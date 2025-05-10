<?php

namespace App\Http\Controllers;

use App\Models\DesaKegiatan;
use App\Models\DokumentasiProyek;
use App\Models\PembangunanProyek;
use App\Models\LaporanProyek;
use App\Models\Kegiatan;
use App\Models\LaporanKegiatan;
use App\Models\ProgresPembangunan;
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
        $this->middleware(['auth', 'role:Admin']);
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

// $proyek = PembangunanProyek::with(['laporanProyek.progresTerbaru'])->get();

// $anggaranPerTahun = [];
// $sisaAnggaranPerTahun = [];

// foreach ($proyek as $item) {
//     $tahun = \Carbon\Carbon::parse($item->tanggal_mulai)->format('Y');
//     $anggaran = $item->anggaran;
//     $persentase = optional($item->laporanProyek->progresTerbaru)->persentase ?? 0;

//     // Hitung total anggaran per tahun
//     if (!isset($anggaranPerTahun[$tahun])) $anggaranPerTahun[$tahun] = 0;
//     $anggaranPerTahun[$tahun] += $anggaran;

//     // Hitung sisa anggaran berdasarkan progres
//     if (!isset($sisaAnggaranPerTahun[$tahun])) $sisaAnggaranPerTahun[$tahun] = 0;
//     $sisaAnggaranPerTahun[$tahun] += $anggaran - ($anggaran * $persentase / 100);
// }
return view('home', [
    'jumlahProyek' => PembangunanProyek::count(),
    'jumlahLaporanProyek' => LaporanProyek::count(),
    'jumlahKegiatan' => DesaKegiatan::count(),
    // 'jumlahLaporanKegiatan' => LaporanKegiatan::count(),

    'laporanDisetujui' => LaporanProyek::where('is_approved', 'setuju')->count(),
    'laporanDitolak' => LaporanProyek::where('is_approved', 'tidak_setuju')->count(),

    'proyekPerencanaan' => PembangunanProyek::where('status', 'perencanaan')->count(),
    'proyekBerjalan' => PembangunanProyek::where('status', 'berjalan')->count(),
    'proyekSelesai' => PembangunanProyek::where('status', 'selesai')->count(),

    'persentase30' => $persentase30,
    'persentase50' => $persentase50,
    'persentase80' => $persentase80,
    'persentase100' => $persentase100,

    // 'anggaranPerTahun' => $anggaranPerTahun,
    // 'sisaAnggaranPerTahun' => $sisaAnggaranPerTahun,
]);
    }
}
