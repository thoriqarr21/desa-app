<?php

namespace App\Http\Controllers;

use App\Models\DesaKegiatan;
use App\Models\DokumentasiProyek;
use App\Models\KategoriKegiatan;
use App\Models\LaporanKegiatan;
use App\Models\LaporanProyek;
use App\Models\PembangunanProyek;
use App\Models\ProgresPembangunan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class FrontController extends Controller
{

    public function kegiatanIndex(Request $request): View
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10); // default 5 jika tidak ada
    
        $kegiatans = DesaKegiatan::when($search, function ($query, $search) {
                            return $query->where('nama_kegiatan', 'like', "%{$search}%")
                                         ->orWhere('deskripsi_kegiatan', 'like', "%{$search}%");
                        })
                        ->latest()
                        ->paginate($perPage)
                        ->appends(['search' => $search, 'per_page' => $perPage]); // pertahankan parameter saat pindah halaman
    
        return view('frontend.kegiatan.index', compact('kegiatans'));
    }
    public function kegiatanShow(DesaKegiatan $kegiatan): View
    {
        Carbon::setLocale('id');
        return view('frontend.kegiatan.show', compact('kegiatan'));
    }
    //   --------------- PROYEK ------------
    public function proyekIndex(Request $request): View
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10);
        $proyeks = PembangunanProyek::when($search, function ($query, $search) {
                        return $query->where('nama_proyek', 'like', "%{$search}%")
                                     ->orWhere('deskripsi_proyek', 'like', "%{$search}%");
                    })
                    ->latest()
                    ->paginate($perPage)
                    ->appends(['search' => $search, 'per_page' => $perPage]);
    
        // Mengirimkan data ke view
        return view('frontend.proyek.index', compact('proyeks'));
    }

    public function proyekShow(PembangunanProyek $proyek): View
    {
        Carbon::setLocale('id');
        return view('frontend.proyek.show', compact('proyek'));
    }
