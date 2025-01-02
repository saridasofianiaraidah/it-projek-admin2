<?php

namespace App\Http\Controllers;

use App\Models\ModelLaporan; // Mengimpor model Laporan
use Illuminate\Http\Request; // Mengimpor kelas Request untuk menangani permintaan HTTP

class ControllerLaporan extends Controller
{
    // Metode untuk menampilkan semua laporan
    public function index()
    {
        // Mengambil semua data laporan dari database
        $laporans = ModelLaporan::all();
        
        // Mengirim data laporan ke view
        return view('laporan.index', ['laporans' => $laporans]);
    }
}
