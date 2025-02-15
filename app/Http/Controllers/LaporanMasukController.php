<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use App\Models\KategoriPengaduan;
use Illuminate\Support\Facades\DB;

class LaporanMasukController extends Controller
{
    public function index()
    {
        $kategoriPengaduan = KategoriPengaduan::all();

        return view('pages.admin.laporanmasuk.index', [
            'title'     => 'APM | Laporan Masuk',
            'header'        => 'Laporan Masuk',
            'breadcrumb1'   => 'Laporan Masuk',
            'breadcrumb2'   => 'Index',
            'kategoriPengaduan' => $kategoriPengaduan
        ]);
    }
    public function indexPetugas()
    {
        $kategoriPengaduan = KategoriPengaduan::all();

        return view('pages.petugas.laporanmasuk.index', [
            'title'     => 'APM | Laporan Masuk',
            'header'        => 'Laporan Masuk',
            'breadcrumb1'   => 'Laporan Masuk',
            'breadcrumb2'   => 'Index',
            'kategoriPengaduan' => $kategoriPengaduan
        ]);
    }
    public function detail($id)
    {
        $laporan = Pengaduan::find($id);
        // Mengambil data laporan berdasarkan ID dan memastikan hanya yang memiliki 'role' masyarakat
        $laporan = Pengaduan::with('user') // Memuat relasi user
            ->whereHas('user', function ($query) {
                $query->where('role', 'masyarakat'); // Filter berdasarkan role masyarakat
            })
            ->find($id); // Ambil berdasarkan ID

        if (!$laporan) {
            return redirect()->route('laporanmasuk')->with('error', 'Laporan tidak ditemukan');
        }
        $laporan->tanggalpengaduan = Carbon::parse($laporan->tanggalpengaduan);

        // Kirim data laporan ke view
        return view('pages.admin.laporanmasuk.detail', [
            'laporan' => $laporan,
            'title' => 'Detail Laporan Masuk',
            'header' => 'Laporan Masuk',
            'breadcrumb1' => 'Laporan Masuk',
            'breadcrumb2' => 'Detail',
        ]);
    }
    public function detailpetugas($id)
    {
        $laporan = Pengaduan::find($id);
        // Mengambil data laporan berdasarkan ID dan memastikan hanya yang memiliki 'role' masyarakat
        $laporan = Pengaduan::with('user') // Memuat relasi user
            ->whereHas('user', function ($query) {
                $query->where('role', 'masyarakat'); // Filter berdasarkan role masyarakat
            })
            ->find($id); // Ambil berdasarkan ID

        if (!$laporan) {
            return redirect()->route('laporanmasuk')->with('error', 'Laporan tidak ditemukan');
        }
        $laporan->tanggalpengaduan = Carbon::parse($laporan->tanggalpengaduan);

        // Kirim data laporan ke view
        return view('pages.petugas.laporanmasuk.detail', [
            'laporan' => $laporan,
            'title' => 'Detail Laporan Masuk',
            'header' => 'Laporan Masuk',
            'breadcrumb1' => 'Laporan Masuk',
            'breadcrumb2' => 'Detail',
        ]);
    }
    public function getDataLaporan(Request $request)
    {
        $orderBy = 'pengaduan.id';
        switch ($request->input('order.0.column')) {
            case '0':
                $orderBy = 'pengaduan.tanggalpengaduan';
                break;
            case '1':
                $orderBy = 'pengaduan.judul';
                break;
            case '2':
                $orderBy = 'users.name';
                break;
            case '3':
                $orderBy = 'kategoripengaduan.namakategori';
                break;
            case '4':
                $orderBy = 'pengaduan.status';
                break;
        }

        // Ambil data laporan dengan filter berdasarkan status dan kategori
        $data = DB::table('pengaduan')
            ->leftJoin('users', 'pengaduan.masyarakat_id', '=', 'users.id')
            ->leftJoin('kategoripengaduan', 'pengaduan.kategori_id', '=', 'kategoripengaduan.id')
            ->select('pengaduan.*', 'users.name', 'kategoripengaduan.namakategori');

        // Filter berdasarkan status jika ada
        if ($request->has('status') && $request->input('status') != '') {
            $data = $data->where('pengaduan.status', $request->input('status'));
        }

        // Filter berdasarkan kategori jika ada
        if ($request->has('kategori_id') && $request->input('kategori_id') != '') {
            $data = $data->where('pengaduan.kategori_id', $request->input('kategori_id'));
        }

        // Filter berdasarkan pencarian jika ada
        if ($request->input('search.value') != null) {
            $data = $data->where(function ($q) use ($request) {
                $q->whereRaw('LOWER(pengaduan.judul) like ?', ['%' . $request->input('search.value') . '%'])
                    ->orWhereRaw('LOWER(users.name) like ?', ['%' . $request->input('search.value') . '%'])
                    ->orWhereRaw('LOWER(kategoripengaduan.namakategori) like ?', ['%' . $request->input('search.value') . '%']);
            });
        }

        // Hitung jumlah data yang terfilter
        $recordsFiltered = $data->get()->count();
        if ($request->input('length') != -1) $data = $data->skip($request->input('start'))->take($request->input('length'));
        $data = $data->orderBy($orderBy, $request->input('order.0.dir'))->get();
        $recordsTotal = $data->count();

        return response()->json([
            'draw' => $request->input('draw'),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data
        ]);
    }
    public function updateStatusPetugas(Request $request, $id)
    {
        // Validasi status yang diterima dari form
        $validated = $request->validate([
            'status' => 'required|in:New,Proses,Selesai,Di Tolak', // Validasi sesuai dengan ENUM yang ada di database
        ]);

        // Mencari laporan berdasarkan ID
        $laporan = Pengaduan::find($id);

        // Jika laporan tidak ditemukan, redirect dengan pesan error
        if (!$laporan) {
            return redirect()->route('laporanmasukpetugas')->with('error', 'Laporan tidak ditemukan');
        }

        // Update status laporan sesuai dengan status yang dipilih dari form
        $laporan->status = $request->status;  // Pastikan nilai status yang dikirim sesuai dengan ENUM
        $laporan->updated_at = now(); // Menambahkan updated_at secara manual jika diperlukan
        $laporan->save(); // Simpan perubahan status ke database

        // Redirect kembali ke halaman laporan masuk
        return redirect()->route('laporanmasukpetugas')->with('success', 'Status berhasil diperbarui');
    }
    public function updateStatus(Request $request, $id)
    {
        // Validasi status yang diterima dari form
        $validated = $request->validate([
            'status' => 'required|in:New,Proses,Selesai,Di Tolak', // Validasi sesuai dengan ENUM yang ada di database
        ]);

        // Mencari laporan berdasarkan ID
        $laporan = Pengaduan::find($id);

        // Jika laporan tidak ditemukan, redirect dengan pesan error
        if (!$laporan) {
            return redirect()->route('laporanmasuk')->with('error', 'Laporan tidak ditemukan');
        }

        // Update status laporan sesuai dengan status yang dipilih dari form
        $laporan->status = $request->status;  // Pastikan nilai status yang dikirim sesuai dengan ENUM
        $laporan->updated_at = now(); // Menambahkan updated_at secara manual jika diperlukan
        $laporan->save(); // Simpan perubahan status ke database

        // Redirect kembali ke halaman laporan masuk
        return redirect()->route('laporanmasuk')->with('success', 'Status berhasil diperbarui');
    }
}
