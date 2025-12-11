<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - KaloriKita</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <style>
        body { font-family: 'Instrument Sans', sans-serif; }
    </style>
</head>

<body class="bg-green-700/60">

    {{-- NAVBAR UTAMA --}}
    <x-navbar></x-navbar>

    @php
        $user = auth()->user();
        $googleConnected = !empty($user?->google_id);
        
        // Data ini dikirim dari Route (Real Database), init array kosong sebagai fallback
        $statsToday = $statsToday ?? [];
        $latestOrders = $latestOrders ?? [];
        $latestUsers  = $latestUsers ?? [];
        $topPackages  = $topPackages ?? [];
        $systemNotifications = $systemNotifications ?? [];
    @endphp

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="flex flex-col lg:flex-row gap-6">

            {{-- SIDEBAR ADMIN --}}
            <aside class="w-full lg:w-64 bg-green-800/90 border border-green-700/70 rounded-3xl p-5 h-max">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-2xl bg-yellow-400 flex items-center justify-center text-green-900 font-extrabold">
                        {{ strtoupper(mb_substr($user->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="leading-tight">
                        <p class="text-sm font-semibold text-white">{{ $user->name ?? 'Admin KaloriKita' }}</p>
                        <p class="text-[11px] text-green-100/70">Admin</p>
                    </div>
                </div>

                <nav class="space-y-2 text-sm">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center justify-between px-3 py-2 rounded-xl {{ request()->routeIs('admin.dashboard') ? 'bg-white text-green-900 font-semibold' : 'text-green-100 hover:bg-green-700/70' }}"><span>Dashboard</span></a>
                    <a href="{{ route('admin.orders.index') }}" class="flex items-center justify-between px-3 py-2 rounded-xl {{ request()->routeIs('admin.orders.*') ? 'bg-white text-green-900 font-semibold' : 'text-green-100 hover:bg-green-700/70' }}"><span>Kelola Pesanan</span></a>
                    <a href="{{ route('admin.paket.index') }}" class="flex items-center justify-between px-3 py-2 rounded-xl {{ request()->routeIs('admin.paket.*') ? 'bg-white text-green-900 font-semibold' : 'text-green-100 hover:bg-green-700/70' }}"><span>Paket Katering</span></a>
                    <a href="{{ route('admin.users.index') }}" class="flex items-center justify-between px-3 py-2 rounded-xl {{ request()->routeIs('admin.users.*') ? 'bg-white text-green-900 font-semibold' : 'text-green-100 hover:bg-green-700/70' }}"><span>Data Pengguna</span></a>
                    <a href="{{ route('admin.reports.index') }}" class="flex items-center justify-between px-3 py-2 rounded-xl {{ request()->routeIs('admin.reports.*') ? 'bg-white text-green-900 font-semibold' : 'text-green-100 hover:bg-green-700/70' }}"><span>Laporan</span></a>
                    <a href="{{ route('admin.ai.logs') }}" class="flex items-center justify-between px-3 py-2 rounded-xl {{ request()->routeIs('admin.ai.*') ? 'bg-white text-green-900 font-semibold' : 'text-green-100 hover:bg-green-700/70' }}"><span>Log KaloriLab (AI)</span></a>
                    <div class="border-t border-green-700/60 my-3"></div>
                    
                    {{-- Status Google di Sidebar --}}
                    <div class="flex items-center justify-between px-3 py-2 rounded-xl bg-green-900/80">
                        <div class="text-xs">
                            <p class="text-green-100/80">Google</p>
                            <p class="text-[11px] {{ $googleConnected ? 'text-emerald-300' : 'text-yellow-300' }}">{{ $googleConnected ? 'Terhubung' : 'Belum terhubung' }}</p>
                        </div>
                        @if (!$googleConnected) <a href="{{ route('google.connect') }}" class="text-[11px] text-yellow-300 hover:text-yellow-200 underline">Hubungkan</a> @endif
                    </div>

                    <a href="{{ route('profil.dashboard') }}" class="mt-3 flex items-center justify-between px-3 py-2 rounded-xl text-[11px] text-green-100 hover:bg-green-700/70"><span>Masuk sebagai Pengguna</span></a>
                    <form action="{{ route('logout') }}" method="POST" class="mt-4">@csrf <button type="submit" class="w-full flex items-center justify-center px-3 py-2 rounded-xl text-red-100 bg-red-900/40 hover:bg-red-800/70 text-xs font-semibold">Logout</button></form>
                </nav>
            </aside>

            {{-- KONTEN UTAMA --}}
            <main class="flex-1 space-y-6">
                
                {{-- SECTION ATAS: Profil & Statistik --}}
                <section class="flex flex-col gap-6 lg:flex-row">
                    
                    {{-- Card Profil --}}
                    <div class="flex-1 bg-green-800/80 border border-green-700/60 rounded-3xl p-6 sm:p-7 shadow-xl shadow-black/20">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-14 h-14 rounded-2xl bg-yellow-400/90 flex items-center justify-center text-green-900 font-extrabold text-xl">{{ strtoupper(mb_substr($user->name ?? 'A', 0, 1)) }}</div>
                            <div>
                                <p class="text-sm text-green-100/80">Selamat datang,</p>
                                <h1 class="text-xl sm:text-2xl font-semibold text-white">{{ $user->name }}</h1>
                                <p class="text-xs text-green-100/70">{{ $user->email }}</p>
                                <p class="text-[11px] text-yellow-300 mt-1">Mode: Admin Panel</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mt-4">
                            {{-- Status Peran --}}
                            <div class="flex items-center justify-between bg-green-900/50 rounded-2xl px-4 py-3">
                                <div><p class="text-xs text-green-200/80">Peran</p><p class="text-sm font-semibold text-white">Admin</p></div>
                                <span class="inline-flex items-center rounded-full bg-green-700/80 px-3 py-1 text-[11px] font-semibold text-green-100">• Panel Aktif</span>
                            </div>

                            {{-- [PERBAIKAN] Status Google di Content Utama --}}
                            <div class="flex items-center justify-between bg-green-900/50 rounded-2xl px-4 py-3">
                                <div>
                                    <p class="text-xs text-green-200/80">Google</p>
                                    <p class="text-sm font-semibold {{ $googleConnected ? 'text-emerald-300' : 'text-yellow-300' }}">
                                        {{ $googleConnected ? 'Terhubung' : 'Belum terhubung' }}
                                    </p>
                                </div>
                                {{-- Tombol Hubungkan (Hanya muncul jika belum connect) --}}
                                @if (!$googleConnected)
                                    <a href="{{ route('google.connect') }}" class="text-[11px] font-semibold text-yellow-300 hover:text-yellow-200 underline cursor-pointer">
                                        Hubungkan
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="mt-6"><p class="text-xs text-green-100/70 mb-2">Aksi Cepat Admin</p><div class="flex flex-wrap gap-3"><a href="{{ route('admin.paket.create') }}" class="inline-flex items-center gap-2 rounded-full bg-yellow-400 text-green-900 px-4 py-2 text-xs font-semibold shadow-md hover:bg-yellow-300 transition">+ Buat Paket Baru</a><a href="{{ route('admin.orders.index') }}" class="inline-flex items-center gap-2 rounded-full bg-white text-green-900 px-4 py-2 text-xs font-semibold shadow-md hover:bg-green-50 transition">Lihat Semua Pesanan</a><a href="{{ route('admin.reports.index') }}" class="inline-flex items-center gap-2 rounded-full bg-green-700/80 text-green-50 px-4 py-2 text-xs font-semibold hover:bg-green-600 transition">Lihat Laporan Harian</a></div></div>
                    </div>

                    {{-- Card Statistik --}}
                    <div class="w-full lg:w-80 flex flex-col gap-4">
                        <div class="bg-white rounded-3xl p-5 shadow-xl shadow-black/30 text-green-900">
                            <p class="text-xs font-semibold uppercase tracking-wide text-green-700 mb-1">Statistik Hari Ini</p>
                            <div class="space-y-3 mt-2 text-sm">
                                <div class="flex items-center justify-between"><span class="text-green-700">Pesanan Masuk</span><span class="font-extrabold">{{ $statsToday['orders_today'] ?? 0 }}</span></div>
                                <div class="flex items-center justify-between"><span class="text-green-700">Pendapatan</span><span class="font-extrabold">Rp {{ number_format($statsToday['revenue_today'] ?? 0, 0, ',', '.') }}</span></div>
                                <div class="flex items-center justify-between"><span class="text-green-700">Pengguna Baru</span><span class="font-extrabold">{{ $statsToday['new_users_today'] ?? 0 }}</span></div>
                                <div class="flex items-center justify-between"><span class="text-green-700">Paket Aktif</span><span class="font-extrabold">{{ $statsToday['active_plans'] ?? 0 }}</span></div>
                            </div>
                            <a href="{{ route('admin.reports.index') }}" class="mt-4 inline-flex items-center justify-center px-4 py-2 rounded-full bg-green-800 text-yellow-200 text-xs font-semibold hover:bg-green-700 transition">Lihat laporan detail</a>
                        </div>
                        <div class="bg-green-800/90 border border-green-700/70 rounded-3xl p-4 shadow-lg">
                            <p class="text-xs text-green-100/80 mb-2 flex items-center justify-between"><span>Notifikasi Sistem</span><span class="text-[10px] bg-green-700/70 rounded-full px-2 py-0.5">{{ count($systemNotifications) }} item</span></p>
                            @if (empty($systemNotifications)) <p class="text-xs text-green-100/70">Tidak ada notifikasi sistem.</p> @endif
                        </div>
                    </div>
                </section>

                <section class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-4">
                    {{-- Pesanan Terbaru --}}
                    <div class="lg:col-span-2 bg-green-800/80 border border-green-700/60 rounded-3xl p-6 shadow-xl">
                        <div class="flex items-center justify-between mb-4"><div><h2 class="text-lg font-semibold text-white">Pesanan Terbaru</h2><p class="text-xs text-green-100/70">Monitor pesanan yang baru masuk.</p></div><span class="text-[11px] text-green-100/70">{{ count($latestOrders) }} pesanan</span></div>
                        @if (empty($latestOrders)) <p class="text-xs text-green-100/70">Belum ada pesanan baru.</p>
                        @else
                            <div class="space-y-3 max-h-72 overflow-y-auto pr-1">
                                @foreach ($latestOrders as $order)
                                    <div class="bg-green-900/70 rounded-2xl px-4 py-3 flex items-center justify-between text-xs text-green-100/85">
                                        <div>
                                            <p class="font-semibold">{{ $order['user_name'] ?? 'User' }} • {{ $order['plan_name'] ?? 'Paket' }}</p>
                                            <p class="text-[11px] text-green-100/60">{{ $order['created_at'] ?? now() }} • Status: {{ $order['status'] ?? 'Pending' }}</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-semibold text-yellow-300">Rp {{ number_format($order['total'] ?? 0, 0, ',', '.') }}</p>
                                            <a href="{{ route('admin.orders.index') }}" class="text-[11px] text-green-100/70 underline">Lihat detail</a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    {{-- Pengguna Terbaru --}}
                    <div class="bg-green-800/80 border border-green-700/60 rounded-3xl p-6 shadow-xl">
                        <div class="flex items-center justify-between mb-4"><div><h2 class="text-lg font-semibold text-white">Pengguna Terbaru</h2><p class="text-xs text-green-100/70">Pantau pengguna baru yang mendaftar.</p></div></div>
                        @if (empty($latestUsers)) <p class="text-xs text-green-100/70">Belum ada pengguna baru.</p>
                        @else
                            <ul class="space-y-2 max-h-72 overflow-y-auto pr-1 text-xs text-green-100/85">
                                @foreach ($latestUsers as $u)
                                    <li class="bg-green-900/70 rounded-2xl px-3 py-2">
                                        <p class="font-semibold">{{ $u['name'] }}</p>
                                        <p class="text-[11px] text-green-100/70">{{ $u['email'] }}</p>
                                        <p class="text-[10px] text-green-100/50 mt-1">Bergabung: {{ $u['joined_at'] }} @if (!empty($u['active_plan'])) • Paket: {{ $u['active_plan'] }} @endif</p>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </section>
            </main>
        </div>
    </div>
</body>
</html>