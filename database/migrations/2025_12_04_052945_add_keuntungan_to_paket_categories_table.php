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
        // Tambah kolom tipe JSON setelah deskripsi
        $table->json('keuntungan')->nullable()->after('deskripsi');
    });
}

public function down()
{
    Schema::table('paket_categories', function (Blueprint $table) {
        $table->dropColumn('keuntungan');
    });
}
};
