<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Database\Factories\PengaduanFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['id_siswa', 'judul', 'kategori', 'isi_pengaduan', 'status', 'id_petugas'])]
class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduan';
    protected $primaryKey = 'id_pengaduan';

    public $timestamps = false;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'tanggal_pengaduan' => 'datetime',
        ];
    }

    /**
     * Pengaduan -> siswa
     */
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }

    /**
     * Pengadua -> petugas
     */
    public function petugas()
    {
        return $this->belongsTo(User::class, 'id_petugas', 'id_user');
    }

    /**
     * Pengaduan punya banyak tanggapan (1:M)
     */
    public function tanggapan()
    {
        return $this->hasMany(Tanggapan::class, 'id_pengaduan', 'id_pengaduan');
    }

    /**
     * Check if the complaint has been ignored/unresolved for more than 3 days.
     */
    public function isTerabaikan(): bool
    {
        return $this->status === 'baru' && $this->tanggal_pengaduan->lt(now()->subDays(3));
    }
}
