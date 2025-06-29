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
        Schema::create('zukira_lapangans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('tipe'); // futsal, tenis, dll
            $table->text('lokasi');
            $table->integer('harga');
            $table->string('foto')->nullable(); // nama file foto (disimpan di folder public/lapangans)
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zukira_lapangans');
    }
};
