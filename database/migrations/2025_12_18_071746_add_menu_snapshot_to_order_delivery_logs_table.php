<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('order_delivery_logs', function (Blueprint $table) {
            $table->string('lunch_menu_name')->nullable()->after('delivery_date');
            $table->string('dinner_menu_name')->nullable()->after('lunch_menu_name');
        });
    }

    public function down(): void
    {
        Schema::table('order_delivery_logs', function (Blueprint $table) {
            $table->dropColumn([
                'lunch_menu_name',
                'dinner_menu_name',
            ]);
        });
    }
};
