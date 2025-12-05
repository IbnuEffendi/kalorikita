<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pesanan - Admin KaloriKita</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <style>
        body {
            font-family: 'Instrument Sans', sans-serif;
        }

        /* Scrollbar halus di tabel */
        .scroll-thin::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        .scroll-thin::-webkit-scrollbar-thumb {
            background-color: rgba(34, 197, 94, 0.7);
            border-radius: 999px;
        }
    </style>
</head>

<body class="bg-green-700/60">

    {{-- NAVBAR UTAMA --}}
    <x-navbar></x-navbar>

    @php
        $user = auth()->user();

        // Jika controller belum mengirim $orders, pakai dummy kosong
        /** @var array $orders */
        $orders = $orders ?? [];

        // Contoh struktur elemen orders:
        // [
        //   'id'         => 1,
        //   'code'       => 'ORD-00123',
        //   'user_name'  => 'Ibnu Effendi',
        //   'user_email' => 'ibnu@example.com',
        //   'plan_name'  => 'Paket Maintain',
        //   'total'      => 300000,
        //   'status'     => 'pending', // pending, paid, cooking, delivered, cancelled
        //   'date'       => '2025-12-01 10:23',
        // ]
    @endphp

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="flex flex-col lg:flex-row gap-6">

            {{-- SIDEBAR ADMIN (sama konsep dengan dashboard admin) --}}
            <aside class="w-full lg:w-64 bg-green-800/90 border border-green-700/70 rounded-3xl p-5 h-max">

                {{-- Profil mini di sidebar --}}
                <div class="flex items-center gap-3 mb-6">
                    <div
                        class="w-10 h-10 rounded-2xl bg-yellow-400 flex items-center justify-center text-green-900 font-extrabold">
                        {{ strtoupper(mb_substr($user->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="leading-tight">
                        <p class="text-sm font-semibold text-white">
                            {{ $user->name ?? 'Admin KaloriKita' }}
                        </p>
                        <p class="text-[11px] text-green-100/70">
                            Admin
                        </p>
                    </div>
                </div>

                {{-- Menu Admin --}}
                <nav class="space-y-2 text-sm">

                    {{-- Dashboard Admin --}}
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center justify-between px-3 py-2 rounded-xl 
                              {{ request()->routeIs('admin.dashboard') ? 'bg-white text-green-900 font-semibold' : 'text-green-100 hover:bg-green-700/70' }}">
                        <span>Dashboard</span>
                    </a>

                    {{-- Kelola Pesanan --}}
                    <a href="{{ route('admin.orders.index') }}"
                        class="flex items-center justify-between px-3 py-2 rounded-xl 
                              {{ request()->routeIs('admin.orders.*') ? 'bg-white text-green-900 font-semibold' : 'text-green-100 hover:bg-green-700/70' }}">
                        <span>Kelola Pesanan</span>
                    </a>

                    {{-- Paket Katering --}}
                    <a href="{{ route('admin.paket.index') }}"
                        class="flex items-center justify-between px-3 py-2 rounded-xl 
                              {{ request()->routeIs('admin.paket.*') ? 'bg-white text-green-900 font-semibold' : 'text-green-100 hover:bg-green-700/70' }}">
                        <span>Paket Katering</span>
                    </a>

                    {{-- Data Pengguna --}}
                    <a href="{{ route('admin.users.index') }}"
                        class="flex items-center justify-between px-3 py-2 rounded-xl 
                              {{ request()->routeIs('admin.users.*') ? 'bg-white text-green-900 font-semibold' : 'text-green-100 hover:bg-green-700/70' }}">
                        <span>Data Pengguna</span>
                    </a>

                    {{-- Laporan --}}
                    <a href="{{ route('admin.reports.index') }}"
                        class="flex items-center justify-between px-3 py-2 rounded-xl 
                              {{ request()->routeIs('admin.reports.*') ? 'bg-white text-green-900 font-semibold' : 'text-green-100 hover:bg-green-700/70' }}">
                        <span>Laporan</span>
                    </a>

                    {{-- Log KaloriLab (AI) --}}
                    <a href="{{ route('admin.ai.logs') }}"
                        class="flex items-center justify-between px-3 py-2 rounded-xl 
                              {{ request()->routeIs('admin.ai.*') ? 'bg-white text-green-900 font-semibold' : 'text-green-100 hover:bg-green-700/70' }}">
                        <span>Log KaloriLab (AI)</span>
                    </a>

                    <div class="border-t border-green-700/60 my-3"></div>

                    {{-- Kembali ke tampilan user --}}
                    <a href="{{ route('profil.dashboard') }}"
                        class="flex items-center justify-between px-3 py-2 rounded-xl text-[11px] text-green-100 hover:bg-green-700/70">
                        <span>Masuk sebagai Pengguna</span>
                    </a>

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

            {{-- KONTEN UTAMA: KELOLA PESANAN --}}
            <main class="flex-1">

                {{-- Header + filter --}}
                <section
                    class="bg-green-800/90 border border-green-700/70 rounded-3xl p-6 sm:p-7 shadow-xl shadow-black/20 mb-6">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-4">
                        <div>
                            <h1 class="text-xl sm:text-2xl font-semibold text-white">Kelola Pesanan</h1>
                            <p class="text-xs text-green-100/70 mt-1">
                                Pantau dan atur pesanan katering pengguna KaloriKita.
                            </p>
                        </div>

                        {{-- Ringkasan kecil --}}
                        <div class="flex flex-wrap gap-3 text-xs">
                            <div
                                class="px-3 py-2 rounded-2xl bg-green-900/60 border border-green-600/70 text-green-100/90">
                                <p class="text-[10px] uppercase tracking-wide text-green-200/70">Total Pesanan</p>
                                <p class="font-semibold text-sm">{{ count($orders) }}</p>
                            </div>
                            {{-- Jika nanti mau tambahin by status, bisa dari controller --}}
                        </div>
                    </div>

                    {{-- Filter bar --}}
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-3 mt-2 text-xs">
                        {{-- Cari keyword --}}
                        <div>
                            <label class="block text-green-100/80 mb-1">Cari</label>
                            <div class="relative">
                                <input type="text" name="q" placeholder="Nama, email, kode pesanan..."
                                    class="w-full rounded-2xl border border-green-600/60 bg-green-900/60 text-green-50 px-3 py-2 text-xs placeholder:text-green-200/40 focus:outline-none focus:ring-1 focus:ring-yellow-300">
                                <span
                                    class="absolute inset-y-0 right-3 flex items-center text-[11px] text-green-200/60">⌕</span>
                            </div>
                        </div>

                        {{-- Status --}}
                        <div>
                            <label class="block text-green-100/80 mb-1">Status</label>
                            <select
                                class="w-full rounded-2xl border border-green-600/60 bg-green-900/60 text-green-50 px-3 py-2 text-xs focus:outline-none focus:ring-1 focus:ring-yellow-300">
                                <option value="">Semua status</option>
                                <option value="pending">Pending</option>
                                <option value="paid">Sudah dibayar</option>
                                <option value="cooking">Diproses / Dimasak</option>
                                <option value="delivered">Terkirim</option>
                                <option value="cancelled">Dibatalkan</option>
                            </select>
                        </div>

                        {{-- Tanggal dari --}}
                        <div>
                            <label class="block text-green-100/80 mb-1">Tanggal dari</label>
                            <input type="date"
                                class="w-full rounded-2xl border border-green-600/60 bg-green-900/60 text-green-50 px-3 py-2 text-xs focus:outline-none focus:ring-1 focus:ring-yellow-300">
                        </div>

                        {{-- Tanggal sampai --}}
                        <div>
                            <label class="block text-green-100/80 mb-1">Sampai</label>
                            <input type="date"
                                class="w-full rounded-2xl border border-green-600/60 bg-green-900/60 text-green-50 px-3 py-2 text-xs focus:outline-none focus:ring-1 focus:ring-yellow-300">
                        </div>
                    </div>

                    <div class="mt-4 flex justify-end">
                        <button
                            class="inline-flex items-center gap-2 rounded-full bg-yellow-400 text-green-900 px-4 py-2 text-xs font-semibold hover:bg-yellow-300 transition">
                            Terapkan Filter
                        </button>
                    </div>
                </section>

                {{-- Tabel pesanan --}}
                <section class="bg-green-800/90 border border-green-700/70 rounded-3xl p-4 sm:p-6 shadow-xl">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-sm font-semibold text-white">Daftar Pesanan</h2>
                        <span class="text-[11px] text-green-100/70">
                            Menampilkan {{ count($orders) }} pesanan
                        </span>
                    </div>

                    @if (empty($orders))
                        <div
                            class="border border-dashed border-green-600/80 rounded-2xl p-6 text-center text-xs text-green-100/80">
                            <p>Belum ada pesanan untuk ditampilkan.</p>
                            <p class="text-green-100/60 mt-1">
                                Pesanan pengguna akan muncul di sini setelah mereka checkout paket.
                            </p>
                        </div>
                    @else
                        <div class="overflow-x-auto scroll-thin">
                            <table class="min-w-full text-xs text-left text-green-50">
                                <thead>
                                    <tr class="border-b border-green-700/80 text-[11px] uppercase text-green-200/80">
                                        <th class="py-2 pr-4">Kode</th>
                                        <th class="py-2 pr-4">Pengguna</th>
                                        <th class="py-2 pr-4">Paket</th>
                                        <th class="py-2 pr-4">Tanggal</th>
                                        <th class="py-2 pr-4">Total</th>
                                        <th class="py-2 pr-4">Status</th>
                                        <th class="py-2 pr-4 text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-green-700/70">
                                    @foreach ($orders as $order)
                                        @php
                                            $status = $order['status'] ?? 'pending';
                                            $statusLabel = [
                                                'pending'   => 'Pending',
                                                'paid'      => 'Sudah Dibayar',
                                                'cooking'   => 'Diproses',
                                                'delivered' => 'Terkirim',
                                                'cancelled' => 'Dibatalkan',
                                            ][$status] ?? ucfirst($status);

                                            $statusColor = match ($status) {
                                                'pending'   => 'bg-yellow-400/20 text-yellow-200 border-yellow-400/40',
                                                'paid'      => 'bg-emerald-400/20 text-emerald-200 border-emerald-400/40',
                                                'cooking'   => 'bg-blue-400/20 text-blue-200 border-blue-400/40',
                                                'delivered' => 'bg-green-400/20 text-green-200 border-green-400/40',
                                                'cancelled' => 'bg-red-400/20 text-red-200 border-red-400/40',
                                                default     => 'bg-green-400/20 text-green-200 border-green-400/40',
                                            };
                                        @endphp
                                        <tr class="hover:bg-green-900/40 transition">
                                            <td class="py-3 pr-4 align-top">
                                                <p class="font-semibold text-[13px]">
                                                    {{ $order['code'] ?? ('ORD-' . str_pad($order['id'] ?? 0, 5, '0', STR_PAD_LEFT)) }}
                                                </p>
                                                <p class="text-[11px] text-green-200/70">
                                                    ID: {{ $order['id'] ?? '-' }}
                                                </p>
                                            </td>

                                            <td class="py-3 pr-4 align-top">
                                                <p class="font-semibold">
                                                    {{ $order['user_name'] ?? 'Pengguna' }}
                                                </p>
                                                <p class="text-[11px] text-green-200/70">
                                                    {{ $order['user_email'] ?? '-' }}
                                                </p>
                                            </td>

                                            <td class="py-3 pr-4 align-top">
                                                <p class="font-semibold">
                                                    {{ $order['plan_name'] ?? 'Paket Katering' }}
                                                </p>
                                            </td>

                                            <td class="py-3 pr-4 align-top">
                                                <p class="text-[11px] text-green-100/80">
                                                    {{ $order['date'] ?? '-' }}
                                                </p>
                                            </td>

                                            <td class="py-3 pr-4 align-top">
                                                <p class="font-semibold text-yellow-300">
                                                    Rp {{ number_format($order['total'] ?? 0, 0, ',', '.') }}
                                                </p>
                                            </td>

                                            <td class="py-3 pr-4 align-top">
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full border text-[11px] font-semibold {{ $statusColor }}">
                                                    {{ $statusLabel }}
                                                </span>
                                            </td>

                                            <td class="py-3 pr-0 align-top">
                                                <div class="flex items-center justify-end gap-2">
                                                    <a href="{{ route('admin.orders.show', $order['id']) }}"
                                                        class="inline-flex items-center px-3 py-1 rounded-full bg-white/10 text-[11px] text-green-50 border border-green-500/60 hover:bg-white/20 transition">
                                                        Detail
                                                    </a>
                                                    {{-- Tombol aksi cepat (misal ubah status) bisa ditambah di sini nanti --}}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination placeholder --}}
                        <div class="mt-4 flex items-center justify-between text-[11px] text-green-100/70">
                            <p>Menampilkan {{ count($orders) }} pesanan (pagination bisa ditambahkan nanti).</p>
                            <div class="flex gap-1">
                                <button
                                    class="px-3 py-1 rounded-full bg-green-900/70 border border-green-600/70 hover:bg-green-900 text-green-100">
                                    ‹
                                </button>
                                <button
                                    class="px-3 py-1 rounded-full bg-yellow-400 text-green-900 font-semibold">
                                    1
                                </button>
                                <button
                                    class="px-3 py-1 rounded-full bg-green-900/70 border border-green-600/70 hover:bg-green-900 text-green-100">
                                    2
                                </button>
                                <button
                                    class="px-3 py-1 rounded-full bg-green-900/70 border border-green-600/70 hover:bg-green-900 text-green-100">
                                    ›
                                </button>
                            </div>
                        </div>
                    @endif
                </section>

            </main>

        </div>
    </div>

</body>

</html>
