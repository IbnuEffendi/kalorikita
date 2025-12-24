<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Batch - Admin KaloriKita</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    {{-- 1. LIBRARY TOM SELECT (Untuk Searchable Dropdown) --}}
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>

    <style>
        body {
            font-family: 'Instrument Sans', sans-serif;
        }

        .scroll-thin::-webkit-scrollbar {
            height: 6px;
            width: 6px;
        }

        .scroll-thin::-webkit-scrollbar-thumb {
            background-color: rgba(251, 191, 36, 0.5);
            border-radius: 999px;
        }

        /* Custom Arrow untuk Select Biasa (Paket) */
        select:not(.tomselected) {
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%23ffffff' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.5rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
        }

        input[type="date"]::-webkit-calendar-picker-indicator {
            filter: invert(1);
            cursor: pointer;
        }

        /* 2. CUSTOM CSS UNTUK TOM SELECT AGAR SESUAI TEMA HIJAU */
        .ts-control {
            background-color: rgba(20, 83, 45, 0.4) !important;
            /* Hijau Transparan */
            border: 1px solid rgba(22, 163, 74, 0.5) !important;
            color: white !important;
            border-radius: 0.75rem !important;
            /* rounded-xl */
            padding-top: 10px !important;
            padding-bottom: 10px !important;
            font-size: 0.75rem !important;
            /* text-xs */
        }

        /* Input teks saat mengetik */
        .ts-control input {
            color: white !important;
        }

        /* Dropdown List Wrapper */
        .ts-dropdown {
            background-color: #14532d !important;
            /* bg-green-900 */
            border: 1px solid rgba(22, 163, 74, 0.5) !important;
            color: white !important;
            border-radius: 0.75rem !important;
            overflow: hidden;
            margin-top: 4px;
        }

        /* Item di dalam dropdown */
        .ts-dropdown .option {
            padding: 8px 12px;
            cursor: pointer;
        }

        /* Hover & Active State */
        .ts-dropdown .active,
        .ts-dropdown .option:hover {
            background-color: #15803d !important;
            /* bg-green-700 */
            color: #facc15 !important;
            /* text-yellow-400 */
        }

        /* Menghilangkan panah default Tom Select agar bersih */
        .ts-control::after {
            border-color: #fff transparent transparent transparent !important;
        }

        /* Placeholder color */
        .ts-control .item {
            color: white;
        }
    </style>
</head>

