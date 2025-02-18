<?php

namespace App\Models;

use App\Models\User;
use App\Models\KategoriPengaduan;
use App\Models\Tanggapan;
use App\Models\Masyarakat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduans';

    protected $fillable = [
        'masyarakat_id',
        'KategoriPengaduan_id',
        'tanggal_pengaduan',
        'isi_pengaduan',
        'foto',
        'status',
    ];

    public function masyarakat()
    {
        return $this->belongsTo(User::class, 'masyarakat_id');
    }

    // Relasi ke model Kategori
    public function kategori()
    {
        return $this->belongsTo(KategoriPengaduan::class, 'kategori_id');
    }

    // Relasi ke model Tanggapan
    public function tanggapans()
    {
        return $this->hasMany(Tanggapan::class);
    }
    public function petugas()
    {
        return $this->belongsTo(User::class, 'masyarakat_id');
    }
    public function tanggapan()
{
    return $this->hasMany(Tanggapan::class, 'pengaduan_id');
}


}
