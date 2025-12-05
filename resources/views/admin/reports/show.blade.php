<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Laporan - Admin KaloriKita</title>

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

        /**
         * Controller diharapkan mengirim:
         *
         * $report = [
         *   'title'         => 'Laporan 05 Desember 2025',
         *   'period_label'  => '05 Desember 2025',
         *   'date'          => '2025-12-05',
         *   'income'        => 1150000,
         *   'orders'        => 10,
         *   'best_package'  => 'Paket Defisit 14 Hari',
         *   'avg_per_order' => 115000,
         * ];
         *
         * $orders = [
         *   [
         *     'id'         => 1,
         *     'code'       => 'ORD-20251205-001',
         *     'user_name'  => 'Ibnu Effendi',
         *     'plan_name'  => 'Paket Defisit 14 Hari',
         *     'status'     => 'success', // success, pending, cancelled
         *     'total'      => 150000,
         *     'created_at' => '2025-12-05 09:30',
         *   ],
         *   ...
         * ];
         */

        $report = $report ?? [
            'title'         => 'Laporan Contoh',
            'period_label'  => 'Periode tidak diketahui',
            'date'          => now()->toDateString(),
            'income'        => 0,
            'orders'        => 0,
            'best_package'  => '-',
            'avg_per_order' => 0,
        ];

        $orders = $orders ?? [];

        // helper aman untuk array/object
        function rget($item, $key, $default = null) {
            if (is_array($item)) {
                return $item[$key] ?? $default;
            }
            if (is_object($item)) {
                return $item->{$key} ?? $default;
            }
            return $default;
        }
    @endphp

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="flex flex-col lg:flex-row gap-6">

            {{-- SIDEBAR ADMIN --}}
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
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <p class="text-[11px] text-green-100/70 mb-1">
                                <a href="{{ route('admin.reports.index') }}" class="hover:underline">Laporan</a>
                                <span class="mx-1">/</span>
                                <span class="text-green-100/50">Detail Laporan</span>
                            </p>
                            <h1 class="text-xl sm:text-2xl font-semibold text-white">
                                {{ $report['title'] ?? 'Detail Laporan' }}
                            </h1>
                            <p class="text-xs text-green-100/70 mt-1">
                                Periode: {{ $report['period_label'] ?? '-' }}
                            </p>
                        </div>

                        <div class="flex flex-wrap gap-2 justify-end">
                            <a href="{{ route('admin.reports.index') }}"
                               class="inline-flex items-center px-4 py-2 rounded-full bg-green-900/80 text-green-50 text-xs font-semibold hover:bg-green-900">
                                ‹ Kembali
                            </a>
                            <button
                                class="inline-flex items-center px-4 py-2 rounded-full bg-yellow-400 text-green-900 text-xs font-semibold hover:bg-yellow-300">
                                Export PDF
                            </button>
                        </div>
                    </div>
                </section>

                {{-- SUMMARY --}}
                <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

                    <div class="bg-green-800/90 border border-green-700/70 rounded-3xl p-5 shadow-xl">
                        <p class="text-xs text-green-200/70">Total Pemasukan</p>
                        <p class="text-xl font-bold text-yellow-300 mt-1">
                            Rp {{ number_format($report['income'] ?? 0, 0, ',', '.') }}
                        </p>
                    </div>

                    <div class="bg-green-800/90 border border-green-700/70 rounded-3xl p-5 shadow-xl">
                        <p class="text-xs text-green-200/70">Total Pesanan</p>
                        <p class="text-xl font-bold text-white mt-1">
                            {{ $report['orders'] ?? 0 }}
                        </p>
                    </div>

                    <div class="bg-green-800/90 border border-green-700/70 rounded-3xl p-5 shadow-xl">
                        <p class="text-xs text-green-200/70">Rata-rata per Pesanan</p>
                        <p class="text-xl font-bold text-white mt-1">
                            Rp {{ number_format($report['avg_per_order'] ?? 0, 0, ',', '.') }}
                        </p>
                    </div>

                    <div class="bg-green-800/90 border border-green-700/70 rounded-3xl p-5 shadow-xl">
                        <p class="text-xs text-green-200/70">Paket Terlaris</p>
                        <p class="text-sm font-semibold text-green-100 mt-1">
                            {{ $report['best_package'] ?? '-' }}
                        </p>
                    </div>

                </section>

                {{-- RINGKASAN KECIL --}}
                <section class="bg-green-800/90 border border-green-700/70 rounded-3xl p-5 shadow-xl text-xs text-green-100/80">
                    <h2 class="text-sm font-semibold text-white mb-2">Catatan</h2>
                    <p>
                        Laporan ini menampilkan semua pesanan yang masuk pada periode
                        <span class="font-semibold">{{ $report['period_label'] ?? '-' }}</span>.
                        Data dapat digunakan untuk analisis performa penjualan paket katering KaloriKita.
                    </p>
                </section>

                {{-- TABEL PESANAN DI PERIODE INI --}}
                <section class="bg-green-800/90 border border-green-700/70 rounded-3xl p-6 shadow-xl">

                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-sm font-semibold text-white">Daftar Pesanan pada Periode Ini</h2>
                        <span class="text-[11px] text-green-100/70">
                            {{ is_countable($orders) ? count($orders) : 0 }} pesanan
                        </span>
                    </div>

                    @if (!is_countable($orders) || count($orders) === 0)
                        <div
                            class="border border-dashed border-green-600/80 rounded-2xl p-6 text-center text-xs text-green-100/80">
                            <p>Belum ada pesanan pada periode ini.</p>
                        </div>
                    @else
                        <div class="overflow-x-auto scroll-thin">
                            <table class="min-w-full text-xs text-left text-green-50">
                                <thead>
                                    <tr class="border-b border-green-700/80 text-[11px] uppercase text-green-200/70">
                                        <th class="py-2 pr-4">Kode Pesanan</th>
                                        <th class="py-2 pr-4">Pengguna</th>
                                        <th class="py-2 pr-4">Paket</th>
                                        <th class="py-2 pr-4">Status</th>
                                        <th class="py-2 pr-4">Total</th>
                                        <th class="py-2 pr-4">Waktu</th>
                                        <th class="py-2 pr-4 text-right">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-green-700/70">
                                    @foreach ($orders as $o)
                                        @php
                                            $id        = rget($o, 'id');
                                            $code      = rget($o, 'code', 'ORD-XXXX');
                                            $userName  = rget($o, 'user_name', 'Pengguna');
                                            $planName  = rget($o, 'plan_name', '-');
                                            $status    = rget($o, 'status', 'pending');
                                            $total     = rget($o, 'total', 0);
                                            $createdAt = rget($o, 'created_at');

                                            if ($createdAt instanceof \Carbon\Carbon) {
                                                $createdFormatted = $createdAt->format('d M Y H:i');
                                            } elseif ($createdAt) {
                                                $createdFormatted = date('d M Y H:i', strtotime($createdAt));
                                            } else {
                                                $createdFormatted = '-';
                                            }

                                            switch ($status) {
                                                case 'success':
                                                    $statusLabel = 'Berhasil';
                                                    $statusColor = 'bg-emerald-400/20 text-emerald-200 border-emerald-400/40';
                                                    break;
                                                case 'cancelled':
                                                    $statusLabel = 'Dibatalkan';
                                                    $statusColor = 'bg-red-400/20 text-red-200 border-red-400/40';
                                                    break;
                                                default:
                                                    $statusLabel = 'Menunggu';
                                                    $statusColor = 'bg-yellow-400/20 text-yellow-200 border-yellow-400/40';
                                                    break;
                                            }
                                        @endphp

                                        <tr class="hover:bg-green-900/40 transition">
                                            <td class="py-3 pr-4 align-top">
                                                <p class="font-semibold text-[13px]">{{ $code }}</p>
                                            </td>
                                            <td class="py-3 pr-4 align-top">
                                                <p class="text-[13px] font-semibold">{{ $userName }}</p>
                                            </td>
                                            <td class="py-3 pr-4 align-top">
                                                <p class="text-[11px] text-green-100/80">{{ $planName }}</p>
                                            </td>
                                            <td class="py-3 pr-4 align-top">
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full border text-[11px] font-semibold {{ $statusColor }}">
                                                    {{ $statusLabel }}
                                                </span>
                                            </td>
                                            <td class="py-3 pr-4 align-top text-yellow-300">
                                                Rp {{ number_format($total, 0, ',', '.') }}
                                            </td>
                                            <td class="py-3 pr-4 align-top">
                                                <p class="text-[11px] text-green-100/80">
                                                    {{ $createdFormatted }}
                                                </p>
                                            </td>
                                            <td class="py-3 pr-0 align-top">
                                                <div class="flex items-center justify-end">
                                                    {{-- arahkan ke halaman detail pesanan kalau sudah ada --}}
                                                    {{-- <a href="{{ route('admin.orders.show', $id) }}" ...> --}}
                                                    <a href="#"
                                                       class="inline-flex items-center px-3 py-1 rounded-full bg-white/10 text-[11px] text-green-50 border border-green-500/60 hover:bg-white/20 transition">
                                                        Detail Pesanan
                                                    </a>
                                                </div>
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

</body>

</html>
