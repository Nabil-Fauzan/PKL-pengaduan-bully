<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->integer('id_siswa')->autoIncrement();
            $table->string('nis', 20);
            $table->string('nama', 100);
            $table->string('kelas', 20);
            $table->string('jurusan', 50);
            $table->string('password', 255);
            $table->enum('status', ['aktif', 'lulus', 'pindah']);
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
