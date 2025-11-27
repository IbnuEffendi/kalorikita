<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('calorie_entries', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');

            // kapan makan
            $table->dateTime('eaten_at');

            // info makanan
            $table->string('meal')->comment('Nama makanan/minuman, misal: Nasi + Telur');
            $table->string('category')->nullable()->comment('Sarapan, Makan Siang, Snack, dst');

            // kalori & makro (boleh null kalau belum tahu/AI belum mengisi)
            $table->integer('calories')->nullable();
            $table->integer('carbs')->nullable();    // gram
            $table->integer('protein')->nullable();  // gram
            $table->integer('fat')->nullable();      // gram

            // sumber data: manual / ai
            $table->string('source')->default('manual'); // manual | ai

            // kalau diisi via prompt AI
            $table->text('ai_prompt')->nullable();
            $table->text('ai_raw_response')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('calorie_entries');
    }
};
