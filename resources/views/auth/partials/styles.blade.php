    <style>
        /* Base & Reset */
        *, *::before, *::after {
            box-sizing: border-box;
        }

        html {
            width: 100%;
            height: 100%;
            overflow-x: hidden;
        }

        body {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            transition: background-color 0.3s ease, color 0.3s ease;
            width: 100%;
            min-height: 100vh;
            min-height: 100dvh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem 1rem;
            position: relative;
            overflow-x: hidden;
            background-color: #f8fafc;
            color: #0f172a;
            margin: 0;
        }

        .hidden {
            display: none !important;
        }

        /* Ambient Glow Container (Fixed & Contained so it never causes scroll overflow) */
        .ambient-glow-container {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
            z-index: 0;
        }

        .ambient-glow-1 {
            position: absolute;
            top: -100px;
            left: -80px;
            width: 380px;
            height: 380px;
            background: radial-gradient(circle, rgba(37, 99, 235, 0.18) 0%, rgba(37, 99, 235, 0) 70%);
            border-radius: 50%;
            pointer-events: none;
            filter: blur(40px);
        }

        .ambient-glow-2 {
            position: absolute;
            bottom: -100px;
            right: -80px;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(245, 158, 11, 0.12) 0%, rgba(245, 158, 11, 0) 70%);
            border-radius: 50%;
            pointer-events: none;
            filter: blur(50px);
        }

        /* Top Accent Strip */
        .top-gradient-strip {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, #2563eb 0%, #4f46e5 50%, #f59e0b 100%);
            border-top-left-radius: 1.25rem;
            border-top-right-radius: 1.25rem;
        }

        /* Embedded Theme Toggle in Card Top-Right */
        .theme-toggle-wrapper {
            position: absolute !important;
            top: 1.15rem !important;
            right: 1.15rem !important;
            z-index: 25 !important;
        }

        .theme-toggle-btn {
            width: 40px !important;
            height: 40px !important;
            border-radius: 50% !important;
            background-color: rgba(241, 245, 249, 0.95) !important;
            border: 1.5px solid #cbd5e1 !important;
            color: #334155 !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            box-shadow: 0 2px 6px rgba(15, 23, 42, 0.06) !important;
            cursor: pointer !important;
            outline: none !important;
            transition: all 0.2s ease !important;
            padding: 0 !important;
        }

        .theme-toggle-btn:hover {
            transform: scale(1.08) !important;
            color: #1d4ed8 !important;
            background-color: #ffffff !important;
            border-color: #94a3b8 !important;
        }

        .dark-mode .theme-toggle-btn {
            background-color: rgba(30, 41, 59, 0.95) !important;
            border-color: #475569 !important;
            color: #fbbf24 !important;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.4) !important;
        }

        .dark-mode .theme-toggle-btn:hover {
            background-color: #1e293b !important;
            border-color: #64748b !important;
        }

        /* Login Card Container */
        .login-card {
            position: relative !important;
            width: 100% !important;
            max-width: 440px !important;
            background-color: rgba(255, 255, 255, 0.98) !important;
            border: 1px solid rgba(203, 213, 225, 0.85) !important;
            border-radius: 1.25rem !important;
            box-shadow: 0 20px 45px -10px rgba(15, 23, 42, 0.1) !important;
            padding: 2.25rem 2rem 2rem 2rem !important;
            z-index: 10 !important;
            margin: auto !important;
            box-sizing: border-box !important;
        }

        .dark-mode .login-card {
            background-color: rgba(15, 23, 42, 0.96) !important;
            border-color: rgba(51, 65, 85, 0.85) !important;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.7) !important;
        }

        /* Brand & Header Section */
        .login-brand-header {
            text-align: center !important;
            margin-bottom: 1.5rem !important;
            display: flex !important;
            flex-direction: column !important;
            align-items: center !important;
            justify-content: center !important;
        }

        .brand-link {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 0.75rem !important;
            text-decoration: none !important;
            margin-bottom: 0.75rem !important;
        }

        .brand-icon-box {
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%) !important;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff !important;
            box-shadow: 0 4px 14px rgba(37, 99, 235, 0.25);
            flex-shrink: 0 !important;
        }

        .brand-text-wrapper {
            text-align: left !important;
        }

        .brand-logo-title {
            font-size: 1.1rem !important;
            font-weight: 800 !important;
            color: #0f172a !important;
            letter-spacing: -0.025em !important;
            line-height: 1 !important;
            margin: 0 !important;
            display: block !important;
        }

        .dark-mode .brand-logo-title {
            color: #f8fafc !important;
        }

        .brand-logo-sub {
            font-size: 0.6875rem !important;
            font-weight: 700 !important;
            color: #475569 !important;
            letter-spacing: 0.05em !important;
            margin-top: 0.2rem !important;
            display: block !important;
        }

        .dark-mode .brand-logo-sub {
            color: #cbd5e1 !important;
        }

        .brand-title {
            font-size: 1.45rem !important;
            font-weight: 800 !important;
            color: #0f172a !important;
            letter-spacing: -0.025em !important;
            margin: 0 !important;
            line-height: 1.2 !important;
        }

        .dark-mode .brand-title {
            color: #f8fafc !important;
        }

        .brand-subtitle {
            font-size: 0.8125rem !important;
            color: #475569 !important;
            margin-top: 0.35rem !important;
            margin-bottom: 0 !important;
            line-height: 1.4 !important;
        }

        .dark-mode .brand-subtitle {
            color: #cbd5e1 !important;
        }

        /* Error Alert Box */
        .login-error-alert {
            display: flex !important;
            align-items: flex-start !important;
            gap: 0.85rem !important;
            padding: 0.85rem 1.1rem !important;
            border-radius: 0.75rem !important;
            background-color: #fef2f2 !important;
            border: 1px solid #fecaca !important;
            margin-bottom: 1.35rem !important;
        }

        .dark-mode .login-error-alert {
            background-color: rgba(239, 68, 68, 0.12) !important;
            border-color: rgba(239, 68, 68, 0.28) !important;
        }

        .login-error-icon {
            flex-shrink: 0 !important;
            width: 1.2rem !important;
            height: 1.2rem !important;
            color: #dc2626 !important;
            margin-top: 0.1rem !important;
        }

        .dark-mode .login-error-icon {
            color: #f87171 !important;
        }

        .login-error-body {
            flex: 1 !important;
            min-width: 0 !important;
        }

        .login-error-title {
            font-size: 0.8125rem !important;
            font-weight: 700 !important;
            color: #991b1b !important;
            margin: 0 0 0.25rem 0 !important;
            line-height: 1.3 !important;
        }

        .dark-mode .login-error-title {
            color: #fca5a5 !important;
        }

        .login-error-list {
            margin: 0 !important;
            padding-left: 1.15rem !important;
            font-size: 0.775rem !important;
            line-height: 1.45 !important;
            color: #991b1b !important;
        }

        .dark-mode .login-error-list {
            color: #fca5a5 !important;
        }

        /* Form Controls */
        .form-group-item {
            margin-bottom: 1.25rem !important;
        }

        .form-label {
            display: block !important;
            font-size: 0.75rem !important;
            font-weight: 700 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.05em !important;
            color: #1e293b !important;
            margin-bottom: 0.45rem !important;
        }

        .dark-mode .form-label {
            color: #f1f5f9 !important;
        }

        /* Primary Login Button */
        .btn-primary-login {
            width: 100% !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 0.5rem !important;
            padding: 0.8rem 1.25rem !important;
            border: none !important;
            font-size: 0.925rem !important;
            font-weight: 700 !important;
            border-radius: 0.75rem !important;
            color: #ffffff !important;
            background: linear-gradient(135deg, #2563eb 0%, #4f46e5 50%, #4338ca 100%) !important;
            box-shadow: 0 10px 20px -5px rgba(79, 70, 229, 0.35) !important;
            cursor: pointer !important;
            outline: none !important;
            transition: all 0.2s ease !important;
        }

        .btn-primary-login:hover {
            background: linear-gradient(135deg, #1d4ed8 0%, #4338ca 50%, #3730a3 100%) !important;
            box-shadow: 0 12px 24px -5px rgba(79, 70, 229, 0.45) !important;
            transform: translateY(-1px);
        }

        .btn-primary-login:active {
            transform: scale(0.98);
        }

        /* Dark Mode Theme */
        body.dark-mode {
            background-color: #0b0f19 !important;
            color: #f8fafc !important;
        }
        
        .dark-mode .ambient-glow-1 {
            background: radial-gradient(circle, rgba(37, 99, 235, 0.28) 0%, rgba(37, 99, 235, 0) 70%);
        }

        .dark-mode .ambient-glow-2 {
            background: radial-gradient(circle, rgba(245, 158, 11, 0.18) 0%, rgba(245, 158, 11, 0) 70%);
        }

        /* Input Styles & Fixed Spacing (Guaranteed No Overlap) */
        .input-group-relative {
            position: relative !important;
            width: 100% !important;
            display: block !important;
        }

        .input-box {
            width: 100% !important;
            padding-left: 2.85rem !important; /* ~45px left padding ensures zero overlap with left icon */
            padding-right: 1.25rem !important;
            padding-top: 0.72rem !important;
            padding-bottom: 0.72rem !important;
            font-size: 0.875rem !important;
            border-radius: 0.75rem !important;
            border: 1.5px solid #94a3b8 !important;
            background-color: #ffffff !important;
            color: #0f172a !important;
            outline: none !important;
            display: block !important;
            transition: all 0.2s ease !important;
        }

        .input-box::placeholder {
            color: #64748b !important;
            opacity: 1 !important;
        }

        .input-box:focus {
            border-color: #4f46e5 !important;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15) !important;
        }

        .input-box.has-password-toggle {
            padding-right: 2.85rem !important; /* ensures no collision with right eye toggle */
        }

        .input-box.is-invalid,
        .input-box-error {
            border-color: #ef4444 !important;
            background-color: #fef2f2 !important;
        }

        .input-box.is-invalid:focus,
        .input-box-error:focus {
            border-color: #dc2626 !important;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.25) !important;
        }

        .dark-mode .input-box {
            background-color: #0f172a !important;
            border-color: #475569 !important;
            color: #f8fafc !important;
        }

        .dark-mode .input-box:focus {
            border-color: #6366f1 !important;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.25) !important;
        }

        .dark-mode .input-box::placeholder {
            color: #94a3b8 !important;
        }

        .dark-mode .input-box.is-invalid,
        .dark-mode .input-box-error {
            border-color: #ef4444 !important;
            background-color: rgba(239, 68, 68, 0.08) !important;
        }

        .input-icon-left {
            position: absolute !important;
            top: 0 !important;
            bottom: 0 !important;
            left: 0 !important;
            width: 2.85rem !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            color: #64748b !important;
            pointer-events: none !important;
            z-index: 5 !important;
        }

        .input-icon-right {
            position: absolute !important;
            top: 0 !important;
            bottom: 0 !important;
            right: 0 !important;
            width: 2.85rem !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            color: #64748b !important;
            cursor: pointer !important;
            z-index: 5 !important;
            background: transparent !important;
            border: none !important;
            padding: 0 !important;
            outline: none !important;
        }

        .input-icon-right:hover {
            color: #0f172a !important;
        }

        .dark-mode .input-icon-left,
        .dark-mode .input-icon-right {
            color: #94a3b8 !important;
        }

        .dark-mode .input-icon-right:hover {
            color: #f8fafc !important;
        }

        /* Smooth Pill Switcher */
        .tab-pill-container {
            background-color: #e2e8f0;
            border-radius: 14px;
            padding: 4px;
            display: flex;
            gap: 4px;
            border: 1px solid #cbd5e1;
            transition: all 0.3s ease;
            margin-bottom: 1.5rem !important;
        }

        .dark-mode .tab-pill-container {
            background-color: #0f172a !important;
            border-color: #334155 !important;
        }

        .tab-pill-btn {
            flex: 1;
            padding: 8px 14px;
            font-size: 0.85rem;
            font-weight: 700;
            border-radius: 10px;
            text-align: center;
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            outline: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border: none;
        }

        .tab-pill-btn.active {
            background-color: #ffffff;
            color: #1d4ed8;
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.08);
        }

        .dark-mode .tab-pill-btn.active {
            background-color: #1e293b;
            color: #93c5fd;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.4);
        }

        .tab-pill-btn:not(.active) {
            color: #475569;
            background-color: transparent;
        }

        .tab-pill-btn:not(.active):hover {
            color: #0f172a;
        }

        .dark-mode .tab-pill-btn:not(.active) {
            color: #cbd5e1;
        }

        .dark-mode .tab-pill-btn:not(.active):hover {
            color: #ffffff;
        }

        /* Footer Link & Badge */
        .back-link {
            display: inline-flex !important;
            align-items: center !important;
            gap: 0.35rem !important;
            font-size: 0.775rem !important;
            font-weight: 700 !important;
            color: #475569 !important;
            text-decoration: none !important;
            transition: color 0.2s ease !important;
        }

        .back-link:hover {
            color: #1d4ed8 !important;
        }

        .dark-mode .back-link {
            color: #cbd5e1 !important;
        }

        .dark-mode .back-link:hover {
            color: #93c5fd !important;
        }

        .trust-badge-footer {
            margin-top: 1.5rem !important;
            padding-top: 1rem !important;
            border-top: 1px solid #e2e8f0 !important;
            text-align: center !important;
        }

        .dark-mode .trust-badge-footer {
            border-top-color: #334155 !important;
        }

        .trust-badge-text {
            display: inline-flex !important;
            align-items: center !important;
            gap: 0.4rem !important;
            font-size: 0.725rem !important;
            font-weight: 600 !important;
            color: #475569 !important;
        }

        .dark-mode .trust-badge-text {
            color: #cbd5e1 !important;
        }

        /* Responsive Breakpoints */
        @media (max-width: 480px) {
            body {
                padding: 1.25rem 0.75rem !important;
            }

            .login-card {
                padding: 1.75rem 1.15rem 1.25rem 1.15rem !important;
                border-radius: 1.125rem !important;
            }

            .theme-toggle-wrapper {
                top: 0.9rem !important;
                right: 0.9rem !important;
            }

            .theme-toggle-btn {
                width: 36px !important;
                height: 36px !important;
            }

            .brand-title {
                font-size: 1.25rem !important;
            }

            .brand-subtitle {
                font-size: 0.775rem !important;
            }

            .brand-icon-box {
                width: 38px !important;
                height: 38px !important;
            }

            .brand-logo-title {
                font-size: 1rem !important;
            }

            .tab-pill-container {
                margin-bottom: 1.2rem !important;
            }

            .tab-pill-btn {
                padding: 7px 8px !important;
                font-size: 0.8rem !important;
                gap: 5px !important;
            }

            .input-box {
                font-size: 0.825rem !important;
                padding-top: 0.65rem !important;
                padding-bottom: 0.65rem !important;
            }

            .btn-primary-login {
                padding: 0.75rem 1rem !important;
                font-size: 0.875rem !important;
            }

            #recaptcha-wrapper {
                overflow-x: auto !important;
                max-width: 100% !important;
            }
        }

        @media (max-width: 340px) {
            body {
                padding: 0.75rem 0.5rem !important;
            }

            .login-card {
                padding: 1.5rem 0.75rem 1rem 0.75rem !important;
            }

            #recaptcha-widget {
                transform: scale(0.85);
                transform-origin: center top;
            }
        }
    </style>
