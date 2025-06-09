<?php

namespace App\Http\Controllers;

use App\Models\DokumentasiProyek;
use App\Models\LaporanProyek;
use App\Models\PembangunanProyek;
use App\Models\ProgresPembangunan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Role;

class LaporanProyekController extends Controller
{
    /**
     * Constructor untuk middleware dan izin akses.
     */

    public function __construct()
    {
        $this->middleware('permission:laporan-list|laporan-create|laporan-edit|laporan-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:laporan-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:laporan-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:laporan-delete', ['only' => ['destroy']]);
    }

    /**
     * Menampilkan daftar laporan proyek.
     */
    public function index(Request $request): View
    {
        $search = $request->input('search');
        // $user = Auth::user();
        
        // Query untuk mengambil data laporan proyek
        $laporan = LaporanProyek::with('progresTerbaru')
                        
                        ->when($search, function ($query, $search) {
                            return $query->where('nama_proyek', 'like', "%{$search}%")
                                         ->orWhere('deskripsi_proyek', 'like', "%{$search}%")
                                         ->orWhere('kode_laporan', 'like', "%{$search}%")
                                         ;
                        })
                        ->paginate(10);

                        $tahunList = PembangunanProyek::selectRaw('YEAR(tanggal_mulai) as tahun')
                        ->groupBy(DB::raw('YEAR(tanggal_mulai)'))
                        ->orderBy('tahun', 'desc')
                        ->pluck('tahun');
    
        // Mengirimkan data ke view
        return view('laporan_proyek.index', compact('laporan', 'tahunList'));
    }
    /**
     * Menampilkan form pembuatan laporan proyek.
     */
    public function create(): View
    {
        $proyeks = PembangunanProyek::all();
        return view('laporan_proyek.create', compact('proyeks'));
    }

    /**
     * Menyimpan laporan proyek baru.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi input
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
        $tanggal = Carbon::now()->format('Ymd');
        $proyekId = $request->proyek_id;
        $kodeLaporan = $tanggal . '-PRY' . $proyekId . '-' . Str::upper(Str::random(4));
        // Jika sudah ada laporan, redirect dengan pesan
        if ($existingLaporan) {
            return redirect()->route('laporan_proyek.index')->with('error', 'Proyek ini sudah memiliki laporan.');
        }
    
        // Jika belum ada laporan, lanjutkan untuk menyimpan laporan baru
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
    
        return redirect()->route('laporan_proyek.index')->with('success', 'Laporan berhasil dikirim.');
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

    return view('laporan_proyek.show', [
        'laporanId' => $laporanId,
        'persenTersisa' => $persenTersisa,
    ]);
}


    /**
     * Menampilkan detail laporan proyek.
     */
    public function show(LaporanProyek $laporanProyek): View
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
        return view('laporan_proyek.show', compact('laporanProyek','persenTersisa', 'grupUploadTambahan'));
    }

    /**
     * Menampilkan form edit laporan (approval).
     */
    public function approve(LaporanProyek $laporanProyek): View
    {
        return view('laporan_proyek.approve', compact('laporanProyek'));
    }

    /**
     * Memperbarui status approval laporan proyek.
     */
    public function approveaction(Request $request, LaporanProyek $laporanProyek): RedirectResponse
    {
        $request->validate([
            'is_approved' => 'nullable|boolean',
            'keterangan_tolak' => 'nullable|string'
        ]);

        $laporanProyek->update([
            'is_approved' => $request->is_approved,
            'keterangan_tolak' => $request->is_approved ? null : $request->keterangan_tolak
        ]);

        return redirect()->route('laporan_proyek.index')->with('success', 'Laporan berhasil diperbarui.');
    }
    // public function update(Request $request, LaporanProyek $laporanProyek): RedirectResponse
    // {
    //     $request->validate([
    //         'keterangan'=> 'required',
    //         'kendala'=> 'required',
    //         'evaluasi'=> 'required',
    //         'is_approved' => 'nullable|boolean',
    //         'keterangan_tolak' => 'nullable|string'
    //     ]);

    //     $laporanProyek->update([   
    //         'keterangan' => $request->keterangan,
    //         'kendala' => $request->kendala,
    //         'evaluasi' => $request->evaluasi,
    //         'is_approved' => $request->is_approved,
    //         'keterangan_tolak' => $request->is_approved ? null : $request->keterangan_tolak
    //     ]);

    //     return redirect()->route('laporan_proyek.index')->with('success', 'Laporan berhasil diperbarui.');
    // }

    public function edit(LaporanProyek $laporanProyek): View
    {
        $proyek = PembangunanProyek::all();
        return view('laporan_proyek.edit', compact('laporanProyek', 'proyek'));
    }
    public function update(Request $request, $id): RedirectResponse
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
    $tanggal = Carbon::now()->format('Ymd');
    $proyekId = $request->proyek_id;
    $kodeLaporan = $tanggal . '-PRY' . $proyekId . '-' . Str::upper(Str::random(4));
    
    // Memperbarui data laporan
    $laporan->update([
        'proyek_id' => $request->proyek_id,
        // 'kode_laporan' => $kodeLaporan,
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

    return redirect()->route('laporan_proyek.index')->with('success', 'Laporan berhasil diperbarui.');
}

public function cetak($id)
{
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

    $pdf = Pdf::loadView('laporan_proyek.pdf', compact('laporanProyek','nomorUrutFormatted', 'bulanRomawiFormatted', 'tahun'));
    return $pdf->stream('laporan-proyek-'.$laporanProyek->proyek->nama_proyek.'.pdf');
}
    /**
     * Menghapus laporan proyek.
     */
    public function destroy(LaporanProyek $laporanProyek): RedirectResponse
    {
        $laporanProyek->delete();
        return redirect()->route('laporan_proyek.index')->with('success', 'Laporan berhasil dihapus.');
    }
    public function exportPdfPerTahun($tahun)   
    {
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
    $laporan = LaporanProyek::with('proyek')
        ->whereHas('proyek', fn ($q) => $q->whereYear('tanggal_mulai', $tahun))
        ->get();

    $pdf = Pdf::loadView('laporan_proyek.report_pdf', compact('laporan','nomorUrutFormatted', 'bulanRomawiFormatted', 'tahun'));
    return $pdf->download("laporan_proyek_{$tahun}.pdf");
    }
}
