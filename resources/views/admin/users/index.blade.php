<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengguna - Admin KaloriKita</title>

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
         * Struktur yang diharapkan:
         *
         * $users = [
         *   [
         *     'id'         => 1,
         *     'name'       => 'Ibnu Effendi',
         *     'email'      => 'ibnu@example.com',
         *     'role'       => 'user', // user / admin
         *     'status'     => 'active', // active / inactive
         *     'created_at' => '2025-12-01 10:23',
         *     'google_id'  => null,
         *   ],
         *   ...
         * ]
         *
         * atau bisa juga langsung Collection Eloquent User
         */

        /** @var iterable $users */
        $users = $users ?? [];

        // helper kecil supaya aman array / object
        function u_get($u, $key, $default = null) {
            if (is_array($u)) {
                return $u[$key] ?? $default;
            }
            if (is_object($u)) {
                return $u->{$key} ?? $default;
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

                {{-- HEADER + FILTER --}}
                <section class="bg-green-800/90 border border-green-700/70 rounded-3xl p-6 shadow-xl">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-4">
                        <div>
                            <h1 class="text-xl sm:text-2xl font-semibold text-white">Data Pengguna</h1>
                            <p class="text-xs text-green-100/70 mt-1">
                                Kelola akun pengguna KaloriKita: role, status, dan akses mereka.
                            </p>
                        </div>

                        <div class="flex flex-wrap gap-3 text-xs">
                            <div
                                class="px-3 py-2 rounded-2xl bg-green-900/70 border border-green-600/70 text-green-100/90">
                                <p class="text-[10px] uppercase tracking-wide text-green-200/70">Total Pengguna</p>
                                <p class="font-semibold text-sm">{{ is_countable($users) ? count($users) : '-' }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Filter bar (static UI, backend bisa disambung nanti) --}}
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-3 mt-2 text-xs">
                        <div>
                            <label class="block text-green-100/80 mb-1">Cari</label>
                            <div class="relative">
                                <input type="text" placeholder="Nama atau email..."
                                       class="w-full rounded-2xl border border-green-600/60 bg-green-900/60 text-green-50 px-3 py-2 text-xs placeholder:text-green-200/40 focus:outline-none focus:ring-1 focus:ring-yellow-300">
                                <span class="absolute inset-y-0 right-3 flex items-center text-[11px] text-green-200/60">⌕</span>
                            </div>
                        </div>

                        <div>
                            <label class="block text-green-100/80 mb-1">Role</label>
                            <select
                                class="w-full rounded-2xl border border-green-600/60 bg-green-900/60 text-green-50 px-3 py-2 text-xs focus:outline-none focus:ring-1 focus:ring-yellow-300">
                                <option value="">Semua</option>
                                <option value="user">Pengguna</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-green-100/80 mb-1">Status</label>
                            <select
                                class="w-full rounded-2xl border border-green-600/60 bg-green-900/60 text-green-50 px-3 py-2 text-xs focus:outline-none focus:ring-1 focus:ring-yellow-300">
                                <option value="">Semua</option>
                                <option value="active">Aktif</option>
                                <option value="inactive">Nonaktif</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-green-100/80 mb-1">Urutkan</label>
                            <select
                                class="w-full rounded-2xl border border-green-600/60 bg-green-900/60 text-green-50 px-3 py-2 text-xs focus:outline-none focus:ring-1 focus:ring-yellow-300">
                                <option value="newest">Terbaru</option>
                                <option value="oldest">Terlama</option>
                                <option value="name_asc">Nama A-Z</option>
                                <option value="name_desc">Nama Z-A</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-4 flex justify-end">
                        <button
                            class="inline-flex items-center gap-2 rounded-full bg-yellow-400 text-green-900 px-4 py-2 text-xs font-semibold hover:bg-yellow-300 transition">
                            Terapkan Filter
                        </button>
                    </div>
                </section>

                {{-- TABEL PENGGUNA --}}
                <section class="bg-green-800/90 border border-green-700/70 rounded-3xl p-4 sm:p-6 shadow-xl">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-sm font-semibold text-white">Daftar Pengguna</h2>
                        <span class="text-[11px] text-green-100/70">
                            Menampilkan {{ is_countable($users) ? count($users) : 0 }} pengguna
                        </span>
                    </div>

                    @if (!is_countable($users) || count($users) === 0)
                        <div
                            class="border border-dashed border-green-600/80 rounded-2xl p-6 text-center text-xs text-green-100/80">
                            <p>Belum ada data pengguna.</p>
                            <p class="text-green-100/60 mt-1">
                                Pengguna yang mendaftar akan muncul di sini.
                            </p>
                        </div>
                    @else
                        <div class="overflow-x-auto scroll-thin">
                            <table class="min-w-full text-xs text-left text-green-50">
                                <thead>
                                    <tr class="border-b border-green-700/80 text-[11px] uppercase text-green-200/80">
                                        <th class="py-2 pr-4">Pengguna</th>
                                        <th class="py-2 pr-4">Role</th>
                                        <th class="py-2 pr-4">Status</th>
                                        <th class="py-2 pr-4">Google</th>
                                        <th class="py-2 pr-4">Tanggal Gabung</th>
                                        <th class="py-2 pr-4 text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-green-700/70">
                                    @foreach ($users as $u)
                                        @php
                                            $name   = u_get($u, 'name', 'Pengguna');
                                            $email  = u_get($u, 'email', '-');
                                            $role   = u_get($u, 'role', 'user');
                                            $status = u_get($u, 'status', 'active');
                                            $gid    = u_get($u, 'google_id', null);
                                            $joined = u_get($u, 'created_at', null);

                                            // format tanggal kalau object Carbon
                                            if ($joined instanceof \Carbon\Carbon) {
                                                $joinedFormatted = $joined->format('d M Y H:i');
                                            } else {
                                                $joinedFormatted = $joined ? date('d M Y H:i', strtotime($joined)) : '-';
                                            }

                                            $roleLabel = $role === 'admin' ? 'Admin' : 'Pengguna';
                                            $roleColor = $role === 'admin'
                                                ? 'bg-purple-400/20 text-purple-200 border-purple-400/40'
                                                : 'bg-green-400/20 text-green-200 border-green-400/40';

                                            $statusLabel = $status === 'inactive' ? 'Nonaktif' : 'Aktif';
                                            $statusColor = $status === 'inactive'
                                                ? 'bg-red-400/20 text-red-200 border-red-400/40'
                                                : 'bg-emerald-400/20 text-emerald-200 border-emerald-400/40';

                                            $googleLabel = $gid ? 'Terhubung' : 'Belum';
                                            $googleColor = $gid
                                                ? 'bg-sky-400/20 text-sky-200 border-sky-400/40'
                                                : 'bg-slate-400/10 text-slate-200 border-slate-400/30';

                                            $id = u_get($u, 'id', null);
                                        @endphp
                                        <tr class="hover:bg-green-900/40 transition">
                                            <td class="py-3 pr-4 align-top">
                                                <p class="font-semibold text-[13px]">
                                                    {{ $name }}
                                                </p>
                                                <p class="text-[11px] text-green-200/70">
                                                    {{ $email }}
                                                </p>
                                            </td>

                                            <td class="py-3 pr-4 align-top">
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full border text-[11px] font-semibold {{ $roleColor }}">
                                                    {{ $roleLabel }}
                                                </span>
                                            </td>

                                            <td class="py-3 pr-4 align-top">
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full border text-[11px] font-semibold {{ $statusColor }}">
                                                    {{ $statusLabel }}
                                                </span>
                                            </td>

                                            <td class="py-3 pr-4 align-top">
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full border text-[11px] font-semibold {{ $googleColor }}">
                                                    {{ $googleLabel }}
                                                </span>
                                            </td>

                                            <td class="py-3 pr-4 align-top">
                                                <p class="text-[11px] text-green-100/80">
                                                    {{ $joinedFormatted }}
                                                </p>
                                            </td>

                                            <td class="py-3 pr-0 align-top">
                                                <div class="flex items-center justify-end gap-2">
                                                    {{-- Nanti bisa diarahkan ke route detail user kalau kamu buat --}}
                                                    {{-- <a href="{{ route('admin.users.show', $id) }}" ...> --}}
                                                    <button
                                                        class="inline-flex items-center px-3 py-1 rounded-full bg-white/10 text-[11px] text-green-50 border border-green-500/60 hover:bg-white/20 transition">
                                                        Detail
                                                    </button>

                                                    {{-- Placeholder tindakan role/status, nanti bisa pakai route POST/PUT --}}
                                                    @if ($role !== 'admin')
                                                        <button
                                                            class="inline-flex items-center px-3 py-1 rounded-full bg-purple-500/20 text-[11px] text-purple-100 border border-purple-400/40 hover:bg-purple-500/30 transition">
                                                            Jadikan Admin
                                                        </button>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination placeholder --}}
                        <div class="mt-4 flex items-center justify-between text-[11px] text-green-100/70">
                            <p>Pagination bisa ditambahkan di sini (Laravel paginate()).</p>
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
