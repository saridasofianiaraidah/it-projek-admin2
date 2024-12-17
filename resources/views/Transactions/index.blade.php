@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Daftar Transaksi</h1>

    <a href="{{ route('transactions.create') }}" class="btn mb-3" style="background-color: #9fb873; color: white; border-color: #9fb873;">Tambah Transaksi</a>

    <table class="table table-bordered">
       <thead>
        <tr>
            <th>No</th>
            <th>Nama Agen</th>
            <th>Nama Barang</th>
            <th>Kategori</th>
            <th>Jumlah</th>
            <th>Harga Satuan</th>
            <th>Diskon (%)</th>
            <th>Total Harga</th>
            <th>Metode Pembayaran</th>
            
            <th>Aksi</th>
        </tr>
       </thead>
       <tbody>
        @foreach($transactions as $transaction)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $transaction->agent->nama }}</td>
            <td>{{ $transaction->item->nama_barang }}</td>
            <td>{{ $transaction->item->category->name ?? '' }}</td> <!-- Perbaikan di sini -->
            <td>{{ $transaction->quantity }}</td>
            <td>Rp {{ number_format($transaction->unit_price, 0, ',', '.') }}</td>
            <td>{{ $transaction->discount }}%</td>
            <td>Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
            <td>{{ ucfirst($transaction->payment_method) }}</td>
           
            <td>
                <!-- Ganti tombol Edit menjadi Detail Transaksi -->
                <a href="{{ route('transactions.show', $transaction->id) }}" class="btn btn-success d-inline-block">Detail</a>

                <!-- Tombol Hapus -->
                <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" style="display:inline;">
                    @csrf
                    
                </form>
            </td>
        </tr>
        @endforeach
       </tbody>
    </table>
</div>
@endsection