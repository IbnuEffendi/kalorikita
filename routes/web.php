<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LabController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\KaloriTrackerController;
use App\Http\Controllers\ProfilDashboardController;

use App\Http\Controllers\MenuController;
use App\Http\Controllers\MenuScheduleController;

use App\Http\Controllers\PaketController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\AiLogController;
use App\Http\Controllers\ProfilOrderController;

// --- MODELS ---
use App\Models\User;
use App\Models\PaketCategory;
use App\Models\PaketOption;
use App\Models\Menu;
use App\Models\MenuSchedule;
use App\Models\Order;

/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');

// register/login/logout
Route::get('/register', fn() => view('auth.register'))->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

Route::post('/logout', function () {
    auth()->logout();
    return redirect('/');
})->name('logout');

// forgot password
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'updatePassword'])->name('password.update');

// google auth
Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');
Route::get('/connect/google', [GoogleController::class, 'connect'])->middleware('auth')->name('google.connect');

// kalori lab public page
Route::get('/kalori-lab', fn() => view('profil.kalorilab'))->name('kalori-lab');
Route::post('/kalori-lab/insight', [LabController::class, 'insight'])->name('lab.insight');
Route::get('/lab-kalori', fn() => view('labkalori'))->name('lab.kalori');

/*
|--------------------------------------------------------------------------
| KALORI TRACKER (AUTH)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/kalori-tracker', [KaloriTrackerController::class, 'index'])->name('profil.kalori.tracker');
    Route::post('/kalori-tracker/entry', [KaloriTrackerController::class, 'storeEntry'])->name('kalori.tracker.entry.store');
    Route::post('/kalori-tracker/target', [KaloriTrackerController::class, 'updateTarget'])->name('kalori.tracker.target.update');
    Route::post('/kalori-tracker/entry/ai', [KaloriTrackerController::class, 'storeEntryAi'])->name('kalori.tracker.entry.ai');
    Route::post('/kalori-tracker/performance-insight', [KaloriTrackerController::class, 'generatePerformanceInsight'])->name('kalori.tracker.insight');
});

/*
|--------------------------------------------------------------------------
| PROFIL (AUTH)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profil', [ProfilDashboardController::class, 'index'])->name('profil.dashboard');

    Route::get('/myorder', [ProfilOrderController::class, 'index'])
        ->name('profil.myorder')
        ->middleware('auth');

    Route::get('/myorder/{code}', [OrderController::class, 'showUserOrder'])
        ->name('profil.order.show');
});

/*
|--------------------------------------------------------------------------
| PAKET (USER)
|--------------------------------------------------------------------------
*/
Route::get('/paket', [PaketController::class, 'index'])->name('paket.list');
Route::get('/paket/{slug}', [PaketController::class, 'show'])->name('paket.detail');

// step 1: checkout (form pengiriman)
Route::post('/checkout', [PaketController::class, 'checkout'])->name('paket.checkout');

// step 2: payment (buat order + snap token + tampilkan view payment)
Route::post('/payment', [PaketController::class, 'payment'])->name('paket.payment');

// success page
Route::get('/pesanan/success', fn() => view('paket.success'))->name('pesanan.success');

/*
|--------------------------------------------------------------------------
| MIDTRANS CALLBACK (WEBHOOK) - TANPA AUTH
|--------------------------------------------------------------------------
*/
Route::post('/midtrans/callback', [OrderController::class, 'callback'])->name('midtrans.callback');

