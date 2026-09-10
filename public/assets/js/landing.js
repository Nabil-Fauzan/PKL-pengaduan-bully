// Interactive Bullying Assessment Quiz
        let quizAnswers = {};

        window.selectQuizAnswer = function (step, score) {
            quizAnswers[step] = score;
            const currentStepEl = document.getElementById('quizStep' + step);
            const nextStepEl = document.getElementById('quizStep' + (step + 1));
            const progressBar = document.getElementById('quizProgressBar');
            const stepText = document.getElementById('quizStepText');
            const percentText = document.getElementById('quizPercentText');

            if (currentStepEl) currentStepEl.classList.add('d-none');

            if (step < 3 && nextStepEl) {
                nextStepEl.classList.remove('d-none');
                const nextPercent = Math.round(((step + 1) / 3) * 100);
                if (progressBar) progressBar.style.width = nextPercent + '%';
                if (stepText) stepText.textContent = 'Pertanyaan ' + (step + 1) + ' dari 3';
                if (percentText) percentText.textContent = nextPercent + '% Selesai';
            } else {
                showQuizResult();
            }
        };

        function showQuizResult() {
            const questionsContainer = document.getElementById('quizQuestionsContainer');
            const resultContainer = document.getElementById('quizResultContainer');
            const resultTitle = document.getElementById('quizResultTitle');
            const resultDesc = document.getElementById('quizResultDesc');
            const resultIconBox = document.getElementById('quizResultIconBox');
            const actionBtn = document.getElementById('quizActionBtn');
            const progressBar = document.getElementById('quizProgressBar');
            const stepText = document.getElementById('quizStepText');
            const percentText = document.getElementById('quizPercentText');

            if (progressBar) progressBar.style.width = '100%';
            if (stepText) stepText.textContent = 'Hasil Analisis Cek Mandiri';
            if (percentText) percentText.textContent = '100% Selesai';
            if (questionsContainer) questionsContainer.classList.add('d-none');
            if (resultContainer) resultContainer.classList.remove('d-none');

            const totalScore = (quizAnswers[1] || 0) + (quizAnswers[2] || 0) + (quizAnswers[3] || 0);

            if (totalScore >= 4) {
                resultIconBox.innerHTML = '<div class="rounded-circle bg-danger bg-opacity-10 text-danger d-inline-flex p-3 fs-2"><i class="fas fa-exclamation-triangle"></i></div>';
                resultTitle.textContent = 'Indikasi Kuat Tindakan Perundungan (Bullying)';
                resultTitle.className = 'fw-bold mb-2 text-danger';
                resultDesc.textContent = 'Situasi yang kamu alami memiliki unsur intimidasi, ketimpangan kuasa, atau perlakuan berulang yang merugikanmu. Kamu tidak sendiri, jangan ragu untuk melaporkannya sekarang melalui STIPOR. Identitasmu dijamin 100% aman dan rahasia.';
                actionBtn.href = "/login";
                actionBtn.innerHTML = '<i class="fas fa-bullhorn me-2"></i> Laporkan ke Guru BK Sekarang';
                actionBtn.className = 'btn btn-danger px-4 py-2';
            } else if (totalScore >= 2) {
                resultIconBox.innerHTML = '<div class="rounded-circle bg-warning bg-opacity-10 text-warning d-inline-flex p-3 fs-2"><i class="fas fa-info-circle"></i></div>';
                resultTitle.textContent = 'Potensi Konflik / Perundungan Ringan';
                resultTitle.className = 'fw-bold mb-2 text-warning';
                resultDesc.textContent = 'Ada indikasi ketidaknyamanan sosial atau perlakuan yang mengarah ke perundungan. Kami sarankan kamu berkonsultasi atau bercerita langsung dengan Guru BK untuk mencegah situasi ini berlanjut.';
                actionBtn.href = "/login";
                actionBtn.innerHTML = '<i class="fas fa-comments me-2"></i> Konsultasi ke Ruang BK';
                actionBtn.className = 'btn btn-warning px-4 py-2 text-dark fw-semibold';
            } else {
                resultIconBox.innerHTML = '<div class="rounded-circle bg-success bg-opacity-10 text-success d-inline-flex p-3 fs-2"><i class="fas fa-check-circle"></i></div>';
                resultTitle.textContent = 'Tampaknya Bukan Tindak Perundungan Berat';
                resultTitle.className = 'fw-bold mb-2 text-success';
                resultDesc.textContent = 'Berdasarkan jawabanmu, situasi ini mungkin merupakan kesalahpahaman antarteman biasa. Namun jika di kemudian hari kamu merasa terancam, STIPOR dan Guru BK selalu siap membantumu.';
                actionBtn.href = "#kontak";
                actionBtn.innerHTML = '<i class="fas fa-phone-alt me-2"></i> Info Kontak Ruang BK';
                actionBtn.className = 'btn btn-stipor-primary px-4 py-2';
            }
        }

        window.resetQuiz = function () {
            quizAnswers = {};
            for (let i = 1; i <= 3; i++) {
                const stepEl = document.getElementById('quizStep' + i);
                if (stepEl) {
                    if (i === 1) stepEl.classList.remove('d-none');
                    else stepEl.classList.add('d-none');
                }
            }
            const questionsContainer = document.getElementById('quizQuestionsContainer');
            const resultContainer = document.getElementById('quizResultContainer');
            const progressBar = document.getElementById('quizProgressBar');
            const stepText = document.getElementById('quizStepText');
            const percentText = document.getElementById('quizPercentText');

            if (questionsContainer) questionsContainer.classList.remove('d-none');
            if (resultContainer) resultContainer.classList.add('d-none');
            if (progressBar) progressBar.style.width = '33%';
            if (stepText) stepText.textContent = 'Pertanyaan 1 dari 3';
            if (percentText) percentText.textContent = '33% Selesai';
        };

        document.addEventListener('DOMContentLoaded', function () {
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true,
                mirror: false
            });

            // Theme Toggle Logic (Multi-button support for desktop and mobile)
            const themeToggleBtns = document.querySelectorAll('.theme-toggle-btn');
            const themeIcons = document.querySelectorAll('.theme-icon');

            function syncThemeIcon(theme) {
                themeIcons.forEach(icon => {
                    if (theme === 'dark') {
                        icon.className = 'fas fa-sun text-warning theme-icon';
                    } else {
                        icon.className = 'fas fa-moon text-secondary theme-icon';
                    }
                });
                themeToggleBtns.forEach(btn => {
                    btn.setAttribute('title', theme === 'dark' ? 'Beralih ke Mode Terang' : 'Beralih ke Mode Gelap');
                });
            }

            const currentTheme = document.documentElement.getAttribute('data-bs-theme') || 'light';
            syncThemeIcon(currentTheme);

            themeToggleBtns.forEach(btn => {
                btn.addEventListener('click', function () {
                    const activeTheme = document.documentElement.getAttribute('data-bs-theme');
                    const targetTheme = activeTheme === 'dark' ? 'light' : 'dark';
                    document.documentElement.setAttribute('data-bs-theme', targetTheme);
                    localStorage.setItem('stipor_theme', targetTheme);
                    localStorage.setItem('dark-mode', targetTheme === 'dark' ? 'enabled' : 'disabled');
                    syncThemeIcon(targetTheme);
                });
            });

            // Back to Top Button
            const backToTop = document.getElementById('backToTop');
            if (backToTop) {
                let scrollTicking = false;
                window.addEventListener('scroll', function () {
                    if (!scrollTicking) {
                        window.requestAnimationFrame(function () {
                            if (window.scrollY > 350) {
                                backToTop.classList.add('show');
                            } else {
                                backToTop.classList.remove('show');
                            }
                            scrollTicking = false;
                        });
                        scrollTicking = true;
                    }
                }, { passive: true });
            }

            // Auto-close mobile navbar on link click
            const navLinks = document.querySelectorAll('.navbar-nav .nav-link:not(.dropdown-toggle), .dropdown-menu .dropdown-item');
            const navbarCollapse = document.getElementById('navbarStiporNav');
            if (navbarCollapse) {
                navLinks.forEach(function (link) {
                    link.addEventListener('click', function () {
                        if (window.innerWidth < 992 && navbarCollapse.classList.contains('show')) {
                            const bsCollapse = bootstrap.Collapse.getInstance(navbarCollapse) || new bootstrap.Collapse(navbarCollapse);
                            bsCollapse.hide();
                        }
                    });
                });
            }

            // Instant FAQ Search and Category Filter
            const faqSearchInput = document.getElementById('faqSearchInput');
            const faqSearchClear = document.getElementById('faqSearchClear');
            const faqCategoryChips = document.querySelectorAll('#faqCategoryChips .faq-chip');
            const faqItems = document.querySelectorAll('.faq-item');
            const faqEmptyState = document.getElementById('faqEmptyState');
            const faqResultCount = document.getElementById('faqSearchResultCount');
            const faqMatchText = document.getElementById('faqMatchText');
            const faqResetBtn = document.getElementById('faqResetBtn');

            let currentCategoryFilter = 'all';

            function filterFaqs() {
                const query = (faqSearchInput ? faqSearchInput.value : '').toLowerCase().trim();
                let visibleCount = 0;

                faqItems.forEach(item => {
                    const text = item.textContent.toLowerCase();
                    const itemCategories = (item.getAttribute('data-category') || '').toLowerCase();
                    
                    const matchCategory = currentCategoryFilter === 'all' || itemCategories.includes(currentCategoryFilter);
                    const matchQuery = !query || text.includes(query);

                    if (matchCategory && matchQuery) {
                        item.classList.remove('d-none');
                        visibleCount++;

                        // Automatically open matching accordion if user is searching with text
                        if (query.length > 2) {
                            const collapseEl = item.querySelector('.accordion-collapse');
                            const buttonEl = item.querySelector('.accordion-button');
                            if (collapseEl && !collapseEl.classList.contains('show')) {
                                const bsCollapse = bootstrap.Collapse.getInstance(collapseEl) || new bootstrap.Collapse(collapseEl, { toggle: false });
                                bsCollapse.show();
                                if (buttonEl) buttonEl.classList.remove('collapsed');
                            }
                        }
                    } else {
                        item.classList.add('d-none');
                    }
                });

                // Clear button visibility
                if (faqSearchClear) {
                    if (query.length > 0) faqSearchClear.classList.remove('d-none');
                    else faqSearchClear.classList.add('d-none');
                }

                // Empty state and counter
                if (faqEmptyState) {
                    if (visibleCount === 0) {
                        faqEmptyState.classList.remove('d-none');
                    } else {
                        faqEmptyState.classList.add('d-none');
                    }
                }

                if (faqResultCount && faqMatchText) {
                    if (query.length > 0 || currentCategoryFilter !== 'all') {
                        faqResultCount.classList.remove('d-none');
                        faqMatchText.textContent = `Menampilkan ${visibleCount} dari ${faqItems.length} pertanyaan`;
                    } else {
                        faqResultCount.classList.add('d-none');
                    }
                }
            }

            if (faqSearchInput) {
                faqSearchInput.addEventListener('input', filterFaqs);
            }

            if (faqSearchClear) {
                faqSearchClear.addEventListener('click', function() {
                    faqSearchInput.value = '';
                    filterFaqs();
                    faqSearchInput.focus();
                });
            }

            faqCategoryChips.forEach(chip => {
                chip.addEventListener('click', function() {
                    faqCategoryChips.forEach(c => c.classList.remove('active'));
                    this.classList.add('active');
                    currentCategoryFilter = this.getAttribute('data-filter');
                    filterFaqs();
                });
            });

            if (faqResetBtn) {
                faqResetBtn.addEventListener('click', function() {
                    if (faqSearchInput) faqSearchInput.value = '';
                    currentCategoryFilter = 'all';
                    faqCategoryChips.forEach(c => {
                        if (c.getAttribute('data-filter') === 'all') c.classList.add('active');
                        else c.classList.remove('active');
                    });
                    filterFaqs();
                });
            }

            // Initialize Bootstrap Tooltips (For Category Examples & Info Badges)
            if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
                const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                tooltipTriggerList.map(function (tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl, {
                        boundary: document.body
                    });
                });
            }

            // Copy Phone Hotline Handler with Feedback Animation
            const copyPhoneBtns = document.querySelectorAll('.btn-copy-phone');
            copyPhoneBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const phone = this.getAttribute('data-phone') || '(0541) 741864';
                    const label = this.querySelector('.copy-label');
                    const icon = this.querySelector('i');

                    navigator.clipboard.writeText(phone).then(() => {
                        if (label) label.textContent = 'Tersalin!';
                        if (icon) icon.className = 'fas fa-check text-success';
                        this.classList.add('border-success', 'text-success');

                        setTimeout(() => {
                            if (label) label.textContent = 'Salin Nomor';
                            if (icon) icon.className = 'fas fa-copy';
                            this.classList.remove('border-success', 'text-success');
                        }, 2200);
                    }).catch(() => {
                        // Fallback
                        const tempInput = document.createElement('input');
                        tempInput.value = phone;
                        document.body.appendChild(tempInput);
                        tempInput.select();
                        document.execCommand('copy');
                        document.body.removeChild(tempInput);

                        if (label) label.textContent = 'Tersalin!';
                        setTimeout(() => {
                            if (label) label.textContent = 'Salin Nomor';
                        }, 2200);
                    });
                });
            });
        });