//   --------------- LAPORAN PROYEK ------------
public function laporanIndex(Request $request)
{
    $user = Auth::user();
    $search = $request->input('search');
    $perPage = $request->input('per_page', 10); // default 10 jika tidak diisi

    $laporan = LaporanProyek::when($search, function ($query, $search) {
                            return $query->where('judul_laporan', 'like', "%{$search}%")
                                         ->orWhere('deskripsi_laporan', 'like', "%{$search}%");
                        })
                        ->where('user_id', $user->id)
                        ->latest()
                        ->paginate($perPage)
                        ->appends(['search' => $search, 'per_page' => $perPage]);

    return view('frontend.laporan_proyek.index', compact('laporan'));
}

    public function laporanCreate(): View 
    {
        $proyekSudahDilaporkan = LaporanProyek::pluck('proyek_id')->toArray();

        // Ambil daftar proyek yang belum pernah dilaporkan
        $proyeks = PembangunanProyek::whereNotIn('id', $proyekSudahDilaporkan)->get();
    
        return view('frontend.laporan_proyek.create', compact('proyeks'));
    }

    public function laporanShow(LaporanProyek $laporanProyek): View
    {
        Carbon::setLocale('id');
    
        $laporanProyek = LaporanProyek::with(['proyek', 'user', 'dokumentasi', 'progres'])->findOrFail($laporanProyek->id);
    
        // Semua pilihan persentase
        $semuaPersen = [50, 100];
    
        // Ambil persentase progres terbaru
        $progresTerbaru = optional($laporanProyek->progres->sortByDesc('created_at')->first())->persentase ?? 0;
    
        // Kalau progres terbaru = 50, berarti 50 sudah terpakai, sisanya 100
        // Kalau progres terbaru = 0, berarti semua persentase tersedia
        $persentaseTerpakai = array_filter($semuaPersen, function ($p) use ($progresTerbaru) {
            return $p <= $progresTerbaru && $p > 0;
        });
    
        // Hapus yang terpakai dari semua persen
        $persenTersisa = array_values(array_diff($semuaPersen, $persentaseTerpakai));
    
        // Grup dokumentasi untuk histori
        $grupUploadTambahan = $laporanProyek->dokumentasi
            ->groupBy('persentase')
            ->sortKeys();
    
        return view('frontend.laporan_proyek.show', compact(
            'laporanProyek',
            'persenTersisa',
            'grupUploadTambahan'
        ));
    }
    
    public function laporanEdit(LaporanProyek $laporanProyek): View
    {
        // Ambil semua ID proyek yang sudah dilaporkan, kecuali proyek dari laporan yang sedang diedit
        $proyekSudahDilaporkan = LaporanProyek::where('id', '!=', $laporanProyek->id)
            ->pluck('proyek_id')
            ->toArray();
    
        // Ambil proyek yang belum dilaporkan atau proyek yang sedang diedit
        $proyek = PembangunanProyek::whereNotIn('id', $proyekSudahDilaporkan)
            ->orWhere('id', $laporanProyek->proyek_id)
            ->get();
    
        return view('frontend.laporan_proyek.edit', compact('laporanProyek', 'proyek'));
    }
    
    public function laporanUpdate(Request $request, $id): RedirectResponse
{
    $request->validate([
        'keterangan'=> 'required|string|max:255',
        'kendala'=> 'required|string|max:255',
        'evaluasi'=> 'required|string|max:255',
        'proyek_id' => 'required|exists:pembangunan_proyeks,id',
        'persentase' => 'required|integer|min:0|max:100',
        'dokumentasi.*' => 'nullable|file|mimes:jpeg,png,jpg,mp4,mov,avi|max:10240',
    ]);

    $laporan = LaporanProyek::with(['progres.dokumentasi', 'proyek'])->findOrFail($id);

    $tanggal = Carbon::now()->format('Ymd');
    $proyekId = $request->proyek_id;
    $kodeLaporan = $tanggal . '-PRY' . $proyekId . '-' . Str::upper(Str::random(4));

    // Update data laporan dasar
    $laporan->update([
        'proyek_id' => $request->proyek_id,
        'kode_laporan' => $kodeLaporan,
        'keterangan' => $request->keterangan,
        'kendala' => $request->kendala,
        'evaluasi' => $request->evaluasi,
        'user_id' => Auth::id(),
        'is_approved' => null,
    ]);

    $persentaseBaru = (int) $request->persentase;

    DB::transaction(function() use ($laporan, $request, $persentaseBaru) {
        // Ambil semua progres terkait laporan ini (beserta dokumentasinya)
        $progresList = $laporan->progres()->with('dokumentasi')->get();

        // Hapus semua progres yang bukan persentase baru
        foreach ($progresList as $p) {
            if ((int) $p->persentase !== $persentaseBaru) {
                foreach ($p->dokumentasi as $dok) {
                    if (Storage::disk('public')->exists($dok->file_path)) {
                        Storage::disk('public')->delete($dok->file_path);
                    }
                    $dok->delete();
                }
                $p->delete();
            }
        }

        // Pastikan ada record progres untuk persentase baru (buat jika belum ada)
        $progres = ProgresPembangunan::firstOrCreate(
            ['laporan_id' => $laporan->id, 'persentase' => $persentaseBaru],
            ['created_at' => now(), 'updated_at' => now()]
        );

        // Upload dokumentasi baru (jika ada)
        if ($request->hasFile('dokumentasi')) {
            foreach ($request->file('dokumentasi') as $file) {
                $path = $file->store('dokumentasi', 'public');
                $mime = $file->getMimeType();
                $fileType = Str::contains($mime, 'video') ? 'video' : 'image';

                $progres->dokumentasi()->create([
                    'laporan_id' => $laporan->id,
                    'file_path' => $path,
                    'file_type' => $fileType,
                    'keterangan' => 'Upload baru',
                    'progres_id' => $progres->id,
                    'persentase' => $persentaseBaru,
                    'is_initial' => false,
                ]);
            }
        }

        // Update status proyek
        if ($persentaseBaru === 100) {
            if ($laporan->proyek) {
                $laporan->proyek->update(['status' => 'selesai']);
            }
        } else {
            if ($laporan->proyek) {
                $laporan->proyek->update(['status' => 'proses']);
            }
        }
    });

    return redirect()
        ->route('frontend.laporan_proyek.index')
        ->with('primary', 'Laporan berhasil diperbarui.');
}


