<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\MenuSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeliveryController extends Controller
{
    public function today()
    {
        $today = now()->toDateString();

        // 1. Ambil semua order AKTIF yang masih dalam masa langganan
        $orders = Order::with(['user', 'paketCategory'])
            ->where('status', 'aktif')
            ->whereDate('start_date', '<=', $today)
            ->whereDate('end_date', '>=', $today)
            ->orderBy('id')
            ->get();

        // 2. Ambil menu master hari ini per paket
        $menuSchedules = MenuSchedule::with(['lunchMenu', 'dinnerMenu'])
            ->whereDate('schedule_date', $today)
            ->get()
            ->keyBy('paket_category_id');

        // 3. Ambil delivery log hari ini (kalau sudah ada)
        $deliveryLogs = collect();
        try {
            $deliveryLogs = DB::table('order_delivery_logs')
                ->where('delivery_date', $today)
                ->get()
                ->keyBy('order_id');
        } catch (\Throwable $e) {
            // tabel belum ada → aman
        }

        return view('admin.delivery.today', compact(
            'orders',
            'menuSchedules',
            'deliveryLogs',
            'today'
        ));
    }

    public function update(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'type' => 'required|in:lunch,dinner',
        ]);

        $today = now()->toDateString();

        DB::table('order_delivery_logs')->updateOrInsert(
            [
                'order_id' => $request->order_id,
                'delivery_date' => $today,
            ],
            [
                $request->type . '_status' => 'delivered',
                $request->type . '_delivered_at' => now(),
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );

        return back()->with('success', 'Delivery berhasil dicatat.');
    }
}
