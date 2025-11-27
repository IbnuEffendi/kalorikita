<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Profil - KaloriKita</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <style>
        body {
            font-family: 'Instrument Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-green-900/95">

    {{-- NAVBAR UTAMA --}}
    <x-navbar></x-navbar>

    @php
        $user = auth()->user();

        // Placeholder sementara, nantinya diisi dari controller
        $activePlan = $activePlan ?? null;
        $todayCalories = $todayCalories ?? 0;
        $todayTarget = $todayTarget ?? null;
        $lastAiInsight = $lastAiInsight ?? null;
        $recentOrders = $recentOrders ?? [];
        $notifications = $notifications ?? [];

        $googleConnected = !empty($user?->google_id);
    @endphp

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="flex flex-col lg:flex-row gap-6">

            {{-- SIDEBAR --}}
            <aside class="w-full lg:w-64 bg-green-800/90 border border-green-700/70 rounded-3xl p-5 h-max">

                {{-- Profil mini di sidebar --}}
                <div class="flex items-center gap-3 mb-6">
                    <div
                        class="w-10 h-10 rounded-2xl bg-yellow-400 flex items-center justify-center text-green-900 font-extrabold">
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

                {{-- Menu --}}
                <nav class="space-y-2 text-sm">

                    {{-- Dashboard --}}
                    <a href="{{ route('profil.dashboard') }}"
                        class="flex items-center justify-between px-3 py-2 rounded-xl 
                              {{ request()->routeIs('profil.dashboard') ? 'bg-white text-green-900 font-semibold' : 'text-green-100 hover:bg-green-700/70' }}">
                        <span>Dashboard</span>
                    </a>

                    {{-- My Order --}}
                    <a href="{{ route('profil.myorder') }}"
                        class="flex items-center justify-between px-3 py-2 rounded-xl 
                              {{ request()->routeIs('profil.myorder') ? 'bg-white text-green-900 font-semibold' : 'text-green-100 hover:bg-green-700/70' }}">
                        <span>Pesanan Saya</span>
                    </a>

                    {{-- Kalori Tracker --}}
                    <a href="{{ route('profil.kalori.tracker') }}"
                        class="flex items-center justify-between px-3 py-2 rounded-xl 
                              {{ request()->routeIs('profil.kalori.tracker') ? 'bg-white text-green-900 font-semibold' : 'text-green-100 hover:bg-green-700/70' }}">
                        <span>Kalori Tracker</span>
                    </a>

                    {{-- Paket --}}
                    <a href="{{ route('paket.list') }}"
                        class="flex items-center justify-between px-3 py-2 rounded-xl 
                              {{ request()->routeIs('paket.*') ? 'bg-white text-green-900 font-semibold' : 'text-green-100 hover:bg-green-700/70' }}">
                        <span>Paket Katering</span>
                    </a>

                    {{-- KaloriLab --}}
                    <a href="/kalori-lab"
                        class="flex items-center justify-between px-3 py-2 rounded-xl 
                              {{ request()->is('kalori-lab') ? 'bg-white text-green-900 font-semibold' : 'text-green-100 hover:bg-green-700/70' }}">
                        <span>KaloriLab (AI)</span>
                    </a>

                    <div class="border-t border-green-700/60 my-3"></div>

                    {{-- Connect Google --}}
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

                    {{-- Logout --}}
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

                {{-- SECTION ATAS: Profil + Kalori + Notif singkat --}}
                <section class="flex flex-col gap-6 lg:flex-row">

                    {{-- Card profil & quick actions --}}
                    <div
                        class="flex-1 bg-green-800/80 border border-green-700/60 rounded-3xl p-6 sm:p-7 shadow-xl shadow-black/20">
                        <div class="flex items-center gap-4 mb-4">
                            <div
                                class="w-14 h-14 rounded-2xl bg-yellow-400/90 flex items-center justify-center text-green-900 font-extrabold text-xl">
                                {{ strtoupper(mb_substr($user->name ?? 'U', 0, 1)) }}
                            </div>
                            <div>
                                <p class="text-sm text-green-100/80">Selamat datang,</p>
                                <h1 class="text-xl sm:text-2xl font-semibold text-white">{{ $user->name }}</h1>
                                <p class="text-xs text-green-100/70">{{ $user->email }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mt-4">
                            <div class="flex items-center justify-between bg-green-900/50 rounded-2xl px-4 py-3">
                                <div>
                                    <p class="text-xs text-green-200/80">Peran</p>
                                    <p class="text-sm font-semibold text-white">
                                        {{ $user->role === 'admin' ? 'Admin' : 'Pengguna' }}
                                    </p>
                                </div>
                                <span
                                    class="inline-flex items-center rounded-full bg-green-700/80 px-3 py-1 text-[11px] font-semibold text-green-100">
                                    • Akun Aktif
                                </span>
                            </div>

                            <div class="flex items-center justify-between bg-green-900/50 rounded-2xl px-4 py-3">
                                <div>
                                    <p class="text-xs text-green-200/80">Google</p>
                                    <p
                                        class="text-sm font-semibold {{ $googleConnected ? 'text-emerald-300' : 'text-yellow-300' }}">
                                        {{ $googleConnected ? 'Terhubung' : 'Belum terhubung' }}
                                    </p>
                                </div>
                                @if (!$googleConnected)
                                    <a href="{{ route('google.connect') }}"
                                        class="text-[11px] font-semibold text-yellow-200 hover:text-yellow-100 underline">
                                        Hubungkan
                                    </a>
                                @endif
                            </div>
                        </div>

                        {{-- Quick Actions --}}
                        <div class="mt-6">
                            <p class="text-xs text-green-100/70 mb-2">Aksi Cepat</p>
                            <div class="flex flex-wrap gap-3">
                                <a href="{{ route('paket.list') }}"
                                    class="inline-flex items-center gap-2 rounded-full bg-yellow-400 text-green-900 px-4 py-2 text-xs font-semibold shadow-md hover:bg-yellow-300 transition">
                                    Pesan Paket
                                </a>
                                <a href="{{ route('profil.kalori.tracker') }}"
                                    class="inline-flex items-center gap-2 rounded-full bg-white text-green-900 px-4 py-2 text-xs font-semibold shadow-md hover:bg-green-50 transition">
                                    Kalori Tracker
                                </a>
                                <a href="/kalori-lab"
                                    class="inline-flex items-center gap-2 rounded-full bg-green-700/80 text-green-50 px-4 py-2 text-xs font-semibold hover:bg-green-600 transition">
                                    KaloriLab (AI)
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Kolom kanan atas: Kalori + notif singkat --}}
                    <div class="w-full lg:w-80 flex flex-col gap-4">

                        {{-- Kalori hari ini --}}
                        <div class="bg-white rounded-3xl p-5 shadow-xl shadow-black/30 text-green-900">
                            <p class="text-xs font-semibold uppercase tracking-wide text-green-700 mb-1">Kalori Hari Ini
                            </p>
                            <div class="flex items-end gap-2 mb-3">
                                <p class="text-3xl font-extrabold leading-tight">
                                    {{ $todayCalories }} <span class="text-base font-semibold">kkal</span>
                                </p>
                                @if ($todayTarget)
                                    <p class="text-xs text-green-700 mb-1">
                                        dari {{ $todayTarget }} kkal
                                    </p>
                                @endif
                            </div>

                            @if ($todayTarget)
                                @php
                                    $pct = min(
                                        100,
                                        $todayTarget > 0 ? round(($todayCalories / $todayTarget) * 100) : 0,
                                    );
                                @endphp
                                <div class="w-full h-2.5 bg-green-100 rounded-full overflow-hidden mb-2">
                                    <div class="h-full bg-green-700" style="width: {{ $pct }}%"></div>
                                </div>
                                <p class="text-[11px] text-green-800">
                                    Progress: {{ $pct }}% dari target harianmu.
                                </p>
                            @else
                                <p class="text-[11px] text-green-800">
                                    Belum ada target. Atur target di KaloriLab.
                                </p>
                            @endif

                            <a href="{{ route('profil.kalori.tracker') }}"
                                class="mt-4 inline-flex items-center justify-center px-4 py-2 rounded-full bg-green-800 text-yellow-200 text-xs font-semibold hover:bg-green-700 transition">
                                Lihat detail tracker
                            </a>
                        </div>

                        {{-- Notifikasi singkat --}}
                        <div class="bg-green-800/90 border border-green-700/70 rounded-3xl p-4 shadow-lg">
                            <p class="text-xs text-green-100/80 mb-2 flex items-center justify-between">
                                <span>Notifikasi Terbaru</span>
                                <span class="text-[10px] bg-green-700/70 rounded-full px-2 py-0.5">
                                    {{ count($notifications) }} item
                                </span>
                            </p>

                            @if (empty($notifications))
                                <p class="text-xs text-green-100/70">Belum ada notifikasi baru.</p>
                            @else
                                <ul class="space-y-2 max-h-32 overflow-y-auto pr-1">
                                    @foreach ($notifications as $notif)
                                        <li class="text-xs text-green-100/80 bg-green-900/70 rounded-2xl px-3 py-2">
                                            <p class="font-semibold">{{ $notif['title'] ?? 'Notifikasi' }}</p>
                                            <p class="text-[11px] text-green-100/70">
                                                {{ $notif['message'] ?? '' }}
                                            </p>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>

                    </div>

                </section>

                {{-- GRID TENGAH: Paket aktif + KaloriLab --}}
                <section class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                    {{-- Paket aktif --}}
                    <div class="lg:col-span-2 bg-green-800/80 border border-green-700/60 rounded-3xl p-6 shadow-xl">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <h2 class="text-lg font-semibold text-white">Paket Aktif</h2>
                                <p class="text-xs text-green-100/70">
                                    Status langganan katering sehatmu.
                                </p>
                            </div>
                            <a href="{{ route('paket.list') }}"
                                class="text-xs font-semibold text-yellow-300 hover:text-yellow-200 underline">
                                Lihat semua paket
                            </a>
                        </div>

                        @if ($activePlan)
                            <div
                                class="bg-green-900/60 border border-green-700/60 rounded-2xl p-4 sm:p-5 flex flex-col sm:flex-row gap-4 sm:items-center">
                                <div class="flex-1">
                                    <p class="text-xs text-green-100/80 mb-1">Nama Paket</p>
                                    <p class="text-sm sm:text-base font-semibold text-white">
                                        {{ $activePlan['name'] ?? 'Paket Anda' }}
                                    </p>

                                    <div class="grid grid-cols-2 gap-3 mt-3 text-[11px] sm:text-xs text-green-100/80">
                                        <div>
                                            <p class="text-green-100/60">Berakhir pada</p>
                                            <p class="font-semibold">
                                                {{ $activePlan['ends_at'] ?? '-' }}
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-green-100/60">Sisa Kotak</p>
                                            <p class="font-semibold">
                                                {{ $activePlan['boxes_left'] ?? '-' }} box
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex flex-col gap-2 sm:items-end">
                                    <span
                                        class="inline-flex items-center rounded-full bg-yellow-400/90 text-green-900 px-3 py-1 text-[11px] font-semibold">
                                        Paket Aktif
                                    </span>
                                    <a href="{{ route('paket.checkout', ['plan' => $activePlan['slug'] ?? null]) }}"
                                        class="inline-flex items-center justify-center px-4 py-2 rounded-full bg-green-700 text-green-50 text-xs font-semibold hover:bg-green-600 transition">
                                        Perpanjang / Upgrade
                                    </a>
                                </div>
                            </div>
                        @else
                            <div
                                class="bg-green-900/60 border border-dashed border-green-600/80 rounded-2xl p-5 text-center">
                                <p class="text-sm text-green-100/80 mb-2">
                                    Kamu belum memiliki paket katering aktif.
                                </p>
                                <p class="text-xs text-green-100/60 mb-4">
                                    Mulai perjalanan sehatmu dengan paket katering dari KaloriKita.
                                </p>
                                <a href="{{ route('paket.list') }}"
                                    class="inline-flex items-center justify-center px-5 py-2.5 rounded-full bg-yellow-400 text-green-900 text-xs font-semibold hover:bg-yellow-300 transition">
                                    Lihat Paket Tersedia
                                </a>
                            </div>
                        @endif
                    </div>

                    {{-- KaloriLab AI Preview --}}
                    <div class="bg-green-800/80 border border-green-700/60 rounded-3xl p-6 shadow-xl flex flex-col">
                        <div class="flex items-center justify-between mb-3">
                            <div>
                                <h2 class="text-lg font-semibold text-white">KaloriLab (AI)</h2>
                                <p class="text-xs text-green-100/70">
                                    Ringkasan insight AI terakhirmu.
                                </p>
                            </div>
                        </div>

                        @if ($lastAiInsight)
                            <div class="bg-green-900/70 rounded-2xl p-4 flex-1 flex flex-col">
                                <p class="text-xs text-green-100/80 line-clamp-5">
                                    {{ $lastAiInsight }}
                                </p>

                                <div class="mt-4 flex flex-wrap gap-2">
                                    <button type="button" id="btn-open-insight-modal"
                                        class="inline-flex items-center justify-center px-4 py-2 rounded-full bg-white/10 border border-yellow-300 text-yellow-200 text-xs font-semibold hover:bg-white/20 transition">
                                        Lihat Insight Lengkap
                                    </button>

                                    <a href="/kalori-lab"
                                        class="inline-flex flex-1 items-center justify-center px-4 py-2 rounded-full bg-yellow-400 text-green-900 text-xs font-semibold hover:bg-yellow-300 transition">
                                        Hitung ulang di KaloriLab
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="bg-green-900/70 rounded-2xl p-4 flex-1 flex flex-col justify-between">
                                <p class="text-xs text-green-100/80">
                                    Belum ada insight AI. Coba gunakan KaloriLab untuk menghitung BMI, BMR, dan
                                    kebutuhan kalorimu.
                                </p>
                                <a href="/kalori-lab"
                                    class="mt-4 inline-flex items-center justify-center px-4 py-2 rounded-full bg-yellow-400 text-green-900 text-xs font-semibold hover:bg-yellow-300 transition">
                                    Buka KaloriLab Sekarang
                                </a>
                            </div>
                        @endif

                    </div>

                </section>

                {{-- BOTTOM: Riwayat Pesanan & Notifikasi lengkap --}}
                <section class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-4">

                    {{-- Riwayat Pesanan --}}
                    <div class="lg:col-span-2 bg-green-800/80 border border-green-700/60 rounded-3xl p-6 shadow-xl">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <h2 class="text-lg font-semibold text-white">Riwayat Pesanan</h2>
                                <p class="text-xs text-green-100/70">
                                    Pesanan paket katering yang pernah kamu buat.
                                </p>
                            </div>
                            <span class="text-[11px] text-green-100/70">
                                {{ count($recentOrders) }} pesanan
                            </span>
                        </div>

                        @if (empty($recentOrders))
                            <p class="text-xs text-green-100/70">
                                Belum ada pesanan. Yuk mulai dengan memilih paket yang sesuai dengan targetmu.
                            </p>
                        @else
                            <div class="space-y-3 max-h-72 overflow-y-auto pr-1">
                                @foreach ($recentOrders as $order)
                                    <div
                                        class="bg-green-900/70 rounded-2xl px-4 py-3 flex items-center justify-between text-xs text-green-100/85">
                                        <div>
                                            <p class="font-semibold">
                                                {{ $order['plan_name'] ?? 'Paket Katering' }}
                                            </p>
                                            <p class="text-[11px] text-green-100/60">
                                                {{ $order['date'] ?? '-' }} • {{ $order['status'] ?? 'Selesai' }}
                                            </p>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-semibold text-yellow-300">
                                                Rp {{ number_format($order['total'] ?? 0, 0, ',', '.') }}
                                            </p>
                                            <a href="#" class="text-[11px] text-green-100/70 underline">
                                                Lihat detail
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    {{-- Notifikasi lengkap --}}
                    <div class="bg-green-800/80 border border-green-700/60 rounded-3xl p-6 shadow-xl">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <h2 class="text-lg font-semibold text-white">Notifikasi</h2>
                                <p class="text-xs text-green-100/70">
                                    Informasi terbaru terkait paket dan aktivitasmu.
                                </p>
                            </div>
                        </div>

                        @if (empty($notifications))
                            <p class="text-xs text-green-100/70">
                                Belum ada notifikasi saat ini.
                            </p>
                        @else
                            <ul class="space-y-2 max-h-72 overflow-y-auto pr-1">
                                @foreach ($notifications as $notif)
                                    <li class="bg-green-900/70 rounded-2xl px-3 py-2 text-xs text-green-100/85">
                                        <p class="font-semibold">
                                            {{ $notif['title'] ?? 'Notifikasi' }}
                                        </p>
                                        <p class="text-[11px] text-green-100/70">
                                            {{ $notif['message'] ?? '' }}
                                        </p>
                                        @if (!empty($notif['time']))
                                            <p class="text-[10px] text-green-100/50 mt-1">
                                                {{ $notif['time'] }}
                                            </p>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>

                </section>

            </main>

        </div>
    </div>

    @if ($lastAiInsight)
        <div id="insight-modal"
            class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center">

            <div class="bg-green-800 rounded-2xl max-w-lg w-full mx-4 p-6 shadow-xl relative">

                <button type="button" id="btn-close-insight-modal"
                    class="absolute top-3 right-3 text-yellow-300 text-xl font-bold">
                    ✕
                </button>

                <h3 class="text-xl font-semibold text-yellow-400 mb-4">
                    Insight KaloriLab Terakhir
                </h3>

                <div id="modal-insight-content"
                    class="text-sm text-green-100 leading-relaxed space-y-3 max-h-[60vh] overflow-y-auto pr-2">
                    {!! nl2br(e($lastAiInsight)) !!}
                </div>

                <div class="mt-6 flex items-center justify-between gap-2">
                    <a href="/kalori-lab"
                        class="inline-flex items-center justify-center px-4 py-2 rounded-full bg-yellow-400 text-green-900 text-xs font-semibold hover:bg-yellow-300 transition">
                        Buka KaloriLab
                    </a>
                    <button type="button" id="btn-close-insight-modal-bottom"
                        class="px-4 py-2 rounded-full bg-green-900 text-yellow-200 text-xs font-semibold hover:bg-green-800 transition">
                        Tutup
                    </button>
                </div>

            </div>
        </div>
    @endif

    @if ($lastAiInsight)
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const openBtn = document.getElementById('btn-open-insight-modal');
                const modal = document.getElementById('insight-modal');
                const closeTop = document.getElementById('btn-close-insight-modal');
                const closeBot = document.getElementById('btn-close-insight-modal-bottom');

                if (!openBtn || !modal) return;

                const closeModal = () => modal.classList.add('hidden');
                const openModal = () => modal.classList.remove('hidden');

                openBtn.addEventListener('click', openModal);
                if (closeTop) closeTop.addEventListener('click', closeModal);
                if (closeBot) closeBot.addEventListener('click', closeModal);

                modal.addEventListener('click', (e) => {
                    if (e.target === modal) {
                        closeModal();
                    }
                });
            });
        </script>
    @endif


</body>

</html>
