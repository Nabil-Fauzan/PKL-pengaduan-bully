<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Setting;
use App\Models\Pengaduan;
use App\Models\Siswa;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;

class ModelUnitTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test Setting::getJurusan() returns default list when no setting exists.
     */
    public function test_setting_get_jurusan_returns_default_list(): void
    {
        $jurusan = Setting::getJurusan();
        $this->assertIsArray($jurusan);
        $this->assertContains("RPL / PPLG", $jurusan);
        $this->assertContains("DKV", $jurusan);
    }

    /**
     * Test Setting::setJurusan() saves sanitized and trimmed majors.
     */
    public function test_setting_set_jurusan_saves_and_retrieves_properly(): void
    {
        Setting::setJurusan([
            " Teknik Otomasi ",
            "",
            "Animasi 3D"
        ]);

        $jurusan = Setting::getJurusan();
        $this->assertCount(2, $jurusan);
        $this->assertEquals(["Teknik Otomasi", "Animasi 3D"], $jurusan);
    }

    /**
     * Test Pengaduan::isTerabaikan() returns true only when status is 'baru' and older than 3 days.
     */
    public function test_pengaduan_is_terabaikan_helper_logic(): void
    {
        $siswa = Siswa::create([
            'nis' => '12345',
            'nama' => 'Test Siswa',
            'kelas' => 'XII',
            'jurusan' => 'RPL / PPLG',
            'password' => 'password123',
            'status' => 'aktif',
        ]);

        // 1. Baru & Created 4 days ago -> isTerabaikan must be TRUE
        $oldComplaint = Pengaduan::create([
            'id_siswa' => $siswa->id_siswa,
            'judul' => 'Kasus Lama',
            'kategori' => 'bullying',
            'isi_pengaduan' => 'Kejadian minggu lalu.',
            'status' => 'baru',
        ]);
        $oldComplaint->tanggal_pengaduan = Carbon::now()->subDays(4);
        $oldComplaint->save();

        $this->assertTrue($oldComplaint->isTerabaikan());

        // 2. Baru & Created today -> isTerabaikan must be FALSE
        $recentComplaint = Pengaduan::create([
            'id_siswa' => $siswa->id_siswa,
            'judul' => 'Kasus Baru',
            'kategori' => 'bullying',
            'isi_pengaduan' => 'Baru terjadi tadi pagi.',
            'status' => 'baru',
        ]);
        $recentComplaint->tanggal_pengaduan = Carbon::now();
        $recentComplaint->save();

        $this->assertFalse($recentComplaint->isTerabaikan());

        // 3. Diproses & Created 4 days ago -> isTerabaikan must be FALSE (because status is diproses)
        $processedComplaint = Pengaduan::create([
            'id_siswa' => $siswa->id_siswa,
            'judul' => 'Kasus Diproses',
            'kategori' => 'bullying',
            'isi_pengaduan' => 'Sedang dalam penanganan.',
            'status' => 'diproses',
        ]);
        $processedComplaint->tanggal_pengaduan = Carbon::now()->subDays(4);
        $processedComplaint->save();

        $this->assertFalse($processedComplaint->isTerabaikan());
    }
}
