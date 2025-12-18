<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\MenuSchedule;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function show($id)
    {
        $orderModel = Order::with(['user', 'paketCategory', 'paketOption'])
            ->findOrFail($id);

        // ====== Menu schedules selama langganan ======
        $dailyMenus = collect();
        $todaySchedule = null;

        if ($orderModel->start_date && $orderModel->end_date) {
            $dailyMenus = MenuSchedule::with(['lunchMenu', 'dinnerMenu'])
                ->where('paket_category_id', $orderModel->paket_category_id)
                ->whereBetween('schedule_date', [
                    $orderModel->start_date->toDateString(),
                    $orderModel->end_date->toDateString(),
                ])
                ->orderBy('schedule_date', 'asc')
                ->get();
        }

        // ✅ Ambil menu hari ini (lebih aman pakai whereDate)
        $todaySchedule = MenuSchedule::with(['lunchMenu', 'dinnerMenu'])
            ->where('paket_category_id', $orderModel->paket_category_id)
            ->whereDate('schedule_date', now()->toDateString())
            ->first();

        // ====== Delivery logs (kalau tabel sudah ada) ======
        $deliveryLogs = collect();
        $todayLog = null;

        try {
            $deliveryLogs = DB::table('order_delivery_logs')
                ->where('order_id', $orderModel->id)
                ->orderBy('delivery_date', 'asc')
                ->get();

            $todayLog = $deliveryLogs->firstWhere('delivery_date', now()->toDateString());
        } catch (\Throwable $e) {
            // kalau tabel belum ada, biarkan kosong
        }

        // ====== Progress box ======
        $totalBox = (int) ($orderModel->total_box ?? 0);
        $usedBox  = (int) ($orderModel->box_terpakai ?? 0);

        if ($usedBox === 0 && $deliveryLogs->count() > 0) {
            $usedLunch  = $deliveryLogs->where('lunch_status', 'delivered')->count();
            $usedDinner = $deliveryLogs->where('dinner_status', 'delivered')->count();
            $usedBox = $usedLunch + $usedDinner;
        }

        // DEBUG OPTIONAL (kalau masih kosong, nyalakan ini)
        /*
        dd([
            'today' => now()->toDateString(),
            'order_category' => $orderModel->paket_category_id,
            'schedule_exist_today' => MenuSchedule::where('paket_category_id', $orderModel->paket_category_id)
                ->whereDate('schedule_date', now()->toDateString())
                ->exists(),
            'todaySchedule' => $todaySchedule,
            'sample_schedule' => MenuSchedule::where('paket_category_id', $orderModel->paket_category_id)
                ->orderBy('schedule_date', 'desc')
                ->first(),
        ]);
        */

        return view('admin.orders.show', compact(
            'orderModel',
            'dailyMenus',
            'todaySchedule',
            'deliveryLogs',
            'todayLog',
            'totalBox',
            'usedBox'
        ));
    }
}
