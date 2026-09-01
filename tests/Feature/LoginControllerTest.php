<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use App\Models\User;
use App\Models\Siswa;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the login form view can be accessed.
     */
    public function test_login_form_can_be_rendered(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertViewIs('auth.login');
        $response->assertSee('Selamat Datang Kembali');
    }

    /**
     * Test redirect to dashboard if user is already authenticated.
     */
    public function test_authenticated_user_cannot_access_login_form(): void
    {
        $siswa = Siswa::create([
            'nis' => '12345',
            'nama' => 'Siswa Test',
            'kelas' => 'XII',
            'jurusan' => 'RPL',
            'password' => Hash::make('password'),
            'status' => 'aktif',
        ]);

        $response = $this->actingAs($siswa, 'siswa')->get('/login');

        $response->assertRedirect('/dashboard');
    }

    /**
     * Test validation requires fields.
     */
    public function test_login_requires_credentials_and_recaptcha(): void
    {
        $response = $this->post('/login', [
            'role' => 'siswa',
        ]);

        $response->assertSessionHasErrors(['nis', 'password', 'g-recaptcha-response']);
    }

    /**
     * Test successful login as a student (Siswa).
     */
    public function test_siswa_can_login_with_correct_credentials(): void
    {
        // Fake Google reCAPTCHA request
        Http::fake([
            'https://www.google.com/recaptcha/api/siteverify*' => Http::response(['success' => true], 200),
        ]);

        $siswa = Siswa::create([
            'nis' => '12345',
            'nama' => 'Siswa Test',
            'kelas' => 'XII',
            'jurusan' => 'RPL',
            'password' => Hash::make('siswa_pass'),
            'status' => 'aktif',
        ]);

        $response = $this->post('/login', [
            'role' => 'siswa',
            'nis' => '12345',
            'password' => 'siswa_pass',
            'g-recaptcha-response' => 'fake-recaptcha-token',
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertTrue(Auth::guard('siswa')->check());
        $this->assertEquals($siswa->id_siswa, Auth::guard('siswa')->id());
    }

    /**
     * Test login failure for inactive student.
     */
    public function test_inactive_siswa_cannot_login(): void
    {
        // Fake Google reCAPTCHA request
        Http::fake([
            'https://www.google.com/recaptcha/api/siteverify*' => Http::response(['success' => true], 200),
        ]);

        Siswa::create([
            'nis' => '12345',
            'nama' => 'Siswa Inaktif',
            'kelas' => 'XII',
            'jurusan' => 'RPL',
            'password' => Hash::make('password'),
            'status' => 'lulus', // status is not 'aktif'
        ]);

        $response = $this->post('/login', [
            'role' => 'siswa',
            'nis' => '12345',
            'password' => 'password',
            'g-recaptcha-response' => 'fake-recaptcha-token',
        ]);

        $response->assertSessionHasErrors(['nis']);
        $this->assertFalse(Auth::guard('siswa')->check());
    }

    /**
     * Test successful login as a user/petugas.
     */
    public function test_user_can_login_with_correct_credentials(): void
    {
        // Fake Google reCAPTCHA request
        Http::fake([
            'https://www.google.com/recaptcha/api/siteverify*' => Http::response(['success' => true], 200),
        ]);

        $user = User::create([
            'nama' => 'Petugas Test',
            'username' => 'petugas_test',
            'email' => 'petugas@test.com',
            'password' => Hash::make('petugas_pass'),
            'role' => 'petugas',
            'status' => 'aktif',
        ]);

        $response = $this->post('/login', [
            'role' => 'petugas',
            'login_identifier' => 'petugas_test',
            'password' => 'petugas_pass',
            'g-recaptcha-response' => 'fake-recaptcha-token',
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertTrue(Auth::guard('web')->check());
        $this->assertEquals($user->id_user, Auth::guard('web')->id());
    }

    /**
     * Test logging out.
     */
    public function test_user_can_logout(): void
    {
        $siswa = Siswa::create([
            'nis' => '12345',
            'nama' => 'Siswa Test',
            'kelas' => 'XII',
            'jurusan' => 'RPL',
            'password' => Hash::make('password'),
            'status' => 'aktif',
        ]);

        $this->actingAs($siswa, 'siswa');

        $response = $this->post('/logout');

        $response->assertRedirect('/');
        $this->assertFalse(Auth::guard('siswa')->check());
    }
}
