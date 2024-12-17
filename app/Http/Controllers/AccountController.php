<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    // Menampilkan daftar akun
    public function index()
    {
        $accounts = Account::all();
        return view('accounts.index', compact('accounts'));
    }

    // Menampilkan halaman pembuatan akun
    public function create()
    {
        return view('accounts.create');
    }

    // Menyimpan akun baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:accounts,email',
            'jabatan' => 'required|in:admin,pemilik,karyawan',
            'password' => 'required|string|min:8|confirmed', // Validasi password
        ]);

        // Enkripsi password sebelum disimpan
        $accountData = $request->all();
        $accountData['password'] = bcrypt($request->password);

        Account::create($accountData);

        return redirect()->route('accounts.index')->with('success', 'Akun berhasil ditambahkan.');
    }

    // Menampilkan halaman edit akun
    public function edit(Account $account)
    {
        return view('accounts.edit', compact('account'));
    }

    // Memperbarui data akun
    public function update(Request $request, Account $account)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:accounts,email,' . $account->id,
            'jabatan' => 'required|in:admin,pemilik,karyawan',
            'password' => 'nullable|string|min:8|confirmed', // Password opsional, jika diisi harus sesuai dengan konfirmasi
        ]);

        $accountData = $request->all();

        // Hanya update password jika diisi
        if ($request->filled('password')) {
            $accountData['password'] = bcrypt($request->password);
        } else {
            unset($accountData['password']); // Jangan update password jika tidak diisi
        }

        $account->update($accountData);

        return redirect()->route('accounts.index')->with('success', 'Akun berhasil diperbarui.');
    }

    // Menghapus akun
    public function destroy(Account $account)
    {
        $account->delete();

        return redirect()->route('accounts.index')->with('success', 'Akun berhasil dihapus.');
    }
}
