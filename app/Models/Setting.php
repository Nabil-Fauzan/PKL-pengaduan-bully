<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'setting';
    protected $primaryKey = 'key';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = ['key', 'value'];

    /**
     * Get list of majors (jurusan) from database or default list.
     */
    public static function getJurusan(): array
    {
        $setting = self::find('jurusan');
        if (!$setting || empty($setting->value)) {
            return [
                "RPL / PPLG",
                "MPLB",
                "TKJ / TJKT",
                "DKV"
            ];
        }

        $decoded = json_decode($setting->value, true);
        return is_array($decoded) ? $decoded : [
            "RPL / PPLG",
            "MPLB",
            "TKJ / TJKT",
            "DKV"
        ];
    }

    /**
     * Save list of majors (jurusan).
     */
    public static function setJurusan(array $jurusan): void
    {
        self::updateOrCreate(
            ['key' => 'jurusan'],
            ['value' => json_encode(array_values(array_filter(array_map('trim', $jurusan))))]
        );
    }
}