/*
|--------------------------------------------------------------------------
| ADMIN (AUTH)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth')
    ->group(function () {

        // =========================
        // DASHBOARD
        // =========================
        Route::get('/dashboard', function () {
            $today = now()->toDateString();

            $statsToday = [
                'orders_today'    => Order::whereDate('created_at', $today)->count(),
                'revenue_today'   => Order::whereDate('created_at', $today)->where('status', 'aktif')->sum('total_harga'),
                'new_users_today' => User::whereDate('created_at', $today)->count(),
                'active_plans'    => Order::where('status', 'aktif')->where('end_date', '>=', $today)->count(),
            ];

            $latestOrders = Order::with(['user', 'paketCategory'])
                ->latest()
                ->take(5)
                ->get()
                ->map(function ($order) {
                    return [
                        'id'        => $order->id,
                        'user_name' => $order->user->name ?? 'Guest',
                        'plan_name' => $order->paketCategory->nama_kategori ?? '-',
                        'total'     => $order->total_harga,
                        'status'    => ucfirst($order->status),
                        'created_at' => $order->created_at->diffForHumans(),
                    ];
                });

            $latestUsers = User::latest()->take(5)->get()->map(function ($u) {
                $activeOrder = Order::where('user_id', $u->id)
                    ->where('status', 'aktif')
                    ->where('end_date', '>=', now())
                    ->with('paketCategory')
                    ->first();

                return [
                    'name'        => $u->name,
                    'email'       => $u->email,
                    'joined_at'   => $u->created_at->format('d M Y'),
                    'active_plan' => $activeOrder ? $activeOrder->paketCategory->nama_kategori : null,
                ];
            });

            $systemNotifications = [];
            $topPackages = [];
            $aiStats = ['requests_today' => 0];

            return view('admin.dashboard', compact(
                'statsToday',
                'latestOrders',
                'latestUsers',
                'systemNotifications',
                'topPackages',
                'aiStats'
            ));
        })->name('dashboard');


        // =========================
        // MANAJEMEN PAKET (TAB 1)
        // =========================
        Route::get('/paket', fn() => view('admin.paket.index'))->name('paket.index');

        Route::get('/paket/create', fn() => view('admin.paket.create'))->name('paket.create');
        Route::post('/paket/store', [PaketController::class, 'store'])->name('paket.store');

        Route::get('/paket/{id}', function ($id) {
            $package = PaketCategory::findOrFail($id);
            $menus = Menu::all();
            $schedules = MenuSchedule::where('paket_category_id', $id)->orderBy('schedule_date', 'asc')->get();
            return view('admin.paket.show', compact('package', 'menus', 'schedules'));
        })->name('paket.show');

        Route::get('/paket/{id}/edit', function ($id) {
            $package = PaketCategory::findOrFail($id);
            return view('admin.paket.edit', compact('package'));
        })->name('paket.edit');

        Route::put('/paket/{id}', [PaketController::class, 'update'])->name('paket.update');
        Route::delete('/paket/{id}', [PaketController::class, 'destroy'])->name('paket.destroy');

        Route::post('/paket-options/store', [PaketController::class, 'storeOption'])->name('paket.options.store');
        Route::delete('/paket-options/{id}', [PaketController::class, 'destroyOption'])->name('paket.options.destroy');


        // =========================
        // KELOLA MENU (TAB 2)
        // =========================
        Route::get('/paket-menus', function () {
            $menus = Menu::orderBy('created_at', 'desc')->get();
            return view('admin.paket.menus', compact('menus'));
        })->name('paket.menus');

        Route::post('/paket-menus/store', function (Request $request) {
            $validated = $request->validate([
                'nama_menu' => 'required',
                'kategori' => 'required',
                'tipe_makanan' => 'required',
                'kalori' => 'required',
                'protein' => 'required',
                'karbohidrat' => 'required',
                'lemak' => 'required',
                'gambar' => 'nullable|image'
            ]);

            $path = $request->hasFile('gambar')
                ? $request->file('gambar')->store('menus', 'public')
                : null;

            Menu::create(array_merge($validated, [
                'gambar' => $path,
                'deskripsi' => $request->deskripsi
            ]));

            return redirect()->back()->with('success', 'Menu berhasil ditambahkan!');
        })->name('menus.store');

        Route::get('/paket-menus/{id}/edit', function ($id) {
            $menu = Menu::findOrFail($id);
            return view('admin.paket.edit-menu', compact('menu'));
        })->name('menus.edit');

        Route::put('/paket-menus/{id}', function (Request $request, $id) {
            $menu = Menu::findOrFail($id);

            $menu->update($request->except(['gambar']));

            if ($request->hasFile('gambar')) {
                $menu->update(['gambar' => $request->file('gambar')->store('menus', 'public')]);
            }

            return redirect()->route('admin.paket.menus')->with('success', 'Menu berhasil diperbarui!');
        })->name('menus.update');

        Route::delete('/paket-menus/{id}', function ($id) {
            $menu = Menu::findOrFail($id);

            if ($menu->gambar && !Str::startsWith($menu->gambar, 'http')) {
                Storage::disk('public')->delete($menu->gambar);
            }

            $menu->delete();
            return redirect()->back()->with('success', 'Menu berhasil dihapus!');
        })->name('menus.destroy');


        // =========================
        // KELOLA BATCH/JADWAL (TAB 3)
        // =========================
        Route::get('/paket-jadwal', function () {
            $packets = PaketCategory::all();
            $menus   = Menu::all();
            $schedules = MenuSchedule::with(['paketCategory', 'lunchMenu', 'dinnerMenu'])
                ->orderBy('schedule_date', 'desc')
                ->get();

            return view('admin.paket.schedules', compact('packets', 'menus', 'schedules'));
        })->name('paket.schedules');

        Route::post('/jadwal-menu/store', [MenuScheduleController::class, 'store'])->name('paket.schedules.store');
        Route::get('/jadwal-menu/{id}/edit', [MenuScheduleController::class, 'edit'])->name('paket.schedules.edit');
        Route::put('/jadwal-menu/{id}', [MenuScheduleController::class, 'update'])->name('paket.schedules.update');
        Route::delete('/jadwal-menu/{id}', [MenuScheduleController::class, 'destroy'])->name('paket.schedules.destroy');


        // =========================
        // KELOLA PESANAN (ADMIN)
        // =========================
        Route::get('/orders', function () {
            $rawOrders = Order::with(['user', 'paketCategory', 'paketOption'])
                ->orderBy('created_at', 'desc')
                ->get();

            $orders = $rawOrders->map(function ($order) {
                return [
                    'id'         => $order->id,
                    'code'       => $order->order_code,
                    'user_name'  => $order->user->name ?? 'Guest',
                    'user_email' => $order->user->email ?? '-',
                    'plan_name'  => $order->paketCategory->nama_kategori ?? '-',
                    'total'      => $order->total_harga,
                    'status'     => $order->status,
                    'date'       => $order->created_at->format('Y-m-d H:i'),
                    'total_hari' => $order->total_hari,
                    'periode'    => $order->paketOption->periode ?? '-',
                ];
            });

            return view('admin.orders.index', compact('orders'));
        })->name('orders.index');

        Route::get('/orders/{id}', [AdminOrderController::class, 'show'])->name('orders.show');




        // =========================
        // USERS (ADMIN)
        // =========================
        Route::get('/users', function (Request $request) {
            $query = User::query();

            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('email', 'LIKE', "%{$search}%");
                });
            }

            if ($request->filled('role')) $query->where('role', $request->role);
            if ($request->filled('status')) $query->where('status', $request->status);

            if ($request->filled('sort')) {
                match ($request->sort) {
                    'oldest' => $query->oldest(),
                    'name_asc' => $query->orderBy('name', 'asc'),
                    'name_desc' => $query->orderBy('name', 'desc'),
                    default => $query->latest(),
                };
            } else {
                $query->latest();
            }

            $users = $query->paginate(10)->withQueryString();
            $totalUsers = User::count();

            return view('admin.users.index', compact('users', 'totalUsers'));
        })->name('users.index');

        Route::get('/users/{id}', function ($id) {
            $user = User::findOrFail($id);
            $stats = ['orders_count' => 0, 'orders_total' => 0, 'last_order_at' => null];
            return view('admin.users.show', ['userDetail' => $user, 'stats' => $stats]);
        })->name('users.show');

        Route::patch('/users/{id}/role', function ($id) {
            $user = User::findOrFail($id);
            if ($user->id == auth()->id()) return back()->with('error', 'Anda tidak bisa mengubah role akun sendiri!');
            $user->role = ($user->role === 'admin') ? 'user' : 'admin';
            $user->save();
            return back()->with('success', 'Role pengguna berhasil diperbarui!');
        })->name('users.updateRole');

        Route::patch('/users/{id}/status', function ($id) {
            $user = User::findOrFail($id);
            if ($user->id == auth()->id()) return back()->with('error', 'Anda tidak bisa menonaktifkan akun sendiri!');
            $user->status = ($user->status === 'aktif') ? 'nonaktif' : 'aktif';
            $user->save();
            return back()->with('success', 'Status pengguna berhasil diperbarui!');
        })->name('users.updateStatus');


        // =========================
        // REPORTS
        // =========================
        Route::get('/reports', function () {
            $currentMonth = now()->month;
            $currentYear = now()->year;

            $pemasukan = Order::where('status', 'aktif')
                ->whereMonth('created_at', $currentMonth)
                ->whereYear('created_at', $currentYear)
                ->sum('total_harga');

            $totalPesanan = Order::count();

            $penggunaBaru = User::whereMonth('created_at', $currentMonth)
                ->whereYear('created_at', $currentYear)
                ->count();

            $bestSeller = Order::select('paket_category_id', DB::raw('count(*) as total'))
                ->where('status', 'aktif')
                ->groupBy('paket_category_id')
                ->orderByDesc('total')
                ->with('paketCategory')
                ->first();

            $namaPaketTerlaris = $bestSeller && $bestSeller->paketCategory
                ? $bestSeller->paketCategory->nama_kategori
                : 'Belum ada data';

            $chartLabels = [];
            $chartIncome = [];
            $chartOrders = [];
            $daysInMonth = now()->daysInMonth;

            for ($day = 1; $day <= $daysInMonth; $day++) {
                $date = \Carbon\Carbon::createFromDate($currentYear, $currentMonth, $day)->format('Y-m-d');
                $chartLabels[] = $day;
                $chartIncome[] = Order::whereDate('created_at', $date)->where('status', 'aktif')->sum('total_harga');
                $chartOrders[] = Order::whereDate('created_at', $date)->count();
            }

            $transactions = Order::with(['user', 'paketCategory'])
                ->whereMonth('created_at', $currentMonth)
                ->orderBy('created_at', 'desc')
                ->take(10)
                ->get();

            return view('admin.reports.index', compact(
                'pemasukan',
                'totalPesanan',
                'penggunaBaru',
                'namaPaketTerlaris',
                'chartLabels',
                'chartIncome',
                'chartOrders',
                'transactions'
            ));
        })->name('reports.index');

        Route::get('/reports/{date}', function ($date) {
            $report = ['title' => 'Laporan', 'income' => 0, 'orders' => 0, 'date' => $date];
            return view('admin.reports.show', ['report' => $report, 'orders' => []]);
        })->name('reports.show');


        // =========================
        // AI LOGS
        // =========================
        Route::get('/ai/ai-logs', [AiLogController::class, 'index'])->name('ai.logs');
        Route::get('/ai/ai-logs/{id}', [AiLogController::class, 'show'])->name('ai.logs.show');


        // =========================
        // DELIVERY (ADMIN)
        // =========================
        Route::get('/delivery/today', [\App\Http\Controllers\Admin\DeliveryController::class, 'today'])
            ->name('delivery.today');

        Route::post('/delivery/update', [\App\Http\Controllers\Admin\DeliveryController::class, 'update'])
            ->name('delivery.update');
    });

// AI generate preview
Route::post('/admin/paket/schedules/ai-generate', [\App\Http\Controllers\Admin\PaketScheduleController::class, 'aiGenerate'])
    ->name('admin.paket.schedules.ai.generate');

// AI confirm save (bulk)
Route::post('/admin/paket/schedules/ai-confirm', [\App\Http\Controllers\Admin\PaketScheduleController::class, 'aiConfirm'])
    ->name('admin.paket.schedules.ai.confirm');
