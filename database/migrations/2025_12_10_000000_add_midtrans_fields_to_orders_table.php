<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('midtrans_snap_token')->nullable()->after('order_code');
            $table->string('midtrans_transaction_id')->nullable()->after('midtrans_snap_token');
            $table->string('midtrans_transaction_status')->nullable()->after('midtrans_transaction_id');
            $table->string('midtrans_payment_type')->nullable()->after('midtrans_transaction_status');
            $table->string('midtrans_fraud_status')->nullable()->after('midtrans_payment_type');
            $table->timestamp('paid_at')->nullable()->after('midtrans_fraud_status');
            $table->longText('raw_callback')->nullable()->after('paid_at');

            $table->index('status');
            $table->index('order_code');
        });

        DB::statement("ALTER TABLE orders MODIFY status ENUM('pending','aktif','selesai','dibatalkan','expired','failed') DEFAULT 'pending'");
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['order_code']);

            $table->dropColumn([
                'midtrans_snap_token',
                'midtrans_transaction_id',
                'midtrans_transaction_status',
                'midtrans_payment_type',
                'midtrans_fraud_status',
                'paid_at',
                'raw_callback',
            ]);
        });

        DB::statement("ALTER TABLE orders MODIFY status ENUM('pending','aktif','selesai','dibatalkan') DEFAULT 'pending'");
    }
};
