<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfilOrderController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $statusFilter = $request->query('status', 'all'); // all|aktif|selesai|pending|dibatalkan

        $q = Order::query()
            ->where('user_id', $user->id)
            ->with(['paketCategory', 'paketOption'])
            ->orderByDesc('created_at');

        if ($statusFilter !== 'all') {
            $q->where('status', $statusFilter);
        }

        $orders = $q->get();

        // Hitung used box dari delivery logs (lebih akurat dari "hari berjalan")
        $orderIds = $orders->pluck('id')->all();

        $usedByOrder = collect();
        if (!empty($orderIds)) {
            try {
                $rows = DB::table('order_delivery_logs')
                    ->selectRaw("
                        order_id,
                        SUM(CASE WHEN lunch_status='delivered' THEN 1 ELSE 0 END) AS lunch_delivered,
                        SUM(CASE WHEN dinner_status='delivered' THEN 1 ELSE 0 END) AS dinner_delivered
                    ")
                    ->whereIn('order_id', $orderIds)
                    ->groupBy('order_id')
                    ->get();

                $usedByOrder = $rows->mapWithKeys(function ($r) {
                    $used = (int)($r->lunch_delivered ?? 0) + (int)($r->dinner_delivered ?? 0);
                    return [$r->order_id => $used];
                });
            } catch (\Throwable $e) {
                // jika tabel belum ada / belum migrate, fallback ke box_terpakai
            }
        }

        return view('profil.myorder', compact('user', 'orders', 'statusFilter', 'usedByOrder'));
    }
}
