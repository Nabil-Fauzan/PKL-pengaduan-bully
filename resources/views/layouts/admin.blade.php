<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard Petugas') | PKL Pengaduan Bullying</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml" />

    <!-- Google Font: Source Sans Pro -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=swap" media="print" onload="this.media='all'">
    <noscript>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=swap">
    </noscript>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets-template/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets-template/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('assets-template/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

    <!-- Fix DataTables encoding glitch (↑ / ↓) using unicode escapes -->
    <style>
        table.dataTable thead .sorting:before,
        table.dataTable thead .sorting_asc:before,
        table.dataTable thead .sorting_desc:before,
        table.dataTable thead .sorting_asc_disabled:before,
        table.dataTable thead .sorting_desc_disabled:before {
            content: "\2191" !important;
        }
        table.dataTable thead .sorting:after,
        table.dataTable thead .sorting_asc:after,
        table.dataTable thead .sorting_desc:after,
        table.dataTable thead .sorting_asc_disabled:after,
        table.dataTable thead .sorting_desc_disabled:after {
            content: "\2193" !important;
        }

        /* AdminLTE Dark Mode Transitions & Fixes */
        body.dark-mode .content-wrapper {
            background-color: #343a40 !important;
            color: #fff;
        }
        body.dark-mode .card:not(.bg-info):not(.bg-success):not(.bg-warning):not(.bg-danger):not(.bg-primary) {
            background-color: #3f474e !important;
            color: #fff !important;
            border-color: #4b545c !important;
        }
        body.dark-mode .card-header {
            border-bottom-color: #4b545c !important;
        }
        body.dark-mode .table {
            color: #f8fafc !important;
        }
        body.dark-mode .table td,
        body.dark-mode .table th {
            color: #f8fafc !important;
        }
        body.dark-mode .text-dark {
            color: #f8fafc !important;
        }
        body.dark-mode .text-muted,
        body.dark-mode small.text-muted,
        body.dark-mode label.text-muted {
            color: #cbd5e1 !important;
        }
        body.dark-mode .badge.bg-primary,
        body.dark-mode .badge-primary {
            background-color: rgba(59, 130, 246, 0.25) !important;
            color: #93c5fd !important;
            border: 1px solid rgba(59, 130, 246, 0.4) !important;
            font-weight: 700 !important;
        }
        body.dark-mode .badge.bg-warning,
        body.dark-mode .badge-warning {
            background-color: rgba(245, 158, 11, 0.25) !important;
            color: #fde047 !important;
            border: 1px solid rgba(245, 158, 11, 0.4) !important;
            font-weight: 700 !important;
        }
        body.dark-mode .badge.bg-danger,
        body.dark-mode .badge-danger {
            background-color: rgba(239, 68, 68, 0.25) !important;
            color: #fca5a5 !important;
            border: 1px solid rgba(239, 68, 68, 0.4) !important;
            font-weight: 700 !important;
        }
        body.dark-mode .badge.bg-success,
        body.dark-mode .badge-success {
            background-color: rgba(16, 185, 129, 0.25) !important;
            color: #86efac !important;
            border: 1px solid rgba(16, 185, 129, 0.4) !important;
            font-weight: 700 !important;
        }
        body.dark-mode .badge.bg-info,
        body.dark-mode .badge-info {
            background-color: rgba(6, 182, 212, 0.25) !important;
            color: #a5f3fc !important;
            border: 1px solid rgba(6, 182, 212, 0.4) !important;
            font-weight: 700 !important;
        }
        body.dark-mode .badge.bg-secondary,
        body.dark-mode .badge-secondary {
            background-color: rgba(100, 116, 139, 0.25) !important;
            color: #cbd5e1 !important;
            border: 1px solid rgba(100, 116, 139, 0.4) !important;
            font-weight: 700 !important;
        }
        body.dark-mode .badge.bg-indigo {
            background-color: rgba(99, 102, 241, 0.3) !important;
            color: #c7d2fe !important;
            border: 1px solid rgba(99, 102, 241, 0.5) !important;
            font-weight: 700 !important;
        }
        body.dark-mode .table-bordered th,
        body.dark-mode .table-bordered td {
            border-color: #4b545c !important;
        }
        body.dark-mode .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(255, 255, 255, 0.03) !important;
        }
        body.dark-mode .table-hover tbody tr:hover {
            background-color: rgba(255, 255, 255, 0.06) !important;
            color: #fff !important;
        }
        body.dark-mode .form-control:not(.bg-transparent) {
            background-color: #2b3035 !important;
            border-color: #4b545c !important;
            color: #f8fafc !important;
        }
        body.dark-mode .input-group-text {
            background-color: #3f474e !important;
            border-color: #4b545c !important;
            color: #f8fafc !important;
        }
        body.dark-mode .bg-light {
            background-color: #2b3035 !important;
            border-color: #4b545c !important;
            color: #f8fafc !important;
        }
        body.dark-mode .timeline-item {
            background-color: #3f474e !important;
            color: #f8fafc !important;
            border-color: #4b545c !important;
        }
        body.dark-mode .timeline-header {
            border-bottom-color: #4b545c !important;
            color: #60a5fa !important;
        }
        body.dark-mode .timeline-body {
            color: #f8fafc !important;
        }
        body.dark-mode .modal-content {
            background-color: #343a40 !important;
            color: #f8fafc !important;
            border-color: #4b545c !important;
        }
        body.dark-mode .modal-header,
        body.dark-mode .modal-footer {
            border-color: #4b545c !important;
        }
        body.dark-mode .dropdown-menu {
            background-color: #343a40 !important;
            border-color: #4b545c !important;
        }
        body.dark-mode .dropdown-item {
            color: #dee2e6 !important;
        }
        body.dark-mode .dropdown-item:hover {
            background-color: #3f474e !important;
            color: #fff !important;
        }
        body.dark-mode .main-footer {
            background-color: #343a40 !important;
            border-color: #4b545c !important;
            color: #cbd5e1 !important;
        }
        body.dark-mode .main-footer a {
            color: #60a5fa !important;
        }
        body.dark-mode .breadcrumb-item,
        body.dark-mode .breadcrumb-item a {
            color: #cbd5e1 !important;
        }
        body.dark-mode .breadcrumb-item.active {
            color: #f8fafc !important;
        }
        body.dark-mode .card-footer {
            background-color: #343a40 !important;
            border-top-color: #4b545c !important;
            color: #f8fafc !important;
        }
        body.dark-mode .page-link {
            background-color: #343a40 !important;
            border-color: #4b545c !important;
            color: #dee2e6 !important;
        }
        body.dark-mode .page-item.active .page-link {
            background-color: #3b82f6 !important;
            border-color: #3b82f6 !important;
            color: #fff !important;
        }
        body.dark-mode .page-item.disabled .page-link {
            background-color: #2b3035 !important;
            border-color: #4b545c !important;
            color: #6c757d !important;
        }
        #admin-dark-mode-toggle {
            cursor: pointer;
        }
        #admin-dark-mode-toggle i {
            font-size: 1rem;
            transition: transform 0.2s ease, color 0.2s ease;
        }
        #admin-dark-mode-toggle:hover i {
            transform: scale(1.2);
        }
    </style>

    <!-- Immediate Theme Initialization to avoid white flash -->
    <script>
        if (localStorage.getItem('dark-mode') === 'enabled' || localStorage.getItem('admin-dark-mode') === 'enabled') {
            document.documentElement.classList.add('dark-mode');
            document.addEventListener('DOMContentLoaded', () => {
                document.body.classList.add('dark-mode');
                const navbar = document.querySelector('.main-header.navbar');
                if (navbar) {
                    navbar.classList.remove('navbar-white', 'navbar-light');
                    navbar.classList.add('navbar-dark', 'bg-dark');
                }
                const icon = document.getElementById('admin-theme-icon');
                if (icon) {
                    icon.classList.remove('fa-moon');
                    icon.classList.add('fa-sun', 'text-warning');
                }
            });
        }
    </script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('dashboard') }}" class="nav-link">Home</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Notifications Dropdown Menu -->
                @php
                    $ignoredCount = \App\Models\Pengaduan::where('status', 'baru')
                        ->where('tanggal_pengaduan', '<', now()->subDays(3))
                        ->count();
                @endphp
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        @if($ignoredCount > 0)
                            <span class="badge badge-danger navbar-badge">{{ $ignoredCount }}</span>
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">{{ $ignoredCount }} Laporan Terabaikan</span>
                        @if($ignoredCount > 0)
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('dashboard.pengaduan', ['status' => 'terabaikan']) }}" class="dropdown-item text-danger">
                                <i class="fas fa-exclamation-triangle mr-2"></i> {{ $ignoredCount }} terabaikan (>3 hari)
                            </a>
                        @endif
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('dashboard.pengaduan') }}" class="dropdown-item dropdown-footer">Lihat Semua Pengaduan</a>
                    </div>
                </li>

                <!-- Dark Mode Toggle Button -->
                <li class="nav-item">
                    <a class="nav-link" id="admin-dark-mode-toggle" href="javascript:void(0)" role="button" title="Ubah Tema Gelap/Terang">
                        <i id="admin-theme-icon" class="fas fa-moon"></i>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ route('dashboard') }}" class="brand-link">
                <span class="brand-text font-weight-light">Lapor! Bullying</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
                    <div class="image">
                        <div class="rounded-circle font-weight-bold d-flex align-items-center justify-content-center text-white" 
                            style="width: 36px; height: 36px; background-color: #4f46e5; font-size: 13px; letter-spacing: 0.5px;">
                            {{ strtoupper(substr(Auth::user()->nama, 0, 2)) }}
                        </div>
                    </div>
                    <div class="info pl-2">
                        <a href="#" class="d-block font-weight-bold text-truncate" style="max-width: 160px;">{{ Auth::user()->nama }}</a>
                        <small class="badge {{ Auth::user()->role === 'admin' ? 'bg-danger' : 'bg-warning text-dark' }} px-1.5 py-0.5 text-[10px] font-weight-bold">
                            {{ Auth::user()->role === 'admin' ? 'Administrator' : 'Petugas BK' }}
                        </small>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" data-accordion="false">
                        <li class="nav-header">Daftar Menu</li>
                        
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('dashboard.pengaduan') }}" class="nav-link {{ (request()->routeIs('dashboard.pengaduan*') || request()->routeIs('petugas.pengaduan*')) ? 'active' : '' }}">
                                <i class="nav-icon fas fa-bullhorn"></i>
                                <p>
                                    Data Pengaduan
                                    @if($ignoredCount > 0)
                                        <span class="badge badge-danger right">{{ $ignoredCount }}</span>
                                    @endif
                                </p>
                            </a>
                        </li>

                        @if(Auth::user()->role === 'admin')
                            <li class="nav-header">Manajemen Akun</li>
                            <li class="nav-item">
                                <a href="{{ route('admin.siswa') }}" class="nav-link {{ request()->routeIs('admin.siswa*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-user-graduate"></i>
                                    <p>Data Siswa</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.petugas') }}" class="nav-link {{ request()->routeIs('admin.petugas*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-user-tie"></i>
                                    <p>Data Petugas</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.setting') }}" class="nav-link {{ request()->routeIs('admin.setting*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-cogs"></i>
                                    <p>Pengaturan Jurusan</p>
                                </a>
                            </li>
                        @endif

                        <li class="nav-item">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); if(confirm('Yakin ingin keluar?')) document.getElementById('logout-form').submit();" class="nav-link text-danger">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>
                                    Logout
                                </p>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">@yield('page_title', 'Dashboard')</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active">@yield('page_title', 'Dashboard')</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <strong>Copyright &copy; {{ date('Y') }} <a href="#">SMK TI Airlangga</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0.0
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('assets-template/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets-template/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets-template/dist/js/adminlte.min.js') }}"></script>

    <!-- Admin Dark Mode Toggle Script -->
    <script>
        $(document).ready(function() {
            const toggleBtn = $('#admin-dark-mode-toggle');
            const icon = $('#admin-theme-icon');
            const navbar = $('.main-header.navbar');

            function applyAdminTheme(isDark) {
                if (isDark) {
                    $('body').addClass('dark-mode');
                    navbar.removeClass('navbar-white navbar-light').addClass('navbar-dark bg-dark');
                    icon.removeClass('fa-moon text-dark').addClass('fa-sun text-warning');
                    localStorage.setItem('dark-mode', 'enabled');
                    localStorage.setItem('admin-dark-mode', 'enabled');
                } else {
                    $('body').removeClass('dark-mode');
                    navbar.removeClass('navbar-dark bg-dark').addClass('navbar-white navbar-light');
                    icon.removeClass('fa-sun text-warning').addClass('fa-moon');
                    localStorage.setItem('dark-mode', 'disabled');
                    localStorage.setItem('admin-dark-mode', 'disabled');
                }
                $(document).trigger('admin-theme-changed', [isDark]);
            }

            toggleBtn.on('click', function(e) {
                e.preventDefault();
                const isCurrentlyDark = $('body').hasClass('dark-mode');
                applyAdminTheme(!isCurrentlyDark);
            });

            if (localStorage.getItem('dark-mode') === 'enabled' || localStorage.getItem('admin-dark-mode') === 'enabled') {
                applyAdminTheme(true);
            }
        });
    </script>

    @yield('scripts')
</body>

</html>
