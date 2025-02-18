<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use App\Models\Kategori;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use App\Models\KategoriPengaduan;

class DashboardController extends Controller
{
    public function index()
{
    $jumlahMasyarakat = User::where('role', 'masyarakat')->count();
    $jumlahKategori = KategoriPengaduan::count();
    $jumlahLaporan = Pengaduan::count();
    $jumlahLaporanBaru = Pengaduan::where('status', '0')->count();
    $jumlahLaporanSelesai = Pengaduan::where('status', 'selesai')->count();

    // Ambil data pengaduan dengan pagination
    $pengaduans = Pengaduan::paginate(3);

    return view('pages.admin.dashboard.index', compact('jumlahMasyarakat', 'jumlahKategori', 'jumlahLaporan', 'jumlahLaporanBaru', 'jumlahLaporanSelesai', 'pengaduans'));
}


public function profil(){
    $profiles = User::all();
    return view('pages.admin.profile.index',compact('profiles'));
}

}
