<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan - Admin KaloriKita</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <style>
        body {
            font-family: 'Instrument Sans', sans-serif;
        }

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

        /** ===========================
         *  DATA YANG DIHARAPKAN
         *  ===========================
         *  $order = [
         *      'id'         => 1,
         *      'code'       => 'ORD-00123',
         *      'user_name'  => 'Ibnu Effendi',
         *      'user_email' => 'ibnu@example.com',
         *      'user_phone' => '08xxxx',
         *      'plan_name'  => 'Paket Maintain 7 Hari',
         *      'plan_slug'  => 'maintain-7',
         *      'total'      => 300000,
         *      'status'     => 'pending', // pending, paid, cooking, delivered, cancelled
         *      'date'       => '2025-12-01 10:23',
         *      'notes'      => 'Tanpa cabe, kirim jam 12 siang.',
         *      'address'    => 'Jl. Contoh No. 123, Denpasar',
         *      'payment_method' => 'Transfer Bank',
         *  ];
         *
         *  $items = [
         *      ['name' => 'Menu Hari 1 - Siang', 'qty' => 1, 'price' => 45000],
         *      ['name' => 'Menu Hari 2 - Siang', 'qty' => 1, 'price' => 45000],
         *  ];
         */

        $order = $order ?? null;
        $items = $items ?? [];

        $status        = $order['status'] ?? 'pending';
        $statusLabel   = [
            'pending'   => 'Pending',
            'paid'      => 'Sudah Dibayar',
            'cooking'   => 'Diproses',
            'delivered' => 'Terkirim',
            'cancelled' => 'Dibatalkan',
        ][$status] ?? ucfirst($status);

        $statusColor   = match ($status) {
            'pending'   => 'bg-yellow-400/20 text-yellow-200 border-yellow-400/40',
            'paid'      => 'bg-emerald-400/20 text-emerald-200 border-emerald-400/40',
            'cooking'   => 'bg-blue-400/20 text-blue-200 border-blue-400/40',
            'delivered' => 'bg-green-400/20 text-green-200 border-green-400/40',
            'cancelled' => 'bg-red-400/20 text-red-200 border-red-400/40',
            default     => 'bg-green-400/20 text-green-200 border-green-400/40',
        };
    @endphp

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="flex flex-col lg:flex-row gap-6">

            {{-- SIDEBAR ADMIN --}}
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

            {{-- KONTEN UTAMA: DETAIL PESANAN --}}
            <main class="flex-1 space-y-6">

                {{-- Header + breadcrumb --}}
                <section
                    class="bg-green-800/90 border border-green-700/70 rounded-3xl p-6 sm:p-7 shadow-xl shadow-black/20">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-4">
                        <div>
                            <p class="text-[11px] text-green-100/70 mb-1">
                                <a href="{{ route('admin.orders.index') }}"
                                   class="hover:underline text-green-100/80">Kelola Pesanan</a>
                                <span class="mx-1">/</span>
                                <span class="text-green-100/50">Detail Pesanan</span>
                            </p>
                            <h1 class="text-xl sm:text-2xl font-semibold text-white">
                                Detail Pesanan
                                @if ($order)
                                    <span class="text-yellow-300 text-sm">
                                        #{{ $order['code'] ?? ('ORD-' . str_pad($order['id'] ?? 0, 5, '0', STR_PAD_LEFT)) }}
                                    </span>
                                @endif
                            </h1>
                            @if ($order)
                                <p class="text-xs text-green-100/70 mt-1">
                                    Dibuat pada: {{ $order['date'] ?? '-' }}
                                </p>
                            @endif
                        </div>

                        @if ($order)
                            <div class="flex flex-wrap gap-2 text-xs justify-end">
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full border {{ $statusColor }} font-semibold">
                                    Status: {{ $statusLabel }}
                                </span>
                            </div>
                        @endif
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('admin.orders.index') }}"
                           class="inline-flex items-center gap-2 rounded-full bg-green-900/80 text-green-50 px-4 py-2 text-xs font-semibold hover:bg-green-900 transition">
                            ‹ Kembali ke daftar
                        </a>

                        {{-- Placeholder tombol aksi (ubah status dsb) --}}
                        @if ($order)
                            <button
                                class="inline-flex items-center gap-2 rounded-full bg-yellow-400 text-green-900 px-4 py-2 text-xs font-semibold hover:bg-yellow-300 transition">
                                Ubah Status Pesanan
                            </button>
                        @endif
                    </div>
                </section>

                @if (!$order)
                    <section
                        class="bg-green-800/90 border border-green-700/70 rounded-3xl p-6 shadow-xl text-center text-sm text-green-100/80">
                        <p>Data pesanan tidak ditemukan.</p>
                        <p class="text-green-100/60 mt-1">Pastikan ID pesanan valid.</p>
                    </section>
                @else
                    {{-- GRID DETAIL: Kiri (info utama) + Kanan (alamat & catatan) --}}
                    <section class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                        {{-- KIRI: Info pesanan & customer --}}
                        <div class="lg:col-span-2 space-y-6">

                            {{-- Info Pesanan --}}
                            <div
                                class="bg-green-800/90 border border-green-700/70 rounded-3xl p-5 sm:p-6 shadow-xl">
                                <h2 class="text-sm font-semibold text-white mb-3">Informasi Pesanan</h2>

                                <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-3 text-xs text-green-100/85">
                                    <div>
                                        <dt class="text-green-200/70">Kode Pesanan</dt>
                                        <dd class="font-semibold">
                                            {{ $order['code'] ?? ('ORD-' . str_pad($order['id'] ?? 0, 5, '0', STR_PAD_LEFT)) }}
                                        </dd>
                                    </div>
                                    <div>
                                        <dt class="text-green-200/70">Tanggal Pesanan</dt>
                                        <dd class="font-semibold">
                                            {{ $order['date'] ?? '-' }}
                                        </dd>
                                    </div>
                                    <div>
                                        <dt class="text-green-200/70">Paket Katering</dt>
                                        <dd class="font-semibold">
                                            {{ $order['plan_name'] ?? 'Paket Katering' }}
                                        </dd>
                                    </div>
                                    <div>
                                        <dt class="text-green-200/70">Metode Pembayaran</dt>
                                        <dd class="font-semibold">
                                            {{ $order['payment_method'] ?? 'Belum diatur' }}
                                        </dd>
                                    </div>
                                    <div>
                                        <dt class="text-green-200/70">Total Pembayaran</dt>
                                        <dd class="font-semibold text-yellow-300">
                                            Rp {{ number_format($order['total'] ?? 0, 0, ',', '.') }}
                                        </dd>
                                    </div>
                                    <div>
                                        <dt class="text-green-200/70">Status</dt>
                                        <dd class="mt-1">
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full border {{ $statusColor }} font-semibold">
                                                {{ $statusLabel }}
                                            </span>
                                        </dd>
                                    </div>
                                </dl>
                            </div>

                            {{-- Info Pengguna --}}
                            <div
                                class="bg-green-800/90 border border-green-700/70 rounded-3xl p-5 sm:p-6 shadow-xl">
                                <h2 class="text-sm font-semibold text-white mb-3">Informasi Pengguna</h2>

                                <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-3 text-xs text-green-100/85">
                                    <div>
                                        <dt class="text-green-200/70">Nama Pengguna</dt>
                                        <dd class="font-semibold">
                                            {{ $order['user_name'] ?? 'Pengguna' }}
                                        </dd>
                                    </div>
                                    <div>
                                        <dt class="text-green-200/70">Email</dt>
                                        <dd class="font-semibold">
                                            {{ $order['user_email'] ?? '-' }}
                                        </dd>
                                    </div>
                                    <div>
                                        <dt class="text-green-200/70">Nomor HP</dt>
                                        <dd class="font-semibold">
                                            {{ $order['user_phone'] ?? '-' }}
                                        </dd>
                                    </div>
                                </dl>
                            </div>

                            {{-- Item Pesanan --}}
                            <div
                                class="bg-green-800/90 border border-green-700/70 rounded-3xl p-5 sm:p-6 shadow-xl">
                                <div class="flex items-center justify-between mb-3">
                                    <h2 class="text-sm font-semibold text-white">Detail Item Pesanan</h2>
                                    <span class="text-[11px] text-green-100/70">
                                        {{ count($items) }} item
                                    </span>
                                </div>

                                @if (empty($items))
                                    <p class="text-xs text-green-100/70">
                                        Belum ada data item pesanan. Kamu bisa isi nanti sesuai struktur paket.
                                    </p>
                                @else
                                    <div class="overflow-x-auto scroll-thin">
                                        <table class="min-w-full text-xs text-left text-green-50">
                                            <thead>
                                                <tr
                                                    class="border-b border-green-700/80 text-[11px] uppercase text-green-200/80">
                                                    <th class="py-2 pr-4">Nama Item</th>
                                                    <th class="py-2 pr-4">Qty</th>
                                                    <th class="py-2 pr-4">Harga</th>
                                                    <th class="py-2 pr-4 text-right">Subtotal</th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-green-700/70">
                                                @foreach ($items as $it)
                                                    @php
                                                        $qty = $it['qty'] ?? 1;
                                                        $price = $it['price'] ?? 0;
                                                        $subtotal = $qty * $price;
                                                    @endphp
                                                    <tr class="hover:bg-green-900/40 transition">
                                                        <td class="py-2 pr-4">
                                                            <p class="font-semibold text-[13px]">
                                                                {{ $it['name'] ?? 'Item' }}
                                                            </p>
                                                            @if (!empty($it['note']))
                                                                <p class="text-[11px] text-green-200/70">
                                                                    Catatan: {{ $it['note'] }}
                                                                </p>
                                                            @endif
                                                        </td>
                                                        <td class="py-2 pr-4 align-top">
                                                            {{ $qty }}
                                                        </td>
                                                        <td class="py-2 pr-4 align-top">
                                                            Rp {{ number_format($price, 0, ',', '.') }}
                                                        </td>
                                                        <td class="py-2 pr-0 text-right align-top">
                                                            Rp {{ number_format($subtotal, 0, ',', '.') }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>

                        </div>

                        {{-- KANAN: Alamat & Catatan --}}
                        <div class="space-y-6">

                            {{-- Alamat Pengiriman --}}
                            <div
                                class="bg-green-800/90 border border-green-700/70 rounded-3xl p-5 sm:p-6 shadow-xl">
                                <h2 class="text-sm font-semibold text-white mb-3">Alamat Pengiriman</h2>
                                <p class="text-xs text-green-100/80 leading-relaxed">
                                    {{ $order['address'] ?? 'Belum ada alamat pengiriman.' }}
                                </p>
                            </div>

                            {{-- Catatan Pesanan --}}
                            <div
                                class="bg-green-800/90 border border-green-700/70 rounded-3xl p-5 sm:p-6 shadow-xl">
                                <h2 class="text-sm font-semibold text-white mb-3">Catatan Pesanan</h2>
                                <p class="text-xs text-green-100/80 leading-relaxed whitespace-pre-line">
                                    {{ $order['notes'] ?? 'Tidak ada catatan khusus dari pengguna.' }}
                                </p>
                            </div>

                            {{-- Timeline Status (static placeholder) --}}
                            <div
                                class="bg-green-800/90 border border-green-700/70 rounded-3xl p-5 sm:p-6 shadow-xl">
                                <h2 class="text-sm font-semibold text-white mb-3">Timeline Status</h2>

                                <ul class="text-xs text-green-100/80 space-y-2">
                                    <li class="flex gap-2">
                                        <span class="mt-[3px] text-[10px]">●</span>
                                        <div>
                                            <p class="font-semibold">Pesanan dibuat</p>
                                            <p class="text-[11px] text-green-200/70">
                                                {{ $order['date'] ?? '-' }}
                                            </p>
                                        </div>
                                    </li>
                                    {{-- Nanti bisa diisi dari log status beneran --}}
                                    <li class="flex gap-2 opacity-60">
                                        <span class="mt-[3px] text-[10px]">●</span>
                                        <div>
                                            <p class="font-semibold">Dibayar</p>
                                            <p class="text-[11px] text-green-200/70">
                                                (waktu pembayaran akan tampil di sini)
                                            </p>
                                        </div>
                                    </li>
                                    <li class="flex gap-2 opacity-60">
                                        <span class="mt-[3px] text-[10px]">●</span>
                                        <div>
                                            <p class="font-semibold">Diproses / Dimasak</p>
                                        </div>
                                    </li>
                                    <li class="flex gap-2 opacity-60">
                                        <span class="mt-[3px] text-[10px]">●</span>
                                        <div>
                                            <p class="font-semibold">Terkirim ke pelanggan</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                        </div>

                    </section>
                @endif

            </main>

        </div>
    </div>

</body>

</html>
