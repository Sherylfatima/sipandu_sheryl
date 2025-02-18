<?php


    namespace App\Models;

    use App\Models\User;
    use App\Models\Pengaduan;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Factories\HasFactory;

    class Tanggapan extends Model
    {
        use HasFactory;

        /**
         * Kolom-kolom yang dapat diisi (mass assignable).
         */
        protected $table = 'tanggapans';
        protected $fillable = [
            'pengaduan_id',
            'tanggal_tanggapan',
            'tanggapan',
            'User_id',
        ];


        /**
         * Relasi ke model Pengaduan.
         */
        public function pengaduan()
        {
            return $this->belongsTo(Pengaduan::class,'pengaduan_id');
        }


        /**
         * Relasi ke model Petugas.
         */
        public function petugas()
        {
            return $this->belongsTo(User::class, 'petugas_id');
        }
}
