<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>KaloriLab (AI) - KaloriKita</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- CSRF untuk fetch ke /kalori-lab/insight --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <style>
        body {
            font-family: 'Instrument Sans', sans-serif;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</head>

<body class="bg-green-900/95">

    {{-- NAVBAR --}}
    <x-navbar></x-navbar>

    @php
        $user = auth()->user();
        $googleConnected = !empty($user?->google_id);
    @endphp

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="flex flex-col lg:flex-row gap-6">

            {{-- SIDEBAR --}}
            <aside class="w-full lg:w-64 bg-green-800/90 border border-green-700/70 rounded-3xl p-5 h-max">

                {{-- Profil mini --}}
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
                            {{ $user?->role === 'admin' ? 'Admin' : 'Pengguna' }}
                        </p>
                    </div>
                </div>

                {{-- Menu --}}
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

                    <a href="{{ route('kalori-lab') }}"
                        class="flex items-center justify-between px-3 py-2 rounded-xl 
                              {{ request()->routeIs('kalori-lab') ? 'bg-white text-green-900 font-semibold' : 'text-green-100 hover:bg-green-700/70' }}">
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
                            <a href="{{ route('google.connect') ?? '#' }}"
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

            {{-- KONTEN UTAMA KALORILAB --}}
            <main class="flex-1 space-y-6">
                <section class="bg-green-800/90 border border-green-700/70 rounded-3xl p-6 sm:p-7 shadow-xl">

                    {{-- Header --}}
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-6">
                        <div>
                            <p class="text-xs text-green-100/70 mb-1">KaloriLab (AI)</p>
                            <h1 class="text-xl sm:text-2xl font-semibold text-white">
                                Hitung Kalori & Dapatkan Insight Cerdas
                            </h1>
                            <p class="text-xs sm:text-sm text-green-100/75 mt-1">
                                Masukkan data dasar, pilih aktivitas & tujuan, lalu KaloriLab menghitung BMI, BMR,
                                kalori target, dan makro.
                            </p>
                        </div>
                        <div
                            class="bg-yellow-400 text-green-900 text-[11px] sm:text-xs font-semibold px-4 py-2 rounded-full shadow-md">
                            Hasil bisa dipakai sebagai target di Kalori Tracker.
                        </div>
                    </div>

                    <div class="space-y-5">
                        {{-- FORM UTAMA --}}
                        <form id="lab-form" class="space-y-4">

                            {{-- 1) PROFIL KAMU (SATU BARIS: KIRI TEKS, KANAN FORM) --}}
                            <div class="bg-green-900/80 border border-green-700/80 rounded-2xl p-4">
                                <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">

                                    {{-- Kiri: judul & keterangan --}}
                                    <div class="md:w-2/5">
                                        <p class="text-[11px] font-bold text-green-100/70 uppercase tracking-wide">
                                            Profil Kamu</p>
                                        <p class="text-xs text-green-100/80 mt-1">
                                            Kita gunakan data ini untuk menghitung BMI, BMR, dan kebutuhan kalori
                                            yang paling mendekati kondisi tubuhmu saat ini.
                                        </p>
                                        <p class="mt-2 text-[11px] text-green-100/70">
                                            Usahakan input sedekat mungkin dengan kondisi nyata agar rekomendasi lebih
                                            akurat.
                                        </p>
                                    </div>

                                    {{-- Kanan: form gender + usia/TB/BB --}}
                                    <div class="md:w-3/5 space-y-3">
                                        {{-- Gender chips --}}
                                        <div>
                                            <p class="text-[11px] text-green-100/75 mb-1">Jenis Kelamin</p>
                                            <div class="grid grid-cols-2 gap-2 text-[11px]">
                                                <label class="cursor-pointer">
                                                    <input type="radio" name="gender" value="male"
                                                        class="hidden peer" />
                                                    <div
                                                        class="flex items-center justify-center gap-2 rounded-2xl 
                                                                bg-green-900/80 border border-green-700/80
                                                                peer-checked:bg-yellow-400 peer-checked:border-yellow-300
                                                                peer-checked:text-green-900
                                                                text-green-100 px-3 py-2 transition">
                                                        <span class="text-lg">👨</span>
                                                        <span class="font-semibold">Laki-laki</span>
                                                    </div>
                                                </label>
                                                <label class="cursor-pointer">
                                                    <input type="radio" name="gender" value="female"
                                                        class="hidden peer" />
                                                    <div
                                                        class="flex items-center justify-center gap-2 rounded-2xl 
                                                                bg-green-900/80 border border-green-700/80
                                                                peer-checked:bg-yellow-400 peer-checked:border-yellow-300
                                                                peer-checked:text-green-900
                                                                text-green-100 px-3 py-2 transition">
                                                        <span class="text-lg">👩</span>
                                                        <span class="font-semibold">Perempuan</span>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>

                                        {{-- Usia, TB, BB --}}
                                        <div>
                                            <p class="text-[11px] text-green-100/75 mb-1">Data Fisik</p>
                                            <div class="grid grid-cols-3 gap-2 text-[11px]">
                                                <div class="space-y-1">
                                                    <p class="text-green-100/70">Usia (Tahun)</p>
                                                    <input id="usia-input" type="number" min="10" max="80"
                                                        placeholder="Tahun"
                                                        class="w-full bg-white border border-green-700/80 rounded-xl px-2 py-1.5 text-center text-[11px] focus:outline-none focus:ring-2 focus:ring-yellow-400/70">
                                                </div>
                                                <div class="space-y-1">
                                                    <p class="text-green-100/70">Tinggi Badan (Cm)</p>
                                                    <input id="tb-input" type="number" min="100" max="230"
                                                        placeholder="cm"
                                                        class="w-full bg-white border border-green-700/80 rounded-xl px-2 py-1.5 text-center text-[11px] focus:outline-none focus:ring-2 focus:ring-yellow-400/70">
                                                </div>
                                                <div class="space-y-1">
                                                    <p class="text-green-100/70">Berat Badan (Kg)</p>
                                                    <input id="bb-input" type="number" min="20" max="200"
                                                        placeholder="kg"
                                                        class="w-full bg-white border border-green-700/80 rounded-xl px-2 py-1.5 text-center text-[11px] focus:outline-none focus:ring-2 focus:ring-yellow-400/70">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            {{-- 2) AKTIVITAS & TUJUAN (2 KARTU SEJAJAR) --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                                {{-- Card Aktivitas --}}
                                <div class="bg-green-900/80 border border-green-700/80 rounded-2xl p-4 space-y-3">
                                    <div>
                                        <p class="text-[11px] text-green-100/70 uppercase tracking-wide">Aktivitas
                                            Harian</p>
                                        <p class="text-xs text-green-100/80">
                                            Pilih gambaran aktivitasmu dalam 1 hari.
                                        </p>
                                    </div>

                                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 text-[11px]">
                                        {{-- Ringan --}}
                                        <label class="cursor-pointer">
                                            <input type="radio" name="aktivitas" value="ringan"
                                                class="hidden peer" />
                                            <div
                                                class="h-full flex flex-col items-start justify-between rounded-2xl 
                                                        bg-green-900/80 border border-green-700/80
                                                        peer-checked:bg-yellow-400 peer-checked:border-yellow-300
                                                        peer-checked:text-green-900
                                                        text-green-50 px-3 py-2.5 transition">
                                                <div class="flex items-center gap-2 mb-1">
                                                    <span class="text-lg">🛋️</span>
                                                    <span class="font-semibold text-xs">Ringan</span>
                                                </div>
                                                <p class="text-[10px] leading-snug">
                                                    Banyak duduk, jalan seperlunya (kuliah/kerja kantoran, minim
                                                    olahraga).
                                                </p>
                                            </div>
                                        </label>

                                        {{-- Sedang --}}
                                        <label class="cursor-pointer">
                                            <input type="radio" name="aktivitas" value="sedang"
                                                class="hidden peer" />
                                            <div
                                                class="h-full flex flex-col items-start justify-between rounded-2xl 
                                                        bg-green-900/80 border border-green-700/80
                                                        peer-checked:bg-yellow-400 peer-checked:border-yellow-300
                                                        peer-checked:text-green-900
                                                        text-green-50 px-3 py-2.5 transition">
                                                <div class="flex items-center gap-2 mb-1">
                                                    <span class="text-lg">🚶‍♂️</span>
                                                    <span class="font-semibold text-xs">Sedang</span>
                                                </div>
                                                <p class="text-[10px] leading-snug">
                                                    Banyak berjalan, naik turun tangga, olahraga ringan 3–5x/minggu.
                                                </p>
                                            </div>
                                        </label>

                                        {{-- Berat --}}
                                        <label class="cursor-pointer">
                                            <input type="radio" name="aktivitas" value="berat"
                                                class="hidden peer" />
                                            <div
                                                class="h-full flex flex-col items-start justify-between rounded-2xl 
                                                        bg-green-900/80 border border-green-700/80
                                                        peer-checked:bg-yellow-400 peer-checked:border-yellow-300
                                                        peer-checked:text-green-900
                                                        text-green-50 px-3 py-2.5 transition">
                                                <div class="flex items-center gap-2 mb-1">
                                                    <span class="text-lg">🏃‍♂️</span>
                                                    <span class="font-semibold text-xs">Berat</span>
                                                </div>
                                                <p class="text-[10px] leading-snug">
                                                    Kerja fisik/latihan intens (gym, olahraga berat, kerja lapangan).
                                                </p>
                                            </div>
                                        </label>
                                    </div>
                                </div>

                                {{-- Card Tujuan --}}
                                <div class="bg-green-900/80 border border-green-700/80 rounded-2xl p-4 space-y-3">
                                    <div>
                                        <p class="text-[11px] text-green-100/70 uppercase tracking-wide">Tujuan Kamu
                                        </p>
                                        <p class="text-xs text-green-100/80">
                                            Pilih arah perubahan berat badan yang diinginkan.
                                        </p>
                                    </div>

                                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 text-[11px]">
                                        {{-- Turun --}}
                                        <label class="cursor-pointer">
                                            <input type="radio" name="tujuan" value="turun"
                                                class="hidden peer" />
                                            <div
                                                class="h-full flex flex-col items-start justify-between rounded-2xl 
                                                        bg-green-900/80 border border-green-700/80
                                                        peer-checked:bg-yellow-400 peer-checked:border-yellow-300
                                                        peer-checked:text-green-900
                                                        text-green-50 px-3 py-2.5 transition">
                                                <div class="flex items-center gap-2 mb-1">
                                                    <span class="text-lg">🎯</span>
                                                    <span class="font-semibold text-xs">Turun</span>
                                                </div>
                                                <p class="text-[10px] leading-snug">
                                                    Fokus defisit kalori untuk menurunkan berat badan bertahap.
                                                </p>
                                            </div>
                                        </label>

                                        {{-- Pertahankan --}}
                                        <label class="cursor-pointer">
                                            <input type="radio" name="tujuan" value="pertahankan"
                                                class="hidden peer" />
                                            <div
                                                class="h-full flex flex-col items-start justify-between rounded-2xl 
                                                        bg-green-900/80 border border-green-700/80
                                                        peer-checked:bg-yellow-400 peer-checked:border-yellow-300
                                                        peer-checked:text-green-900
                                                        text-green-50 px-3 py-2.5 transition">
                                                <div class="flex items-center gap-2 mb-1">
                                                    <span class="text-lg">⚖️</span>
                                                    <span class="font-semibold text-xs">Pertahankan</span>
                                                </div>
                                                <p class="text-[10px] leading-snug">
                                                    Menjaga berat badan sekarang tetap stabil dan seimbang.
                                                </p>
                                            </div>
                                        </label>

                                        {{-- Naik --}}
                                        <label class="cursor-pointer">
                                            <input type="radio" name="tujuan" value="naik"
                                                class="hidden peer" />
                                            <div
                                                class="h-full flex flex-col items-start justify-between rounded-2xl 
                                                        bg-green-900/80 border border-green-700/80
                                                        peer-checked:bg-yellow-400 peer-checked:border-yellow-300
                                                        peer-checked:text-green-900
                                                        text-green-50 px-3 py-2.5 transition">
                                                <div class="flex items-center gap-2 mb-1">
                                                    <span class="text-lg">💪</span>
                                                    <span class="font-semibold text-xs">Naik</span>
                                                </div>
                                                <p class="text-[10px] leading-snug">
                                                    Menambah berat badan (bulking) dengan cara yang terkontrol.
                                                </p>
                                            </div>
                                        </label>
                                    </div>
                                </div>

                            </div>

                            {{-- 3) WARNING + TOMBOL HITUNG --}}
                            <div class="space-y-2">
                                <span id="form-warning" class="hidden text-[11px] text-red-300 font-semibold">
                                    *Lengkapi semua data terlebih dahulu
                                </span>
                                <button type="submit"
                                    class="w-full inline-flex items-center justify-center rounded-full bg-yellow-400 text-green-900 text-xs sm:text-sm font-semibold px-4 py-2.5 shadow-md hover:bg-yellow-300 transition">
                                    Hitung Kalori & Insight
                                </button>
                            </div>

                        </form>

                        {{-- HASIL ANALISIS --}}
                        <div id="lab-result-wrapper" class="hidden mt-8 text-white">
                            <div class="flex justify-between items-center mb-6 gap-4">
                                <div>
                                    <h2 class="text-2xl font-semibold">Hasil Analisis Kalori</h2>
                                    <p class="text-sm text-green-100 mt-1">
                                        Ringkasan kebutuhan kalori dan makronutrien berdasarkan data yang kamu masukkan.
                                    </p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                                {{-- KIRI: BMI + KALORI --}}
                                <div class="space-y-6">
                                    {{-- BMI CARD --}}
                                    <div class="bg-green-900/60 border border-green-500/40 rounded-2xl p-5 shadow-lg">
                                        <div class="flex justify-between items-center mb-2">
                                            <h3 class="text-lg font-semibold text-yellow-300">Status BMI</h3>
                                            <span id="result-bmi-category"
                                                class="px-3 py-1 rounded-full text-xs font-bold bg-yellow-400 text-green-900">
                                                -
                                            </span>
                                        </div>

                                        <div class="flex items-end gap-4 mb-4">
                                            <div>
                                                <p class="text-3xl font-bold" id="result-bmi">0.0</p>
                                                <p class="text-xs text-green-100">Body Mass Index</p>
                                            </div>
                                            <div class="text-xs text-green-100">
                                                <p><span class="font-semibold">Usia:</span> <span
                                                        id="result-usia">-</span> th</p>
                                                <p><span class="font-semibold">TB:</span> <span
                                                        id="result-tb">-</span> cm</p>
                                                <p><span class="font-semibold">BB:</span> <span
                                                        id="result-bb">-</span> kg</p>
                                            </div>
                                        </div>

                                        {{-- BMI SCALE BAR --}}
                                        <div class="w-full max-w-md">
                                            <div class="flex justify-between text-[11px] text-green-100 mb-1">
                                                <span>Kurus</span>
                                                <span>Normal</span>
                                                <span>Berlebih</span>
                                                <span>Obesitas</span>
                                            </div>
                                            <div
                                                class="relative w-full h-3 rounded-full bg-gradient-to-r from-sky-300 via-emerald-400 via-yellow-300 to-red-500 overflow-hidden">
                                                <div id="bmi-indicator"
                                                    class="absolute -top-1 w-2 h-5 bg-white rounded-full shadow"></div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- KALORI CARD --}}
                                    <div class="bg-green-900/60 border border-green-500/40 rounded-2xl p-5 shadow-lg">
                                        <h3 class="text-lg font-semibold text-yellow-300 mb-3">Kebutuhan Kalori</h3>
                                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-sm">
                                            <div class="bg-green-950/60 rounded-xl p-3 flex flex-col items-start">
                                                <span
                                                    class="text-[11px] text-green-200 uppercase tracking-wide">BMR</span>
                                                <span class="text-xl font-bold mt-1" id="result-bmr">0</span>
                                                <span class="text-[11px] text-green-300">Kalori saat istirahat</span>
                                            </div>
                                            <div class="bg-green-950/60 rounded-xl p-3 flex flex-col items-start">
                                                <span
                                                    class="text-[11px] text-green-200 uppercase tracking-wide">TDEE</span>
                                                <span class="text-xl font-bold mt-1" id="result-tdee">0</span>
                                                <span class="text-[11px] text-green-300">Kalori harian
                                                    (aktivitas)</span>
                                            </div>
                                            <div
                                                class="bg-yellow-400 text-green-900 rounded-xl p-3 flex flex-col items-start">
                                                <span class="text-[11px] uppercase tracking-wide">Kalori Target</span>
                                                <span class="text-xl font-extrabold mt-1"
                                                    id="result-cal-target">0</span>
                                                <span class="text-[11px]" id="result-tujuan-label">Sesuai tujuan
                                                    kamu</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- KANAN: MAKRO + INSIGHT --}}
                                <div class="space-y-6">
                                    {{-- MAKRO CARD --}}
                                    <div class="bg-green-900/60 border border-green-500/40 rounded-2xl p-5 shadow-lg">
                                        <h3 class="text-lg font-semibold text-yellow-300 mb-3">Perkiraan Makronutrien /
                                            Hari</h3>
                                        <p class="text-xs text-green-100 mb-3">
                                            Dibagi dari kalori <span class="font-semibold">target</span> untuk
                                            memudahkan
                                            pengaturan pola makan.
                                        </p>
                                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-sm">
                                            <div class="bg-white text-green-900 rounded-xl p-3 flex flex-col">
                                                <span
                                                    class="text-[11px] font-semibold uppercase tracking-wide text-green-700">Karbohidrat</span>
                                                <span class="text-xl font-extrabold mt-1" id="result-carb-g">0
                                                    g</span>
                                                <span class="text-[11px] text-green-700" id="result-carb-pct">0%
                                                    kalori</span>
                                            </div>
                                            <div class="bg-white text-green-900 rounded-xl p-3 flex flex-col">
                                                <span
                                                    class="text-[11px] font-semibold uppercase tracking-wide text-green-700">Protein</span>
                                                <span class="text-xl font-extrabold mt-1" id="result-protein-g">0
                                                    g</span>
                                                <span class="text-[11px] text-green-700" id="result-protein-pct">0%
                                                    kalori</span>
                                            </div>
                                            <div class="bg-white text-green-900 rounded-xl p-3 flex flex-col">
                                                <span
                                                    class="text-[11px] font-semibold uppercase tracking-wide text-green-700">Lemak</span>
                                                <span class="text-xl font-extrabold mt-1" id="result-fat-g">0 g</span>
                                                <span class="text-[11px] text-green-700" id="result-fat-pct">0%
                                                    kalori</span>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- INSIGHT AI CARD --}}
                                    <div class="bg-green-900/60 border border-green-500/40 rounded-2xl p-5 shadow-lg">
                                        <div class="flex items-center gap-2 mb-3">
                                            <div
                                                class="w-8 h-8 rounded-full bg-yellow-400 flex items-center justify-center text-green-900 font-extrabold text-lg">
                                                AI
                                            </div>
                                            <h3 class="text-lg font-semibold text-yellow-300">Insight Rekomendasi</h3>
                                        </div>
                                        <p id="result-insight"
                                            class="text-sm text-green-100 leading-relaxed line-clamp-3">
                                            Insight AI akan muncul di sini.
                                        </p>

                                        <button id="view-more-btn"
                                            class="mt-3 text-yellow-400 hover:text-yellow-300 text-sm font-semibold underline hidden">
                                            View More
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>

                        {{-- MODAL FULL INSIGHT --}}
                        <div id="insight-modal"
                            class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm flex justify-center items-center z-50">

                            <div class="bg-green-800 rounded-2xl max-w-lg w-full mx-4 p-6 shadow-xl relative">

                                <button id="close-modal"
                                    class="absolute top-3 right-3 text-yellow-300 text-xl font-bold">
                                    ✕
                                </button>

                                <h3 class="text-xl font-semibold text-yellow-400 mb-4">Insight Lengkap</h3>

                                <div id="modal-insight-content"
                                    class="text-sm text-green-100 leading-relaxed space-y-3 overflow-y-auto max-h-[60vh] pr-2">
                                    <!-- Full insight AI akan masuk ke sini -->
                                </div>

                                <div class="mt-6 text-right">
                                    <button id="close-modal-bottom"
                                        class="px-6 py-2 rounded-full bg-yellow-400 text-green-900 font-bold hover:bg-yellow-300">
                                        Tutup
                                    </button>
                                </div>

                            </div>
                        </div>

                </section>
            </main>
        </div>
    </div>

    {{-- MODAL FULL INSIGHT --}}
    <div id="insight-modal"
        class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm flex justify-center items-center z-50">

        <div class="bg-green-800 rounded-2xl max-w-lg w-full mx-4 p-6 shadow-xl relative">

            <button id="close-modal" class="absolute top-3 right-3 text-yellow-300 text-xl font-bold">
                ✕
            </button>

            <h3 class="text-xl font-semibold text-yellow-400 mb-4">Insight Lengkap</h3>

            <div id="modal-insight-content"
                class="text-sm text-green-100 leading-relaxed space-y-3 overflow-y-auto max-h-[60vh] pr-2">
                <!-- Full insight AI -->
            </div>

            <div class="mt-6 text-right">
                <button id="close-modal-bottom"
                    class="px-6 py-2 rounded-full bg-yellow-400 text-green-900 font-bold hover:bg-yellow-300">
                    Tutup
                </button>
            </div>

        </div>
    </div>

    {{-- SCRIPT --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('lab-form');
            const formWarning = document.getElementById('form-warning');

            const usiaInput = document.getElementById('usia-input');
            const tbInput = document.getElementById('tb-input');
            const bbInput = document.getElementById('bb-input');

            const bmiSpan = document.getElementById('result-bmi');
            const bmiCatSpan = document.getElementById('result-bmi-category');
            const usiaSpan = document.getElementById('result-usia');
            const tbSpan = document.getElementById('result-tb');
            const bbSpan = document.getElementById('result-bb');
            const bmiIndicator = document.getElementById('bmi-indicator');

            const bmrSpan = document.getElementById('result-bmr');
            const tdeeSpan = document.getElementById('result-tdee');
            const calTargetSpan = document.getElementById('result-cal-target');
            const tujuanLabelSpan = document.getElementById('result-tujuan-label');

            const carbGSpan = document.getElementById('result-carb-g');
            const carbPctSpan = document.getElementById('result-carb-pct');
            const proteinGSpan = document.getElementById('result-protein-g');
            const proteinPctSpan = document.getElementById('result-protein-pct');
            const fatGSpan = document.getElementById('result-fat-g');
            const fatPctSpan = document.getElementById('result-fat-pct');

            const resultWrapper = document.getElementById('lab-result-wrapper');
            const insightP = document.getElementById('result-insight');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            function classifyBMI(bmi) {
                if (bmi < 18.5) return 'Kurus';
                if (bmi < 25) return 'Normal';
                if (bmi < 30) return 'Berlebih';
                return 'Obesitas';
            }

            function tujuanLabel(tujuan) {
                if (tujuan === 'turun')
                    return 'Defisit sekitar 15% dari TDEE untuk menurunkan berat badan.';
                if (tujuan === 'naik')
                    return 'Surplus sekitar 15% dari TDEE untuk menaikkan berat badan.';
                return 'Kalori seimbang untuk mempertahankan berat badan.';
            }

            function getMacroConfig(tujuan) {
                if (tujuan === 'turun') {
                    return {
                        carb: 45,
                        protein: 25,
                        fat: 30
                    };
                }
                if (tujuan === 'naik') {
                    return {
                        carb: 55,
                        protein: 20,
                        fat: 25
                    };
                }
                return {
                    carb: 50,
                    protein: 20,
                    fat: 30
                };
            }

            function generatePromptForGemini({
                gender,
                usia,
                tb,
                bb,
                bmi,
                bmiCat,
                bmr,
                tdee,
                tujuan,
                calTarget,
                macroCfg,
                carbG,
                proteinG,
                fatG
            }) {
                const genderText = gender === 'male' ? 'laki-laki' : 'perempuan';
                const tujuanText = tujuan === 'turun' ?
                    'turun berat badan' :
                    tujuan === 'naik' ?
                    'naik berat badan' :
                    'mempertahankan berat badan';

                return `
Kamu adalah asisten gizi untuk aplikasi KaloriKita.

Berikan insight singkat berdasarkan data pengguna berikut:

Gender: ${genderText}
Usia: ${usia} tahun
Tinggi badan: ${tb} cm
Berat badan: ${bb} kg

BMI: ${bmi.toFixed(1)}
Kategori BMI: ${bmiCat}

BMR: ${Math.round(bmr)} kkal
TDEE: ${Math.round(tdee)} kkal
Tujuan: ${tujuanText}
Kalori target: ${Math.round(calTarget)} kkal

Makronutrien per hari (dari kalori target):
- Karbohidrat: ${Math.round(carbG)} g (${macroCfg.carb}% kalori)
- Protein: ${Math.round(proteinG)} g (${macroCfg.protein}% kalori)
- Lemak: ${Math.round(fatG)} g (${macroCfg.fat}% kalori)

Instruksi format jawaban:
1. Paragraf 1: jelaskan kondisi pengguna (kategori BMI dan tujuan) dengan nada positif dan tidak menghakimi.
2. Paragraf 2: gambarkan pola makan harian secara umum (misal 3x makan utama + 1–2 snack) berdasarkan kalori awal tersebut.
3. Tambahkan 3 bullet point saran praktis yang sangat konkret (contoh jenis makanan, kebiasaan harian sederhana, dan tips konsisten).

Gunakan bahasa Indonesia, maksimal sekitar 180 kata, ramah dan mudah dipahami, tanpa istilah medis rumit.
                `.trim();
            }

            form.addEventListener('submit', (e) => {
                e.preventDefault();

                const genderEl = document.querySelector('input[name="gender"]:checked');
                const aktivitasEl = document.querySelector('input[name="aktivitas"]:checked');
                const tujuanEl = document.querySelector('input[name="tujuan"]:checked');

                const usia = parseFloat(usiaInput.value);
                const tb = parseFloat(tbInput.value);
                const bb = parseFloat(bbInput.value);

                if (!genderEl || !aktivitasEl || !tujuanEl || isNaN(usia) || isNaN(tb) || isNaN(bb)) {
                    formWarning.textContent = '*Lengkapi semua data terlebih dahulu';
                    formWarning.classList.remove('hidden');
                    return;
                }

                formWarning.classList.add('hidden');

                const gender = genderEl.value;
                const aktivitas = aktivitasEl.value;
                const tujuan = tujuanEl.value;

                // BMI
                const bmi = bb / Math.pow(tb / 100, 2);
                const bmiCat = classifyBMI(bmi);

                // BMR
                let bmr;
                if (gender === 'male') {
                    bmr = 10 * bb + 6.25 * tb - 5 * usia + 5;
                } else {
                    bmr = 10 * bb + 6.25 * tb - 5 * usia - 161;
                }

                // Faktor aktivitas
                let faktorAktivitas = 1.375;
                if (aktivitas === 'sedang') faktorAktivitas = 1.55;
                if (aktivitas === 'berat') faktorAktivitas = 1.725;

                const tdee = bmr * faktorAktivitas;

                // Kalori target
                let calTarget = tdee;
                if (tujuan === 'turun') calTarget = tdee * 0.85;
                if (tujuan === 'naik') calTarget = tdee * 1.15;

                // Makro
                const macroCfg = getMacroConfig(tujuan);
                const carbKcal = calTarget * (macroCfg.carb / 100);
                const proteinKcal = calTarget * (macroCfg.protein / 100);
                const fatKcal = calTarget * (macroCfg.fat / 100);

                const carbG = carbKcal / 4;
                const proteinG = proteinKcal / 4;
                const fatG = fatKcal / 9;

                // UPDATE UI
                bmiSpan.textContent = bmi.toFixed(1);
                bmiCatSpan.textContent = bmiCat;
                usiaSpan.textContent = usia.toString();
                tbSpan.textContent = tb.toString();
                bbSpan.textContent = bb.toString();

                bmrSpan.textContent = Math.round(bmr) + ' kkal';
                tdeeSpan.textContent = Math.round(tdee) + ' kkal';
                calTargetSpan.textContent = Math.round(calTarget) + ' kkal';
                tujuanLabelSpan.textContent = tujuanLabel(tujuan);

                carbGSpan.textContent = Math.round(carbG) + ' g';
                carbPctSpan.textContent = macroCfg.carb + '% kalori';
                proteinGSpan.textContent = Math.round(proteinG) + ' g';
                proteinPctSpan.textContent = macroCfg.protein + '% kalori';
                fatGSpan.textContent = Math.round(fatG) + ' g';
                fatPctSpan.textContent = macroCfg.fat + '% kalori';

                // Posisi indikator BMI
                const minBMI = 15;
                const maxBMI = 40;
                const normalized = Math.max(0, Math.min(1, (bmi - minBMI) / (maxBMI - minBMI)));
                const percent = normalized * 100;
                bmiIndicator.style.left = `calc(${percent}% - 4px)`;

                // TAMPILKAN HASIL + SCROLL KE BAGIAN HASIL
                if (resultWrapper) {
                    resultWrapper.classList.remove('hidden');
                    resultWrapper.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }


                // PANGGIL GEMINI
                insightP.textContent = 'Menyusun insight AI berdasarkan data kamu...';

                const prompt = generatePromptForGemini({
                    gender,
                    usia,
                    tb,
                    bb,
                    bmi,
                    bmiCat,
                    bmr,
                    tdee,
                    tujuan,
                    calTarget,
                    macroCfg,
                    carbG,
                    proteinG,
                    fatG
                });

                const goal = tujuan === 'turun' ?
                    'weightloss' :
                    tujuan === 'naik' ?
                    'bulking' :
                    'maintain';

                fetch("{{ route('lab.insight') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            prompt,
                            bmr: Math.round(bmr),
                            tdee: Math.round(tdee),
                            kalori_target: Math.round(calTarget),
                            karbo_target: Math.round(carbG),
                            protein_target: Math.round(proteinG),
                            lemak_target: Math.round(fatG),
                            goal
                        })
                    })

                    .then(async (res) => {
                        if (!res.ok) {
                            const errorText = await res.text();
                            console.error('Response error:', res.status, errorText);
                            throw new Error('HTTP ' + res.status);
                        }
                        return res.json();
                    })

                    .then(data => {
                        if (data.insight) {
                            const fullInsight = data.insight;

                            insightP.textContent = fullInsight;

                            const modalInsightEl = document.getElementById("modal-insight-content");
                            modalInsightEl.innerHTML = formatInsightToHtml(fullInsight);

                            document.getElementById("view-more-btn").classList.remove("hidden");
                        } else {
                            insightP.textContent = 'AI tidak mengembalikan insight.';
                        }
                    })
                    .catch(() => {
                        insightP.textContent = 'Maaf, terjadi kesalahan saat mengambil insight AI.';
                    });
            });

            // MODAL
            const viewMoreBtn = document.getElementById("view-more-btn");
            const modal = document.getElementById("insight-modal");
            const closeModal = document.getElementById("close-modal");
            const closeModalBottom = document.getElementById("close-modal-bottom");

            viewMoreBtn.addEventListener("click", () => {
                modal.classList.remove("hidden");
            });

            closeModal.addEventListener("click", () => {
                modal.classList.add("hidden");
            });

            closeModalBottom.addEventListener("click", () => {
                modal.classList.add("hidden");
            });

            modal.addEventListener("click", (e) => {
                if (e.target === modal) {
                    modal.classList.add("hidden");
                }
            });
        });

        function formatInsightToHtml(text) {
            if (!text) return '';

            let html = text
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;');

            // **bold**
            html = html.replace(/\*(.+?)\*/g, '<strong>$1</strong>');

            const lines = html.split(/\r?\n/);
            let inList = false;
            let result = '';

            for (let line of lines) {
                const bulletMatch = line.match(/^\s*\*\s+(.*)/);

                if (bulletMatch) {
                    if (!inList) {
                        inList = true;
                        result += '<ul class="list-disc pl-5 space-y-1 mb-2">';
                    }
                    result += `<li>${bulletMatch[1]}</li>`;
                } else {
                    if (inList) {
                        inList = false;
                        result += '</ul>';
                    }
                    if (line.trim() !== '') {
                        result += `<p class="mb-2">${line}</p>`;
                    } else {
                        result += '<div class="mb-2"></div>';
                    }
                }
            }

            if (inList) {
                result += '</ul>';
            }

            return result;
        }
    </script>

</body>

</html>
