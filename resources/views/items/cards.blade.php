@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Daftar Barang</h1>
    <a href="{{ route('items.create') }}" class="btn mb-3" style="background-color: #9fb873; color: white; border-color: #9fb873;">Tambah Barang</a>

    @if (session('success'))
        <div class="alert alert-success" id="success-alert">
            {{ session('success') }}
        </div>
    @endif

    <!-- Grid Card Barang -->
    <div class="row">
        @foreach ($items as $item)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                @if ($item->gambar)
                    <img src="{{ asset('images/'.$item->gambar) }}" class="card-img-top" alt="{{ $item->nama_barang }}" style="height: 200px; object-fit: cover;">
                @else
                    <img src="{{ asset('images/default.png') }}" class="card-img-top" alt="default" style="height: 200px; object-fit: cover;">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $item->nama_barang }}</h5>
                    <p class="card-text">
                        <strong>Kategori:</strong> {{ $item->category->name ?? 'Tidak ada kategori' }}<br>
                        <strong>Harga:</strong> Rp {{ number_format($item->harga, 0, ',', '.') }}<br>
                        <strong>Jumlah:</strong> {{ $item->jumlah }}
                    </p>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route('items.edit', $item->id) }}" class="btn btn-sm btn-warning">Ubah</a>
                    <form action="{{ route('items.destroy', $item->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
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
