<?php

namespace App\Http\Controllers;

use App\Models\DesaKegiatan;
use App\Models\LaporanProyek;
use App\Models\PembangunanProyek;
use Illuminate\Http\Request;

class PegawaiDashboardController extends Controller
{
    /**
     * PegawaiDashboardController constructor.
     * Terapkan middleware untuk memastikan hanya pegawai yang bisa mengakses.
     */
    public function __construct()
    {
        $this->middleware(['auth', 'role:Pegawai']);
    }

    /**
     * Tampilkan halaman dashboard pegawai.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $laporan = LaporanProyek::with('progresTerbaru')->get();

$persentase30 = $laporan->filter(fn ($item) => $item->progresTerbaru?->persentase == 30)->count();
$persentase50 = $laporan->filter(fn ($item) => $item->progresTerbaru?->persentase == 50)->count();
$persentase80 = $laporan->filter(fn ($item) => $item->progresTerbaru?->persentase == 80)->count();
$persentase100 = $laporan->filter(fn ($item) => $item->progresTerbaru?->persentase == 100)->count();

return view('frontend.index', [
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
]);
    }
}
