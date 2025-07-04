<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // ...
public function up(): void
{
    Schema::table('zukira_lapangans', function (Blueprint $table) {
        $table->unsignedInteger('harga_per_jam')->default(0)->after('nama');
    });
}
// ...

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('zukira_lapangans', function (Blueprint $table) {
            //
        });
    }
};