public function laporanStore(Request $request): RedirectResponse
{
    $request->validate([
        'keterangan'=> 'required|string|max:255',
        'kendala'=> 'required|string|max:255',
        'evaluasi'=> 'required|string|max:255',
        'proyek_id' => 'required|exists:pembangunan_proyeks,id',
        'persentase' => 'required|integer|min:0|max:100',
        'dokumentasi.*' => 'file|mimes:jpeg,png,jpg,mp4,mov,avi|max:10240', // max 10MB
    ]);
    
    // Cek apakah proyek sudah memiliki laporan
    $existingLaporan = LaporanProyek::where('proyek_id', $request->proyek_id)->first();
    $tanggal = Carbon::now()->format('Ymd');
    $proyekId = $request->proyek_id;
    $kodeLaporan = $tanggal . '-PRY' . $proyekId . '-' . Str::upper(Str::random(4));

    if ($existingLaporan) {
        return redirect()->route('frontend.laporan_proyek.index')
                         ->with('error', 'Proyek ini sudah memiliki laporan.');
    }

    // Simpan laporan
    $laporan = LaporanProyek::create([
        'proyek_id' => $request->proyek_id,
        'kode_laporan' => $kodeLaporan,
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
            $mime = $file->getMimeType();
            $fileType = str_contains($mime, 'video') ? 'video' : 'image';

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

    // 🔹 Jika persentase 100%, ubah status proyek jadi selesai
    if ((int) $request->persentase === 100) {
        $laporan->proyek->update([
            'status' => 'selesai',
        ]);
    }

    return redirect()->route('frontend.laporan_proyek.index')
                     ->with('success', 'Laporan berhasil ditambahkan.');
}


    public function storeTambahan(Request $request)
{
    $request->validate([
        'laporan_id' => 'required|exists:laporan_proyeks,id',
        'persentase' => 'required|numeric|min:0|max:100',
        'dokumentasi' => 'required|array|max:3',
        'dokumentasi.*' => 'file|mimes:jpg,jpeg,png,mp4,mov,avi|max:10240',
        'keterangan' => 'nullable|string',
    ]);

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

    // Jika gagal buat progres
    if (!$progres) {
        return back()->with('error', 'Progres gagal dibuat.');
    }

    // Simpan dokumentasi
    foreach ($request->file('dokumentasi') as $file) {
        $path = $file->store('dokumentasi', 'public');
        $extension = $file->getClientOriginalExtension();
        $fileType = $this->tentukanFileType($extension);

        $progres->dokumentasi()->create([
            'laporan_id' => $request->laporan_id,
            'file_path' => $path,
            'keterangan' => $request->keterangan,
            'progres_id' => $progres->id,
            'persentase' => $progres->persentase,
            'is_initial' => true,
            'file_type' => $fileType,
        ]);
    }
    // Jika persentase 100% → proyek selesai
    if ((int) $request->persentase === 100) {
        $laporan = LaporanProyek::with('proyek')->findOrFail($request->laporan_id);
        if ($laporan->proyek && $laporan->proyek->status !== 'selesai') {
            $laporan->proyek->update([
                'status' => 'selesai',
            ]);
        }
    } else {
        // Kalau persentase < 100, pastikan status proyek jadi proses
        $laporan = LaporanProyek::with('proyek')->findOrFail($request->laporan_id);
        if ($laporan->proyek && $laporan->proyek->status === 'selesai') {
            $laporan->proyek->update([
                'status' => 'proses',
            ]);
        }
    }
    return back()->with('success', 'Dokumentasi tambahan berhasil ditambahkan!');
}


public function updateTambahanBerdasarkanPersen(Request $request)
{
    $request->validate([
        'laporan_id' => 'required|exists:laporan_proyeks,id',
        'persentase' => 'required|numeric',
        'dokumentasi' => 'required|array|max:3',
        'dokumentasi.*' => 'file|mimes:jpg,jpeg,png,mp4,mov,avi|max:10240',
        'keterangan' => 'required|string',
    ]);

    // Ambil semua dokumentasi yang sesuai
    $dokumentasiList = DokumentasiProyek::where('laporan_id', $request->laporan_id)
        ->where('persentase', $request->persentase)
        ->get();

    // Hapus semua file lama dan record-nya
    foreach ($dokumentasiList as $dokumentasi) {
        if (Storage::disk('public')->exists($dokumentasi->file_path)) {
            Storage::disk('public')->delete($dokumentasi->file_path);
        }
        $dokumentasi->delete();
    }

    // Cari progres_id jika perlu disimpan ulang
    $progresId = $dokumentasiList->first()->progres_id ?? null;

    // Upload file baru dan simpan
    foreach ($request->file('dokumentasi') as $file) {
        $path = $file->store('dokumentasi', 'public');
        $fileType = $this->tentukanFileType($file->getClientOriginalExtension());

        DokumentasiProyek::create([
            'laporan_id' => $request->laporan_id,
            'progres_id' => $progresId,
            'file_path' => $path,
            'file_type' => $fileType,
            'keterangan' => $request->keterangan,
            'persentase' => $request->persentase,
            'is_initial' => true,
        ]);
    }

    return back()->with('primary', 'Dokumentasi progres ' . $request->persentase . '% berhasil diperbarui dan diganti total.');
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
public function laporanDestroy($id): RedirectResponse
{
    $laporanProyek = LaporanProyek::findOrFail($id);
    // Hapus dokumentasi terkait beserta file fisiknya
    foreach ($laporanProyek->dokumentasi as $dok) {
        if ($dok->file_path && Storage::disk('public')->exists($dok->file_path)) {
            Storage::disk('public')->delete($dok->file_path);
        }
        $dok->delete();
    }

    // Hapus laporan proyek
    $laporanProyek->delete();

    return redirect()->route('frontend.laporan_proyek.index')
                     ->with('danger', 'Laporan dan dokumentasinya berhasil dihapus.');
}


public function cetakProyek($id)
{
    Carbon::setLocale('id');
    $bulan = date('n'); // nomor bulan (1-12)
    $tahun = date('Y');

    // Hitung berapa laporan yang sudah dibuat pada bulan dan tahun ini
    $count = LaporanProyek::whereMonth('created_at', $bulan)
                           ->whereYear('created_at', $tahun)
                           ->count();

    // Nomor urut berikutnya
    $nomorUrut = $count + 1;

    // Format nomor urut jadi dua digit, misal 01, 02, 10
    $nomorUrutFormatted = str_pad($nomorUrut, 2, '0', STR_PAD_LEFT);

    // Ubah bulan ke romawi
    $bulanRomawi = ['I','II','III','IV','V','VI','VII','VIII','IX','X','XI','XII'];
    $bulanRomawiFormatted = $bulanRomawi[$bulan - 1];

    $laporanProyek = LaporanProyek::with(['proyek', 'user', 'dokumentasi.progres'])->findOrFail($id);

    $pdf = Pdf::loadView('frontend.laporan_proyek.pdf', compact('laporanProyek','nomorUrutFormatted', 'bulanRomawiFormatted', 'tahun'));
    return $pdf->stream('frontend.laporan-proyek-'.$laporanProyek->proyek->nama_proyek.'.pdf');
}



    /**
     * LAPORAN KEGIATAN
     */

     public function indexLaporanKegiatan(Request $request): View
     {
         $search = $request->input('search');
         $perPage = $request->input('per_page', 10); // default 10 jika tidak diisi
         $user = Auth::user();
     
         $laporan = LaporanKegiatan::with('kegiatan') // pastikan eager loading relasi
             ->when($search, function ($query, $search) {
                 $query->where(function ($q) use ($search) {
                     $q->whereHas('kegiatan', function ($subQuery) use ($search) {
                         $subQuery->where('nama_kegiatan', 'like', "%{$search}%");
                     })->orWhere('kode_kegiatan', 'like', "%{$search}%");
                 });
             })
             ->where('user_id', $user->id)
             ->latest()
             ->paginate($perPage)
             ->appends(['search' => $search, 'per_page' => $perPage]);
     
         return view('frontend.laporan_kegiatan.index', compact('laporan'));
     }
     
     

     public function createLaporanKegiatan(): View
     {
        $kegiatanSudahDilaporkan = LaporanKegiatan::pluck('kegiatan_id')->toArray();

        $kegiatans = DesaKegiatan::whereNotIn('id', $kegiatanSudahDilaporkan)->get();
         return view('frontend.laporan_kegiatan.create', compact('kegiatans'));
     }
 
     /**
      * Store a newly created resource in storage.
      */
      public function storeLaporanKegiatan(Request $request): RedirectResponse
      {
          $request->validate([
              'keterangan'=> 'required|string|max:255',
              'hasil'=> 'required|string|max:255',
              'tujuan_kegiatan'=> 'required|string|max:255',
              'evaluasi'=> 'required|string|max:255',
              'kegiatan_id' => 'required|exists:desa_kegiatans,id',
              'dokumentasi.*' => 'file|mimes:jpeg,png,jpg,mp4,mov,avi|max:10240', // max 10MB
          ]);
      
          $existingLaporan = LaporanKegiatan::where('kegiatan_id', $request->kegiatan_id)->first();
          $tanggal = Carbon::now()->format('Ymd');
      
          $kegiatanId = $request->kegiatan_id;
          $kodeKegiatan = $tanggal . '-KGT' . $kegiatanId . '-' . Str::upper(Str::random(4));
      
          if ($existingLaporan) {
              return redirect()->route('frontend.laporan_kegiatan.index')
                  ->with('error', 'Kegiatan ini sudah memiliki laporan.');
          }
      
          $laporan = LaporanKegiatan::create([
              'kegiatan_id' => $request->kegiatan_id,
              'hasil' => $request->hasil,
              'kode_kegiatan' => $kodeKegiatan,
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
                      'file_path' => $path,
                      'file_type' => $fileType,
                  ]);
              }
          }
      
          return redirect()->route('frontend.laporan_kegiatan.index')->with('success', 'Laporan berhasil ditambahkan.');
      }
      

     public function showLaporanKegiatan(LaporanKegiatan $laporanKegiatan): View
    {
        Carbon::setLocale('id');
        $laporanKegiatan->load('dokumentasi');
        return view('frontend.laporan_kegiatan.show', compact('laporanKegiatan'));
    }
    

    /**
     * Show the form for editing the specified resource.
     */
public function editLaporanKegiatan(LaporanKegiatan $laporanKegiatan): View
{
    // Ambil semua ID kegiatan yang sudah dilaporkan, kecuali yang sedang diedit
    $kegiatanSudahDilaporkan = LaporanKegiatan::where('id', '!=', $laporanKegiatan->id)
        ->pluck('kegiatan_id')
        ->toArray();

    // Ambil kegiatan yang belum dilaporkan atau yang sedang diedit
    $kegiatan = DesaKegiatan::whereNotIn('id', $kegiatanSudahDilaporkan)
        ->orWhere('id', $laporanKegiatan->kegiatan_id)
        ->get();

    return view('frontend.laporan_kegiatan.edit', compact('laporanKegiatan', 'kegiatan'));
}

    /**
     * Update the specified resource in storage.
     */
    public function updateLaporanKegiatan(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'keterangan'=> 'required|string|max:255',
            'hasil'=> 'required|string|max:255',
            'tujuan_kegiatan'=> 'required|string|max:255',
            'evaluasi'=> 'required|string|max:255',
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
    
        return redirect()->route('frontend.laporan_kegiatan.index')->with('primary', 'Laporan berhasil diperbarui.');
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
                          ->with('danger', 'Laporan dan dokumentasinya berhasil dihapus.');
     }
     public function cetakKegiatan($id)
    {
        Carbon::setLocale('id');
        $bulan = date('n'); // nomor bulan (1-12)
        $tahun = date('Y');
    
        // Hitung berapa laporan yang sudah dibuat pada bulan dan tahun ini
        $count = LaporanKegiatan::whereMonth('created_at', $bulan)
                               ->whereYear('created_at', $tahun)
                               ->count();
    
        // Nomor urut berikutnya
        $nomorUrut = $count + 1;
    
        // Format nomor urut jadi dua digit, misal 01, 02, 10
        $nomorUrutFormatted = str_pad($nomorUrut, 2, '0', STR_PAD_LEFT);
    
        // Ubah bulan ke romawi
        $bulanRomawi = ['I','II','III','IV','V','VI','VII','VIII','IX','X','XI','XII'];
        $bulanRomawiFormatted = $bulanRomawi[$bulan - 1];

    $laporanKegiatan = LaporanKegiatan::with(['kegiatan', 'user', 'dokumentasi.laporan'])->findOrFail($id);

    $pdf = Pdf::loadView('frontend.laporan_kegiatan.pdf', compact('laporanKegiatan','nomorUrutFormatted', 'bulanRomawiFormatted', 'tahun'));
    return $pdf->stream('frontend.laporan-kegiatan-'.$laporanKegiatan->kegiatan->nama_kegiatan.'.pdf');
    }
  // -------------------------------  ///

  public function profile(): View
  {
      $user = Auth::user();
      return view('frontend.profile', compact('user'));
  }
  
  public function updatePassword(Request $request): RedirectResponse
  {
      $request->validate([
          'current_password' => 'required',
          'new_password' => 'required|min:6|confirmed',
      ]);
  
      
  
      $user = Auth::user();
  
      if (!Hash::check($request->current_password, $user->password)) {
          return back()->withErrors(['current_password' => 'Password saat ini salah.']);
      }
  
      $user->password = Hash::make($request->new_password);
      $user->save(); 
      return back()->with('primary', 'Password berhasil diperbarui.');
  }
  public function updateProfile(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'name' => 'required|string|max:255',
        'username' => 'required|string|max:255',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $user->name = $request->name;
    $user->username = $request->username;

    if ($request->hasFile('gambar')) {
        // Hapus gambar lama jika ada
        if ($user->gambar && Storage::disk('public')->exists($user->gambar)) {
            Storage::disk('public')->delete($user->gambar);
        }

        $path = $request->file('gambar')->store('profile', 'public');
        $user->gambar = $path;
    }

    $user->save();

    return redirect()->back()->with('primary', 'Profil berhasil di update.');
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
