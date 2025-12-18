<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void
  {
    Schema::create('order_delivery_logs', function (Blueprint $table) {
      $table->id();

      $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
      $table->date('delivery_date');

      // status per meal (ceklist)
      $table->enum('lunch_status', ['pending','delivered','skipped','failed'])->default('pending');
      $table->enum('dinner_status', ['pending','delivered','skipped','failed'])->default('pending');

      $table->timestamp('lunch_delivered_at')->nullable();
      $table->timestamp('dinner_delivered_at')->nullable();

      $table->text('notes_admin')->nullable();

      $table->timestamps();

      $table->unique(['order_id', 'delivery_date']);
      $table->index(['delivery_date']);
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('order_delivery_logs');
  }
};
