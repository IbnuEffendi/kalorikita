<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('langganan_menu', function (Blueprint $table) {
            $table->id();

            // relasi ke langganan
            $table->foreignId('langganan_id')
                ->constrained('langganan')
                ->onDelete('cascade');

            // relasi ke menu
            $table->foreignId('menu_id')
                ->constrained('menu')
                ->onDelete('cascade');

            $table->date('tanggal');
            $table->enum('waktu_makan', ['sarapan', 'makan_siang', 'makan_malam']);

            $table->text('catatan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('langganan_menu');
    }
};
