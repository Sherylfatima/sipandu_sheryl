<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display the profile of the user who is logged in.
     */
    public function index()
    {
        return view('pages.admin.profile.index', [
            'title'     => 'APM | Profile',
            'header'        => 'Profile',
            'breadcrumb1'   => 'Profile',
            'breadcrumb2'   => 'Index',
            'dataUser'      => auth()->user(), // Mengambil data user yang sedang login
        ]);
    }
    public function indexpetugas()
    {
        return view('pages.petugas.profile.index', [
            'title'     => 'APM | Profile',
            'header'        => 'Profile',
            'breadcrumb1'   => 'Profile',
            'breadcrumb2'   => 'Index',
            'dataUser'      => auth()->user(), // Mengambil data user yang sedang login
        ]);
    }

    /**
     * Show the form for editing the logged-in user's profile.
     */
    public function edit()
    {
        $user = auth()->user(); // Ambil data user yang sedang login
        
        return view('pages.admin.profile.editprofile', [
            'title'     => 'APM | Edit Profile',
            'header'    => 'Edit Profile',
            'breadcrumb1' => 'Profile',
            'breadcrumb2' => 'Edit',
            'dataUser' => $user,  // Ambil data user yang sedang login
        ]);
    }
    public function editpetugas()
    {
        $user = auth()->user(); // Ambil data user yang sedang login
        
        return view('pages.petugas.profile.editprofile', [
            'title'     => 'APM | Edit Profile',
            'header'    => 'Edit Profile',
            'breadcrumb1' => 'Profile',
            'breadcrumb2' => 'Edit',
            'dataUser' => $user,  // Ambil data user yang sedang login
        ]);
    }

    /**
     * Update the logged-in user's profile.
     */public function update(Request $request, $id)
{
    // Validasi untuk update data profile
    $request->validate([
        'textNik' => 'required',
        'textNama' => 'required',
        'selectJenisKelamin' => 'required',
        'textNoTelepon' => 'required',
        'textAlamat' => 'required',
        'textEmail' => 'required|email|unique:users,email,' . $id,
    ]);

    // Temukan user berdasarkan id
    $user = User::find($id);
    if (!$user) {
        return redirect()->back()->with('error', 'User tidak ditemukan!');
    }

    // Update data selain password
    $user->nik = $request->textNik;
    $user->name = $request->textNama;
    $user->jeniskelamin = $request->selectJenisKelamin;
    $user->notelpon = $request->textNoTelepon;
    $user->alamat = $request->textAlamat;
    $user->email = $request->textEmail;

    // Cek apakah password baru diinputkan dan validasi
    if ($request->filled('textPassword') && $request->textPassword !== '' && $request->textPassword === $request->textNewPassword) {
        $request->validate([
            'textPassword' => 'required|min:6', // Minimal password 6 karakter
            'textNewPassword' => 'required|same:textPassword', // Pastikan password baru dan konfirmasi sama
        ]);
        // Update password jika valid
        $user->password = bcrypt($request->textNewPassword);
    }

    // Simpan perubahan data
    $user->save();

    return redirect()->route('admin.profile.index')->with('success', 'Profile berhasil diperbarui!');
}
     public function updatepetugas(Request $request, $id)
{
    // Validasi untuk update data profile
    $request->validate([
        'textNik' => 'required',
        'textNama' => 'required',
        'selectJenisKelamin' => 'required',
        'textNoTelepon' => 'required',
        'textAlamat' => 'required',
        'textEmail' => 'required|email|unique:users,email,' . $id,
    ]);

    // Temukan user berdasarkan id
    $user = User::find($id);
    if (!$user) {
        return redirect()->back()->with('error', 'User tidak ditemukan!');
    }

    // Update data selain password
    $user->nik = $request->textNik;
    $user->name = $request->textNama;
    $user->jeniskelamin = $request->selectJenisKelamin;
    $user->notelpon = $request->textNoTelepon;
    $user->alamat = $request->textAlamat;
    $user->email = $request->textEmail;

    // Cek apakah password baru diinputkan dan validasi
    if ($request->filled('textPassword') && $request->textPassword !== '' && $request->textPassword === $request->textNewPassword) {
        $request->validate([
            'textPassword' => 'required|min:6', // Minimal password 6 karakter
            'textNewPassword' => 'required|same:textPassword', // Pastikan password baru dan konfirmasi sama
        ]);
        // Update password jika valid
        $user->password = bcrypt($request->textNewPassword);
    }

    // Simpan perubahan data
    $user->save();

    return redirect()->route('petugas.profile.indexpetugas')->with('success', 'Profile berhasil diperbarui!');
}

}
