<?php

// database/migrations/xxxx_xx_xx_xxxxxx_add_booking_id_to_zukira_reviews_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('zukira_reviews', function (Blueprint $table) {
            // Tambahkan kolom booking_id setelah lapangan_id
            $table->foreignId('booking_id')
                  ->nullable() // Sementara nullable agar tidak error di data lama
                  ->after('lapangan_id')
                  ->constrained('zukira_bookings') // Pastikan nama tabel booking benar
                  ->onDelete('cascade'); // Jika booking dihapus, review ikut terhapus
                  
            // Membuat setiap booking_id unik, artinya 1 booking hanya bisa punya 1 review
            $table->unique('booking_id'); 
        });
    }

    public function down(): void
    {
        Schema::table('zukira_reviews', function (Blueprint $table) {
            $table->dropForeign(['booking_id']);
            $table->dropUnique(['booking_id']);
            $table->dropColumn('booking_id');
        });
    }
};