<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\KategoriPengaduan;
use Illuminate\Http\Request;

class KategoriPengaduanController extends Controller
{
    //
    public function index(){
        $kategoriPengaduan=KategoriPengaduan::paginate(5);
        return view('pages.admin.kategori.index',compact('kategoriPengaduan'));
    }

    public function create(){
        $kategoris = KategoriPengaduan::all();
        return view('pages.admin.kategori.create',compact('kategoris'));
    }

    public function store(Request $request){
        $request->validate([
            'nama_kategori'  => 'required',
            'deskripsi'      => 'required',
        ]);

        KategoriPengaduan::create([
            'nama_kategori' => $request->nama_kategori,
            'deskripsi'     => $request->deskripsi,
        ]);

        return redirect('kategori')->with('success','kategori berhasil di tambahkan');

    }

    public function edit($id){
        $kategoris = KategoriPengaduan::findOrFail($id);
        return view('pages.admin.kategori.edit',compact('kategoris'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori'  => 'required',
            'deskripsi'      => 'required',
        ]);

        // Cari kategori berdasarkan id
        $kategori = KategoriPengaduan::findOrFail($id);

        // Update data kategori
        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
            'deskripsi'     => $request->deskripsi,
        ]);

        return redirect('/kategori')->with('success', 'Kategori berhasil diperbarui');
    }

    public function destroy($id)
    {
        $kategori = KategoriPengaduan::findOrFail($id);
        $kategori->delete();

        return redirect('kategori')->with('success', 'Kategori berhasil dihapus');

    }


}
