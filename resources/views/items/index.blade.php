@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Kelola Barang</h1>
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
                    <td>{{ $item->category->name ?? 'tidak ada kategori' }}</td>
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

<!-- Modal Pop-Up Berhasil Login -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center p-4" style="border: none; background-color: transparent;">
            <!-- Card Putih -->
            <div class="card shadow-lg p-4" style="border-radius: 20px; background-color: white;">
                <div class="card-body d-flex justify-content-center align-items-center flex-column">
                    <!-- Ikon Lingkaran dengan Margin -->
                    <div class="circle-container mb-3">
                        <div class="circle-success">
                            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="#ffffff" viewBox="0 0 16 16">
                                <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05L7.477 10.528a.75.75 0 0 1-1.08.02L4.384 8.634a.75.75 0 0 1 1.068-1.05l1.609 1.607 3.908-4.217z"/>
                            </svg>
                        </div>
                    </div>
                    <!-- Teks -->
                    <h4 class="text-success mb-2" style="font-weight: bold;">Berhasil Login</h4>
                    <p class="text-secondary">Selamat datang di <strong>TOKO YULIA</strong>.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
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
