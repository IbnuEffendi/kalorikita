<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalori Tracker - KaloriKita</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <style>
        body {
            font-family: 'Instrument Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-green-700/60">

    {{-- NAVBAR --}}
    <x-navbar></x-navbar>

    @php
        $user = auth()->user();

        // Placeholder data – nanti diganti dari controller
        $todayDate = now()->translatedFormat('l, d F Y');

        $targetCalories = $targetCalories ?? 2200;
        $todayCalories = $todayCalories ?? 1450;
        $todayCarbs = $todayCarbs ?? 180; // gram
        $todayProtein = $todayProtein ?? 70; // gram
        $todayFat = $todayFat ?? 50; // gram;

        $entries = $entries ?? [
            [
                'time' => '07:30',
                'meal' => 'Sarapan Nasi + Telur',
                'category' => 'Sarapan',
                'calories' => 550,
            ],
            [
                'time' => '12:45',
                'meal' => 'Nasi + Ayam Panggang + Sayur',
                'category' => 'Makan Siang',
                'calories' => 720,
            ],
            [
                'time' => '16:00',
                'meal' => 'Snack Pisang + Susu',
                'category' => 'Snack',
                'calories' => 180,
            ],
        ];

        $googleConnected = !empty($user?->google_id);

        $remainingCalories = max(0, $targetCalories - $todayCalories);
        $progressPct = $targetCalories > 0 ? min(100, round(($todayCalories / $targetCalories) * 100)) : 0;
    @endphp

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="flex flex-col lg:flex-row gap-6">

            {{-- SIDEBAR --}}
            <aside class="w-full lg:w-64 bg-green-800/90 border border-green-700/70 rounded-3xl p-5 h-max">

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

            {{-- KONTEN UTAMA --}}
            <main class="flex-1 space-y-6">

                {{-- HEADER TRACKER --}}
                <section class="bg-green-800/80 border border-green-700/60 rounded-3xl p-6 shadow-xl">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                        <div>
                            <h1 class="text-xl sm:text-2xl font-semibold text-white">Kalori Tracker</h1>
                            <p class="text-xs text-green-100/70 mt-1">
                                Pantau asupan kalori harianmu dan pastikan tetap sesuai target.
                            </p>
                            <p class="text-[11px] text-green-100/60 mt-1">
                                {{ $periodLabel ?? '' }}
                            </p>

                        </div>

                        <div class="flex flex-col items-start sm:items-end gap-2">
                            <p class="text-xs text-green-100/70">
                                Target Kalori Harian
                            </p>
                            <p class="text-lg font-semibold text-yellow-300">
                                {{ $targetCaloriesDaily }} <span class="text-sm text-green-100">kkal</span>
                            </p>
                            @if ($range !== 'today' && $range !== 'yesterday' && $range !== 'date')
                                <p class="text-[11px] text-green-100/70 mt-1">
                                    Target untuk periode ini: {{ $targetCalories }} kkal ({{ $daysForTarget ?? '?' }}
                                    hari)
                                </p>
                            @endif
                            <div class="flex">
                                <button id="btn-open-target-modal"
                                    class="mt-1 inline-flex items-center justify-center px-3 py-1.5 rounded-full bg-green-900 text-yellow-200 text-[11px] font-semibold hover:bg-green-800 transition">
                                    Atur Target
                                </button>
                            </div>


                        </div>
                    </div>
                    {{-- TAB RANGE --}}
                    <div class="mt-4 flex flex-wrap items-center gap-2 text-[11px]">
                        @php
                            $currentRange = $range ?? 'today';
                        @endphp

                        <div class="inline-flex bg-green-900/80 rounded-full p-1 gap-1">
                            <a href="{{ route('profil.kalori.tracker', ['range' => 'today']) }}"
                                class="px-3 py-1.5 rounded-full font-semibold
                  {{ $currentRange === 'today' ? 'bg-yellow-400 text-green-900' : 'text-green-100 hover:bg-green-800' }}">
                                Hari ini
                            </a>
                            <a href="{{ route('profil.kalori.tracker', ['range' => 'yesterday']) }}"
                                class="px-3 py-1.5 rounded-full font-semibold
                  {{ $currentRange === 'yesterday' ? 'bg-yellow-400 text-green-900' : 'text-green-100 hover:bg-green-800' }}">
                                Kemarin
                            </a>
                            <a href="{{ route('profil.kalori.tracker', ['range' => '7d']) }}"
                                class="px-3 py-1.5 rounded-full font-semibold
                  {{ $currentRange === '7d' ? 'bg-yellow-400 text-green-900' : 'text-green-100 hover:bg-green-800' }}">
                                7 hari
                            </a>
                            <a href="{{ route('profil.kalori.tracker', ['range' => '30d']) }}"
                                class="px-3 py-1.5 rounded-full font-semibold
                  {{ $currentRange === '30d' ? 'bg-yellow-400 text-green-900' : 'text-green-100 hover:bg-green-800' }}">
                                30 hari
                            </a>
                        </div>

                        {{-- DROPDOWN TANGGAL (CUSTOM DATE) --}}
                        <form method="GET" action="{{ route('profil.kalori.tracker') }}"
                            class="flex items-center gap-2">
                            <input type="hidden" name="range" value="date">
                            <label class="text-green-100/70">
                                <span class="hidden sm:inline">Pilih tanggal:</span>
                            </label>
                            <input type="date" name="date" value="{{ $dateParam ?? now()->toDateString() }}"
                                class="bg-green-900/80 border border-green-700/70 text-green-100 text-[11px] rounded-full px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-yellow-300">
                            <button type="submit"
                                class="px-3 py-1.5 rounded-full bg-yellow-400 text-green-900 font-semibold text-[11px] hover:bg-yellow-300">
                                Tampilkan
                            </button>
                        </form>
                        <button id="btn-open-performance-modal"
                            class="mt-1 inline-flex items-center justify-center px-3 py-1.5 rounded-full bg-green-700 text-yellow-200 text-[11px] font-semibold hover:bg-green-600 transition">
                            Lihat Performa
                        </button>
                    </div>

                </section>

                {{-- RINGKASAN HARI INI --}}
                <section class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                    {{-- Card progress kalori --}}
                    <div class="lg:col-span-2 bg-white rounded-3xl p-6 shadow-xl text-green-900">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-green-700 mb-1">
                                    Ringkasan Kalori Hari Ini
                                </p>
                                <p class="text-3xl font-extrabold leading-tight">
                                    {{ $todayCalories }} <span class="text-base font-semibold">kkal</span>
                                </p>
                                <p class="text-xs text-green-700 mt-1">
                                    Target periode ini:
                                    <span class="font-semibold">{{ $targetCalories }} kkal</span>
                                    @if ($daysForTarget >= 1)
                                        <p class="text-[11px] text-green-100/70 mt-1">
                                            Target untuk periode ini: {{ $targetCalories }} kkal
                                            @if ($daysForTarget > 1)
                                                ({{ $targetCaloriesDaily }} kkal x {{ $daysForTarget }} hari)
                                            @else
                                                (1 hari)
                                            @endif
                                        </p>
                                    @endif

                                </p>
                            </div>
                            <div class="text-sm text-right">
                                <p class="text-green-700">Sisa kalori</p>
                                <p class="text-xl font-semibold text-green-900">
                                    {{ $remainingCalories }} <span class="text-xs">kkal</span>
                                </p>
                            </div>
                        </div>

                        <div class="mb-2">
                            <div class="flex items-center justify-between text-[11px] text-green-700 mb-1">
                                <span>Progress</span>
                                <span>{{ $progressPct }}%</span>
                            </div>
                            <div class="w-full h-2.5 bg-green-100 rounded-full overflow-hidden">
                                <div class="h-full bg-green-700" style="width: {{ $progressPct }}%"></div>
                            </div>
                        </div>

                        <p class="text-[11px] text-green-700 mt-2">
                            Usahakan asupanmu mendekati target tanpa berlebihan. Jika kamu sedang defisit atau surplus
                            kalori,
                            sesuaikan target di KaloriLab.
                        </p>
                    </div>

                    {{-- Card ringkasan makro --}}
                    <div class="bg-green-800/90 border border-green-700/70 rounded-3xl p-6 shadow-xl flex flex-col">
                        <h2 class="text-sm font-semibold text-white mb-3">Ringkasan Makronutrien</h2>

                        <div class="space-y-4 text-xs text-green-100/80">
                            {{-- Karbo --}}
                            <div>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="font-semibold text-white">Karbohidrat</p>
                                        <p class="text-[11px] text-green-100/70">
                                            Hari ini / Target
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-semibold text-yellow-300">
                                            {{ $todayCarbs }} g
                                            @if ($targetCarbs > 0)
                                                <span class="text-[11px] text-green-100/80">
                                                    / {{ $targetCarbs }} g
                                                </span>
                                            @endif
                                        </p>
                                        @if ($targetCarbs > 0)
                                            <p class="text-[10px] text-green-100/70">
                                                {{ $carbProgressPct }}%
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                @if ($targetCarbs > 0)
                                    <div class="w-full h-1.5 bg-green-900 rounded-full overflow-hidden mt-1.5">
                                        <div class="h-full bg-yellow-400" style="width: {{ $carbProgressPct }}%">
                                        </div>
                                    </div>
                                @endif
                            </div>

                            {{-- Protein --}}
                            <div>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="font-semibold text-white">Protein</p>
                                        <p class="text-[11px] text-green-100/70">
                                            Hari ini / Target
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-semibold text-yellow-300">
                                            {{ $todayProtein }} g
                                            @if ($targetProtein > 0)
                                                <span class="text-[11px] text-green-100/80">
                                                    / {{ $targetProtein }} g
                                                </span>
                                            @endif
                                        </p>
                                        @if ($targetProtein > 0)
                                            <p class="text-[10px] text-green-100/70">
                                                {{ $proteinProgressPct }}%
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                @if ($targetProtein > 0)
                                    <div class="w-full h-1.5 bg-green-900 rounded-full overflow-hidden mt-1.5">
                                        <div class="h-full bg-yellow-400" style="width: {{ $proteinProgressPct }}%">
                                        </div>
                                    </div>
                                @endif
                            </div>

                            {{-- Lemak --}}
                            <div>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="font-semibold text-white">Lemak</p>
                                        <p class="text-[11px] text-green-100/70">
                                            Hari ini / Target
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-semibold text-yellow-300">
                                            {{ $todayFat }} g
                                            @if ($targetFat > 0)
                                                <span class="text-[11px] text-green-100/80">
                                                    / {{ $targetFat }} g
                                                </span>
                                            @endif
                                        </p>
                                        @if ($targetFat > 0)
                                            <p class="text-[10px] text-green-100/70">
                                                {{ $fatProgressPct }}%
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                @if ($targetFat > 0)
                                    <div class="w-full h-1.5 bg-green-900 rounded-full overflow-hidden mt-1.5">
                                        <div class="h-full bg-yellow-400" style="width: {{ $fatProgressPct }}%">
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>


                </section>

                {{-- DAFTAR MAKANAN HARI INI --}}
                <section class="bg-green-800/80 border border-green-700/60 rounded-3xl p-6 shadow-xl">

                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
                        <div>
                            <h2 class="text-lg font-semibold text-white">Catatan Makan Hari Ini</h2>
                            <p class="text-xs text-green-100/70 mt-1">
                                Tambahkan makanan/minuman untuk melacak asupan kalori.
                            </p>
                        </div>
                        <div class="flex flex-wrap gap-2">
                            <button id="btn-open-entry-modal"
                                class="inline-flex items-center justify-center px-4 py-2 rounded-full bg-yellow-400 text-green-900 text-xs font-semibold hover:bg-yellow-300 transition">
                                + Tambah Catatan Makan
                            </button>

                        </div>
                    </div>

                    @if (empty($entries))
                        <div class="text-center py-8">
                            <p class="text-sm text-green-100/80 mb-2">
                                Belum ada catatan makan untuk hari ini.
                            </p>
                            <p class="text-xs text-green-100/60 mb-4">
                                Mulai dengan menambahkan sarapan, makan siang, makan malam, atau snack.
                            </p>
                            <button
                                class="inline-flex items-center justify-center px-5 py-2.5 rounded-full bg-yellow-400 text-green-900 text-xs font-semibold hover:bg-yellow-300 transition">
                                Tambah Catatan Pertama
                            </button>
                        </div>
                    @else
                        <div class="overflow-x-auto mt-2">
                            <table class="min-w-full text-xs text-left">
                                <thead>
                                    <tr class="border-b border-green-700/70 text-green-100/80">
                                        @if ($range !== 'today' && $range !== 'yesterday')
                                            <th class="py-2 pr-4">Tanggal</th>
                                        @endif
                                        <th class="py-2 pr-4">Waktu</th>
                                        <th class="py-2 pr-4">Makanan / Minuman</th>
                                        <th class="py-2 pr-4">Kategori</th>
                                        <th class="py-2 pr-4 text-right">Kalori (kkal)</th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-green-800/80">
                                    @foreach ($entries as $item)
                                        <tr>
                                            @if ($range !== 'today' && $range !== 'yesterday')
                                                <td class="py-2 pr-4 text-green-100/80">
                                                    {{ $item['date'] ?? '-' }}
                                                </td>
                                            @endif
                                            <td class="py-2 pr-4 text-green-100/80">
                                                {{ $item['time'] ?? '-' }}
                                            </td>
                                            <td class="py-2 pr-4 text-green-50">
                                                {{ $item['meal'] ?? '-' }}
                                            </td>
                                            <td class="py-2 pr-4 text-green-100/80">
                                                {{ $item['category'] ?? '-' }}
                                            </td>
                                            <td class="py-2 pr-4 text-right text-yellow-300 font-semibold">
                                                {{ $item['calories'] ?? 0 }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>


                            </table>
                        </div>
                    @endif

                </section>

            </main>

        </div>
    </div>
    <!-- Modal Atur Target -->
    <div id="modal-target"
        class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center">
        <div class="bg-green-800 rounded-2xl p-6 w-full max-w-md shadow-xl relative">

            <button type="button" id="close-modal-target" class="absolute top-3 right-3 text-yellow-300 font-bold">
                ✕
            </button>

            <h3 class="text-lg font-semibold mb-4 text-yellow-300">Atur Target Kalori & Makro</h3>

            <p class="text-xs text-green-100/80 mb-3">
                Kamu bisa menghitung target otomatis lewat KaloriLab, atau mengatur secara manual di sini.
            </p>

            <div class="flex flex-col gap-2 mb-4">
                <a href="{{ route('kalori-lab') }}"
                    class="w-full inline-flex items-center justify-center px-4 py-2 rounded-full bg-yellow-400 text-green-900 text-xs font-semibold hover:bg-yellow-300 transition">
                    Hitung di KaloriLab (AI)
                </a>
                <p class="text-[10px] text-green-100/70 text-center">
                    Setelah menghitung di KaloriLab, target akan otomatis tersimpan dan muncul di sini.
                </p>
            </div>

            <div class="border-t border-green-700/60 my-3"></div>

            <p class="text-xs text-green-100/80 mb-2 font-semibold">
                Atur Target Manual
            </p>

            <form action="{{ route('kalori.tracker.target.update') }}" method="POST" class="space-y-3 text-sm">
                @csrf

                <div>
                    <label class="block mb-1 text-green-100/80">Target Kalori Harian (kkal)</label>
                    <input type="number" name="kalori_target" value="{{ $targetCalories ?? '' }}"
                        class="w-full rounded-xl px-3 py-2 text-green-900 text-sm" placeholder="Contoh: 2200"
                        required>
                </div>

                <div class="grid grid-cols-3 gap-3">
                    <div>
                        <label class="block mb-1 text-green-100/80">Karbo (g)</label>
                        <input type="number" name="karbo_target" value="{{ $targetCarbs ?? '' }}"
                            class="w-full rounded-xl px-3 py-2 text-green-900 text-xs" placeholder="Contoh: 250">
                    </div>
                    <div>
                        <label class="block mb-1 text-green-100/80">Protein (g)</label>
                        <input type="number" name="protein_target" value="{{ $targetProtein ?? '' }}"
                            class="w-full rounded-xl px-3 py-2 text-green-900 text-xs" placeholder="Contoh: 110">
                    </div>
                    <div>
                        <label class="block mb-1 text-green-100/80">Lemak (g)</label>
                        <input type="number" name="lemak_target" value="{{ $targetFat ?? '' }}"
                            class="w-full rounded-xl px-3 py-2 text-green-900 text-xs" placeholder="Contoh: 70">
                    </div>
                </div>

                <div class="pt-3 flex justify-end gap-2">
                    <button type="button" id="cancel-modal-target"
                        class="px-4 py-2 rounded-full border border-yellow-300 text-yellow-300 text-xs">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2 rounded-full bg-yellow-400 text-green-900 text-xs font-semibold">
                        Simpan Target
                    </button>
                </div>
            </form>
        </div>
    </div>


    <!-- Modal Tambah Makan (Manual + AI) -->
    <div id="modal-add-entry"
        class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center">
        <div class="bg-green-800 rounded-2xl p-6 w-full max-w-md shadow-xl relative">

            <button type="button" id="close-modal-entry" class="absolute top-3 right-3 text-yellow-300 font-bold">
                ✕
            </button>

            <h3 class="text-lg font-semibold mb-4 text-yellow-300">Tambah Catatan Makan</h3>

            {{-- TOGGLE MODE --}}
            <div class="flex mb-4 text-xs font-semibold bg-green-900/80 rounded-full p-1 gap-1">
                <button type="button" id="btn-mode-manual"
                    class="flex-1 px-3 py-2 rounded-full text-center bg-yellow-400 text-green-900">
                    Input Manual
                </button>
                <button type="button" id="btn-mode-ai"
                    class="flex-1 px-3 py-2 rounded-full text-center text-green-100 hover:bg-green-700/80">
                    Input via AI
                </button>
            </div>

            {{-- FORM MANUAL --}}
            <div id="section-manual">
                <form action="{{ route('kalori.tracker.entry.store') }}" method="POST" class="space-y-3 text-sm">
                    @csrf

                    @if (!empty($aiSuggestion))
                        <div class="mb-2 rounded-xl bg-green-900/80 border border-yellow-400/60 px-3 py-2">
                            <p class="text-[11px] text-yellow-200 font-semibold">
                                Hasil analisis AI sudah diisi. Silakan cek dan sesuaikan jika perlu sebelum disimpan.
                            </p>
                            @if (!empty($aiSuggestion['insight']))
                                <p class="text-[11px] text-green-100/80 mt-1 italic">
                                    Insight AI: "{{ $aiSuggestion['insight'] }}"
                                </p>
                            @endif
                        </div>
                    @endif

                    <div>
                        <label class="block mb-1 text-green-100/80">Waktu Makan</label>
                        <input type="datetime-local" name="eaten_at"
                            value="{{ old('eaten_at', $prefillEntry['eaten_at'] ?? ($aiSuggestion['eaten_at'] ?? now()->format('Y-m-d\TH:i'))) }}"
                            class="w-full rounded-xl px-3 py-2 text-green-900 text-xs">
                    </div>

                    <div>
                        <label class="block mb-1 text-green-100/80">Nama Makanan / Minuman</label>
                        <input type="text" name="meal"
                            value="{{ old('meal', $prefillEntry['meal'] ?? ($aiSuggestion['meal'] ?? '')) }}"
                            class="w-full rounded-xl px-3 py-2 text-green-900 text-sm" required>
                    </div>

                    <div>
                        <label class="block mb-1 text-green-100/80">Kategori</label>
                        @php $selectedCategory = old('category', $prefillEntry['category'] ?? ($aiSuggestion['category'] ?? '')); @endphp
                        <select name="category" class="w-full rounded-xl px-3 py-2 text-green-900 text-sm">
                            <option value="">Pilih kategori...</option>
                            @foreach (['Sarapan', 'Makan Siang', 'Makan Malam', 'Snack'] as $cat)
                                <option value="{{ $cat }}"
                                    {{ $selectedCategory === $cat ? 'selected' : '' }}>
                                    {{ $cat }}
                                </option>
                            @endforeach
                        </select>
                        <p class="text-[10px] text-green-100/70 mt-1">
                            Contoh: Sarapan jam 07.30, Makan Siang jam 12.00, Snack sore, dll.
                        </p>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block mb-1 text-green-100/80">Kalori (kkal)</label>
                            <input type="number" name="calories"
                                value="{{ old('calories', $prefillEntry['calories'] ?? ($aiSuggestion['calories'] ?? '')) }}">
                        </div>
                        <div>
                            <label class="block mb-1 text-green-100/80">Karbo (g)</label>
                            <input type="number" name="carbs"
                                value="{{ old('carbs', $prefillEntry['carbs'] ?? ($aiSuggestion['carbs'] ?? '')) }}">
                        </div>
                        <div>
                            <label class="block mb-1 text-green-100/80">Protein (g)</label>
                            <input type="number" name="protein"
                                value="{{ old('protein', $prefillEntry['protein'] ?? ($aiSuggestion['protein'] ?? '')) }}">
                        </div>
                        <div>
                            <label class="block mb-1 text-green-100/80">Lemak (g)</label>
                            <input type="number" name="fat"
                                value="{{ old('fat', $prefillEntry['fat'] ?? ($aiSuggestion['fat'] ?? '')) }}">
                        </div>
                    </div>

                    @if (!empty($aiSuggestion))
                        {{-- tandai bahwa entry ini berasal dari AI (meskipun sudah diedit) --}}
                        <input type="hidden" name="source" value="ai">
                        <input type="hidden" name="ai_prompt" value="{{ $aiSuggestion['ai_prompt'] }}">
                        <input type="hidden" name="ai_raw_response" value="{{ $aiSuggestion['ai_raw'] }}">
                    @endif

                    <div class="pt-3 flex justify-end gap-2">
                        <button type="button" id="cancel-modal-entry"
                            class="px-4 py-2 rounded-full border border-yellow-300 text-yellow-300 text-xs">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-4 py-2 rounded-full bg-yellow-400 text-green-900 text-xs font-semibold">
                            @if (!empty($aiSuggestion))
                                Simpan (Setelah Edit)
                            @else
                                Simpan Manual
                            @endif
                        </button>
                    </div>
                </form>
            </div>


            {{-- FORM AI --}}
            <div id="section-ai" class="hidden">
                <form action="{{ route('kalori.tracker.entry.ai') }}" method="POST" class="space-y-3 text-sm">
                    @csrf

                    <div>
                        <label class="block mb-1 text-green-100/80">Waktu Makan</label>
                        <input type="datetime-local" name="eaten_at" value="{{ now()->format('Y-m-d\TH:i') }}"
                            class="w-full rounded-xl px-3 py-2 text-green-900 text-xs">
                        <p class="text-[10px] text-green-100/70 mt-1">
                            Waktu saat kamu menghabiskan makanan ini.
                        </p>
                    </div>

                    <div>
                        <label class="block mb-1 text-green-100/80">Deskripsi Makanan (Prompt)</label>
                        <textarea name="ai_prompt" rows="4" class="w-full rounded-xl px-3 py-2 text-green-900 text-sm"
                            placeholder="Contoh:
Sarapan tadi: nasi putih 1 piring (±200 g), ayam goreng 1 potong paha, sambal sedikit, dan es teh manis 1 gelas. Tolong perkirakan kalori, karbohidrat, protein, dan lemaknya."></textarea>
                        <p class="text-[10px] text-green-100/70 mt-1">
                            Jelaskan dengan sederhana: jumlah nasi, lauk, minuman, cara masak (goreng/rebus), dan porsi
                            kira-kira.
                            AI akan mengira-ngira kandungan nutrisinya.
                        </p>
                    </div>

                    <div class="pt-3 flex justify-end gap-2">
                        <button type="button"
                            class="px-4 py-2 rounded-full border border-yellow-300 text-yellow-300 text-xs"
                            id="cancel-modal-entry-ai">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-4 py-2 rounded-full bg-yellow-400 text-green-900 text-xs font-semibold">
                            Analisis dengan AI
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <!-- Modal Performa (Grafik 7 & 30 hari) -->
    <div id="modal-performance"
        class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center">
        <div class="bg-green-800 rounded-2xl p-6 w-full max-w-3xl shadow-xl relative max-h-[90vh] overflow-y-auto">

            <button type="button" id="close-modal-performance"
                class="absolute top-3 right-3 text-yellow-300 font-bold">
                ✕
            </button>

            <h3 class="text-lg font-semibold mb-2 text-yellow-300">Performa Asupan Kalori</h3>
            <p class="text-[11px] text-green-100/80 mb-4">
                Lihat tren asupan kalori kamu 7 hari dan 30 hari terakhir untuk memantau konsistensi.
            </p>

            {{-- Tab 7 hari / 30 hari --}}
            <div class="flex mb-4 text-xs font-semibold bg-green-900/80 rounded-full p-1 gap-1">
                <button type="button" id="btn-tab-7d"
                    class="flex-1 px-3 py-2 rounded-full text-center bg-yellow-400 text-green-900">
                    7 Hari Terakhir
                </button>
                <button type="button" id="btn-tab-30d"
                    class="flex-1 px-3 py-2 rounded-full text-center text-green-100 hover:bg-green-700/80">
                    30 Hari Terakhir
                </button>
            </div>

            {{-- Canvas chart --}}
            <div class="bg-green-900/60 rounded-2xl p-4 mb-4">
                <canvas id="chart-performance" class="w-full h-64"></canvas>
            </div>

            {{-- Insight AI --}}
            <div class="bg-green-900/70 rounded-2xl p-4">
                <h4 class="text-sm font-semibold text-yellow-300 mb-2">Insight & Motivasi dari AI</h4>

                <div id="performance-insight-text" class="text-[12px] text-green-100/80 whitespace-pre-line mb-3">
                    Tekan tombol di bawah untuk mendapatkan insight.
                </div>

                <button id="btn-generate-insight"
                    class="w-full flex items-center justify-center px-4 py-2 rounded-full bg-yellow-400 text-green-900 text-xs font-semibold hover:bg-yellow-300 transition">
                    Dapatkan Insight AI
                </button>
            </div>


        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // === Generate Insight AI ===
        const insightBtn = document.getElementById('btn-generate-insight');
        const insightText = document.getElementById('performance-insight-text');

        if (insightBtn) {
            insightBtn.addEventListener('click', async () => {

                insightText.innerHTML = "⏳ Meminta insight dari AI...";

                const payload = {
                    chart7: chart7Labels.map((label, i) => ({
                        label: label,
                        value: chart7Calories[i]
                    })),
                    chart30: chart30Labels.map((label, i) => ({
                        label: label,
                        value: chart30Calories[i]
                    }))
                };

                const response = await fetch("{{ route('kalori.tracker.insight') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify(payload)
                });

                const json = await response.json();

                if (json.error) {
                    insightText.innerHTML = "❌ " + json.error;
                } else {
                    insightText.innerHTML = json.insight;
                }
            });
        }

        // === Modal Performa (Grafik) ===
        const perfModal = document.getElementById('modal-performance');
        const btnOpenPerf = document.getElementById('btn-open-performance-modal');
        const btnClosePerf = document.getElementById('close-modal-performance');
        const btnTab7d = document.getElementById('btn-tab-7d');
        const btnTab30d = document.getElementById('btn-tab-30d');
        const ctxPerf = document.getElementById('chart-performance')?.getContext('2d');

        const chart7Labels = @json($chart7Labels ?? []);
        const chart7Calories = @json($chart7Calories ?? []);
        const chart30Labels = @json($chart30Labels ?? []);
        const chart30Calories = @json($chart30Calories ?? []);

        let perfChart = null;
        let currentPerfTab = '7d';

        function openPerfModal() {
            perfModal.classList.remove('hidden');
            // saat dibuka pertama kali, pakai 7 hari
            currentPerfTab = '7d';
            setPerfTabActive();
            renderPerfChart(chart7Labels, chart7Calories, 'Kalori 7 Hari Terakhir');
        }

        function closePerfModal() {
            perfModal.classList.add('hidden');
        }

        function setPerfTabActive() {
            if (!btnTab7d || !btnTab30d) return;
            if (currentPerfTab === '7d') {
                btnTab7d.classList.add('bg-yellow-400', 'text-green-900');
                btnTab7d.classList.remove('text-green-100', 'hover:bg-green-700/80');

                btnTab30d.classList.remove('bg-yellow-400', 'text-green-900');
                btnTab30d.classList.add('text-green-100', 'hover:bg-green-700/80');
            } else {
                btnTab30d.classList.add('bg-yellow-400', 'text-green-900');
                btnTab30d.classList.remove('text-green-100', 'hover:bg-green-700/80');

                btnTab7d.classList.remove('bg-yellow-400', 'text-green-900');
                btnTab7d.classList.add('text-green-100', 'hover:bg-green-700/80');
            }
        }

        function renderPerfChart(labels, data, labelText) {
            if (!ctxPerf) return;

            if (perfChart) {
                perfChart.destroy();
            }

            perfChart = new Chart(ctxPerf, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: labelText,
                        data: data,
                        tension: 0.3,
                        fill: true,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            ticks: {
                                color: '#bbf7d0',
                                font: {
                                    size: 10
                                }
                            },
                            grid: {
                                display: false
                            },
                        },
                        y: {
                            ticks: {
                                color: '#bbf7d0',
                                font: {
                                    size: 10
                                }
                            },
                            grid: {
                                color: 'rgba(34,197,94,0.2)'
                            },
                        }
                    },
                    plugins: {
                        legend: {
                            labels: {
                                color: '#facc15',
                                font: {
                                    size: 11
                                }
                            }
                        }
                    }
                }
            });
        }

        if (btnOpenPerf) {
            btnOpenPerf.addEventListener('click', openPerfModal);
        }
        if (btnClosePerf) {
            btnClosePerf.addEventListener('click', closePerfModal);
        }
        if (perfModal) {
            perfModal.addEventListener('click', (e) => {
                if (e.target === perfModal) closePerfModal();
            });
        }

        if (btnTab7d) {
            btnTab7d.addEventListener('click', () => {
                currentPerfTab = '7d';
                setPerfTabActive();
                renderPerfChart(chart7Labels, chart7Calories, 'Kalori 7 Hari Terakhir');
            });
        }

        if (btnTab30d) {
            btnTab30d.addEventListener('click', () => {
                currentPerfTab = '30d';
                setPerfTabActive();
                renderPerfChart(chart30Labels, chart30Calories, 'Kalori 30 Hari Terakhir');
            });
        }

        // === Modal Target ===
        const targetModal = document.getElementById('modal-target');
        const openTargetBtn = document.getElementById('btn-open-target-modal');
        const closeTargetBtn = document.getElementById('close-modal-target');
        const cancelTargetBtn = document.getElementById('cancel-modal-target');

        function showTargetModal() {
            targetModal.classList.remove('hidden');
        }

        function hideTargetModal() {
            targetModal.classList.add('hidden');
        }

        if (openTargetBtn) {
            openTargetBtn.addEventListener('click', showTargetModal);
        }
        if (closeTargetBtn) {
            closeTargetBtn.addEventListener('click', hideTargetModal);
        }
        if (cancelTargetBtn) {
            cancelTargetBtn.addEventListener('click', hideTargetModal);
        }

        targetModal.addEventListener('click', (e) => {
            if (e.target === targetModal) hideTargetModal();
        });
        //Modal Entry
        const entryModal = document.getElementById('modal-add-entry');
        const openEntry = document.getElementById('btn-open-entry-modal');
        const closeEntry = document.getElementById('close-modal-entry');

        const cancelEntryManual = document.getElementById('cancel-modal-entry');
        const cancelEntryAi = document.getElementById('cancel-modal-entry-ai');

        const btnModeManual = document.getElementById('btn-mode-manual');
        const btnModeAi = document.getElementById('btn-mode-ai');
        const sectionManual = document.getElementById('section-manual');
        const sectionAi = document.getElementById('section-ai');

        function showModal() {
            entryModal.classList.remove('hidden');
        }

        function hideModal() {
            entryModal.classList.add('hidden');
        }

        function setMode(mode) {
            if (mode === 'manual') {
                sectionManual.classList.remove('hidden');
                sectionAi.classList.add('hidden');

                btnModeManual.classList.add('bg-yellow-400', 'text-green-900');
                btnModeManual.classList.remove('text-green-100', 'hover:bg-green-700/80');

                btnModeAi.classList.remove('bg-yellow-400', 'text-green-900');
                btnModeAi.classList.add('text-green-100', 'hover:bg-green-700/80');
            } else {
                sectionManual.classList.add('hidden');
                sectionAi.classList.remove('hidden');

                btnModeAi.classList.add('bg-yellow-400', 'text-green-900');
                btnModeAi.classList.remove('text-green-100', 'hover:bg-green-700/80');

                btnModeManual.classList.remove('bg-yellow-400', 'text-green-900');
                btnModeManual.classList.add('text-green-100', 'hover:bg-green-700/80');
            }
        }

        // DEFAULT MODE
        @if (!empty($prefillEntry))
            setMode('manual');
            entryModal.classList.remove('hidden');
        @elseif (!empty($aiSuggestion))
            setMode('manual');
            entryModal.classList.remove('hidden');
        @else
            setMode('ai');
        @endif




        if (openEntry) {
            openEntry.addEventListener('click', () => {
                // Saat user klik "Tambah Catatan Makan", arahkan ke mode AI dulu
                setMode('ai');
                showModal();
            });
        }

        // Untuk tombol "Tambah Catatan Pertama"
        const openEntryEmpty = document.getElementById('btn-open-entry-modal-empty');
        if (openEntryEmpty) {
            openEntryEmpty.addEventListener('click', () => {
                setMode('ai');
                showModal();
            });
        }


        closeEntry.addEventListener('click', hideModal);
        if (cancelEntryManual) cancelEntryManual.addEventListener('click', hideModal);
        if (cancelEntryAi) cancelEntryAi.addEventListener('click', hideModal);

        entryModal.addEventListener('click', (e) => {
            if (e.target === entryModal) hideModal();
        });

        btnModeManual.addEventListener('click', () => setMode('manual'));
        btnModeAi.addEventListener('click', () => setMode('ai'));
    </script>



</body>

</html>
