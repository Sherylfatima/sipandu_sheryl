<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MasyarakatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.admin.masyarakat.index', [
            'title'           => 'APM | Masyarakat',
            'header'          =>'Masyarakat',
            'breadcrumb1'     =>'Masyarakat',
            'breadcrumb2'     =>'Index',
            'dataMasyarakat'  => User::where('role', 'Masyarakat')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.masyarakat.create', [
            'title'         => 'APM | Masyarakat',
            'header'        =>'Masyarakat',
            'breadcrumb1'   =>'Masyarakat',
            'breadcrumb2'   =>'Create'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'textNik'             =>'required|unique:users,nik',
            'textNama'            =>'required',
            'selectJenisKelamin'  =>'required',
            'textNoTelepon'       =>'required',
            'textAlamat'          =>'required',
            'textEmail'           =>'required|unique:users,email',
            'textPassword'        =>'required'
        ]);
        $dataSimpanMasyarakat =[
            'nik'             => $request->textNik,
            'name'            => $request->textNama,
            'jeniskelamin'    => $request->selectJenisKelamin,
            'notelpon'        => $request->textNoTelepon,
            'alamat'          => $request->textAlamat,
            'email'           => $request->textEmail,
            'password'        => bcrypt($request->textPassword),
            'role'            => 'Masyarakat'
        ];
        User::create($dataSimpanMasyarakat);
        return redirect('/masyarakat');  // Redirect ke halaman daftar masyarakat setelah penyimpanan
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('pages.admin.masyarakat.edit', [
            'title'          => 'APM | Masyarakat',
            'header'         =>'Masyarakat',
            'breadcrumb1'    =>'Masyarakat',
            'breadcrumb2'    =>'Edit',
            'dataMasyarakat' => User::where('id', $id)->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'textNik'               => 'required',
            'textNama'              => 'required',
            'selectJenisKelamin'    => 'required',
            'textNoTelepon'         => 'required',
            'textAlamat'            => 'required',
            'textEmail'             => 'required|email|unique:users,email,' . $id,
        ]);

        $user = User::find($id);  // Ambil user berdasarkan id

        // Update data
        $user->nik          = $request->textNik;
        $user->name         = $request->textNama;
        $user->jeniskelamin = $request->selectJenisKelamin;
        $user->notelpon     = $request->textNoTelepon;
        $user->alamat       = $request->textAlamat;
        $user->email        = $request->textEmail;

        // Cek apakah password diinputkan
        if ($request->textPassword) {
            $user->password = bcrypt($request->textPassword);
        }

        $user->save();

        // Redirect ke halaman daftar masyarakat setelah update
        return redirect('/masyarakat');  // Redirect ke halaman daftar masyarakat setelah update
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    // Mencari masyarakat berdasarkan id
    $masyarakat = User::findOrFail($id);

    // Hapus pengaduan yang terkait dengan masyarakat ini
    $masyarakat->pengaduan()->delete(); // Asumsi bahwa relasi 'pengaduan' sudah didefinisikan di model User

    // Hapus masyarakat
    $masyarakat->delete();

    // Redirect setelah menghapus data
    return redirect()->route('masyarakat.index')->with('success', 'Masyarakat berhasil dihapus!');
}


}
