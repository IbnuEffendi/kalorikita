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

    <section id="lab-section" class="w-full min-h-screen flex justify-center items-center py-20 px-4">

        <div class="relative w-full max-w-6xl bg-green-800 rounded-[2.5rem] shadow-2xl p-8 md:p-12">

            <!-- WRAPPER FORM HITUNG -->
            <div id="lab-form-wrapper">
                <form id="lab-form" action="#" method="POST">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20">

                        <div class="flex flex-col items-center w-full">

                            <div class="text-center mb-8">
                                <h2 class="text-2xl font-semibold text-white mb-2">Informasi Personal</h2>
                                <div class="h-1 w-16 bg-yellow-400 mx-auto rounded-full"></div>
                            </div>

                            <!-- GENDER -->
                            <div class="flex justify-center gap-6 mb-8 w-full max-w-md">
                                <label class="cursor-pointer group w-1/2">
                                    <input type="radio" name="gender" value="male" class="hidden peer" />
                                    <div
                                        class="flex flex-col items-center gap-3 border-2 border-transparent bg-white peer-checked:bg-[#DAEFA2] peer-checked:border-green-400 rounded-2xl px-4 py-6 transition-all shadow-md hover:scale-105 w-full h-full justify-center">
                                        <img src="/asset/laki.png" alt="Laki-laki" class="w-16 h-16 object-contain">
                                        <span class="text-sm font-bold text-gray-800">Laki-Laki</span>
                                    </div>
                                </label>

                                <label class="cursor-pointer group w-1/2">
                                    <input type="radio" name="gender" value="female" class="hidden peer" />
                                    <div
                                        class="flex flex-col items-center gap-3 border-2 border-transparent bg-white peer-checked:bg-[#DAEFA2] peer-checked:border-green-400 rounded-2xl px-4 py-6 transition-all shadow-md hover:scale-105 w-full h-full justify-center">
                                        <img src="/asset/perempuan.png" alt="Perempuan"
                                            class="w-16 h-16 object-contain">
                                        <span class="text-sm font-bold text-gray-800">Perempuan</span>
                                    </div>
                                </label>
                            </div>

                            <span id="form-warning"
                                class="text-sm text-red-400 font-bold drop-shadow-md block mb-6 text-center animate-pulse">
                                *Lengkapi Data Diri Anda
                            </span>

                            <!-- INPUT USIA / TB / BB -->
                            <div class="flex flex-col items-center space-y-4 w-full max-w-md">
                                <input id="usia-input" type="number" min="10" max="80"
                                    placeholder="Usia (Tahun)"
                                    class="w-full bg-white rounded-xl px-6 py-3 text-center font-medium placeholder:text-gray-400 focus:outline-none focus:ring-4 focus:ring-green-500/50 shadow-inner">

                                <input id="tb-input" type="number" min="100" max="230"
                                    placeholder="Tinggi Badan (Cm)"
                                    class="w-full bg-white rounded-xl px-6 py-3 text-center font-medium placeholder:text-gray-400 focus:outline-none focus:ring-4 focus:ring-green-500/50 shadow-inner">

                                <input id="bb-input" type="number" min="20" max="200"
                                    placeholder="Berat Badan (Kg)"
                                    class="w-full bg-white rounded-xl px-6 py-3 text-center font-medium placeholder:text-gray-400 focus:outline-none focus:ring-4 focus:ring-green-500/50 shadow-inner">
                            </div>
                        </div>

                        <div class="lg:hidden w-full h-0.5 bg-green-700/50"></div>

                        <!-- AKTIVITAS & TUJUAN -->
                        <div class="flex flex-col items-center justify-between w-full h-full">

                            <!-- Aktivitas -->
                            <div class="w-full flex flex-col items-center mb-10">
                                <h3 class="text-2xl font-semibold text-white mb-2">Aktivitas</h3>
                                <div class="h-1 w-12 bg-yellow-400 mb-8 rounded-full"></div>

                                <div class="grid grid-cols-3 gap-4 w-full max-w-md">
                                    <label class="cursor-pointer">
                                        <input type="radio" name="aktivitas" value="ringan" class="hidden peer" />
                                        <div
                                            class="h-20 flex items-center justify-center bg-white text-gray-700 font-bold rounded-xl border-2 border-transparent peer-checked:bg-[#DAEFA2] peer-checked:text-green-800 peer-checked:border-green-500 transition-all hover:bg-gray-50 px-2 text-center text-sm sm:text-base">
                                            Ringan</div>
                                    </label>
                                    <label class="cursor-pointer">
                                        <input type="radio" name="aktivitas" value="sedang" class="hidden peer" />
                                        <div
                                            class="h-20 flex items-center justify-center bg-white text-gray-700 font-bold rounded-xl border-2 border-transparent peer-checked:bg-[#DAEFA2] peer-checked:text-green-800 peer-checked:border-green-500 transition-all hover:bg-gray-50 px-2 text-center text-sm sm:text-base">
                                            Sedang</div>
                                    </label>
                                    <label class="cursor-pointer">
                                        <input type="radio" name="aktivitas" value="berat" class="hidden peer" />
                                        <div
                                            class="h-20 flex items-center justify-center bg-white text-gray-700 font-bold rounded-xl border-2 border-transparent peer-checked:bg-[#DAEFA2] peer-checked:text-green-800 peer-checked:border-green-500 transition-all hover:bg-gray-50 px-2 text-center text-sm sm:text-base">
                                            Berat</div>
                                    </label>
                                </div>
                            </div>

                            <div class="w-full max-w-md h-0.5 bg-green-600/30 mb-10"></div>

                            <!-- Tujuan -->
                            <div class="w-full flex flex-col items-center">
                                <h3 class="text-2xl font-semibold text-white mb-2">Tujuan</h3>
                                <div class="h-1 w-12 bg-yellow-400 mb-8 rounded-full"></div>

                                <div class="grid grid-cols-3 gap-4 w-full max-w-md">
                                    <label class="cursor-pointer">
                                        <input type="radio" name="tujuan" value="turun" class="hidden peer" />
                                        <div
                                            class="h-20 flex items-center justify-center bg-white text-gray-700 font-bold rounded-xl border-2 border-transparent peer-checked:bg-[#DAEFA2] peer-checked:text-green-800 peer-checked:border-green-500 transition-all hover:bg-gray-50 px-2 text-center text-sm sm:text-base">
                                            Turun</div>
                                    </label>
                                    <label class="cursor-pointer">
                                        <input type="radio" name="tujuan" value="pertahankan"
                                            class="hidden peer" />
                                        <div
                                            class="h-20 flex items-center justify-center bg-white text-gray-700 font-bold rounded-xl border-2 border-transparent peer-checked:bg-[#DAEFA2] peer-checked:text-green-800 peer-checked:border-green-500 transition-all hover:bg-gray-50 px-2 text-center text-xs sm:text-sm font-bold leading-tight">
                                            Pertahankan</div>
                                    </label>
                                    <label class="cursor-pointer">
                                        <input type="radio" name="tujuan" value="naik" class="hidden peer" />
                                        <div
                                            class="h-20 flex items-center justify-center bg-white text-gray-700 font-bold rounded-xl border-2 border-transparent peer-checked:bg-[#DAEFA2] peer-checked:text-green-800 peer-checked:border-green-500 transition-all hover:bg-gray-50 px-2 text-center text-sm sm:text-base">
                                            Naik</div>
                                    </label>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="relative flex flex-col sm:flex-row justify-center gap-6 mt-16">
                        <button type="submit"
                            class="bg-yellow-400 hover:bg-yellow-300 text-green-900 font-bold text-lg px-12 py-3 rounded-full shadow-lg transition-all transform hover:-translate-y-1">
                            Hitung
                        </button>
                        <button type="reset"
                            class="bg-transparent border-2 border-white text-white hover:bg-white hover:text-green-900 font-bold text-lg px-12 py-3 rounded-full shadow-lg transition-all transform hover:-translate-y-1">
                            Reset
                        </button>
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

                        <!-- INSIGHT AI CARD -->
                        <div class="bg-green-900/60 border border-green-500/40 rounded-2xl p-5 shadow-lg">
                            <div class="flex items-center gap-2 mb-3">
                                <div
                                    class="w-8 h-8 rounded-full bg-yellow-400 flex items-center justify-center text-green-900 font-extrabold text-lg">
                                    AI
                                </div>
                                <h3 class="text-lg font-semibold text-yellow-300">Insight Rekomendasi</h3>
                            </div>
                            <p id="result-insight" class="text-sm text-green-100 leading-relaxed line-clamp-3">
                                Insight AI akan muncul di sini.
                            </p>

                            <button id="view-more-btn"
                                class="mt-3 text-yellow-400 hover:text-yellow-300 text-sm font-semibold underline hidden">
                                View More
                            </button>

                            <button id="back-edit-mobile" type="button"
                                class="mt-5 w-full md:hidden bg-yellow-400 text-green-900 font-bold text-sm px-4 py-2 rounded-full shadow hover:bg-yellow-300 transition">
                                Ubah Data
                            </button>
                        </div>
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
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            function classifyBMI(bmi) {
                if (bmi < 18.5) return 'Kurus';
                if (bmi < 25) return 'Normal';
                if (bmi < 30) return 'Berlebih';
                return 'Obesitas';
            }

            function tujuanLabel(tujuan) {
                if (tujuan === 'turun') return 'Defisit sekitar 15% dari TDEE untuk menurunkan berat badan.';
                if (tujuan === 'naik') return 'Surplus sekitar 15% dari TDEE untuk menaikkan berat badan.';
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

                // >>>> PANGGIL GEMINI UNTUK INSIGHT <<<<
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

                fetch("{{ route('lab.insight') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            prompt
                        })
                    })

                    .then(res => res.json())
                    .then(data => {
                        if (data.insight) {
                            const fullInsight = data.insight;

                            // Preview pendek tetap plain (biar line-clamp rapi)
                            insightP.textContent = fullInsight;

                            // Modal: pakai HTML yang sudah diformat
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

            function backToEdit() {
                resultWrapper.classList.add('hidden');
                formWrapper.classList.remove('hidden');
            }

            backEdit.addEventListener('click', backToEdit);
            backEditMobile.addEventListener('click', backToEdit);
        });

        function formatInsightToHtml(text) {
            if (!text) return '';

            // Escape dasar supaya aman
            let html = text
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;');

            // Bold: **teks** -> <strong>teks</strong>
            html = html.replace(/\*\*(.+?)\*\*/g, '<strong>$1</strong>');

            // Bullet list: baris yang diawali "* " jadi <li>
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
                        // baris kosong -> jarak antar paragraf
                        result += '<div class="mb-2"></div>';
                    }
                }
            }

            if (inList) {
                result += '</ul>';
            }

            return result;
        }


        // ===== MODAL HANDLING =====
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

        // klik area gelap (outside modal) untuk close
        modal.addEventListener("click", (e) => {
            if (e.target === modal) {
                modal.classList.add("hidden");
            }
        });
    </script>

</body>

</html>
