<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->id();
            $table->string('nama_menu');
            $table->text('deskripsi')->nullable();
            $table->enum('kategori', ['sarapan', 'makan_siang', 'makan_malam', 'snack']);
            $table->enum('tipe_makanan', ['non_vegan', 'vegan'])->default('non_vegan');
            $table->integer('kalori')->nullable();
            $table->float('protein')->nullable();
            $table->float('karbohidrat')->nullable();
            $table->float('lemak')->nullable();
            $table->string('gambar')->nullable();
            $table->enum('status', ['tersedia', 'habis'])->default('tersedia');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menu');
    }
};
