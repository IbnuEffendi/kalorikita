<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\MenuSchedule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderAdminController extends Controller
{
    public function show($id)
    {
        $o = Order::with(['user', 'paketCategory', 'paketOption'])->findOrFail($id);

        // ====== DURASI LANGGANAN (progress) ======
        $start = Carbon::parse($o->start_date)->startOfDay();
        $end   = Carbon::parse($o->end_date)->endOfDay();
        $today = now()->startOfDay();

        $totalHari = (int) ($o->total_hari ?? max(1, $start->diffInDays($end) + 1));

        // hari berjalan: kalau belum mulai => 0, kalau lewat end => totalHari
        if ($today->lt($start)) {
            $hariBerjalan = 0;
        } elseif ($today->gt($end)) {
            $hariBerjalan = $totalHari;
        } else {
            $hariBerjalan = $start->diffInDays($today) + 1; // hari ke-1 dst
        }

        $totalBox = (int) ($o->total_box ?? ($totalHari * 2));
        $boxTerpakai = (int) ($o->box_terpakai ?? 0);

        // ====== MENU HARI INI ======
        // Ambil schedule sesuai paket_category + tanggal hari ini
        $todaySchedule = MenuSchedule::with(['lunchMenu', 'dinnerMenu'])
            ->where('paket_category_id', $o->paket_category_id)
            ->whereDate('schedule_date', $today->toDateString())
            ->first();

        // ====== LOG DELIVERY (kalau tabelnya sudah ada nanti) ======
        // Untuk sementara kosong dulu supaya blade tidak error
        $deliveryLogs = collect();

        // Mapping ringkas untuk blade (kalau kamu masih pakai $order array)
        $order = [
            'id'         => $o->id,
            'code'       => $o->order_code,
            'user_name'  => $o->user->name ?? 'Guest',
            'user_email' => $o->user->email ?? '-',
            'user_phone' => $o->user_phone ?? '-',
            'plan_name'  => $o->paketCategory->nama_kategori ?? '-',
            'total'      => (int) $o->total_harga,
            'status'     => $o->status,
            'date'       => optional($o->created_at)->format('Y-m-d H:i'),
            'notes'      => $o->notes,
            'address'    => $o->address,

            // ✅ tambahkan ini supaya Blade yang pakai $order[...] tidak kosong
            'start_date'    => optional($o->start_date)->format('Y-m-d'),
            'end_date'      => optional($o->end_date)->format('Y-m-d'),
            'total_hari'    => (int) ($o->total_hari ?? $totalHari),
            'hari_berjalan' => (int) $hariBerjalan,
            'total_box'     => (int) ($o->total_box ?? $totalBox),
            'box_terpakai'  => (int) ($o->box_terpakai ?? $boxTerpakai),
        ];


        return view('admin.orders.show', compact(
            'order',
            'o',
            'totalHari',
            'hariBerjalan',
            'totalBox',
            'boxTerpakai',
            'todaySchedule',
            'deliveryLogs'
        ));
    }
}
