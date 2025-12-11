<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pesanan - Admin KaloriKita</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body { font-family: 'Instrument Sans', sans-serif; }
        .scroll-thin::-webkit-scrollbar { width: 6px; height: 6px; }
        .scroll-thin::-webkit-scrollbar-thumb { background-color: rgba(34, 197, 94, 0.7); border-radius: 999px; }
        
        /* Icon select & date fix for dark theme */
        select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%239ca3af' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.5rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
        }
        input[type="date"]::-webkit-calendar-picker-indicator { filter: invert(0.8); cursor: pointer; }
    </style>
</head>

<body class="bg-green-700/60 min-h-screen">

    <x-navbar></x-navbar>

    @php
        $user = auth()->user();
        $orders = $orders ?? []; 
    @endphp

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="flex flex-col lg:flex-row gap-6">

            {{-- SIDEBAR --}}
            <aside class="w-full lg:w-64 bg-green-800/90 border border-green-700/70 rounded-3xl p-5 h-max flex-shrink-0">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-2xl bg-yellow-400 flex items-center justify-center text-green-900 font-extrabold shadow-md">
                        {{ strtoupper(mb_substr($user->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="leading-tight">
                        <p class="text-sm font-semibold text-white">{{ $user->name ?? 'Admin' }}</p>
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
                    <a href="{{ route('profil.dashboard') }}" class="flex items-center justify-between px-3 py-2 rounded-xl text-[11px] text-green-100 hover:bg-green-700/70"><span>Masuk sebagai Pengguna</span></a>
                    <form action="{{ route('logout') }}" method="POST">@csrf <button class="w-full mt-3 px-3 py-2 rounded-xl bg-red-900/50 text-red-100 text-xs hover:bg-red-800/70">Logout</button></form>
                </nav>
            </aside>

            {{-- KONTEN UTAMA --}}
            <main class="flex-1 space-y-6">

                {{-- SATU HEADER BESAR (GABUNGAN JUDUL & FILTER) --}}
                <section class="bg-green-800/90 border border-green-700/70 rounded-3xl p-6 shadow-xl relative overflow-hidden">
                    
                    {{-- Hiasan Background --}}
                    <div class="absolute top-0 right-0 p-6 opacity-10 pointer-events-none">
                        <i class="bi bi-cart-check text-[10rem] text-white"></i>
                    </div>

                    <div class="relative z-10">
                        {{-- Bagian Atas: Judul & Total --}}
                        <div class="flex flex-col md:flex-row md:items-start justify-between gap-4 mb-6">
                            <div>
                                <h1 class="text-2xl font-bold text-white tracking-tight">Kelola Pesanan</h1>
                                <p class="text-xs text-green-200/80 mt-1">Pantau, cari, dan kelola transaksi pelanggan.</p>
                            </div>
                            
                            <div class="bg-green-900/60 backdrop-blur-sm rounded-xl px-5 py-2.5 border border-green-600/30 text-right shadow-lg">
                                <p class="text-[10px] text-green-300 uppercase tracking-wider font-bold">Total Pesanan</p>
                                <p class="text-2xl font-bold text-white">{{ count($orders) }}</p>
                            </div>
                        </div>

                        {{-- Bagian Bawah: Filter (Menyatu dalam Header) --}}
                        <div class="bg-green-900/40 border border-green-600/30 rounded-2xl p-4 backdrop-blur-sm">
                            <form action="{{ route('admin.orders.index') }}" method="GET">
                                <div class="grid grid-cols-1 md:grid-cols-4 gap-3 text-xs">
                                    {{-- Cari --}}
                                    <div class="md:col-span-1">
                                        <label class="block text-green-200/70 mb-1 font-medium">Pencarian</label>
                                        <div class="relative">
                                            <input type="text" name="q" placeholder="Nama / Kode Order..." value="{{ request('q') }}"
                                                class="w-full rounded-xl bg-green-800/60 border border-green-600/60 text-green-50 px-3 py-2.5 text-xs placeholder:text-green-200/30 focus:outline-none focus:ring-1 focus:ring-yellow-400 transition">
                                            <i class="bi bi-search absolute right-3 top-2.5 text-green-200/40"></i>
                                        </div>
                                    </div>

                                    {{-- Status --}}
                                    <div>
                                        <label class="block text-green-200/70 mb-1 font-medium">Status</label>
                                        <select name="status" class="w-full rounded-xl bg-green-800/60 border border-green-600/60 text-green-50 px-3 py-2.5 text-xs focus:outline-none focus:ring-1 focus:ring-yellow-400 transition cursor-pointer">
                                            <option value="">Semua Status</option>
                                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif / Lunas</option>
                                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                                        </select>
                                    </div>

                                    {{-- Tanggal --}}
                                    <div class="md:col-span-2 grid grid-cols-2 gap-2">
                                        <div>
                                            <label class="block text-green-200/70 mb-1 font-medium">Dari</label>
                                            <input type="date" name="start_date" value="{{ request('start_date') }}"
                                                class="w-full rounded-xl bg-green-800/60 border border-green-600/60 text-green-50 px-3 py-2.5 text-xs focus:outline-none focus:ring-1 focus:ring-yellow-400 transition">
                                        </div>
                                        <div>
                                            <label class="block text-green-200/70 mb-1 font-medium">Sampai</label>
                                            <input type="date" name="end_date" value="{{ request('end_date') }}"
                                                class="w-full rounded-xl bg-green-800/60 border border-green-600/60 text-green-50 px-3 py-2.5 text-xs focus:outline-none focus:ring-1 focus:ring-yellow-400 transition">
                                        </div>
                                    </div>
                                </div>

                                {{-- Tombol Filter --}}
                                <div class="mt-3 flex justify-end">
                                    <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-yellow-400 text-green-900 px-5 py-2 text-xs font-bold shadow-md hover:bg-yellow-300 transition hover:-translate-y-0.5">
                                        <i class="bi bi-funnel-fill"></i> Terapkan Filter
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>

                {{-- TABEL PESANAN --}}
                <div class="bg-green-800/90 border border-green-700/70 rounded-3xl p-6 shadow-xl min-h-[400px]">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-sm font-bold text-white">Daftar Transaksi</h2>
                    </div>

                    <div class="overflow-x-auto scroll-thin">
                        <table class="w-full text-left text-sm text-green-50">
                            <thead class="bg-green-900/50 text-green-200 uppercase text-[10px] font-bold border-b border-green-600/50 tracking-wider">
                                <tr>
                                    <th class="px-4 py-3">Kode</th>
                                    <th class="px-4 py-3">Pengguna</th>
                                    <th class="px-4 py-3">Paket</th>
                                    <th class="px-4 py-3">Tanggal</th>
                                    <th class="px-4 py-3">Total</th>
                                    <th class="px-4 py-3">Status</th>
                                    <th class="px-4 py-3 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-green-700/50 text-xs">
                                @forelse($orders as $order)
                                    <tr class="hover:bg-green-900/30 transition duration-150 group">
                                        <td class="px-4 py-4 font-mono font-bold text-white uppercase tracking-wide">
                                            {{ $order['code'] }}
                                        </td>
                                        <td class="px-4 py-4">
                                            <p class="font-bold text-white">{{ $order['user_name'] }}</p>
                                            <p class="text-[10px] text-green-200/60">{{ $order['user_email'] }}</p>
                                        </td>
                                        <td class="px-4 py-4">
                                            <span class="inline-block bg-green-900 text-green-100 text-[10px] px-2.5 py-1 rounded-md border border-green-600/50 font-bold uppercase tracking-wide">
                                                {{ $order['plan_name'] }}
                                            </span>
                                            @if(!empty($order['periode']))
                                                <p class="text-[10px] text-green-200/50 mt-1">{{ $order['periode'] }}</p>
                                            @endif
                                        </td>
                                        <td class="px-4 py-4 text-green-200/80 whitespace-nowrap">
                                            {{ $order['date'] }}
                                        </td>
                                        <td class="px-4 py-4 font-bold text-yellow-300">
                                            Rp {{ number_format($order['total'], 0, ',', '.') }}
                                        </td>
                                        <td class="px-4 py-4">
                                            @php
                                                $s = $order['status'];
                                                $badgeClass = match($s) {
                                                    'aktif', 'paid' => 'bg-emerald-500/20 text-emerald-200 border-emerald-500/40',
                                                    'pending' => 'bg-yellow-500/20 text-yellow-200 border-yellow-500/40',
                                                    'cancelled', 'expire' => 'bg-red-500/20 text-red-200 border-red-500/40',
                                                    default => 'bg-gray-500/20 text-gray-200 border-gray-500/40'
                                                };
                                                $label = match($s) {
                                                    'aktif', 'paid' => 'Lunas / Aktif',
                                                    'pending' => 'Belum Bayar',
                                                    'cancelled', 'expire' => 'Dibatalkan',
                                                    default => ucfirst($s)
                                                };
                                            @endphp
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[10px] font-bold border {{ $badgeClass }}">
                                                {{ $label }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-4 text-right">
                                            <a href="{{ route('admin.orders.show', $order['id']) }}" class="w-8 h-8 rounded-full bg-green-700/50 border border-green-600/50 inline-flex items-center justify-center text-green-100 hover:bg-green-600 hover:text-white transition shadow-sm group-hover:scale-105">
                                                <i class="bi bi-chevron-right text-xs"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-16 text-center">
                                            <div class="flex flex-col items-center justify-center text-green-200/30">
                                                <i class="bi bi-inbox text-4xl mb-3"></i>
                                                <p class="text-sm font-medium">Belum ada pesanan masuk.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Footer Pagination (Statik Sesuai Desain) --}}
                    @if(count($orders) > 0)
                    <div class="px-6 py-4 border-t border-green-700/50 bg-green-900/20 flex items-center justify-between mt-auto">
                        <p class="text-[11px] text-green-200/60">Menampilkan {{ count($orders) }} data.</p>
                        <div class="flex gap-2">
                            <button class="w-8 h-8 rounded-lg bg-green-900/50 border border-green-700/50 text-green-200 text-xs flex items-center justify-center hover:bg-green-800 transition">‹</button>
                            <button class="w-8 h-8 rounded-lg bg-yellow-400 text-green-900 text-xs font-bold flex items-center justify-center shadow-md">1</button>
                            <button class="w-8 h-8 rounded-lg bg-green-900/50 border border-green-700/50 text-green-200 text-xs flex items-center justify-center hover:bg-green-800 transition">›</button>
                        </div>
                    </div>
                    @endif
                </div>

            </main>

        </div>
    </div>

</body>
</html>