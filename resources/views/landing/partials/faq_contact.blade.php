<section id="faq" class="section-py bg-light">
    <div class="container">
        <div class="row g-5">
            <!-- Left: FAQ Accordion -->
            <div class="col-lg-7" data-aos="fade-right">
                <span class="section-tag">TANYA JAWAB (FAQ)</span>
                <h2 class="section-title mb-4">Pertanyaan yang Sering Diajukan</h2>
                
                <div class="accordion" id="stiporFaqAccordion">
                    <div class="accordion-item">
                        <h3 class="accordion-header" id="faqHeadingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseOne" aria-expanded="true" aria-controls="faqCollapseOne">
                                Apakah identitas saya sebagai pelapor dijamin aman?
                            </button>
                        </h3>
                        <div id="faqCollapseOne" class="accordion-collapse collapse show" aria-labelledby="faqHeadingOne" data-bs-parent="#stiporFaqAccordion">
                            <div class="accordion-body">
                                <strong>Ya, 100% aman dan rahasia.</strong> Laporan Anda hanya dapat diakses oleh Guru BK yang bertugas menangani kasus. Pelaku maupun teman sekelas tidak akan mengetahui siapa yang membuat laporan.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h3 class="accordion-header" id="faqHeadingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseTwo" aria-expanded="false" aria-controls="faqCollapseTwo">
                                Berapa lama laporan saya akan ditanggapi?
                            </button>
                        </h3>
                        <div id="faqCollapseTwo" class="accordion-collapse collapse" aria-labelledby="faqHeadingTwo" data-bs-parent="#stiporFaqAccordion">
                            <div class="accordion-body">
                                Setiap laporan yang masuk akan diverifikasi oleh Tim BK maksimal <strong>1x24 jam kerja</strong>. Anda dapat melihat progres dan tanggapan langsung di portal siswa Anda.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h3 class="accordion-header" id="faqHeadingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseThree" aria-expanded="false" aria-controls="faqCollapseThree">
                                Apakah saya boleh melaporkan kejadian yang menimpa teman saya?
                            </button>
                        </h3>
                        <div id="faqCollapseThree" class="accordion-collapse collapse" aria-labelledby="faqHeadingThree" data-bs-parent="#stiporFaqAccordion">
                            <div class="accordion-body">
                                <strong>Sangat boleh dan dianjurkan!</strong> Sebagai saksi (upstander), kepedulian Anda dapat menyelamatkan teman Anda dari dampak buruk perundungan yang berkepanjangan.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h3 class="accordion-header" id="faqHeadingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseFour" aria-expanded="false" aria-controls="faqCollapseFour">
                                Bagaimana jika saya lupa password akun siswa saya?
                            </button>
                        </h3>
                        <div id="faqCollapseFour" class="accordion-collapse collapse" aria-labelledby="faqHeadingFour" data-bs-parent="#stiporFaqAccordion">
                            <div class="accordion-body">
                                Anda dapat langsung datang ke Ruang BK atau menghubungi Tim Administrator Sekolah untuk melakukan reset password akun dengan menunjukkan kartu pelajar.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Contact Card -->
            <div class="col-lg-5" id="kontak" data-aos="fade-left">
                <span class="section-tag">KONTAK LANGSUNG</span>
                <h2 class="section-title mb-4">Ruang Bimbingan Konseling</h2>

                <div class="contact-info-card">
                    <div class="d-flex align-items-start gap-3 mb-4">
                        <div class="contact-icon-box">
                            <i class="fas fa-map-marker-alt fs-5"></i>
                        </div>
                        <div>
                            <h3 class="h6 fw-bold mb-1">Alamat Sekolah:</h3>
                            <p class="text-muted mb-0" style="font-size: 0.9rem;">
                                Jl. Pahlawan No. 2A, Kel. Dadi Mulya, Kec. Samarinda Ulu, Kota Samarinda, Kalimantan Timur 75123.
                            </p>
                        </div>
                    </div>

                    <div class="d-flex align-items-start gap-3 mb-4">
                        <div class="contact-icon-box">
                            <i class="fas fa-clock fs-5"></i>
                        </div>
                        <div>
                            <h3 class="h6 fw-bold mb-1">Jam Konseling Tatap Muka:</h3>
                            <p class="text-muted mb-0" style="font-size: 0.9rem;">
                                Senin - Jumat: 07.30 - 15.30 WITA<br>
                                (Bisa langsung berkunjung di Ruang BK Lantai 1)
                            </p>
                        </div>
                    </div>

                    <div class="d-flex align-items-start gap-3 mb-4">
                        <div class="contact-icon-box success">
                            <i class="fas fa-phone-alt fs-5"></i>
                        </div>
                        <div>
                            <h3 class="h6 fw-bold mb-1">Hotline &amp; WhatsApp BK:</h3>
                            <p class="text-muted mb-0" style="font-size: 0.9rem;">
                                (0541) 732644 / +62 812-3456-7890
                            </p>
                        </div>
                    </div>

                    <a href="{{ route('login') }}" class="btn btn-stipor-primary w-100 py-2">
                        <i class="fas fa-bullhorn me-2"></i> Laporkan Masalah Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
