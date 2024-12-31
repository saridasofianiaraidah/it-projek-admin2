<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up()
{
    Schema::table('items', function (Blueprint $table) {
        if (Schema::hasColumn('items', 'kategori')) {
            $table->dropColumn('kategori');
        }
    });
    
}

public function down()
{
    Schema::table('items', function (Blueprint $table) {
        $table->string('kategori')->nullable();
    });
}

    
};
