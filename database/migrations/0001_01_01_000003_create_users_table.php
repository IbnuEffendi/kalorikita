<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // identitas dasar
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');

            // peran: admin atau user biasa
            $table->enum('role', ['user', 'admin'])->default('user');

            // opsional tambahan
            $table->string('foto')->nullable();
            $table->string('no_hp')->nullable();
            $table->text('alamat')->nullable();

            // untuk fitur login
            $table->rememberToken();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
