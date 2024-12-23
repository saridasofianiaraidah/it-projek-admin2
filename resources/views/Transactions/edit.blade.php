@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Edit Transaksi Pembelian</h1>

    <form action="{{ route('transactions.update', $transaction->id) }}" method="POST" enctype="multipart/form-data">
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

        <!-- Input Gambar -->
        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar (kosongkan jika tidak ingin mengubah)</label>
            <input type="file" name="gambar" class="form-control">
            @if ($transaction->gambar)
                <img src="{{ asset('images/'.$transaction->gambar) }}" alt="{{ $transaction->item->nama_barang }}" width="100" class="mt-2">
            @endif
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
            <label for="quantity" class="form-label">Jumlah</label>
            <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $transaction->quantity }}" min="1" required>
        </div>

        <!-- Input harga satuan -->
        <div class="mb-3">
            <label for="unit_price" class="form-label">Harga Satuan</label>
            <input type="number" class="form-control" id="unit_price" name="unit_price" value="{{ $transaction->unit_price }}" min="0" required>
        </div>

        <!-- Input diskon -->
        <div class="mb-3">
            <label for="discount" class="form-label">Diskon (%)</label>
            <input type="number" class="form-control" id="discount" name="discount" value="{{ $transaction->discount }}" min="0" max="100" required>
        </div>

        <!-- Total Harga (readonly) -->
        <div class="mb-3">
            <label for="total_price" class="form-label">Total Harga (Setelah Diskon)</label>
            <input type="text" class="form-control" id="total_price" value="{{ number_format($transaction->total_price, 2) }}" readonly>
        </div>

        <!-- Dropdown untuk memilih metode pembayaran -->
        <div class="mb-3">
            <label for="payment_method" class="form-label">Metode Pembayaran</label>
            <select class="form-control" id="payment_method" name="payment_method" required>
                <option value="cash" {{ $transaction->payment_method == 'cash' ? 'selected' : '' }}>Cash</option>
                <option value="transfer" {{ $transaction->payment_method == 'transfer' ? 'selected' : '' }}>Transfer</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Transaksi</button>
        <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const quantityInput = document.getElementById('quantity');
        const unitPriceInput = document.getElementById('unit_price');
        const discountInput = document.getElementById('discount');
        const totalPriceInput = document.getElementById('total_price');

        function calculateTotalPrice() {
            const quantity = parseFloat(quantityInput.value) || 0;
            const unitPrice = parseFloat(unitPriceInput.value) || 0;
            const discount = parseFloat(discountInput.value) || 0;

            let totalPrice = quantity * unitPrice;
            if (discount > 0) {
                totalPrice -= totalPrice * (discount / 100);
            }

            totalPriceInput.value = totalPrice.toFixed(2);
        }

        quantityInput.addEventListener('input', calculateTotalPrice);
        unitPriceInput.addEventListener('input', calculateTotalPrice);
        discountInput.addEventListener('input', calculateTotalPrice);
    });
</script>
@endsection
