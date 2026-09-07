<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>STIPOR - Layanan Pengaduan Bullying SMK TI Airlangga Samarinda</title>
    <meta name="description" content="Sistem Informasi Pelaporan Bullying dan Pengaduan Siswa Resmi SMK TI Airlangga Samarinda. 100% Rahasia, Cepat, dan Didampingi Guru BK Profesional.">

    <!-- OpenGraph & Social Media Meta Tags -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="STIPOR - Layanan Pengaduan &amp; Perlindungan Bullying SMK TI Airlangga">
    <meta property="og:description" content="Kanal resmi pelaporan bullying SMK TI Airlangga Samarinda. 100% Rahasia, Aman, Bebas Intimidasi, dan Didampingi Guru BK Profesional.">
    <meta property="og:image" content="{{ asset('favicon.svg') }}">
    <meta property="og:site_name" content="STIPOR SMK TI Airlangga">
    <meta property="og:locale" content="id_ID">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="STIPOR - Layanan Pengaduan Bullying SMK TI Airlangga">
    <meta name="twitter:description" content="Laporkan tindakan perundungan secara aman &amp; rahasia. Bersama wujudkan sekolah ramah dan beradab.">
    <meta name="twitter:image" content="{{ asset('favicon.svg') }}">
    <meta name="theme-color" content="#2563eb">

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

    <!-- Google Fonts (Poppins, Marcellus & Plus Jakarta Sans) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Marcellus&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3.3 CSS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Font Awesome 5 (CDN) -->
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

        /* --- TRANSPARENCY BAR --- */
        .transparency-bar {
            border-color: var(--stipor-card-border) !important;
        }

        .transparency-number {
            font-size: 1.6rem;
            font-weight: 800;
            line-height: 1.2;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .transparency-label {
            font-size: 0.82rem;
            color: var(--stipor-muted);
            font-weight: 600;
            margin-top: 4px;
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

        /* --- QUOTES & COMMITMENT CARDS --- */
        .quote-card {
            background: #ffffff;
            border: 1px solid var(--stipor-card-border);
            border-radius: 20px;
            padding: 32px 28px;
            position: relative;
            transition: all 0.3s ease;
        }

        [data-bs-theme="dark"] .quote-card {
            background: #1e293b;
            border-color: #334155;
        }

        .quote-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 16px 32px -10px rgba(15, 23, 42, 0.08);
        }

        [data-bs-theme="dark"] .quote-card:hover {
            box-shadow: 0 16px 32px -10px rgba(0, 0, 0, 0.4);
        }

        .quote-icon-box {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background-color: #eff6ff;
            color: var(--stipor-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .quote-icon-box.quote-icon-green {
            background-color: #f0fdf4;
            color: #16a34a;
        }

        [data-bs-theme="dark"] .quote-icon-box {
            background-color: rgba(37, 99, 235, 0.2);
            color: #60a5fa;
        }

        [data-bs-theme="dark"] .quote-icon-box.quote-icon-green {
            background-color: rgba(16, 185, 129, 0.2);
            color: #34d399;
        }

        .quote-text {
            font-size: 0.98rem;
            color: #475569;
            font-style: italic;
            line-height: 1.7;
        }

        [data-bs-theme="dark"] .quote-text {
            color: #cbd5e1;
        }

        .quote-avatar {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.15rem;
            flex-shrink: 0;
        }

        .quote-author {
            color: var(--stipor-dark);
        }

        /* --- QUIZ SECTION --- */
        .quiz-card {
            background: #ffffff;
            border: 1px solid var(--stipor-card-border);
            transition: all 0.3s ease;
        }

        [data-bs-theme="dark"] .quiz-card {
            background: #1e293b;
            border-color: #334155;
        }

        .quiz-option-btn {
            border: 1.5px solid var(--stipor-card-border);
            background-color: #ffffff;
            color: var(--stipor-dark);
            border-radius: 14px;
            transition: all 0.25s ease;
            font-size: 0.95rem;
        }

        .quiz-option-btn:hover {
            border-color: var(--stipor-primary);
            background-color: #eff6ff;
            color: var(--stipor-primary);
            transform: translateX(4px);
        }

        [data-bs-theme="dark"] .quiz-option-btn {
            background-color: #0f172a;
            border-color: #334155;
            color: #f8fafc;
        }

        [data-bs-theme="dark"] .quiz-option-btn:hover {
            background-color: rgba(37, 99, 235, 0.18);
            border-color: #60a5fa;
            color: #60a5fa;
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
            transition: all 0.3s ease;
        }

        .category-tag {
            font-size: 0.78rem;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 50rem;
            display: inline-block;
            margin-bottom: 12px;
            align-self: flex-start;
            transition: all 0.3s ease;
        }

        /* Category Icons & Tags (Light Theme) */
        .category-icon.cat-danger { background-color: #fee2e2; color: #ef4444; }
        .category-tag.tag-danger { background-color: #fee2e2; color: #b91c1c; border: 1px solid #fecaca; }

        .category-icon.cat-warning { background-color: #fef3c7; color: #d97706; }
        .category-tag.tag-warning { background-color: #fef3c7; color: #b45309; border: 1px solid #fde68a; }

        .category-icon.cat-primary { background-color: #dbeafe; color: #2563eb; }
        .category-tag.tag-primary { background-color: #dbeafe; color: #1d4ed8; border: 1px solid #bfdbfe; }

        .category-icon.cat-purple { background-color: #f3e8ff; color: #9333ea; }
        .category-tag.tag-purple { background-color: #f3e8ff; color: #6b21a8; border: 1px solid #e9d5ff; }

        /* Category Icons & Tags (Dark Theme) */
        [data-bs-theme="dark"] .category-icon.cat-danger { background-color: rgba(239, 68, 68, 0.2); color: #f87171; }
        [data-bs-theme="dark"] .category-tag.tag-danger { background-color: rgba(239, 68, 68, 0.2); color: #fca5a5; border: 1px solid rgba(239, 68, 68, 0.35); }

        [data-bs-theme="dark"] .category-icon.cat-warning { background-color: rgba(245, 158, 11, 0.2); color: #fbbf24; }
        [data-bs-theme="dark"] .category-tag.tag-warning { background-color: rgba(245, 158, 11, 0.2); color: #fde047; border: 1px solid rgba(245, 158, 11, 0.35); }

        [data-bs-theme="dark"] .category-icon.cat-primary { background-color: rgba(37, 99, 235, 0.2); color: #60a5fa; }
        [data-bs-theme="dark"] .category-tag.tag-primary { background-color: rgba(37, 99, 235, 0.2); color: #93c5fd; border: 1px solid rgba(37, 99, 235, 0.35); }

        [data-bs-theme="dark"] .category-icon.cat-purple { background-color: rgba(147, 51, 234, 0.2); color: #c084fc; }
        [data-bs-theme="dark"] .category-tag.tag-purple { background-color: rgba(147, 51, 234, 0.2); color: #d8b4fe; border: 1px solid rgba(147, 51, 234, 0.35); }

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

        .contact-icon-box {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background-color: rgba(37, 99, 235, 0.1);
            color: var(--stipor-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: all 0.3s ease;
        }

        .contact-icon-box.success {
            background-color: rgba(16, 185, 129, 0.1);
            color: #16a34a;
        }

        [data-bs-theme="dark"] .contact-info-card {
            background: #1e293b;
        }

        [data-bs-theme="dark"] .contact-icon-box {
            background-color: rgba(37, 99, 235, 0.2);
            color: #60a5fa;
        }

        [data-bs-theme="dark"] .contact-icon-box.success {
            background-color: rgba(16, 185, 129, 0.2);
            color: #34d399;
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

        /* --- SECTION SPACING & UTILITIES --- */
        .section-py {
            padding: 85px 0;
            transition: padding 0.3s ease;
        }

        .transparency-number.text-info {
            color: #0284c7 !important;
        }

        [data-bs-theme="dark"] .transparency-number.text-info {
            color: #38bdf8 !important;
        }

        .btn-warning {
            color: #0f172a !important;
            background-color: #f59e0b;
            border-color: #f59e0b;
            font-weight: 600;
        }

        .btn-warning:hover {
            background-color: #d97706;
            border-color: #d97706;
            color: #ffffff !important;
        }

        .footer-official-badge {
            background-color: rgba(37, 99, 235, 0.15);
            color: #93c5fd;
            border: 1px solid rgba(59, 130, 246, 0.3);
            border-radius: 50rem;
            font-weight: 600;
        }

        [data-bs-theme="dark"] .text-muted {
            color: #94a3b8 !important;
        }

        [data-bs-theme="dark"] .badge.text-primary {
            color: #93c5fd !important;
        }

        [data-bs-theme="dark"] .badge.text-success {
            color: #86efac !important;
        }

        [data-bs-theme="dark"] .badge.text-warning {
            color: #fde047 !important;
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
            .section-py {
                padding: 55px 0;
            }

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
            .section-py {
                padding: 42px 0;
            }

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
            .about-feature-card,
            .quote-card,
            .quiz-card {
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

            .transparency-number {
                font-size: 1.35rem;
            }

            .transparency-label {
                font-size: 0.76rem;
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

        /* --- SCROLL OFFSET & BACK TO TOP --- */
        html {
            scroll-behavior: smooth;
        }

        section[id], div[id], [id] {
            scroll-margin-top: 85px;
        }

        .back-to-top-btn {
            position: fixed;
            bottom: 25px;
            right: 25px;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background-color: var(--stipor-primary);
            color: #ffffff !important;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            box-shadow: 0 8px 24px rgba(37, 99, 235, 0.35);
            z-index: 999;
            opacity: 0;
            visibility: hidden;
            transform: translateY(15px);
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .back-to-top-btn.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .back-to-top-btn:hover {
            background-color: var(--stipor-primary-dark);
            transform: translateY(-3px);
            box-shadow: 0 12px 28px rgba(37, 99, 235, 0.45);
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

    <!-- 5.1 KOMITMEN PIMPINAN & GURU BK (QUOTES) -->
    @include('landing.partials.quotes')

    <!-- 6. KATEGORI PERUNDUNGAN (MENU/CATEGORY CARDS) -->
    @include('landing.partials.categories')

    <!-- 6.1 CEK MANDIRI INTERAKTIF (QUIZ) -->
    @include('landing.partials.quiz')

    <!-- 7. ALUR PENANGANAN (PROCESS STEPS) -->
    @include('landing.partials.process')

    <!-- 8. SECTION FAQ & KONTAK RUANG BK -->
    @include('landing.partials.faq_contact')

    <!-- 9. FOOTER PROFESIONAL -->
    @include('landing.partials.footer')

    <!-- Back to Top Floating Button -->
    <a href="#beranda" id="backToTop" class="back-to-top-btn" aria-label="Kembali ke atas" title="Kembali ke atas">
        <i class="fas fa-chevron-up"></i>
    </a>

    <!-- Bootstrap 5.3.3 JS Bundle (CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- AOS (Animate on Scroll) JS (CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
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
                actionBtn.href = "{{ route('login') }}";
                actionBtn.innerHTML = '<i class="fas fa-bullhorn me-2"></i> Laporkan ke Guru BK Sekarang';
                actionBtn.className = 'btn btn-danger px-4 py-2';
            } else if (totalScore >= 2) {
                resultIconBox.innerHTML = '<div class="rounded-circle bg-warning bg-opacity-10 text-warning d-inline-flex p-3 fs-2"><i class="fas fa-info-circle"></i></div>';
                resultTitle.textContent = 'Potensi Konflik / Perundungan Ringan';
                resultTitle.className = 'fw-bold mb-2 text-warning';
                resultDesc.textContent = 'Ada indikasi ketidaknyamanan sosial atau perlakuan yang mengarah ke perundungan. Kami sarankan kamu berkonsultasi atau bercerita langsung dengan Guru BK untuk mencegah situasi ini berlanjut.';
                actionBtn.href = "{{ route('login') }}";
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
                    localStorage.setItem('dark-mode', targetTheme === 'dark' ? 'enabled' : 'disabled');
                    syncThemeIcon(targetTheme);
                });
            }

            // Back to Top Button
            const backToTop = document.getElementById('backToTop');
            window.addEventListener('scroll', function () {
                if (window.scrollY > 350) {
                    backToTop.classList.add('show');
                } else {
                    backToTop.classList.remove('show');
                }
            });

            // Auto-close mobile navbar on link click
            const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
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
        });
    </script>
</body>
</html>
