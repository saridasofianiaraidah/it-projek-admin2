<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agent_id')->constrained()->onDelete('cascade'); // Relasi ke tabel agents
            $table->string('item_name');
            $table->string('item_image')->nullable(); // File gambar, opsional
            $table->decimal('netto', 10, 2); // Berat barang
            $table->enum('unit', ['kg', 'g', 'mg', 'l']); // Satuan berat
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // Relasi ke tabel categories
            $table->decimal('unit_price', 10, 2); // Harga satuan
            $table->integer('quantity'); // Jumlah barang
            $table->decimal('discount', 10, 2)->nullable(); // Diskon, opsional
            $table->decimal('total_price', 10, 2); // Total harga setelah diskon
            $table->date('purchase_date'); // Tanggal pembelian
            $table->enum('payment_method', ['cash', 'transfer']); // Metode pembayaran
            $table->timestamps(); // Timestamps created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
