<?php
  
// use Illuminate\Container\Attributes\Auth;
use App\Http\Controllers\DesaKegiatanController;
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
   
Route::get('/', function () {
    return view('welcome');
});
  
Auth::routes();
  
Route::get('/home', [HomeController::class, 'index'])->name('home');
  
Route::group(['middleware' => ['auth', 'role:Admin']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('jalans', JalanController::class);
    Route::resource('proyek', PembangunanProyekController::class);
    Route::resource('kegiatan', DesaKegiatanController::class);
    Route::resource('kategori_kegiatan', KategoriKegiatanController::class);
    Route::resource('jenis_proyek', JenisProyekController::class);
    Route::post('/dokumentasi/store', [DokumentasiProyekController::class, 'store'])->name('dokumentasi.store');
    Route::post('/dokumentasi/store', [DokumentasiProyekController::class, 'store'])->name('dokumentasi.storeTambahan');
    Route::resource('laporan_proyek', LaporanProyekController::class);
    Route::get('laporan_proyek/{laporanProyek}/approve', [LaporanProyekController::class, 'approve'])->name('laporan_proyek.approve');
    Route::put('laporan_proyek/{laporanProyek}/approveaction', [LaporanProyekController::class, 'approveaction'])->name('laporan_proyek.approveaction');
    Route::post('laporan_proyek/storeTambahan', [LaporanProyekController::class, 'storeTambahan'])->name('laporan_proyek.storeTambahan');
    Route::delete('/dokumentasi/{id}', [DokumentasiProyekController::class, 'destroy'])->name('dokumentasi.destroy');
    Route::get('/profile', [UserController::class, 'profile'])->name('users.profile');
    Route::post('/profile/update-password', [UserController::class, 'updatePassword'])->name('users.updatePassword');
    Route::get('/laporan-proyek/{laporanProyek}/cetak', [LaporanProyekController::class, 'cetak'])->name('laporan_proyek.cetak');
});


Route::middleware(['auth', 'role:Pegawai'])->name('frontend.')->group(function () {
    Route::get('/frontend/dashboard', [PegawaiDashboardController::class, 'index'])->name('dashboard');
    Route::get('/frontend/kategori_kegiatan', [FrontController::class, 'kategoriIndex'])->name('kategori_kegiatan.index');
    Route::get('/frontend/kegiatan', [FrontController::class, 'kegiatanIndex'])->name('kegiatan.index');
    Route::get('/frontend/laporan-proyek', [FrontController::class, 'laporanIndex'])->name('laporan.index');

    // Tambahkan jika butuh buat data

    Route::get('/frontend/kategori_kegiatan/create', [FrontController::class, 'kategoriCreate'])->name('kategori_kegiatan.create');
    Route::post('/frontend/kategori_kegiatan/store', [FrontController::class, 'kategoriStore'])->name('kategori_kegiatan.store');

    // Route::get('/laporan-proyek/create', [FrontController::class, 'laporanCreate'])->name('laporan.create');
    // Route::post('/laporan-proyek/store', [FrontController::class, 'laporanStore'])->name('laporan.store');

});


