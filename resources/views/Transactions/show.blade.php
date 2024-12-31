@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card" id="transaction-detail">
        <div class="card-header">
            Detail Transaksi
        </div>
        <div class="card-body">
            <p><strong>Nama Agen:</strong> {{ $transaction->agent ? $transaction->agent->nama : 'N/A' }}</p>
            <p><strong>Nama Barang:</strong> {{ $transaction->item ? $transaction->item->nama_barang : 'N/A' }}</p>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
    document.getElementById('share-btn').addEventListener('click', function () {
        const button = this;
        button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Membuat Gambar...';
        button.disabled = true;

        html2canvas(document.querySelector('#transaction-detail')).then(canvas => {
            const imageData = canvas.toDataURL('image/jpeg');

            // Kirim gambar ke server
            fetch('{{ route("save.transaction.image") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ image: imageData })
            })
                .then(response => response.json())
                .then(data => {
                    const whatsappUrl = `https://api.whatsapp.com/send?text=Detail%20transaksi:%0A- Nama%20Agen:%20{{ urlencode($transaction->agent->nama ?? 'N/A') }}%0A- Nama%20Barang:%20{{ urlencode($transaction->item->nama_barang ?? 'N/A') }}%0A- Total%20Harga:%20Rp%20{{ number_format($transaction->total_price, 0, ',', '.') }}%0A%0AKlik%20tautan%20untuk%20melihat%20gambar:%0A${data.url}`;
                    window.open(whatsappUrl, '_blank');

                    button.innerHTML = '<i class="fab fa-whatsapp"></i> Bagikan';
                    button.disabled = false;
                })
                .catch(error => {
                    console.error('Error saat menyimpan gambar:', error);
                    alert('Terjadi kesalahan saat menyimpan gambar. Silakan coba lagi.');
                    button.innerHTML = '<i class="fab fa-whatsapp"></i> Bagikan';
                    button.disabled = false;
                });
        }).catch(error => {
            console.error('Error saat membuat gambar:', error);
            alert('Terjadi kesalahan saat membuat gambar. Silakan coba lagi.');
            button.innerHTML = '<i class="fab fa-whatsapp"></i> Bagikan';
            button.disabled = false;
        });
    });
</script>

@endsection
