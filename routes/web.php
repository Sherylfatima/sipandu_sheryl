<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardMasyarakatController;
use App\Http\Controllers\DashboardPetugasController;
use App\Http\Controllers\KategoriPengaduanController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\MasyarakatController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// login register
Route::middleware(['guest'])->group(function () {
    Route::get('/', [DashboardMasyarakatController::class, 'index']);
    Route::get('/register', [AuthController::class, 'register']);
    Route::post('/store/register', [AuthController::class, 'storeregister']);
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/store/login', [AuthController::class, 'storelogin']);
});



Route::middleware(['auth'])->group(function(){
    
    
    // dashboard masyarakat
    Route::get('/dashboard_masyarakat',[MasyarakatController::class,'dashboard']);
    // dashboard admin
    Route::get('/dashboard',[DashboardController::class,'index']);

    // pegawai
    Route::get('/dashboardpetugas', [DashboardPetugasController::class, 'index']);
    Route::get('/pegawai', [PegawaiController::class, 'index']);
    Route::get('/tambah_pegawai', [PegawaiController::class, 'create']);
    Route::post('/store/pegawai', [PegawaiController::class, 'store']);
    Route::get('/edit_pegawai/{id}', [PegawaiController::class, 'edit'])->name('pegawai.edit');
    Route::post('/update/pegawai/{id}', [PegawaiController::class, 'update']);
    Route::delete('/destroy_petugas/{id}', [PegawaiController::class, 'destroy'])->name('pegawai.destroy');
    


    // pengaduan /laporan

    

    // masyarakat
    Route::get('/masyarakat',[MasyarakatController::class,'index']);
    Route::get('/tambah_masyarakat',[MasyarakatController::class,'create']);
    Route::post('/store/masyarakat',[MasyarakatController::class,'store']);
    Route::get('/edit_masyarakat/{id}',[MasyarakatController::class,'edit']);
    Route::post('/update_masyarakat/{id}', [MasyarakatController::class, 'update']);
    Route::get('tanggapan_admin',[MasyarakatController::class,'data_pengaduan']);
    Route::delete('/destroy_masyarakat/{id}', [MasyarakatController::class, 'destroy'])->name('masyarakat.destroy');
    Route::get('pengaduanku',[MasyarakatController::class,'data_tanggapan']);



    // kategori
    Route::get('/kategori',[KategoriPengaduanController::class,'index']);
    Route::get('/tambah_kategori',[KategoriPengaduanController::class,'create']);
    Route::post('/store/kategori',[KategoriPengaduanController::class,'store']);
    Route::get('/edit_kategori/{id}',[KategoriPengaduanController::class,'edit']);
    Route::post('/update_kategori/{id}',[KategoriPengaduanController::class,'update']);
    Route::delete('/destroy_kategori/{id}', [KategoriPengaduanController::class, 'destroy'])->name('kategori.destroy');
    // profile
    Route::get('/profile',[DashboardController::class,'profil']);

    
    // pengaduan
    Route::get('/pengaduan',[PengaduanController::class,'index']) ->name('pengaduan');
    Route::get('/tambah_pengaduan',[PengaduanController::class,'tambah']);
    Route::post('/store/pengaduan', [PengaduanController::class,'store']);
    Route::get('/edit_pengaduan/{id}',[PengaduanController::class,'edit']);
    Route::post('/update/pengaduan/{id}',[PengaduanController::class,'update']);
    Route::delete('/destroy_pengaduan/{id}', [PengaduanController::class, 'destroy'])->name('destroy_pengaduan');


    Route::get('tanggapan', [PengaduanController::class, 'tanggapan'])->name('tanggapan.index');
    Route::get('/tambah_tanggapan/{id}', [PengaduanController::class, 'createtanggapan']);
    Route::post('/update_tanggapan/{id}', [PengaduanController::class, 'updateTanggapan']);
    Route::post('/update/data_pengaduan/{id}', [PengaduanController::class, 'update']);
    Route::get('/edit_tanggapan/{id}', [PengaduanController::class, 'editing']);
    Route::delete('/destroy_tanggapan/{id}', [PengaduanController::class, 'deleteTanggapan'])->name('tanggapan.destroy');
   

    
    Route::get('/generate',[PengaduanController::class,'report'])->name('pengaduan.laporan');
    Route::get('/formulir_laporan/{id}', [PengaduanController::class, 'formulir']);
    
    Route::get('/indexx',function(){
        return view('index');
    });


    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    
});