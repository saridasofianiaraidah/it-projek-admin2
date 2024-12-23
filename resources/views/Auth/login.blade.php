<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield ('title')</title>

    <!-- Link ke file CSS Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" />
    
    <style>
        body {
            background: linear-gradient(135deg, #ffffff, #9fb873); /* Background gradient */
        }

        .login-container {
            width: 100%;
            max-width: 600px; /* Memperbesar ukuran card */
            margin: auto;
        }

        .login-form {
            background-color: #9fb873;
            color: #9fb873; /* Warna teks putih */
            padding: 50px; /* Memperbesar padding */
            border-radius: 12px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2); /* Shadow lebih tebal */
        }

        .login-form h2 {
            font-size: 2rem; /* Ukuran heading lebih besar */
            font-weight: 700;
            color: #ffffff; /* Warna heading putih */
        }

        .form-group label {
            font-size: 1.2rem; /* Label lebih besar */
            color: #ffffff; /* Warna label putih */
        }

        .form-control {
            padding: 15px; /* Padding input lebih besar */
            font-size: 1rem;
        }

        .btn-primary {
            font-size: 1.2rem; /* Ukuran tombol lebih besar */
            padding: 15px;
        }

        .alert {
            font-size: 1rem;
            color: #ffffff; /* Warna teks alert putih */
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #9fb873;">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/items') }}">TOKO YULIA</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <!-- Konten halaman -->
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="login-container">
            <div class="login-form">
                <h2 class="text-center mb-4">Login</h2>
    
                <form action="{{ url('/login') }}" method="POST">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                    </div>
    
                    <div class="form-group mb-4">
                        <label for="password">Password:</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
    
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
    
                @if($errors->any())
                    <div class="alert alert-danger mt-3">
                        <p>{{ $errors->first() }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
   

    <!-- Optional JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <!-- Script untuk Memunculkan Modal -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Cek apakah ada sesi 'success'
            @if(session('success'))
                var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                successModal.show();
            @endif
        });
    </script>
    
</body>
</html>
