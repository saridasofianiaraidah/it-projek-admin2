<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    // Menampilkan daftar kategori
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    // Menampilkan form tambah kategori
    public function create()
    {
        return view('categories.create');
    }

    // Menyimpan kategori baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create($request->all());

        // Tambahkan alert sukses
        Alert::success('Berhasil!', 'Kategori berhasil ditambahkan.');

        return redirect()->route('categories.index');
    }

    // Menampilkan form edit kategori
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    // Memperbarui kategori
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category->update($request->all());

        // Tambahkan alert sukses
        Alert::success('Berhasil!', 'Kategori berhasil diperbarui.');

        return redirect()->route('categories.index');
    }

    // Menghapus kategori
    public function destroy(Category $category)
    {
        $category->delete();

        // Tambahkan alert sukses
        Alert::success('Berhasil!', 'Kategori berhasil dihapus.');

        return redirect()->route('categories.index');
    }
}
