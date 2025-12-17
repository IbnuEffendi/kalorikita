<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengguna - Admin KaloriKita</title>

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
            background-color: rgba(34, 197, 94, 0.7);
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
         * Controller mengirim:
         * - $userDetail: array atau Eloquent User
         * - (opsional) $stats:
         * ['orders_count' => 0, 'orders_total' => 0, 'last_order_at' => null]
         */

        $u = $userDetail ?? $user ?? null; // fallback

        // Helper
        function du($u, $key, $default = null) {
            if (is_array($u)) return $u[$key] ?? $default;
            if (is_object($u)) return $u->{$key} ?? $default;
            return $default;
        }

        $id        = du($u, 'id', '-');
        $name      = du($u, 'name', 'Pengguna');
        $email     = du($u, 'email', '-');
        $role      = du($u, 'role', 'user');
        $status    = du($u, 'status', 'active');
        $google_id = du($u, 'google_id', null);
        $created   = du($u, 'created_at', null);
        $updated   = du($u, 'updated_at', null);

        if ($created instanceof \Carbon\Carbon) {
            $createdFormatted = $created->format('d M Y H:i');
        } elseif ($created) {
            $createdFormatted = date('d M Y H:i', strtotime($created));
        } else {
            $createdFormatted = '-';
        }

        if ($updated instanceof \Carbon\Carbon) {
            $updatedFormatted = $updated->format('d M Y H:i');
        } elseif ($updated) {
            $updatedFormatted = date('d M Y H:i', strtotime($updated));
        } else {
            $updatedFormatted = '-';
        }

        $roleLabel = $role === 'admin' ? 'Admin' : 'Pengguna';
        $roleColor = $role === 'admin'
            ? 'bg-purple-400/20 text-purple-200 border-purple-400/40'
            : 'bg-green-400/20 text-green-200 border-green-400/40';

        $statusLabel = $status === 'inactive' ? 'Nonaktif' : 'Aktif';
        $statusColor = $status === 'inactive'
            ? 'bg-red-400/20 text-red-200 border-red-400/40'
            : 'bg-emerald-400/20 text-emerald-200 border-emerald-400/40';

        $googleLabel = $google_id ? 'Terhubung' : 'Belum Terhubung';
        $googleColor = $google_id
            ? 'bg-sky-400/20 text-sky-200 border-sky-400/40'
            : 'bg-slate-400/10 text-slate-200 border-slate-400/30';

        $stats = $stats ?? [
            'orders_count' => 0,
            'orders_total' => 0,
            'last_order_at' => null,
        ];

        $ordersCount = $stats['orders_count'] ?? 0;
        $ordersTotal = $stats['orders_total'] ?? 0;
        $lastOrderAt = $stats['last_order_at'] ?? null;

        if ($lastOrderAt instanceof \Carbon\Carbon) {
            $lastOrderFormatted = $lastOrderAt->format('d M Y H:i');
        } elseif ($lastOrderAt) {
            $lastOrderFormatted = date('d M Y H:i', strtotime($lastOrderAt));
        } else {
            $lastOrderFormatted = '-';
        }
    @endphp

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="flex flex-col lg:flex-row gap-6">

            {{-- SIDEBAR ADMIN --}}
            <aside class="w-full lg:w-64 bg-green-800/90 border border-green-700/70 rounded-3xl p-5 h-max">

                {{-- Profil mini admin --}}
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
                <section class="bg-green-800/90 border border-green-700/70 rounded-3xl p-6 shadow-xl">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <p class="text-[11px] text-green-100/70 mb-1">
                                <a href="{{ route('admin.users.index') }}" class="hover:underline">Data Pengguna</a>
                                <span class="mx-1">/</span>
                                <span class="text-green-100/50">Detail Pengguna</span>
                            </p>
                            <h1 class="text-xl sm:text-2xl font-semibold text-white">
                                {{ $name }}
                            </h1>
                            <p class="text-xs text-green-100/70 mt-1">
                                ID: {{ $id }} • {{ $email }}
                            </p>
                        </div>

                        <div class="flex flex-wrap gap-2 justify-end">
                            <span class="inline-flex items-center px-3 py-1 rounded-full border text-[11px] font-semibold {{ $roleColor }}">
                                {{ $roleLabel }}
                            </span>

                            <span class="inline-flex items-center px-3 py-1 rounded-full border text-[11px] font-semibold {{ $statusColor }}">
                                {{ $statusLabel }}
                            </span>

                            <span class="inline-flex items-center px-3 py-1 rounded-full border text-[11px] font-semibold {{ $googleColor }}">
                                Google: {{ $googleLabel }}
                            </span>

                            <a href="{{ route('admin.users.index') }}"
                               class="inline-flex items-center px-4 py-2 rounded-full bg-green-900/80 text-green-50 text-xs font-semibold hover:bg-green-900">
                                ‹ Kembali
                            </a>
                        </div>
                    </div>
                </section>

                {{-- GRID DETAIL --}}
                <section class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                    {{-- KIRI: Info akun & statistik --}}
                    <div class="lg:col-span-2 space-y-6">

                        {{-- Info Akun --}}
                        <div class="bg-green-800/90 border border-green-700/70 rounded-3xl p-6 shadow-xl">
                            <h2 class="text-sm font-semibold text-white mb-3">Informasi Akun</h2>

                            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-3 text-xs text-green-100/85">
                                <div>
                                    <dt class="text-green-200/70">Nama</dt>
                                    <dd class="font-semibold">{{ $name }}</dd>
                                </div>
                                <div>
                                    <dt class="text-green-200/70">Email</dt>
                                    <dd class="font-semibold">{{ $email }}</dd>
                                </div>
                                <div>
                                    <dt class="text-green-200/70">Role</dt>
                                    <dd class="font-semibold">{{ $roleLabel }}</dd>
                                </div>
                                <div>
                                    <dt class="text-green-200/70">Status Akun</dt>
                                    <dd class="font-semibold">{{ $statusLabel }}</dd>
                                </div>
                                <div>
                                    <dt class="text-green-200/70">Terdaftar Pada</dt>
                                    <dd class="font-semibold">{{ $createdFormatted }}</dd>
                                </div>
                                <div>
                                    <dt class="text-green-200/70">Terakhir Diupdate</dt>
                                    <dd class="font-semibold">{{ $updatedFormatted }}</dd>
                                </div>
                            </dl>
                        </div>

                        {{-- Statistik Pesanan --}}
                        <div class="bg-green-800/90 border border-green-700/70 rounded-3xl p-6 shadow-xl">
                            <h2 class="text-sm font-semibold text-white mb-3">Aktivitas Pesanan</h2>

                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs text-green-100/80">
                                <div class="rounded-2xl bg-green-900/60 border border-green-600/70 px-4 py-3 flex flex-col gap-1">
                                    <p class="text-[11px] text-green-200/80">Jumlah Pesanan</p>
                                    <p class="text-lg font-semibold text-yellow-300">{{ $ordersCount }}</p>
                                </div>

                                <div class="rounded-2xl bg-green-900/60 border border-green-600/70 px-4 py-3 flex flex-col gap-1">
                                    <p class="text-[11px] text-green-200/80">Total Belanja</p>
                                    <p class="text-lg font-semibold text-yellow-300">
                                        Rp {{ number_format($ordersTotal, 0, ',', '.') }}
                                    </p>
                                </div>

                                <div class="rounded-2xl bg-green-900/60 border border-green-600/70 px-4 py-3 flex flex-col gap-1">
                                    <p class="text-[11px] text-green-200/80">Pesanan Terakhir</p>
                                    <p class="text-xs font-semibold text-green-100">
                                        {{ $lastOrderFormatted }}
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- KANAN: Google & Aksi Admin --}}
                    <div class="space-y-6">

                        {{-- Info Google --}}
                        <div class="bg-green-800/90 border border-green-700/70 rounded-3xl p-5 shadow-xl">
                            <h2 class="text-sm font-semibold text-white mb-3">Integrasi Google</h2>

                            <p class="text-xs text-green-100/80 mb-2">
                                Status: <span class="font-semibold">{{ $googleLabel }}</span>
                            </p>

                            @if ($google_id)
                                <p class="text-[11px] text-green-100/70 mb-2">
                                    Pengguna ini telah menghubungkan akun Google-nya.
                                </p>
                                <p class="text-[11px] text-green-100/60">
                                    ID Google: <span class="font-mono">{{ $google_id }}</span>
                                </p>
                            @else
                                <p class="text-[11px] text-green-100/70">
                                    Pengguna ini belum menghubungkan akun Google.
                                </p>
                            @endif
                        </div>

                        {{-- Aksi Admin (FINALIZED) --}}
                        @if ($u->id !== $admin->id) {{-- Cek: Jangan edit diri sendiri --}}
                            <div class="bg-green-800/90 border border-green-700/70 rounded-3xl p-5 shadow-xl">
                                <h2 class="text-sm font-semibold text-white mb-3">Aksi Admin</h2>

                                <div class="flex flex-col gap-2 text-xs">
                                    
                                    {{-- Form Ubah Role --}}
                                    <form action="{{ route('admin.users.updateRole', $u->id) }}" method="POST"
                                          onsubmit="return confirm('Apakah Anda yakin ingin mengubah role pengguna ini?');">
                                        @csrf
                                        @method('PATCH')

                                        @if ($role !== 'admin')
                                            <button type="submit"
                                                    class="w-full inline-flex items-center justify-center px-4 py-2 rounded-full bg-purple-500/20 text-purple-100 border border-purple-400/50 hover:bg-purple-500/30 transition font-semibold">
                                                Jadikan Admin
                                            </button>
                                        @else
                                            <button type="submit"
                                                    class="w-full inline-flex items-center justify-center px-4 py-2 rounded-full bg-yellow-500/20 text-yellow-100 border border-yellow-400/50 hover:bg-yellow-500/30 transition font-semibold">
                                                Turunkan ke Pengguna Biasa
                                            </button>
                                        @endif
                                    </form>

                                    {{-- Form Ubah Status --}}
                                    <form action="{{ route('admin.users.updateStatus', $u->id) }}" method="POST"
                                          onsubmit="return confirm('Apakah Anda yakin ingin mengubah status pengguna ini?');">
                                        @csrf
                                        @method('PATCH')

                                        @if ($status === 'active')
                                            <button type="submit"
                                                    class="w-full inline-flex items-center justify-center px-4 py-2 rounded-full bg-red-500/20 text-red-100 border border-red-400/50 hover:bg-red-500/30 transition font-semibold">
                                                Nonaktifkan Akun
                                            </button>
                                        @else
                                            <button type="submit"
                                                    class="w-full inline-flex items-center justify-center px-4 py-2 rounded-full bg-emerald-500/20 text-emerald-100 border border-emerald-400/50 hover:bg-emerald-500/30 transition font-semibold">
                                                Aktifkan Akun
                                            </button>
                                        @endif
                                    </form>

                                </div>

                                <p class="text-[10px] text-green-100/50 mt-3 text-center">
                                    Perubahan akan langsung diterapkan pada akun pengguna.
                                </p>
                            </div>
                        @endif

                    </div>

                </section>

            </main>

        </div>
    </div>

</body>

</html>