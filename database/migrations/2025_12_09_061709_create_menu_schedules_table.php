<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('menu_schedules', function (Blueprint $table) {
            $table->id();
            
            // 1. Konek ke Tabel Paket (Sesuai foto: paket_categories)
            $table->foreignId('paket_category_id')
                  ->constrained('paket_categories') 
                  ->onDelete('cascade');
            
            // 2. Tanggal Jadwal Menu (Yg dibilang Ibnu "Batch")
            $table->date('schedule_date'); 
            
            // 3. Menu Siang (Konek ke tabel 'menus')
            // NOTE: Kalau error "table menus not found", ganti 'menus' jadi 'menu'
            $table->foreignId('lunch_menu_id')->constrained('menu')->onDelete('cascade');
            
            // 4. Menu Malam (Konek ke tabel 'menus')
            $table->foreignId('dinner_menu_id')->constrained('menu')->onDelete('cascade');
            
            $table->timestamps();

            // Mencegah admin input 2 jadwal di tanggal & paket yg sama
            $table->unique(['paket_category_id', 'schedule_date']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('menu_schedules');
    }
};