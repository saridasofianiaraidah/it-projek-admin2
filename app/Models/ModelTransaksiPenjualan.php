<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelTransaksiPenjualan extends Model
{
    use HasFactory;

    protected $table = 'kasir'; // Tabel yang digunakan

    //mendefinisikan kolom mana yang dapat diisi secara massal (mass assignment). Artinya, hanya kolom yang tercantum di dalam array ini yang bisa diisi melalui operasi massal
    protected $fillable = ['nama_karyawan', 'nama_barang', 'tanggal', 'harga', 'jumlah', 'subtotal', 'metode_pembayaran'];
}
