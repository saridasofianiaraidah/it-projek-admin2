<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ItemController extends Controller
{
    // Menampilkan daftar item
    // Controller untuk Item
public function index()
{
    // Mengambil data item yang terkait dengan transaksi tertentu (misalnya transaksi dengan ID tertentu)
    $items = Item::with('transactions')->get(); // Ambil semua item dengan transaksi terkait

    return view('items.index', compact('items'));
}



    // Menyimpan item baru ke database
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'harga' => 'required|numeric|min:0',
            'jumlah' => 'required|integer|min:1',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'netto' => 'required|numeric|min:0',
            'unit' => 'required|string|in:kg,g,mg,l',
        ]);

        try {
            // Proses upload gambar jika ada
            if ($request->hasFile('gambar')) {
                $fileName = time() . '_' . $request->file('gambar')->getClientOriginalName();
                $filePath = $request->file('gambar')->storeAs('uploads/items', $fileName, 'public');
                $validatedData['gambar'] = $filePath;
            }

            Item::create($validatedData);

            return redirect()->route('items.index')->with('success', 'Item berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error('Error creating item:', ['error' => $e->getMessage()]);
            return redirect()->back()->withErrors(['message' => 'Gagal menambahkan item, silakan coba lagi.']);
        }
    }

    // Menampilkan form untuk mengedit item
    public function edit($id)
    {
        $item = Item::findOrFail($id);
        $categories = Category::all();
        return view('items.edit', compact('item', 'categories'));
    }

    // Memperbarui item di database
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'harga' => 'required|numeric|min:0',
            'jumlah' => 'required|integer|min:1',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'netto' => 'required|numeric|min:0',
            'unit' => 'required|string|in:kg,g,mg,l',
        ]);

        try {
            $item = Item::findOrFail($id);

            // Proses upload gambar jika ada
            if ($request->hasFile('gambar')) {
                $fileName = time() . '_' . $request->file('gambar')->getClientOriginalName();
                $filePath = $request->file('gambar')->storeAs('uploads/items', $fileName, 'public');
                $validatedData['gambar'] = $filePath;
            }

            $item->update($validatedData);

            return redirect()->route('items.index')->with('success', 'Item berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Error updating item:', ['error' => $e->getMessage()]);
            return redirect()->back()->withErrors(['message' => 'Gagal memperbarui item, silakan coba lagi.']);
        }
    }

    // Menghapus item dari database
    public function destroy($id)
    {
        try {
            $item = Item::findOrFail($id);
            $item->delete();

            return redirect()->route('items.index')->with('success', 'Item berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Error deleting item:', ['error' => $e->getMessage()]);
            return redirect()->back()->withErrors(['message' => 'Gagal menghapus item, silakan coba lagi.']);
        }
    }
}
