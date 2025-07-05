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
            // Mengubah tipe kolom 'harga_per_jam' menjadi DECIMAL
            // DECIMAL(10, 2) bisa menyimpan angka hingga 99,999,999.99 (sangat aman)
            $table->decimal('harga_per_jam', 10, 2)->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('zukira_lapangans', function (Blueprint $table) {
            // Mengembalikan tipe kolom ke INTEGER jika migrasi di-rollback
            $table->integer('harga_per_jam')->default(0)->change();
        });
    }
};
