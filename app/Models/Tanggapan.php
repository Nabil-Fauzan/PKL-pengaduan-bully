<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['id_pengaduan', 'id_user', 'isi_tanggapan', 'status_pengaduan'])]
class Tanggapan extends Model
{
    use HasFactory;

    protected $table = 'tanggapan';
    protected $primaryKey = 'id_tanggapan';

    public $timestamps = false;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'tanggal_tanggapan' => 'datetime',
        ];
    }

    /**
     * Tanggapan -> pengaduan
     */
    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class, 'id_pengaduan', 'id_pengaduan');
    }

    /**
     * Tanggapan -> petugas
     */
    public function petugas()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
