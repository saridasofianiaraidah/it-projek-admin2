<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Yulia</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f7f7f7;
        }

        .navbar {
            background-color: #9fb873;
            color: white;
            width: 100%;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .navbar .brand {
            font-size: 24px;
            font-weight: bold;
        }

        .navbar .links {
            display: flex;
            gap: 15px;
        }

        .navbar .links a {
            color: white;
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
            transition: color 0.2s;
        }

        .navbar .links a:hover {
            color: #9fb873;
        }

        .container {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 100px;
        }

        .button {
            background-color: #9fb873;
            color: white;
            padding: 15px 30px;
            text-align: center;
            text-decoration: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: bold;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }

        .button:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="brand">Toko Yulia</div>
        <div class="links">
        </div>
    </div>

    <div class="container">
        <a href="pemilik.html" class="button">Pemilik</a>
        <a href="http://it-projek-admin.test/login" class="button">Admin</a>
        <a href="karyawan.html" class="button">Karyawan</a>
    </div>
</body>
</html>
