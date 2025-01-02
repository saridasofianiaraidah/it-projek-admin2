@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="header mb-4 text-center">
        <h1>Tambah Transaksi</h1>
    </div>

    <form action="{{ route('transactions.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-5 shadow rounded">
        @csrf
        <div class="mb-3">
            <label for="agent_id" class="form-label">Agen</label>
            <select name="agent_id" id="agent_id" class="form-control" required>
                @foreach($agents as $agent)
                    <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="item_name" class="form-label">Nama Barang</label>
            <input type="text" name="item_name" id="item_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="item_image" class="form-label">Gambar Barang</label>
            <input type="file" name="item_image" id="item_image" class="form-control">
        </div>

        <div class="mb-3">
            <label for="netto" class="form-label">Netto (Berat)</label>
            <input type="number" step="any" name="netto" id="netto" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="unit" class="form-label">Satuan</label>
            <select name="unit" id="unit" class="form-control" required>
                <option value="kg">Kilogram</option>
                <option value="g">Gram</option>
                <option value="mg">Miligram</option>
                <option value="l">Liter</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Kategori</label>
            <select name="category_id" id="category_id" class="form-control" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="unit_price" class="form-label">Harga Satuan</label>
            <input type="number" name="unit_price" id="unit_price" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="quantity" class="form-label">Jumlah</label>
            <input type="number" name="quantity" id="quantity" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="discount" class="form-label">Diskon (%)</label>
            <input type="number" name="discount" id="discount" class="form-control">
        </div>

        <div class="mb-3">
            <label for="purchase_date" class="form-label">Tanggal Pembelian</label>
            <input type="date" name="purchase_date" id="purchase_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="payment_method" class="form-label">Metode Pembayaran</label>
            <select name="payment_method" id="payment_method" class="form-control" required>
                <option value="cash">Tunai</option>
                <option value="bank_transfer">Transfer Bank</option>
            </select>
        </div>

        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const datetimeInput = document.getElementById('purchase_date');
        const unitPriceInput = document.getElementById('unit_price');
        const quantityInput = document.getElementById('quantity');
        const discountInput = document.getElementById('discount');
        const totalPriceInput = document.getElementById('total_price');

        // Atur tanggal pembelian default ke sekarang
        const now = new Date();
        const formattedDatetime = now.toISOString().slice(0, 19).replace('T', ' ');
        datetimeInput.value = formattedDatetime;

        // Hitung total harga
        function calculateTotalPrice() {
            const unitPrice = parseFloat(unitPriceInput.value) || 0;
            const quantity = parseInt(quantityInput.value) || 0;
            const discount = parseFloat(discountInput.value) || 0;

            const total = (unitPrice * quantity) * (1 - (discount / 100));
            totalPriceInput.value = total.toFixed(2);
        }

        unitPriceInput.addEventListener('input', calculateTotalPrice);
        quantityInput.addEventListener('input', calculateTotalPrice);
        discountInput.addEventListener('input', calculateTotalPrice);

        // Debug input form
        document.getElementById('transactionForm').addEventListener('submit', function (e) {
            console.log('Form submitted with values:', new FormData(this));
        });
    });
</script>
@endsection
