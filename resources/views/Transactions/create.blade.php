@extends('layouts.app')

@section('content')
<h1>Tambah Transaksi</h1>
<form action="{{ route('transactions.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="agent_id" class="form-label">Nama Agen</label>
        <select class="form-control" id="agent_id" name="agent_id" required>
            @foreach($agents as $agent)
                <option value="{{ $agent->id }}">{{ $agent->nama }}</option>
            @endforeach
        </select>
    </div>   
    <div class="mb-3">
        <label for="item_name">Nama Barang</label>
        <input type="text" name="item_name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="item_image">Gambar Barang</label>
        <input type="file" name="item_image" class="form-control">
    </div>
    <div class="mb-3 d-flex">
        <label for="netto" class="mr-2">Netto (berat)</label>
        <input type="number" id="netto" name="netto" class="form-control" step="0.01" placeholder="Masukkan berat barang" required>
        <select name="unit" class="form-control ml-2" required>
            <option value="kg">Kg</option>
            <option value="g">g</option>
            <option value="mg">mg</option> <!-- Corrected option -->
            <option value="l">L</option>  <!-- Corrected option -->
        </select>
    </div>
    <div class="mb-3">
        <label for="category_id">Kategori</label>
        <select name="category_id" class="form-control" required>
            <option value="">Pilih Kategori</option>
            @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="unit_price">Harga Satuan</label>
        <input type="number" name="unit_price" class="form-control" id="unit_price" required>
    </div>
    <div class="mb-3">
        <label for="quantity">Jumlah</label>
        <input type="number" name="quantity" class="form-control" id="quantity" required>
    </div>
    <div class="mb-3">
        <label for="discount">Diskon</label>
        <input type="number" name="discount" class="form-control" id="discount">
    </div>
    <div class="mb-3">
        <label for="total_price">Total Harga</label>
        <input type="text" name="total_price" class="form-control" id="total_price" readonly>
    </div>
    
    <div class="mb-3">
        <label for="purchase_date">Tanggal Pembelian</label>
        <input type="text" id="purchase_date" name="purchase_date" class="form-control" readonly required>
    </div>
    <div class="mb-3">
        <label for="payment_method">Metode Pembayaran</label>
        <select name="payment_method" class="form-control" required>
            <option value="">Pilih Metode Pembayaran</option>
            <option value="cash">Cash</option>
            <option value="bank_transfer">Transfer</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Kembali</a>
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

        // Set tanggal dan waktu pembelian otomatis (tanggal dan waktu sekarang)
        function setDateTime() {
            const now = new Date();
            const formattedDatetime = now.toLocaleString('id-ID', {
                year: 'numeric',
                month: '2-digit',
                day: '2-digit',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            }).replace(', ', ' '); // Untuk format dd-mm-yyyy hh:mm:ss

            datetimeInput.value = formattedDatetime;
        }

        // Set date and time on page load
        setDateTime();

    function calculateTotalPrice() {
        const unitPrice = parseFloat(unitPriceInput.value) || 0;
        const quantity = parseInt(quantityInput.value) || 0;
        const discount = parseFloat(discountInput.value) || 0;

        const total = (unitPrice * quantity) * (1 - (discount / 100));
        totalPriceInput.value = total.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
    }

    unitPriceInput.addEventListener('input', calculateTotalPrice);
    quantityInput.addEventListener('input', calculateTotalPrice);
    discountInput.addEventListener('input', calculateTotalPrice);
});

</script>
@endsection
