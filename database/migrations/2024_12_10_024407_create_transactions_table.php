<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id(); // Kolom id
            $table->unsignedBigInteger('agent_id'); // Kolom agent_id
            $table->string('gambar')->nullable();//menamplkan gambar
            $table->unsignedBigInteger('item_id'); // Kolom item_id
            $table->integer('quantity'); // Kolom quantity
            $table->decimal('unit_price', 8, 2); // Kolom unit_price
            $table->decimal('total_price', 10, 2); // Kolom total_price
            $table->decimal('discount', 8, 2)->default(0); // Kolom discount dengan nilai default 0
            $table->string('payment_method'); // Kolom payment_method
            $table->timestamps(); // Kolom created_at dan updated_at
            
            // Menambahkan foreign key constraints
            $table->foreign('agent_id')->references('id')->on('agents')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
