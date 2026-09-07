<?php

namespace Tests\Feature;

use App\Models\Pengaduan;
use App\Models\Setting;
use App\Models\Siswa;
use App\Models\Tanggapan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class DashboardAndAdminTest extends TestCase
{
    use RefreshDatabase;

    private Siswa $siswa;
    private User $petugas;
    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->siswa = Siswa::create([
            'nis' => '10001',
            'nama' => 'Budi Santoso',
            'kelas' => 'XII',
            'jurusan' => 'RPL',
            'password' => Hash::make('password123'),
            'status' => 'aktif',
        ]);

        $this->petugas = User::create([
            'nama' => 'Guru BK Satu',
            'username' => 'gurubk',
            'email' => 'bk@smktia.sch.id',
            'password' => Hash::make('password123'),
            'role' => 'petugas',
            'status' => 'aktif',
        ]);

        $this->admin = User::create([
            'nama' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@smktia.sch.id',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'status' => 'aktif',
        ]);
    }

    /**
     * 1. Siswa Dashboard & Complaint Creation Tests
     */
    public function test_siswa_can_access_dashboard_and_create_complaint(): void
    {
        $response = $this->actingAs($this->siswa, 'siswa')->get('/dashboard');
        $response->assertStatus(200);
        $response->assertSee('Budi Santoso');

        // Access create form
        $createForm = $this->actingAs($this->siswa, 'siswa')->get('/dashboard/pengaduan/tambah');
        $createForm->assertStatus(200);

        // Submit new complaint (regular category)
        $submit = $this->actingAs($this->siswa, 'siswa')->post('/dashboard/pengaduan/simpan', [
            'judul' => 'Perundungan di Lapangan',
            'kategori' => 'bullying',
            'isi_pengaduan' => 'Kronologi kejadian perundungan...',
        ]);

        $submit->assertRedirect('/dashboard');
        $submit->assertSessionHas('success_message');

        $this->assertDatabaseHas('pengaduan', [
            'id_siswa' => $this->siswa->id_siswa,
            'judul' => 'Perundungan di Lapangan',
            'kategori' => 'bullying',
            'status' => 'baru',
        ]);
    }

    public function test_siswa_can_create_complaint_with_kategori_lainnya(): void
    {
        $submit = $this->actingAs($this->siswa, 'siswa')->post('/dashboard/pengaduan/simpan', [
            'judul' => 'Masalah Lingkungan',
            'kategori' => 'lainnya',
            'kategori_lainnya' => 'Kebersihan',
            'isi_pengaduan' => 'Ada sampah menumpuk di lorong.',
        ]);

        $submit->assertRedirect('/dashboard');

        $pengaduan = Pengaduan::where('judul', 'Masalah Lingkungan')->first();
        $this->assertNotNull($pengaduan);
        $this->assertStringContainsString('[Kategori Lainnya: Kebersihan]', $pengaduan->isi_pengaduan);
    }

    /**
     * 2. Petugas Investigation & Tanggapan Flow
     */
    public function test_petugas_can_view_and_respond_to_complaint(): void
    {
        $pengaduan = Pengaduan::create([
            'id_siswa' => $this->siswa->id_siswa,
            'judul' => 'Laporan Pengaduan Siswa',
            'kategori' => 'bullying',
            'isi_pengaduan' => 'Isi laporan...',
            'status' => 'baru',
            'tanggal_pengaduan' => now(),
        ]);

        // Petugas views complaint list
        $listResponse = $this->actingAs($this->petugas, 'web')->get('/dashboard/pengaduan');
        $listResponse->assertStatus(200);
        $listResponse->assertSee('Laporan Pengaduan Siswa');

        // Petugas views detail
        $detailResponse = $this->actingAs($this->petugas, 'web')->get("/dashboard/petugas/pengaduan/{$pengaduan->id_pengaduan}");
        $detailResponse->assertStatus(200);

        // Petugas responds and updates status to diproses
        $respondAction = $this->actingAs($this->petugas, 'web')
                              ->from("/dashboard/petugas/pengaduan/{$pengaduan->id_pengaduan}")
                              ->post("/dashboard/petugas/pengaduan/{$pengaduan->id_pengaduan}/tanggapan", [
                                  'status_pengaduan' => 'diproses',
                                  'isi_tanggapan' => 'Laporan sudah kami terima dan sedang ditindaklanjuti oleh guru BK.',
                              ]);

        $respondAction->assertRedirect("/dashboard/petugas/pengaduan/{$pengaduan->id_pengaduan}");
        $respondAction->assertSessionHas('success_message');

        $pengaduan->refresh();
        $this->assertEquals('diproses', $pengaduan->status);
        $this->assertEquals($this->petugas->id_user, $pengaduan->id_petugas);

        $this->assertDatabaseHas('tanggapan', [
            'id_pengaduan' => $pengaduan->id_pengaduan,
            'id_user' => $this->petugas->id_user,
            'status_pengaduan' => 'diproses',
        ]);
    }

    /**
     * 3. Admin Siswa CRUD Tests
     */
    public function test_admin_can_manage_siswa(): void
    {
        // View index
        $indexRes = $this->actingAs($this->admin, 'web')->get('/dashboard/admin/siswa');
        $indexRes->assertStatus(200);

        // Create new Siswa
        $storeRes = $this->actingAs($this->admin, 'web')->post('/dashboard/admin/siswa/simpan', [
            'nis' => '10002',
            'nama' => 'Siti Aminah',
            'kelas' => 'XI',
            'jurusan' => 'RPL / PPLG',
            'password' => 'secret123',
            'status' => 'aktif',
        ]);
        $storeRes->assertRedirect('/dashboard/admin/siswa');

        $newSiswa = Siswa::where('nis', '10002')->first();
        $this->assertNotNull($newSiswa);

        // Edit Siswa
        $updateRes = $this->actingAs($this->admin, 'web')->post("/dashboard/admin/siswa/update/{$newSiswa->id_siswa}", [
            'nis' => '10002',
            'nama' => 'Siti Aminah Updated',
            'kelas' => 'XII',
            'jurusan' => 'TKJ / TJKT',
            'status' => 'lulus',
        ]);
        $updateRes->assertRedirect('/dashboard/admin/siswa');

        $newSiswa->refresh();
        $this->assertEquals('Siti Aminah Updated', $newSiswa->nama);
        $this->assertEquals('XII', $newSiswa->kelas);
        $this->assertEquals('lulus', $newSiswa->status);

        // Toggle status
        $toggleRes = $this->actingAs($this->admin, 'web')->post("/dashboard/admin/siswa/toggle/{$newSiswa->id_siswa}");
        $toggleRes->assertStatus(302);
        $newSiswa->refresh();
        $this->assertEquals('aktif', $newSiswa->status);
    }

    /**
     * 4. Admin Petugas CRUD & Self-Safety Guards
     */
    public function test_admin_cannot_demote_or_deactivate_self(): void
    {
        // Attempt to demote self to petugas
        $demoteRes = $this->actingAs($this->admin, 'web')->post("/dashboard/admin/petugas/update/{$this->admin->id_user}", [
            'nama' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@smktia.sch.id',
            'role' => 'petugas',
            'status' => 'aktif',
        ]);
        $demoteRes->assertSessionHasErrors('role');

        // Attempt to deactivate self
        $deactivateRes = $this->actingAs($this->admin, 'web')->post("/dashboard/admin/petugas/update/{$this->admin->id_user}", [
            'nama' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@smktia.sch.id',
            'role' => 'admin',
            'status' => 'nonaktif',
        ]);
        $deactivateRes->assertSessionHasErrors('status');

        // Attempt toggle on self
        $toggleRes = $this->actingAs($this->admin, 'web')->post("/dashboard/admin/petugas/toggle/{$this->admin->id_user}");
        $toggleRes->assertSessionHas('error_message');
    }

    /**
     * 5. Admin Settings (Jurusan) Management
     */
    public function test_admin_can_update_jurusan_settings(): void
    {
        $res = $this->actingAs($this->admin, 'web')->post('/dashboard/admin/setting', [
            'jurusan' => ['RPL', 'TKJ', 'MM', 'DKV', 'SIJA'],
        ]);

        $res->assertRedirect('/dashboard/admin/setting');
        $res->assertSessionHas('success_message');

        $jurusanList = Setting::getJurusan();
        $this->assertContains('SIJA', $jurusanList);
        $this->assertContains('DKV', $jurusanList);
    }
}
