<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_deliveries', function (Blueprint $table) {
            $table->id();

            $table->foreignId('order_id')
                ->constrained('orders')
                ->onDelete('cascade');

            $table->date('delivery_date');

            // status per hari
            $table->enum('status', [
                'scheduled',  // sudah dijadwalkan
                'prepared',   // sedang disiapkan
                'delivered',  // sudah dikirim
                'skipped',    // diskip (misal libur / user pause)
                'cancelled'   // dibatalkan per hari
            ])->default('scheduled');

            $table->timestamp('delivered_at')->nullable();
            $table->text('courier_note')->nullable();   // catatan dari admin/kurir
            $table->text('customer_note')->nullable();  // catatan user khusus hari ini (optional)

            $table->timestamps();

            $table->unique(['order_id', 'delivery_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_deliveries');
    }
};
