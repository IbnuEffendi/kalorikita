<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Storage; // Untuk hapus foto lama
use Illuminate\Support\Str;             // Untuk cek URL foto

use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LabController;
use App\Http\Controllers\GoogleController;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Http\Controllers\KaloriTrackerController;
use App\Http\Controllers\ProfilDashboardController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\MenuScheduleController;

// --- MODEL DATABASE ---
use App\Models\PaketCategory;
use App\Models\Menu;
use App\Models\MenuSchedule;
use App\Models\Order; // [WAJIB] Agar Admin bisa ambil data pesanan

/*
|--------------------------------------------------------------------------
| KALORI TRACKER ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/kalori-tracker', [KaloriTrackerController::class, 'index'])
    ->name('profil.kalori.tracker')
    ->middleware('auth');

Route::post('/kalori-tracker/entry', [KaloriTrackerController::class, 'storeEntry'])
    ->name('kalori.tracker.entry.store')
    ->middleware('auth');

Route::post('/kalori-tracker/target', [KaloriTrackerController::class, 'updateTarget'])
    ->name('kalori.tracker.target.update')
    ->middleware('auth');

Route::post('/kalori-tracker/entry/ai', [KaloriTrackerController::class, 'storeEntryAi'])
    ->name('kalori.tracker.entry.ai')
    ->middleware('auth');

Route::post('/kalori-tracker/performance-insight', [KaloriTrackerController::class, 'generatePerformanceInsight'])
    ->name('kalori.tracker.insight');


/*
|--------------------------------------------------------------------------
| PUBLIC PAGE ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'home'])->name('home');

// REGISTER
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', [AuthController::class, 'register'])->name('register.store');

// LOGIN
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

// LOGOUT
Route::post('/logout', function () {
    auth()->logout();
    return redirect('/'); 
})->name('logout');


// HALAMAN LAIN
Route::get('/kalori-lab', function () {
    return view('profil.kalorilab');
})->name('kalori-lab');

Route::post('/kalori-lab/insight', [LabController::class, 'insight'])->name('lab.insight');

Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');

Route::get('/lab-kalori', function () {
    return view('labkalori');
})->name('lab.kalori');


/*
|--------------------------------------------------------------------------
| PROFIL ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/profil', [ProfilDashboardController::class, 'index'])
    ->name('profil.dashboard')
    ->middleware('auth');

Route::get('/myorder', function () {
    return view('profil.myorder');
})->name('profil.myorder');


/*
|--------------------------------------------------------------------------
| PAKET ROUTES (USER SIDE)
|--------------------------------------------------------------------------
*/

Route::get('/paket', [PaketController::class, 'index'])->name('paket.list');

Route::post('/checkout', [PaketController::class, 'checkout'])->name('paket.checkout');

Route::post('/payment', [PaketController::class, 'payment'])->name('paket.payment');

Route::get('/proses-beli', [OrderController::class, 'showForm'])->name('proses.beli');
Route::post('/proses-beli', [OrderController::class, 'store'])->name('proses.beli.store');

Route::get('/pesanan/success', function () {
    return view('paket.success');
})->name('pesanan.success');

Route::get('/paket/{slug}', [PaketController::class, 'show'])->name('paket.detail');


/*
|--------------------------------------------------------------------------
| FORGOT PASSWORD
|--------------------------------------------------------------------------
*/

Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'updatePassword'])->name('password.update');


/*
|--------------------------------------------------------------------------
| GOOGLE AUTH ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');
Route::get('/connect/google', [GoogleController::class, 'connect'])->middleware('auth')->name('google.connect');


/*
|--------------------------------------------------------------------------
| MIDTRANS CALLBACK (WEBHOOK)
|--------------------------------------------------------------------------
*/
// [PENTING] Route ini harus di luar middleware auth agar Midtrans bisa akses
Route::post('/midtrans/callback', [OrderController::class, 'callback']);


