@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Daftar Barang</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr class="text-center">
                <th>No</th>
                <th>Nama Barang</th>
                <th>Gambar</th>
                <th>Netto (Berat)</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Jumlah</th>
                
                
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($items as $item)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $item->nama_barang }}</td>
                <td>{{ $item->category->name ?? 'Tidak ada kategori' }}</td>
                <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                <td>{{ $item->jumlah }}</td>
                <td>{{ $item->netto ?? 'Tidak tersedia' }} kg</td>
                <td class="text-center">
                    @if($item->gambar)
                        <img src="{{ asset('images/' . $item->gambar) }}" alt="{{ $item->nama_barang }}" class="img-thumbnail" style="width: 100px; height: auto;">
                    @else
                        <span class="text-muted">Tidak ada gambar</span>
                    @endif
                </td>
                <td class="text-center">
                    <a href="{{ route('items.edit', $item->id) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('items.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center text-muted">Tidak ada data barang yang tersedia.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
