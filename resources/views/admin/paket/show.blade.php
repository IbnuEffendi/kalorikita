<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Paket Katering - Admin KaloriKita</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body { font-family: 'Instrument Sans', sans-serif; }
        .scroll-thin::-webkit-scrollbar { height: 6px; width: 6px; }
        .scroll-thin::-webkit-scrollbar-thumb { background-color: rgba(251, 191, 36, 0.5); border-radius: 999px; }
    </style>
</head>

<body class="bg-green-700/60 min-h-screen">

    <x-navbar></x-navbar>

    @php
        $user = auth()->user();
        $status = $package->status ?? 'inactive';
        $statusColor = $status === 'active' ? 'bg-emerald-400/20 text-emerald-200 border-emerald-400/40' : 'bg-red-400/20 text-red-200 border-red-400/40';
    @endphp

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="flex flex-col lg:flex-row gap-6">

            {{-- SIDEBAR ADMIN --}}
            <aside class="w-full lg:w-64 bg-green-800/90 border border-green-700/70 rounded-3xl p-6 h-max flex-shrink-0 flex flex-col">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-10 h-10 rounded-2xl bg-yellow-400 text-green-900 flex items-center justify-center font-extrabold shadow-md">
                        {{ strtoupper(mb_substr($user->name ?? 'A', 0, 1)) }}
                    </div>
                    <div>
                        <p class="text-sm font-bold text-white">{{ $user->name }}</p>
                        <p class="text-[11px] text-green-200/80">Admin</p>
                    </div>
                </div>
                <nav class="space-y-1 flex-1">
                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-3 rounded-xl text-sm font-medium text-green-100 hover:bg-green-700/50 transition">Dashboard</a>
                    <a href="{{ route('admin.orders.index') }}" class="block px-4 py-3 rounded-xl text-sm font-medium text-green-100 hover:bg-green-700/50 transition">Kelola Pesanan</a>
                    <a href="{{ route('admin.paket.index') }}" class="block px-4 py-3 rounded-xl text-sm font-bold bg-white text-green-900 shadow-lg">Paket Katering</a>
                    <a href="{{ route('admin.users.index') }}" class="block px-4 py-3 rounded-xl text-sm font-medium text-green-100 hover:bg-green-700/50 transition">Data Pengguna</a>
                    <a href="{{ route('admin.reports.index') }}" class="block px-4 py-3 rounded-xl text-sm font-medium text-green-100 hover:bg-green-700/50 transition">Laporan</a>
                    <a href="{{ route('admin.ai.logs') }}" class="block px-4 py-3 rounded-xl text-sm font-medium text-green-100 hover:bg-green-700/50 transition">Log KaloriLab (AI)</a>
                </nav>
                <div class="mt-8 pt-6 border-t border-green-700/40">
                    <a href="{{ route('profil.dashboard') }}" class="block text-xs text-green-200/70 hover:text-white mb-3 pl-1 transition">Masuk sebagai Pengguna</a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="w-full py-3 rounded-xl bg-[#4c4232] text-white/90 text-xs font-semibold hover:bg-[#3e3629] transition shadow-md">Logout</button>
                    </form>
                </div>
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
                                {{ $package->nama_kategori }}
                            </h1>
                            <p class="text-xs text-green-100/70 mt-1">
                                ID: {{ $package->id }} • Slug: {{ $package->slug }}
                            </p>
                        </div>

                        <div class="flex flex-wrap gap-2 justify-end">
                            <span class="inline-flex px-3 py-1 rounded-full border text-[11px] font-semibold {{ $statusColor }}">
                                {{ $status === 'active' ? 'Aktif' : 'Tidak Aktif' }}
                            </span>

                            <a href="{{ route('admin.paket.edit', $package->id) }}"
                               class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 text-green-50 text-xs font-semibold border border-green-500/70 hover:bg-white/20">
                                Edit Info Paket
                            </a>

                            <a href="{{ route('admin.paket.index') }}"
                               class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-green-900/80 text-green-50 text-xs font-semibold hover:bg-green-900">
                                ‹ Kembali
                            </a>
                        </div>
                    </div>
                </section>

                <section class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                    {{-- KIRI: Info & Opsi Harga --}}
                    <div class="lg:col-span-1 space-y-6">

                        {{-- Card utama paket --}}
                        <div class="bg-green-800/90 border border-green-700/70 rounded-3xl p-6 shadow-xl">
                            <div class="flex flex-col gap-5">
                                <div>
                                    @if (!empty($package->gambar))
                                        <div class="overflow-hidden rounded-2xl border border-green-700/70 w-full h-40">
                                            <img src="{{ asset('storage/' . $package->gambar) }}" class="w-full h-full object-cover">
                                        </div>
                                    @else
                                        <div class="w-full h-40 rounded-2xl border border-dashed border-green-600/70 flex items-center justify-center text-[11px] text-green-100/60">
                                            Tidak ada gambar.
                                        </div>
                                    @endif
                                </div>

                                <div class="space-y-3 text-xs text-green-100/85">
                                    <div>
                                        <p class="text-green-200/70 text-[11px] uppercase font-bold">Deskripsi</p>
                                        <p class="leading-relaxed whitespace-pre-line mt-1">{{ $package->deskripsi }}</p>
                                    </div>

                                    <div>
                                        <p class="text-green-200/70 text-[11px] uppercase font-bold mb-1">Keuntungan</p>
                                        <div class="flex flex-wrap gap-2">
                                            @if(is_array($package->keuntungan) || is_object($package->keuntungan))
                                                @foreach($package->keuntungan as $fitur)
                                                    <span class="px-2 py-1 bg-green-900/50 border border-green-600/50 rounded-lg text-[10px] text-green-100">
                                                        <i class="bi bi-check2 text-yellow-400 mr-1"></i> {{ $fitur }}
                                                    </span>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- CARD: KELOLA OPSI DURASI --}}
                        <div class="bg-green-900/80 border border-green-600/50 rounded-3xl p-5 shadow-xl">
                            <h3 class="text-white font-bold text-sm mb-4 flex items-center gap-2">
                                <i class="bi bi-tag-fill text-yellow-400"></i> Opsi Durasi & Harga
                            </h3>

                            {{-- List Opsi --}}
                            <div class="space-y-2 mb-4">
                                @foreach($package->options as $opt)
                                    <div class="flex justify-between items-center p-3 bg-green-800/50 rounded-xl border border-green-700/50">
                                        <div>
                                            <p class="text-xs font-bold text-white">{{ $opt->durasi_hari }} Hari</p>
                                            <p class="text-[10px] text-green-300">{{ $opt->periode }}</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-xs font-bold text-yellow-300">Rp {{ number_format($opt->harga, 0, ',', '.') }}</p>
                                            
                                            {{-- PERBAIKAN: route admin.paket.options.destroy --}}
                                            <form action="{{ route('admin.paket.options.destroy', $opt->id) }}" method="POST" class="inline-block mt-1" onsubmit="return confirm('Hapus opsi ini?');">
                                                @csrf @method('DELETE')
                                                <button class="text-[9px] text-red-300 hover:text-red-100 hover:underline">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            {{-- Form Tambah Opsi --}}
                            <div class="pt-3 border-t border-green-700/50">
                                <p class="text-[10px] font-bold text-green-300 uppercase mb-2">Tambah Varian Baru</p>
                                
                                {{-- PERBAIKAN: route admin.paket.options.store --}}
                                <form action="{{ route('admin.paket.options.store') }}" method="POST" class="space-y-2">
                                    @csrf
                                    <input type="hidden" name="paket_category_id" value="{{ $package->id }}">
                                    
                                    <div class="grid grid-cols-2 gap-2">
                                        <input type="number" name="durasi_hari" required placeholder="Hari (Cth: 14)" class="w-full bg-green-900/40 border border-green-600/50 rounded-lg px-3 py-2 text-[10px] text-white placeholder-green-100/30 focus:outline-none focus:border-yellow-400">
                                        <input type="text" name="periode" required placeholder="Label (Cth: 2 Minggu)" class="w-full bg-green-900/40 border border-green-600/50 rounded-lg px-3 py-2 text-[10px] text-white placeholder-green-100/30 focus:outline-none focus:border-yellow-400">
                                    </div>
                                    <input type="number" name="harga" required placeholder="Harga (Cth: 550000)" class="w-full bg-green-900/40 border border-green-600/50 rounded-lg px-3 py-2 text-[10px] text-white placeholder-green-100/30 focus:outline-none focus:border-yellow-400">
                                    
                                    <button type="submit" class="w-full bg-yellow-400 text-green-900 text-[10px] font-bold py-2 rounded-lg hover:bg-yellow-300 transition shadow-md">
                                        + Tambah Opsi
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>

                    {{-- KANAN: Jadwal Menu --}}
                    <div class="lg:col-span-2 space-y-4">
                        <div class="bg-green-800/90 border border-green-700/70 rounded-3xl p-5 shadow-xl min-h-[500px] flex flex-col">
                            <div class="flex items-center justify-between mb-4 border-b border-green-700/50 pb-2">
                                <h2 class="text-sm font-semibold text-white">Jadwal Menu Terdaftar</h2>
                                <span class="bg-green-900 border border-green-600/50 text-green-100 text-[10px] px-2 py-1 rounded-lg font-bold">
                                    Total: {{ $schedules->count() }} Hari
                                </span>
                            </div>

                            <div class="bg-blue-900/30 border border-blue-500/30 rounded-xl p-3 mb-4 flex items-center gap-3">
                                <i class="bi bi-info-circle-fill text-blue-300 text-lg"></i>
                                <div>
                                    <p class="text-[11px] text-blue-100">
                                        Ingin mengatur menu harian? Silakan ke menu 
                                        <a href="{{ route('admin.paket.schedules') }}" class="font-bold text-yellow-300 hover:underline">Kelola Batch</a>.
                                    </p>
                                </div>
                            </div>

                            <div class="overflow-x-auto flex-1 scroll-thin">
                                <table class="w-full text-left text-xs text-green-100">
                                    <thead class="bg-green-900/50 text-green-300 uppercase font-bold text-[10px] tracking-wider border-b border-green-700/50">
                                        <tr>
                                            <th class="px-4 py-3">Tanggal</th>
                                            <th class="px-4 py-3">Siang</th>
                                            <th class="px-4 py-3">Malam</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-green-700/30">
                                        @forelse($schedules as $jadwal)
                                        <tr class="hover:bg-green-900/20 transition">
                                            <td class="px-4 py-3 font-bold text-white whitespace-nowrap">
                                                {{ \Carbon\Carbon::parse($jadwal->schedule_date)->translatedFormat('d F Y') }}
                                            </td>
                                            <td class="px-4 py-3">
                                                <div class="flex items-center gap-2">
                                                    <i class="bi bi-sun text-yellow-400"></i>
                                                    {{ $jadwal->lunchMenu->nama_menu ?? '-' }}
                                                </div>
                                            </td>
                                            <td class="px-4 py-3">
                                                <div class="flex items-center gap-2">
                                                    <i class="bi bi-moon-stars text-indigo-300"></i>
                                                    {{ $jadwal->dinnerMenu->nama_menu ?? '-' }}
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="3" class="px-4 py-12 text-center text-green-200/40">
                                                <i class="bi bi-calendar-x text-3xl mb-2 opacity-50 block"></i>
                                                <span class="text-xs">Belum ada jadwal menu untuk paket ini.</span>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </section>

            </main>

        </div>
    </div>

    @if(session('success'))
        <div class="fixed bottom-4 right-4 bg-emerald-600 text-white px-6 py-3 rounded-xl shadow-2xl animate-bounce text-xs font-bold z-50">
            <i class="bi bi-check-circle mr-2"></i> {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="fixed bottom-4 right-4 bg-red-600 text-white px-6 py-3 rounded-xl shadow-2xl z-50 text-xs font-bold">
            <i class="bi bi-x-circle mr-2"></i> {{ session('error') }}
        </div>
    @endif

</body>
</html>