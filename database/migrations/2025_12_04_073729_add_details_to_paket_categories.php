<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('paket_categories', function (Blueprint $table) {
        $table->string('target_program')->nullable()->after('slug'); // Contoh: Turun 2-4kg
        $table->string('range_kalori')->nullable()->after('target_program'); // Contoh: 1100-1200 kkal
        $table->string('level_protein')->nullable()->after('range_kalori'); // Contoh: 60-80 gram
        $table->longText('deskripsi_lengkap')->nullable()->after('deskripsi'); // Buat teks panjang
    });
}

public function down()
{
    Schema::table('paket_categories', function (Blueprint $table) {
        $table->dropColumn(['target_program', 'range_kalori', 'level_protein', 'deskripsi_lengkap']);
    });
}
};
