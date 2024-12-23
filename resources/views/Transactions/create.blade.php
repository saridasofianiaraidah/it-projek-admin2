@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Tambah Transaksi</h1>

    <form action="{{ route('transactions.storeMultiple') }}" method="POST" enctype="multipart/form-data">
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
            <label for="payment_method" class="form-label">Metode Pembayaran</label>
            <select class="form-control" id="payment_method" name="payment_method" required>
                <option value="cash">Cash</option>
                <option value="transfer">Transfer</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="gambar" class="form-label">Gambar</label>
            <input type="file" name="gambar" class="form-control">
        </div>

        <div id="items-container">
            <div class="item-row mb-3">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="item_id[]" class="form-label">Nama Barang</label>
                        <select class="form-control" name="item_id[]" required>
                            @foreach($items as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_barang }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="quantity[]" class="form-label">Jumlah</label>
                        <input type="number" class="form-control" name="quantity[]" min="1" required>
                    </div>
                    <div class="col-md-3">
                        <label for="unit_price[]" class="form-label">Harga Satuan</label>
                        <input type="number" class="form-control" name="unit_price[]" min="0" required>
                    </div>
                    <div class="col-md-2">
                        <label for="discount[]" class="form-label">Diskon (%)</label>
                        <input type="number" class="form-control" name="discount[]" min="0" max="100">
                    </div>
                    <div class="col-md-1 d-flex align-items-end">
                        <button type="button" class="btn btn-danger remove-item">Hapus</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <button type="button" class="btn btn-success" id="add-item">Tambah Barang</button>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
        <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const itemsContainer = document.getElementById('items-container');
        const addItemButton = document.getElementById('add-item');

        addItemButton.addEventListener('click', function () {
            const newRow = document.querySelector('.item-row').cloneNode(true);
            newRow.querySelectorAll('input, select').forEach(input => input.value = '');
            itemsContainer.appendChild(newRow);
        });

        itemsContainer.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-item')) {
                e.target.closest('.item-row').remove();
            }
        });
    });
</script>
@endsection
