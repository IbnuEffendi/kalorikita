<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Paket Katering - Admin KaloriKita</title>

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

        /**
         * Data yang diharapkan dari controller:
         *
         * $package = [
         *   'id'          => 1,
         *   'name'        => 'Paket Maintain 7 Hari',
         *   'slug'        => 'maintain-7',
         *   'price'       => 300000,
         *   'days'        => 7,
         *   'status'      => 'active', // active / inactive
         *   'description' => 'Paket untuk menjaga berat badan...',
         *   'image_url'   => '...', // optional
         *   'calories'    => 1800,   // optional, target kalori per hari
         * ];
         *
         * $menus = [
         *   ['day' => 1, 'title' => 'Hari 1 - Siang', 'desc' => 'Nasi merah, ayam panggang, sayur...'],
         *   ...
         * ];
         */

        $package = [
            'id' => 1,
            'name' => 'Paket Contoh 7 Hari',
            'slug' => 'paket-contoh-7',
            'price' => 300000,
            'days' => 7,
            'status' => 'active',
            'description' => 'Ini adalah paket contoh untuk menjaga konsistensi desain halaman detail paket.',
            'image_url' => null,
            'calories' => 1800,
        ];

        // helper agar tidak error
        $id = 1;
        $name = $package['name'] ?? 'Tanpa Nama';
        $slug = $package['slug'] ?? '-';
        $price = $package['price'] ?? 0;
        $days = $package['days'] ?? 0;
        $description = $package['description'] ?? 'Tidak ada deskripsi.';
        $image_url = $package['image_url'] ?? null;
        $status = $package['status'] ?? 'inactive';

        $menus = $menus ?? [
            ['day' => 1, 'title' => 'Hari 1 - Siang', 'desc' => 'Nasi merah, telur dadar, tumis sayur hijau.'],
            ['day' => 2, 'title' => 'Hari 2 - Siang', 'desc' => 'Nasi putih, ayam panggang, lalapan dan buah.'],
        ];

        $status = $package['status'] ?? 'inactive';

        $statusColor =
            $status === 'active'
                ? 'bg-emerald-400/20 text-emerald-200 border-emerald-400/40'
                : 'bg-red-400/20 text-red-200 border-red-400/40';

    @endphp

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="flex flex-col lg:flex-row gap-6">

            {{-- SIDEBAR ADMIN --}}
            <aside class="w-full lg:w-64 bg-green-800/90 border border-green-700/70 rounded-3xl p-5 h-max">
                {{-- Profile --}}
                <div class="flex items-center gap-3 mb-6">
                    <div
                        class="w-10 h-10 rounded-2xl bg-yellow-400 text-green-900 flex items-center justify-center font-extrabold">
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
                        <button
                            class="w-full mt-3 px-3 py-2 rounded-xl bg-red-900/50 text-red-100 text-xs hover:bg-red-800/70">
                            Logout
                        </button>
                    </form>
                </nav>
            </aside>

            {{-- KONTEN UTAMA --}}
            <main class="flex-1 space-y-6">

                {{-- Header / breadcrumb --}}
                <section class="bg-green-800/90 border border-green-700/70 rounded-3xl p-6 shadow-xl">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <p class="text-[11px] text-green-100/70 mb-1">
                                <a href="{{ route('admin.paket.index') }}" class="hover:underline">Paket Katering</a>
                                <span class="mx-1">/</span>
                                <span class="text-green-100/50">Detail Paket</span>
                            </p>
                            <h1 class="text-xl sm:text-2xl font-semibold text-white">
                                {{ $name }}
                            </h1>
                            <p class="text-xs text-green-100/70 mt-1">
                                ID: {{ $id }} • Slug: {{ $slug }}
                            </p>
                        </div>

                        <div class="flex flex-wrap gap-2 justify-end">
                            <span
                                class="inline-flex px-3 py-1 rounded-full border text-[11px] font-semibold {{ $statusColor }}">
                                {{ $status === 'active' ? 'Aktif' : 'Tidak Aktif' }}
                            </span>


                            <a href="{{ route('admin.paket.edit', $package['id']) }}"
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 text-green-50 text-xs font-semibold border border-green-500/70 hover:bg-white/20">
                                Edit Paket
                            </a>

                            <a href="{{ route('admin.paket.index') }}"
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-green-900/80 text-green-50 text-xs font-semibold hover:bg-green-900">
                                ‹ Kembali
                            </a>
                        </div>
                    </div>
                </section>

                {{-- GRID: Info paket + menu harian --}}
                <section class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                    {{-- KIRI: Info paket --}}
                    <div class="lg:col-span-2 space-y-6">

                        {{-- Card utama paket --}}
                        <div class="bg-green-800/90 border border-green-700/70 rounded-3xl p-6 shadow-xl">
                            <div class="flex flex-col md:flex-row gap-5">

                                {{-- Gambar paket (optional) --}}
                                <div class="md:w-1/3">
                                    @if (!empty($package['image_url']))
                                        <div class="overflow-hidden rounded-2xl border border-green-700/70">
                                            <img src="{{ $package['image_url'] }}" alt="Gambar Paket"
                                                class="w-full h-40 object-cover">
                                        </div>
                                    @else
                                        <div
                                            class="w-full h-40 rounded-2xl border border-dashed border-green-600/70 flex items-center justify-center text-[11px] text-green-100/60">
                                            Tidak ada gambar paket.
                                        </div>
                                    @endif
                                </div>

                                {{-- Detail teks --}}
                                <div class="md:flex-1 space-y-3 text-xs text-green-100/85">
                                    <div>
                                        <p class="text-green-200/70 text-[11px]">Nama Paket</p>
                                        <p class="font-semibold text-white text-sm">
                                            {{ $name }}
                                        </p>
                                    </div>

                                    <div class="grid grid-cols-2 gap-3">
                                        <div>
                                            <p class="text-green-200/70 text-[11px]">Harga</p>
                                            <p class="font-semibold text-yellow-300">
                                                Rp {{ number_format($price, 0, ',', '.') }}
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-green-200/70 text-[11px]">Durasi Paket</p>
                                            <p class="font-semibold">
                                                {{ $days }} hari
                                            </p>
                                        </div>
                                    </div>

                                    @if (!empty($package['calories']))
                                        <div>
                                            <p class="text-green-200/70 text-[11px]">Perkiraan Kalori / Hari</p>
                                            <p class="font-semibold">
                                                ± {{ $package['calories'] }} kkal / hari
                                            </p>
                                        </div>
                                    @endif

                                    <div>
                                        <p class="text-green-200/70 text-[11px] mb-1">Deskripsi Paket</p>
                                        <p class="leading-relaxed whitespace-pre-line">
                                            {{ $package['description'] }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Info tambahan (optional) --}}
                        <div
                            class="bg-green-800/90 border border-green-700/70 rounded-3xl p-5 shadow-xl text-xs text-green-100/80">
                            <h2 class="text-sm font-semibold text-white mb-2">Catatan Admin (Opsional)</h2>
                            <p>
                                Di sini nantinya kamu bisa menampilkan informasi tambahan, misalnya:
                                <br>- Segmentasi paket (defisit / maintain / surplus)
                                <br>- Rekomendasi untuk tipe pengguna tertentu
                                <br>- Informasi stok atau jadwal produksi
                            </p>
                        </div>

                    </div>

                    {{-- KANAN: Menu harian --}}
                    <div class="space-y-4">
                        <div class="bg-green-800/90 border border-green-700/70 rounded-3xl p-5 shadow-xl">
                            <h2 class="text-sm font-semibold text-white mb-3">Rangkuman Paket</h2>

                            <ul class="text-xs text-green-100/85 space-y-2">
                                <li>• Durasi: {{ $package['days'] }} hari</li>
                                <li>• Estimasi total harga: Rp {{ number_format($package['price'], 0, ',', '.') }}</li>
                                @if (!empty($package['calories']))
                                    <li>• ± {{ $package['calories'] }} kkal / hari</li>
                                @endif
                                <li>• Status: {{ $status === 'active' ? 'Aktif' : 'Tidak Aktif' }}</li>

                            </ul>
                        </div>

                        <div class="bg-green-800/90 border border-green-700/70 rounded-3xl p-5 shadow-xl">
                            <div class="flex items-center justify-between mb-3">
                                <h2 class="text-sm font-semibold text-white">Menu Harian</h2>
                                <span class="text-[11px] text-green-100/70">
                                    {{ count($menus) }} menu contoh
                                </span>
                            </div>

                            @if (empty($menus))
                                <p class="text-xs text-green-100/70">
                                    Belum ada data menu harian untuk paket ini.
                                </p>
                            @else
                                <div class="space-y-3 max-h-72 overflow-y-auto scroll-thin">
                                    @foreach ($menus as $menu)
                                        <div class="bg-green-900/70 rounded-2xl px-3 py-2 text-xs text-green-100/85">
                                            <p class="font-semibold text-white">
                                                @if (!empty($menu['day']))
                                                    Hari {{ $menu['day'] }} – {{ $menu['title'] ?? 'Menu' }}
                                                @else
                                                    {{ $menu['title'] ?? 'Menu' }}
                                                @endif
                                            </p>
                                            @if (!empty($menu['desc']))
                                                <p class="text-[11px] text-green-100/70 mt-1">
                                                    {{ $menu['desc'] }}
                                                </p>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                </section>

            </main>

        </div>
    </div>

</body>

</html>
