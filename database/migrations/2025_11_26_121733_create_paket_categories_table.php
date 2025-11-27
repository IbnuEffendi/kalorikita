<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('paket_categories', function (Blueprint $table) {
            $table->id();

            $table->string('nama_kategori');  // Weight Loss / Maintain / Bulking
            $table->string('slug')->unique(); // weightloss / maintain / bulking
            $table->string('tagline')->nullable(); // "Popular", "Best Value"
            $table->string('gambar')->nullable();  // URL gambar banner
            $table->string('kalori_range')->nullable(); // "1200-1400"
            $table->string('protein_level')->nullable(); // Low / Medium / High
            $table->text('deskripsi')->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('paket_categories');
    }
};
