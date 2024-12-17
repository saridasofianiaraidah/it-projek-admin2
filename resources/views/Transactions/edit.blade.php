@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Edit Transaksi Pembelian</h1>

    <form action="{{ route('transactions.update', $transaction->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Dropdown untuk memilih agen -->
        <div class="mb-3">
            <label for="agent_id" class="form-label">Nama Agen</label>
            <select class="form-control" id="agent_id" name="agent_id" required>
                @foreach($agents as $agent)
                    <option value="{{ $agent->id }}" {{ $transaction->agent_id == $agent->id ? 'selected' : '' }}>{{ $agent->nama }}</option>
                @endforeach
            </select>
        </div>

        <!-- Dropdown untuk memilih barang -->
        <div class="mb-3">
            <label for="item_id" class="form-label">Nama Barang</label>
            <select class="form-control" id="item_id" name="item_id" required>
                @foreach($items as $item)
                    <option value="{{ $item->id }}" {{ $transaction->item_id == $item->id ? 'selected' : '' }}>{{ $item->nama_barang }}</option>
                @endforeach
            </select>
        </div>

        <!-- Dropdown untuk memilih kategori -->
        <div class="mb-3">
            <label for="category_id" class="form-label">Kategori</label>
            <select class="form-control" id="category_id" name="category_id" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $transaction->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Input jumlah -->
        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" class="form-control" id="jumlah" name="jumlah" value="{{ $transaction->jumlah }}" required>
        </div>

        <!-- Input harga satuan -->
        <div class="mb-3">
            <label for="harga_satuan" class="form-label">Harga Satuan</label>
            <input type="number" class="form-control" id="harga_satuan" name="harga_satuan" value="{{ $transaction->harga_satuan }}" required>
        </div>

        <div class="mb-3">
    <label for="discount" class="form-label">Diskon (%)</label>
    <input type="number" class="form-control" id="discount" name="discount" value="{{ $transaction->discount }}" required>
</div>

<div class="mb-3">
    <label for="total_price" class="form-label">Total Harga (Setelah Diskon)</label>
    <input type="text" class="form-control" id="total_price" value="{{ number_format($transaction->total_price, 2) }}" readonly>
</div>


       

        <!-- Dropdown untuk memilih metode pembayaran -->
        <div class="mb-3">
            <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
            <select class="form-control" id="metode_pembayaran" name="metode_pembayaran" required>
                <option value="cash" {{ $transaction->metode_pembayaran == 'cash' ? 'selected' : '' }}>Cash</option>
                <option value="transfer" {{ $transaction->metode_pembayaran == 'transfer' ? 'selected' : '' }}>Transfer</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Transaksi</button>
        <a href="{{ route('Transactions.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
