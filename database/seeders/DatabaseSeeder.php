<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Siswa;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Akun Admin
        User::create([
            'nama' => 'Admin Utama',
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'status' => 'aktif',
        ]);

        // Akun Petugas/User Testing
        User::create([
            'nama' => 'Petugas Testing',
            'username' => 'user',
            'password' => Hash::make('user'),
            'email' => 'user@gmail.com',
            'role' => 'petugas',
            'status' => 'aktif',
        ]);

        // Akun Siswa (untuk kebutuhan testing pengaduan)
        Siswa::create([
            'nis' => '12345',
            'nama' => 'Siswa Uji Coba',
            'kelas' => 'XII',
            'jurusan' => 'RPL',
            'password' => Hash::make('siswa'),
            'status' => 'aktif',
        ]);
    }
}
