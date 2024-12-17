<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Default Title')</title> <!-- Judul default jika tidak ada yield -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Tambahkan link CSS atau skrip di sini -->
</head>
<body>
    <header>
        <h1>Nama Aplikasi</h1>
        <nav>
            <ul>
                <li><a href="{{ route('accounts.index') }}">Daftar Akun</a></li>
                <li><a href="{{ route('accounts.create') }}">Tambah Akun</a></li>
                <!-- Tambahkan item menu lain sesuai kebutuhan -->
            </ul>
        </nav>
    </header>
    
    <div class="container">
        @yield('content')
    </div>
    
    <footer>
        <p>&copy; {{ date('Y') }} Nama Perusahaan. Semua hak dilindungi.</p>
    </footer>
</body>
</html>
