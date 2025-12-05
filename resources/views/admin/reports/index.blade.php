<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan - Admin KaloriKita</title>

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
            background-color: rgba(251, 191, 36, 0.4);
            border-radius: 999px;
        }
    </style>
</head>

<body class="bg-green-700/60">

    {{-- NAVBAR --}}
    <x-navbar></x-navbar>

    @php
        $admin = auth()->user();

        // Dummy data sementara — nanti bisa diisi dari controller
        $summary = $summary ?? [
            'income'       => 3250000,
            'orders'       => 27,
            'best_package' => 'Paket Maintain 7 Hari',
            'new_users'    => 12,
        ];

        $monthly = $monthly ?? [
            ['date' => '01 Dec 2025', 'orders' => 3, 'income' => 300000],
            ['date' => '02 Dec 2025', 'orders' => 5, 'income' => 550000],
            ['date' => '03 Dec 2025', 'orders' => 2, 'income' => 200000],
            ['date' => '04 Dec 2025', 'orders' => 7, 'income' => 750000],
            ['date' => '05 Dec 2025', 'orders' => 10, 'income' => 1150000],
        ];
    @endphp

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="flex flex-col lg:flex-row gap-6">

            {{-- SIDEBAR ADMIN (SAMA SEPERTI HALAMAN LAIN) --}}
            <aside class="w-full lg:w-64 bg-green-800/90 border border-green-700/70 rounded-3xl p-5 h-max">

                {{-- Profil mini --}}
                <div class="flex items-center gap-3 mb-6">
                    <div
                        class="w-10 h-10 rounded-2xl bg-yellow-400 text-green-900 flex items-center justify-center font-extrabold">
                        {{ strtoupper(mb_substr($admin->name ?? 'A', 0, 1)) }}
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-white">{{ $admin->name ?? 'Admin KaloriKita' }}</p>
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

                {{-- HEADER --}}
                <section class="bg-green-800/90 border border-green-700/60 rounded-3xl p-6 shadow-xl">
                    <h1 class="text-xl sm:text-2xl font-semibold text-white">Laporan</h1>
                    <p class="text-xs text-green-100/70 mt-1">
                        Ringkasan dan statistik performa KaloriKita.
                    </p>
                </section>

                {{-- SUMMARY CARDS --}}
                <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

                    <div class="bg-green-800/90 border border-green-700/70 rounded-3xl p-5 shadow-xl">
                        <p class="text-xs text-green-200/70">Pemasukan Bulan Ini</p>
                        <p class="text-xl font-bold text-yellow-300 mt-1">
                            Rp {{ number_format($summary['income'], 0, ',', '.') }}
                        </p>
                    </div>

                    <div class="bg-green-800/90 border border-green-700/70 rounded-3xl p-5 shadow-xl">
                        <p class="text-xs text-green-200/70">Total Pesanan</p>
                        <p class="text-xl font-bold text-white mt-1">
                            {{ $summary['orders'] }}
                        </p>
                    </div>

                    <div class="bg-green-800/90 border border-green-700/70 rounded-3xl p-5 shadow-xl">
                        <p class="text-xs text-green-200/70">Paket Terlaris</p>
                        <p class="text-sm font-semibold text-green-100 mt-1">
                            {{ $summary['best_package'] }}
                        </p>
                    </div>

                    <div class="bg-green-800/90 border border-green-700/70 rounded-3xl p-5 shadow-xl">
                        <p class="text-xs text-green-200/70">Pengguna Baru Bulan Ini</p>
                        <p class="text-xl font-bold text-white mt-1">
                            +{{ $summary['new_users'] }}
                        </p>
                    </div>

                </section>

                {{-- GRAFIK (PLACEHOLDER) --}}
                <section class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                    <div class="bg-green-800/90 border border-green-700/70 rounded-3xl p-6 shadow-xl">
                        <h2 class="text-sm font-semibold text-white mb-3">Grafik Pendapatan</h2>
                        <div
                            class="w-full h-48 rounded-xl bg-green-900/50 border border-green-700/60 flex items-center justify-center text-green-200 text-xs">
                            Grafik bisa menggunakan Chart.js
                        </div>
                    </div>

                    <div class="bg-green-800/90 border border-green-700/70 rounded-3xl p-6 shadow-xl">
                        <h2 class="text-sm font-semibold text-white mb-3">Grafik Pesanan</h2>
                        <div
                            class="w-full h-48 rounded-xl bg-green-900/50 border border-green-700/60 flex items-center justify-center text-green-200 text-xs">
                            Grafik bisa menggunakan Chart.js
                        </div>
                    </div>

                </section>

                {{-- TABEL LAPORAN BULAN INI --}}
                <section class="bg-green-800/90 border border-green-700/70 rounded-3xl p-6 shadow-xl">

                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-sm font-semibold text-white">Rincian Transaksi Bulan Ini</h2>
                        <span class="text-[11px] text-green-100/70">{{ count($monthly) }} hari</span>
                    </div>

                    <div class="overflow-x-auto scroll-thin">
                        <table class="min-w-full text-xs text-left text-green-50">
                            <thead>
                                <tr class="border-b border-green-700/80 text-[11px] uppercase text-green-200/70">
                                    <th class="py-2 pr-4">Tanggal</th>
                                    <th class="py-2 pr-4">Jumlah Pesanan</th>
                                    <th class="py-2 pr-4">Pemasukan</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-green-700/70">
                                @foreach ($monthly as $d)
                                    <tr class="hover:bg-green-900/40 transition">
                                        <td class="py-2 pr-4">{{ $d['date'] }}</td>
                                        <td class="py-2 pr-4">{{ $d['orders'] }}</td>
                                        <td class="py-2 pr-4 text-yellow-300">
                                            Rp {{ number_format($d['income'], 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </section>

            </main>

        </div>
    </div>

</body>

</html>
