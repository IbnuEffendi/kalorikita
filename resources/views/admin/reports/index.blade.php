<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan - Admin KaloriKita</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    {{-- Script Chart.js Wajib Ada --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
        // Data dummy sudah DIHAPUS karena data sekarang datang dari Routes/Controller
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

                {{-- Menu Sidebar --}}
                <nav class="space-y-2 text-sm">
                    <a href="{{ route('admin.dashboard') }}"
                       class="flex items-center justify-between px-3 py-2 rounded-xl {{ request()->routeIs('admin.dashboard') ? 'bg-white text-green-900 font-semibold' : 'text-green-100 hover:bg-green-700/70' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('admin.orders.index') }}"
                       class="flex items-center justify-between px-3 py-2 rounded-xl {{ request()->routeIs('admin.orders.*') ? 'bg-white text-green-900 font-semibold' : 'text-green-100 hover:bg-green-700/70' }}">
                        Kelola Pesanan
                    </a>
                    <a href="{{ route('admin.paket.index') }}"
                       class="flex items-center justify-between px-3 py-2 rounded-xl {{ request()->routeIs('admin.paket.*') ? 'bg-white text-green-900 font-semibold' : 'text-green-100 hover:bg-green-700/70' }}">
                        Paket Katering
                    </a>
                    <a href="{{ route('admin.users.index') }}"
                       class="flex items-center justify-between px-3 py-2 rounded-xl {{ request()->routeIs('admin.users.*') ? 'bg-white text-green-900 font-semibold' : 'text-green-100 hover:bg-green-700/70' }}">
                        Data Pengguna
                    </a>
                    <a href="{{ route('admin.reports.index') }}"
                       class="flex items-center justify-between px-3 py-2 rounded-xl {{ request()->routeIs('admin.reports.*') ? 'bg-white text-green-900 font-semibold' : 'text-green-100 hover:bg-green-700/70' }}">
                        Laporan
                    </a>
                    <a href="{{ route('admin.ai.logs') }}"
                       class="flex items-center justify-between px-3 py-2 rounded-xl {{ request()->routeIs('admin.ai.*') ? 'bg-white text-green-900 font-semibold' : 'text-green-100 hover:bg-green-700/70' }}">
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

                {{-- HEADER --}}
                <section class="bg-green-800/90 border border-green-700/60 rounded-3xl p-6 shadow-xl">
                    <h1 class="text-xl sm:text-2xl font-semibold text-white">Laporan Keuangan</h1>
                    <p class="text-xs text-green-100/70 mt-1">
                        Ringkasan dan statistik performa KaloriKita bulan ini (Data Realtime).
                    </p>
                </section>

                {{-- SUMMARY CARDS (DATA REAL) --}}
                <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

                    {{-- Pemasukan --}}
                    <div class="bg-green-800/90 border border-green-700/70 rounded-3xl p-5 shadow-xl">
                        <p class="text-xs text-green-200/70">Pemasukan Bulan Ini</p>
                        <p class="text-xl font-bold text-yellow-300 mt-1">
                            Rp {{ number_format($pemasukan, 0, ',', '.') }}
                        </p>
                    </div>

                    {{-- Total Pesanan --}}
                    <div class="bg-green-800/90 border border-green-700/70 rounded-3xl p-5 shadow-xl">
                        <p class="text-xs text-green-200/70">Total Pesanan</p>
                        <p class="text-xl font-bold text-white mt-1">
                            {{ $totalPesanan }}
                        </p>
                    </div>

                    {{-- Paket Terlaris --}}
                    <div class="bg-green-800/90 border border-green-700/70 rounded-3xl p-5 shadow-xl">
                        <p class="text-xs text-green-200/70">Paket Terlaris</p>
                        <p class="text-sm font-semibold text-green-100 mt-1 line-clamp-1">
                            {{ $namaPaketTerlaris }}
                        </p>
                    </div>

                    {{-- Pengguna Baru --}}
                    <div class="bg-green-800/90 border border-green-700/70 rounded-3xl p-5 shadow-xl">
                        <p class="text-xs text-green-200/70">User Baru Bulan Ini</p>
                        <p class="text-xl font-bold text-white mt-1">
                            +{{ $penggunaBaru }}
                        </p>
                    </div>

                </section>

                {{-- GRAFIK (SUDAH PAKAI CHART.JS) --}}
                <section class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                    {{-- Grafik Pendapatan --}}
                    <div class="bg-green-800/90 border border-green-700/70 rounded-3xl p-6 shadow-xl">
                        <h2 class="text-sm font-semibold text-white mb-3">Grafik Pendapatan</h2>
                        <div class="w-full h-48 rounded-xl bg-green-900/30 border border-green-700/60 p-2 relative">
                            <canvas id="incomeChart"></canvas>
                        </div>
                    </div>

                    {{-- Grafik Pesanan --}}
                    <div class="bg-green-800/90 border border-green-700/70 rounded-3xl p-6 shadow-xl">
                        <h2 class="text-sm font-semibold text-white mb-3">Grafik Pesanan</h2>
                        <div class="w-full h-48 rounded-xl bg-green-900/30 border border-green-700/60 p-2 relative">
                            <canvas id="ordersChart"></canvas>
                        </div>
                    </div>

                </section>

                {{-- TABEL TRANSAKSI TERAKHIR (DATA REAL) --}}
                <section class="bg-green-800/90 border border-green-700/70 rounded-3xl p-6 shadow-xl">

                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-sm font-semibold text-white">Transaksi Terakhir</h2>
                        <span class="text-[11px] text-green-100/70">10 Data Terbaru</span>
                    </div>

                    <div class="overflow-x-auto scroll-thin">
                        <table class="min-w-full text-xs text-left text-green-50">
                            <thead>
                                <tr class="border-b border-green-700/80 text-[11px] uppercase text-green-200/70">
                                    <th class="py-2 pr-4">Tanggal</th>
                                    <th class="py-2 pr-4">Pelanggan</th>
                                    <th class="py-2 pr-4">Paket</th>
                                    <th class="py-2 pr-4">Status</th>
                                    <th class="py-2 pr-4">Total</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-green-700/70">
                                @forelse ($transactions as $trx)
                                    <tr class="hover:bg-green-900/40 transition">
                                        <td class="py-3 pr-4">{{ $trx->created_at->format('d M Y') }}</td>
                                        <td class="py-3 pr-4 font-medium">{{ $trx->user->name ?? 'Guest' }}</td>
                                        <td class="py-3 pr-4">{{ $trx->paketCategory->nama_kategori ?? '-' }}</td>
                                        <td class="py-3 pr-4">
                                            @if($trx->status == 'aktif')
                                                <span class="text-green-300 font-bold bg-green-900/50 px-2 py-1 rounded">Aktif</span>
                                            @elseif($trx->status == 'pending')
                                                <span class="text-yellow-300 font-bold bg-yellow-900/30 px-2 py-1 rounded">Pending</span>
                                            @else
                                                <span class="text-gray-300">{{ ucfirst($trx->status) }}</span>
                                            @endif
                                        </td>
                                        <td class="py-3 pr-4 text-yellow-300 font-bold">
                                            Rp {{ number_format($trx->total_harga, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-4 text-center text-green-200/50">
                                            Belum ada transaksi bulan ini.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </section>

            </main>

        </div>
    </div>

    {{-- CONFIG CHART.JS --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Setup Warna agar sesuai tema Green KaloriKita
            Chart.defaults.color = '#a7f3d0'; // Warna teks (green-200)
            Chart.defaults.borderColor = 'rgba(255, 255, 255, 0.1)';

            // Data dari Laravel Routes
            const labels = @json($chartLabels);
            const incomeData = @json($chartIncome);
            const ordersData = @json($chartOrders);

            // 1. Grafik Pendapatan (Line Chart)
            new Chart(document.getElementById('incomeChart'), {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Pendapatan (Rp)',
                        data: incomeData,
                        borderColor: '#fcd34d', // Yellow-300
                        backgroundColor: 'rgba(252, 211, 77, 0.1)',
                        borderWidth: 2,
                        tension: 0.3,
                        fill: true,
                        pointRadius: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true },
                        x: { display: false } // Sembunyikan label X agar bersih
                    }
                }
            });

            // 2. Grafik Pesanan (Bar Chart)
            new Chart(document.getElementById('ordersChart'), {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Jumlah Pesanan',
                        data: ordersData,
                        backgroundColor: '#ffffff', // Putih
                        borderRadius: 3,
                        barPercentage: 0.5
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, ticks: { stepSize: 1 } },
                        x: { display: false }
                    }
                }
            });
        });
    </script>

</body>
</html>