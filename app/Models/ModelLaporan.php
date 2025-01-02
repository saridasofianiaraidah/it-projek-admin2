<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelLaporan extends Model
{
    use HasFactory;
    
    // Kolom yang dapat diisi secara massal (mass assignment)
    protected $fillable = ['nama_karyawan', 'tanggal', 'pendapatan'];
    
    // Jika tabel sudah dinamai 'posts', tidak perlu menyetel $table
    protected $table = 'laporan';
}
