<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profil.
     */
    public function profil()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    /**
     * Memperbarui foto profil pengguna.
     */
    public function updatePicture(Request $request)
    {
        // Validasi file gambar
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = Auth::user();

        // Menghapus gambar lama jika ada dan bukan default
        if ($user->profile_picture && $user->profile_picture !== 'default.jpg') {
            Storage::delete('public/profile_pictures/' . $user->profile_picture);
        }

        // Simpan file gambar baru
        $image = $request->file('profile_picture');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('public/profile_pictures', $imageName);

        // Perbarui data pengguna di database
        $user->profile_picture = $imageName;
        $user->save();

        return back()->with('success', 'Foto profil berhasil diperbarui.');
    }
}
