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
    // Mengubah kolom ENUM menjadi Bahasa Inggris
    DB::statement("ALTER TABLE zukira_payments CHANGE status_verifikasi status_verifikasi ENUM('pending', 'approved', 'rejected') NOT NULL DEFAULT 'pending'");
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('zukira_payments', function (Blueprint $table) {
            //
        });
    }
};
