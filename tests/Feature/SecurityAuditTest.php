<?php

namespace Tests\Feature;

use App\Models\Pengaduan;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class SecurityAuditTest extends TestCase
{
    use RefreshDatabase;

    /**
     * 1. Test Rate Limiting on Login Route
     */
    public function test_login_rate_limiting_triggers_after_excessive_attempts(): void
    {
        for ($i = 0; $i < 5; $i++) {
            $this->post('/login', [
                'role' => 'siswa',
                'nis' => '99999',
                'password' => 'wrongpass',
                'g-recaptcha-response' => 'fake-token',
            ]);
        }

        // The 6th request should hit rate limiting (HTTP 429)
        $response = $this->post('/login', [
            'role' => 'siswa',
            'nis' => '99999',
            'password' => 'wrongpass',
            'g-recaptcha-response' => 'fake-token',
        ]);

        $response->assertStatus(429);
    }

    /**
     * 2. Test Server-Side Google reCAPTCHA Verification
     */
    public function test_recaptcha_is_strictly_verified_server_side(): void
    {
        // Mock Google reCAPTCHA returning failure
        Http::fake([
            'https://www.google.com/recaptcha/api/siteverify*' => Http::response(['success' => false], 200),
        ]);

        $siswa = Siswa::create([
            'nis' => '12345',
            'nama' => 'Test Siswa',
            'kelas' => 'XII',
            'jurusan' => 'RPL',
            'password' => Hash::make('password123'),
            'status' => 'aktif',
        ]);

        $response = $this->post('/login', [
            'role' => 'siswa',
            'nis' => '12345',
            'password' => 'password123',
            'g-recaptcha-response' => 'invalid-recaptcha-token',
        ]);

        $response->assertSessionHasErrors('g-recaptcha-response');
        $this->assertGuest('siswa');
    }

    /**
     * 3. Test Session ID Regeneration & Logout Invalidation
     */
    public function test_session_id_is_regenerated_on_login_and_invalidated_on_logout(): void
    {
        Http::fake([
            'https://www.google.com/recaptcha/api/siteverify*' => Http::response(['success' => true], 200),
        ]);

        $siswa = Siswa::create([
            'nis' => '12345',
            'nama' => 'Test Siswa',
            'kelas' => 'XII',
            'jurusan' => 'RPL',
            'password' => Hash::make('password123'),
            'status' => 'aktif',
        ]);

        // Initial session before login
        $this->get('/login');
        $initialSessionId = session()->getId();

        $response = $this->post('/login', [
            'role' => 'siswa',
            'nis' => '12345',
            'password' => 'password123',
            'g-recaptcha-response' => 'valid-mock-token',
        ]);

        $response->assertRedirect('/dashboard');
        $postLoginSessionId = session()->getId();

        // Verify session ID has regenerated (not equal to pre-login session ID)
        $this->assertNotEquals($initialSessionId, $postLoginSessionId);
        $this->assertAuthenticatedAs($siswa, 'siswa');

        // Logout
        $logoutResponse = $this->post('/logout');
        $logoutResponse->assertRedirect('/');
        $this->assertGuest('siswa');
    }

    /**
     * 4. Test Anti-User Enumeration (Identical Error Messages)
     */
    public function test_login_returns_generic_error_to_prevent_user_enumeration(): void
    {
        Http::fake([
            'https://www.google.com/recaptcha/api/siteverify*' => Http::response(['success' => true], 200),
        ]);

        Siswa::create([
            'nis' => '12345',
            'nama' => 'Existing Siswa',
            'kelas' => 'XII',
            'jurusan' => 'RPL',
            'password' => Hash::make('correctpassword'),
            'status' => 'aktif',
        ]);

        // Attempt 1: Existing NIS with wrong password
        $resWrongPassword = $this->post('/login', [
            'role' => 'siswa',
            'nis' => '12345',
            'password' => 'wrongpassword',
            'g-recaptcha-response' => 'valid-mock-token',
        ]);

        // Attempt 2: Non-existent NIS
        $resNonExistent = $this->post('/login', [
            'role' => 'siswa',
            'nis' => '99999',
            'password' => 'somepassword',
            'g-recaptcha-response' => 'valid-mock-token',
        ]);

        // Both attempts must return the exact same generic error message
        $resWrongPassword->assertSessionHasErrors(['nis' => 'NIS atau password yang Anda masukkan salah.']);
        $resNonExistent->assertSessionHasErrors(['nis' => 'NIS atau password yang Anda masukkan salah.']);
    }

    /**
     * 5. Test IDOR Prevention on Student Complaints
     */
    public function test_siswa_cannot_view_other_students_complaint_via_idor(): void
    {
        $siswaA = Siswa::create([
            'nis' => '11111',
            'nama' => 'Siswa A',
            'kelas' => 'XII',
            'jurusan' => 'RPL',
            'password' => Hash::make('password'),
            'status' => 'aktif',
        ]);

        $siswaB = Siswa::create([
            'nis' => '22222',
            'nama' => 'Siswa B',
            'kelas' => 'XI',
            'jurusan' => 'DKV',
            'password' => Hash::make('password'),
            'status' => 'aktif',
        ]);

        // Siswa B creates a complaint
        $complaintB = Pengaduan::create([
            'id_siswa' => $siswaB->id_siswa,
            'judul' => 'Rahasia Siswa B',
            'kategori' => 'bullying',
            'isi_pengaduan' => 'Laporan pribadi Siswa B.',
            'status' => 'baru',
        ]);

        // Siswa A tries to access Siswa B's complaint detail
        $response = $this->actingAs($siswaA, 'siswa')
            ->get("/dashboard/pengaduan/{$complaintB->id_pengaduan}");

        // Must return 404 (ModelNotFoundException scoped by id_siswa)
        $response->assertStatus(404);
    }

    /**
     * 6. Test RBAC: Siswa Cannot Access Admin Routes
     */
    public function test_siswa_is_forbidden_from_admin_management_routes(): void
    {
        $siswa = Siswa::create([
            'nis' => '12345',
            'nama' => 'Siswa Biasa',
            'kelas' => 'X',
            'jurusan' => 'TKJ',
            'password' => Hash::make('password'),
            'status' => 'aktif',
        ]);

        $routes = [
            '/dashboard/admin/siswa',
            '/dashboard/admin/petugas',
            '/dashboard/admin/setting',
        ];

        foreach ($routes as $route) {
            $response = $this->actingAs($siswa, 'siswa')->get($route);
            $response->assertStatus(403);
        }
    }

    /**
     * 7. Test RBAC: Petugas Cannot Access Admin Routes
     */
    public function test_petugas_is_forbidden_from_admin_management_routes(): void
    {
        $petugas = User::create([
            'nama' => 'Petugas BK',
            'username' => 'petugas_bk',
            'password' => Hash::make('password'),
            'email' => 'petugas@sekolah.sch.id',
            'role' => 'petugas', // Non-admin role
            'status' => 'aktif',
        ]);

        $routes = [
            '/dashboard/admin/siswa',
            '/dashboard/admin/petugas',
            '/dashboard/admin/setting',
        ];

        foreach ($routes as $route) {
            $response = $this->actingAs($petugas, 'web')->get($route);
            $response->assertStatus(403);
        }
    }

    /**
     * 8. Test RBAC: Siswa Cannot Access Officer Investigation Endpoints
     */
    public function test_siswa_cannot_access_officer_complaint_investigation_view(): void
    {
        $siswa = Siswa::create([
            'nis' => '12345',
            'nama' => 'Siswa Test',
            'kelas' => 'XII',
            'jurusan' => 'RPL',
            'password' => Hash::make('password'),
            'status' => 'aktif',
        ]);

        $complaint = Pengaduan::create([
            'id_siswa' => $siswa->id_siswa,
            'judul' => 'Pengaduan Uji Coba',
            'kategori' => 'bullying',
            'isi_pengaduan' => 'Isi laporan.',
            'status' => 'baru',
        ]);

        // Siswa attempts to access officer detail route
        $response = $this->actingAs($siswa, 'siswa')
            ->get("/dashboard/petugas/pengaduan/{$complaint->id_pengaduan}");

        // Must redirect to login because Siswa does not pass web guard check
        $response->assertRedirect('/login');
    }

    /**
     * 9. Test Tamper-Proofing: Siswa Cannot Spoof id_siswa in Complaint Submission
     */
    public function test_siswa_cannot_spoof_id_siswa_when_submitting_complaint(): void
    {
        $realSiswa = Siswa::create([
            'nis' => '11111',
            'nama' => 'Real Siswa',
            'kelas' => 'XII',
            'jurusan' => 'RPL',
            'password' => Hash::make('password'),
            'status' => 'aktif',
        ]);

        $victimSiswa = Siswa::create([
            'nis' => '22222',
            'nama' => 'Victim Siswa',
            'kelas' => 'X',
            'jurusan' => 'DKV',
            'password' => Hash::make('password'),
            'status' => 'aktif',
        ]);

        // Real Siswa sends a POST request with spoofed id_siswa in the payload
        $response = $this->actingAs($realSiswa, 'siswa')->post('/dashboard/pengaduan/simpan', [
            'id_siswa' => $victimSiswa->id_siswa, // Spoofed ID
            'judul' => 'Laporan Uji Coba',
            'kategori' => 'bullying',
            'isi_pengaduan' => 'Mencoba memalsukan pengirim laporan.',
        ]);

        $response->assertRedirect('/dashboard');

        // Verify that the complaint was saved with the authenticated user's ID, ignoring spoofed ID
        $complaint = Pengaduan::where('judul', 'Laporan Uji Coba')->first();
        $this->assertNotNull($complaint);
        $this->assertEquals($realSiswa->id_siswa, $complaint->id_siswa);
        $this->assertNotEquals($victimSiswa->id_siswa, $complaint->id_siswa);
    }

    /**
     * 10. Test Secure Password Hashing (Bcrypt Check)
     */
    public function test_passwords_are_securely_hashed_and_not_stored_in_plaintext(): void
    {
        $rawPassword = 'SuperSecretPassword!@#123';

        $siswa = Siswa::create([
            'nis' => '33333',
            'nama' => 'Security Test Siswa',
            'kelas' => 'XII',
            'jurusan' => 'RPL',
            'password' => Hash::make($rawPassword),
            'status' => 'aktif',
        ]);

        // Directly inspect database value without Eloquent hiding
        $dbPassword = DB::table('siswa')->where('id_siswa', $siswa->id_siswa)->value('password');

        $this->assertNotEquals($rawPassword, $dbPassword);
        $this->assertTrue(str_starts_with($dbPassword, '$2y$')); // Bcrypt algorithm prefix
        $this->assertTrue(Hash::check($rawPassword, $dbPassword));
    }

    /**
     * 11. Threat Model: Compromised Siswa cannot submit officer responses or change status
     */
    public function test_threat_model_siswa_cannot_post_tanggapan_or_alter_complaint_status(): void
    {
        $attackerSiswa = Siswa::create([
            'nis' => '66666',
            'nama' => 'Attacker Siswa',
            'kelas' => 'XII',
            'jurusan' => 'RPL',
            'password' => Hash::make('password'),
            'status' => 'aktif',
        ]);

        $victimSiswa = Siswa::create([
            'nis' => '77777',
            'nama' => 'Victim Siswa',
            'kelas' => 'X',
            'jurusan' => 'DKV',
            'password' => Hash::make('password'),
            'status' => 'aktif',
        ]);

        $complaint = Pengaduan::create([
            'id_siswa' => $victimSiswa->id_siswa,
            'judul' => 'Victim Report',
            'kategori' => 'bullying',
            'isi_pengaduan' => 'Bullying text.',
            'status' => 'baru',
        ]);

        // Attacker Siswa attempts to submit a response directly via POST
        $response = $this->actingAs($attackerSiswa, 'siswa')
            ->post("/dashboard/petugas/pengaduan/{$complaint->id_pengaduan}/tanggapan", [
                'status_pengaduan' => 'selesai',
                'isi_tanggapan' => 'Palsu ditutup oleh penyerang.',
            ]);

        // Guard rejects request and redirects to login
        $response->assertRedirect('/login');

        // Status remains unchanged
        $freshComplaint = Pengaduan::find($complaint->id_pengaduan);
        $this->assertEquals('baru', $freshComplaint->status);
        $this->assertEmpty($freshComplaint->tanggapan);
    }

    /**
     * 12. Threat Model: Compromised Siswa cannot toggle or delete other students
     */
    public function test_threat_model_siswa_cannot_toggle_other_student_accounts(): void
    {
        $attackerSiswa = Siswa::create([
            'nis' => '88888',
            'nama' => 'Attacker Siswa',
            'kelas' => 'XII',
            'jurusan' => 'RPL',
            'password' => Hash::make('password'),
            'status' => 'aktif',
        ]);

        $targetSiswa = Siswa::create([
            'nis' => '99991',
            'nama' => 'Target Siswa',
            'kelas' => 'XI',
            'jurusan' => 'TKJ',
            'password' => Hash::make('password'),
            'status' => 'aktif',
        ]);

        $response = $this->actingAs($attackerSiswa, 'siswa')
            ->post("/dashboard/admin/siswa/toggle/{$targetSiswa->id_siswa}");

        $response->assertStatus(403);
        $this->assertEquals('aktif', Siswa::find($targetSiswa->id_siswa)->status);
    }

    /**
     * 13. Security Headers: Responses must include defensive security headers across public and auth routes
     */
    public function test_responses_contain_required_security_headers(): void
    {
        // 1. Public route (welcome)
        $publicRes = $this->get('/');
        $publicRes->assertHeader('X-Frame-Options', 'SAMEORIGIN');
        $publicRes->assertHeader('X-Content-Type-Options', 'nosniff');
        $publicRes->assertHeader('Referrer-Policy', 'strict-origin-when-cross-origin');
        $publicRes->assertHeader('X-XSS-Protection', '1; mode=block');
        $this->assertTrue($publicRes->headers->has('Content-Security-Policy'));
        $this->assertStringContainsString("frame-ancestors 'self'", $publicRes->headers->get('Content-Security-Policy'));

        // 2. Login route
        $loginRes = $this->get('/login');
        $loginRes->assertHeader('X-Frame-Options', 'SAMEORIGIN');
        $loginRes->assertHeader('X-Content-Type-Options', 'nosniff');

        // 3. Authenticated Siswa route
        $siswa = Siswa::create([
            'nis' => '11223',
            'nama' => 'Header Test Siswa',
            'kelas' => 'X',
            'jurusan' => 'RPL',
            'password' => Hash::make('password'),
            'status' => 'aktif',
        ]);
        $authRes = $this->actingAs($siswa, 'siswa')->get('/dashboard');
        $authRes->assertHeader('X-Frame-Options', 'SAMEORIGIN');
        $authRes->assertHeader('X-Content-Type-Options', 'nosniff');
        $authRes->assertHeader('Referrer-Policy', 'strict-origin-when-cross-origin');
    }

    /**
     * 14. Threat Model: Unauthenticated attacker cannot access any dashboard endpoints
     */
    public function test_threat_model_unauthenticated_attacker_is_redirected_to_login(): void
    {
        $endpoints = [
            '/dashboard',
            '/dashboard/pengaduan',
            '/dashboard/pengaduan/tambah',
            '/dashboard/pengaduan/1',
            '/dashboard/petugas/pengaduan/1',
        ];

        foreach ($endpoints as $url) {
            $response = $this->get($url);
            $response->assertRedirect('/login');
        }
    }

    /**
     * 15. Threat Model: Authenticated Petugas cannot perform admin privilege escalation
     */
    public function test_threat_model_petugas_cannot_escalate_privilege_or_modify_other_accounts(): void
    {
        $petugas = User::create([
            'nama' => 'Petugas BK Biasa',
            'username' => 'petugas_biasa',
            'password' => Hash::make('password'),
            'email' => 'petugas_biasa@sekolah.sch.id',
            'role' => 'petugas',
            'status' => 'aktif',
        ]);

        $admin = User::create([
            'nama' => 'Kepala Admin',
            'username' => 'superadmin',
            'password' => Hash::make('password'),
            'email' => 'superadmin@sekolah.sch.id',
            'role' => 'admin',
            'status' => 'aktif',
        ]);

        // Attempt 1: Direct POST to change admin password or role
        $response = $this->actingAs($petugas, 'web')->post("/dashboard/admin/petugas/update/{$admin->id_user}", [
            'nama' => 'Hacked Admin',
            'username' => 'superadmin',
            'email' => 'superadmin@sekolah.sch.id',
            'role' => 'petugas', // Attempt to demote admin
        ]);

        $response->assertStatus(403);
        $this->assertEquals('admin', User::find($admin->id_user)->role);

        // Attempt 2: Toggle admin account status
        $responseToggle = $this->actingAs($petugas, 'web')->post("/dashboard/admin/petugas/toggle/{$admin->id_user}");
        $responseToggle->assertStatus(403);
        $this->assertEquals('aktif', User::find($admin->id_user)->status);
    }
}
