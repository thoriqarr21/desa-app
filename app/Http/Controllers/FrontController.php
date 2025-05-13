<?php

namespace App\Http\Controllers;

use App\Models\DesaKegiatan;
use App\Models\KategoriKegiatan;
use App\Models\LaporanKegiatan;
use App\Models\LaporanProyek;
use App\Models\PembangunanProyek;
use App\Models\ProgresPembangunan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class FrontController extends Controller
{
//   --------------- LAPORAN PROYEK ------------
    public function laporanIndex() {
        // Use paginate to paginate results
        $laporan = LaporanProyek::paginate(10); // Adjust the number as needed
        return view('frontend.laporan_proyek.index', compact('laporan'));
    }
    
    public function laporanCreate(): View 
    {
        $proyeks = PembangunanProyek::all();
        return view('frontend.laporan_proyek.create', compact('proyeks'));
    }

    public function laporanShow(LaporanProyek $laporanProyek): View
    {
        $persentaseList = $laporanProyek->dokumentasi->pluck('persentase')->unique()->sort()->values();
        $laporanProyek->load('proyek', 'user');
        $semuaPersen = [50, 80, 100];

    // Ambil persentase dokumentasi yang sudah dipakai (khusus tambahan > 30%)
    $persentaseTerpakai = $laporanProyek->dokumentasi
        ->where('persentase', '>', 30)
        ->pluck('persentase')
        ->unique()
        ->toArray();
        
        $laporanProyek->load('dokumentasi'); // Pastikan dokumentasi sudah dimuat
        $grupUploadTambahan = $laporanProyek->dokumentasi
            ->groupBy('persentase'); 

    // Hitung persentase yang belum dipakai
    $persenTersisa = array_values(array_diff($semuaPersen, $persentaseTerpakai));
        return view('frontend.laporan_proyek.show', compact('laporanProyek','persenTersisa', 'grupUploadTambahan'));
    }


    public function laporanEdit(LaporanProyek $laporanProyek): View
    {
    $proyek = PembangunanProyek::all(); 
    return view('frontend.laporan_proyek.edit', compact('laporanProyek', 'proyek')); 
    }
    public function laporanUpdate(Request $request, $id): RedirectResponse
{
    $request->validate([
        'keterangan'=> 'required',
        'kendala'=> 'required',
        'evaluasi'=> 'required',
        'proyek_id' => 'required|exists:pembangunan_proyeks,id',
        'persentase' => 'required|integer|min:0|max:100',
        'dokumentasi.*' => 'file|mimes:jpeg,png,jpg,mp4,mov,avi|max:10240',
    ]);

    // Mencari laporan berdasarkan ID
    $laporan = LaporanProyek::findOrFail($id);
    
    // Memperbarui data laporan
    $laporan->update([
        'proyek_id' => $request->proyek_id,
        'keterangan' => $request->keterangan,
        'kendala' => $request->kendala,
        'evaluasi' => $request->evaluasi,
        'user_id' => Auth::id(),
        'is_approved' => null,
    ]);

    // Mencari progres yang terkait dengan laporan
    $progres = $laporan->progres()->first();
    
    // Memperbarui persentase
    if ($progres) {
        $progres->update([
            'persentase' => $request->persentase
        ]);
    }

    // Mengupdate dokumentasi jika ada file baru
    if ($request->hasFile('dokumentasi')) {
        // Hapus semua dokumentasi yang ada sebelumnya
        $progres->dokumentasi()->delete();

        // Menambahkan file baru
        foreach ($request->file('dokumentasi') as $file) {
            $path = $file->store('dokumentasi', 'public');

            // Deteksi jenis file: image atau video
            $mime = $file->getMimeType();
            $fileType = str_contains($mime, 'video') ? 'video' : 'image';

            $progres->dokumentasi()->create([
                'laporan_id' => $laporan->id,
                'file_path' => $path,
                'file_type' => $fileType, // Menyimpan jenis file
                'keterangan' => 'Upload baru', // Ganti dengan keterangan sesuai kebutuhan
                'progres_id' => $progres->id,
                'is_initial' => false,  // Mengindikasikan ini bukan dokumentasi awal
            ]);
        }
    }

    return redirect()->route('frontend.laporan_proyek.index')->with('success', 'Laporan berhasil diperbarui.');
}

    public function laporanStore(Request $request): RedirectResponse
    {
        $request->validate([
            'keterangan'=> 'required',
            'kendala'=> 'required',
            'evaluasi'=> 'required',
            'proyek_id' => 'required|exists:pembangunan_proyeks,id',
            'persentase' => 'required|integer|min:0|max:100',
            'dokumentasi.*' => 'file|mimes:jpeg,png,jpg,mp4,mov,avi|max:10240', // max 10MB
        ]);
        
        // Cek apakah proyek sudah memiliki laporan
        $existingLaporan = LaporanProyek::where('proyek_id', $request->proyek_id)->first();
    
        // Jika sudah ada laporan, redirect dengan pesan
        if ($existingLaporan) {
            return redirect()->route('laporan_proyek.index')->with('error', 'Proyek ini sudah memiliki laporan.');
        }
    
        // Jika belum ada laporan, lanjutkan untuk menyimpan laporan baru
        $laporan = LaporanProyek::create([
            'proyek_id' => $request->proyek_id,
            'keterangan' => $request->keterangan,
            'kendala' => $request->kendala,
            'evaluasi' => $request->evaluasi,
            'user_id' => Auth::id(),
            'is_approved' => null,
        ]);
    
        // Simpan progres
        $progres = $laporan->progres()->create([
            'persentase' => $request->persentase
        ]);
    
        // Menyimpan dokumentasi jika ada
        if ($request->hasFile('dokumentasi')) {
            foreach ($request->file('dokumentasi') as $file) {
                $path = $file->store('dokumentasi', 'public');
    
                // Deteksi jenis file: image atau video
                $mime = $file->getMimeType();
                $fileType = str_contains($mime, 'video') ? 'video' : 'image';
    
                // Simpan dokumentasi
                $progres->dokumentasi()->create([
                    'laporan_id'   => $laporan->id,
                    'file_path'    => $path,
                    'file_type'    => $fileType,
                    'keterangan'   => 'Upload awal',
                    'progres_id'   => $progres->id,
                    'persentase'   => $progres->persentase,
                    'is_initial'   => false,
                ]);
            }
        }
    
        return redirect()->route('frontend.laporan_proyek.index')->with('success', 'Laporan berhasil dikirim.');
    }


    public function storeTambahan(Request $request)
    {
    // Dapatkan progres sesuai persentase
    $progres = ProgresPembangunan::firstOrCreate(
        [
            'laporan_id' => $request->laporan_id,
            'persentase' => $request->persentase,
        ],
        [
            'created_at' => now(),
            'updated_at' => now(),
        ]
    );
    
    // Pastikan $progres berhasil dibuat
    if (!$progres) {
        return back()->with('error', 'Progres gagal dibuat.');
    }
    
    // Jika ada file dokumentasi
    foreach ($request->file('dokumentasi') as $file) {
        $path = $file->store('dokumentasi', 'public');
        $extension = $file->getClientOriginalExtension(); // contoh: jpg, png
    
        $fileType = $this->tentukanFileType($extension);
    
        $progres->dokumentasi()->create([
            'laporan_id' => $request->laporan_id,
            'file_path' => $path,
            'keterangan' => $request->keterangan,
            'progres_id' => $progres->id,
            'persentase' => $progres->persentase,
            'is_initial' => true,
            'file_type' => $fileType, // ← tambahkan ini
        ]);
    }
    


    return back()->with('success', 'Dokumentasi tambahan berhasil ditambahkan!');
}
private function tentukanFileType($ext)
{
    $imageExt = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    $videoExt = ['mp4', 'mov', 'avi'];
    $pdfExt = ['pdf'];

    if (in_array($ext, $imageExt)) return 'image';
    if (in_array($ext, $videoExt)) return 'video';
    if (in_array($ext, $pdfExt)) return 'pdf';
    return 'other';
}
public function createTambahan($laporanId)
{
    $semuaPersen = [50, 80, 100];

    $persenTerpakai = ProgresPembangunan::where('laporan_id', $laporanId)
        ->pluck('persentase')
        ->toArray();

    $persenTersisa = array_diff($semuaPersen, $persenTerpakai);

    return view('frontend.laporan_proyek.show', [
        'laporanId' => $laporanId,
        'persenTersisa' => $persenTersisa,
    ]);
}
public function cetakProyek($id)
{
    $laporanProyek = LaporanProyek::with(['proyek', 'user', 'dokumentasi.progres'])->findOrFail($id);

    $pdf = Pdf::loadView('frontend.laporan_proyek.pdf', compact('laporanProyek'));
    return $pdf->stream('frontend.laporan-proyek-'.$laporanProyek->proyek->nama_proyek.'.pdf');
}



    /**
     * APORAN KEGIATAN
     */

     public function indexLaporanKegiatan(Request $request): View
     {
         $search = $request->input('search');
         $user = Auth::user();
         
         $laporan = LaporanKegiatan::when($search, function ($query, $search) {
            return $query->where('nama_kegiatan', 'like', "%{$search}%")
                ->orWhere('deskripsi_kegiatan', 'like', "%{$search}%");
                })->where('user_id', $user->id)->paginate(10);
     
         // Mengirimkan data ke view
         return view('frontend.laporan_kegiatan.index', compact('laporan'));
     }

     public function createLaporanKegiatan(): View
     {
         $kegiatans = DesaKegiatan::all();
         return view('frontend.laporan_kegiatan.create', compact('kegiatans'));
     }
 
     /**
      * Store a newly created resource in storage.
      */
     public function storeLaporanKegiatan(Request $request): RedirectResponse
     {
         $request->validate([
             'keterangan'=> 'required',
             'hasil'=> 'required',
             'tujuan_kegiatan'=> 'required',
             'evaluasi'=> 'required',
             'kegiatan_id' => 'required|exists:desa_kegiatans,id',
             'dokumentasi.*' => 'file|mimes:jpeg,png,jpg,mp4,mov,avi|max:10240', // max 10MB
         ]);
         
         $existingLaporan = LaporanKegiatan::where('kegiatan_id', $request->kegiatan_id)->first();
     
         // Jika sudah ada laporan, redirect dengan pesan
         if ($existingLaporan) {
             return redirect()->route('frontend.laporan_kegiatan.index')->with('error', 'Kegiatan ini sudah memiliki laporan.');
         }
     
         // Jika belum ada laporan, lanjutkan untuk menyimpan laporan baru
         $laporan = LaporanKegiatan::create([
             'kegiatan_id' => $request->kegiatan_id,
             'hasil' => $request->hasil,
             'tujuan_kegiatan' => $request->tujuan_kegiatan,
             'evaluasi' => $request->evaluasi,
             'user_id' => Auth::id(),
             'keterangan' => $request->keterangan,
             'is_approved' => null,
         ]);
     
         if ($request->hasFile('dokumentasi')) {
             foreach ($request->file('dokumentasi') as $file) {
                 $path = $file->store('dokumentasi', 'public');
     
                 $mime = $file->getMimeType();
                 $fileType = str_contains($mime, 'video') ? 'video' : 'image';
     
                 $laporan->dokumentasi()->create([
                     'file_path'   => $path,
                     'file_type'   => $fileType,
                 ]);
             }
         }
     
         return redirect()->route('frontend.laporan_kegiatan.index')->with('success', 'Laporan berhasil dikirim.');
     }

     public function showLaporanKegiatan(LaporanKegiatan $laporanKegiatan): View
    {
        $laporanKegiatan->load('dokumentasi');
        return view('frontend.laporan_kegiatan.show', compact('laporanKegiatan'));
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function editLaporanKegiatan(LaporanKegiatan $laporanKegiatan): View
    {
        $kegiatan = DesaKegiatan::all();
        return view('frontend.laporan_kegiatan.edit', compact('laporanKegiatan', 'kegiatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateLaporanKegiatan(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'keterangan'=> 'required',
            'hasil'=> 'required',
            'tujuan_kegiatan'=> 'required',
            'evaluasi'=> 'required',
            'kegiatan_id' => 'required|exists:desa_kegiatans,id',
            'dokumentasi.*' => 'file|mimes:jpeg,png,jpg,mp4,mov,avi|max:10240', // max 10MB
        ]);
    
        // Mencari laporan berdasarkan ID
        $laporan = LaporanKegiatan::findOrFail($id);
        
        // Memperbarui data laporan
        $laporan->update([
            'laporan_id' => $request->laporan_id,
            'keterangan' => $request->keterangan,
            'hasil' => $request->hasil,
            'tujuan_kegiatan' => $request->tujuan_kegiatan,
            'evaluasi' => $request->evaluasi,
            'user_id' => Auth::id(),
            'is_approved' => null,
        ]);
    
        // Mencari progres yang terkait dengan laporan
    
        // Mengupdate dokumentasi jika ada file baru
        if ($request->hasFile('dokumentasi')) {
            // Hapus semua dokumentasi yang ada sebelumnya
            $laporan->dokumentasi()->delete();
    
            // Menambahkan file baru
            foreach ($request->file('dokumentasi') as $file) {
                $path = $file->store('dokumentasi', 'public');
    
                // Deteksi jenis file: image atau video
                $mime = $file->getMimeType();
                $fileType = str_contains($mime, 'video') ? 'video' : 'image';
    
                $laporan->dokumentasi()->create([
                    'laporan_id' => $laporan->id,
                    'file_path' => $path,
                    'file_type' => $fileType, // Menyimpan jenis file
                ]);
            }
        }
    
        return redirect()->route('frontend.laporan_kegiatan.index')->with('success', 'Laporan berhasil diperbarui.');
    }

     public function destroyLaporanKegiatan($id)
     {
         $laporan = LaporanKegiatan::findOrFail($id);
     
         // Hapus dokumentasi terkait dan file fisiknya
         foreach ($laporan->dokumentasi as $dok) {
             if ($dok->file_path && \Storage::disk('public')->exists($dok->file_path)) {
                 \Storage::disk('public')->delete($dok->file_path);
             }
             $dok->delete();
         }
     
         // Hapus laporan
         $laporan->delete();
     
         return redirect()->route('frontend.laporan_kegiatan.index')
                          ->with('success', 'Laporan dan dokumentasinya berhasil dihapus.');
     }
     public function cetakKegiatan($id)
    {
    $laporanKegiatan = LaporanKegiatan::with(['kegiatan', 'user', 'dokumentasi.laporan'])->findOrFail($id);

    $pdf = Pdf::loadView('frontend.laporan_kegiatan.pdf', compact('laporanKegiatan'));
    return $pdf->stream('frontend.laporan-kegiatan-'.$laporanKegiatan->kegiatan->nama_kegiatan.'.pdf');
    }
 
// ------------------------------

     public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
