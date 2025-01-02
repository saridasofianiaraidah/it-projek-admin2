@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card" id="transaction-detail">
        <div class="card-header">
            Detail Transaksi
        </div>
        <div class="card">
            <div class="card-header">
                <h5>Transaksi ID: {{ $transaction->id }}</h5>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item"><strong>Nama Agen:</strong> {{ $transaction->agent->nama ?? 'Tidak ada nama agen' }}</li>
                    <li class="list-group-item"><strong>Nama Barang:</strong> {{ $transaction->item_name }}</li>
                    <li class="list-group-item">
                        <strong>Gambar Barang:</strong>
                        <img src="{{ $transaction->item_image ? asset('storage/' . $transaction->item_image) : asset('images/default.png') }}" 
                             alt="{{ $transaction->item_name }}" 
                             width="100">
                    </li>
                    <li class="list-group-item"><strong>Kategori:</strong> {{ $transaction->category->name ?? 'Tidak ada kategori' }}</li>
                    <li class="list-group-item"><strong>Netto (Berat):</strong> {{ $transaction->netto ?? 'Tidak ada data berat' }} kg</li>
                    <li class="list-group-item"><strong>Harga Satuan:</strong> Rp {{ number_format($transaction->unit_price, 0, ',', '.') }}</li>
                    <li class="list-group-item"><strong>Jumlah:</strong> {{ $transaction->quantity }}</li>
                    <li class="list-group-item"><strong>Diskon:</strong> {{ $transaction->discount }}%</li>
                    <li class="list-group-item"><strong>Total Harga:</strong> Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</li>
                    <li class="list-group-item"><strong>Total Setelah Diskon:</strong> Rp {{ number_format($transaction->total_price * (1 - ($transaction->discount / 100)), 0, ',', '.') }}</li>
                    <li class="list-group-item"><strong>Tanggal Pembelian:</strong> {{ \Carbon\Carbon::parse($transaction->purchase_date)->format('d-m-Y') }}</li>
                    <li class="list-group-item"><strong>Metode Pembayaran:</strong> {{ ucfirst($transaction->payment_method ?? 'Tidak ada metode pembayaran') }}</li>
                </ul>
            </div>
            <div class="card-footer">
                <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Kembali ke Daftar Transaksi</a>

                <!-- Tombol untuk membagikan ke WhatsApp -->
                <button id="share-btn" class="btn btn-success">
                    <i class="fab fa-whatsapp"></i> Bagikan
                </button>

                <!-- Tombol untuk mengunduh gambar -->
                <button id="download-btn" class="btn btn-primary">
                    <i class="fas fa-download"></i> Unduh Gambar
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
    document.getElementById('share-btn').addEventListener('click', function () {
        const button = this;
        button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Membuat Gambar...';
        button.disabled = true;

        // Membuat gambar dari elemen transaksi
        html2canvas(document.querySelector('#transaction-detail')).then(canvas => {
            const imageUrl = canvas.toDataURL('image/jpeg'); // Menyimpan data gambar dalam format base64

            // Mengunduh gambar
            const link = document.createElement('a');
            link.href = imageUrl;
            link.download = 'transaction_detail.jpg'; // Menyimpan gambar sebagai file .jpg
            link.click(); // Melakukan unduhan

            // Setelah unduhan selesai, arahkan pengguna ke WhatsApp
            const whatsappUrl = `https://api.whatsapp.com/send?text=Detail%20Transaksi:%0A- Nama%20Agen:%20{{ urlencode($transaction->agent->nama ?? 'N/A') }}%0A- Nama%20Barang:%20{{ urlencode($transaction->item_name ?? 'N/A') }}%0A- Total%20Harga:%20Rp%20{{ number_format($transaction->total_price, 0, ',', '.') }}%0A%0A`;
            window.open(whatsappUrl, '_blank'); // Membuka WhatsApp dengan pesan

            // Reset tombol setelah selesai
            button.innerHTML = '<i class="fab fa-whatsapp"></i> Bagikan';
            button.disabled = false;
        }).catch(error => {
            console.error('Error saat membuat gambar:', error);
            alert('Terjadi kesalahan saat membuat gambar. Silakan coba lagi.');
            button.innerHTML = '<i class="fab fa-whatsapp"></i> Bagikan';
            button.disabled = false;
        });
    });
</script>
@endsection
