<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('zukira_lapangans', function (Blueprint $table) {
            // Perintah untuk menghapus kolom 'harga_per_jam'
            $table->dropColumn('harga_per_jam');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('zukira_lapangans', function (Blueprint $table) {
            // Perintah untuk mengembalikan kolom jika migrasi dibatalkan (rollback)
            // 'after('nama')' menempatkan kolom setelah kolom 'nama' agar urutannya rapi.
            $table->integer('harga_per_jam')->default(0)->after('nama');
        });
    }
};
