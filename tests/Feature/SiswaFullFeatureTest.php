<?php

namespace Tests\Feature;

use App\Models\Pengaduan;
use App\Models\Siswa;
use App\Models\Tanggapan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class SiswaFullFeatureTest extends TestCase
{
    use RefreshDatabase;

    private Siswa $siswa;
    private Siswa $siswaLain;
    private User $guruBk;

    protected function setUp(): void
    {
        parent::setUp();

        $this->siswa = Siswa::create([
            'nis' => '10001',
            'nama' => 'Ahmad Siswa',
            'kelas' => 'XII',
            'jurusan' => 'RPL',
            'password' => Hash::make('password123'),
            'status' => 'aktif',
        ]);

        $this->siswaLain = Siswa::create([
            'nis' => '10002',
            'nama' => 'Rizky Siswa',
            'kelas' => 'XI',
            'jurusan' => 'DKV',
            'password' => Hash::make('password123'),
            'status' => 'aktif',
        ]);

        $this->guruBk = User::create([
            'nama' => 'Ibu Rahmawati, S.Pd',
            'username' => 'konselor_bk',
            'email' => 'bk@smktiairlangga.sch.id',
            'password' => Hash::make('password123'),
            'role' => 'petugas',
            'status' => 'aktif',
        ]);
    }

    /**
     * 1. Dashboard View & UI Components
     */
    public function test_siswa_can_view_dashboard_with_all_components(): void
    {
        $response = $this->actingAs($this->siswa, 'siswa')->get('/dashboard');

        $response->assertStatus(200);
        $response->assertSee('Ahmad Siswa');
        $response->assertSee('10001');
        $response->assertSee('XII');
        $response->assertSee('RPL');
        $response->assertSee('Total Pengaduan');
        $response->assertSee('Dalam Proses');
        $response->assertSee('Laporan Selesai');
        $response->assertSee('Semua');
        $response->assertSee('Bullying');
        $response->assertSee('Fasilitas');
        $response->assertSee('Akademik');
        $response->assertSee('Kutipan Hari Ini');
    }

    /**
     * 2. Dashboard Statistics & Card Feed
     */
    public function test_siswa_dashboard_calculates_statistics_and_renders_cards(): void
    {
        // Create 3 complaints with different statuses
        Pengaduan::create([
            'id_siswa' => $this->siswa->id_siswa,
            'judul' => 'Laporan Bullying Fisik',
            'kategori' => 'bullying',
            'isi_pengaduan' => 'Kronologi bullying...',
            'status' => 'baru',
            'tanggal_pengaduan' => now(),
        ]);

        Pengaduan::create([
            'id_siswa' => $this->siswa->id_siswa,
            'judul' => 'Laporan Fasilitas Rusak',
            'kategori' => 'fasilitas',
            'isi_pengaduan' => 'Kursi patah di lab...',
            'status' => 'diproses',
            'tanggal_pengaduan' => now(),
        ]);

        Pengaduan::create([
            'id_siswa' => $this->siswa->id_siswa,
            'judul' => 'Laporan Sengketa Nilai',
            'kategori' => 'akademik',
            'isi_pengaduan' => 'Sudah dimediasi...',
            'status' => 'selesai',
            'tanggal_pengaduan' => now(),
        ]);

        $response = $this->actingAs($this->siswa, 'siswa')->get('/dashboard');

        $response->assertStatus(200);
        $response->assertSee('Laporan Bullying Fisik');
        $response->assertSee('Laporan Fasilitas Rusak');
        $response->assertSee('Laporan Sengketa Nilai');
    }

    /**
     * 3. Overdue (>3 Days) Complaint Warning Badge
     */
    public function test_siswa_dashboard_displays_terabaikan_badge_for_overdue_complaints(): void
    {
        $overdueComplaint = Pengaduan::create([
            'id_siswa' => $this->siswa->id_siswa,
            'judul' => 'Laporan Lama Belum Direspon',
            'kategori' => 'bullying',
            'isi_pengaduan' => 'Sudah 4 hari...',
            'status' => 'baru',
            'tanggal_pengaduan' => now()->subDays(4),
        ]);

        $this->assertTrue($overdueComplaint->isTerabaikan());

        $response = $this->actingAs($this->siswa, 'siswa')->get('/dashboard');
        $response->assertStatus(200);
        $response->assertSee('Terabaikan');
    }

    /**
     * 4. Empty State When No Complaints
     */
    public function test_siswa_dashboard_renders_empty_state_when_no_complaints(): void
    {
        $response = $this->actingAs($this->siswa, 'siswa')->get('/dashboard');
        $response->assertStatus(200);
        $response->assertSee('Tidak Ada Laporan');
        $response->assertSee('Tulis Laporan Pertama');
    }

    /**
     * 5. Form Buat Pengaduan Page
     */
    public function test_siswa_can_access_create_form_with_guidelines(): void
    {
        $response = $this->actingAs($this->siswa, 'siswa')->get('/dashboard/pengaduan/tambah');

        $response->assertStatus(200);
        $response->assertSee('Tulis Pengaduan Baru');
        $response->assertSee('PENTING: Laporan Tidak Dapat Diubah/Dihapus!');
        $response->assertSee('Judul Laporan');
        $response->assertSee('Kategori Laporan');
        $response->assertSee('Isi Laporan / Detail Kejadian');
    }

    /**
     * 6. Form Validation on Create Complaint
     */
    public function test_siswa_validation_errors_when_creating_complaint(): void
    {
        $response = $this->actingAs($this->siswa, 'siswa')->post('/dashboard/pengaduan/simpan', []);

        $response->assertSessionHasErrors(['judul', 'kategori', 'isi_pengaduan']);
    }

    /**
     * 7. Successful Complaint Submission
     */
    public function test_siswa_can_create_complaint_successfully(): void
    {
        $response = $this->actingAs($this->siswa, 'siswa')->post('/dashboard/pengaduan/simpan', [
            'judul' => 'Cyberbullying di Grup WhatsApp',
            'kategori' => 'bullying',
            'isi_pengaduan' => 'Menerima teror dan kata-kata kasar di media sosial.',
        ]);

        $response->assertRedirect('/dashboard');
        $response->assertSessionHas('success_message');

        $complaint = Pengaduan::where('judul', 'Cyberbullying di Grup WhatsApp')->first();
        $this->assertNotNull($complaint);
        $this->assertEquals($this->siswa->id_siswa, $complaint->id_siswa);
        $this->assertEquals('bullying', $complaint->kategori);
        $this->assertEquals('baru', $complaint->status);
    }

    /**
     * 8. Complaint Submission with Custom Category (Lainnya)
     */
    public function test_siswa_can_create_complaint_with_kategori_lainnya(): void
    {
        $response = $this->actingAs($this->siswa, 'siswa')->post('/dashboard/pengaduan/simpan', [
            'judul' => 'Masalah Fasilitas Lapangan Basket',
            'kategori' => 'lainnya',
            'kategori_lainnya' => 'Fasilitas Olahraga',
            'isi_pengaduan' => 'Ring basket patah dan membahayakan siswa saat jam PJOK.',
        ]);

        $response->assertRedirect('/dashboard');
        $response->assertSessionHas('success_message');

        $complaint = Pengaduan::where('judul', 'Masalah Fasilitas Lapangan Basket')->first();
        $this->assertNotNull($complaint);
        $this->assertStringContainsString('[Kategori Lainnya: Fasilitas Olahraga]', $complaint->isi_pengaduan);
    }

    /**
     * 9. Detail Pengaduan & Response Timeline
     */
    public function test_siswa_can_view_complaint_detail_with_officer_response(): void
    {
        $complaint = Pengaduan::create([
            'id_siswa' => $this->siswa->id_siswa,
            'judul' => 'Laporan Pemalakan',
            'kategori' => 'bullying',
            'isi_pengaduan' => 'Uang jajan diambil secara paksa di kantin.',
            'status' => 'diproses',
            'id_petugas' => $this->guruBk->id_user,
            'tanggal_pengaduan' => now(),
        ]);

        Tanggapan::create([
            'id_pengaduan' => $complaint->id_pengaduan,
            'id_user' => $this->guruBk->id_user,
            'status_pengaduan' => 'diproses',
            'isi_tanggapan' => 'Kasus sudah diagendakan untuk konseling mediasi bersama wali kelas.',
            'tanggal_tanggapan' => now(),
        ]);

        $response = $this->actingAs($this->siswa, 'siswa')->get("/dashboard/pengaduan/{$complaint->id_pengaduan}");

        $response->assertStatus(200);
        $response->assertSee('Laporan Pemalakan');
        $response->assertSee('Uang jajan diambil secara paksa');
        $response->assertSee('Ibu Rahmawati, S.Pd');
        $response->assertSee('Kasus sudah diagendakan untuk konseling mediasi');
        $response->assertSee('Kembali ke Dashboard');
        $response->assertSee('Progres Penanganan Kasus');
    }

    /**
     * 10. IDOR Security Protection (Cannot view other student's complaint)
     */
    public function test_siswa_cannot_access_other_students_complaint(): void
    {
        $otherComplaint = Pengaduan::create([
            'id_siswa' => $this->siswaLain->id_siswa,
            'judul' => 'Laporan Rahasia Siswa Lain',
            'kategori' => 'bullying',
            'isi_pengaduan' => 'Data sensitif siswa lain.',
            'status' => 'baru',
            'tanggal_pengaduan' => now(),
        ]);

        // Attempt to access other student's complaint
        $response = $this->actingAs($this->siswa, 'siswa')->get("/dashboard/pengaduan/{$otherComplaint->id_pengaduan}");

        // Must return 404 (Not Found via scoped query)
        $response->assertStatus(404);
    }
}
