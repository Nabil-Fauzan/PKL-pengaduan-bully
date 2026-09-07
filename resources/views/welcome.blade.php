<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>STIPOR - Layanan Pengaduan Bullying SMK TI Airlangga Samarinda</title>
    <meta name="description" content="Sistem Informasi Pelaporan Bullying dan Pengaduan Siswa Resmi SMK TI Airlangga Samarinda. 100% Rahasia, Cepat, dan Didampingi Guru BK Profesional.">

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

    <!-- Google Fonts (Poppins, Marcellus & Plus Jakarta Sans) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Marcellus&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3.3 CSS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Font Awesome 5 (Local Project Assets + CDN Fallback) -->
    <link rel="stylesheet" href="{{ asset('assets-template/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- AOS (Animate on Scroll) CSS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <!-- Custom Flavora-Inspired Stylesheet -->
    <style>
        :root {
            --stipor-primary: #2563eb;
            --stipor-primary-dark: #1d4ed8;
            --stipor-primary-light: #eff6ff;
            --stipor-accent: #f59e0b;
            --stipor-dark: #0f172a;
            --stipor-navy: #1e293b;
            --stipor-muted: #64748b;
            --stipor-bg-light: #f8fafc;
            --stipor-card-border: #e2e8f0;
        }

        [data-bs-theme="dark"] {
            --stipor-dark: #f8fafc;
            --stipor-navy: #0f172a;
            --stipor-muted: #94a3b8;
            --stipor-bg-light: #0f172a;
            --stipor-card-border: #334155;
        }

        body {
            font-family: 'Poppins', 'Plus Jakarta Sans', sans-serif;
            color: #334155;
            background-color: #ffffff;
            overflow-x: hidden;
            line-height: 1.65;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        [data-bs-theme="dark"] body {
            background-color: #0b0f19;
            color: #cbd5e1;
        }

        h1, h2, h3, h4, .font-heading {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 700;
            color: var(--stipor-dark);
            letter-spacing: -0.02em;
        }

        .font-serif-elegant {
            font-family: 'Marcellus', Georgia, serif;
        }

        /* --- NAVBAR STICKY --- */
        .navbar-stipor {
            background-color: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(12px);
            box-shadow: 0 4px 20px -4px rgba(15, 23, 42, 0.08);
            transition: all 0.3s ease;
            padding: 14px 0;
        }

        [data-bs-theme="dark"] .navbar-stipor {
            background-color: rgba(15, 23, 42, 0.94);
            box-shadow: 0 4px 20px -4px rgba(0, 0, 0, 0.5);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .navbar-brand {
            font-size: 1.35rem;
            font-weight: 800;
            color: var(--stipor-dark);
            letter-spacing: -0.03em;
        }

        [data-bs-theme="dark"] .navbar-brand .text-dark {
            color: #f8fafc !important;
        }

        .nav-link {
            font-size: 0.95rem;
            font-weight: 500;
            color: #475569 !important;
            padding: 8px 14px !important;
            transition: all 0.2s ease;
        }

        [data-bs-theme="dark"] .nav-link {
            color: #cbd5e1 !important;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--stipor-primary) !important;
        }

        [data-bs-theme="dark"] .nav-link:hover,
        [data-bs-theme="dark"] .nav-link.active {
            color: #60a5fa !important;
        }

        /* --- BUTTONS --- */
        .btn-stipor-primary {
            background-color: var(--stipor-primary);
            color: #ffffff;
            border: 1px solid var(--stipor-primary);
            font-weight: 600;
            padding: 10px 22px;
            border-radius: 50rem;
            transition: all 0.25s ease;
            box-shadow: 0 4px 14px rgba(37, 99, 235, 0.25);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-stipor-primary:hover {
            background-color: var(--stipor-primary-dark);
            border-color: var(--stipor-primary-dark);
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.35);
        }

        .btn-stipor-outline {
            background-color: transparent;
            color: var(--stipor-dark);
            border: 2px solid #cbd5e1;
            font-weight: 600;
            padding: 9px 22px;
            border-radius: 50rem;
            transition: all 0.25s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-stipor-outline:hover {
            background-color: #f1f5f9;
            border-color: #94a3b8;
            color: var(--stipor-dark);
            transform: translateY(-2px);
        }

        [data-bs-theme="dark"] .btn-stipor-outline {
            border-color: #475569;
            color: #f1f5f9;
        }

        [data-bs-theme="dark"] .btn-stipor-outline:hover {
            background-color: #1e293b;
            border-color: #64748b;
            color: #ffffff;
        }

        /* --- THEME TOGGLE BUTTON --- */
        .btn-theme-toggle {
            width: 40px;
            height: 40px;
            padding: 0;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            cursor: pointer;
            border: 1.5px solid #cbd5e1;
            background-color: transparent;
            color: #475569;
            transition: all 0.25s ease;
        }

        .btn-theme-toggle:hover {
            background-color: #f1f5f9;
            color: var(--stipor-primary);
            transform: rotate(15deg);
        }

        [data-bs-theme="dark"] .btn-theme-toggle {
            border-color: #475569;
            color: #f59e0b;
        }

        [data-bs-theme="dark"] .btn-theme-toggle:hover {
            background-color: #1e293b;
            color: #fbbf24;
        }

        /* --- HERO SECTION --- */
        .hero-section {
            padding: 90px 0 70px;
            background: radial-gradient(circle at top right, rgba(37, 99, 235, 0.06), transparent 50%),
                        radial-gradient(circle at bottom left, rgba(245, 158, 11, 0.05), transparent 40%);
            position: relative;
        }

        [data-bs-theme="dark"] .hero-section {
            background: radial-gradient(circle at top right, rgba(37, 99, 235, 0.15), transparent 50%),
                        radial-gradient(circle at bottom left, rgba(245, 158, 11, 0.08), transparent 40%);
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            padding: 6px 16px;
            background-color: #eff6ff;
            color: var(--stipor-primary);
            border: 1px solid #dbeafe;
            border-radius: 50rem;
            font-size: 0.85rem;
            font-weight: 700;
            letter-spacing: 0.02em;
            margin-bottom: 20px;
        }

        [data-bs-theme="dark"] .hero-badge {
            background-color: rgba(37, 99, 235, 0.18);
            border-color: rgba(37, 99, 235, 0.35);
            color: #93c5fd;
        }

        .hero-title {
            font-size: clamp(2.2rem, 4vw, 3.4rem);
            font-weight: 800;
            line-height: 1.18;
            color: var(--stipor-dark);
            margin-bottom: 22px;
        }

        .hero-title span {
            color: var(--stipor-primary);
            position: relative;
        }

        .hero-desc {
            font-size: 1.1rem;
            color: #64748b;
            margin-bottom: 34px;
            max-width: 540px;
        }

        [data-bs-theme="dark"] .hero-desc {
            color: #94a3b8;
        }

        /* --- HERO INTERACTIVE CARD --- */
        .hero-card-container {
            position: relative;
        }

        .hero-main-card {
            background: #ffffff;
            border: 1px solid var(--stipor-card-border);
            border-radius: 24px;
            padding: 36px 30px;
            box-shadow: 0 20px 40px -15px rgba(15, 23, 42, 0.08);
            position: relative;
            overflow: hidden;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        [data-bs-theme="dark"] .hero-main-card {
            background: #1e293b;
            box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.5);
        }

        .hero-inner-card {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .hero-inner-title {
            color: #0f172a;
            font-size: 1rem;
        }

        .hero-inner-desc {
            color: #475569;
            font-size: 0.88rem;
            line-height: 1.5;
        }

        .hero-card-step {
            color: #64748b;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .hero-stat-box {
            padding: 10px 8px;
            border-radius: 12px;
            background-color: rgba(37, 99, 235, 0.08);
            border: 1px solid rgba(37, 99, 235, 0.15);
            transition: all 0.3s ease;
        }

        .hero-stat-box.warning {
            background-color: rgba(245, 158, 11, 0.08);
            border-color: rgba(245, 158, 11, 0.18);
        }

        .hero-stat-box.success {
            background-color: rgba(16, 185, 129, 0.08);
            border-color: rgba(16, 185, 129, 0.18);
        }

        .hero-stat-label {
            font-size: 0.75rem;
            color: #64748b;
            font-weight: 500;
        }

        [data-bs-theme="dark"] .hero-inner-card {
            background-color: rgba(15, 23, 42, 0.85);
            border-color: #334155;
        }

        [data-bs-theme="dark"] .hero-inner-title {
            color: #f8fafc;
        }

        [data-bs-theme="dark"] .hero-inner-desc {
            color: #cbd5e1;
        }

        [data-bs-theme="dark"] .hero-card-step {
            color: #94a3b8;
        }

        [data-bs-theme="dark"] .hero-stat-box {
            background-color: rgba(37, 99, 235, 0.18);
            border-color: rgba(37, 99, 235, 0.35);
        }

        [data-bs-theme="dark"] .hero-stat-box.warning {
            background-color: rgba(245, 158, 11, 0.18);
            border-color: rgba(245, 158, 11, 0.35);
        }

        [data-bs-theme="dark"] .hero-stat-box.success {
            background-color: rgba(16, 185, 129, 0.18);
            border-color: rgba(16, 185, 129, 0.35);
        }

        [data-bs-theme="dark"] .hero-stat-label {
            color: #94a3b8;
        }

        .hero-main-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background-color: var(--stipor-primary);
        }

        .floating-badge {
            position: absolute;
            background: #ffffff;
            padding: 10px 18px;
            border-radius: 50rem;
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.12);
            border: 1px solid #f1f5f9;
            font-size: 0.85rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 8px;
            z-index: 2;
            animation: float 4s ease-in-out infinite;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        [data-bs-theme="dark"] .floating-badge {
            background: #1e293b;
            border-color: #334155;
            color: #f8fafc !important;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.4);
        }

        .floating-badge-1 {
            top: -15px;
            right: -10px;
            animation-delay: 0s;
        }

        .floating-badge-2 {
            bottom: -15px;
            left: -10px;
            animation-delay: 2s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-8px); }
        }

        /* --- STATS & VALUE BAR --- */
        .value-bar-section {
            background-color: #ffffff;
            border-top: 1px solid var(--stipor-card-border);
            border-bottom: 1px solid var(--stipor-card-border);
            padding: 35px 0;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        [data-bs-theme="dark"] .value-bar-section {
            background-color: #0f172a;
        }

        .value-item {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .value-icon-box {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            background-color: #eff6ff;
            color: var(--stipor-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.35rem;
            flex-shrink: 0;
            transition: all 0.3s ease;
        }

        .value-icon-box.value-icon-warning {
            background-color: #fef3c7;
            color: #d97706;
        }

        .value-icon-box.value-icon-success {
            background-color: #f0fdf4;
            color: #16a34a;
        }

        .value-icon-box.value-icon-purple {
            background-color: #faf5ff;
            color: #9333ea;
        }

        [data-bs-theme="dark"] .value-icon-box {
            background-color: rgba(37, 99, 235, 0.2);
            color: #60a5fa;
        }

        [data-bs-theme="dark"] .value-icon-box.value-icon-warning {
            background-color: rgba(245, 158, 11, 0.2);
            color: #fbbf24;
        }

        [data-bs-theme="dark"] .value-icon-box.value-icon-success {
            background-color: rgba(16, 185, 129, 0.2);
            color: #34d399;
        }

        [data-bs-theme="dark"] .value-icon-box.value-icon-purple {
            background-color: rgba(147, 51, 234, 0.2);
            color: #c084fc;
        }

        /* --- ABOUT SECTION --- */
        .about-feature-card {
            background-color: #eff6ff;
            border: 1px solid #dbeafe;
            transition: all 0.3s ease;
        }

        .about-card-title {
            color: var(--stipor-primary);
        }

        .about-card-desc {
            color: #475569;
            line-height: 1.6;
        }

        .about-feature-list {
            color: #1e293b;
            font-weight: 500;
        }

        [data-bs-theme="dark"] .about-feature-card {
            background-color: rgba(30, 41, 59, 0.85);
            border-color: #334155;
            box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.5);
        }

        [data-bs-theme="dark"] .about-card-title {
            color: #60a5fa;
        }

        [data-bs-theme="dark"] .about-card-desc {
            color: #cbd5e1;
        }

        [data-bs-theme="dark"] .about-feature-list {
            color: #f1f5f9;
        }

        /* --- CATEGORY CARDS (FLAVORA-INSPIRED) --- */
        .section-header {
            text-align: center;
            margin-bottom: 50px;
        }

        .section-tag {
            font-size: 0.82rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: var(--stipor-primary);
            margin-bottom: 10px;
            display: inline-block;
        }

        .section-title {
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--stipor-dark);
            margin-bottom: 14px;
        }

        .section-subtitle {
            color: var(--stipor-muted);
            max-width: 620px;
            margin: 0 auto;
            font-size: 1rem;
        }

        .category-card {
            background: #ffffff;
            border: 1px solid var(--stipor-card-border);
            border-radius: 20px;
            padding: 32px 26px;
            height: 100%;
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .category-card:hover {
            transform: translateY(-8px);
            border-color: var(--stipor-primary);
            box-shadow: 0 18px 36px -10px rgba(37, 99, 235, 0.12);
        }

        [data-bs-theme="dark"] .category-card {
            background: #1e293b;
        }

        [data-bs-theme="dark"] .category-card:hover {
            border-color: #3b82f6;
            box-shadow: 0 18px 36px -10px rgba(37, 99, 235, 0.3);
        }

        .category-icon {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 20px;
        }

        .category-tag {
            font-size: 0.78rem;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 50rem;
            display: inline-block;
            margin-bottom: 12px;
            align-self: flex-start;
        }

        /* --- PROCESS STEP / TIMELINE --- */
        .step-box {
            background: #ffffff;
            border: 1px solid var(--stipor-card-border);
            border-radius: 20px;
            padding: 32px 24px;
            position: relative;
            height: 100%;
            transition: all 0.3s ease;
        }

        .step-box:hover {
            transform: translateY(-5px);
            border-color: var(--stipor-primary);
            box-shadow: 0 14px 28px -8px rgba(15, 23, 42, 0.08);
        }

        [data-bs-theme="dark"] .step-box {
            background: #1e293b;
        }

        [data-bs-theme="dark"] .step-box:hover {
            border-color: #3b82f6;
            box-shadow: 0 14px 28px -8px rgba(37, 99, 235, 0.3);
        }

        .step-number {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background-color: var(--stipor-primary);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 1.1rem;
            margin-bottom: 20px;
        }

        /* --- FAQ ACCORDION --- */
        .accordion-item {
            border: 1px solid var(--stipor-card-border);
            border-radius: 14px !important;
            margin-bottom: 14px;
            overflow: hidden;
            transition: border-color 0.3s ease;
        }

        [data-bs-theme="dark"] .accordion-item {
            background-color: #1e293b;
        }

        .accordion-button {
            font-weight: 600;
            font-size: 1.02rem;
            color: var(--stipor-dark);
            padding: 18px 22px;
            background-color: #ffffff;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .accordion-button:not(.collapsed) {
            color: var(--stipor-primary);
            background-color: #f8fafc;
            box-shadow: none;
        }

        [data-bs-theme="dark"] .accordion-button {
            background-color: #1e293b;
            color: #f8fafc;
        }

        [data-bs-theme="dark"] .accordion-button:not(.collapsed) {
            background-color: #0f172a;
            color: #60a5fa;
        }

        .accordion-button:focus {
            box-shadow: none;
            border-color: var(--stipor-primary);
        }

        .accordion-body {
            color: #475569;
            font-size: 0.95rem;
            padding: 18px 22px;
            background-color: #f8fafc;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        [data-bs-theme="dark"] .accordion-body {
            background-color: #0f172a;
            color: #cbd5e1;
        }

        /* --- CONTACT CARD --- */
        .contact-info-card {
            background: #ffffff;
            border: 1px solid var(--stipor-card-border);
            border-radius: 22px;
            padding: 34px 28px;
            box-shadow: 0 10px 30px -8px rgba(15, 23, 42, 0.06);
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        [data-bs-theme="dark"] .contact-info-card {
            background: #1e293b;
        }

        /* --- FOOTER --- */
        .stipor-footer {
            background-color: var(--stipor-navy);
            color: #94a3b8;
            padding: 40px 0 20px;
            font-size: 0.88rem;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
        }

        [data-bs-theme="dark"] .stipor-footer {
            background-color: #050811;
        }

        .footer-heading {
            color: #ffffff;
            font-size: 0.95rem;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .footer-desc {
            color: #94a3b8;
            line-height: 1.5;
        }

        .stipor-footer a {
            color: #94a3b8;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .stipor-footer a:hover {
            color: #60a5fa;
        }

        .footer-bottom {
            margin-top: 28px;
            padding-top: 16px;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            font-size: 0.82rem;
        }

        .footer-copyright {
            color: #94a3b8;
        }

        /* --- DARK THEME HELPERS --- */
        [data-bs-theme="dark"] .bg-light {
            background-color: #0f172a !important;
        }

        [data-bs-theme="dark"] .border-bottom {
            border-color: #334155 !important;
        }

        /* --- RESPONSIVE OPTIMIZATIONS (TABLET & MOBILE) --- */
        html, body {
            overflow-x: hidden !important;
            max-width: 100% !important;
            width: 100% !important;
            position: relative;
        }

        @media (max-width: 991.98px) {
            .navbar-collapse {
                background: rgba(255, 255, 255, 0.98);
                padding: 20px;
                border-radius: 16px;
                margin-top: 14px;
                box-shadow: 0 14px 35px rgba(15, 23, 42, 0.12);
                border: 1px solid var(--stipor-card-border);
            }

            [data-bs-theme="dark"] .navbar-collapse {
                background: rgba(15, 23, 42, 0.98);
                box-shadow: 0 14px 35px rgba(0, 0, 0, 0.6);
                border-color: #334155;
            }

            .hero-section {
                padding: 45px 0 35px;
                text-align: center;
            }

            .hero-badge {
                margin-left: auto;
                margin-right: auto;
            }

            .hero-desc {
                margin-left: auto;
                margin-right: auto;
            }

            .hero-card-container {
                margin-top: 25px;
                max-width: 480px;
                margin-left: auto;
                margin-right: auto;
            }

            .section-title {
                font-size: 1.85rem;
            }

            .section-header {
                margin-bottom: 35px;
            }

            section.py-5 {
                padding: 55px 0 !important;
            }
        }

        @media (max-width: 767.98px) {
            .floating-badge {
                position: static !important;
                margin: 0 auto !important;
                display: inline-flex !important;
                font-size: 0.78rem;
                padding: 7px 14px;
                animation: none !important;
            }

            .floating-badge-1 {
                margin-bottom: 12px !important;
            }

            .floating-badge-2 {
                margin-top: 12px !important;
            }

            .hero-card-container {
                display: flex;
                flex-direction: column;
                align-items: center;
                width: 100%;
            }

            .hero-main-card {
                width: 100%;
            }

            .value-item {
                justify-content: center;
                text-align: left;
            }
        }

        @media (max-width: 575.98px) {
            .navbar-brand {
                font-size: 1.15rem;
            }

            .hero-title {
                font-size: 1.7rem;
                line-height: 1.25;
            }

            .hero-desc {
                font-size: 0.95rem;
            }

            .hero-main-card {
                padding: 20px 15px;
                border-radius: 18px;
            }

            .category-card,
            .step-box,
            .contact-info-card,
            .about-feature-card {
                padding: 22px 16px !important;
                border-radius: 16px !important;
            }

            .value-bar-section {
                padding: 24px 0;
            }

            .value-icon-box {
                width: 44px;
                height: 44px;
                font-size: 1.15rem;
            }

            .accordion-button {
                padding: 14px 16px;
                font-size: 0.92rem;
            }

            .accordion-body {
                padding: 14px 16px;
                font-size: 0.88rem;
            }

            .stipor-footer {
                padding: 30px 0 15px;
            }
        }
    </style>

    <!-- Instant Dark Mode Init Script (Prevents FOUC) -->
    <script>
        (function() {
            const savedTheme = localStorage.getItem('stipor_theme');
            if (savedTheme === 'dark' || (!savedTheme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.setAttribute('data-bs-theme', 'dark');
            } else {
                document.documentElement.setAttribute('data-bs-theme', 'light');
            }
        })();
    </script>
</head>
<body id="beranda">

    <!-- 1. STICKY NAVBAR -->
    @include('landing.partials.navbar')

    <!-- 3. HERO SECTION -->
    @include('landing.partials.hero')

    <!-- 4. STATS & VALUE HIGHLIGHT BAR -->
    @include('landing.partials.stats')

    <!-- 5. TENTANG LAYANAN (ABOUT) -->
    @include('landing.partials.about')

    <!-- 6. KATEGORI PERUNDUNGAN (MENU/CATEGORY CARDS) -->
    @include('landing.partials.categories')

    <!-- 7. ALUR PENANGANAN (PROCESS STEPS) -->
    @include('landing.partials.process')

    <!-- 8. SECTION FAQ & KONTAK RUANG BK -->
    @include('landing.partials.faq_contact')

    <!-- 9. FOOTER PROFESIONAL -->
    @include('landing.partials.footer')

    <!-- Bootstrap 5.3.3 JS Bundle (CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- AOS (Animate on Scroll) JS (CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true,
                mirror: false
            });

            // Theme Toggle Logic
            const themeToggle = document.getElementById('themeToggle');
            const themeIcon = document.getElementById('themeIcon');

            function syncThemeIcon(theme) {
                if (!themeIcon) return;
                if (theme === 'dark') {
                    themeIcon.className = 'fas fa-sun text-warning';
                    if (themeToggle) themeToggle.setAttribute('title', 'Beralih ke Mode Terang');
                } else {
                    themeIcon.className = 'fas fa-moon text-secondary';
                    if (themeToggle) themeToggle.setAttribute('title', 'Beralih ke Mode Gelap');
                }
            }

            const currentTheme = document.documentElement.getAttribute('data-bs-theme') || 'light';
            syncThemeIcon(currentTheme);

            if (themeToggle) {
                themeToggle.addEventListener('click', function () {
                    const activeTheme = document.documentElement.getAttribute('data-bs-theme');
                    const targetTheme = activeTheme === 'dark' ? 'light' : 'dark';
                    document.documentElement.setAttribute('data-bs-theme', targetTheme);
                    localStorage.setItem('stipor_theme', targetTheme);
                    syncThemeIcon(targetTheme);
                });
            }
        });
    </script>
</body>
</html>
