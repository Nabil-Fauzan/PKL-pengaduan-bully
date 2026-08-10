<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tanggapan', function (Blueprint $table) {
            $table->integer('id_tanggapan')->autoIncrement();
            $table->integer('id_pengaduan');
            $table->integer('id_user');
            $table->text('isi_tanggapan');
            $table->timestamp('tanggal_tanggapan')->useCurrent();
            $table->enum('status_pengaduan', ['diproses', 'selesai', 'ditolak']);

            $table->foreign('id_pengaduan')->references('id_pengaduan')->on('pengaduan')->onDelete('cascade');
            $table->foreign('id_user')->references('id_user')->on('user')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tanggapan');
    }
};
