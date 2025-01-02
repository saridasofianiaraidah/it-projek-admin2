<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->decimal('harga', 10, 2);
            $table->integer('jumlah');
            $table->string('gambar')->nullable();
            $table->decimal('netto', 10, 2);
            $table->string('unit');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('item_transaction');
    }
}
