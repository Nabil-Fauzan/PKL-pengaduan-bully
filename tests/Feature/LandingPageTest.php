<?php

namespace Tests\Feature;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LandingPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_landing_page_renders_successfully(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('STIPOR');
        $response->assertSee('SMK TI AIRLANGGA');
        $response->assertSee('Wujudkan Sekolah');
        $response->assertSee('Aman, Nyaman');
        $response->assertSee('Bebas Perundungan');
    }

    public function test_landing_page_has_responsive_meta_and_assets(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('<meta name="viewport" content="width=device-width, initial-scale=1">', false);
        $response->assertSee('bootstrap@5.3.3', false);
        $response->assertSee('data-bs-theme', false);
        $response->assertSee('id="backToTop"', false);
    }

    public function test_landing_page_navbar_and_dropdown_navigation(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('href="#beranda"', false);
        $response->assertSee('href="#tentang"', false);
        $response->assertSee('href="#kategori"', false);
        $response->assertSee('id="navbarEdukasiDropdown"', false);
        $response->assertSee('href="#edukasi"', false);
        $response->assertSee('href="#panduan-saksi"', false);
        $response->assertSee('href="#cek-mandiri"', false);
        $response->assertSee('href="#alur"', false);
        $response->assertSee('href="#faq"', false);
        $response->assertSee('href="#kontak"', false);
        $response->assertSee('theme-toggle-btn', false);
    }

    public function test_navbar_renders_guest_ctas(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Masuk');
        $response->assertSee('Laporkan Sekarang');
    }

    public function test_navbar_renders_authenticated_siswa_cta(): void
    {
        $siswa = Siswa::create([
            'nis' => '12345',
            'nama' => 'Budi Siswa',
            'kelas' => 'X',
            'jurusan' => 'RPL',
            'password' => bcrypt('password123'),
            'status' => 'aktif',
        ]);

        $response = $this->actingAs($siswa, 'siswa')->get('/');
        $response->assertStatus(200);
        $response->assertSee('Dashboard Siswa');
    }

    public function test_navbar_renders_authenticated_petugas_cta(): void
    {
        $petugas = User::create([
            'nama' => 'Pak Guru BK',
            'username' => 'petugasbk',
            'email' => 'bk@smktiairlangga.sch.id',
            'password' => bcrypt('password123'),
            'role' => 'petugas',
            'status' => 'aktif',
        ]);

        $response = $this->actingAs($petugas, 'web')->get('/');
        $response->assertStatus(200);
        $response->assertSee('Panel Petugas');
    }

    public function test_landing_page_contains_interactive_quiz(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('id="cek-mandiri"', false);
        $response->assertSee('id="quizStep1"', false);
        $response->assertSee('id="quizStep2"', false);
        $response->assertSee('id="quizStep3"', false);
        $response->assertSee('id="quizProgressBar"', false);
        $response->assertSee('id="quizResultContainer"', false);
        $response->assertSee('selectQuizAnswer(1', false);
        $response->assertSee('resetQuiz()', false);
    }

    public function test_landing_page_contains_hidden_bullying_infographic(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('id="edukasi"', false);
        $response->assertSee('Bentuk Bullying yang Sering Tak Disadari');
        $response->assertSee('Pengucilan &amp; Silent Treatment', false);
        $response->assertSee('Ejekan Berkedok');
        $response->assertSee('Cuma Bercanda');
        $response->assertSee('Gaslighting &amp; Manipulasi', false);
        $response->assertSee('Doxing &amp; Teror Akun Anonim', false);
    }

    public function test_landing_page_contains_bystander_5d_intervention_guide(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('id="panduan-saksi"', false);
        $response->assertSee('Melihat Bullying? Lakukan Metode 5D');
        $response->assertSee('1. DIRECT');
        $response->assertSee('2. DISTRACT');
        $response->assertSee('3. DELEGATE');
        $response->assertSee('4. DELAY');
        $response->assertSee('5. DOCUMENT');
        $response->assertSee('KOMITMEN UPSTANDER SMK TI AIRLANGGA');
    }

    public function test_landing_page_contains_faq_quick_search_and_filter(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('id="faqSearchInput"', false);
        $response->assertSee('id="faqSearchClear"', false);
        $response->assertSee('id="faqCategoryChips"', false);
        $response->assertSee('data-filter="all"', false);
        $response->assertSee('data-filter="kerahasiaan"', false);
        $response->assertSee('data-filter="penanganan"', false);
        $response->assertSee('data-filter="saksi"', false);
        $response->assertSee('data-filter="akun"', false);
        $response->assertSee('id="faqEmptyState"', false);
        $response->assertSee('id="faqResetBtn"', false);
    }

    public function test_landing_page_contains_bk_contact_and_footer(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('id="kontak"', false);
        $response->assertSee('Ruang Bimbingan Konseling');
        $response->assertSee('SMK TI Airlangga Samarinda');
        $response->assertSee('Seluruh Hak Cipta Dilindungi Undang-Undang');
    }
}
