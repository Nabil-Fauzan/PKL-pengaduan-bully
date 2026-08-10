<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengaduan', function (Blueprint $table) {
            $table->integer('id_pengaduan')->autoIncrement();
            $table->integer('id_siswa');
            $table->string('judul', 150);
            $table->enum('kategori', ['bullying', 'fasilitas', 'akademik', 'lainnya']);
            $table->text('isi_pengaduan');
            $table->timestamp('tanggal_pengaduan')->useCurrent();
            $table->enum('status', ['baru', 'diproses', 'selesai', 'ditolak'])->default('baru');
            $table->integer('id_petugas')->nullable();

            $table->foreign('id_siswa')->references('id_siswa')->on('siswa')->onDelete('cascade');
            $table->foreign('id_petugas')->references('id_user')->on('user')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaduan');
    }
};
