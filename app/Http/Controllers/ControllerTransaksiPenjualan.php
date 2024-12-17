<?php

namespace App\Http\Controllers;

use App\Models\ModelTransaksiPenjualan;
use Illuminate\Http\Request;

class ControllerTransaksiPenjualan extends Controller
{
    public function index()
    {
        $posts = ModelTransaksiPenjualan::all(); // Mengambil semua data transaksi
        return view('kasir', compact('posts')); // Mengembalikan view dengan data
    }

//menghitung pendapatan (revenue) berdasarkan input yang diterima dari HTTP request
    public function calculateRevenue(Request $request)
{
    // Validasi input
    $request->validate([
        'start_date' => 'required|date',
        'end_date' => 'required|date',
    ]);

    // Mengambil data transaksi berdasarkan rentang tanggal
    $transactions = ModelTransaksiPenjualan::whereBetween('tanggal', [$request->start_date, $request->end_date])->get();

    // Menghitung total pendapatan
    $totalRevenue = $transactions->sum(function($transaction) {
        return $transaction->harga * $transaction->jumlah;
    });

    // Mengembalikan total pendapatan dalam format JSON
    return response()->json(['total' => $totalRevenue]);
}

    public function createPost(Request $request)
    {
        // Validasi data yang masuk
        $incomingField = $request->validate([
            'nama_karyawan' => 'required',
            'nama_barang' => 'required',
            'tanggal' => 'required|date',
            'harga' => 'required|numeric',
            'jumlah' => 'required|numeric',
            'metode_pembayaran' => 'required',
        ]);

        // Menghitung subtotal
        $subtotal = $incomingField['harga'] * $incomingField['jumlah'];

        // Menambahkan subtotal ke dalam array data yang akan disimpan
        $incomingField['subtotal'] = $subtotal;

        // Menyimpan data ke dalam model
        ModelTransaksiPenjualan::create($incomingField);

        // Redirect setelah berhasil menyimpan
        return redirect('/kasir')->with('success', 'Transaksi berhasil ditambahkan.'); // Menambahkan pesan sukses
    }
}
