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
                // Cek apakah kolom 'item_image' sudah ada
                if (!Schema::hasColumn('transactions', 'item_image')) {
                    $table->string('item_image')->nullable()->after('item_name');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        if (Schema::hasTable('transactions')) {
            Schema::table('transactions', function (Blueprint $table) {
                // Cek apakah kolom 'item_image' ada sebelum mencoba menghapusnya
                if (Schema::hasColumn('transactions', 'item_image')) {
                    $table->dropColumn('item_image');
                }
            });
        }
    }
};
