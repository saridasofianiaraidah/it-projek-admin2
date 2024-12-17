@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Buat Akun Baru</h1>
        
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('accounts.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label for="jabatan">Jabatan</label>
                <select name="jabatan" class="form-control" required>
                    <option value="admin">Admin</option>
                    <option value="pemilik">Pemilik</option>
                    <option value="karyawan">Karyawan</option>
                </select>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('accounts.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

    <style>
        .btn-kembali {
            background-color: red; /* Warna tombol kembali */
            color: white; /* Warna teks tombol */
            padding: 10px 20px; /* Tambahkan padding di dalam tombol */
            border-radius: 5px; /* Sudut bulat untuk tombol */
            text-decoration: none; /* Hapus garis bawah */
            transition: background-color 0.3s; /* Efek transisi untuk perubahan warna */
        }

        .btn-kembali:hover {
            background-color: darkred; /* Ganti warna saat hover */
        }
    </style>
@endsection