/*
|--------------------------------------------------------------------------
| ADMIN DASHBOARD ROUTES (PREFIX /admin)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth') // Pastikan hanya yang login bisa akses
    ->group(function () {

        // ==========================================================
        // 1. DASHBOARD ADMIN (DATA REAL)
        // ==========================================================
        Route::get('/dashboard', function () {
            
            $today = now()->toDateString();

            // 1. Hitung Statistik Real-time
            $statsToday = [
                'orders_today'    => Order::whereDate('created_at', $today)->count(),
                'revenue_today'   => Order::whereDate('created_at', $today)->where('status', 'aktif')->sum('total_harga'),
                'new_users_today' => User::whereDate('created_at', $today)->count(),
                'active_plans'    => Order::where('status', 'aktif')->where('end_date', '>=', $today)->count(),
            ];

            // 2. Ambil 5 Pesanan Terbaru
            $latestOrders = Order::with(['user', 'paketCategory'])
                ->latest()
                ->take(5)
                ->get()
                ->map(function($order) {
                    return [
                        'id'        => $order->id,
                        'user_name' => $order->user->name ?? 'Guest',
                        'plan_name' => $order->paketCategory->nama_kategori ?? '-',
                        'total'     => $order->total_harga,
                        'status'    => ucfirst($order->status),
                        'created_at'=> $order->created_at->diffForHumans(), 
                    ];
                });

            // 3. Ambil 5 User Terbaru
            $latestUsers = User::latest()->take(5)->get()->map(function($u) {
                // Cari paket aktif user ini
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

            // Data Dummy (Fallback)
            $systemNotifications = [];
            $topPackages = [];
            $aiStats = ['requests_today' => 0];

            return view('admin.dashboard', compact('statsToday', 'latestOrders', 'latestUsers', 'systemNotifications', 'topPackages', 'aiStats'));
        })->name('dashboard');


        // ==========================================================
        // 2. MANAJEMEN PAKET (TAB 1)
        // ==========================================================

        Route::get('/paket', fn() => view('admin.paket.index'))->name('paket.index');

        // CRUD Paket
        Route::get('/paket/create', fn() => view('admin.paket.create'))->name('paket.create');
        Route::post('/paket/store', [PaketController::class, 'store'])->name('paket.store');
        
        // Halaman Detail
        Route::get('/paket/{id}', function ($id) {
            $package = PaketCategory::findOrFail($id);
            $menus = Menu::all();
            $schedules = MenuSchedule::where('paket_category_id', $id)->orderBy('schedule_date', 'asc')->get();
            return view('admin.paket.show', compact('package', 'menus', 'schedules'));
        })->name('paket.show');

        // Halaman Edit
        Route::get('/paket/{id}/edit', function($id) {
            $package = PaketCategory::findOrFail($id);
            return view('admin.paket.edit', compact('package'));
        })->name('paket.edit');
        
        // Update & Hapus
        Route::put('/paket/{id}', [PaketController::class, 'update'])->name('paket.update');
        Route::delete('/paket/{id}', [PaketController::class, 'destroy'])->name('paket.destroy');

        // CRUD Opsi Durasi (Anak)
        Route::post('/paket-options/store', [PaketController::class, 'storeOption'])->name('paket.options.store');
        Route::delete('/paket-options/{id}', [PaketController::class, 'destroyOption'])->name('paket.options.destroy');


        // ==========================================================
        // 3. KELOLA MENU (TAB 2)
        // ==========================================================
        Route::get('/paket-menus', function() {
             $menus = Menu::orderBy('created_at', 'desc')->get();
             return view('admin.paket.menus', compact('menus'));
        })->name('paket.menus');

        Route::post('/paket-menus/store', function(Request $request) {
            $validated = $request->validate([
                'nama_menu' => 'required', 'kategori' => 'required', 'tipe_makanan' => 'required',
                'kalori' => 'required', 'protein' => 'required', 'karbohidrat' => 'required', 'lemak' => 'required',
                'gambar' => 'nullable|image'
            ]);
            $path = $request->hasFile('gambar') ? $request->file('gambar')->store('menus', 'public') : null;
            Menu::create(array_merge($validated, ['gambar' => $path, 'deskripsi' => $request->deskripsi]));
            return redirect()->back()->with('success', 'Menu berhasil ditambahkan!');
        })->name('menus.store');

        Route::get('/paket-menus/{id}/edit', function($id) {
            $menu = Menu::findOrFail($id);
            return view('admin.paket.edit-menu', compact('menu'));
        })->name('menus.edit');
        
        Route::put('/paket-menus/{id}', function(Request $request, $id) {
            $menu = Menu::findOrFail($id);
            $menu->update($request->except(['gambar']));
            if ($request->hasFile('gambar')) {
                $menu->update(['gambar' => $request->file('gambar')->store('menus', 'public')]);
            }
            return redirect()->route('admin.paket.menus')->with('success', 'Menu berhasil diperbarui!');
        })->name('menus.update');

        Route::delete('/paket-menus/{id}', function($id) {
            $menu = Menu::findOrFail($id);
            if ($menu->gambar && !Str::startsWith($menu->gambar, 'http')) {
                Storage::disk('public')->delete($menu->gambar);
            }
            $menu->delete();
            return redirect()->back()->with('success', 'Menu berhasil dihapus!');
        })->name('menus.destroy');


        // ==========================================================
        // 4. KELOLA BATCH (TAB 3)
        // ==========================================================
        Route::get('/paket-jadwal', function() {
            $packets = PaketCategory::all(); 
            $menus   = Menu::all();          
            $schedules = MenuSchedule::with(['paketCategory', 'lunchMenu', 'dinnerMenu'])
                            ->orderBy('schedule_date', 'desc')
                            ->get();
            return view('admin.paket.schedules', compact('packets', 'menus', 'schedules'));
        })->name('paket.schedules');

        // Simpan
        Route::post('/jadwal-menu/store', [MenuScheduleController::class, 'store'])->name('paket.schedules.store');
        
        // [FITUR EDIT JADWAL - HALAMAN TERPISAH]
        Route::get('/jadwal-menu/{id}/edit', [MenuScheduleController::class, 'edit'])->name('paket.schedules.edit');
        Route::put('/jadwal-menu/{id}', [MenuScheduleController::class, 'update'])->name('paket.schedules.update');
        
        // Hapus
        Route::delete('/jadwal-menu/{id}', [MenuScheduleController::class, 'destroy'])->name('paket.schedules.destroy');


        // ==========================================================
        // 5. FITUR ADMIN LAINNYA (ORDERS, USERS, REPORTS)
        // ==========================================================

        // --- KELOLA PESANAN (DATA REAL) ---
        Route::get('/orders', function () {
            // Ambil data DB
            $rawOrders = Order::with(['user', 'paketCategory', 'paketOption'])
                        ->orderBy('created_at', 'desc')
                        ->get();

            // Transformasi Data agar sesuai dengan view kamu (Array Style)
            $orders = $rawOrders->map(function($order) {
                return [
                    'id'         => $order->id,
                    'code'       => $order->order_code,
                    'user_name'  => $order->user->name ?? 'Guest',
                    'user_email' => $order->user->email ?? '-',
                    'plan_name'  => $order->paketCategory->nama_kategori ?? '-',
                    'total'      => $order->total_harga,
                    'status'     => $order->status, // 'pending', 'aktif'
                    'date'       => $order->created_at->format('Y-m-d H:i'),
                    'total_hari' => $order->total_hari,
                    'periode'    => $order->paketOption->periode ?? '-'
                ];
            });

            return view('admin.orders.index', compact('orders'));
        })->name('orders.index');

        Route::get('/orders/{id}', function ($id) {
            // Placeholder Detail Order
            return view('admin.orders.show', ['order' => [], 'items' => []]);
        })->name('orders.show');


        // --- DATA PENGGUNA ---
        Route::get('/users', function () {
            return view('admin.users.index');
        })->name('users.index');

        Route::get('/users/{id}', function ($id) {
            $user = User::findOrFail($id);
            $stats = ['orders_count' => 0, 'orders_total' => 0, 'last_order_at' => null];
            return view('admin.users.show', ['userDetail' => $user, 'stats' => $stats]);
        })->name('users.show');


        // --- LAPORAN ---
        Route::get('/reports', function () {
            return view('admin.reports.index');
        })->name('reports.index');

        Route::get('/reports/{date}', function ($date) {
            // Dummy report data
            $report = ['title' => 'Laporan', 'income' => 0, 'orders' => 0, 'date' => $date];
            return view('admin.reports.show', ['report' => $report, 'orders' => []]);
        })->name('reports.show');


        // --- LOG AI ---
        Route::get('/ai/ai-logs', function () {
            return view('admin.ai.logs', ['logs' => []]);
        })->name('ai.logs');

        Route::get('/ai/ai-logs/{id}', function ($id) {
            // Dummy log data
            return view('admin.ai.show', ['log' => []]);
        })->name('ai.logs.show');
    });