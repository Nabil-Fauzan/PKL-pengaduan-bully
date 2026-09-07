<footer class="stipor-footer">
    <div class="container">
        <div class="row g-4 align-items-start">
            <div class="col-lg-5">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <div class="rounded-3 bg-primary text-white d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                        <i class="fas fa-shield-alt" style="font-size: 0.95rem;"></i>
                    </div>
                    <h5 class="mb-0 fw-bold text-white fs-6">STIPOR SMK TI AIRLANGGA</h5>
                </div>
                <p class="footer-desc mb-0" style="max-width: 420px; font-size: 0.85rem;">
                    Sistem Informasi Pengaduan &amp; Perlindungan Siswa SMK TI Airlangga Samarinda. Berkomitmen menjaga lingkungan sekolah tetap aman, beradab, dan bebas dari perundungan.
                </p>
            </div>

            <div class="col-6 col-lg-3">
                <h6 class="footer-heading">Navigasi</h6>
                <ul class="list-unstyled d-flex flex-column gap-1 mb-0" style="font-size: 0.85rem;">
                    <li><a href="#beranda"><i class="fas fa-chevron-right me-1 text-primary" style="font-size: 0.7rem;"></i> Beranda</a></li>
                    <li><a href="#tentang"><i class="fas fa-chevron-right me-1 text-primary" style="font-size: 0.7rem;"></i> Tentang STIPOR</a></li>
                    <li><a href="#kategori"><i class="fas fa-chevron-right me-1 text-primary" style="font-size: 0.7rem;"></i> Kategori Kasus</a></li>
                    <li><a href="#cek-mandiri"><i class="fas fa-chevron-right me-1 text-primary" style="font-size: 0.7rem;"></i> Cek Mandiri</a></li>
                    <li><a href="#alur"><i class="fas fa-chevron-right me-1 text-primary" style="font-size: 0.7rem;"></i> Alur Laporan</a></li>
                    <li><a href="#faq"><i class="fas fa-chevron-right me-1 text-primary" style="font-size: 0.7rem;"></i> FAQ &amp; Kontak</a></li>
                </ul>
            </div>

            <div class="col-6 col-lg-4">
                <h6 class="footer-heading">Akses Cepat</h6>
                <ul class="list-unstyled d-flex flex-column gap-1 mb-2" style="font-size: 0.85rem;">
                    <li><a href="{{ route('login') }}"><i class="fas fa-sign-in-alt me-1 text-primary"></i> Login Siswa</a></li>
                    <li><a href="{{ route('login') }}"><i class="fas fa-user-shield me-1 text-primary"></i> Login Petugas / Konselor BK</a></li>
                </ul>
                <span class="badge footer-official-badge px-3 py-2" style="font-size: 0.78rem;">
                    <i class="fas fa-check-double me-1 text-primary"></i> Layanan Resmi Sekolah
                </span>
            </div>
        </div>

        <div class="footer-bottom text-center">
            <p class="footer-copyright mb-0">
                &copy; {{ date('Y') }} <strong class="text-white">SMK TI Airlangga Samarinda</strong>. Seluruh Hak Cipta Dilindungi Undang-Undang.
            </p>
        </div>
    </div>
</footer>
