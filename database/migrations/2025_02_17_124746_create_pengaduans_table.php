<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->id();
            $table->string('judul_pengaduan');
            $table->unsignedBigInteger('masyarakat_id');
            $table->unsignedBigInteger('kategori_id');
            $table->date('tanggal_pengaduan');
            $table->text('isi_pengaduan');
            $table->string('foto')->nullable();
            $table->enum('status', ['ditolak', 'new', 'diproses', 'selesai'])->default('new');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduans');
    }
};
