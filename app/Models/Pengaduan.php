<?php

namespace Models;

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $fillable = ['masyarakat_id', 'kategori_id', 'judul', 'isipengaduan', 'tanggalpengaduan', 'foto', 'status'];

    protected $table = 'pengaduan';

    // Nilai Balik Relasi Ke Table KategoriPengaduan
    public function kategoripengaduan()
    {
        // Pastikan nama model 'KategoriPengaduan' sesuai dengan nama file model
        return $this->belongsTo(KategoriPengaduan::class, 'kategori_id', 'id');
    }

    // Relasi Ke Tanggapan
    public function tanggapan()
    {
        return $this->hasMany(Tanggapan::class, 'pengaduan_id', 'id');
    }
    // Model Pengaduan
public function user()
{
    return $this->belongsTo(User::class, 'masyarakat_id', 'id');
}

}
