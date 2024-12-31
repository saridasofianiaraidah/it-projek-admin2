<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use App\Models\Agent;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TransactionController extends Controller
{
    // Menampilkan detail transaksi berdasarkan ID
    public function show($id)
    {
        $transaction = Transactions::with(['agent', 'category'])->findOrFail($id);
        return view('transactions.show', compact('transaction'));
    }

    // Halaman utama untuk daftar transaksi
    public function index()
    {
        $transactions = Transactions::with(['agent', 'category'])->get(); // Mengambil transaksi dengan relasi agent dan category
        return view('transactions.index', compact('transactions'));
    }

    // Form untuk membuat transaksi baru
    public function create()
    {
        $agents = Agent::all(); // Mengambil semua data agen
        $categories = Category::all(); // Mengambil semua kategori

        return view('transactions.create', compact('agents', 'categories'));
    }

    // Menyimpan data transaksi baru
    public function store(Request $request)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'agent_id' => 'required|exists:agents,id',
            'item_name' => 'required|string|max:255',
            'item_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'netto' => 'required|numeric|min:0',
            'unit' => 'required|string|max:10',
            'category_id' => 'required|exists:categories,id',
            'unit_price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'discount' => 'nullable|numeric|min:0|max:100',
            'purchase_date' => 'required|date',
            'payment_method' => 'required|string|in:cash,transfer',
        ]);        

        try {
            // Proses upload gambar barang (jika ada)
            if ($request->hasFile('item_image')) {
                $fileName = time() . '_' . $request->file('item_image')->getClientOriginalName();
                $filePath = $request->file('item_image')->storeAs('uploads/items', $fileName, 'public');
                $validatedData['item_image'] = $filePath;
            }

            // Hitung total harga setelah diskon
            $totalPrice = ($validatedData['unit_price'] * $validatedData['quantity']) 
            * (1 - (($validatedData['discount'] ?? 0) / 100));

            // Tambahkan total harga ke data validasi
            $validatedData['total_price'] = $totalPrice;

            // Simpan data ke database
            Transactions::create($validatedData);

            // Redirect ke halaman transaksi dengan pesan sukses
            return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil ditambahkan.');
        } catch (\Exception $e) {
            // Log error untuk debugging
            Log::error('Error storing transaction:', ['error' => $e->getMessage()]);

            // Redirect kembali dengan pesan error
            return redirect()->back()->withErrors(['message' => 'Gagal menyimpan transaksi, silakan coba lagi.']);
        }
    }
}
