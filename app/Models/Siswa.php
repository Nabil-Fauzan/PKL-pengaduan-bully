<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Siswa extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'siswa';
    protected $primaryKey = 'id_siswa';

    public $timestamps = false;

    protected $fillable = [
        'nis',
        'nama',
        'kelas',
        'jurusan',
        'password',
        'status',
    ];

    protected $hidden = [
        'password',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    /**
     * Siswa punya banyak pengaduan (1:M)
     */
    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class, 'id_siswa', 'id_siswa');
    }
}
