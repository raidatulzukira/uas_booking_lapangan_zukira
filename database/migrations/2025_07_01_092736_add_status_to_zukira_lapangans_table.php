<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('zukira_lapangans', function (Blueprint $table) {
            $table->enum('status', ['tersedia', 'tidak tersedia', 'maintenance'])->default('tersedia')->after('foto');
        });
    }

    public function down(): void
    {
        Schema::table('zukira_lapangans', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};