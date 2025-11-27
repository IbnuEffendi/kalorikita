<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('paket_options', function (Blueprint $table) {
            $table->id();

            $table->foreignId('paket_category_id')
                  ->constrained('paket_categories')
                  ->onDelete('cascade');

            $table->string('nama_opsi'); // "7 Hari", "14 Hari", "10 Box"
            $table->integer('durasi_hari')->nullable(); // jika berbasis hari
            $table->integer('jumlah_box')->nullable();  // jika berbasis box

            $table->integer('harga');
            $table->integer('harga_coret')->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('paket_options');
    }
};
