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
        if (Schema::hasTable('accounts')) {
            // If the table exists, just add the new columns
            Schema::table('accounts', function (Blueprint $table) {
                $table->string('nama')->default('Unknown')->nullable();
                $table->string('password', 255)->nullable();
                $table->string('jabatan')->default('karyawan');
            });
        } else {
            // If the table does not exist, create it with required columns
            Schema::create('accounts', function (Blueprint $table) {
                $table->id();
                $table->string('email')->unique();
                $table->string('nama')->default('Unknown')->nullable();
                $table->string('password', 255)->nullable();
                $table->string('jabatan')->default('karyawan');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        if (Schema::hasTable('accounts')) {
            Schema::table('accounts', function (Blueprint $table) {
                // Remove columns if table exists
                $table->dropColumn(['nama', 'password', 'jabatan']);
            });
        } else {
            // If the table doesn't exist, there's no need to drop columns
            Schema::dropIfExists('accounts');
        }
    }
};
