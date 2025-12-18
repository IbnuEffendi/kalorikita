<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan - KaloriKita</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Instrument Sans', sans-serif;
        }

        .scroll-thin::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        .scroll-thin::-webkit-scrollbar-thumb {
            background-color: rgba(34, 197, 94, 0.7);
            border-radius: 999px;
        }
    </style>
</head>

<body class="bg-green-700/60">
    <x-navbar></x-navbar>

    @php
        $user = auth()->user();
        $googleConnected = !empty($user?->google_id);

        $status = $order->status ?? 'pending';
        $statusLabel = match ($status) {
            'aktif' => 'Aktif',
            'selesai' => 'Selesai',
            'pending' => 'Menunggu Bayar',
            'dibatalkan' => 'Dibatalkan',
            'expired' => 'Expired',
            'failed' => 'Gagal',
            default => ucfirst($status),
        };

        $statusColor = match ($status) {
            'aktif' => 'bg-emerald-400/20 text-emerald-200 border-emerald-400/40',
            'selesai' => 'bg-green-400/20 text-green-200 border-green-400/40',
            'pending' => 'bg-yellow-400/20 text-yellow-200 border-yellow-400/40',
            'dibatalkan', 'failed' => 'bg-red-400/20 text-red-200 border-red-400/40',
            'expired' => 'bg-orange-400/20 text-orange-200 border-orange-400/40',
            default => 'bg-white/10 text-green-100 border-white/20',
        };

        // Durasi
        $startDate = $order->start_date;
        $endDate = $order->end_date;

        $totalDays = 0;
        $passedDays = 0;
        $daysPct = 0;
        if ($startDate && $endDate) {
            $totalDays = max(1, $startDate->diffInDays($endDate) + 1);
            $today = now()->startOfDay();
            $passedDays = $today->lt($startDate)
                ? 0
                : min($totalDays, $startDate->diffInDays(min($today, $endDate)) + 1);
            $daysPct = (int) round(($passedDays / $totalDays) * 100);
        }

        // Box progress (lebih akurat dari delivery logs kalau ada)
        $totalBox = (int) ($order->total_box ?? 0);

        $usedFromLogs = 0;
        if ($deliveryLogs && $deliveryLogs->count() > 0) {
            $usedLunch = $deliveryLogs->where('lunch_status', 'delivered')->count();
            $usedDinner = $deliveryLogs->where('dinner_status', 'delivered')->count();
            $usedFromLogs = $usedLunch + $usedDinner;
        }
        $usedBox = $usedFromLogs > 0 ? $usedFromLogs : (int) ($order->box_terpakai ?? 0);
        $usedBox = min($totalBox, max(0, $usedBox));
        $boxPct = $totalBox > 0 ? (int) round(($usedBox / $totalBox) * 100) : 0;

        // SVG circle progress
        $r = 26;
        $c = 2 * pi() * $r;
        $dash = $totalBox > 0 ? $c * ($boxPct / 100) : 0;
        $gap = $c - $dash;

        // badge untuk status delivery
        $badge = function ($st) {
            return match ($st) {
                'delivered' => 'bg-emerald-400/20 text-emerald-200 border-emerald-400/40',
                'failed' => 'bg-red-400/20 text-red-200 border-red-400/40',
                'skipped' => 'bg-zinc-400/15 text-zinc-200 border-zinc-400/30',
                default => 'bg-yellow-400/20 text-yellow-200 border-yellow-400/40',
            };
        };
        $labelSt = function ($st) {
            return match ($st) {
                'delivered' => 'Terkirim',
                'failed' => 'Gagal',
                'skipped' => 'Lewat',
                default => 'Belum',
            };
        };

        // helper ambil gambar menu
        $menuImg = function ($menu) {
            if (!$menu) {
                return null;
            }
            $img = $menu->gambar ?? null;
            if (!$img) {
                return null;
            }
            // kalau kamu simpan di storage public: gunakan asset('storage/'.$img)
            if (str_starts_with($img, 'http')) {
                return $img;
            }
            return asset('storage/' . ltrim($img, '/'));
        };

        // URL ke tracker dengan prefill sederhana (nanti kamu bisa tangkap query di tracker)
        $trackerUrl = function ($menu, $meal, $dateStr) {
            $name = $menu?->nama_menu ?? '';
            $cal = $menu?->kalori ?? '';
            $pro = $menu?->protein ?? '';
            $carb = $menu?->karbohidrat ?? '';
            $fat = $menu?->lemak ?? '';

            return route('profil.kalori.tracker', [
                'prefill' => 1,
                'name' => $name,
                'cal' => $cal,
                'protein' => $pro,
                'carb' => $carb,
                'fat' => $fat,
                'meal' => $meal, // lunch / dinner
                'date' => $dateStr,
            ]);
        };
    @endphp

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col lg:flex-row gap-6">

            {{-- SIDEBAR USER --}}
            <aside
                class="w-full lg:w-64 bg-green-800/90 border border-green-700/70 rounded-3xl p-5 h-max flex-shrink-0">
                <div class="flex items-center gap-3 mb-6">
                    <div
                        class="w-10 h-10 rounded-2xl bg-yellow-400 flex items-center justify-center text-green-900 font-extrabold">
                        {{ strtoupper(mb_substr($user->name ?? 'U', 0, 1)) }}
                    </div>
                    <div class="leading-tight">
                        <p class="text-sm font-semibold text-white">{{ $user->name ?? 'Pengguna KaloriKita' }}</p>
                        <p class="text-[11px] text-green-100/70">{{ $user->role === 'admin' ? 'Admin' : 'Pengguna' }}
                        </p>
                    </div>
                </div>

                <nav class="space-y-2 text-sm">
                    <a href="{{ route('profil.dashboard') }}"
                        class="flex items-center justify-between px-3 py-2 rounded-xl {{ request()->routeIs('profil.dashboard') ? 'bg-white text-green-900 font-semibold' : 'text-green-100 hover:bg-green-700/70' }}">
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('profil.myorder') }}"
                        class="flex items-center justify-between px-3 py-2 rounded-xl {{ request()->routeIs('profil.myorder') ? 'bg-white text-green-900 font-semibold' : 'text-green-100 hover:bg-green-700/70' }}">
                        <span>Pesanan Saya</span>
                    </a>

                    <a href="{{ route('profil.kalori.tracker') }}"
                        class="flex items-center justify-between px-3 py-2 rounded-xl {{ request()->routeIs('profil.kalori.tracker') ? 'bg-white text-green-900 font-semibold' : 'text-green-100 hover:bg-green-700/70' }}">
                        <span>Kalori Tracker</span>
                    </a>

                    <a href="{{ route('paket.list') }}"
                        class="flex items-center justify-between px-3 py-2 rounded-xl {{ request()->routeIs('paket.*') ? 'bg-white text-green-900 font-semibold' : 'text-green-100 hover:bg-green-700/70' }}">
                        <span>Paket Katering</span>
                    </a>

                    <a href="/kalori-lab"
                        class="flex items-center justify-between px-3 py-2 rounded-xl {{ request()->is('kalori-lab') ? 'bg-white text-green-900 font-semibold' : 'text-green-100 hover:bg-green-700/70' }}">
                        <span>KaloriLab (AI)</span>
                    </a>

                    <div class="border-t border-green-700/60 my-3"></div>

                    <div class="flex items-center justify-between px-3 py-2 rounded-xl bg-green-900/80">
                        <div class="text-xs">
                            <p class="text-green-100/80">Google</p>
                            <p class="text-[11px] {{ $googleConnected ? 'text-emerald-300' : 'text-yellow-300' }}">
                                {{ $googleConnected ? 'Terhubung' : 'Belum terhubung' }}
                            </p>
                        </div>
                        @if (!$googleConnected)
                            <a href="{{ route('google.connect') }}"
                                class="text-[11px] text-yellow-300 hover:text-yellow-200 underline">Hubungkan</a>
                        @endif
                    </div>

                    <form action="{{ route('logout') }}" method="POST" class="mt-4">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center justify-center px-3 py-2 rounded-xl text-red-100 bg-red-900/40 hover:bg-red-800/70 text-xs font-semibold">
                            Logout
                        </button>
                    </form>
                </nav>
            </aside>

            {{-- KONTEN UTAMA --}}
            <main class="flex-1 space-y-6">

                {{-- HEADER (mirip admin) --}}
                <section
                    class="bg-green-800/90 border border-green-700/70 rounded-3xl p-6 sm:p-7 shadow-xl shadow-black/20">
                    <div class="flex flex-col gap-4">
                        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                            <div>
                                <p class="text-[11px] text-green-100/70 mb-1">
                                    <a href="{{ route('profil.myorder') }}"
                                        class="hover:underline text-green-100/80">Pesanan Saya</a>
                                    <span class="mx-1">/</span>
                                    <span class="text-green-100/50">Detail</span>
                                </p>

                                <h1 class="text-xl sm:text-2xl font-semibold text-white">
                                    Detail Pesanan
                                    <span class="text-yellow-300 text-sm">#{{ $order->order_code }}</span>
                                </h1>

                                <p class="text-xs text-green-100/70 mt-1">
                                    Dibuat pada: {{ optional($order->created_at)->format('d M Y H:i') ?? '-' }}
                                </p>
                            </div>

                            <div class="flex flex-wrap gap-2 text-xs justify-end">
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full border {{ $statusColor }} font-semibold">
                                    Status: {{ $statusLabel }}
                                </span>
                            </div>
                        </div>

                        {{-- BAR DURASI --}}
                        <div class="bg-green-900/50 border border-green-700/50 rounded-2xl p-4">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                                <div>
                                    <p class="text-xs text-green-100/70">Durasi Langganan</p>
                                    <p class="text-sm font-semibold text-white">
                                        {{ $startDate ? $startDate->format('d M Y') : '-' }}
                                        <span class="text-green-100/60">→</span>
                                        {{ $endDate ? $endDate->format('d M Y') : '-' }}
                                    </p>
                                    <p class="text-[11px] text-green-100/70 mt-1">
                                        {{ $passedDays }} / {{ $totalDays }} hari ({{ $daysPct }}%)
                                    </p>
                                </div>

                                <div class="w-full sm:w-1/2">
                                    <div
                                        class="h-3 bg-green-950/60 rounded-full overflow-hidden border border-green-700/40">
                                        <div class="h-3 bg-yellow-400" style="width: {{ $daysPct }}%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-wrap gap-3">
                            <a href="{{ route('profil.myorder') }}"
                                class="inline-flex items-center gap-2 rounded-full bg-green-900/80 text-green-50 px-4 py-2 text-xs font-semibold hover:bg-green-900 transition">
                                ‹ Kembali
                            </a>
                        </div>
                    </div>
                </section>

                {{-- GRID --}}
                <section class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                    {{-- KIRI --}}
                    <div class="lg:col-span-2 space-y-6">

                        {{-- INFORMASI (alamat+catatan masuk sini) --}}
                        <div class="bg-green-800/90 border border-green-700/70 rounded-3xl p-5 sm:p-6 shadow-xl">
                            <h2 class="text-sm font-semibold text-white mb-3">Informasi Pesanan</h2>

                            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-3 text-xs text-green-100/85">
                                <div>
                                    <dt class="text-green-200/70">Paket</dt>
                                    <dd class="font-semibold">
                                        {{ $order->paketCategory?->nama_kategori ?? '-' }}
                                        @if ($order->paketOption?->durasi_hari)
                                            ({{ $order->paketOption->durasi_hari }} hari)
                                        @endif
                                    </dd>
                                </div>

                                <div>
                                    <dt class="text-green-200/70">Total</dt>
                                    <dd class="font-semibold text-yellow-300">
                                        Rp {{ number_format((int) $order->total_harga, 0, ',', '.') }}
                                    </dd>
                                </div>

                                <div>
                                    <dt class="text-green-200/70">Preferensi</dt>
                                    <dd class="font-semibold">
                                        {{ $order->food_preference ? strtoupper(str_replace('_', ' ', $order->food_preference)) : '-' }}
                                    </dd>
                                </div>

                                <div>
                                    <dt class="text-green-200/70">Kontak</dt>
                                    <dd class="font-semibold">{{ $order->user_phone ?? '-' }}</dd>
                                </div>

                                <div>
                                    <dt class="text-green-200/70">Alamat</dt>
                                    <dd class="font-semibold">{{ $order->address ?? '-' }}</dd>
                                </div>

                                <div>
                                    <dt class="text-green-200/70">Catatan</dt>
                                    <dd class="font-semibold">{{ $order->notes ?? '-' }}</dd>
                                </div>
                            </dl>
                        </div>

                        {{-- LOG MENU (dengan gambar + tombol tambah ke tracker) --}}
                        <div class="bg-green-800/90 border border-green-700/70 rounded-3xl p-5 sm:p-6 shadow-xl">
                            <div class="flex items-center justify-between mb-3">
                                <h2 class="text-sm font-semibold text-white">Log Menu & Delivery</h2>
                                <span class="text-[11px] text-green-100/70">{{ $dailyMenus->count() }} hari</span>
                            </div>

                            @if ($dailyMenus->isEmpty())
                                <p class="text-xs text-green-100/70">Jadwal menu untuk paket ini belum tersedia.</p>
                            @else
                                <div class="space-y-4">
                                    @foreach ($dailyMenus as $sch)
                                        @php
                                            $d = \Carbon\Carbon::parse($sch->schedule_date)->toDateString();
                                            $log = $deliveryLogs[$d] ?? null;

                                            $lMenu = $sch->lunchMenu ?? null;
                                            $dMenu = $sch->dinnerMenu ?? null;

                                            $lStatus = $log->lunch_status ?? 'pending';
                                            $dStatus = $log->dinner_status ?? 'pending';

                                            $lImg = $menuImg($lMenu);
                                            $dImg = $menuImg($dMenu);
                                        @endphp

                                        <div class="rounded-2xl border border-green-700/50 bg-green-900/40 p-4">
                                            <div class="flex items-center justify-between gap-3 mb-3">
                                                <div>
                                                    <p class="text-xs text-green-100/70">Tanggal</p>
                                                    <p class="text-sm font-semibold text-white">
                                                        {{ \Carbon\Carbon::parse($d)->translatedFormat('l, d M Y') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                                                {{-- SIANG --}}
                                                <div class="rounded-2xl border border-green-700/40 bg-green-800/40 p-3">
                                                    <div class="flex items-start justify-between gap-3">
                                                        <div class="flex gap-3">
                                                            <div
                                                                class="w-16 h-16 rounded-xl overflow-hidden bg-green-950/50 border border-green-700/40 flex-shrink-0">
                                                                @if ($lImg)
                                                                    <img src="{{ $lImg }}" alt="menu"
                                                                        class="w-full h-full object-cover">
                                                                @else
                                                                    <div
                                                                        class="w-full h-full flex items-center justify-center text-green-200/40 text-xs">
                                                                        No Image
                                                                    </div>
                                                                @endif
                                                            </div>

                                                            <div>
                                                                <p class="text-[11px] text-green-200/70">Siang</p>
                                                                <p class="text-sm font-semibold text-white">
                                                                    {{ $lMenu?->nama_menu ?? '-' }}
                                                                </p>
                                                                <p class="text-[11px] text-green-100/70 mt-0.5">
                                                                    {{ $lMenu?->kalori ? $lMenu->kalori . ' kkal' : '' }}
                                                                    @if ($lMenu?->protein)
                                                                        • P {{ $lMenu->protein }}
                                                                    @endif
                                                                    @if ($lMenu?->karbohidrat)
                                                                        • K {{ $lMenu->karbohidrat }}
                                                                    @endif
                                                                    @if ($lMenu?->lemak)
                                                                        • L {{ $lMenu->lemak }}
                                                                    @endif
                                                                </p>
                                                            </div>
                                                        </div>

                                                        <span
                                                            class="inline-flex items-center px-3 py-1 rounded-full border text-[11px] font-semibold {{ $badge($lStatus) }}">
                                                            {{ $labelSt($lStatus) }}
                                                        </span>
                                                    </div>

                                                    <div class="mt-3 flex justify-end">
                                                        @php
                                                            $date = \Carbon\Carbon::parse(
                                                                $sch->schedule_date,
                                                            )->toDateString();
                                                            // jam default (boleh kamu ubah)
                                                            $eatenAt = $date . 'T12:00';
                                                        @endphp

                                                        <a href="{{ route('profil.kalori.tracker', [
                                                            'range' => 'date',
                                                            'date' => $date,
                                                            'open_entry' => 1, // trigger buka modal
                                                            'mode' => 'manual', // langsung manual
                                                            'eaten_at' => $eatenAt,
                                                            'meal' => $sch->lunchMenu?->nama_menu,
                                                            'category' => 'Makan Siang',
                                                            'calories' => $sch->lunchMenu?->kalori,
                                                            'carbs' => $sch->lunchMenu?->karbohidrat,
                                                            'protein' => $sch->lunchMenu?->protein,
                                                            'fat' => $sch->lunchMenu?->lemak,
                                                        ]) }}"
                                                            class="px-3 py-1.5 rounded-full bg-yellow-400 text-green-900 text-[11px] font-semibold hover:bg-yellow-300">
                                                            + Tambah ke Tracker
                                                        </a>
                                                    </div>
                                                </div>

                                                {{-- MALAM --}}
                                                <div
                                                    class="rounded-2xl border border-green-700/40 bg-green-800/40 p-3">
                                                    <div class="flex items-start justify-between gap-3">
                                                        <div class="flex gap-3">
                                                            <div
                                                                class="w-16 h-16 rounded-xl overflow-hidden bg-green-950/50 border border-green-700/40 flex-shrink-0">
                                                                @if ($dImg)
                                                                    <img src="{{ $dImg }}" alt="menu"
                                                                        class="w-full h-full object-cover">
                                                                @else
                                                                    <div
                                                                        class="w-full h-full flex items-center justify-center text-green-200/40 text-xs">
                                                                        No Image
                                                                    </div>
                                                                @endif
                                                            </div>

                                                            <div>
                                                                <p class="text-[11px] text-green-200/70">Malam</p>
                                                                <p class="text-sm font-semibold text-white">
                                                                    {{ $dMenu?->nama_menu ?? '-' }}
                                                                </p>
                                                                <p class="text-[11px] text-green-100/70 mt-0.5">
                                                                    {{ $dMenu?->kalori ? $dMenu->kalori . ' kkal' : '' }}
                                                                    @if ($dMenu?->protein)
                                                                        • P {{ $dMenu->protein }}
                                                                    @endif
                                                                    @if ($dMenu?->karbohidrat)
                                                                        • K {{ $dMenu->karbohidrat }}
                                                                    @endif
                                                                    @if ($dMenu?->lemak)
                                                                        • L {{ $dMenu->lemak }}
                                                                    @endif
                                                                </p>
                                                            </div>
                                                        </div>

                                                        <span
                                                            class="inline-flex items-center px-3 py-1 rounded-full border text-[11px] font-semibold {{ $badge($dStatus) }}">
                                                            {{ $labelSt($dStatus) }}
                                                        </span>
                                                    </div>

                                                    <div class="mt-3 flex justify-end">
                                                        @php
                                                            $date = \Carbon\Carbon::parse(
                                                                $sch->schedule_date,
                                                            )->toDateString();
                                                            // jam default (boleh kamu ubah)
                                                            $eatenAt = $date . 'T12:00';
                                                        @endphp

                                                        <a href="{{ route('profil.kalori.tracker', [
                                                            'range' => 'date',
                                                            'date' => $date,
                                                            'open_entry' => 1, // trigger buka modal
                                                            'mode' => 'manual', // langsung manual
                                                            'eaten_at' => $eatenAt,
                                                            'meal' => $sch->lunchMenu?->nama_menu,
                                                            'category' => 'Makan Siang',
                                                            'calories' => $sch->lunchMenu?->kalori,
                                                            'carbs' => $sch->lunchMenu?->karbohidrat,
                                                            'protein' => $sch->lunchMenu?->protein,
                                                            'fat' => $sch->lunchMenu?->lemak,
                                                        ]) }}"
                                                            class="px-3 py-1.5 rounded-full bg-yellow-400 text-green-900 text-[11px] font-semibold hover:bg-yellow-300">
                                                            + Tambah ke Tracker
                                                        </a>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                    </div>

                    {{-- KANAN: progress box (mirip admin) --}}
                    <div class="space-y-6">
                        <div class="bg-green-800/90 border border-green-700/70 rounded-3xl p-5 sm:p-6 shadow-xl">
                            <h2 class="text-sm font-semibold text-white mb-3">Progress Box</h2>

                            <div class="flex items-center gap-4">
                                <div class="relative w-16 h-16">
                                    <svg class="w-16 h-16" viewBox="0 0 80 80">
                                        <circle cx="40" cy="40" r="26" fill="none"
                                            stroke="rgba(255,255,255,0.12)" stroke-width="10" />
                                        <circle cx="40" cy="40" r="26" fill="none"
                                            stroke="rgba(250, 204, 21, 1)" stroke-width="10" stroke-linecap="round"
                                            stroke-dasharray="{{ $dash }} {{ $gap }}"
                                            transform="rotate(-90 40 40)" />
                                    </svg>
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <div class="text-center">
                                            <div class="text-xs font-extrabold text-white">{{ $boxPct }}%</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex-1">
                                    <p class="text-xs text-green-100/70 mb-1">
                                        {{ $usedBox }} / {{ $totalBox }} box terkirim
                                    </p>
                                    <div
                                        class="h-3 bg-green-950/60 rounded-full overflow-hidden border border-green-700/40">
                                        <div class="h-3 bg-yellow-400" style="width: {{ $boxPct }}%"></div>
                                    </div>
                                </div>
                            </div>

                            <p class="text-[11px] text-green-100/60 mt-3">
                                Progress dihitung dari status delivery (siang + malam).
                            </p>
                        </div>
                    </div>

                </section>

            </main>
        </div>
    </div>

</body>

</html>
