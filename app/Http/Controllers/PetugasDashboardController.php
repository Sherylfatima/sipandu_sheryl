<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\KategoriPengaduan;
use App\Models\Pengaduan; // Pastikan menggunakan model Pengaduan
use Illuminate\Http\Request;

class PetugasDashboardController extends Controller
{
    public function index()
    {
        // Mengambil jumlah masyarakat (role 'masyarakat')
        $jumlahMasyarakat = User::where('role', 'masyarakat')->count();
        
        // Mengambil jumlah kategori pengaduan
        $jumlahKategoriPengaduan = KategoriPengaduan::count();
        
        // Mengambil jumlah laporan pengaduan
        $jumlahLaporanPengaduan = Pengaduan::count();
        
        // Mengambil jumlah laporan baru (status = 'new')
        $jumlahLaporanBaru = Pengaduan::where('status', 'new')->count(); // Pastikan status 'new' sesuai dengan data Anda
        
        // Mengambil data pengaduan dengan relasi kategori
        $pengaduans = Pengaduan::with('kategoripengaduan') // Asumsikan ada relasi dengan kategori
            ->orderBy('created_at', 'desc')
            ->get();

        // Mengirim data ke view untuk petugas
        return view('pages.petugas.dashboard.index', [
            'title'                   => 'APM | Dashboard Petugas',
            'header'                  => 'Dashboard Petugas',
            'breadcrumb1'             => 'Dashboard',
            'breadcrumb2'             => 'Index',
            'jumlahMasyarakat'        => $jumlahMasyarakat,
            'jumlahKategoriPengaduan' => $jumlahKategoriPengaduan,
            'jumlahLaporanPengaduan'  => $jumlahLaporanPengaduan,
            'jumlahLaporanBaru'       => $jumlahLaporanBaru, // Mengirim jumlah laporan baru
            'pengaduans'              => $pengaduans,
        ]);
    }
}
