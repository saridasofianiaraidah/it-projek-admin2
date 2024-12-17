@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Akun</h1>
        <form action="{{ route('accounts.update', $account->id) }}" method="POST" class="form-edit">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" name="nama" id="nama" value="{{ old('nama', $account->nama) }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="{{ old('email', $account->email) }}" required>
            </div>

            <div class="form-group">
                <label for="jabatan">Jabatan:</label>
                <select name="jabatan" id="jabatan" required>
                    <option value="admin" {{ $account->jabatan == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="pemilik" {{ $account->jabatan == 'pemilik' ? 'selected' : '' }}>Pemilik</option>
                    <option value="karyawan" {{ $account->jabatan == 'karyawan' ? 'selected' : '' }}>Karyawan</option>
                </select>
            </div>

            <div class="form-group">
                <label for="password">Kata Sandi (Kosongkan jika tidak ingin mengubah):</label>
                <input type="password" name="password" id="password" placeholder="Masukkan kata sandi baru">
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Kata Sandi:</label>
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Konfirmasi kata sandi baru">
            </div>

            <button type="submit" class="btn btn-warning">Ubah</button>
            <a href="{{ route('accounts.index') }}" class="btn btn-secondary">Kembali</a>
        </form>

        <style>
            .form-edit {
                max-width: 500px;
                margin: 0 auto;
                padding: 20px;
                border: 1px solid #ddd;
                border-radius: 8px;
                background-color: #f9f9f9;
            }

            .form-group {
                margin-bottom: 15px;
            }

            label {
                display: block;
                margin-bottom: 5px;
                font-weight: bold;
            }

            input[type="text"],
            input[type="email"],
            input[type="password"],
            select {
                width: 100%;
                padding: 10px;
                border: 1px solid #ddd;
                border-radius: 5px;
            }

            input[type="text"]:focus,
            input[type="email"]:focus,
            input[type="password"]:focus,
            select:focus {
                border-color: #007bff;
                outline: none;
            }

            .btn-ubah {
                background-color: #007bff;
                color: white;
                border: none;
                padding: 10px 20px;
                border-radius: 5px;
                cursor: pointer;
                font-size: 16px;
                transition: background-color 0.3s;
            }

            .btn-ubah:hover {
                background-color: #0056b3;
            }

            .btn-kembali {
                display: inline-block;
                margin-left: 10px;
                text-decoration: none;
                background-color: red;
                color: white;
                padding: 10px 20px;
                border-radius: 5px;
                transition: background-color 0.3s;
            }

            .btn-kembali:hover {
                background-color: darkred;
            }
        </style>
    </div>
@endsection
