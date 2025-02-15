<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriPengaduan;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengaduan;
use Carbon\Carbon;  // Pastikan Carbon diimpor

class UserPengaduankuController extends Controller
{
    public function index()
{
    $pengaduans = Pengaduan::where('masyarakat_id', Auth::id())
                           ->with('kategoripengaduan')
                           ->get();

    // Pass the data to the view
    return view('pages.users.pengaduanku.index', compact('pengaduans'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = KategoriPengaduan::all(); // Ambil semua kategori pengaduan
        return view('pages.users.pengaduanku.create', compact('kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'judul'              => 'required|string|max:255',
        'kategori_id'        => 'required|exists:kategoripengaduan,id', // Pastikan kategori ada di database
        'isipengaduan'       => 'required|string',
        'foto'               => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'tanggalpengaduan'   => 'required|date', // Validasi untuk tanggal pengaduan
    ]);

    // Menangani upload foto jika ada
    $fotoPath = null;
    if ($request->hasFile('foto')) {
        $fotoPath = $request->file('foto')->store('pengaduan', 'public');
    }

    // Menyimpan data pengaduan ke database
    Pengaduan::create([
        'masyarakat_id'     => Auth::id(), // Menggunakan ID user yang sedang login
        'kategori_id'       => $request->kategori_id,
        'judul'             => $request->judul, // Menyimpan judul yang diterima dari form
        'isipengaduan'      => $request->isipengaduan,
        'foto'              => $fotoPath,
        'status'            => 'New', // Status default 'New'
        'tanggalpengaduan'  => $request->tanggalpengaduan, // Menyimpan tanggal pengaduan yang dipilih pengguna
    ]);

    // Redirect ke halaman pengaduanku dengan pesan sukses
    return redirect('/pengaduanku')->with('success', 'Pengaduan berhasil dibuat!');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pengaduan = Pengaduan::where('id', $id)
        ->where('masyarakat_id', Auth::id()) // Ensure only the logged-in user can view their own complaint
        ->with('kategoripengaduan') // Load the related category for the complaint
        ->first();

// Check if the complaint exists
if (!$pengaduan) {
return redirect('/pengaduanku')->with('error', 'Pengaduan tidak ditemukan!');
}

// Pass the complaint data to the view
return view('pages.users.pengaduanku.show', data: compact('pengaduan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Function for editing a complaint (can be added later)
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Function for updating the complaint (can be added later)
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Function for deleting the complaint (can be added later)
    }
}
