<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Contoh migrasi: 2024_xx_xx_add_columns_to_accounts_table.php
public function up()
{
    Schema::table('accounts', function (Blueprint $table) {
        $table->string('nama')->default('Unknown')->nullable();
        $table->string('password', 255)->nullable();
        $table->string('jabatan')->default('karyawan');
    });
}

public function down()
{
    Schema::table('accounts', function (Blueprint $table) {
        $table->dropColumn(['nama', 'password', 'jabatan']);
    });
}

};
