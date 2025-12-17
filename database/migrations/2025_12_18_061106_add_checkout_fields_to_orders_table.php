<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('user_phone')->nullable()->after('customer_name');
            $table->text('address')->nullable()->after('user_phone');
            $table->text('notes')->nullable()->after('address');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'customer_name',
                'address',
                'notes',
                'paid_at',
                'midtrans_snap_token',
                'midtrans_transaction_id',
                'midtrans_transaction_status',
                'midtrans_payment_type',
                'midtrans_fraud_status',
                'raw_callback',
            ]);
        });
    }
};
