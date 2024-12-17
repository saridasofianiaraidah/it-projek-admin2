<!-- resources/views/accounts/store.blade.php -->

@extends('layouts.app') <!-- Pastikan file layout app.blade.php ada -->

@section('content')
<div class="container">
    <h2>Tambah Akun Baru</h2>
    
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
            <label for="name">Nama:</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Masukkan nama" required>
        </div>
        
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Masukkan email" required>
        </div>
        
        <div class="form-group">
            <label for="role">Peran:</label>
            <select name="role" class="form-control" id="role" required>
                <option value="admin">Admin</option>
                <option value="pegawai">Pegawai</option>
                <option value="pemilik">Pemilik</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan password" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
