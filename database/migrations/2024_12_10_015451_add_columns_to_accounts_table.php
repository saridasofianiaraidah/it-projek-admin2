<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('accounts')) {
            Schema::table('accounts', function (Blueprint $table) {
                if (!Schema::hasColumn('accounts', 'nama')) {
                    $table->string('nama')->default('Unknown')->nullable();
                }
                if (!Schema::hasColumn('accounts', 'password')) {
                    $table->string('password', 255)->nullable();
                }
                if (!Schema::hasColumn('accounts', 'jabatan')) {
                    $table->string('jabatan')->default('karyawan');
                }
            });
        } else {
            error_log('Tabel accounts tidak ditemukan. Pastikan migrasi untuk membuat tabel accounts sudah dijalankan.');
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('accounts')) {
            Schema::table('accounts', function (Blueprint $table) {
                if (Schema::hasColumn('accounts', 'nama')) {
                    $table->dropColumn('nama');
                }
                if (Schema::hasColumn('accounts', 'password')) {
                    $table->dropColumn('password');
                }
                if (Schema::hasColumn('accounts', 'jabatan')) {
                    $table->dropColumn('jabatan');
                }
            });
        }
    }
};
