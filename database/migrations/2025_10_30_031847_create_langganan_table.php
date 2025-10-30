<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('langganan', function (Blueprint $table) {
            $table->id();

            // user yang berlangganan
            $table->foreignId('user_id')
                ->constrained() // ke tabel users
                ->onDelete('cascade');

            // paket yang dipilih
            $table->foreignId('paket_id')
                ->constrained('paket_catering')
                ->onDelete('cascade');

            // preferensi
            $table->enum('tujuan', ['bulking', 'diet', 'maintain'])->default('maintain');
            $table->enum('pola_makan', ['non_vegan', 'vegan'])->default('non_vegan');

            // request khusus dari user
            $table->text('request_khusus')->nullable();

            // periode langganan
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');

            // status pesanan / langganan
            $table->enum('status', ['pending', 'aktif', 'selesai', 'dibatalkan'])->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('langganan');
    }
};
