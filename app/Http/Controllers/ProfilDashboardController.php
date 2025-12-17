<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CalorieEntry;
use App\Models\UserTarget;
use App\Models\Order; 
use App\Models\MenuSchedule; // [WAJIB] Tambahkan ini untuk ambil menu harian

class ProfilDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 1. Cek Login
        if (!$user) {
            return redirect()->route('login');
        }

        // 2. Cek Role Admin
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        $today = now()->toDateString();

        // ==========================================
        // 1. DATA KALORI & TARGET
        // ==========================================
        
        $todayCalories = (int) round(
            CalorieEntry::where('user_id', $user->id)
                ->whereDate('eaten_at', $today)
                ->sum('calories')
        );

        $latestTarget = UserTarget::where('user_id', $user->id)
            ->latest('created_at')
            ->first();

        $todayTarget = $latestTarget 
            ? (int) ($latestTarget->kalori_target ?? 0) 
            : null;

        $latestInsightRow = UserTarget::where('user_id', $user->id)
            ->whereNotNull('insight')
            ->latest('created_at')
            ->first();

        $lastAiInsight = $latestInsightRow?->insight;


        // ==========================================
        // 2. DATA PESANAN & MENU HARIAN (FINAL)
        // ==========================================

        // A. Ambil semua riwayat pesanan
        $allOrders = Order::where('user_id', $user->id)
            ->with(['paketCategory', 'paketOption']) 
            ->orderBy('created_at', 'desc')
            ->get();

        // B. Cari Paket yang Sedang AKTIF Hari Ini
        $activePlan = $allOrders->where('status', 'aktif')
            ->where('start_date', '<=', $today) // Sudah mulai
            ->where('end_date', '>=', $today)   // Belum berakhir
            ->first();

        // (Fallback: Jika tidak ada yg aktif hari ini, ambil yg statusnya aktif terakhir)
        if (!$activePlan) {
            $activePlan = $allOrders->where('status', 'aktif')->first();
        }

        // C. [BARU] Ambil Menu Makan Siang & Malam HARI INI
        $todaysMenu = null;
        if ($activePlan) {
            $todaysMenu = MenuSchedule::where('paket_category_id', $activePlan->paket_category_id)
                            ->where('schedule_date', $today)
                            ->with(['lunchMenu', 'dinnerMenu'])
                            ->first();
        }

        // D. Hitung Sisa Box (Opsional, untuk progress bar)
        // Asumsi: Box terpakai dihitung dari selisih hari mulai sampai hari ini * 2
        if ($activePlan && $activePlan->status == 'aktif') {
            $daysPassed = \Carbon\Carbon::parse($activePlan->start_date)->diffInDays(now()) + 1;
            // Pastikan tidak minus dan tidak lebih dari total
            $daysPassed = max(0, min($daysPassed, $activePlan->total_hari));
            $boxUsed = $daysPassed * 2; // 2 box per hari
            
            // Update data box terpakai di object (hanya untuk tampilan, tidak save DB disini biar cepat)
            $activePlan->box_terpakai = $boxUsed;
        }

        $notifications = [];

        return view('profil.dashboard', [
            'user'          => $user,
            'todayCalories' => $todayCalories,
            'todayTarget'   => $todayTarget,
            'lastAiInsight' => $lastAiInsight,
            'activePlan'    => $activePlan,   // Data Paket Aktif
            'todaysMenu'    => $todaysMenu,   // [BARU] Data Menu Siang/Malam Hari Ini
            'recentOrders'  => $allOrders,    // List Riwayat
            'notifications' => $notifications
        ]);
    }
}