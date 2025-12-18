<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\MenuSchedule;
use App\Models\OrderDeliveryLog;
use App\Services\MidtransService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    /**
     * MIDTRANS CALLBACK (WEBHOOK)
     * Route harus tanpa auth (Midtrans server tidak login)
     */
    public function callback(Request $request, MidtransService $midtransService)
    {
        $payload = $request->all();

        // 1) Verify signature
        if (!$midtransService->verifySignature(
            $request->order_id,
            $request->status_code,
            $request->gross_amount,
            $request->signature_key
        )) {
            Log::warning('Midtrans callback with invalid signature', ['payload' => $payload]);
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        // 2) Find order by order_code (order_id Midtrans == order_code kita)
        $order = Order::where('order_code', $request->order_id)->first();
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        // 3) Validate amount
        $gross    = (int) round((float) $request->gross_amount);
        $expected = (int) $order->total_harga;

        if ($gross !== $expected) {
            Log::warning('Amount mismatch', ['gross' => $gross, 'expected' => $expected, 'order' => $order->id]);
            return response()->json(['message' => 'Amount mismatch'], 422);
        }

        // 4) Map Midtrans status -> status internal
        $mappedStatus = $midtransService->mapTransactionStatus(
            $request->transaction_status,
            $request->fraud_status
        );

        $paidAt = $order->paid_at;
        if ($mappedStatus === 'aktif' && !$order->paid_at) {
            $paidAt = now();
        }

        // 5) Save callback data
        $order->update([
            'status'                      => $mappedStatus,
            'midtrans_transaction_id'     => $request->transaction_id,
            'midtrans_transaction_status' => $request->transaction_status,
            'midtrans_payment_type'       => $request->payment_type,
            'midtrans_fraud_status'       => $request->fraud_status,
            'paid_at'                     => $paidAt,
            'raw_callback'                => json_encode($payload),
        ]);

        return response()->json(['status' => 'success']);
    }

    /**
     * USER: Detail langganan + menu (master schedule)
     * + log delivery (kalau kamu sudah bikin tabel log)
     */
    public function showUserOrder(string $code)
    {
        $order = Order::where('order_code', $code)
            ->where('user_id', auth()->id())
            ->with(['paketCategory', 'paketOption'])
            ->firstOrFail();

        // Ambil menu schedule (menu master) untuk range tanggal langganan
        $dailyMenus = collect();

        if ($order->start_date && $order->end_date) {
            $dailyMenus = MenuSchedule::where('paket_category_id', $order->paket_category_id)
                ->whereBetween('schedule_date', [$order->start_date, $order->end_date])
                ->with(['lunchMenu', 'dinnerMenu'])
                ->orderBy('schedule_date', 'asc')
                ->get();
        }

        // OPTIONAL: jika sudah ada tabel log delivery
        $deliveryLogs = collect();
        if (class_exists(OrderDeliveryLog::class)) {
            $deliveryLogs = OrderDeliveryLog::with(['lunchMenu', 'dinnerMenu'])
                ->where('order_id', $order->id)
                ->orderBy('delivery_date', 'asc')
                ->get();
        }

        // Menu hari ini (kalau masih dalam periode)
        $todayMenu = null;
        $today = now()->startOfDay();

        if ($order->start_date && $order->end_date && $today->between($order->start_date, $order->end_date)) {
            $todayMenu = MenuSchedule::with(['lunchMenu', 'dinnerMenu'])
                ->where('paket_category_id', $order->paket_category_id)
                ->whereDate('schedule_date', $today)
                ->first();
        }

        return view('profil.order-detail', compact('order', 'dailyMenus', 'deliveryLogs', 'todayMenu'));
    }
}
