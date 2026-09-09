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

class AdminFullFeatureTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;
    private User $petugas;
    private Siswa $siswa;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::create([
            'nama' => 'Super Administrator',
            'username' => 'admin_utama',
            'email' => 'admin@smktiairlangga.sch.id',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'status' => 'aktif',
        ]);

        $this->petugas = User::create([
            'nama' => 'Guru BK Satu',
            'username' => 'petugas_bk',
            'email' => 'bk@smktiairlangga.sch.id',
            'password' => Hash::make('password123'),
            'role' => 'petugas',
            'status' => 'aktif',
        ]);

        $this->siswa = Siswa::create([
            'nis' => '10001',
            'nama' => 'Muhammad Fauzan',
            'kelas' => 'XII',
            'jurusan' => 'RPL / PPLG',
            'password' => Hash::make('password123'),
            'status' => 'aktif',
        ]);
    }

    /**
     * 1. Admin Dashboard Metrics & Navigation
     */
    public function test_admin_can_view_dashboard_with_all_metrics_and_admin_menu(): void
    {
        // Seed a complaint
        Pengaduan::create([
            'id_siswa' => $this->siswa->id_siswa,
            'judul' => 'Pengaduan Bullying',
            'kategori' => 'bullying',
            'isi_pengaduan' => 'Isi laporan bullying...',
            'status' => 'baru',
            'tanggal_pengaduan' => now(),
        ]);

        $response = $this->actingAs($this->admin, 'web')->get('/dashboard');

        $response->assertStatus(200);
        $response->assertSee('Super Administrator');
        $response->assertSee('Administrator');
        $response->assertSee('Total Pengaduan');
        $response->assertSee('Pengaduan Baru');
        $response->assertSee('Pengaduan Bullying');
        // Admin menu items in sidebar
        $response->assertSee(route('admin.siswa'));
        $response->assertSee(route('admin.petugas'));
        $response->assertSee(route('admin.setting'));
        $response->assertSee('Data Siswa');
        $response->assertSee('Data Petugas');
        $response->assertSee('Pengaturan Jurusan');
    }

    /**
     * 2. Admin Complaint Management & Official Response
     */
    public function test_admin_can_manage_complaints_and_give_response(): void
    {
        $pengaduan = Pengaduan::create([
            'id_siswa' => $this->siswa->id_siswa,
            'judul' => 'Laporan Kerusakan Fasilitas',
            'kategori' => 'fasilitas',
            'isi_pengaduan' => 'AC ruang lab komputer rusak dan bocor.',
            'status' => 'baru',
            'tanggal_pengaduan' => now(),
        ]);

        // View complaint list
        $listResponse = $this->actingAs($this->admin, 'web')->get('/dashboard/pengaduan');
        $listResponse->assertStatus(200);
        $listResponse->assertSee('Laporan Kerusakan Fasilitas');

        // View detail
        $detailResponse = $this->actingAs($this->admin, 'web')->get("/dashboard/petugas/pengaduan/{$pengaduan->id_pengaduan}");
        $detailResponse->assertStatus(200);
        $detailResponse->assertSee('AC ruang lab komputer rusak dan bocor.');

        // Submit tanggapan as admin
        $responseAction = $this->actingAs($this->admin, 'web')->post("/dashboard/petugas/pengaduan/{$pengaduan->id_pengaduan}/tanggapan", [
            'status_pengaduan' => 'selesai',
            'isi_tanggapan' => 'Teknisi sudah memperbaiki AC lab komputer.',
        ]);

        $responseAction->assertRedirect("/dashboard/petugas/pengaduan/{$pengaduan->id_pengaduan}");
        $responseAction->assertSessionHas('success_message');

        $pengaduan->refresh();
        $this->assertEquals('selesai', $pengaduan->status);
        $this->assertEquals($this->admin->id_user, $pengaduan->id_petugas);

        $this->assertDatabaseHas('tanggapan', [
            'id_pengaduan' => $pengaduan->id_pengaduan,
            'id_user' => $this->admin->id_user,
            'status_pengaduan' => 'selesai',
            'isi_tanggapan' => 'Teknisi sudah memperbaiki AC lab komputer.',
        ]);
    }

    /**
     * 3. Admin Siswa Management: Index & Search
     */
    public function test_admin_can_view_siswa_index_and_search_by_keyword(): void
    {
        Siswa::create([
            'nis' => '10002',
            'nama' => 'Anisa Rahmawati',
            'kelas' => 'XI',
            'jurusan' => 'DKV',
            'password' => Hash::make('password123'),
            'status' => 'aktif',
        ]);

        // View all
        $response = $this->actingAs($this->admin, 'web')->get('/dashboard/admin/siswa');
        $response->assertStatus(200);
        $response->assertSee('Muhammad Fauzan');
        $response->assertSee('Anisa Rahmawati');

        // Search specific student
        $searchResponse = $this->actingAs($this->admin, 'web')->get('/dashboard/admin/siswa?search=Anisa');
        $searchResponse->assertStatus(200);
        $searchResponse->assertSee('Anisa Rahmawati');
        $searchResponse->assertDontSee('10001'); // Muhammad Fauzan's NIS should not be present
    }

    /**
     * 4. Admin Siswa: Create & Validation
     */
    public function test_admin_siswa_create_form_and_validation_rules(): void
    {
        $createForm = $this->actingAs($this->admin, 'web')->get('/dashboard/admin/siswa/tambah');
        $createForm->assertStatus(200);
        $createForm->assertSee('Formulir Registrasi Akun Siswa Baru');

        // Empty post fails validation
        $invalidPost = $this->actingAs($this->admin, 'web')->post('/dashboard/admin/siswa/simpan', []);
        $invalidPost->assertSessionHasErrors(['nis', 'nama', 'kelas', 'jurusan', 'password', 'status']);

        // Duplicate NIS validation
        $duplicateNisPost = $this->actingAs($this->admin, 'web')->post('/dashboard/admin/siswa/simpan', [
            'nis' => '10001', // Already belongs to Muhammad Fauzan
            'nama' => 'Siswa Baru',
            'kelas' => 'X',
            'jurusan' => 'RPL / PPLG',
            'password' => 'secret123',
            'status' => 'aktif',
        ]);
        $duplicateNisPost->assertSessionHasErrors(['nis']);

        // Valid student creation
        $validPost = $this->actingAs($this->admin, 'web')->post('/dashboard/admin/siswa/simpan', [
            'nis' => '10099',
            'nama' => 'Bintang Perkasa',
            'kelas' => 'X',
            'jurusan' => 'RPL / PPLG',
            'password' => 'rahasia123',
            'status' => 'aktif',
        ]);
        $validPost->assertRedirect(route('admin.siswa'));
        $validPost->assertSessionHas('success_message');

        $createdSiswa = Siswa::where('nis', '10099')->first();
        $this->assertNotNull($createdSiswa);
        $this->assertTrue(Hash::check('rahasia123', $createdSiswa->password));
    }

    /**
     * 5. Admin Siswa: Edit, Update, & Toggle Status
     */
    public function test_admin_can_edit_update_and_toggle_siswa_status(): void
    {
        $editForm = $this->actingAs($this->admin, 'web')->get("/dashboard/admin/siswa/edit/{$this->siswa->id_siswa}");
        $editForm->assertStatus(200);
        $editForm->assertSee('Formulir Pembaruan Data Siswa');
        $editForm->assertSee('Muhammad Fauzan');

        // Update name and class without updating password
        $oldPassword = $this->siswa->password;
        $updateResponse = $this->actingAs($this->admin, 'web')->post("/dashboard/admin/siswa/update/{$this->siswa->id_siswa}", [
            'nis' => '10001',
            'nama' => 'Muhammad Fauzan S.Kom',
            'kelas' => 'XII',
            'jurusan' => 'RPL / PPLG',
            'status' => 'lulus',
        ]);

        $updateResponse->assertRedirect(route('admin.siswa'));
        $updateResponse->assertSessionHas('success_message');

        $this->siswa->refresh();
        $this->assertEquals('Muhammad Fauzan S.Kom', $this->siswa->nama);
        $this->assertEquals('lulus', $this->siswa->status);
        $this->assertEquals($oldPassword, $this->siswa->password); // Password unchanged

        // Toggle status back to aktif
        $toggleResponse = $this->actingAs($this->admin, 'web')->post("/dashboard/admin/siswa/toggle/{$this->siswa->id_siswa}");
        $toggleResponse->assertStatus(302);
        $this->siswa->refresh();
        $this->assertEquals('aktif', $this->siswa->status);
    }

    /**
     * 6. Admin Petugas Management: Index & Search
     */
    public function test_admin_can_view_petugas_index_and_search(): void
    {
        $response = $this->actingAs($this->admin, 'web')->get('/dashboard/admin/petugas');
        $response->assertStatus(200);
        $response->assertSee('Super Administrator');
        $response->assertSee('Guru BK Satu');

        // Search by username
        $searchResponse = $this->actingAs($this->admin, 'web')->get('/dashboard/admin/petugas?search=petugas_bk');
        $searchResponse->assertStatus(200);
        $searchResponse->assertSee('Guru BK Satu');
        $searchResponse->assertDontSee('admin@smktiairlangga.sch.id'); // Admin email should not appear in search results table
    }

    /**
     * 7. Admin Petugas: Create & Validation
     */
    public function test_admin_petugas_create_form_and_validation(): void
    {
        $createForm = $this->actingAs($this->admin, 'web')->get('/dashboard/admin/petugas/tambah');
        $createForm->assertStatus(200);
        $createForm->assertSee('Formulir Registrasi Akun Petugas Baru');

        // Empty post fails
        $invalidPost = $this->actingAs($this->admin, 'web')->post('/dashboard/admin/petugas/simpan', []);
        $invalidPost->assertSessionHasErrors(['nama', 'username', 'email', 'password', 'role', 'status']);

        // Duplicate username / email fails
        $dupPost = $this->actingAs($this->admin, 'web')->post('/dashboard/admin/petugas/simpan', [
            'nama' => 'Staff Baru',
            'username' => 'admin_utama', // Duplicate
            'email' => 'admin@smktiairlangga.sch.id', // Duplicate
            'password' => 'pass123',
            'role' => 'petugas',
            'status' => 'aktif',
        ]);
        $dupPost->assertSessionHasErrors(['username', 'email']);

        // Valid creation
        $validPost = $this->actingAs($this->admin, 'web')->post('/dashboard/admin/petugas/simpan', [
            'nama' => 'Drs. Supriyadi',
            'username' => 'supriyadi_bk',
            'email' => 'supriyadi@smktiairlangga.sch.id',
            'password' => 'securebkpass',
            'role' => 'petugas',
            'status' => 'aktif',
        ]);
        $validPost->assertRedirect(route('admin.petugas'));
        $validPost->assertSessionHas('success_message');

        $createdUser = User::where('username', 'supriyadi_bk')->first();
        $this->assertNotNull($createdUser);
        $this->assertEquals('petugas', $createdUser->role);
        $this->assertTrue(Hash::check('securebkpass', $createdUser->password));
    }

    /**
     * 8. Admin Petugas: Edit & Update Other Staff
     */
    public function test_admin_can_edit_and_toggle_other_staff_status(): void
    {
        $editForm = $this->actingAs($this->admin, 'web')->get("/dashboard/admin/petugas/edit/{$this->petugas->id_user}");
        $editForm->assertStatus(200);
        $editForm->assertSee('Guru BK Satu');
        $editForm->assertSee('Formulir Pembaruan Data Petugas / Admin');

        // Update petugas details
        $updateRes = $this->actingAs($this->admin, 'web')->post("/dashboard/admin/petugas/update/{$this->petugas->id_user}", [
            'nama' => 'Guru BK Senior',
            'username' => 'petugas_bk',
            'email' => 'bk_senior@smktiairlangga.sch.id',
            'role' => 'petugas',
            'status' => 'aktif',
        ]);
        $updateRes->assertRedirect(route('admin.petugas'));
        $this->petugas->refresh();
        $this->assertEquals('Guru BK Senior', $this->petugas->nama);
        $this->assertEquals('bk_senior@smktiairlangga.sch.id', $this->petugas->email);

        // Toggle petugas status to nonaktif
        $toggleRes = $this->actingAs($this->admin, 'web')->post("/dashboard/admin/petugas/toggle/{$this->petugas->id_user}");
        $toggleRes->assertStatus(302);
        $this->petugas->refresh();
        $this->assertEquals('nonaktif', $this->petugas->status);
    }

    /**
     * 9. Self-Safety Guards: Admin Cannot Deactivate or Demote Self
     */
    public function test_admin_self_protection_prevents_lockout(): void
    {
        // Attempt to demote self
        $demoteRes = $this->actingAs($this->admin, 'web')->post("/dashboard/admin/petugas/update/{$this->admin->id_user}", [
            'nama' => 'Super Administrator',
            'username' => 'admin_utama',
            'email' => 'admin@smktiairlangga.sch.id',
            'role' => 'petugas', // Illegal demotion
            'status' => 'aktif',
        ]);
        $demoteRes->assertSessionHasErrors('role');

        // Attempt to deactivate self via update
        $deactivateRes = $this->actingAs($this->admin, 'web')->post("/dashboard/admin/petugas/update/{$this->admin->id_user}", [
            'nama' => 'Super Administrator',
            'username' => 'admin_utama',
            'email' => 'admin@smktiairlangga.sch.id',
            'role' => 'admin',
            'status' => 'nonaktif', // Illegal deactivation
        ]);
        $deactivateRes->assertSessionHasErrors('status');

        // Attempt to toggle status of self
        $toggleRes = $this->actingAs($this->admin, 'web')->post("/dashboard/admin/petugas/toggle/{$this->admin->id_user}");
        $toggleRes->assertSessionHas('error_message');

        $this->admin->refresh();
        $this->assertEquals('admin', $this->admin->role);
        $this->assertEquals('aktif', $this->admin->status);
    }

    /**
     * 10. Admin Settings: View & Dynamic Jurusan Update
     */
    public function test_admin_can_manage_dynamic_jurusan_settings(): void
    {
        $settingView = $this->actingAs($this->admin, 'web')->get('/dashboard/admin/setting');
        $settingView->assertStatus(200);
        $settingView->assertSee('Daftar Jurusan');

        // Empty jurusan list fails
        $invalidUpdate = $this->actingAs($this->admin, 'web')->post('/dashboard/admin/setting', [
            'jurusan' => [],
        ]);
        $invalidUpdate->assertSessionHasErrors('jurusan');

        // Valid update
        $validUpdate = $this->actingAs($this->admin, 'web')->post('/dashboard/admin/setting', [
            'jurusan' => ['RPL / PPLG', 'TKJ / TJKT', 'DKV', 'Animasi 3D', 'Cyber Security'],
        ]);
        $validUpdate->assertRedirect(route('admin.setting'));
        $validUpdate->assertSessionHas('success_message');

        $majors = Setting::getJurusan();
        $this->assertContains('Cyber Security', $majors);
        $this->assertContains('Animasi 3D', $majors);

        // Verify the new major is available in create siswa form
        $createSiswaForm = $this->actingAs($this->admin, 'web')->get('/dashboard/admin/siswa/tambah');
        $createSiswaForm->assertSee('Cyber Security');
        $createSiswaForm->assertSee('Animasi 3D');
    }

    /**
     * 11. Strict RBAC: Non-Admin Access Restrictions (Petugas, Siswa, Guest)
     */
    public function test_non_admin_cannot_access_any_admin_routes(): void
    {
        $adminRoutes = [
            ['GET', '/dashboard/admin/siswa'],
            ['GET', '/dashboard/admin/siswa/tambah'],
            ['POST', '/dashboard/admin/siswa/simpan'],
            ['GET', "/dashboard/admin/siswa/edit/{$this->siswa->id_siswa}"],
            ['POST', "/dashboard/admin/siswa/update/{$this->siswa->id_siswa}"],
            ['POST', "/dashboard/admin/siswa/toggle/{$this->siswa->id_siswa}"],
            ['GET', '/dashboard/admin/petugas'],
            ['GET', '/dashboard/admin/petugas/tambah'],
            ['POST', '/dashboard/admin/petugas/simpan'],
            ['GET', "/dashboard/admin/petugas/edit/{$this->petugas->id_user}"],
            ['POST', "/dashboard/admin/petugas/update/{$this->petugas->id_user}"],
            ['POST', "/dashboard/admin/petugas/toggle/{$this->petugas->id_user}"],
            ['GET', '/dashboard/admin/setting'],
            ['POST', '/dashboard/admin/setting'],
        ];

        foreach ($adminRoutes as [$method, $uri]) {
            // Petugas forbidden (403)
            $petugasRes = $method === 'GET'
                ? $this->actingAs($this->petugas, 'web')->get($uri)
                : $this->actingAs($this->petugas, 'web')->post($uri, []);
            $petugasRes->assertStatus(403);

            // Siswa forbidden (403)
            $siswaRes = $method === 'GET'
                ? $this->actingAs($this->siswa, 'siswa')->get($uri)
                : $this->actingAs($this->siswa, 'siswa')->post($uri, []);
            $siswaRes->assertStatus(403);

            // Guest forbidden (403)
            $guestRes = $method === 'GET'
                ? $this->get($uri)
                : $this->post($uri, []);
            $guestRes->assertStatus(403);
        }
    }
}
