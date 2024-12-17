@extends('layouts.app')  <!-- Gunakan layout umum jika ada -->

@section('content')
<div class="container">


    <h1 class="text-center mb-4">Tambah Barang</h1>

    <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="nama_barang">Nama Barang</label>
            <input type="text" name="nama_barang" class="form-control" value="{{ old('nama_barang', $item->nama_barang ?? '') }}" required>
        </div>
    
        <div class="form-group">
            <label for="category_id">Kategori</label>
            <select name="category_id" class="form-control" required>
                <option value="">Pilih Kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $item->category_id ?? '') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
    
        <div class="form-group">
            <label for="harga">Harga</label>
            <input type="number" name="harga" class="form-control" value="{{ old('harga', $item->harga ?? '') }}" required>
        </div>
    
        <div class="form-group">
            <label for="jumlah">Jumlah</label>
            <input type="number" name="jumlah" class="form-control" value="{{ old('jumlah', $item->jumlah ?? '') }}" required>
        </div>
    
        <div class="form-group">
            <label for="gambar">Gambar</label>
            <input type="file" name="gambar" class="form-control">
        </div>
    
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('items.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
    
</div>

<!-- Tambahkan style CSS khusus untuk tombol lingkaran -->
<style>
    .btn-circle {
        width: 50px;
        height: 50px;
        padding: 10px;
        border-radius: 50%;
        text-align: center;
        font-size: 20px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    
</style>
@endsection
