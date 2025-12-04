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
        $table->string('label_paket')->nullable()->after('nama_kategori'); // Misal: POPULAR
        $table->string('gambar_background')->nullable()->after('deskripsi_lengkap'); // Link Gambar
    });
}

public function down()
{
    Schema::table('paket_categories', function (Blueprint $table) {
        $table->dropColumn(['label_paket', 'gambar_background']);
    });
}
};
