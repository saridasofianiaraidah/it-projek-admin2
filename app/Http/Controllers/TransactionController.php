<?php
namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Item;
use App\Models\Category;
use App\Models\Transactions;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transactions::with('agent', 'item.category')->get();
        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $agents = Agent::all();
        $items = Item::all();
        $categories = Category::all();

        return view('transactions.create', compact('agents', 'items', 'categories'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'agent_id' => 'required|exists:agents,id',
            'item_id' => 'required|exists:items,id',
            'category_id' => 'required|exists:categories,id',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0|max:100',
            'payment_method' => 'required|in:cash,transfer',
        ]);

        // Hitung total harga
        $totalPrice = $validated['quantity'] * $validated['unit_price'];
        if (!empty($validated['discount'])) {
            $totalPrice -= $totalPrice * ($validated['discount'] / 100);
        }

        // Simpan transaksi
        Transactions::create([
            'agent_id' => $validated['agent_id'],
            'item_id' => $validated['item_id'],
            'category_id' => $validated['category_id'],
            'quantity' => $validated['quantity'],
            'unit_price' => $validated['unit_price'],
            'discount' => $validated['discount'] ?? 0,
            'total_price' => $totalPrice,
            'payment_method' => $validated['payment_method'],
            'purchase_date' => now(),
        ]);         

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    public function storeMultiple(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'agent_id' => 'required|exists:agents,id',
            'payment_method' => 'required|in:cash,transfer',
            'item_id.*' => 'required|exists:items,id',
            'quantity.*' => 'required|integer|min:1',
            'unit_price.*' => 'required|numeric|min:0',
            'discount.*' => 'nullable|numeric|min:0|max:100',
        ]);

        foreach ($validated['item_id'] as $index => $itemId) {
            $quantity = $validated['quantity'][$index];
            $unitPrice = $validated['unit_price'][$index];
            $discount = $validated['discount'][$index] ?? 0;

            $totalPrice = $quantity * $unitPrice;
            if ($discount > 0) {
                $totalPrice -= $totalPrice * ($discount / 100);
            }

            Transactions::create([
                'agent_id' => $validated['agent_id'],
                'item_id' => $itemId,
                'quantity' => $quantity,
                'unit_price' => $unitPrice,
                'discount' => $discount,
                'total_price' => $totalPrice,
                'payment_method' => $validated['payment_method'],
                'purchase_date' => now(),
            ]);
        }

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil disimpan.');
    }

    public function destroy($id)
    {
        $transaction = Transactions::findOrFail($id);
        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dihapus.');
    }

    public function show($id)
    {
        $transaction = Transactions::with('agent', 'item.category')->findOrFail($id);
        return view('transactions.show', compact('transaction'));
    }

    
public function saveImage(Request $request)
{
    $imageData = $request->input('image');
    $imageName = 'transaction_' . time() . '.jpg';
    $path = public_path('images/transactions/' . $imageName);

    // Simpan gambar
    $image = str_replace('data:image/jpeg;base64,', '', $imageData);
    $image = str_replace(' ', '+', $image);
    file_put_contents($path, base64_decode($image));

    // Kembalikan URL gambar
    return response()->json(['url' => asset('images/transactions/' . $imageName)]);
}

}