<body class="bg-green-700/60 min-h-screen">

    <x-navbar></x-navbar>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="flex flex-col lg:flex-row gap-6">

            {{-- SIDEBAR --}}
            <aside
                class="w-full lg:w-64 bg-green-800/90 border border-green-700/70 rounded-3xl p-6 h-max flex-shrink-0 flex flex-col">
                <div class="flex items-center gap-3 mb-8">
                    <div
                        class="w-10 h-10 rounded-2xl bg-yellow-400 text-green-900 flex items-center justify-center font-extrabold shadow-md">
                        {{ strtoupper(mb_substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <div>
                        <p class="text-sm font-bold text-white">{{ auth()->user()->name }}</p>
                        <p class="text-[11px] text-green-200/80">Admin</p>
                    </div>
                </div>
                <nav class="space-y-1 flex-1">
                    <a href="{{ route('admin.dashboard') }}"
                        class="block px-4 py-3 rounded-xl text-sm font-medium text-green-100 hover:bg-green-700/50 transition">Dashboard</a>
                    <a href="{{ route('admin.orders.index') }}"
                        class="block px-4 py-3 rounded-xl text-sm font-medium text-green-100 hover:bg-green-700/50 transition">Kelola
                        Pesanan</a>
                    <a href="{{ route('admin.paket.index') }}"
                        class="block px-4 py-3 rounded-xl text-sm font-bold bg-white text-green-900 shadow-lg">Paket
                        Katering</a>
                    <a href="{{ route('admin.users.index') }}"
                        class="block px-4 py-3 rounded-xl text-sm font-medium text-green-100 hover:bg-green-700/50 transition">Data
                        Pengguna</a>
                    <a href="{{ route('admin.reports.index') }}"
                        class="block px-4 py-3 rounded-xl text-sm font-medium text-green-100 hover:bg-green-700/50 transition">Laporan</a>
                    <a href="{{ route('admin.ai.logs') }}"
                        class="block px-4 py-3 rounded-xl text-sm font-medium text-green-100 hover:bg-green-700/50 transition">Log
                        KaloriLab (AI)</a>
                </nav>
                <div class="mt-8 pt-6 border-t border-green-700/40">
                    <a href="{{ route('profil.dashboard') }}"
                        class="block text-xs text-green-200/70 hover:text-white mb-3 pl-1 transition">Masuk sebagai
                        Pengguna</a>
                    <form action="{{ route('logout') }}" method="POST">@csrf <button
                            class="w-full py-3 rounded-xl bg-[#4c4232] text-white/90 text-xs font-semibold hover:bg-[#3e3629] transition shadow-md">Logout</button>
                    </form>
                </div>
            </aside>

            {{-- KONTEN UTAMA --}}
            <main class="flex-1 space-y-6">

                {{-- HEADER + TABS --}}
                <section
                    class="bg-green-800/90 border border-green-700/70 rounded-3xl p-6 shadow-xl relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-6 opacity-10 pointer-events-none">
                        <i class="bi bi-calendar-week text-[8rem] text-white"></i>
                    </div>

                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 mb-6 relative z-10">
                        <div>
                            <h1 class="text-2xl font-bold text-white tracking-tight">Kelola Batch & Jadwal</h1>
                            <p class="text-xs text-green-200/80 mt-1">Atur menu makan siang & malam berdasarkan tanggal.
                            </p>
                        </div>
                        <a href="{{ route('admin.paket.index') }}"
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-green-900/50 text-green-100 text-[10px] font-semibold border border-green-600/50 hover:bg-green-900 hover:text-white transition">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                    </div>

                    {{-- TABS --}}
                    <div class="flex flex-wrap items-center gap-2 relative z-10 border-t border-green-700/50 pt-4">
                        <a href="{{ route('admin.paket.index') }}"
                            class="px-4 py-2 rounded-xl text-green-100 hover:bg-green-700/40 hover:text-white text-xs font-medium transition flex items-center gap-2">
                            <i class="bi bi-grid-fill"></i> Daftar Paket
                        </a>
                        <a href="{{ route('admin.paket.menus') }}"
                            class="px-4 py-2 rounded-xl text-green-100 hover:bg-green-700/40 hover:text-white text-xs font-medium transition flex items-center gap-2">
                            <i class="bi bi-egg-fried"></i> Kelola Menu
                        </a>
                        <a href="{{ route('admin.paket.schedules') }}"
                            class="px-4 py-2 rounded-xl bg-white text-green-900 text-xs font-bold shadow-md flex items-center gap-2">
                            <i class="bi bi-calendar-week"></i> Kelola Batch
                        </a>
                    </div>
                </section>

                <section class="grid grid-cols-1 xl:grid-cols-3 gap-6">


                    {{-- FORM INPUT JADWAL --}}
                    <div class="xl:col-span-1">
                        <div class="bg-green-800/90 border border-green-700/70 rounded-3xl p-6 shadow-lg sticky top-6">
                            <h3 class="font-bold text-white mb-5 flex items-center gap-2 text-sm">
                                <i class="bi bi-plus-circle-fill text-yellow-400"></i> Buat Jadwal Baru
                            </h3>
                            <button type="button" id="btn-open-ai-schedule"
                                class="w-full bg-white/10 hover:bg-white/20 text-green-50 font-bold py-2.5 rounded-xl transition shadow-lg flex justify-center items-center gap-2 text-xs border border-green-500/40 mb-3">
                                <i class="bi bi-stars text-yellow-300"></i> Generate Schedule dengan AI
                            </button>


                            @if (session('success'))
                                <div
                                    class="bg-emerald-500/20 border border-emerald-500/50 text-emerald-100 p-3 rounded-xl text-[10px] mb-4 flex items-center gap-2">
                                    <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                                </div>
                            @endif
                            @if (session('error'))
                                <div
                                    class="bg-red-500/20 border border-red-500/50 text-red-100 p-3 rounded-xl text-[10px] mb-4 flex items-center gap-2">
                                    <i class="bi bi-exclamation-circle-fill"></i> {{ session('error') }}
                                </div>
                            @endif

                            <form action="{{ route('admin.paket.schedules.store') }}" method="POST" class="space-y-4">
                                @csrf
                                <div>
                                    <label class="block text-[10px] font-bold text-green-300 uppercase mb-1">Pilih
                                        Paket</label>
                                    <select name="paket_category_id" required
                                        class="w-full bg-green-900/40 border border-green-600/50 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-yellow-400 cursor-pointer">
                                        <option value="" class="bg-green-900">-- Pilih Paket --</option>
                                        @foreach ($packets as $p)
                                            <option value="{{ $p->id }}" class="bg-green-900">
                                                {{ $p->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label
                                        class="block text-[10px] font-bold text-green-300 uppercase mb-1">Tanggal</label>
                                    <input type="date" name="schedule_date" required
                                        class="w-full bg-green-900/40 border border-green-600/50 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-yellow-400 cursor-pointer">
                                </div>

                                {{-- MENU SIANG (SEARCHABLE) --}}
                                <div>
                                    <label class="block text-[10px] font-bold text-green-300 uppercase mb-1">Menu
                                        Siang</label>
                                    <select id="select-lunch" name="lunch_menu_id" required
                                        placeholder="Cari Menu Siang..." autocomplete="off">
                                        <option value="">Cari Menu Siang...</option>
                                        @foreach ($menus as $m)
                                            <option value="{{ $m->id }}">{{ $m->nama_menu }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- MENU MALAM (SEARCHABLE) --}}
                                <div>
                                    <label class="block text-[10px] font-bold text-green-300 uppercase mb-1">Menu
                                        Malam</label>
                                    <select id="select-dinner" name="dinner_menu_id" required
                                        placeholder="Cari Menu Malam..." autocomplete="off">
                                        <option value="">Cari Menu Malam...</option>
                                        @foreach ($menus as $m)
                                            <option value="{{ $m->id }}">{{ $m->nama_menu }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <button type="submit"
                                    class="w-full bg-yellow-400 hover:bg-yellow-300 text-green-900 font-bold py-2.5 rounded-xl transition shadow-lg flex justify-center items-center gap-2 mt-2 text-xs">
                                    <i class="bi bi-save"></i> Simpan ke Batch
                                </button>
                            </form>
                        </div>
                    </div>

                    {{-- TABEL RIWAYAT JADWAL --}}
                    <div class="xl:col-span-2">
                        <div
                            class="bg-green-800/90 border border-green-700/70 rounded-3xl shadow-lg overflow-hidden min-h-[500px] flex flex-col">
                            <div
                                class="px-6 py-4 border-b border-green-700/50 bg-green-900/30 flex justify-between items-center">
                                <h3 class="font-bold text-white text-sm">Jadwal Terdaftar</h3>
                                <span
                                    class="bg-green-900 border border-green-600/50 text-green-100 text-[10px] px-2 py-1 rounded-lg font-bold">
                                    Total: {{ $schedules->count() }}
                                </span>
                            </div>

                            <div class="overflow-x-auto flex-1 scroll-thin">
                                <table class="w-full text-left text-xs text-green-100">
                                    <thead
                                        class="bg-green-900/50 text-green-300 uppercase font-bold text-[10px] tracking-wider border-b border-green-700/50">
                                        <tr>
                                            <th class="px-6 py-3">Tanggal</th>
                                            <th class="px-6 py-3">Paket</th>
                                            <th class="px-6 py-3">Siang</th>
                                            <th class="px-6 py-3">Malam</th>
                                            <th class="px-6 py-3 text-right">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-green-700/30">
                                        @forelse($schedules as $s)
                                            <tr class="hover:bg-green-900/20 transition duration-150 group">
                                                <td class="px-6 py-4 font-bold text-white whitespace-nowrap">
                                                    {{ \Carbon\Carbon::parse($s->schedule_date)->translatedFormat('d M Y') }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    <span
                                                        class="inline-block bg-yellow-400/10 border border-yellow-400/30 text-yellow-200 text-[10px] px-2 py-0.5 rounded-md font-bold uppercase tracking-wide">
                                                        {{ $s->paketCategory->nama_kategori ?? '-' }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="flex items-center gap-2">
                                                        <i class="bi bi-sun text-orange-400"></i>
                                                        <span
                                                            class="truncate max-w-[120px]">{{ $s->lunchMenu->nama_menu ?? '-' }}</span>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="flex items-center gap-2">
                                                        <i class="bi bi-moon-stars text-indigo-300"></i>
                                                        <span
                                                            class="truncate max-w-[120px]">{{ $s->dinnerMenu->nama_menu ?? '-' }}</span>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 text-right">
                                                    <div class="flex items-center justify-end gap-2">
                                                        <a href="{{ route('admin.paket.schedules.edit', $s->id) }}"
                                                            class="text-blue-300 hover:text-blue-100 transition p-1"
                                                            title="Edit">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </a>
                                                        <button type="button"
                                                            onclick="openDeleteModal('{{ route('admin.paket.schedules.destroy', $s->id) }}', '{{ \Carbon\Carbon::parse($s->schedule_date)->translatedFormat('d M Y') }}', '{{ $s->paketCategory->nama_kategori }}')"
                                                            class="text-red-300 hover:text-red-100 transition p-1"
                                                            title="Hapus">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="px-6 py-12 text-center text-green-200/40">
                                                    <i class="bi bi-calendar-x text-3xl mb-2 opacity-50 block"></i>
                                                    <span class="text-xs">Belum ada jadwal batch dibuat.</span>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </section>

            </main>

        </div>
    </div>

    {{-- MODAL DELETE --}}
    <div id="delete-modal"
        class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4">
        <div
            class="bg-[#1a412b] border border-green-800 rounded-3xl p-6 w-full max-w-sm shadow-2xl relative text-center">
            <h3 class="text-lg font-bold text-white mb-2">Hapus Jadwal?</h3>
            <p class="text-green-200/70 text-xs mb-6 leading-relaxed">
                Jadwal untuk paket <span id="del-paket" class="font-bold text-yellow-300"></span>
                pada tanggal <span id="del-date" class="font-bold text-white"></span>
                akan dihapus permanen.
            </p>
            <div class="flex items-center justify-center gap-3">
                <button type="button" onclick="closeDeleteModal()"
                    class="px-6 py-2 rounded-xl bg-green-800 text-green-100 text-xs font-bold hover:bg-green-700 transition">Batal</button>
                <form id="delete-form" method="POST" action="">
                    @csrf @method('DELETE')
                    <button type="submit"
                        class="px-6 py-2 rounded-xl bg-red-600 text-white text-xs font-bold hover:bg-red-500 transition shadow-lg">Hapus</button>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal AI --}}
    <div id="modal-ai-schedule"
        class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4">
        <div class="bg-[#1a412b] border border-green-800 rounded-3xl p-6 w-full max-w-lg shadow-2xl relative">
            <button type="button" id="btn-close-ai-schedule"
                class="absolute top-4 right-4 text-yellow-300 font-bold">✕</button>

            <h3 class="text-lg font-bold text-white mb-1">Generate Jadwal dengan AI</h3>
            <p class="text-xs text-green-200/70 mb-5">AI akan menyusun jadwal menggunakan menu yang sudah ada di
                database.</p>

            <div class="space-y-3 text-xs">
                <div>
                    <label class="block text-[10px] font-bold text-green-300 uppercase mb-1">Pilih Paket</label>
                    <select id="ai-paket"
                        class="w-full bg-green-900/40 border border-green-600/50 rounded-xl px-4 py-2.5 text-xs text-white">
                        <option value="">-- Pilih Paket --</option>
                        @foreach ($packets as $p)
                            <option value="{{ $p->id }}">{{ $p->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-green-300 uppercase mb-1">Kategori Goal</label>
                    <select id="ai-goal"
                        class="w-full bg-green-900/40 border border-green-600/50 rounded-xl px-4 py-2.5 text-xs text-white">
                        <option value="maintain">Maintain</option>
                        <option value="diet">Diet</option>
                        <option value="bulking">Bulking</option>
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[10px] font-bold text-green-300 uppercase mb-1">Start Date</label>
                        <input id="ai-start" type="date"
                            class="w-full bg-green-900/40 border border-green-600/50 rounded-xl px-4 py-2.5 text-xs text-white">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-green-300 uppercase mb-1">End Date</label>
                        <input id="ai-end" type="date"
                            class="w-full bg-green-900/40 border border-green-600/50 rounded-xl px-4 py-2.5 text-xs text-white">
                    </div>
                </div>

                <div id="ai-error"
                    class="hidden bg-red-500/20 border border-red-500/40 text-red-100 p-3 rounded-xl text-[10px]">
                </div>

                <button type="button" id="btn-generate-ai"
                    class="w-full bg-yellow-400 hover:bg-yellow-300 text-green-900 font-bold py-2.5 rounded-xl transition shadow-lg flex justify-center items-center gap-2 text-xs mt-2">
                    <i class="bi bi-magic"></i> Generate Preview
                </button>

                <p class="text-[10px] text-green-200/60 mt-2">
                    Catatan: Jadwal akan dibuat sebagai preview dulu, kamu bisa cek sebelum disimpan.
                </p>
            </div>
        </div>
    </div>

    {{-- Modal COnfirm AI --}}
    <div id="modal-ai-confirm"
        class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4">
        <div class="bg-[#1a412b] border border-green-800 rounded-3xl p-6 w-full max-w-4xl shadow-2xl relative">
            <button type="button" id="btn-close-ai-confirm"
                class="absolute top-4 right-4 text-yellow-300 font-bold">✕</button>

            <h3 class="text-lg font-bold text-white mb-1">Konfirmasi Jadwal AI</h3>
            <p class="text-xs text-green-200/70 mb-4">Cek hasil generate. Jika sudah cocok, klik “Simpan Batch”.</p>

            <div class="overflow-x-auto scroll-thin bg-green-900/30 rounded-2xl border border-green-700/40">
                <table class="w-full text-left text-xs text-green-100">
                    <thead
                        class="bg-green-900/50 text-green-300 uppercase font-bold text-[10px] tracking-wider border-b border-green-700/50">
                        <tr>
                            <th class="px-4 py-3">Tanggal</th>
                            <th class="px-4 py-3">Siang</th>
                            <th class="px-4 py-3">Malam</th>
                            <th class="px-4 py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody id="ai-preview-body" class="divide-y divide-green-700/30"></tbody>
                </table>
            </div>

            <div id="ai-confirm-error"
                class="hidden mt-3 bg-red-500/20 border border-red-500/40 text-red-100 p-3 rounded-xl text-[10px]">
            </div>

            <div class="mt-5 flex items-center justify-end gap-3">
                <button type="button" id="btn-back-ai"
                    class="px-5 py-2 rounded-xl bg-green-800 text-green-100 text-xs font-bold hover:bg-green-700 transition">
                    Kembali
                </button>
                <button type="button" id="btn-save-ai"
                    class="px-5 py-2 rounded-xl bg-yellow-400 text-green-900 text-xs font-bold hover:bg-yellow-300 transition shadow-lg">
                    Simpan Batch
                </button>
            </div>
        </div>
    </div>

    <script>
        // ====== ELEMEN ======
        const modalAi = document.getElementById('modal-ai-schedule');
        const modalConfirm = document.getElementById('modal-ai-confirm');

        const btnOpenAi = document.getElementById('btn-open-ai-schedule');
        const btnCloseAi = document.getElementById('btn-close-ai-schedule');
        const btnGenerate = document.getElementById('btn-generate-ai');

        const btnCloseConfirm = document.getElementById('btn-close-ai-confirm');
        const btnBackAi = document.getElementById('btn-back-ai');
        const btnSaveAi = document.getElementById('btn-save-ai');

        const elErr = document.getElementById('ai-error');
        const elConfirmErr = document.getElementById('ai-confirm-error');

        const paketEl = document.getElementById('ai-paket');
        const goalEl = document.getElementById('ai-goal');
        const startEl = document.getElementById('ai-start');
        const endEl = document.getElementById('ai-end');

        const previewBody = document.getElementById('ai-preview-body');

        // ====== STATE ======
        let aiPreviewItems = [];
        let aiPreviewPaketId = null;
        let aiPreviewMenuMap = {};

        // ====== UTIL ======
        function show(el) {
            el?.classList.remove('hidden');
        }

        function hide(el) {
            el?.classList.add('hidden');
        }

        function setError(el, msg) {
            if (!el) return;
            if (!msg) {
                el.innerText = '';
                hide(el);
                return;
            }
            el.innerText = msg;
            show(el);
        }

        function normalizeMenuMap(menuMap) {
            // pastikan key string biar aman saat akses
            const out = {};
            if (!menuMap || typeof menuMap !== 'object') return out;
            for (const [k, v] of Object.entries(menuMap)) out[String(k)] = v;
            return out;
        }

        function renderPreview(items, menuMap) {
            previewBody.innerHTML = '';

            items.forEach(row => {
                const lunch = menuMap[String(row.lunch_menu_id)]?.name ?? ('#' + row.lunch_menu_id);
                const dinner = menuMap[String(row.dinner_menu_id)]?.name ?? ('#' + row.dinner_menu_id);

                const badge = row.overwrite ?
                    `<span class="inline-block bg-red-500/20 border border-red-500/40 text-red-100 text-[10px] px-2 py-0.5 rounded-md font-bold">Overwrite</span>` :
                    `<span class="inline-block bg-emerald-500/20 border border-emerald-500/40 text-emerald-100 text-[10px] px-2 py-0.5 rounded-md font-bold">New</span>`;

                const tr = document.createElement('tr');
                tr.className = 'hover:bg-green-900/20 transition';
                tr.innerHTML = `
        <td class="px-4 py-3 font-bold text-white whitespace-nowrap">${row.date}</td>
        <td class="px-4 py-3">${lunch}</td>
        <td class="px-4 py-3">${dinner}</td>
        <td class="px-4 py-3">${badge}</td>
      `;
                previewBody.appendChild(tr);
            });
        }

        // ====== OPEN/CLOSE MODAL ======
        btnOpenAi.onclick = () => {
            setError(elErr, null);
            show(modalAi);
        };
        btnCloseAi.onclick = () => hide(modalAi);
        modalAi.onclick = (e) => {
            if (e.target === modalAi) hide(modalAi);
        };

        btnCloseConfirm.onclick = () => hide(modalConfirm);
        modalConfirm.onclick = (e) => {
            if (e.target === modalConfirm) hide(modalConfirm);
        };

        btnBackAi.onclick = () => {
            hide(modalConfirm);
            show(modalAi);
        };

        // ====== GENERATE ======
        btnGenerate.onclick = async () => {
            setError(elErr, null);

            const paket = paketEl.value?.trim();
            const goal = goalEl.value?.trim();
            const start = startEl.value;
            const end = endEl.value;

            if (!paket || !start || !end) {
                setError(elErr, 'Paket, start date, dan end date wajib diisi.');
                return;
            }

            if (start > end) {
                setError(elErr, 'Start date tidak boleh lebih besar dari end date.');
                return;
            }

            const oldHtml = btnGenerate.innerHTML;
            btnGenerate.disabled = true;
            btnGenerate.innerHTML = `<i class="bi bi-hourglass-split"></i> Generating...`;

            try {
                const res = await fetch(`{{ route('admin.paket.schedules.ai.generate') }}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': `{{ csrf_token() }}`
                    },
                    body: JSON.stringify({
                        paket_category_id: paket,
                        goal,
                        start_date: start,
                        end_date: end
                    })
                });

                // kalau server ngirim HTML, ini bakal bantu deteksi
                const contentType = res.headers.get('content-type') || '';
                if (!contentType.includes('application/json')) {
                    const text = await res.text();
                    console.error('Non-JSON response:', text);
                    setError(elErr, 'Server tidak mengembalikan JSON (cek route/middleware/redirect).');
                    return;
                }

                const json = await res.json();
                console.log('AI response:', json);

                if (!res.ok || json.ok === false) {
                    setError(elErr, json.error || 'Gagal generate jadwal.');
                    return;
                }

                let items = json?.result ?? json?.data?.result ?? [];

                if (typeof items === 'string') {
                    try {
                        items = JSON.parse(items);
                    } catch (e) {
                        items = [];
                    }
                }

                aiPreviewItems = Array.isArray(items) ? items : [];

                // biar bisa kamu cek dari console tanpa scope issue
                window.aiPreviewItems = aiPreviewItems;

                console.log('LEN FINAL:', aiPreviewItems.length, aiPreviewItems);

                aiPreviewPaketId = paket;
                aiPreviewMenuMap = normalizeMenuMap(json.menuMap);

                console.log('LEN FINAL:', aiPreviewItems.length);

                if (aiPreviewItems.length === 0) {
                    setError(elErr, 'AI tidak menghasilkan jadwal.');
                    return;
                }

                renderPreview(aiPreviewItems, aiPreviewMenuMap);
                hide(modalAi);
                show(modalConfirm);

            } catch (err) {
                console.error(err);
                setError(elErr, 'Terjadi error jaringan / server.');
            } finally {
                btnGenerate.disabled = false;
                btnGenerate.innerHTML = oldHtml;
            }
        };

        // ====== SAVE / CONFIRM ======
        btnSaveAi.onclick = async () => {
            setError(elConfirmErr, null);

            if (!aiPreviewPaketId || aiPreviewItems.length === 0) {
                setError(elConfirmErr, 'Data preview kosong.');
                return;
            }

            const oldText = btnSaveAi.innerText;
            btnSaveAi.disabled = true;
            btnSaveAi.innerText = 'Menyimpan...';

            try {
                const res = await fetch(`{{ route('admin.paket.schedules.ai.confirm') }}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': `{{ csrf_token() }}`
                    },
                    body: JSON.stringify({
                        paket_category_id: aiPreviewPaketId,
                        items: aiPreviewItems
                    })
                });

                const contentType = res.headers.get('content-type') || '';
                if (!contentType.includes('application/json')) {
                    const text = await res.text();
                    console.error('Non-JSON response:', text);
                    setError(elConfirmErr, 'Server tidak mengembalikan JSON saat simpan (cek route/middleware).');
                    return;
                }

                const json = await res.json();
                console.log('Save response:', json);

                if (!res.ok || json.ok === false || json.success === false) {
                    setError(elConfirmErr, json.error || 'Gagal menyimpan batch.');
                    return;
                }

                window.location.reload();

            } catch (err) {
                console.error(err);
                setError(elConfirmErr, 'Terjadi error jaringan / server.');
            } finally {
                btnSaveAi.disabled = false;
                btnSaveAi.innerText = oldText;
            }
        };
    </script>




    {{-- Script Modal Delete & Tom Select --}}
    <script>
        // 3. INISIALISASI TOM SELECT UNTUK PENCARIAN
        document.addEventListener('DOMContentLoaded', function() {
            var settings = {
                create: false,
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            };

            // Aktifkan pada Menu Siang
            new TomSelect('#select-lunch', settings);

            // Aktifkan pada Menu Malam
            new TomSelect('#select-dinner', settings);
        });

        function openDeleteModal(actionUrl, dateStr, paketName) {
            const modal = document.getElementById('delete-modal');
            const form = document.getElementById('delete-form');
            const dateSpan = document.getElementById('del-date');
            const paketSpan = document.getElementById('del-paket');

            form.action = actionUrl;
            dateSpan.innerText = dateStr;
            paketSpan.innerText = paketName;
            modal.classList.remove('hidden');
        }

        function closeDeleteModal() {
            const modal = document.getElementById('delete-modal');
            modal.classList.add('hidden');
        }
    </script>

</body>

</html>
