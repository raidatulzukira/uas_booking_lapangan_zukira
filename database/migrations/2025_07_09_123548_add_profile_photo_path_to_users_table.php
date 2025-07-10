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
        Schema::table('users', function (Blueprint $table) {
            // PERINTAH: Tambahkan kolom baru bernama 'profile_photo_path'
            // Kolom ini bisa kosong (nullable) dan ditambahkan setelah kolom 'email'.
            $table->string('profile_photo_path', 2048)->nullable()->after('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // PERINTAH: Jika migrasi di-rollback, hapus kolom 'profile_photo_path'
            $table->dropColumn('profile_photo_path');
        });
    }
};
