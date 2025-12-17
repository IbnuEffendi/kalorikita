<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pemesanan | KaloriKita</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="bg-[#F4F8F2] font-sans relative pb-20">

    <x-navbar></x-navbar>

    <section class="relative bg-green-800 text-white py-16">
        <div class="absolute inset-0">
            <img src="/asset/header-paket.jpeg" class="w-full h-full object-cover" alt="Header Pemesanan" />
            <div class="absolute inset-0 bg-green-900/60"></div>
        </div>

        <div class="relative max-w-6xl mx-auto px-6 text-left">
            <h1 class="text-4xl font-bold mb-2">Pemesanan</h1>
            <p class="text-lg font-medium">
                Lengkapi data pengiriman untuk Paket {{ $paketOption->category->nama_kategori }}
            </p>
        </div>
    </section>

    <section class="max-w-6xl mx-auto px-6 mt-10">
        <div class="flex items-center justify-center space-x-6 text-sm font-medium text-gray-600">
            <div class="flex items-center space-x-2">
                <div class="w-6 h-6 rounded-full bg-green-600 text-white flex items-center justify-center text-xs font-semibold">1</div>
                <span class="text-green-700 font-bold">Data & Pengiriman</span>
            </div>
            <div class="w-16 h-0.5 bg-gray-300"></div>
            <div class="flex items-center space-x-2">
                <div class="w-6 h-6 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center text-xs font-semibold">2</div>
                <span class="text-gray-400">Pembayaran</span>
            </div>
            <div class="w-16 h-0.5 bg-gray-300"></div>
            <div class="flex items-center space-x-2">
                <div class="w-6 h-6 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center text-xs font-semibold">3</div>
                <span class="text-gray-400">Konfirmasi</span>
            </div>
        </div>
    </section>

    <section class="max-w-6xl mx-auto px-6 py-12 flex flex-col lg:flex-row gap-10 relative z-10">

        <div class="bg-white shadow-md rounded-2xl p-8 flex-1">
            <div class="flex items-start justify-between gap-4 mb-8">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Detail Pengiriman</h2>
                    <p class="text-sm text-gray-500 mt-2">
                        Kolom bertanda <span class="text-red-500 font-bold">*</span> wajib diisi.
                    </p>
                </div>

                {{-- Alert ringkas untuk error global --}}
                <div id="formAlert" class="hidden text-xs bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl">
                    <i class="fas fa-exclamation-circle mr-1"></i>
                    Lengkapi dulu semua kolom wajib agar bisa lanjut.
                </div>
            </div>

            <form id="orderForm" class="space-y-6" method="POST" action="{{ route('paket.payment') }}" novalidate>
                @csrf

                <input type="hidden" name="paket_option_id" value="{{ $paketOption->id }}">

                {{-- Paket dipilih --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Paket Dipilih</label>
                    <input type="text"
                        value="Paket {{ $paketOption->category->nama_kategori }} ({{ $paketOption->durasi_hari }} Hari)"
                        readonly
                        class="w-full border border-gray-300 bg-gray-100 text-gray-500 rounded-lg p-3 focus:outline-none cursor-not-allowed font-medium" />
                </div>

                {{-- Nama --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Nama Lengkap <span class="text-red-500">*</span>
                        <span class="ml-2 text-[11px] text-gray-400 font-semibold">Wajib</span>
                    </label>
                    <input id="nama" type="text" name="nama"
                        value="{{ Auth::check() ? Auth::user()->name : '' }}"
                        class="field w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-green-500 focus:outline-none transition"
                        placeholder="Masukkan nama lengkap penerima" required minlength="3" />
                    <p id="err-nama" class="hidden text-xs text-red-600 mt-2">
                        <i class="fas fa-exclamation-circle mr-1"></i> Nama wajib diisi (min. 3 karakter).
                    </p>
                </div>

                {{-- WhatsApp --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Nomor WhatsApp <span class="text-red-500">*</span>
                        <span class="ml-2 text-[11px] text-gray-400 font-semibold">Wajib</span>
                    </label>
                    <input id="whatsapp" type="tel" name="whatsapp"
                        inputmode="numeric"
                        class="field w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-green-500 focus:outline-none transition"
                        placeholder="Contoh: 081234567890" required />
                    <p class="text-[11px] text-gray-400 mt-2">Gunakan format Indonesia, contoh: 08xxxxxxxxxx</p>
                    <p id="err-whatsapp" class="hidden text-xs text-red-600 mt-2">
                        <i class="fas fa-exclamation-circle mr-1"></i> Nomor WA wajib diisi (min. 10 digit).
                    </p>
                </div>

                {{-- Start Date (Wajib) --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Tanggal Mulai Paket <span class="text-red-500">*</span>
                        <span class="ml-2 text-[11px] text-gray-400 font-semibold">Wajib</span>
                    </label>
                    <input id="start_date" type="date" name="start_date"
                        class="field w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-green-500 focus:outline-none transition"
                        required />
                    <p id="err-start_date" class="hidden text-xs text-red-600 mt-2">
                        <i class="fas fa-exclamation-circle mr-1"></i> Pilih tanggal mulai (minimal hari ini).
                    </p>
                </div>

                {{-- Food Preference (Wajib) --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-3">
                        Preferensi Makanan <span class="text-red-500">*</span>
                        <span class="ml-2 text-[11px] text-gray-400 font-semibold">Wajib</span>
                    </label>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <label class="cursor-pointer border border-gray-300 rounded-xl p-4 hover:border-green-500 transition flex items-start gap-3">
                            <input class="field mt-1" type="radio" name="food_preference" value="non_vegan" required />
                            <div>
                                <p class="font-bold text-gray-800">Non-Vegan</p>
                                <p class="text-xs text-gray-500 mt-1">Termasuk telur/susu dan menu umum.</p>
                            </div>
                        </label>

                        <label class="cursor-pointer border border-gray-300 rounded-xl p-4 hover:border-green-500 transition flex items-start gap-3">
                            <input class="field mt-1" type="radio" name="food_preference" value="vegan" required />
                            <div>
                                <p class="font-bold text-gray-800">Vegan</p>
                                <p class="text-xs text-gray-500 mt-1">Tanpa produk hewani (sesuai paket).</p>
                            </div>
                        </label>
                    </div>

                    <p id="err-food_preference" class="hidden text-xs text-red-600 mt-2">
                        <i class="fas fa-exclamation-circle mr-1"></i> Pilih salah satu preferensi makanan.
                    </p>
                </div>

                {{-- Alamat --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Alamat Lengkap <span class="text-red-500">*</span>
                        <span class="ml-2 text-[11px] text-gray-400 font-semibold">Wajib</span>
                    </label>
                    <textarea id="alamat" name="alamat" rows="3"
                        class="field w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-green-500 focus:outline-none transition"
                        placeholder="Nama Jalan, No. Rumah, RT/RW, Patokan..." required minlength="10"></textarea>
                    <p id="err-alamat" class="hidden text-xs text-red-600 mt-2">
                        <i class="fas fa-exclamation-circle mr-1"></i> Alamat wajib diisi (min. 10 karakter).
                    </p>
                </div>

                {{-- Catatan (Opsional) --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Catatan Makanan <span class="text-gray-400 text-xs font-semibold">(Opsional)</span>
                    </label>
                    <input id="catatan" type="text" name="catatan"
                        class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-green-500 focus:outline-none transition"
                        placeholder="Contoh: Tanpa pedas, alergi udang" maxlength="500" />
                </div>

                {{-- Submit button mobile (optional) --}}
                <button id="btnNextMobile" type="submit"
                    class="lg:hidden w-full mt-2 py-3.5 bg-yellow-400 hover:bg-yellow-600 text-black font-bold rounded-xl text-center transition shadow-md hover:shadow-lg flex justify-center items-center gap-2 disabled:opacity-60 disabled:cursor-not-allowed">
                    Lanjut Pembayaran <i class="fas fa-arrow-right text-xs"></i>
                </button>

            </form>
        </div>

        <div class="lg:w-1/3">
            <div class="bg-white shadow-md rounded-2xl p-6 sticky top-24 border border-gray-50">
                <h3 class="text-xl font-semibold text-gray-800 mb-6">Ringkasan</h3>

                <div class="space-y-4 text-gray-700">

                    <div class="border-b border-gray-100 pb-4">
                        <div class="flex justify-between items-start mb-2">
                            <span class="font-bold text-gray-800 text-lg">Paket
                                {{ $paketOption->category->nama_kategori }}</span>
                        </div>

                        <div class="bg-green-50 rounded-lg p-3 text-xs text-gray-600 space-y-1.5 border border-green-100">
                            <div class="flex justify-between">
                                <span><i class="far fa-calendar mr-1 text-green-600"></i> Durasi</span>
                                <span class="font-bold">{{ $paketOption->durasi_hari }} Hari</span>
                            </div>
                            <div class="flex justify-between">
                                <span><i class="fas fa-box-open mr-1 text-green-600"></i> Total Box</span>
                                <span class="font-bold">{{ $totalBox }} Box</span>
                            </div>
                            <div class="flex justify-between">
                                <span><i class="fas fa-fire mr-1 text-green-600"></i> Kalori</span>
                                <span class="font-bold">{{ $paketOption->category->range_kalori }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span><i class="fas fa-dumbbell mr-1 text-green-600"></i> Protein</span>
                                <span class="font-bold">{{ $paketOption->category->level_protein }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between text-sm">
                        <span>Harga Paket</span>
                        <span>Rp {{ number_format($paketOption->harga, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span>Ongkir</span>
                        <span class="text-green-600 font-bold">Gratis</span>
                    </div>

                    <div class="border-t border-gray-200 pt-4 flex justify-between items-center mt-2">
                        <span class="font-bold text-gray-800 text-lg">Total Bayar</span>
                        <span class="font-extrabold text-[#1F5A34] text-xl">Rp
                            {{ number_format($paketOption->harga, 0, ',', '.') }}</span>
                    </div>
                </div>

                <button id="btnNextDesktop" type="button"
                    class="hidden lg:block w-full mt-8 py-3.5 bg-yellow-400 hover:bg-yellow-600 text-black font-bold rounded-xl text-center transition shadow-md hover:shadow-lg flex justify-center items-center gap-2 disabled:opacity-60 disabled:cursor-not-allowed">
                    Lanjut Pembayaran <i class="fas fa-arrow-right text-xs"></i>
                </button>

                <div class="mt-4 flex items-center justify-center gap-2 text-xs text-gray-400">
                    <i class="fas fa-lock"></i> Pembayaran aman & terenkripsi
                </div>
            </div>
        </div>
    </section>

    <div class="pointer-events-none fixed bottom-0 left-0 w-full h-full overflow-hidden z-0">
        <div class="absolute bottom-0 left-0 w-[220px] h-[220px] opacity-40 bg-no-repeat bg-contain"
            style="background-image:url('/asset/doodle-left.png');"></div>
        <div class="absolute bottom-0 left-0 w-[380px] h-[380px] opacity-40 bg-no-repeat bg-contain"
            style="background-image:url('/asset/kiri bawah.png'); background-position: bottom left; transform: translate(-10px, 10px);"></div>
        <div class="absolute bottom-[-50px] right-[-50px] w-[380px] h-[380px] opacity-40 bg-no-repeat bg-contain"
            style="background-image:url('/asset/kanan bawah.png');"></div>
    </div>

    <script>
        const form = document.getElementById('orderForm');
        const btnDesktop = document.getElementById('btnNextDesktop');
        const btnMobile = document.getElementById('btnNextMobile');
        const formAlert = document.getElementById('formAlert');

        const fields = {
            nama: document.getElementById('nama'),
            whatsapp: document.getElementById('whatsapp'),
            start_date: document.getElementById('start_date'),
            alamat: document.getElementById('alamat'),
            food_preference: () => document.querySelector('input[name="food_preference"]:checked')
        };

        // set min date = today
        (function setMinDate() {
            const today = new Date();
            const yyyy = today.getFullYear();
            const mm = String(today.getMonth() + 1).padStart(2, '0');
            const dd = String(today.getDate()).padStart(2, '0');
            const min = `${yyyy}-${mm}-${dd}`;
            fields.start_date.min = min;
        })();

        function showErr(id, show) {
            const el = document.getElementById(id);
            if (!el) return;
            el.classList.toggle('hidden', !show);
        }

        function markFieldInvalid(input, invalid) {
            if (!input) return;
            input.classList.toggle('border-red-400', invalid);
            input.classList.toggle('ring-2', invalid);
            input.classList.toggle('ring-red-200', invalid);
        }

        function validateNama() {
            const v = (fields.nama.value || '').trim();
            const invalid = v.length < 3;
            showErr('err-nama', invalid);
            markFieldInvalid(fields.nama, invalid);
            return !invalid;
        }

        function validateWA() {
            const v = (fields.whatsapp.value || '').trim();
            const digits = v.replace(/\D/g, '');
            const invalid = digits.length < 10;
            showErr('err-whatsapp', invalid);
            markFieldInvalid(fields.whatsapp, invalid);
            return !invalid;
        }

        function validateStartDate() {
            const v = fields.start_date.value;
            const invalid = !v;
            showErr('err-start_date', invalid);
            markFieldInvalid(fields.start_date, invalid);
            return !invalid;
        }

        function validateAlamat() {
            const v = (fields.alamat.value || '').trim();
            const invalid = v.length < 10;
            showErr('err-alamat', invalid);
            markFieldInvalid(fields.alamat, invalid);
            return !invalid;
        }

        function validatePreference() {
            const ok = !!fields.food_preference();
            showErr('err-food_preference', !ok);
            return ok;
        }

        function validateAll(showGlobalAlert = false) {
            const ok =
                validateNama() &
                validateWA() &
                validateStartDate() &
                validatePreference() &
                validateAlamat();

            if (btnDesktop) btnDesktop.disabled = !ok;
            if (btnMobile) btnMobile.disabled = !ok;

            if (showGlobalAlert) {
                formAlert.classList.toggle('hidden', !!ok);
            } else {
                // jangan ganggu user saat mengetik
                if (ok) formAlert.classList.add('hidden');
            }

            return !!ok;
        }

        // realtime validation
        fields.nama.addEventListener('input', () => validateAll(false));
        fields.whatsapp.addEventListener('input', () => validateAll(false));
        fields.start_date.addEventListener('change', () => validateAll(false));
        fields.alamat.addEventListener('input', () => validateAll(false));
        document.querySelectorAll('input[name="food_preference"]').forEach(r => {
            r.addEventListener('change', () => validateAll(false));
        });

        // desktop button -> submit form
        if (btnDesktop) {
            btnDesktop.addEventListener('click', () => {
                const ok = validateAll(true);
                if (!ok) {
                    // scroll ke field error pertama
                    const firstErr = document.querySelector('#orderForm .border-red-400, #orderForm [aria-invalid="true"]');
                    if (firstErr) firstErr.scrollIntoView({behavior: 'smooth', block: 'center'});
                    return;
                }
                form.submit();
            });
        }

        // prevent submit jika belum valid (mobile submit button / enter)
        form.addEventListener('submit', (e) => {
            const ok = validateAll(true);
            if (!ok) {
                e.preventDefault();
                const first = document.querySelector('#orderForm .border-red-400');
                if (first) first.scrollIntoView({behavior:'smooth', block:'center'});
            }
        });

        // initial state
        validateAll(false);
    </script>

</body>

</html>
