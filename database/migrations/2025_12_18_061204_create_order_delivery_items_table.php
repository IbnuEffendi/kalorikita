<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_delivery_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('order_delivery_id')
                ->constrained('order_deliveries')
                ->onDelete('cascade');

            // referensi menu (optional tapi berguna)
            $table->unsignedBigInteger('menu_id')->nullable();

            $table->enum('meal_type', ['lunch', 'dinner']); // siang/malam

            // snapshot menu saat itu (biar historis aman)
            $table->string('menu_name');
            $table->integer('calories')->nullable();
            $table->integer('protein')->nullable();
            $table->integer('carbohydrate')->nullable();
            $table->integer('fat')->nullable();
            $table->string('menu_image')->nullable();

            $table->timestamps();

            $table->index(['order_delivery_id', 'meal_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_delivery_items');
    }
};
