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
                $table->foreignId('agent_id')->constrained()->onDelete('cascade');
                $table->string('item_name');
                $table->string('item_image')->nullable();
                $table->decimal('netto', 10, 2);
                $table->enum('unit', ['kg', 'g', 'mg', 'l']);
                $table->foreignId('category_id')->constrained()->onDelete('cascade');
                $table->decimal('unit_price', 10, 2);
                $table->integer('quantity');
                $table->decimal('discount', 10, 2)->nullable();
                $table->decimal('total_price', 10, 2);
                $table->date('purchase_date');
                $table->enum('payment_method', ['cash', 'transfer']);
                $table->timestamps();
            });
        }
        

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
