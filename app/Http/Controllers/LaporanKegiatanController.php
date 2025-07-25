<?php

namespace App\Http\Controllers;

use App\Models\DesaKegiatan;
use App\Models\LaporanKegiatan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanKegiatanExport;

class LaporanKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function __construct()
     {
         $this->middleware('permission:laporankegiatan-list|laporankegiatan-create|laporankegiatan-edit|laporankegiatan-delete', ['only' => ['index', 'show']]);
         $this->middleware('permission:laporankegiatan-create', ['only' => ['create', 'store']]);
         $this->middleware('permission:laporankegiatan-edit', ['only' => ['edit', 'update']]);
         $this->middleware('permission:laporankegiatan-delete', ['only' => ['destroy']]);
     }
    public function index(Request $request): View
    {
        $search = $request->input('search');
        $laporan = LaporanKegiatan::when($search, function ($query, $search) {
                            return $query->where('nama_kegiatan', 'like', "%{$search}%")
                                         ->orWhere('deskripsi_kegiatan', 'like', "%{$search}%");
                        })
                        ->paginate(10);

                        $tahunList = DesaKegiatan::selectRaw('YEAR(tanggal_mulai) as tahun')
                        ->groupBy(DB::raw('YEAR(tanggal_mulai)'))
                        ->orderBy('tahun', 'desc')
                        ->pluck('tahun');
    
        // Mengirimkan data ke view
        return view('laporan_kegiatan.index', compact('laporan', 'tahunList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $kegiatans = DesaKegiatan::all();
        return view('laporan_kegiatan.create', compact('kegiatans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
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
        $tanggal = Carbon::now()->format('Ymd');

        // Ambil id kegiatan
        $kegiatanId = $request->kegiatan_id;
    
        // Generate kode_kegiatan unik, misalnya: 20250521-KGT1234-XYZ
        $kodeKegiatan = $tanggal . '-KGT' . $kegiatanId . '-' . Str::upper(Str::random(4));
    
        // Jika sudah ada laporan, redirect dengan pesan
        if ($existingLaporan) {
            return redirect()->route('laporan_kegiatan.index')->with('error', 'Kegiatan ini sudah memiliki laporan.');
        }
    
        // Jika belum ada laporan, lanjutkan untuk menyimpan laporan baru
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
                    'file_path'   => $path,
                    'file_type'   => $fileType,
                ]);
            }
        }
    
        return redirect()->route('laporan_kegiatan.index')->with('success', 'Laporan berhasil dikirim.');
    }

    
    /**
     * Display the specified resource.
     */
    public function show(LaporanKegiatan $laporanKegiatan): View
    {
        $laporanKegiatan->load(['dokumentasi', 'kegiatan.kategoriKegiatan']); // eager load
        return view('laporan_kegiatan.show', compact('laporanKegiatan'));
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LaporanKegiatan $laporanKegiatan): View
    {
        $kegiatan = DesaKegiatan::all();
        return view('laporan_kegiatan.edit', compact('laporanKegiatan', 'kegiatan'));
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, string $id): RedirectResponse
{
    $request->validate([
        'keterangan' => 'required|string|max:255',
        'hasil' => 'required|string|max:255',
        'tujuan_kegiatan' => 'required|string|max:255',
        'evaluasi' => 'required|string|max:255',
        'kegiatan_id' => 'required|exists:desa_kegiatans,id',
        'dokumentasi.*' => 'file|mimes:jpeg,png,jpg,mp4,mov,avi|max:10240', // max 10MB
    ]);

    $laporan = LaporanKegiatan::findOrFail($id);

    // Generate ulang kode_kegiatan saat update (opsional)
    $tanggal = Carbon::now()->format('Ymd');
    $kegiatanId = $request->kegiatan_id;
    $kodeKegiatan = $tanggal . '-KGT' . $kegiatanId . '-' . Str::upper(Str::random(4));

    $laporan->update([
        'kegiatan_id' => $kegiatanId,
        'keterangan' => $request->keterangan,
        'hasil' => $request->hasil,
        'tujuan_kegiatan' => $request->tujuan_kegiatan,
        'evaluasi' => $request->evaluasi,
        'user_id' => Auth::id(),
        'kode_kegiatan' => $kodeKegiatan, // Update kode_kegiatan
        'is_approved' => null, // Reset status approval
    ]);

    // Update dokumentasi jika ada file baru
    if ($request->hasFile('dokumentasi')) {
        // Hapus dokumentasi lama
        $laporan->dokumentasi()->delete();

        foreach ($request->file('dokumentasi') as $file) {
            $path = $file->store('dokumentasi', 'public');
            $mime = $file->getMimeType();
            $fileType = str_contains($mime, 'video') ? 'video' : 'image';

            $laporan->dokumentasi()->create([
                'laporan_id' => $laporan->id,
                'file_path' => $path,
                'file_type' => $fileType,
            ]);
        }
    }
    return redirect()->route('laporan_kegiatan.index')->with('primary', 'Laporan berhasil di update.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
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

    return redirect()->route('laporan_kegiatan.index')
                     ->with('danger', 'Laporan dan dokumentasinya berhasil dihapus.');
}

public function approve(LaporanKegiatan $laporanKegiatan): View
{
    return view('laporan_kegiatan.approve', compact('laporanKegiatan'));
}

/**
 * Memperbarui status approval laporan kegiatan.
 */
public function approveaction(Request $request, LaporanKegiatan $laporanKegiatan): RedirectResponse
{
    $request->validate([
        'is_approved' => 'nullable|boolean',
        'keterangan_tolak' => 'nullable|string'
    ]);

    $laporanKegiatan->update([
        'is_approved' => $request->is_approved,
        'keterangan_tolak' => $request->is_approved ? null : $request->keterangan_tolak
    ]);

    return redirect()->route('laporan_kegiatan.index')->with('success', 'Laporan berhasil diperbarui.');
}
public function cetak($id)
{
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

    $pdf = Pdf::loadView('laporan_kegiatan.pdf', compact('laporanKegiatan','nomorUrutFormatted', 'bulanRomawiFormatted', 'tahun'));
    return $pdf->stream('laporan-kegiatan-'.$laporanKegiatan->kegiatan->nama_kegiatan.'.pdf');
}
protected function getAddressFromCoordinates($lat, $lng)
{
    try {
        $url = "https://nominatim.openstreetmap.org/reverse?format=json&lat={$lat}&lon={$lng}&addressdetails=1";
        $opts = ['http' => ['header' => "User-Agent: laporan-kegiatan\r\n"]];
        $context = stream_context_create($opts);
        $response = file_get_contents($url, false, $context);
        $data = json_decode($response, true);

        return $data['display_name'] ?? '-';
    } catch (\Exception $e) {
        return '-';
    }
}

public function exportPdfPerTahun($tahun)
{
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

    $laporan = LaporanKegiatan::with('kegiatan')
    ->whereHas('kegiatan', fn ($q) => $q->whereYear('tanggal_mulai', $tahun))
    ->get();
    // Proses lokasi menjadi alamat
    foreach ($laporan as $item) {
        if ($item->kegiatan && $item->kegiatan->latitude && $item->kegiatan->longitude) {
            $item->kegiatan->lokasi_nama = $this->getAddressFromCoordinates(
                $item->kegiatan->latitude,
                $item->kegiatan->longitude
            );
        } else {
            $item->kegiatan->lokasi_nama = '-';
        }
    }

    $pdf = Pdf::loadView('laporan_kegiatan.report_pdf', compact('laporan','nomorUrutFormatted', 'bulanRomawiFormatted', 'tahun'));
    return $pdf->download("laporan_kegiatan_{$tahun}.pdf");
}
public function exportExcelPerTahun($tahun)
{
    $bulan = date('n'); // bulan sekarang
    $tahunSekarang = date('Y');

    // Hitung jumlah laporan di bulan dan tahun ini
    $count = LaporanKegiatan::whereMonth('created_at', $bulan)
                            ->whereYear('created_at', $tahunSekarang)
                            ->count();

    $nomorUrut = str_pad($count + 1, 2, '0', STR_PAD_LEFT);
    $bulanRomawi = ['I','II','III','IV','V','VI','VII','VIII','IX','X','XI','XII'];
    $bulanRomawiFormatted = $bulanRomawi[$bulan - 1];

    $laporan = LaporanKegiatan::with('kegiatan')
        ->whereHas('kegiatan', fn ($q) => $q->whereYear('tanggal_mulai', $tahun))
        ->get();

    return Excel::download(
        new LaporanKegiatanExport($laporan, $nomorUrut, $bulanRomawiFormatted, $tahun),
        "laporan_kegiatan_{$tahun}.xlsx"
    );
}
// public function exportExcelPerTahun($tahun)
// {
//     return Excel::download(new LaporanKegiatan($tahun), "laporan_kegiatan_{$tahun}.xlsx");
// }

}
