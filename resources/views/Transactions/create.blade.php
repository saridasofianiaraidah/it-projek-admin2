@extends('layouts.app')

@section('content')
<h1>Tambah Transaksi</h1>
<form action="{{ route('transactions.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="agent_id">Agen</label>
        <select name="agent_id" id="agent_id" required>
            @foreach($agents as $agent)
                <option value="{{ $agent->id }}">{{ $agent->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="item_name">Nama Barang</label>
        <input type="text" name="item_name" id="item_name" required>
    </div>
    <div>
        <label for="item_image">Gambar Barang</label>
        <input type="file" name="item_image" id="item_image">
    </div>
    <div class="form-group">
        <label for="netto">Netto (Berat):</label>
        <input type="number" step="any" name="netto" id="netto" class="form-control" required>
    </div>
    
    <div>
        <label for="unit">Satuan</label>
        <select name="unit" id="unit" required>
            <option value="kg">Kilogram</option>
            <option value="g">Gram</option>
            <option value="mg">Miligram</option>
            <option value="l">Liter</option>
        </select>
    </div>
    <div>
        <label for="category_id">Kategori</label>
        <select name="category_id" id="category_id" required>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="unit_price">Harga Satuan</label>
        <input type="number" name="unit_price" id="unit_price" required>
    </div>
    <div>
        <label for="quantity">jumlah</label>
        <input type="number" name="quantity" id="quantity" required>
    </div>
    <div>
        <label for="discount">Diskon (%)</label>
        <input type="number" name="discount" id="discount">
    </div>
    <div>
        <label for="purchase_date">Tanggal Pembelian</label>
        <input type="date" name="purchase_date" id="purchase_date" required>
    </div>
    <div>
        <label for="payment_method">Metode Pembayaran</label>
        <select name="payment_method" id="payment_method" required>
            <option value="cash">Tunai</option>
            <option value="bank_transfer">Transfer Bank</option>
        </select>
    </div>
    <button type="submit">Simpan</button>
</form>

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
