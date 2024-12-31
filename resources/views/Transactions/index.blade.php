@extends('layouts.app')

@section('content')
<h1>Daftar Transaksi</h1>
<a href="{{ route('transactions.create') }}" class="btn mb-3" style="background-color: #9fb873; color: white; border-color: #9fb873;">Tambah Transaksi</a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama Agen</th>
            <th>Nama Barang</th>
            <th>Gambar Barang</th>
            <th>Netto (Berat)</th>
            <th>Kategori</th>
            <th>Harga Satuan</th>
            <th>Jumlah</th>
            <th>Diskon</th>
            <th>Total Harga</th>
            <th>Tanggal Pembelian</th>
            <th>Metode Pembayaran</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($transactions as $transaction)
        <tr>
            <td>{{ $transaction->agent->nama ?? 'Tidak ada nama agen' }}</td>
            <td>{{ $transaction->item_name }}</td>
            <td>
                <img src="{{ $transaction->item_image ? asset('storage/' . $transaction->item_image) : asset('images/default.png') }}" 
                     alt="{{ $transaction->item_name }}" 
                     width="50">
            </td>
            <td>{{ $transaction->category->name ?? 'Tidak ada kategori' }}</td>
            <td>Rp {{ number_format($transaction->unit_price, 0, ',', '.') }}</td>
            <td>{{ $transaction->quantity }}</td>
            <td>{{ $transaction->discount }}%</td>
            <td>Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
            <td>Rp {{ number_format($transaction->total_price * (1 - ($transaction->discount / 100)), 0, ',', '.') }}</td>
            <td>{{ \Carbon\Carbon::parse($transaction->purchase_date)->format('d-m-Y') }}</td>
            <td>{{ ucfirst($transaction->payment_method ?? 'Tidak ada metode pembayaran') }}</td>
            <td>
                <a href="{{ route('transactions.show', $transaction->id) }}" class="btn btn-info btn-sm">Detail</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
