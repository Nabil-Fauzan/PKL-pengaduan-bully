<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['nama', 'username', 'email', 'password', 'role', 'status'])]
#[Hidden(['password'])]
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'user';
    protected $primaryKey = 'id_user';
    
    public $timestamps = false;

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
     * Siswa punya banyak tanggapan (1:M)
     */
    public function tanggapan()
    {
        return $this->hasMany(Tanggapan::class, 'id_user', 'id_user');
    }

    /**
     * Petugas punya banyak Pengaduan (1:M)
     */
    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class, 'id_petugas', 'id_user');
    }
}
