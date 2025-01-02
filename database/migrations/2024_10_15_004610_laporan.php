<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('laporan', function (Blueprint $table) {
            $table->id(); // Menambahkan ID otomatis
            $table->string('nama_karyawan'); // Kolom untuk nama karyawan
            $table->date('tanggal'); // Kolom untuk tanggal
            $table->decimal('pendapatan', 10, 2); // Kolom untuk pendapatan dengan 10 digit dan 2 digit di belakang koma
            $table->timestamps(); // Menambahkan kolom created_at dan updated_at otomatis
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan');
    }
};


