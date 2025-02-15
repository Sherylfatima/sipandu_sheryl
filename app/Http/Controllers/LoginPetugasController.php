<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginPetugasController extends Controller
{
public function showLoginForm()
{
    return view('pages.petugas.loginpetugas');
}

    public function authpetugas(Request $request)
    {
        // Validasi input
        $dataValidasi = $request->validate([
            'email'    => 'required',  // Pastikan email valid
            'password' => 'required',  // Pastikan password minimal 6 karakter
        ]);

        // Coba autentikasi petugas menggunakan email dan password
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();  // Regenerasi session untuk mencegah session fixation
            return redirect()->intended('/dashboardpetugas'); // Redirect ke dashboard petugas setelah login
        } else {
            // Jika autentikasi gagal, kembalikan dengan error
            return redirect('/loginpetugas')->withErrors('Invalid credentials!'); 
        }
    }

    // Logout petugas
    public function logout(Request $request)
    {
        Auth::logout();  // Logout petugas
        $request->session()->invalidate();  // Invalidasi session
        $request->session()->regenerateToken();  // Regenerasi token CSRF untuk mencegah serangan CSRF
        return redirect('/loginpetugas');  // Redirect kembali ke halaman login
    }
}
