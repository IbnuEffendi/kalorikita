<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab Kalori - KaloriKita</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <style>
        body {
            font-family: 'Instrument Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-green-900 text-gray-900">

    <section id="lab-section" class="w-full min-h-screen flex justify-center items-center px-4">

        <div class="relative w-full max-w-6xl bg-green-800 rounded-[2.5rem] shadow-2xl p-8 md:p-12">
            <center><h1 class="uppercase font-bold text-yellow-400 text-2xl pb-8">Kalori Lab</h1></center>

            <!-- WRAPPER FORM HITUNG -->
            <div id="lab-form-wrapper">
                <form id="lab-form" class="space-y-5">

                    <!-- CARD: PROFIL KAMU -->
                    <div class="bg-green-900/80 border border-green-700/80 rounded-2xl p-4">
                        <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">

                            <!-- Kiri: judul & keterangan -->
                            <div class="md:w-2/5">
                                <p class="text-[11px] font-bold text-green-100/70 uppercase tracking-wide">
                                    Profil Kamu
                                </p>
                                <p class="text-xs text-green-100/80 mt-1">
                                    Kita gunakan data ini untuk menghitung BMI, BMR, dan kebutuhan kalori
                                    yang paling mendekati kondisi tubuhmu saat ini.
                                </p>
                                <p class="mt-2 text-[11px] text-green-100/70">
                                    Usahakan input sedekat mungkin dengan kondisi nyata agar rekomendasi lebih akurat.
                                </p>
                            </div>

                            <!-- Kanan: GENDER + USIA/TB/BB -->
                            <div class="md:w-3/5 space-y-3">
                                <!-- Gender chips -->
                                <div>
                                    <p class="text-[11px] text-green-100/75 mb-1">Jenis Kelamin</p>
                                    <div class="grid grid-cols-2 gap-2 text-[11px]">
                                        <label class="cursor-pointer">
                                            <input type="radio" name="gender" value="male" class="hidden peer" />
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
                                            <input type="radio" name="gender" value="female" class="hidden peer" />
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

                                <!-- Usia, TB, BB -->
                                <div>
                                    <p class="text-[11px] text-green-100/75 mb-1">Data Fisik</p>
                                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 text-[11px]">
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

                    <!-- CARD: AKTIVITAS & TUJUAN (2 KARTU SEJAJAR) -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <!-- Aktivitas -->
                        <div class="bg-green-900/80 border border-green-700/80 rounded-2xl p-4 space-y-3">
                            <div>
                                <p class="text-[11px] text-green-100/70 uppercase tracking-wide">Aktivitas Harian</p>
                                <p class="text-xs text-green-100/80">
                                    Pilih gambaran aktivitasmu dalam 1 hari.
                                </p>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 text-[11px]">
                                <!-- Ringan -->
                                <label class="cursor-pointer">
                                    <input type="radio" name="aktivitas" value="ringan" class="hidden peer" />
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
                                            Banyak duduk, jalan seperlunya (kuliah/kerja kantoran, minim olahraga).
                                        </p>
                                    </div>
                                </label>

                                <!-- Sedang -->
                                <label class="cursor-pointer">
                                    <input type="radio" name="aktivitas" value="sedang" class="hidden peer" />
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

                                <!-- Berat -->
                                <label class="cursor-pointer">
                                    <input type="radio" name="aktivitas" value="berat" class="hidden peer" />
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

                        <!-- Tujuan -->
                        <div class="bg-green-900/80 border border-green-700/80 rounded-2xl p-4 space-y-3">
                            <div>
                                <p class="text-[11px] text-green-100/70 uppercase tracking-wide">Tujuan Kamu</p>
                                <p class="text-xs text-green-100/80">
                                    Pilih arah perubahan berat badan yang diinginkan.
                                </p>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 text-[11px]">
                                <!-- Turun -->
                                <label class="cursor-pointer">
                                    <input type="radio" name="tujuan" value="turun" class="hidden peer" />
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

                                <!-- Pertahankan -->
                                <label class="cursor-pointer">
                                    <input type="radio" name="tujuan" value="pertahankan" class="hidden peer" />
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

                                <!-- Naik -->
                                <label class="cursor-pointer">
                                    <input type="radio" name="tujuan" value="naik" class="hidden peer" />
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

                    <!-- WARNING + TOMBOL -->
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 mt-2">
                        <span id="form-warning" class="hidden text-[11px] text-red-300 font-semibold">
                            *Lengkapi semua data terlebih dahulu
                        </span>

                        <div class="flex gap-3 w-full sm:w-auto">
                            <button type="submit"
                                class="flex-1 sm:flex-none inline-flex items-center justify-center rounded-full bg-yellow-400 text-green-900 text-xs sm:text-sm font-semibold px-6 py-2.5 shadow-md hover:bg-yellow-300 transition">
                                Hitung Kalori
                            </button>
                            <button type="reset"
                                class="flex-1 sm:flex-none inline-flex items-center justify-center rounded-full border border-green-200 text-green-100 text-xs sm:text-sm font-semibold px-6 py-2.5 hover:bg-green-100/10 transition">
                                Reset
                            </button>
                        </div>
                    </div>

                </form>
            </div>


            <!-- WRAPPER HASIL ANALISIS (AWALNYA HIDDEN) -->
            <div id="lab-result-wrapper" class="hidden text-white">
                <div class="flex justify-between items-center mb-6 gap-4">
                    <div>
                        <h2 class="text-2xl font-semibold">Hasil Analisis Kalori</h2>
                        <p class="text-sm text-green-100 mt-1">
                            Ringkasan kebutuhan kalori dan makronutrien berdasarkan data yang kamu masukkan.
                        </p>
                    </div>
                    <button id="back-edit" type="button"
                        class="hidden md:inline-flex items-center gap-2 px-4 py-2 rounded-full border border-yellow-400 text-yellow-300 hover:bg-yellow-400 hover:text-green-900 text-sm font-semibold transition">
                        Ubah Data
                    </button>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                    <!-- KIRI: BMI + KALORI -->
                    <div class="space-y-6">
                        <!-- BMI CARD -->
                        <div class="bg-green-900/60 border border-green-500/40 rounded-2xl p-5 shadow-lg">
                            <div class="flex justify-between items-center mb-2">
                                <h3 class="text-lg font-semibold text-yellow-300">Status BMI</h3>
                                <span id="result-bmi-category"
                                    class="px-3 py-1 rounded-full text-xs font-bold bg-yellow-400 text-green-900">
                                    Normal
                                </span>
                            </div>

                            <div class="flex items-end gap-4 mb-4">
                                <div>
                                    <p class="text-3xl font-bold" id="result-bmi">0.0</p>
                                    <p class="text-xs text-green-100">Body Mass Index</p>
                                </div>
                                <div class="text-xs text-green-100">
                                    <p><span class="font-semibold">Usia:</span> <span id="result-usia">-</span> th</p>
                                    <p><span class="font-semibold">TB:</span> <span id="result-tb">-</span> cm</p>
                                    <p><span class="font-semibold">BB:</span> <span id="result-bb">-</span> kg</p>
                                </div>
                            </div>

                            <!-- BMI SCALE BAR -->
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

                        <!-- KALORI CARD -->
                        <div class="bg-green-900/60 border border-green-500/40 rounded-2xl p-5 shadow-lg">
                            <h3 class="text-lg font-semibold text-yellow-300 mb-3">Kebutuhan Kalori</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-sm">
                                <div class="bg-green-950/60 rounded-xl p-3 flex flex-col items-start">
                                    <span class="text-[11px] text-green-200 uppercase tracking-wide">BMR</span>
                                    <span class="text-xl font-bold mt-1" id="result-bmr">0</span>
                                    <span class="text-[11px] text-green-300">Kalori saat istirahat</span>
                                </div>
                                <div class="bg-green-950/60 rounded-xl p-3 flex flex-col items-start">
                                    <span class="text-[11px] text-green-200 uppercase tracking-wide">TDEE</span>
                                    <span class="text-xl font-bold mt-1" id="result-tdee">0</span>
                                    <span class="text-[11px] text-green-300">Kalori harian (aktivitas)</span>
                                </div>
                                <div class="bg-yellow-400 text-green-900 rounded-xl p-3 flex flex-col items-start">
                                    <span class="text-[11px] uppercase tracking-wide">Kalori Target</span>
                                    <span class="text-xl font-extrabold mt-1" id="result-cal-target">0</span>
                                    <span class="text-[11px]" id="result-tujuan-label">Sesuai tujuan kamu</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- KANAN: MAKRO + INSIGHT -->
                    <div class="space-y-6">
                        <!-- MAKRO CARD -->
                        <div class="bg-green-900/60 border border-green-500/40 rounded-2xl p-5 shadow-lg">
                            <h3 class="text-lg font-semibold text-yellow-300 mb-3">Perkiraan Makronutrien / Hari</h3>
                            <p class="text-xs text-green-100 mb-3">
                                Dibagi dari kalori <span class="font-semibold">target</span> untuk memudahkan
                                pengaturan pola makan.
                            </p>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-sm">
                                <div class="bg-white text-green-900 rounded-xl p-3 flex flex-col">
                                    <span
                                        class="text-[11px] font-semibold uppercase tracking-wide text-green-700">Karbohidrat</span>
                                    <span class="text-xl font-extrabold mt-1" id="result-carb-g">0 g</span>
                                    <span class="text-[11px] text-green-700" id="result-carb-pct">0% kalori</span>
                                </div>
                                <div class="bg-white text-green-900 rounded-xl p-3 flex flex-col">
                                    <span
                                        class="text-[11px] font-semibold uppercase tracking-wide text-green-700">Protein</span>
                                    <span class="text-xl font-extrabold mt-1" id="result-protein-g">0 g</span>
                                    <span class="text-[11px] text-green-700" id="result-protein-pct">0% kalori</span>
                                </div>
                                <div class="bg-white text-green-900 rounded-xl p-3 flex flex-col">
                                    <span
                                        class="text-[11px] font-semibold uppercase tracking-wide text-green-700">Lemak</span>
                                    <span class="text-xl font-extrabold mt-1" id="result-fat-g">0 g</span>
                                    <span class="text-[11px] text-green-700" id="result-fat-pct">0% kalori</span>
                                </div>
                            </div>
                        </div>

                        <!-- INSIGHT (NON-AI UNTUK UMUM) -->
                        <div class="bg-green-900/60 border border-green-500/40 rounded-2xl p-5 shadow-lg">
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center gap-2">
                                    <div
                                        class="w-8 h-8 rounded-full bg-yellow-400 flex items-center justify-center text-green-900 font-extrabold text-lg">
                                        AI
                                    </div>
                                    <h3 class="text-lg font-semibold text-yellow-300">Insight & Saran Singkat</h3>
                                </div>
                                <span
                                    class="text-[11px] px-3 py-1 rounded-full bg-green-950/70 text-yellow-200 font-semibold">
                                    Fitur AI penuh: Login
                                </span>
                            </div>

                            <p class="text-xs text-green-100/80 mb-2">
                                Di halaman demo ini kamu bisa lihat perhitungan BMI, BMR, TDEE, dan makro. Insight di
                                bawah ini
                                dibuat otomatis sederhana (bukan AI). Untuk insight AI yang lebih personal dan tersimpan
                                di akunmu,
                                silakan login.
                            </p>

                            <p id="result-insight" class="text-sm text-green-100 leading-relaxed">
                                Setelah menghitung, saran singkat akan muncul di sini.
                            </p>

                            <a href="{{ route('login') }}"
                                class="mt-4 inline-flex items-center justify-center px-4 py-2 rounded-full bg-yellow-400 text-green-900 text-xs font-semibold hover:bg-yellow-300 transition">
                                Login untuk membuka KaloriLab (AI) versi penuh
                            </a>

                            <button id="back-edit-mobile" type="button"
                                class="mt-3 w-full md:hidden bg-transparent border border-yellow-400 text-yellow-300 font-bold text-sm px-4 py-2 rounded-full shadow hover:bg-yellow-400 hover:text-green-900 transition">
                                Ubah Data
                            </button>
                        </div>

                    </div>
                </div>

                <!-- MODAL FULL INSIGHT -->
                <div id="insight-modal"
                    class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm flex justify-center items-center z-50">

                    <div class="bg-green-800 rounded-2xl max-w-lg w-full mx-4 p-6 shadow-xl relative">

                        <button id="close-modal" class="absolute top-3 right-3 text-yellow-300 text-xl font-bold">
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


            </div>

    </section>

    <!-- SCRIPT PERHITUNGAN -->

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('lab-form');
            const formWrapper = document.getElementById('lab-form-wrapper');
            const resultWrapper = document.getElementById('lab-result-wrapper');
            const formWarning = document.getElementById('form-warning');
            const backEdit = document.getElementById('back-edit');
            const backEditMobile = document.getElementById('back-edit-mobile');

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

            const insightP = document.getElementById('result-insight');

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

            function buildSimpleInsight({
                tujuan,
                calTarget,
                bmiCat
            }) {
                let opening = '';

                if (bmiCat === 'Kurus') {
                    opening =
                        'Berat badanmu saat ini masuk kategori kurus. Itu bukan berarti buruk, tapi kamu perlu ekstra perhatian pada asupan energi dan protein.';
                } else if (bmiCat === 'Normal') {
                    opening =
                        'Berat badanmu saat ini berada di kategori normal. Ini modal yang bagus untuk menjaga kesehatan jangka panjang.';
                } else if (bmiCat === 'Berlebih') {
                    opening =
                        'Berat badanmu masuk kategori berlebih. Dengan pola makan yang lebih teratur dan aktif bergerak, kamu bisa perlahan kembali ke rentang sehat.';
                } else {
                    opening =
                        'Berat badanmu masuk kategori obesitas. Perubahan kecil tapi konsisten akan jauh lebih aman dan efektif daripada diet ekstrem.';
                }

                let goalText = '';
                if (tujuan === 'turun') {
                    goalText =
                        `Kamu memilih tujuan menurunkan berat badan. Coba jaga asupan sekitar ${Math.round(calTarget)} kkal per hari dan fokus ke makanan tinggi protein dan berserat.`;
                } else if (tujuan === 'naik') {
                    goalText =
                        `Kamu memilih tujuan menaikkan berat badan. Target sekitar ${Math.round(calTarget)} kkal per hari dengan sumber kalori dari karbo kompleks, protein cukup, dan lemak sehat.`;
                } else {
                    goalText =
                        `Kamu ingin mempertahankan berat badan. Menjaga asupan sekitar ${Math.round(calTarget)} kkal per hari dengan pola makan seimbang sudah sangat baik.`;
                }

                const closing =
                    'Ingat, ini baru gambaran angka awal. Untuk insight AI yang lebih personal dan bisa disimpan di akunmu, login ke KaloriKita dan gunakan KaloriLab versi penuh di dashboard.';

                return `${opening} ${goalText} ${closing}`;
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

                const gender = genderEl.value; // 'male' / 'female'
                const aktivitas = aktivitasEl.value; // 'ringan' / 'sedang' / 'berat'
                const tujuan = tujuanEl.value; // 'turun' / 'pertahankan' / 'naik'

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

                // UPDATE UI angka dasar
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

                // TAMPILKAN HASIL, SEMBUNYIKAN FORM
                formWrapper.classList.add('hidden');
                resultWrapper.classList.remove('hidden');

                // INSIGHT SEDERHANA (BUKAN AI)
                const simpleInsight = buildSimpleInsight({
                    tujuan,
                    calTarget,
                    bmiCat
                });
                insightP.textContent = simpleInsight;

                // Scroll ke hasil
                const labSection = document.getElementById('lab-section');
                if (labSection && labSection.scrollIntoView) {
                    labSection.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });

            function backToEdit() {
                resultWrapper.classList.add('hidden');
                formWrapper.classList.remove('hidden');
            }

            if (backEdit) backEdit.addEventListener('click', backToEdit);
            if (backEditMobile) backEditMobile.addEventListener('click', backToEdit);
        });
    </script>


</body>

</html>
