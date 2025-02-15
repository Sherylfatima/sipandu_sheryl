<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash; // Untuk hashing password
use Illuminate\Support\Facades\Validator; // Untuk validasi data
use App\Models\User; // Menggunakan model User untuk menyimpan data

class RegisterMasyarakatController extends Controller
{
    // Menampilkan form registrasi
    public function showRegisterForm()
    {
        return view('pages.users.registermasyarakat'); // Menampilkan form registrasi
    }

    // Menangani form registrasi dan menyimpan data
    public function register(Request $request)
    {
        $request->validate([
            'textNik' =>'required|unique:users,nik',
            'textNama' => 'required',
            'selectJenisKelamin' => 'required',
            'textNomorTelepon' => 'required',
            'textAlamat' => 'required',
            'textEmail' => 'required|email|unique:users,email',
            'textPassword' => 'required',
        ]);

        $user = new User();
        $user->nik = $request->textNik;
        $user->name = $request->textNama;
        $user->jeniskelamin = $request->selectJenisKelamin;
        $user->notelpon = $request->textNomorTelepon;
        $user->alamat = $request->textAlamat;
        $user->email = $request->textEmail;
        $user->password = bcrypt($request->textPassword);
        $user->save();
        

        return redirect()->route('loginmasyarakat');
    }

}
