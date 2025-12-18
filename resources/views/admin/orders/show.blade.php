<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan - Admin KaloriKita</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <style>
        body { font-family: 'Instrument Sans', sans-serif; }
        .scroll-thin::-webkit-scrollbar { width: 6px; height: 6px; }
        .scroll-thin::-webkit-scrollbar-thumb { background-color: rgba(34, 197, 94, 0.7); border-radius: 999px; }
    </style>
</head>

<body class="bg-green-700/60">
    <x-navbar></x-navbar>

    @php
        /** @var \App\Models\Order $orderModel */
        $o = $orderModel;

        $status = $o->status ?? 'pending';
        $statusLabel = [
            'pending' => 'Pending',
            'aktif' => 'Aktif',
            'selesai' => 'Selesai',
            'dibatalkan' => 'Dibatalkan',
            'expired' => 'Expired',
            'failed' => 'Gagal',
        ][$status] ?? ucfirst($status);

        $statusColor = match ($status) {
            'pending' => 'bg-yellow-400/20 text-yellow-200 border-yellow-400/40',
            'aktif' => 'bg-emerald-400/20 text-emerald-200 border-emerald-400/40',
            'selesai' => 'bg-green-400/20 text-green-200 border-green-400/40',
            'dibatalkan', 'failed' => 'bg-red-400/20 text-red-200 border-red-400/40',
            'expired' => 'bg-orange-400/20 text-orange-200 border-orange-400/40',
            default => 'bg-green-400/20 text-green-200 border-green-400/40',
        };

        // Durasi
        $startDate = $o->start_date ?? null;
        $endDate   = $o->end_date ?? null;

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

        // Box progress
        $totalBox = (int) ($totalBox ?? ($o->total_box ?? 0));
        $usedBox  = (int) ($usedBox ?? ($o->box_terpakai ?? 0));
        $boxPct   = $totalBox > 0 ? (int) round(($usedBox / $totalBox) * 100) : 0;

        // SVG circle
        $r = 26;
        $c = 2 * pi() * $r;
        $dash = $totalBox > 0 ? ($c * ($boxPct/100)) : 0;
        $gap  = $c - $dash;

        // Menu hari ini: pakai log dulu (kalau ada), fallback schedule master
        $todayDate = now()->toDateString();

        $todayLunchName = $todayLog?->lunch_menu_name
            ?? $todaySchedule?->lunchMenu?->nama_menu
            ?? '-';

        $todayDinnerName = $todayLog?->dinner_menu_name
            ?? $todaySchedule?->dinnerMenu?->nama_menu
            ?? '-';

        $todayLunchStatus = $todayLog?->lunch_status ?? 'pending';
        $todayDinnerStatus = $todayLog?->dinner_status ?? 'pending';

        $badge = function($st) {
            return match($st) {
                'delivered' => 'bg-emerald-400/20 text-emerald-200 border-emerald-400/40',
                'failed' => 'bg-red-400/20 text-red-200 border-red-400/40',
                'skipped' => 'bg-zinc-400/15 text-zinc-200 border-zinc-400/30',
                default => 'bg-yellow-400/20 text-yellow-200 border-yellow-400/40',
            };
        };

        $labelSt = function($st) {
            return match($st) {
                'delivered' => 'Terkirim',
                'failed' => 'Gagal',
                'skipped' => 'Lewat',
                default => 'Belum',
            };
        };

        $user = auth()->user();
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
                    <a href="{{ route('admin.dashboard') }}"
                       class="flex items-center justify-between px-3 py-2 rounded-xl
                       {{ request()->routeIs('admin.dashboard') ? 'bg-white text-green-900 font-semibold' : 'text-green-100 hover:bg-green-700/70' }}">
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('admin.orders.index') }}"
                       class="flex items-center justify-between px-3 py-2 rounded-xl
                       {{ request()->routeIs('admin.orders.*') ? 'bg-white text-green-900 font-semibold' : 'text-green-100 hover:bg-green-700/70' }}">
                        <span>Kelola Pesanan</span>
                    </a>

                    <a href="{{ route('admin.paket.index') }}"
                       class="flex items-center justify-between px-3 py-2 rounded-xl
                       {{ request()->routeIs('admin.paket.*') ? 'bg-white text-green-900 font-semibold' : 'text-green-100 hover:bg-green-700/70' }}">
                        <span>Paket Katering</span>
                    </a>

                    <a href="{{ route('admin.users.index') }}"
                       class="flex items-center justify-between px-3 py-2 rounded-xl
                       {{ request()->routeIs('admin.users.*') ? 'bg-white text-green-900 font-semibold' : 'text-green-100 hover:bg-green-700/70' }}">
                        <span>Data Pengguna</span>
                    </a>

                    <a href="{{ route('admin.reports.index') }}"
                       class="flex items-center justify-between px-3 py-2 rounded-xl
                       {{ request()->routeIs('admin.reports.*') ? 'bg-white text-green-900 font-semibold' : 'text-green-100 hover:bg-green-700/70' }}">
                        <span>Laporan</span>
                    </a>

                    <a href="{{ route('admin.ai.logs') }}"
                       class="flex items-center justify-between px-3 py-2 rounded-xl
                       {{ request()->routeIs('admin.ai.*') ? 'bg-white text-green-900 font-semibold' : 'text-green-100 hover:bg-green-700/70' }}">
                        <span>Log KaloriLab (AI)</span>
                    </a>

                    <div class="border-t border-green-700/60 my-3"></div>

                    <a href="{{ route('profil.dashboard') }}"
                       class="flex items-center justify-between px-3 py-2 rounded-xl text-[11px] text-green-100 hover:bg-green-700/70">
                        <span>Masuk sebagai Pengguna</span>
                    </a>

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

                {{-- HEADER --}}
                <section class="bg-green-800/90 border border-green-700/70 rounded-3xl p-6 sm:p-7 shadow-xl shadow-black/20">
                    <div class="flex flex-col gap-4">

                        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                            <div>
                                <p class="text-[11px] text-green-100/70 mb-1">
                                    <a href="{{ route('admin.orders.index') }}" class="hover:underline text-green-100/80">Kelola Pesanan</a>
                                    <span class="mx-1">/</span>
                                    <span class="text-green-100/50">Detail Pesanan</span>
                                </p>

                                <h1 class="text-xl sm:text-2xl font-semibold text-white">
                                    Detail Pesanan
                                    <span class="text-yellow-300 text-sm">#{{ $o->order_code }}</span>
                                </h1>

                                <p class="text-xs text-green-100/70 mt-1">
                                    Dibuat pada: {{ optional($o->created_at)->format('d M Y H:i') ?? '-' }}
                                </p>
                            </div>

                            <div class="flex flex-wrap gap-2 text-xs justify-end">
                                <span class="inline-flex items-center px-3 py-1 rounded-full border {{ $statusColor }} font-semibold">
                                    Status: {{ $statusLabel }}
                                </span>
                            </div>
                        </div>

                        {{-- BAR DURASI LANGGANAN --}}
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
                                    <div class="h-3 bg-green-950/60 rounded-full overflow-hidden border border-green-700/40">
                                        <div class="h-3 bg-yellow-400" style="width: {{ $daysPct }}%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-wrap gap-3">
                            <a href="{{ route('admin.orders.index') }}"
                               class="inline-flex items-center gap-2 rounded-full bg-green-900/80 text-green-50 px-4 py-2 text-xs font-semibold hover:bg-green-900 transition">
                                ‹ Kembali ke daftar
                            </a>
                        </div>

                    </div>
                </section>

                {{-- GRID: kiri info + kanan menu/progress --}}
                <section class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                    {{-- KIRI --}}
                    <div class="lg:col-span-2 space-y-6">

                        {{-- Informasi Pesanan --}}
                        <div class="bg-green-800/90 border border-green-700/70 rounded-3xl p-5 sm:p-6 shadow-xl">
                            <h2 class="text-sm font-semibold text-white mb-3">Informasi Pesanan</h2>

                            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-3 text-xs text-green-100/85">
                                <div>
                                    <dt class="text-green-200/70">Paket Katering</dt>
                                    <dd class="font-semibold">
                                        {{ $o->paketCategory?->nama_kategori ?? '-' }}
                                        ({{ $o->paketOption?->durasi_hari ?? '-' }} hari)
                                    </dd>
                                </div>

                                <div>
                                    <dt class="text-green-200/70">Total Pembayaran</dt>
                                    <dd class="font-semibold text-yellow-300">
                                        Rp {{ number_format((int)$o->total_harga, 0, ',', '.') }}
                                    </dd>
                                </div>

                                <div>
                                    <dt class="text-green-200/70">Nama Penerima</dt>
                                    <dd class="font-semibold">{{ $o->customer_name ?? ($o->user?->name ?? '-') }}</dd>
                                </div>

                                <div>
                                    <dt class="text-green-200/70">Telepon</dt>
                                    <dd class="font-semibold">{{ $o->user_phone ?? '-' }}</dd>
                                </div>

                                <div>
                                    <dt class="text-green-200/70">Preferensi</dt>
                                    <dd class="font-semibold">
                                        {{ $o->food_preference ? strtoupper(str_replace('_',' ', $o->food_preference)) : '-' }}
                                    </dd>
                                </div>

                                <div>
                                    <dt class="text-green-200/70">Pembayaran</dt>
                                    <dd class="font-semibold">
                                        {{ $o->midtrans_payment_type ?? '-' }}
                                    </dd>
                                </div>

                                <div>
                                    <dt class="text-green-200/70">Total Box</dt>
                                    <dd class="font-semibold">{{ $totalBox }} box</dd>
                                </div>

                                <div>
                                    <dt class="text-green-200/70">Box Terkirim</dt>
                                    <dd class="font-semibold">{{ $usedBox }} box</dd>
                                </div>
                            </dl>
                        </div>

                        {{-- LOG DELIVERY --}}
                        <div class="bg-green-800/90 border border-green-700/70 rounded-3xl p-5 sm:p-6 shadow-xl">
                            <div class="flex items-center justify-between mb-3">
                                <h2 class="text-sm font-semibold text-white">Log Delivery</h2>
                                <span class="text-[11px] text-green-100/70">
                                    {{ $deliveryLogs->count() }} hari tercatat
                                </span>
                            </div>

                            @if ($deliveryLogs->isEmpty())
                                <p class="text-xs text-green-100/70">
                                    Belum ada log delivery. Log akan muncul saat admin checklist pengiriman.
                                </p>
                            @else
                                <div class="overflow-x-auto scroll-thin">
                                    <table class="min-w-full text-xs text-left text-green-50">
                                        <thead>
                                            <tr class="border-b border-green-700/80 text-[11px] uppercase text-green-200/80">
                                                <th class="py-2 pr-4">Tanggal</th>
                                                <th class="py-2 pr-4">Menu Siang</th>
                                                <th class="py-2 pr-4">Status</th>
                                                <th class="py-2 pr-4">Menu Malam</th>
                                                <th class="py-2 pr-0 text-right">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-green-700/70">
                                            @foreach ($deliveryLogs as $log)
                                                <tr class="hover:bg-green-900/40 transition">
                                                    <td class="py-2 pr-4 font-semibold whitespace-nowrap">
                                                        {{ \Carbon\Carbon::parse($log->delivery_date)->format('d M Y') }}
                                                    </td>

                                                    <td class="py-2 pr-4">
                                                        <div class="font-semibold text-[13px]">
                                                            {{ $log->lunch_menu_name ?? '-' }}
                                                        </div>
                                                        @if (!empty($log->lunch_delivered_at))
                                                            <div class="text-[11px] text-green-200/70">
                                                                {{ \Carbon\Carbon::parse($log->lunch_delivered_at)->format('H:i') }}
                                                            </div>
                                                        @endif
                                                    </td>

                                                    <td class="py-2 pr-4">
                                                        <span class="inline-flex items-center px-3 py-1 rounded-full border {{ $badge($log->lunch_status ?? 'pending') }} font-semibold">
                                                            {{ $labelSt($log->lunch_status ?? 'pending') }}
                                                        </span>
                                                    </td>

                                                    <td class="py-2 pr-4">
                                                        <div class="font-semibold text-[13px]">
                                                            {{ $log->dinner_menu_name ?? '-' }}
                                                        </div>
                                                        @if (!empty($log->dinner_delivered_at))
                                                            <div class="text-[11px] text-green-200/70">
                                                                {{ \Carbon\Carbon::parse($log->dinner_delivered_at)->format('H:i') }}
                                                            </div>
                                                        @endif
                                                    </td>

                                                    <td class="py-2 pr-0 text-right">
                                                        <span class="inline-flex items-center px-3 py-1 rounded-full border {{ $badge($log->dinner_status ?? 'pending') }} font-semibold">
                                                            {{ $labelSt($log->dinner_status ?? 'pending') }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- KANAN --}}
                    <div class="space-y-6">

                        {{-- Progress Box --}}
                        <div class="bg-green-800/90 border border-green-700/70 rounded-3xl p-5 sm:p-6 shadow-xl">
                            <h2 class="text-sm font-semibold text-white mb-3">Progress Box</h2>

                            <div class="flex items-center gap-4">
                                <div class="relative w-16 h-16">
                                    <svg class="w-16 h-16" viewBox="0 0 80 80">
                                        <circle cx="40" cy="40" r="26" fill="none" stroke="rgba(255,255,255,0.12)" stroke-width="10" />
                                        <circle cx="40" cy="40" r="26" fill="none"
                                            stroke="rgba(250, 204, 21, 1)"
                                            stroke-width="10"
                                            stroke-linecap="round"
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
                                    <div class="h-3 bg-green-950/60 rounded-full overflow-hidden border border-green-700/40">
                                        <div class="h-3 bg-yellow-400" style="width: {{ $boxPct }}%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Menu Hari Ini --}}
                        <div class="bg-green-800/90 border border-green-700/70 rounded-3xl p-5 sm:p-6 shadow-xl">
                            <h2 class="text-sm font-semibold text-white mb-3">Menu Hari Ini</h2>

                            <div class="space-y-3 text-xs text-green-100/85">
                                <div class="p-3 rounded-2xl bg-green-900/40 border border-green-700/40">
                                    <div class="flex items-start justify-between gap-3">
                                        <div>
                                            <p class="text-[11px] text-green-200/70">Siang</p>
                                            <p class="text-sm font-semibold text-white">{{ $todayLunchName }}</p>
                                        </div>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full border {{ $badge($todayLunchStatus) }} font-semibold">
                                            {{ $labelSt($todayLunchStatus) }}
                                        </span>
                                    </div>
                                </div>

                                <div class="p-3 rounded-2xl bg-green-900/40 border border-green-700/40">
                                    <div class="flex items-start justify-between gap-3">
                                        <div>
                                            <p class="text-[11px] text-green-200/70">Malam</p>
                                            <p class="text-sm font-semibold text-white">{{ $todayDinnerName }}</p>
                                        </div>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full border {{ $badge($todayDinnerStatus) }} font-semibold">
                                            {{ $labelSt($todayDinnerStatus) }}
                                        </span>
                                    </div>
                                </div>

                                <p class="text-[11px] text-green-100/60">
                                    Tanggal: {{ \Carbon\Carbon::parse($todayDate)->format('d M Y') }}
                                </p>
                            </div>
                        </div>

                        {{-- Alamat --}}
                        <div class="bg-green-800/90 border border-green-700/70 rounded-3xl p-5 sm:p-6 shadow-xl">
                            <h2 class="text-sm font-semibold text-white mb-3">Alamat Pengiriman</h2>
                            <p class="text-xs text-green-100/80 leading-relaxed">
                                {{ $o->address ?? 'Belum ada alamat pengiriman.' }}
                            </p>
                        </div>

                        {{-- Catatan --}}
                        <div class="bg-green-800/90 border border-green-700/70 rounded-3xl p-5 sm:p-6 shadow-xl">
                            <h2 class="text-sm font-semibold text-white mb-3">Catatan Pesanan</h2>
                            <p class="text-xs text-green-100/80 leading-relaxed whitespace-pre-line">
                                {{ $o->notes ?? 'Tidak ada catatan khusus dari pengguna.' }}
                            </p>
                        </div>

                    </div>
                </section>

            </main>
        </div>
    </div>
</body>
</html>
