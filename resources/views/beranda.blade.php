<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Dashboard')</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f7f8fa;
            margin: 0;
            padding: 0;
        }

        /* Sidebar Styling */
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #061a11;
            position: fixed;
            top: 0;
            left: 0;
            padding: 20px 10px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: #9fb873;
            text-align: center;
            margin-bottom: 30px;
        }

        .sidebar .menu-item {
            list-style: none;
            padding: 0;
        }

        .sidebar .menu-item li {
            margin-bottom: 20px;
        }

        .sidebar .menu-item a {
            text-decoration: none;
            font-size: 1rem;
            color: #ecf0f1;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
        }

        .sidebar .menu-item a:hover {
            color: #9fb873;
        }

        .sidebar .menu-item a.active {
            color: #9fb873;
            font-weight: bold;
        }

        /* Main Content Styling */
        .main-content {
            margin-left: 250px;
            padding: 20px;
            background-color: #fff;
            min-height: 100vh;
        }

        header {
            background-color: #9fb873;
            color: #fff;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            font-size: 1.5rem;
            margin: 0;
        }

        header .profile {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        header .profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        footer {
            text-align: center;
            padding: 10px 0;
            font-size: 0.85rem;
            color: #666;
            background-color: #f1f1f1;
            margin-top: 20px;
        }

        header .profile img src {
    width: 60px;
    height: 60px;
    border-radius: 50%;
}

    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">Toko Yulia</div>
        <ul class="menu-item">
            <li><a href="items" class="active"><i class="bi bi-box"></i> Cek Barang</a></li>
            <li><a href="agents"><i class="bi bi-people"></i> Agen</a></li>
            <li><a href="categories"><i class="bi bi-tag"></i> Kategori</a></li>
            <li><a href="Transactions"><i class="bi bi-basket"></i> Transaksi</a></li>
            <li><a href="#"><i class="bi bi-file-earmark-text"></i> Laporan</a></li>
            <li><a href="accounts"><i class="bi bi-person-plus"></i> Tambah Akun</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <header>
            <h1>@yield('title', 'Dashboard')</h1>
            <div class="profile">
                <img src="" alt="Profile">
                <a href="/login" class="btn btn-sm btn-danger">Keluar</a>
            </div>
        </header>

        <main class="container mt-4">
            @yield('content')
        </main>

        
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
