<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (Schema::hasTable('accounts')) { // Pastikan tabel ada
            Schema::table('accounts', function (Blueprint $table) {
                $table->string('nama')->default('Unknown')->nullable();
                $table->string('password', 255)->nullable();
                $table->string('jabatan')->default('karyawan');
            });
        } else {
            // Tambahkan fallback jika tabel tidak ada
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

    public function down()
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->dropColumn(['nama', 'password', 'jabatan']);
        });
    }
};
