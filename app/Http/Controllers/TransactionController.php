<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Agent;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class TransactionController extends Controller
{
    // Tampilkan daftar transaksi
    public function index()
    {
        $transactions = Transaction::with(['agent', 'category'])->get();
        return view('transactions.index', compact('transactions'));
    }

    // Tampilkan form tambah transaksi
    public function create()
    {
        $agents = Agent::all();
        $categories = Category::all();

        return view('transactions.create', compact('agents', 'categories'));
    }

    // Tampilkan detail transaksi
    public function show($id)
{
    try {
        $transaction = Transaction::with(['agent', 'category'])->findOrFail($id);
        return view('transactions.show', compact('transaction'));
    } catch (\Exception $e) {
        Log::error('Error fetching transaction:', ['error' => $e->getMessage()]);
        return redirect()->route('transactions.index')->withErrors(['message' => 'Transaksi tidak ditemukan.']);
    }
}


    // Simpan transaksi baru
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'agent_id' => 'required|exists:agents,id',
            'item_name' => 'required|string',
            'item_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'netto' => 'required|numeric',
            'unit' => 'required|in:kg,g,mg,l',
            'category_id' => 'required|exists:categories,id',
            'unit_price' => 'required|numeric',
            'quantity' => 'required|integer',
            'discount' => 'nullable|numeric|min:0|max:100',
            'purchase_date' => 'required|date',
            'payment_method' => 'required|in:cash,bank_transfer',
        ]);

        try {
            // Jika ada file gambar, simpan
            if ($request->hasFile('item_image')) {
                $validatedData['item_image'] = $request->file('item_image')->store('images', 'public');
            }

            // Hitung total harga
            $discount = $validatedData['discount'] ?? 0;
            $validatedData['total_price'] = ($validatedData['unit_price'] * $validatedData['quantity']) * (1 - ($discount / 100));

            // Simpan transaksi ke database
            Transaction::create($validatedData);

            return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil disimpan.');
        } catch (\Exception $e) {
            Log::error('Error saving transaction:', ['error' => $e->getMessage()]);
            return redirect()->back()->withErrors(['message' => 'Terjadi kesalahan saat menyimpan transaksi.']);
        }
    }

    // Simpan gambar transaksi
    public function saveTransactionImage(Request $request)
    {
        try {
            $imageData = $request->input('image');
            $imageData = str_replace('data:image/jpeg;base64,', '', $imageData);
            $imageData = base64_decode($imageData);

            $fileName = 'transaction_image_' . time() . '.jpg';
            $filePath = 'uploads/transaction_images/' . $fileName;
            Storage::disk('public')->put($filePath, $imageData);

            $imageUrl = asset('storage/' . $filePath);
            return response()->json(['url' => $imageUrl]);
        } catch (\Exception $e) {
            Log::error('Error saving transaction image:', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Gagal menyimpan gambar.'], 500);
        }
    }
}
