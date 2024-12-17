<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;

class ItemController extends Controller
{


    // Menampilkan daftar barang
    public function index()
    {
        $items = Item::with('category')->get(); // Ambil barang dengan relasi kategori
        return view('items.index', compact('items'));
    }

    // Menampilkan form pembuatan barang
    public function create()
    {
        $categories = Category::all(); // Ambil semua kategori
        return view('items.create', compact('categories')); // Kirim data kategori ke view
    }

    // Menyimpan barang baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'jumlah' => 'required|integer',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id', // Validasi category_id
        ]);

        $imageName = null;
        if ($request->hasFile('gambar')) {
            $imageName = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('images'), $imageName);
        }

        Item::create([
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga,
            'jumlah' => $request->jumlah,
            'gambar' => $imageName,
            'category_id' => $request->category_id, // Simpan category_id
        ]);

        return redirect()->route('items.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    // Menampilkan halaman edit barang
    public function edit(Item $item)
    {
        $categories = Category::all(); // Ambil semua kategori
        return view('items.edit', compact('item', 'categories'));
    }

    // Memperbarui barang
    public function update(Request $request, Item $item)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'jumlah' => 'required|integer',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id', // Validasi category_id
        ]);

        if ($request->hasFile('gambar')) {
            if ($item->gambar) {
                $oldImagePath = public_path('images/' . $item->gambar);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $imageName = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('images'), $imageName);
            $item->gambar = $imageName;
        }

        $item->update([
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga,
            'jumlah' => $request->jumlah,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('items.index')->with('success', 'Barang berhasil diperbarui.');
    }

    // Menghapus barang
    public function destroy(Item $item)
    {
        if ($item->gambar) {
            $oldImagePath = public_path('images/' . $item->gambar);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }

        $item->delete();

        return redirect()->route('items.index')->with('success', 'Barang berhasil dihapus.');
    }
}
