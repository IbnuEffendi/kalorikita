<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->foreignId('paket_category_id')
                  ->constrained('paket_categories');

            $table->foreignId('paket_option_id')
                  ->constrained('paket_options');

            $table->string('order_code')->unique(); // #KK-2025-001

            $table->integer('total_harga');

            // Durasi real yg dipakai (jika user upgrade, extend, dsb.)
            $table->integer('total_hari')->nullable();
            $table->integer('total_box')->nullable();

            // Tracking progress
            $table->integer('box_terpakai')->default(0);

            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            // Preferensi makanan
            $table->enum('food_preference', ['non_vegan', 'vegan'])->default('non_vegan');

            // status pesanan
            $table->enum('status', [
                'pending',
                'aktif',
                'selesai',
                'dibatalkan'
            ])->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
