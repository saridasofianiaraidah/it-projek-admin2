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
        if (Schema::hasTable('transactions')) {
            Schema::table('transactions', function (Blueprint $table) {
                if (!Schema::hasColumn('transactions', 'purchase_date')) {
                    $table->dateTime('purchase_date')->nullable(); // Menambahkan kolom purchase_date
                }
            });
        } else {
            error_log('Tabel transactions tidak ditemukan. Pastikan migrasi yang membuat tabel ini sudah dijalankan.');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        if (Schema::hasTable('transactions')) {
            Schema::table('transactions', function (Blueprint $table) {
                if (Schema::hasColumn('transactions', 'purchase_date')) {
                    $table->dropColumn('purchase_date'); // Menghapus kolom purchase_date saat rollback
                }
            });
        }
    }
};
