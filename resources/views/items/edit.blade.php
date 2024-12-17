@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Barang</h1>
    
    <form action="{{ route('items.update', $item->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nama_barang">Nama Barang</label>
            <input type="text" name="nama_barang" class="form-control" value="{{ $item->nama_barang }}" required>
        </div>

        <div class="form-group">
            <label for="category_id">Kategori:</label>
            <select name="category_id" id="kategori" class="form-control @error('category_id') is-invalid @enderror" required>
                <option value="">Pilih Kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" 
                        @if ($category->id == $item->category_id) selected @endif>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="harga">Harga</label>
            <input type="number" name="harga" class="form-control" step="0.01" value="{{ $item->harga }}" required>
        </div>

        <div class="form-group">
            <label for="jumlah">Jumlah</label>
            <input type="number" name="jumlah" class="form-control" value="{{ $item->jumlah }}" required>
        </div>

        <div class="form-group">
            <label for="gambar">Gambar (kosongkan jika tidak ingin mengubah)</label>
            <input type="file" name="gambar" class="form-control">
            @if ($item->gambar)
                <img src="{{ asset('images/'.$item->gambar) }}" alt="{{ $item->nama_barang }}" width="100" class="mt-2">
            @endif
        </div>

        <button type="submit" class="btn btn-warning">Ubah</button>
        <a href="{{ route('items.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
