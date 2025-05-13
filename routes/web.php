<?php
  
// use Illuminate\Container\Attributes\Auth;
use App\Http\Controllers\DesaKegiatanController;
use App\Http\Controllers\DokumentasiKegiatanController;
use App\Http\Controllers\DokumentasiProyekController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\JenisProyekController;
use App\Http\Controllers\KategoriKegiatanController;
use App\Http\Controllers\LaporanProyekController;
use App\Http\Controllers\PegawaiDashboardController;
use App\Http\Controllers\PembangunanProyekController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

  
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JalanController;
use App\Http\Controllers\LaporanKegiatanController;

Route::get('/', function () {
    return view('welcome');
});
  
Auth::routes();
  
Route::get('/home', [HomeController::class, 'index'])->name('home');
  
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('jalans', JalanController::class);
    Route::resource('proyek', PembangunanProyekController::class);
    Route::resource('kegiatan', DesaKegiatanController::class);
    Route::resource('kategori_kegiatan', KategoriKegiatanController::class);
    // Route::resource('jenis_proyek', JenisProyekController::class);
    Route::post('/dokumentasi/store', [DokumentasiKegiatanController::class, 'store'])->name('dokumentasi.store');
    Route::post('/dokumentasi/store', [DokumentasiProyekController::class, 'store'])->name('dokumentasi.store');
    Route::post('/dokumentasi/store', [DokumentasiProyekController::class, 'store'])->name('dokumentasi.storeTambahan');
    Route::resource('laporan_kegiatan', LaporanKegiatanController::class);
    Route::get('laporan_kegiatan/{laporanKegiatan}/approve', [LaporanKegiatanController::class, 'approve'])->name('laporan_kegiatan.approve');
    Route::put('laporan_kegiatan/{laporanKegiatan}/approveaction', [LaporanKegiatanController::class, 'approveaction'])->name('laporan_kegiatan.approveaction');
    
    Route::resource('laporan_proyek', LaporanProyekController::class);
    Route::get('laporan_proyek/{laporanProyek}/approve', [LaporanProyekController::class, 'approve'])->name('laporan_proyek.approve');
    Route::put('laporan_proyek/{laporanProyek}/approveaction', [LaporanProyekController::class, 'approveaction'])->name('laporan_proyek.approveaction');
    Route::post('laporan_proyek/storeTambahan', [LaporanProyekController::class, 'storeTambahan'])->name('laporan_proyek.storeTambahan');
    Route::delete('/dokumentasi/{id}', [DokumentasiProyekController::class, 'destroy'])->name('dokumentasi.destroy');
    Route::delete('/dokumentasi/{id}', [DokumentasiKegiatanController::class, 'destroy'])->name('dokumentasi.destroy');
    Route::get('/profile', [UserController::class, 'profile'])->name('users.profile');
    Route::post('/profile/update-password', [UserController::class, 'updatePassword'])->name('users.updatePassword');
    Route::get('/laporan-proyek/{laporanProyek}/cetak', [LaporanProyekController::class, 'cetak'])->name('laporan_proyek.cetak');
    Route::get('/laporan-kegiatan/{laporanKegiatan}/cetak', [LaporanKegiatanController::class, 'cetak'])->name('laporan_kegiatan.cetak');
});


Route::middleware(['auth', 'role:Pegawai'])->name('frontend.')->group(function () {
    Route::get('/frontend/index', [PegawaiDashboardController::class, 'index'])->name('index');
    Route::get('/frontend/laporan_proyek', [FrontController::class, 'laporanIndex'])->name('laporan_proyek.index');
    Route::get('/frontend/laporan_proyek/create', [FrontController::class, 'laporanCreate'])->name('laporan_proyek.create');
    Route::post('/frontend/laporan_proyek', [FrontController::class, 'laporanStore'])->name('laporan_proyek.store');
    Route::get('/frontend/laporan_proyek/{laporanProyek}', [FrontController::class, 'laporanShow'])->name('laporan_proyek.show');
    Route::get('/frontend/laporan_proyek/{laporanProyek}/edit', [FrontController::class, 'laporanEdit'])->name('laporan_proyek.edit');
    Route::put('/frontend/laporan_proyek/{laporanProyek}', [FrontController::class, 'laporanUpdate'])->name('laporan_proyek.update');
    Route::delete('/frontend/laporan_proyek/{id}', [FrontController::class, 'laporanDestroy'])->name('laporan_proyek.destroy');
    Route::post('frontend.laporan_proyek/storeTambahan', [LaporanProyekController::class, 'storeTambahan'])->name('laporan_proyek.storeTambahan');
    Route::get('/frontend/laporan_proyek/{id}/cetak', [FrontController::class, 'cetakProyek'])->name('laporan_proyek.cetak');

    Route::get('/frontend/laporan_kegiatan', [FrontController::class, 'indexLaporanKegiatan'])->name('laporan_kegiatan.index');
    Route::get('/frontend/laporan_kegiatan/create', [FrontController::class, 'createLaporanKegiatan'])->name('laporan_kegiatan.create');
    Route::post('/frontend/laporan_kegiatan', [FrontController::class, 'storeLaporanKegiatan'])->name('laporan_kegiatan.store');
    Route::get('/frontend/laporan_kegiatan/{laporanKegiatan}', [FrontController::class, 'showLaporanKegiatan'])->name('laporan_kegiatan.show');
    Route::get('/frontend/laporan_kegiatan/{laporanKegiatan}/edit', [FrontController::class, 'editLaporanKegiatan'])->name('laporan_kegiatan.edit');
    Route::put('/frontend/laporan_kegiatan/{laporanKegiatan}', [FrontController::class, 'updateLaporanKegiatan'])->name('laporan_kegiatan.update');
    Route::delete('/frontend/laporan_kegiatan/{id}', [FrontController::class, 'destroyLaporanKegiatan'])->name('laporan_kegiatan.destroy');
    Route::get('/frontend/laporan_kegiatan/{id}/cetak', [FrontController::class, 'cetakKegiatan'])->name('laporan_kegiatan.cetak');
});


