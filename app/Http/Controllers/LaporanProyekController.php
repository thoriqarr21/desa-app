<?php

namespace App\Http\Controllers;

use App\Exports\LaporanProyekExport;
use App\Models\DokumentasiProyek;
use App\Models\LaporanProyek;
use App\Models\PembangunanProyek;
use App\Models\ProgresPembangunan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Maatwebsite\Excel\Facades\Excel;
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
        $bulan = $request->input('bulan');
        
        // Query untuk mengambil data laporan proyek
        $laporan = LaporanProyek::with('progresTerbaru')
                        
                        ->when($search, function ($query, $search) {
                            return $query->where('nama_proyek', 'like', "%{$search}%")
                                         ->orWhere('deskripsi_proyek', 'like', "%{$search}%")
                                         ->orWhere('kode_laporan', 'like', "%{$search}%")
                                         ;
                        })
                        ->when($bulan, function ($query, $bulan) {
                            return $query->whereMonth('created_at', $bulan);
                        })
                        ->orderByDesc('created_at')
                        ->paginate(5)
                        ->appends($request->all());

                        $tahunList = PembangunanProyek::selectRaw('YEAR(tanggal_mulai) as tahun')
                        ->groupBy(DB::raw('YEAR(tanggal_mulai)'))
                        ->orderBy('tahun', 'desc')
                        ->pluck('tahun');
    
        // Mengirimkan data ke view
        return view('laporan_proyek.index', compact('laporan', 'tahunList','bulan'));
    }
    /**
     * Menampilkan form pembuatan laporan proyek.
     */
    public function create(): View
    {
        $proyekSudahDilaporkan = LaporanProyek::pluck('proyek_id')->toArray();

        // Ambil daftar proyek yang belum pernah dilaporkan
        $proyeks = PembangunanProyek::whereNotIn('id', $proyekSudahDilaporkan)->get();
        return view('laporan_proyek.create', compact('proyeks'));
    }

    /**
     * Menyimpan laporan proyek baru.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi input
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

    return back()->with('success', 'Dokumentasi progres ' . $request->persentase . '% berhasil diperbarui dan diganti total.');
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
    $semuaPersen = [50, 100];

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
        $semuaPersen = [50, 100];

    // Ambil persentase dokumentasi yang sudah dipakai (khusus tambahan > 30%)
    $persentaseTerpakai = $laporanProyek->dokumentasi
        ->where('persentase', '>', 0)
        ->pluck('persentase')
        ->unique()
        ->toArray();
        
        $laporanProyek->load('dokumentasi'); // Pastikan dokumentasi sudah dimuat
        $grupUploadTambahan = $laporanProyek->dokumentasi
            ->groupBy('persentase')
            ->sortKeys();; 

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


    public function edit(LaporanProyek $laporanProyek): View
    {
        $proyekSudahDilaporkan = LaporanProyek::where('id', '!=', $laporanProyek->id)
        ->pluck('proyek_id')
        ->toArray();
        
        // Ambil proyek yang belum dilaporkan atau proyek yang sedang diedit
        $proyek = PembangunanProyek::whereNotIn('id', $proyekSudahDilaporkan)
        ->orWhere('id', $laporanProyek->proyek_id)
        ->get();
        return view('laporan_proyek.edit', compact('laporanProyek', 'proyek'));
    }
    public function update(Request $request, $id): RedirectResponse
    {
    $request->validate([
        'keterangan'=> 'required|string|max:255',
        'kendala'=> 'required|string|max:255',
        'evaluasi'=> 'required|string|max:255',
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

    return redirect()->route('laporan_proyek.index')->with('primary', 'Laporan berhasil di update.');
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
        return redirect()->route('laporan_proyek.index')->with('danger', 'Laporan berhasil dihapus.');
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

    // Convert koordinat ke nama lokasi
    foreach ($laporan as $item) {
        \Log::info('Koordinat:', [
            'lat' => $item->proyek->latitude ?? 'null',
            'lng' => $item->proyek->longitude ?? 'null',
        ]);
    
        if ($item->proyek && $item->proyek->latitude && $item->proyek->longitude) {
            $item->proyek->lokasi_nama = $this->getAddressFromCoordinates(
                $item->proyek->latitude,
                $item->proyek->longitude
            );
        } else {
            $item->proyek->lokasi_nama = '-';
        }
    }
    
    $pdf = Pdf::loadView('laporan_proyek.report_pdf', compact('laporan','nomorUrutFormatted', 'bulanRomawiFormatted', 'tahun'));
    return $pdf->download("laporan_proyek_{$tahun}.pdf");
    }

    
    protected function getAddressFromCoordinates($lat, $lng)
    {
        try {
            $url = "https://nominatim.openstreetmap.org/reverse?format=json&lat={$lat}&lon={$lng}&addressdetails=1";
            $response = file_get_contents($url, false, stream_context_create([
                'http' => ['header' => "User-Agent: laporan-proyek\r\n"]
            ]));
            $data = json_decode($response, true);
            return $data['display_name'] ?? '-';
        } catch (\Exception $e) {
            return '-';
        }
    }
    public function exportExcelPerTahun($tahun)
    {
        $bulan = date('n');
        $tahun = (int) $tahun;
    
        $count = LaporanProyek::whereMonth('created_at', $bulan)
                                ->whereYear('created_at', $tahun)
                                ->count();
    
        $nomorUrutFormatted = str_pad($count + 1, 2, '0', STR_PAD_LEFT);
        $bulanRomawi = ['I','II','III','IV','V','VI','VII','VIII','IX','X','XI','XII'];
        $bulanRomawiFormatted = $bulanRomawi[$bulan - 1];
    
        $laporan = LaporanProyek::with('proyek')
            ->whereHas('proyek', fn($q) => $q->whereYear('tanggal_mulai', $tahun))
            ->get();
    
        return Excel::download(new LaporanProyekExport($laporan, $nomorUrutFormatted, $bulanRomawiFormatted, $tahun), "laporan_proyek_{$tahun}.xlsx");
    }
}

