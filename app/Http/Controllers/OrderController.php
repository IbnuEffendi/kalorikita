<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\PaketOption;
use App\Models\MenuSchedule;
use Midtrans\Config;
use Midtrans\Snap;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    // 1. TAMPILKAN FORM CHECKOUT (PILIH PAKET)
    public function showForm(Request $request)
    {
        if (!$request->has('paket_option_id')) {
            return redirect()->route('paket.list')->with('error', 'Silakan pilih durasi paket terlebih dahulu.');
        }

        // Ambil data paket yang dipilih
        $paketOption = PaketOption::with('category')->findOrFail($request->paket_option_id);
        
        // Hitung box (asumsi 2x makan per hari)
        $totalBox = $paketOption->durasi_hari * 2;

        return view('paket.checkout', compact('paketOption', 'totalBox'));
    }

    // 2. PROSES SIMPAN ORDER & MINTA TOKEN MIDTRANS
    public function store(Request $request)
    {
        // A. Validasi Input
        $request->validate([
            'paket_option_id' => 'required|exists:paket_options,id',
            'nama'            => 'required|string|max:255',
            'whatsapp'        => 'required|string',
            'alamat'          => 'required|string',
            'start_date'      => 'required|date|after_or_equal:today',
            'food_preference' => 'required|in:non_vegan,vegan',
            'catatan'         => 'nullable|string',
        ]);

        try {
            // B. Ambil Data Paket
            $paketOption = PaketOption::with('category')->findOrFail($request->paket_option_id);

            // C. Hitung Data Order
            $startDate = Carbon::parse($request->start_date);
            $endDate   = $startDate->copy()->addDays($paketOption->durasi_hari - 1);
            $totalBox  = $paketOption->durasi_hari * 2;
            
            // Generate Kode Unik
            $orderCode = 'ORD-' . now()->format('YmdHis') . '-' . rand(100, 999);

            // ==========================================================
            // [PENTING] SIMPAN KE DATABASE (Status: Pending)
            // ==========================================================
            $order = Order::create([
                'user_id'           => auth()->id(),
                'paket_category_id' => $paketOption->category->id,
                'paket_option_id'   => $paketOption->id,
                'order_code'        => $orderCode,
                'total_harga'       => $paketOption->harga,
                'total_hari'        => $paketOption->durasi_hari,
                'total_box'         => $totalBox,
                'box_terpakai'      => 0,
                'start_date'        => $startDate,
                'end_date'          => $endDate,
                'user_phone'        => $request->whatsapp,
                'address'           => $request->alamat,
                'food_preference'   => $request->food_preference,
                'notes'             => $request->catatan,
                'status'            => 'pending', // Wajib Pending dulu
            ]);

            // ==========================================================
            // KONFIGURASI MIDTRANS
            // ==========================================================
            Config::$serverKey    = config('midtrans.server_key');
            Config::$isProduction = config('midtrans.is_production');
            Config::$isSanitized  = true;
            Config::$is3ds        = true;

            // Parameter Midtrans
            $params = [
                'transaction_details' => [
                    'order_id'     => $orderCode,
                    'gross_amount' => (int) $order->total_harga,
                ],
                'customer_details' => [
                    'first_name' => $request->nama,
                    'email'      => auth()->user()->email,
                    'phone'      => $request->whatsapp,
                    'billing_address' => [
                        'address' => $request->alamat
                    ]
                ],
                'item_details' => [
                    [
                        'id'       => $paketOption->id,
                        'price'    => (int) $order->total_harga,
                        'quantity' => 1,
                        'name'     => substr('Paket ' . $paketOption->category->nama_kategori, 0, 50),
                    ]
                ]
            ];

            // Minta Snap Token
            $snapToken = Snap::getSnapToken($params);

            // Simpan token ke DB (opsional)
            $order->update(['snap_token' => $snapToken]);

            // Kirim data ke View Payment
            // Kita kirim variabel $data agar view tidak error
            $data = $request->all();
            
            return view('paket.payment', compact('order', 'snapToken', 'paketOption', 'data', 'totalBox'));

        } catch (\Exception $e) {
            Log::error('Order Error: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // 3. MIDTRANS CALLBACK (WEBHOOK)
    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            $order = Order::where('order_code', $request->order_id)->first();
            
            if ($order) {
                if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                    $order->update(['status' => 'aktif']); // Ubah jadi AKTIF
                } elseif ($request->transaction_status == 'expire' || $request->transaction_status == 'cancel') {
                    $order->update(['status' => 'dibatalkan']);
                } elseif ($request->transaction_status == 'pending') {
                    $order->update(['status' => 'pending']);
                }
            }
        }
        return response()->json(['status' => 'success']);
    }

    // 4. [BARU] TAMPILKAN MENU HARIAN USER
    public function showUserOrder($code)
    {
        // Cari Pesanan User
        $order = Order::where('order_code', $code)
                    ->where('user_id', auth()->id()) // Validasi keamanan
                    ->with(['paketCategory', 'paketOption'])
                    ->firstOrFail();

        // Ambil Jadwal Menu sesuai tanggal pesanan
        $dailyMenus = MenuSchedule::where('paket_category_id', $order->paket_category_id)
                        ->whereBetween('schedule_date', [$order->start_date, $order->end_date])
                        ->with(['lunchMenu', 'dinnerMenu'])
                        ->orderBy('schedule_date', 'asc')
                        ->get();

        return view('profil.order-detail', compact('order', 'dailyMenus'));
    }
}