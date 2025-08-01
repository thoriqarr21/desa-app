<?php
  
// use Illuminate\Container\Attributes\Auth;
use App\Http\Controllers\Auth\ForgotPasswordController;
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
    return view('auth.login');
});
  
Auth::routes();
  
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/forgot-password-username', [ForgotPasswordController::class, 'showUsernameForm'])->name('password.username.form');
Route::put('/forgot-password-username', [ForgotPasswordController::class, 'checkUsername'])->name('password.username.check');

// Halaman ubah password setelah username benar
Route::get('/reset-password/{username}', [ForgotPasswordController::class, 'showChangeForm'])->name('password.reset.form');
Route::put('/reset-password/{username}', [ForgotPasswordController::class, 'updatePassword'])->name('password.update');

  
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
    Route::get('/laporan_kegiatan/export-excel/{tahun}', [LaporanKegiatanController::class, 'exportExcelPerTahun'])->name('laporan_kegiatan.exportExcelPerTahun');
    
    Route::resource('laporan_proyek', LaporanProyekController::class);
    Route::post('/dokumentasi/update-by-progress', [LaporanProyekController::class, 'updateTambahanBerdasarkanPersen'])->name('dokumentasi.update_by_progress');
    Route::delete('/dokumentasi/hapus-by-persen', [DokumentasiProyekController::class, 'destroyTambahanBerdasarkanPersen'])->name('dokumentasi.destroy_by_progress');
    Route::get('laporan_proyek/{laporanProyek}/approve', [LaporanProyekController::class, 'approve'])->name('laporan_proyek.approve');
    Route::put('laporan_proyek/{laporanProyek}/approveaction', [LaporanProyekController::class, 'approveaction'])->name('laporan_proyek.approveaction');
    Route::post('laporan_proyek/storeTambahan', [LaporanProyekController::class, 'storeTambahan'])->name('laporan_proyek.storeTambahan');
    Route::delete('/dokumentasi/{id}', [DokumentasiProyekController::class, 'destroy'])->name('dokumentasi.destroy');
    Route::get('/profile', [UserController::class, 'profile'])->name('users.profile');
    Route::post('/profile/update-password', [UserController::class, 'updatePassword'])->name('users.updatePassword');
    Route::get('/laporan-proyek/{laporanProyek}/cetak', [LaporanProyekController::class, 'cetak'])->name('laporan_proyek.cetak');
    Route::get('/laporan-kegiatan/{laporanKegiatan}/cetak', [LaporanKegiatanController::class, 'cetak'])->name('laporan_kegiatan.cetak');
    Route::get('laporan_proyek/export-excel/{tahun}', [LaporanProyekController::class, 'exportExcelPerTahun']);
    Route::get('laporan-kegiatan/pdf/{tahun}', [LaporanKegiatanController::class, 'exportPdfPerTahun'])->name('laporan_kegiatan.export.pdf');
    Route::get('laporan-proyek/pdf/{tahun}', [LaporanProyekController::class, 'exportPdfPerTahun'])->name('laporan_proyek.export.pdf');
    Route::put('/profile/update', [UserController::class, 'updateProfile'])->name('updateProfile');

});


Route::middleware(['auth', 'role:Pegawai'])->name('frontend.')->group(function () {
    Route::get('/frontend/index', [PegawaiDashboardController::class, 'index'])->name('index');

    Route::get('/frontend/proyek/index', [FrontController::class, 'proyekIndex'])->name('proyek.index');
    Route::get('/frontend/proyek/{proyek}', [FrontController::class, 'proyekShow'])->name('proyek.show');
    Route::get('/frontend/laporan_proyek', [FrontController::class, 'laporanIndex'])->name('laporan_proyek.index');
    Route::get('/frontend/laporan_proyek/create', [FrontController::class, 'laporanCreate'])->name('laporan_proyek.create');
    Route::post('/frontend/laporan_proyek', [FrontController::class, 'laporanStore'])->name('laporan_proyek.store');
    Route::get('/frontend/laporan_proyek/{laporanProyek}', [FrontController::class, 'laporanShow'])->name('laporan_proyek.show');
    Route::get('/frontend/laporan_proyek/{laporanProyek}/edit', [FrontController::class, 'laporanEdit'])->name('laporan_proyek.edit');
    Route::put('/frontend/laporan_proyek/{laporanProyek}', [FrontController::class, 'laporanUpdate'])->name('laporan_proyek.update');
    Route::delete('/frontend/laporan_proyek/{id}', [FrontController::class, 'laporanDestroy'])->name('laporan_proyek.destroy');
    Route::post('frontend.laporan_proyek/storeTambahan', [LaporanProyekController::class, 'storeTambahan'])->name('laporan_proyek.storeTambahan');
    Route::get('/frontend/laporan_proyek/{id}/cetak', [FrontController::class, 'cetakProyek'])->name('laporan_proyek.cetak');
    Route::post('/frontend/dokumentasi/update-by-progress', [FrontController::class, 'updateTambahanBerdasarkanPersen'])->name('dokumentasi.update_by_progress');
    Route::delete('/frontend/dokumentasi/hapus-by-persen', [DokumentasiProyekController::class, 'destroyTambahanBerdasarkanPersen'])->name('dokumentasi.destroy_by_progress');
    /// Space ///
    Route::get('/frontend/kegiatan/index', [FrontController::class, 'kegiatanIndex'])->name('kegiatan.index');
    Route::get('/frontend/kegiatan/{kegiatan}', [FrontController::class, 'kegiatanShow'])->name('kegiatan.show');
    Route::get('/frontend/laporan_kegiatan', [FrontController::class, 'indexLaporanKegiatan'])->name('laporan_kegiatan.index');
    Route::get('/frontend/laporan_kegiatan/create', [FrontController::class, 'createLaporanKegiatan'])->name('laporan_kegiatan.create');
    Route::post('/frontend/laporan_kegiatan', [FrontController::class, 'storeLaporanKegiatan'])->name('laporan_kegiatan.store');
    Route::get('/frontend/laporan_kegiatan/{laporanKegiatan}', [FrontController::class, 'showLaporanKegiatan'])->name('laporan_kegiatan.show');
    Route::get('/frontend/laporan_kegiatan/{laporanKegiatan}/edit', [FrontController::class, 'editLaporanKegiatan'])->name('laporan_kegiatan.edit');
    Route::put('/frontend/laporan_kegiatan/{laporanKegiatan}', [FrontController::class, 'updateLaporanKegiatan'])->name('laporan_kegiatan.update');
    Route::delete('/frontend/laporan_kegiatan/{id}', [FrontController::class, 'destroyLaporanKegiatan'])->name('laporan_kegiatan.destroy');
    Route::get('/frontend/laporan_kegiatan/{id}/cetak', [FrontController::class, 'cetakKegiatan'])->name('laporan_kegiatan.cetak');
    // --------------- //
    Route::get('/frontend/profile', [FrontController::class, 'profile'])->name('profile');
    Route::post('/frontend/profile/update-password', [FrontController::class, 'updatePassword'])->name('updatePassword');
    Route::put('/frontend/profile/update', [FrontController::class, 'updateProfile'])->name('updateProfile');

});


