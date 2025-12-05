<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Paket Katering - Admin KaloriKita</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

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
    </style>
</head>

<body class="bg-green-700/60">

    {{-- NAVBAR --}}
    <x-navbar></x-navbar>

    @php
        $user = auth()->user();
    @endphp

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="flex flex-col lg:flex-row gap-6">

            {{-- SIDEBAR ADMIN --}}
            <aside class="w-full lg:w-64 bg-green-800/90 border border-green-700/70 rounded-3xl p-5 h-max">

                {{-- Profile --}}
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-2xl bg-yellow-400 text-green-900 flex items-center justify-center font-extrabold">
                        {{ strtoupper(mb_substr($user->name ?? 'A', 0, 1)) }}
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-white">{{ $user->name }}</p>
                        <p class="text-[11px] text-green-100/70">Admin</p>
                    </div>
                </div>

                {{-- Menu --}}
                <nav class="space-y-2 text-sm">

                    <a href="{{ route('admin.dashboard') }}"
                       class="flex items-center justify-between px-3 py-2 rounded-xl 
                       {{ request()->routeIs('admin.dashboard') ? 'bg-white text-green-900 font-semibold' : 'text-green-100 hover:bg-green-700/70' }}">
                        Dashboard
                    </a>

                    <a href="{{ route('admin.orders.index') }}"
                       class="flex items-center justify-between px-3 py-2 rounded-xl 
                       {{ request()->routeIs('admin.orders.*') ? 'bg-white text-green-900 font-semibold' : 'text-green-100 hover:bg-green-700/70' }}">
                        Kelola Pesanan
                    </a>

                    <a href="{{ route('admin.paket.index') }}"
                       class="flex items-center justify-between px-3 py-2 rounded-xl 
                       {{ request()->routeIs('admin.paket.*') ? 'bg-white text-green-900 font-semibold' : 'text-green-100 hover:bg-green-700/70' }}">
                        Paket Katering
                    </a>

                    <a href="{{ route('admin.users.index') }}"
                       class="flex items-center justify-between px-3 py-2 rounded-xl 
                       {{ request()->routeIs('admin.users.*') ? 'bg-white text-green-900 font-semibold' : 'text-green-100 hover:bg-green-700/70' }}">
                        Data Pengguna
                    </a>

                    <a href="{{ route('admin.reports.index') }}"
                       class="flex items-center justify-between px-3 py-2 rounded-xl 
                       {{ request()->routeIs('admin.reports.*') ? 'bg-white text-green-900 font-semibold' : 'text-green-100 hover:bg-green-700/70' }}">
                        Laporan
                    </a>

                    <a href="{{ route('admin.ai.logs') }}"
                       class="flex items-center justify-between px-3 py-2 rounded-xl 
                       {{ request()->routeIs('admin.ai.*') ? 'bg-white text-green-900 font-semibold' : 'text-green-100 hover:bg-green-700/70' }}">
                        Log KaloriLab (AI)
                    </a>

                    <div class="border-t border-green-700/60 my-3"></div>

                    <a href="{{ route('profil.dashboard') }}"
                       class="flex items-center justify-between px-3 py-2 rounded-xl text-[11px] text-green-100 hover:bg-green-700/70">
                       Masuk sebagai Pengguna
                    </a>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="w-full mt-3 px-3 py-2 rounded-xl bg-red-900/50 text-red-100 text-xs hover:bg-red-800/70">
                            Logout
                        </button>
                    </form>

                </nav>
            </aside>

            {{-- KONTEN UTAMA --}}
            <main class="flex-1 space-y-6">

                {{-- Header --}}
                <section class="bg-green-800/90 border border-green-700/70 rounded-3xl p-6 shadow-xl">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <h1 class="text-xl sm:text-2xl font-semibold text-white">Buat Paket Katering Baru</h1>
                            <p class="text-xs text-green-100/70 mt-1">Tambahkan paket katering untuk pelanggan KaloriKita.</p>
                        </div>

                        <a href="{{ route('admin.paket.index') }}"
                           class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-green-900/80 text-green-50 text-xs font-semibold hover:bg-green-900 transition">
                            ‹ Kembali
                        </a>
                    </div>
                </section>

                {{-- FORM CREATE --}}
                <section class="bg-green-800/90 border border-green-700/70 rounded-3xl p-6 shadow-xl">

                    <form action="#" method="POST" enctype="multipart/form-data" class="space-y-5">
                        @csrf

                        {{-- Nama Paket --}}
                        <div>
                            <label class="text-xs text-green-100/80 mb-1 block">Nama Paket *</label>
                            <input type="text" required placeholder="Contoh: Paket Maintain 7 Hari"
                                class="w-full rounded-2xl bg-green-900/60 border border-green-600/60 text-green-50 px-4 py-2 text-xs placeholder:text-green-200/40 focus:ring-1 focus:ring-yellow-300 outline-none">
                        </div>

                        {{-- Slug --}}
                        <div>
                            <label class="text-xs text-green-100/80 mb-1 block">Slug (URL)</label>
                            <input type="text" placeholder="contoh: maintain-7"
                                class="w-full rounded-2xl bg-green-900/60 border border-green-600/60 text-green-50 px-4 py-2 text-xs placeholder:text-green-200/40 focus:ring-1 focus:ring-yellow-300 outline-none">
                        </div>

                        {{-- Deskripsi --}}
                        <div>
                            <label class="text-xs text-green-100/80 mb-1 block">Deskripsi</label>
                            <textarea rows="4" placeholder="Deskripsi paket katering..."
                                class="w-full rounded-2xl bg-green-900/60 border border-green-600/60 text-green-50 px-4 py-2 text-xs placeholder:text-green-200/40 focus:ring-1 focus:ring-yellow-300 outline-none"></textarea>
                        </div>

                        {{-- Harga --}}
                        <div>
                            <label class="text-xs text-green-100/80 mb-1 block">Harga (Rp) *</label>
                            <input type="number" required placeholder="contoh: 300000"
                                class="w-full rounded-2xl bg-green-900/60 border border-green-600/60 text-green-50 px-4 py-2 text-xs focus:ring-1 focus:ring-yellow-300 outline-none">
                        </div>

                        {{-- Jumlah Hari --}}
                        <div>
                            <label class="text-xs text-green-100/80 mb-1 block">Durasi Paket (Hari) *</label>
                            <input type="number" required placeholder="contoh: 7"
                                class="w-full rounded-2xl bg-green-900/60 border border-green-600/60 text-green-50 px-4 py-2 text-xs focus:ring-1 focus:ring-yellow-300 outline-none">
                        </div>

                        {{-- Status --}}
                        <div>
                            <label class="text-xs text-green-100/80 mb-1 block">Status *</label>
                            <select
                                class="w-full rounded-2xl bg-green-900/60 border border-green-600/60 text-green-50 px-4 py-2 text-xs focus:ring-1 focus:ring-yellow-300 outline-none">
                                <option value="active">Aktif</option>
                                <option value="inactive">Tidak Aktif</option>
                            </select>
                        </div>

                        {{-- Upload Gambar --}}
                        <div>
                            <label class="text-xs text-green-100/80 mb-1 block">Gambar Paket</label>
                            <input type="file"
                                class="w-full text-xs text-green-100 file:bg-yellow-400 file:text-green-900 file:px-3 file:py-1 file:rounded-lg cursor-pointer">
                        </div>

                        {{-- Tombol --}}
                        <div class="flex justify-end gap-3 pt-4">
                            <a href="{{ route('admin.paket.index') }}"
                               class="px-5 py-2 text-xs rounded-full bg-green-900 text-green-200 hover:bg-green-800 transition">
                                Batal
                            </a>

                            <button type="submit"
                                class="px-5 py-2 text-xs rounded-full bg-yellow-400 text-green-900 font-semibold hover:bg-yellow-300 transition">
                                Simpan Paket
                            </button>
                        </div>

                    </form>

                </section>

            </main>

        </div>
    </div>

</body>

</html>
