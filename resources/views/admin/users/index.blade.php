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
        // Fallback agar tidak error jika variabel controller belum dikirim
        $users = $users ?? collect([]);
        $totalUsers = $totalUsers ?? 0;
    @endphp

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="flex flex-col lg:flex-row gap-6">

            {{-- SIDEBAR ADMIN --}}
            <aside class="w-full lg:w-64 bg-green-800/90 border border-green-700/70 rounded-3xl p-5 h-max">

                {{-- Profil mini --}}
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-2xl bg-yellow-400 text-green-900 flex items-center justify-center font-extrabold">
                        {{ strtoupper(substr($admin->name ?? 'A', 0, 1)) }}
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
                            <div class="px-3 py-2 rounded-2xl bg-green-900/70 border border-green-600/70 text-green-100/90">
                                <p class="text-[10px] uppercase tracking-wide text-green-200/70">Total Pengguna</p>
                                <p class="font-semibold text-sm">{{ number_format($totalUsers, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Form Filter --}}
                    <form action="{{ route('admin.users.index') }}" method="GET">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-3 mt-2 text-xs">
                            <div>
                                <label class="block text-green-100/80 mb-1">Cari</label>
                                <div class="relative">
                                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Nama atau email..."
                                           class="w-full rounded-2xl border border-green-600/60 bg-green-900/60 text-green-50 px-3 py-2 text-xs placeholder:text-green-200/40 focus:outline-none focus:ring-1 focus:ring-yellow-300">
                                    <span class="absolute inset-y-0 right-3 flex items-center text-[11px] text-green-200/60">⌕</span>
                                </div>
                            </div>

                            <div>
                                <label class="block text-green-100/80 mb-1">Role</label>
                                <select name="role" class="w-full rounded-2xl border border-green-600/60 bg-green-900/60 text-green-50 px-3 py-2 text-xs focus:outline-none focus:ring-1 focus:ring-yellow-300">
                                    <option value="">Semua</option>
                                    <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>Pengguna</option>
                                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-green-100/80 mb-1">Status</label>
                                <select name="status" class="w-full rounded-2xl border border-green-600/60 bg-green-900/60 text-green-50 px-3 py-2 text-xs focus:outline-none focus:ring-1 focus:ring-yellow-300">
                                    <option value="">Semua</option>
                                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-green-100/80 mb-1">Urutkan</label>
                                <select name="sort" class="w-full rounded-2xl border border-green-600/60 bg-green-900/60 text-green-50 px-3 py-2 text-xs focus:outline-none focus:ring-1 focus:ring-yellow-300">
                                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                                    <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nama A-Z</option>
                                    <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Nama Z-A</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-4 flex justify-end">
                            <button type="submit" class="inline-flex items-center gap-2 rounded-full bg-yellow-400 text-green-900 px-4 py-2 text-xs font-semibold hover:bg-yellow-300 transition">
                                Terapkan Filter
                            </button>
                        </div>
                    </form>
                </section>

                {{-- TABEL PENGGUNA --}}
                <section class="bg-green-800/90 border border-green-700/70 rounded-3xl p-4 sm:p-6 shadow-xl">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-sm font-semibold text-white">Daftar Pengguna</h2>
                        <span class="text-[11px] text-green-100/70">
                            Menampilkan {{ $users->count() }} dari {{ $users->total() }} pengguna
                        </span>
                    </div>

                    @if ($users->isEmpty())
                        <div class="border border-dashed border-green-600/80 rounded-2xl p-6 text-center text-xs text-green-100/80">
                            <p>Data pengguna tidak ditemukan.</p>
                            <p class="text-green-100/60 mt-1">
                                Coba ubah kata kunci pencarian atau filter Anda.
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
                                            // LOGIC TAMPILAN
                                            $roleLabel = $u->role === 'admin' ? 'Admin' : 'Pengguna';
                                            $roleColor = $u->role === 'admin'
                                                ? 'bg-purple-400/20 text-purple-200 border-purple-400/40'
                                                : 'bg-green-400/20 text-green-200 border-green-400/40';

                                            $status = $u->status ?? 'active';
                                            $statusLabel = $status === 'inactive' ? 'Nonaktif' : 'Aktif';
                                            $statusColor = $status === 'inactive'
                                                ? 'bg-red-400/20 text-red-200 border-red-400/40'
                                                : 'bg-emerald-400/20 text-emerald-200 border-emerald-400/40';

                                            $googleLabel = $u->google_id ? 'Terhubung' : 'Belum';
                                            $googleColor = $u->google_id
                                                ? 'bg-sky-400/20 text-sky-200 border-sky-400/40'
                                                : 'bg-slate-400/10 text-slate-200 border-slate-400/30';
                                            
                                            $joinDate = optional($u->created_at)->format('d M Y H:i') ?? '-';
                                        @endphp
                                        <tr class="hover:bg-green-900/40 transition">
                                            <td class="py-3 pr-4 align-top">
                                                <p class="font-semibold text-[13px]">{{ $u->name }}</p>
                                                <p class="text-[11px] text-green-200/70">{{ $u->email }}</p>
                                            </td>

                                            <td class="py-3 pr-4 align-top">
                                                <span class="inline-flex items-center px-3 py-1 rounded-full border text-[11px] font-semibold {{ $roleColor }}">
                                                    {{ $roleLabel }}
                                                </span>
                                            </td>

                                            <td class="py-3 pr-4 align-top">
                                                <span class="inline-flex items-center px-3 py-1 rounded-full border text-[11px] font-semibold {{ $statusColor }}">
                                                    {{ $statusLabel }}
                                                </span>
                                            </td>

                                            <td class="py-3 pr-4 align-top">
                                                <span class="inline-flex items-center px-3 py-1 rounded-full border text-[11px] font-semibold {{ $googleColor }}">
                                                    {{ $googleLabel }}
                                                </span>
                                            </td>

                                            <td class="py-3 pr-4 align-top">
                                                <p class="text-[11px] text-green-100/80">{{ $joinDate }}</p>
                                            </td>

                                            {{-- KOLOM AKSI (FINALIZED) --}}
                                            <td class="py-3 pr-0 align-top">
                                                <div class="flex items-center justify-end gap-2">
                                                    {{-- Tombol Detail --}}
                                                    <a href="{{ route('admin.users.show', $u->id) }}"
                                                       class="inline-flex items-center px-3 py-1 rounded-full bg-white/10 text-[11px] text-green-50 border border-green-500/60 hover:bg-white/20 transition">
                                                        Detail
                                                    </a>

                                                    {{-- Tombol Ubah Role (Hanya muncul jika bukan diri sendiri) --}}
                                                    @if ($u->id !== auth()->id())
                                                        <form action="{{ route('admin.users.updateRole', $u->id) }}" method="POST"
                                                              onsubmit="return confirm('Apakah Anda yakin ingin mengubah role pengguna ini?');">
                                                            @csrf
                                                            @method('PATCH')

                                                            @if ($u->role === 'admin')
                                                                <button type="submit"
                                                                        class="inline-flex items-center px-3 py-1 rounded-full bg-yellow-500/20 text-[11px] text-yellow-100 border border-yellow-400/40 hover:bg-yellow-500/30 transition">
                                                                    Turunkan User
                                                                </button>
                                                            @else
                                                                <button type="submit"
                                                                        class="inline-flex items-center px-3 py-1 rounded-full bg-purple-500/20 text-[11px] text-purple-100 border border-purple-400/40 hover:bg-purple-500/30 transition">
                                                                    Jadikan Admin
                                                                </button>
                                                            @endif
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination Custom --}}
                        <div class="mt-4 flex items-center justify-between text-[11px] text-green-100/70">
                            <p>
                                Halaman {{ $users->currentPage() }} dari {{ $users->lastPage() }}
                            </p>
                            <div class="flex gap-1">
                                @if ($users->onFirstPage())
                                    <span class="px-3 py-1 rounded-full bg-green-900/40 border border-green-800 text-green-100/50 cursor-not-allowed">‹</span>
                                @else
                                    <a href="{{ $users->previousPageUrl() }}" class="px-3 py-1 rounded-full bg-green-900/70 border border-green-600/70 hover:bg-green-900 text-green-100">‹</a>
                                @endif

                                <span class="px-3 py-1 rounded-full bg-yellow-400 text-green-900 font-semibold">
                                    {{ $users->currentPage() }}
                                </span>

                                @if ($users->hasMorePages())
                                    <a href="{{ $users->nextPageUrl() }}" class="px-3 py-1 rounded-full bg-green-900/70 border border-green-600/70 hover:bg-green-900 text-green-100">›</a>
                                @else
                                    <span class="px-3 py-1 rounded-full bg-green-900/40 border border-green-800 text-green-100/50 cursor-not-allowed">›</span>
                                @endif
                            </div>
                        </div>
                    @endif
                </section>

            </main>

        </div>
    </div>

</body>

</html>