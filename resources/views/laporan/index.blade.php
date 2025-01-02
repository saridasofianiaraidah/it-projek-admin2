@extends('layouts.app')

@section('content')
<div class="header">
    <h1>Data Laporan Karyawan</h1>
</div>

<div class="container">
    <!-- Data Laporan -->
    <div class="table-container mt-4">
        <table class="table table-striped table-bordered text-center">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Karyawan</th>
                    <th>Tanggal</th>
                    <th>Pendapatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($laporans as $key => $laporan)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $laporan->nama_karyawan }}</td>
                    <td>{{ \Carbon\Carbon::parse($laporan->tanggal)->format('d F Y') }}</td>
                    <td>Rp {{ number_format($laporan->pendapatan, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endsection

