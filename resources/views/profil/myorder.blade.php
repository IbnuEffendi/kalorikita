<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya - KaloriKita</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

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

        // --- DATA REAL DARI DATABASE ---
        // Mengambil semua pesanan milik user yang sedang login
        $orders = \App\Models\Order::where('user_id', auth()->id())
                    ->with(['paketCategory', 'paketOption'])
                    ->orderBy('created_at', 'desc')
                    ->get();
    @endphp

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="flex flex-col lg:flex-row gap-6">

            {{-- SIDEBAR (Sama Persis dengan Dashboard) --}}
            <aside class="w-full lg:w-64 bg-green-800/90 border border-green-700/70 rounded-3xl p-5 h-max flex-shrink-0">

                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-2xl bg-yellow-400 flex items-center justify-center text-green-900 font-extrabold">
                        {{ strtoupper(mb_substr($user->name ?? 'U', 0, 1)) }}
                    </div>
                    <div class="leading-tight">
                        <p class="text-sm font-semibold text-white">
                            {{ $user->name ?? 'Pengguna KaloriKita' }}
                        </p>
                        <p class="text-[11px] text-green-100/70">
                            {{ $user->role === 'admin' ? 'Admin' : 'Pengguna' }}
                        </p>
                    </div>
                </div>

                <nav class="space-y-2 text-sm">

                    <a href="{{ route('profil.dashboard') }}"
                        class="flex items-center justify-between px-3 py-2 rounded-xl 
                              {{ request()->routeIs('profil.dashboard') ? 'bg-white text-green-900 font-semibold' : 'text-green-100 hover:bg-green-700/70' }}">
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('profil.myorder') }}"
                        class="flex items-center justify-between px-3 py-2 rounded-xl 
                              {{ request()->routeIs('profil.myorder') ? 'bg-white text-green-900 font-semibold' : 'text-green-100 hover:bg-green-700/70' }}">
                        <span>Pesanan Saya</span>
                    </a>

                    <a href="{{ route('profil.kalori.tracker') }}"
                        class="flex items-center justify-between px-3 py-2 rounded-xl 
                              {{ request()->routeIs('profil.kalori.tracker') ? 'bg-white text-green-900 font-semibold' : 'text-green-100 hover:bg-green-700/70' }}">
                        <span>Kalori Tracker</span>
                    </a>

                    <a href="{{ route('paket.list') }}"
                        class="flex items-center justify-between px-3 py-2 rounded-xl 
                              {{ request()->routeIs('paket.*') ? 'bg-white text-green-900 font-semibold' : 'text-green-100 hover:bg-green-700/70' }}">
                        <span>Paket Katering</span>
                    </a>

                    <a href="/kalori-lab"
                        class="flex items-center justify-between px-3 py-2 rounded-xl 
                              {{ request()->is('kalori-lab') ? 'bg-white text-green-900 font-semibold' : 'text-green-100 hover:bg-green-700/70' }}">
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
                                class="text-[11px] text-yellow-300 hover:text-yellow-200 underline">
                                Hubungkan
                            </a>
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

            {{-- KONTEN UTAMA: PESANAN SAYA --}}
            <main class="flex-1 space-y-6">

                {{-- Header halaman --}}
                <section class="bg-green-800/80 border border-green-700/60 rounded-3xl p-6 shadow-xl">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                        <div>
                            <h1 class="text-xl sm:text-2xl font-semibold text-white">Pesanan Saya</h1>
                            <p class="text-xs text-green-100/70 mt-1">
                                Daftar langganan paket katering yang pernah kamu beli.
                            </p>
                        </div>

                        {{-- Filter UI --}}
                        <div class="inline-flex bg-green-900/70 rounded-full p-1 text-xs">
                            <button class="px-3 py-1 rounded-full bg-yellow-400 text-green-900 font-semibold">
                                Semua
                            </button>
                            <button class="px-3 py-1 rounded-full text-green-100 hover:bg-green-700/80">
                                Aktif
                            </button>
                            <button class="px-3 py-1 rounded-full text-green-100 hover:bg-green-700/80">
                                Selesai
                            </button>
                        </div>
                    </div>
                </section>

                {{-- Daftar pesanan --}}
                <section class="bg-green-800/80 border border-green-700/60 rounded-3xl p-6 shadow-xl">

                    @if($orders->isEmpty())
                        {{-- Empty state (Kalau belum ada pesanan) --}}
                        <div class="text-center py-10">
                            <i class="bi bi-box-seam text-4xl text-green-200/30 mb-3 block"></i>
                            <p class="text-sm text-green-100/80 mb-2">
                                Kamu belum memiliki pesanan paket katering.
                            </p>
                            <p class="text-xs text-green-100/60 mb-4">
                                Mulai dengan memilih paket sesuai kebutuhan kalori dan tujuanmu.
                            </p>
                            <a href="{{ route('paket.list') }}"
                               class="inline-flex items-center justify-center px-5 py-2.5 rounded-full bg-yellow-400 text-green-900 text-xs font-semibold hover:bg-yellow-300 transition">
                                Lihat Paket Katering
                            </a>
                        </div>
                    @else
                        {{-- List Pesanan --}}
                        <div class="space-y-4">

                            @foreach($orders as $order)
                                @php
                                    // Hitung Sisa Box secara Real-time
                                    $totalBoxes = $order->total_box;
                                    $used = 0;
                                    
                                    if ($order->status == 'aktif' && $order->start_date <= now()) {
                                        // Hitung hari berjalan x 2 makan
                                        $daysPassed = \Carbon\Carbon::parse($order->start_date)->diffInDays(now()) + 1;
                                        $used = min($totalBoxes, $daysPassed * 2);
                                    } elseif ($order->status == 'selesai') {
                                        $used = $totalBoxes;
                                    }

                                    $remaining = max(0, $totalBoxes - $used);
                                    $progressPct = ($totalBoxes > 0) ? min(100, round(($used / $totalBoxes) * 100)) : 0;

                                    // Status Badge Color
                                    $statusClass = match($order->status) {
                                        'aktif', 'paid' => 'bg-emerald-500/20 text-emerald-200 border-emerald-400/60',
                                        'selesai'       => 'bg-green-500/20 text-green-100 border-green-400/60',
                                        'dibatalkan'    => 'bg-red-500/20 text-red-100 border-red-400/60',
                                        'pending'       => 'bg-yellow-500/20 text-yellow-200 border-yellow-400/60',
                                        default         => 'bg-green-500/20 text-green-100 border-green-400/60',
                                    };
                                    
                                    $statusLabel = ucfirst($order->status);
                                    if ($order->status == 'paid') $statusLabel = 'Lunas / Aktif';
                                @endphp

                                {{-- Item Card --}}
                                <div class="bg-green-900/70 rounded-2xl px-4 py-4 sm:px-5 sm:py-4 flex flex-col gap-3 border border-green-600/30">
                                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                                        <div>
                                            <p class="text-xs text-green-100/60 mb-0.5">
                                                ID Pesanan: #{{ $order->order_code }}
                                            </p>
                                            <p class="text-sm sm:text-base font-semibold text-white">
                                                {{ $order->paketCategory->nama_kategori }} ({{ $order->paketOption->periode }})
                                            </p>
                                            <p class="text-[11px] text-green-100/70">
                                                {{ $order->total_hari }} Hari Katering • {{ $order->total_box }} Box Total
                                            </p>
                                        </div>

                                        <div class="flex flex-col items-start sm:items-end gap-1">
                                            <span class="inline-flex items-center rounded-full border px-3 py-1 text-[11px] font-semibold {{ $statusClass }}">
                                                {{ $statusLabel }}
                                            </span>
                                            <p class="text-[11px] text-green-100/70">
                                                Total: <span class="font-semibold text-yellow-300">
                                                    Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                                                </span>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3 text-[11px] text-green-100/80 mt-1">
                                        <div>
                                            <p class="text-green-100/60">Mulai</p>
                                            <p class="font-semibold">{{ \Carbon\Carbon::parse($order->start_date)->translatedFormat('d M Y') }}</p>
                                        </div>
                                        <div>
                                            <p class="text-green-100/60">Berakhir</p>
                                            <p class="font-semibold">{{ \Carbon\Carbon::parse($order->end_date)->translatedFormat('d M Y') }}</p>
                                        </div>
                                        <div>
                                            <p class="text-green-100/60">Box Terkirim</p>
                                            <p class="font-semibold">
                                                {{ $used }} / {{ $totalBoxes }}
                                                @if($remaining > 0)
                                                    <span class="text-green-100/60"> (sisa {{ $remaining }})</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>

                                    {{-- Progress Bar --}}
                                    @if($totalBoxes > 0)
                                        <div class="mt-2">
                                            <div class="w-full h-2 bg-green-950/70 rounded-full overflow-hidden">
                                                <div class="h-full bg-yellow-400" style="width: {{ $progressPct }}%"></div>
                                            </div>
                                            <p class="mt-1 text-[11px] text-green-100/70">
                                                Pemakaian paket: {{ $progressPct }}%
                                            </p>
                                        </div>
                                    @endif

                                    {{-- Action Buttons --}}
                                    <div class="flex flex-wrap items-center justify-end gap-2 mt-2 pt-3 border-t border-green-700/40">
                                        
                                        {{-- TOMBOL LIHAT MENU HARIAN (FITUR BARU) --}}
                                        <a href="{{ route('profil.order.show', $order->order_code) }}"
                                           class="px-4 py-1.5 rounded-full bg-green-700 text-green-50 text-[11px] font-semibold hover:bg-green-600 transition flex items-center gap-1">
                                            Lihat Menu Harian <i class="bi bi-calendar-week"></i>
                                        </a>

                                        @if($order->status == 'aktif' || $order->status == 'paid')
                                            <a href="{{ route('paket.list') }}"
                                               class="px-4 py-1.5 rounded-full bg-yellow-400 text-green-900 text-[11px] font-semibold hover:bg-yellow-300 transition">
                                                Perpanjang / Upgrade
                                            </a>
                                        @elseif($order->status == 'pending')
                                            {{-- Jika pending, tombol arahkan ke halaman bayar --}}
                                            {{-- Note: Idealnya arahkan ke Snap Page lagi, tapi untuk simpel ke WA dulu atau checkout ulang --}}
                                            <a href="{{ route('paket.list') }}" class="px-4 py-1.5 rounded-full bg-yellow-400 text-green-900 text-[11px] font-semibold hover:bg-yellow-300 transition animate-pulse">
                                                Bayar Sekarang
                                            </a>
                                        @elseif($order->status == 'selesai')
                                            <a href="{{ route('paket.list') }}"
                                               class="px-4 py-1.5 rounded-full bg-white text-green-900 text-[11px] font-semibold hover:bg-green-50 transition">
                                                Pesan Lagi
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    @endif

                </section>
            </main>

        </div>
    </div>

</body>
</html>