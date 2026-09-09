<footer class="stipor-footer">
    <div class="container">
        <div class="row g-4 justify-content-between align-items-start">
            <!-- Col 1: Brand & School Mission -->
            <div class="col-lg-4 col-md-6 mb-2 mb-lg-0">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div class="rounded-3 bg-primary text-white d-flex align-items-center justify-content-center flex-shrink-0" style="width: 36px; height: 36px; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.35);">
                        <i class="fas fa-shield-alt fs-6"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-white fs-6 lh-1">STIPOR</h5>
                        <small class="d-block mt-1 text-white-50" style="font-size: 0.72rem; font-weight: 600; letter-spacing: 0.04em;">SMK TI AIRLANGGA SAMARINDA</small>
                    </div>
                </div>
                <p class="footer-desc mb-3" style="font-size: 0.86rem; color: #cbd5e1;">
                    Website pelaporan pengaduan dan perlindungan perundungan resmi sekolah. Menjamin kerahasiaan 100%, cepat ditindaklanjuti, dan didampingi langsung oleh Tim Guru BK.
                </p>
                <div class="d-flex flex-wrap gap-2 pt-1">
                    <span class="badge rounded-pill px-3 py-1.5" style="background: rgba(37, 99, 235, 0.25); color: #93c5fd; border: 1px solid rgba(59, 130, 246, 0.4); font-size: 0.76rem; font-weight: 600;">
                        <i class="fas fa-user-shield me-1" style="color: #60a5fa;"></i> 100% Rahasia
                    </span>
                    <span class="badge rounded-pill px-3 py-1.5" style="background: rgba(16, 185, 129, 0.25); color: #86efac; border: 1px solid rgba(16, 185, 129, 0.4); font-size: 0.76rem; font-weight: 600;">
                        <i class="fas fa-check-circle me-1" style="color: #34d399;"></i> Respon &lt; 24 Jam
                    </span>
                </div>
            </div>

            <!-- Col 2: Main Navigation -->
            <div class="col-6 col-lg-2 col-md-3">
                <h6 class="footer-heading">
                    <i class="fas fa-compass me-1" style="color: #60a5fa;"></i> Navigasi
                </h6>
                <ul class="list-unstyled d-flex flex-column gap-1 mb-0" style="font-size: 0.86rem;">
                    <li><a href="#beranda" class="footer-nav-link"><i class="fas fa-chevron-right me-1" style="color: #60a5fa; font-size: 0.7rem;"></i> Beranda</a></li>
                    <li><a href="#tentang" class="footer-nav-link"><i class="fas fa-chevron-right me-1" style="color: #60a5fa; font-size: 0.7rem;"></i> Tentang STIPOR</a></li>
                    <li><a href="#komitmen" class="footer-nav-link"><i class="fas fa-chevron-right me-1" style="color: #60a5fa; font-size: 0.7rem;"></i> Komitmen Pimpinan</a></li>
                    <li><a href="#kategori" class="footer-nav-link"><i class="fas fa-chevron-right me-1" style="color: #60a5fa; font-size: 0.7rem;"></i> Kategori Kasus</a></li>
                    <li><a href="#alur" class="footer-nav-link"><i class="fas fa-chevron-right me-1" style="color: #60a5fa; font-size: 0.7rem;"></i> Alur Penanganan</a></li>
                </ul>
            </div>

            <!-- Col 3: Education & Resources -->
            <div class="col-6 col-lg-3 col-md-3">
                <h6 class="footer-heading">
                    <i class="fas fa-book-open me-1" style="color: #60a5fa;"></i> Edukasi &amp; Bantuan
                </h6>
                <ul class="list-unstyled d-flex flex-column gap-1 mb-0" style="font-size: 0.86rem;">
                    <li><a href="#edukasi" class="footer-nav-link"><i class="fas fa-chevron-right me-1" style="color: #60a5fa; font-size: 0.7rem;"></i> Bentuk Bullying</a></li>
                    <li><a href="#panduan-saksi" class="footer-nav-link"><i class="fas fa-chevron-right me-1" style="color: #60a5fa; font-size: 0.7rem;"></i> Panduan Saksi (5D)</a></li>
                    <li><a href="#cek-mandiri" class="footer-nav-link"><i class="fas fa-chevron-right me-1" style="color: #60a5fa; font-size: 0.7rem;"></i> Cek Mandiri (Kuis)</a></li>
                    <li><a href="#faq" class="footer-nav-link"><i class="fas fa-chevron-right me-1" style="color: #60a5fa; font-size: 0.7rem;"></i> FAQ &amp; Tanya Jawab</a></li>
                    <li><a href="#kontak" class="footer-nav-link"><i class="fas fa-chevron-right me-1" style="color: #60a5fa; font-size: 0.7rem;"></i> Kontak Ruang BK</a></li>
                </ul>
            </div>

            <!-- Col 4: Quick Portals & Contact Callout -->
            <div class="col-lg-3 col-md-12 mt-3 mt-lg-0">
                <h6 class="footer-heading">
                    <i class="fas fa-link me-1" style="color: #60a5fa;"></i> Akses Portal
                </h6>
                <div class="d-flex flex-column gap-2 mb-3">
                    <a href="{{ route('login') }}" class="footer-portal-card">
                        <span class="d-flex align-items-center gap-2">
                            <i class="fas fa-user-graduate" style="color: #60a5fa;"></i> Login Siswa
                        </span>
                        <i class="fas fa-arrow-right text-white-50 small"></i>
                    </a>
                    <a href="{{ route('login') }}" class="footer-portal-card">
                        <span class="d-flex align-items-center gap-2">
                            <i class="fas fa-user-shield" style="color: #fbbf24;"></i> Login Petugas / BK
                        </span>
                        <i class="fas fa-arrow-right text-white-50 small"></i>
                    </a>
                </div>

                <!-- Emergency Contact Widget -->
                <div class="footer-hotline-box d-flex align-items-center gap-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 38px; height: 38px; background: rgba(239, 68, 68, 0.25); color: #fca5a5; border: 1px solid rgba(239, 68, 68, 0.4);">
                        <i class="fas fa-phone-alt fs-6"></i>
                    </div>
                    <div style="font-size: 0.82rem;">
                        <span class="text-white fw-bold d-block">Hotline Siaga BK</span>
                        <a href="tel:0541741864" class="text-white-50 text-decoration-none" style="transition: color 0.2s ease;">(0541) 741864</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Bottom Bar -->
        <div class="footer-bottom d-flex flex-column flex-md-row align-items-center justify-content-between gap-2 text-center text-md-start">
            <p class="footer-copyright mb-0 text-white-50">
                &copy; {{ date('Y') }} <strong class="text-white">SMK TI Airlangga Samarinda</strong>. Seluruh Hak Cipta Dilindungi Undang-Undang.
            </p>
            <div class="d-flex align-items-center gap-3 text-white-50" style="font-size: 0.8rem;">
                <span><i class="fas fa-shield-alt me-1" style="color: #60a5fa;"></i> Bebas Bullying</span>
                <span>•</span>
                <span><i class="fas fa-heart me-1" style="color: #f87171;"></i> Sekolah Ramah Siswa</span>
            </div>
        </div>
    </div>
</footer>
