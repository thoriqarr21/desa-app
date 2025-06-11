<?php

namespace App\Http\Controllers;

use App\Models\DesaKegiatan;
use App\Models\DokumentasiProyek;
use App\Models\PembangunanProyek;
use App\Models\LaporanProyek;
use App\Models\Kegiatan;
use App\Models\LaporanKegiatan;
use App\Models\ProgresPembangunan;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('role:Admin|Kades');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $laporan = LaporanProyek::with('progresTerbaru')->get();

$persentase30 = $laporan->filter(fn ($item) => $item->progresTerbaru?->persentase == 30)->count();
$persentase50 = $laporan->filter(fn ($item) => $item->progresTerbaru?->persentase == 50)->count();
$persentase80 = $laporan->filter(fn ($item) => $item->progresTerbaru?->persentase == 80)->count();
$persentase100 = $laporan->filter(fn ($item) => $item->progresTerbaru?->persentase == 100)->count();

$kegiatan = DesaKegiatan::selectRaw('YEAR(tanggal_mulai) as tahun, COUNT(*) as jumlah')
    ->groupBy(DB::raw('YEAR(tanggal_mulai)'))
    ->orderBy('tahun', 'asc')
    ->get();

    
    $dataKegiatan = DesaKegiatan::select('nama_kegiatan', 'tanggal_mulai', 'tanggal_selesai', 'lokasi')
    ->get()
    ->map(function($item) {
        $item->tanggal_mulai = \Carbon\Carbon::parse($item->tanggal_mulai)->format('Y-m-d');
        $item->tanggal_selesai = \Carbon\Carbon::parse($item->tanggal_selesai)->format('Y-m-d');
        return $item;
    });
$rasioDisetujui = LaporanKegiatan::where('is_approved', true)->count();
$rasioDitolak = LaporanKegiatan::where('is_approved', false)->count();
$rasioPending = LaporanKegiatan::whereNull('is_approved')->count();

    $lokasiKegiatan = DesaKegiatan::select('nama_kegiatan as nama', 'lokasi')->get();
    $lokasiProyek = PembangunanProyek::select('nama_proyek as nama', 'lokasi')->get();
    
    // Gabungkan menjadi satu koleksi
    $lokasiGabungan = $lokasiKegiatan->concat($lokasiProyek);
    $dataProyek = PembangunanProyek::select('nama_proyek', 'tanggal_mulai', 'tanggal_selesai', 'lokasi')
    ->get()
    ->map(function ($item) {
        $item->tanggal_mulai = \Carbon\Carbon::parse($item->tanggal_mulai)->format('Y-m-d');
        $item->tanggal_selesai = \Carbon\Carbon::parse($item->tanggal_selesai)->format('Y-m-d');
        return $item;
    });

return view('home', [
    'jumlahProyek' => PembangunanProyek::count(),
    'jumlahLaporanProyek' => LaporanProyek::count(),
    'jumlahLaporanKegiatan' => LaporanKegiatan::count(),
    'jumlahKegiatan' => DesaKegiatan::count(),
    // 'jumlahLaporanKegiatan' => LaporanKegiatan::count(),

    'laporanDisetujui' => LaporanProyek::where('is_approved', 'setuju')->count(),
    'laporanDitolak' => LaporanProyek::where('is_approved', 'tidak_setuju')->count(),
    'laporanDipending' => LaporanProyek::where('is_approved', 'pending')->count(),

    'proyekPerencanaan' => PembangunanProyek::where('status', 'perencanaan')->count(),
    'proyekBerjalan' => PembangunanProyek::where('status', 'berjalan')->count(),
    'proyekSelesai' => PembangunanProyek::where('status', 'selesai')->count(),

    'persentase30' => $persentase30,
    'persentase50' => $persentase50,
    'persentase80' => $persentase80,
    'persentase100' => $persentase100,

    'kegiatan' => $kegiatan,

    'dataKegiatan' => $dataKegiatan,
    'dataProyek' => $dataProyek,
        'rasioDisetujui' => $rasioDisetujui,
        'rasioDitolak' => $rasioDitolak,
        'rasioPending' => $rasioPending, 
        'lokasiGabungan' => $lokasiGabungan,

]);

    }

    
}
