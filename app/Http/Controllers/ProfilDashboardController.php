<?php

namespace App\Http\Controllers;

use App\Models\CalorieEntry;
use App\Models\UserTarget;
use Illuminate\Support\Facades\Auth;

class ProfilDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 👇 Kalau belum login, lempar ke login (jaga-jaga)
        if (!$user) {
            return redirect()->route('login');
        }

        // 👇 Kalau role = admin, arahkan ke dashboard admin
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        $today = now()->toDateString();

        // =========================
        // 1. KALORI HARI INI
        // =========================
        $todayCalories = (int) round(
            CalorieEntry::where('user_id', $user->id)
                ->whereDate('eaten_at', $today)
                ->sum('calories')
        );

        // =========================
        // 2. TARGET TERBARU
        // =========================
        $latestTarget = UserTarget::where('user_id', $user->id)
            ->latest('created_at')   // atau 'updated_at' kalau pakai updateOrCreate
            ->first();

        $todayTarget = $latestTarget
            ? (int) ($latestTarget->kalori_target ?? 0)
            : null;

        // =========================
        // 3. INSIGHT AI TERAKHIR (YANG TIDAK NULL)
        // =========================
        $latestInsightRow = UserTarget::where('user_id', $user->id)
            ->whereNotNull('insight')
            ->latest('created_at')   // atau 'updated_at'
            ->first();

        $lastAiInsight = $latestInsightRow?->insight;

        // =========================
        // 4. DATA LAIN (sementara dummy)
        // =========================
        $activePlan    = null;
        $recentOrders  = [];
        $notifications = [];

        return view('profil.dashboard', [
            'activePlan'     => $activePlan,
            'todayCalories'  => $todayCalories,
            'todayTarget'    => $todayTarget,
            'lastAiInsight'  => $lastAiInsight,
            'recentOrders'   => $recentOrders,
            'notifications'  => $notifications,
        ]);
    }
}
