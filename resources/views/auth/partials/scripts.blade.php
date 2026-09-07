    <!-- Javascript Tab Switcher, Theme & Security Logic -->
    <script>
        function switchRole(role) {
            const tabSiswa = document.getElementById('tab-siswa');
            const tabPetugas = document.getElementById('tab-petugas');
            const fieldSiswa = document.getElementById('field-siswa');
            const fieldPetugas = document.getElementById('field-petugas');
            const roleInput = document.getElementById('role-input');

            // Set role value
            if (roleInput) roleInput.value = role;

            if (role === 'siswa') {
                if (tabSiswa) {
                    tabSiswa.className = "tab-pill-btn active";
                    tabSiswa.setAttribute('aria-selected', 'true');
                }
                if (tabPetugas) {
                    tabPetugas.className = "tab-pill-btn";
                    tabPetugas.setAttribute('aria-selected', 'false');
                }
                if (fieldSiswa) fieldSiswa.classList.remove('hidden');
                if (fieldPetugas) fieldPetugas.classList.add('hidden');
            } else {
                if (tabSiswa) {
                    tabSiswa.className = "tab-pill-btn";
                    tabSiswa.setAttribute('aria-selected', 'false');
                }
                if (tabPetugas) {
                    tabPetugas.className = "tab-pill-btn active";
                    tabPetugas.setAttribute('aria-selected', 'true');
                }
                if (fieldSiswa) fieldSiswa.classList.add('hidden');
                if (fieldPetugas) fieldPetugas.classList.remove('hidden');
            }
        }

        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const eyeOpen = document.getElementById('eye-open');
            const eyeClosed = document.getElementById('eye-closed');
            if (!passwordInput) return;

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                if (eyeOpen) eyeOpen.classList.add('hidden');
                if (eyeClosed) eyeClosed.classList.remove('hidden');
            } else {
                passwordInput.type = 'password';
                if (eyeOpen) eyeOpen.classList.remove('hidden');
                if (eyeClosed) eyeClosed.classList.add('hidden');
            }
        }

        // reCAPTCHA Dynamic Theme Logic
        let recaptchaWidgetId = null;

        function getActiveTheme() {
            return (document.body.classList.contains('dark-mode') || localStorage.getItem('dark-mode') === 'enabled') ? 'dark' : 'light';
        }

        function renderRecaptchaWidget(theme) {
            const wrapper = document.getElementById('recaptcha-wrapper');
            if (!wrapper) return;

            wrapper.innerHTML = '<div id="recaptcha-widget"></div>';

            if (typeof grecaptcha !== 'undefined' && grecaptcha.render) {
                try {
                    recaptchaWidgetId = grecaptcha.render('recaptcha-widget', {
                        'sitekey': '{{ config('services.recaptcha.sitekey') }}',
                        'theme': theme
                    });
                } catch (e) {
                    // Gracefully suppress console error in test environments
                }
            }
        }

        window.onRecaptchaLoad = function() {
            renderRecaptchaWidget(getActiveTheme());
        };

        // Dark Mode Switcher Logic
        const darkModeToggle = document.getElementById('dark-mode-toggle');
        const sunIcon = document.getElementById('sun-icon');
        const moonIcon = document.getElementById('moon-icon');

        function enableDarkMode() {
            document.body.classList.add('dark-mode');
            document.documentElement.classList.add('dark');
            if (sunIcon && moonIcon) {
                sunIcon.classList.remove('hidden');
                moonIcon.classList.add('hidden');
            }
            localStorage.setItem('dark-mode', 'enabled');
            localStorage.setItem('stipor_theme', 'dark');
            renderRecaptchaWidget('dark');
        }

        function disableDarkMode() {
            document.body.classList.remove('dark-mode');
            document.documentElement.classList.remove('dark');
            if (sunIcon && moonIcon) {
                sunIcon.classList.add('hidden');
                moonIcon.classList.remove('hidden');
            }
            localStorage.setItem('dark-mode', 'disabled');
            localStorage.setItem('stipor_theme', 'light');
            renderRecaptchaWidget('light');
        }

        if (darkModeToggle) {
            darkModeToggle.addEventListener('click', () => {
                if (document.body.classList.contains('dark-mode')) {
                    disableDarkMode();
                } else {
                    enableDarkMode();
                }
            });
        }

        if (localStorage.getItem('dark-mode') === 'enabled' || localStorage.getItem('stipor_theme') === 'dark') {
            enableDarkMode();
        }

        // Safety fallback: if reCAPTCHA script loaded before callback bound
        document.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
                if (typeof grecaptcha !== 'undefined' && grecaptcha.render && !recaptchaWidgetId) {
                    renderRecaptchaWidget(getActiveTheme());
                }
            }, 300);
        });
    </script>
    
    <!-- reCAPTCHA API with explicit render callback (Loaded at body end for optimal performance) -->
    <script src="https://www.google.com/recaptcha/api.js?onload=onRecaptchaLoad&render=explicit" async defer></script>
