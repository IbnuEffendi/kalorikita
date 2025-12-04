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
    Schema::table('paket_options', function (Blueprint $table) {
        $table->text('deskripsi')->nullable()->after('harga');
    });
}

public function down()
{
    Schema::table('paket_options', function (Blueprint $table) {
        $table->dropColumn('deskripsi');
    });
}
};
