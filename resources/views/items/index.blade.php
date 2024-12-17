@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Cek Barang</h1>
    <a href="{{ route('items.create') }}" class="btn mb-3" style="background-color: #9fb873; color: white; border-color: #9fb873;">Tambah Barang</a>

    @if (session('success'))
        <div class="alert alert-success" id="success-alert">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        @if ($item->gambar)
                            <img src="{{ asset('images/'.$item->gambar) }}" alt="{{ $item->nama_barang }}" width="50">
                        @else
                            <img src="{{ asset('images/default.png') }}" alt="default" width="50">
                        @endif
                    </td>
                    <td>{{ $item->nama_barang }}</td>
                    <td>{{ $item->category->name ?? 'tidak ada kategori'}}</td>
                    <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>
                        <a href="{{ route('items.edit', $item->id) }}" class="btn btn-warning">Ubah</a>
                        <form action="{{ route('items.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    // Menghilangkan notifikasi setelah 5 detik
    window.onload = function() {
        var alert = document.getElementById('success-alert');
        if (alert) {
            setTimeout(function() {
                alert.style.transition = 'opacity 0.5s ease';
                alert.style.opacity = '0';
                setTimeout(function() {
                    alert.style.display = 'none';
                }, 500);
            }, 5000);
        }
    };
</script>
@endsection
