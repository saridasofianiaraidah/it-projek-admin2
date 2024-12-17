<!-- resources/views/transactions/show.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card" id="transaction-detail">
        <div class="card-header">
            Detail Transaksi
        </div>
        <div class="card-body">
            <p><strong>Nama Agen:</strong> {{ $transaction->agent->nama }}</p>
            <p><strong>Nama Barang:</strong> {{ $transaction->item->nama_barang }}</p>
            <p><strong>Jumlah:</strong> {{ $transaction->quantity }}</p>
            <p><strong>Harga Satuan:</strong> Rp {{ number_format($transaction->unit_price, 0, ',', '.') }}</p>
            <p><strong>Diskon (%):</strong> {{ $transaction->discount }}%</p>
            <p><strong>Total Harga:</strong> Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</p>
            <p><strong>Metode Pembayaran:</strong> {{ ucfirst($transaction->payment_method) }}</p>
            <p><strong>Tanggal Pembelian:</strong> {{ \Carbon\Carbon::parse($transaction->purchase_date)->format('d-m-Y') }}</p>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('transactions.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
                <button class="btn btn-primary" id="share-btn">
                    <i class="fab fa-whatsapp"></i> Bagikan
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
    
    document.getElementById('share-btn').addEventListener('click', function() {
        html2canvas(document.querySelector('#transaction-detail')).then(canvas => {
            // Mengunduh gambar secara otomatis
            const link = document.createElement('a');
            link.download = 'transaction-detail.jpg';
            link.href = canvas.toDataURL('image/jpeg');
            link.click();

            // Memberikan instruksi untuk membagikan gambar secara manual
            setTimeout(() => {
                const whatsappUrl = `https://api.whatsapp.com/send?text=Detail%20transaksi%20telah%20diunduh%20sebagai%20gambar.%20Silakan%20unggah%20gambar%20ke%20WhatsApp%20secara%20manual.`;
                window.open(whatsappUrl, '_blank');
            }, 1000); // Tunggu unduhan selesai sebelum membuka WhatsApp
        }).catch(error => {
            console.error('Error saat membagikan gambar:', error);
        });
    });
</script>
@endsection
