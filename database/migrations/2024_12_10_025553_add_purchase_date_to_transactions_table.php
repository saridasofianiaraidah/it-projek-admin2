<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('transactions', function (Blueprint $table) {
        $table->dateTime('purchase_date')->nullable(); // Menambahkan kolom purchase_date
    });
}

public function down()
{
    Schema::table('transactions', function (Blueprint $table) {
        $table->dropColumn('purchase_date'); // Menghapus kolom purchase_date saat rollback
    });
}

};
