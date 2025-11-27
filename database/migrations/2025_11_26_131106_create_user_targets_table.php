<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_targets', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->integer('bmr')->nullable();
            $table->integer('tdee')->nullable();
            $table->integer('kalori_target')->nullable();

            $table->integer('karbo_target')->nullable();
            $table->integer('protein_target')->nullable();
            $table->integer('lemak_target')->nullable();

            $table->string('goal')->nullable(); // weightloss, maintain, bulking

            $table->text('insight')->nullable();


            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_targets');
    }
};
