<?php
namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Item;
use App\Models\Category;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transactions::with(['agent', 'item.category'])->get();
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
        $validated = $request->validate([
            'agent_id' => 'required|exists:agents,id',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'item_id' => 'required|exists:items,id',
            'category_id' => 'required|exists:categories,id',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0|max:100',
            'payment_method' => 'required|in:cash,transfer',
        ]);

        $totalPrice = $validated['quantity'] * $validated['unit_price'];
        if (!empty($validated['discount'])) {
            $totalPrice -= $totalPrice * ($validated['discount'] / 100);
        }

        $imageName = null;
        if ($request->hasFile('gambar')) {
            $imageName = $request->file('gambar')->store('transactions', 'public');
        }

        Transactions::create([
            'agent_id' => $validated['agent_id'],
            'gambar' => $imageName,
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
        $validated = $request->validate([
            'agent_id' => 'required|exists:agents,id',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'payment_method' => 'required|in:cash,transfer',
            'item_id.*' => 'required|exists:items,id',
            'quantity.*' => 'required|integer|min:1',
            'unit_price.*' => 'required|numeric|min:0',
            'discount.*' => 'nullable|numeric|min:0|max:100',
        ]);

        $imageName = null;
        if ($request->hasFile('gambar')) {
            $imageName = $request->file('gambar')->store('transactions', 'public');
        }

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
                'gambar' => $index === 0 ? $imageName : null,
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
        if ($transaction->gambar) {
            Storage::disk('public')->delete($transaction->gambar);
        }
        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dihapus.');
    }

    public function show($id)
    {
        $transaction = Transactions::with(['agent', 'item.category'])->findOrFail($id);
        return view('transactions.show', compact('transaction'));
    }

    public function saveImage(Request $request)
    {
        $imageData = $request->input('image');
        $imageName = 'transaction_' . time() . '.jpg';
        $path = public_path('images/transactions/' . $imageName);

        $image = str_replace('data:image/jpeg;base64,', '', $imageData);
        $image = str_replace(' ', '+', $image);
        file_put_contents($path, base64_decode($image));

        return response()->json(['url' => asset('images/transactions/' . $imageName)]);
    }
}
