<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Pengaduan Bullying - SMK TI Airlangga')</title>
    
    <!-- Link to Custom Vanilla CSS (Flat Design) -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <!-- Header & Navigation -->
    <header>
        <div class="container header-container">
            <a href="{{ url('/') }}" class="logo">
                🛡️ Airlangga Care
            </a>
            <nav>
                <a href="{{ url('/') }}">Beranda</a>
                <!-- We will add auth links dynamically here later -->
            </nav>
        </div>
    </header>

    <!-- Main Content Area -->
    <main>
        <div class="container">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; {{ date('Y') }} SMK TI Airlangga. All Rights Reserved.</p>
        </div>
    </footer>

</body>
</html>
