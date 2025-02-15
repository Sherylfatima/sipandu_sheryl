<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginAdminController;
use App\Http\Controllers\MasyarakatController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\LaporanMasukController;
use App\Http\Controllers\LoginPetugasController;
use App\Http\Controllers\GenerateReportController;
use App\Http\Controllers\LoginMasyarakatController;
use App\Http\Controllers\UserPengaduankuController;
use App\Http\Controllers\PetugasDashboardController;
use App\Http\Controllers\KategoriPengaduanController;
use App\Http\Controllers\RegisterMasyarakatController;

/*
|-------------------------------------------------------------------------- 
| Web Routes 
|-------------------------------------------------------------------------- 
| 
| Here is where you can register web routes for your application. These 
| routes are loaded by the RouteServiceProvider and all of them will 
| be assigned to the "web" middleware group. Make something great! 
|
*/

Route::get('/', function () {
    return view('pages.users.index');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
Route::resource('/masyarakat', MasyarakatController::class);
Route::get('/masyarakat/{id}/edit', [MasyarakatController::class, 'edit'])->name('masyarakat.edit');
Route::put('/masyarakat/{id}', [MasyarakatController::class, 'update'])->name('masyarakat.update');
Route::delete('/masyarakat/{id}', [MasyarakatController::class, 'destroy'])->name('masyarakat.destroy');

// Routes for Pegawai (Similar to profile)
Route::prefix('pegawai')->middleware('auth')->group(function () {
    Route::get('/', [PegawaiController::class, 'index'])->name('pegawai.index');
    Route::get('/create', [PegawaiController::class, 'create'])->name('pegawai.create');
    Route::post('/', [PegawaiController::class, 'store'])->name('pegawai.store');  // Menambahkan route store
    Route::get('/{id}', [PegawaiController::class, 'show'])->name('pegawai.show');
    Route::get('/edit/{id}', [PegawaiController::class, 'edit'])->name('pegawai.edit');
    Route::put('/update/{id}', [PegawaiController::class, 'update'])->name('pegawai.update');
    Route::delete('/destroy/{id}', [PegawaiController::class, 'destroy'])->name('pegawai.destroy'); // Menambahkan route destroy
});

// Routes for kategori pengaduan
Route::resource('/kategori', KategoriPengaduanController::class);

// Routes for laporan masuk
Route::get('/laporanmasuk', [LaporanMasukController::class, 'index'])->name('laporanmasuk');
Route::get('/laporanmasuk/detail/{id}', [LaporanMasukController::class, 'detail'])->name('laporanmasuk.detail');
Route::put('/laporanmasuk/{id}', [LaporanMasukController::class, 'updateStatus'])->name('laporanmasuk.updateStatus');

// Routes for generate report
Route::get('/generatereport', [GenerateReportController::class, 'index']);
Route::get('/generatereport/periode', [GenerateReportController::class, 'periode']);
Route::get('/generatereport/rekap', [GenerateReportController::class, 'rekap']);

// Routes for profile
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('admin.profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::put('/profile/update/{id}', [ProfileController::class, 'update'])->name('admin.profile.update');
    Route::put('/profile/update-password/{id}', [ProfileController::class, 'updatePassword'])->name('admin.profile.updatePassword');
});

// Login Admin Routes
Route::get('/loginadmin', [LoginAdminController::class, 'index'])->name('loginadmin');
Route::post('/authadmin', [LoginAdminController::class, 'authadmin']);
Route::post('/logoutadmin', [LoginAdminController::class, 'logout'])->name('logoutadmin');

// Routes untuk Login Masyarakat
Route::get('/loginmasyarakat', [LoginMasyarakatController::class, 'index'])->name('loginmasyarakat');
Route::post('/authmasyarakat', [LoginMasyarakatController::class, 'authmasyarakat']);
Route::post('/logoutmasyarakat', [LoginMasyarakatController::class, 'logout'])->name('logoutmasyarakat');
Route::middleware('auth')->get('/pengaduanku', [UserPengaduankuController::class, 'index'])->name('pengaduanku.index');
Route::get('/registermasyarakat', [RegisterMasyarakatController::class, 'showRegisterForm'])->name('registermasyarakat');
Route::post('/registermasyarakat', [RegisterMasyarakatController::class, 'register'])->name('masyarakat.register');

// Rute untuk halaman profil
Route::middleware('auth')->get('/profile', [UserProfileController::class, 'index'])->name('profile.index');
Route::middleware('auth')->post('/profile/update', [UserProfileController::class, 'update'])->name('update.profile');
Route::middleware('auth')->post('/password/update', [UserProfileController::class, 'updatePassword'])->name('update.password');

// Routes for Pengaduanku resource and profile for masyarakat
Route::middleware('auth')->group(function () {
    Route::resource('/pengaduanku', UserPengaduankuController::class);
    Route::get('/pengaduanku/create', [UserPengaduankuController::class, 'create'])->name('pengaduanku.create');
    Route::post('/pengaduanku', [UserPengaduankuController::class, 'store'])->name('pengaduanku.store');
});

// DataTable for Laporan
Route::any('/dataTableLaporan', [LaporanMasukController::class, 'getDataLaporan']);

// Petugas login routes
Route::get('/loginpetugas', [LoginPetugasController::class, 'showLoginForm'])->name('loginpetugas');
Route::post('/loginpetugas', [LoginPetugasController::class, 'authpetugas']);
Route::post('/logoutpetugas', [LoginPetugasController::class, 'logout'])->name('logoutpetugas');
Route::get('/dashboardpetugas', [PetugasDashboardController::class, 'index'])
    ->name('dashboardpetugas')
    ->middleware('auth');
// Routes for laporan masuk
Route::get('/laporanmasukpetugas', [LaporanMasukController::class, 'indexPetugas'])->name('laporanmasukpetugas');
Route::get('/laporanmasukpetugas/detail/{id}', [LaporanMasukController::class, 'detailpetugas'])->name('laporanmasukpetugas.detailpetugas');
Route::put('/laporanmasukpetugas/{id}', [LaporanMasukController::class, 'updateStatusPetugas'])->name('laporanmasukpetugas.updateStatusPetugas');


Route::prefix('petugas')->middleware('auth')->group(function () {
    Route::get('/profilepetugas', [ProfileController::class, 'indexpetugas'])->name('petugas.profile.indexpetugas');
    Route::get('/profilepetugas/edit', [ProfileController::class, 'editpetugas'])->name('petugas.profile.editpetugas');
    Route::put('/profilepetugas/update/{id}', [ProfileController::class, 'updatepetugas'])->name('petugas.profile.updatepetugas');
    Route::put('/profilepetugas/update-password/{id}', [ProfileController::class, 'updatePasswordPetugas'])->name('petugas.profile.updatePasswordPetugas');
});
