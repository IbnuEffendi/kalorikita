<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Batch - Admin KaloriKita</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body { font-family: 'Instrument Sans', sans-serif; }
        .scroll-thin::-webkit-scrollbar { height: 6px; width: 6px; }
        .scroll-thin::-webkit-scrollbar-thumb { background-color: rgba(251, 191, 36, 0.5); border-radius: 999px; }
        
        select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%23ffffff' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.5rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
        }
        
        input[type="date"]::-webkit-calendar-picker-indicator {
            filter: invert(1);
            cursor: pointer;
        }
    </style>
</head>

<body class="bg-green-700/60 min-h-screen">

    <x-navbar></x-navbar>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="flex flex-col lg:flex-row gap-6">

            {{-- SIDEBAR --}}
            <aside class="w-full lg:w-64 bg-green-800/90 border border-green-700/70 rounded-3xl p-6 h-max flex-shrink-0 flex flex-col">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-10 h-10 rounded-2xl bg-yellow-400 text-green-900 flex items-center justify-center font-extrabold shadow-md">
                        {{ strtoupper(mb_substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <div>
                        <p class="text-sm font-bold text-white">{{ auth()->user()->name }}</p>
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
                    <form action="{{ route('logout') }}" method="POST">@csrf <button class="w-full py-3 rounded-xl bg-[#4c4232] text-white/90 text-xs font-semibold hover:bg-[#3e3629] transition shadow-md">Logout</button></form>
                </div>
            </aside>

            {{-- KONTEN UTAMA --}}
            <main class="flex-1 space-y-6">

                {{-- HEADER + TABS --}}
                <section class="bg-green-800/90 border border-green-700/70 rounded-3xl p-6 shadow-xl relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-6 opacity-10 pointer-events-none">
                        <i class="bi bi-calendar-week text-[8rem] text-white"></i>
                    </div>

                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 mb-6 relative z-10">
                        <div>
                            <h1 class="text-2xl font-bold text-white tracking-tight">Kelola Batch & Jadwal</h1>
                            <p class="text-xs text-green-200/80 mt-1">Atur menu makan siang & malam berdasarkan tanggal.</p>
                        </div>
                        <a href="{{ route('admin.paket.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-green-900/50 text-green-100 text-[10px] font-semibold border border-green-600/50 hover:bg-green-900 hover:text-white transition">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                    </div>

                    {{-- TABS --}}
                    <div class="flex flex-wrap items-center gap-2 relative z-10 border-t border-green-700/50 pt-4">
                        <a href="{{ route('admin.paket.index') }}" class="px-4 py-2 rounded-xl text-green-100 hover:bg-green-700/40 hover:text-white text-xs font-medium transition flex items-center gap-2">
                            <i class="bi bi-grid-fill"></i> Daftar Paket
                        </a>
                        <a href="{{ route('admin.paket.menus') }}" class="px-4 py-2 rounded-xl text-green-100 hover:bg-green-700/40 hover:text-white text-xs font-medium transition flex items-center gap-2">
                            <i class="bi bi-egg-fried"></i> Kelola Menu
                        </a>
                        <a href="{{ route('admin.paket.schedules') }}" class="px-4 py-2 rounded-xl bg-white text-green-900 text-xs font-bold shadow-md flex items-center gap-2">
                            <i class="bi bi-calendar-week"></i> Kelola Batch
                        </a>
                    </div>
                </section>

                <section class="grid grid-cols-1 xl:grid-cols-3 gap-6">
                    
                    {{-- FORM INPUT JADWAL --}}
                    <div class="xl:col-span-1">
                        <div class="bg-green-800/90 border border-green-700/70 rounded-3xl p-6 shadow-lg sticky top-6">
                            <h3 class="font-bold text-white mb-5 flex items-center gap-2 text-sm">
                                <i class="bi bi-plus-circle-fill text-yellow-400"></i> Buat Jadwal Baru
                            </h3>

                            @if(session('success'))
                                <div class="bg-emerald-500/20 border border-emerald-500/50 text-emerald-100 p-3 rounded-xl text-[10px] mb-4 flex items-center gap-2">
                                    <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                                </div>
                            @endif
                            @if(session('error'))
                                <div class="bg-red-500/20 border border-red-500/50 text-red-100 p-3 rounded-xl text-[10px] mb-4 flex items-center gap-2">
                                    <i class="bi bi-exclamation-circle-fill"></i> {{ session('error') }}
                                </div>
                            @endif

                            <form action="{{ route('admin.paket.schedules.store') }}" method="POST" class="space-y-4">
                                @csrf
                                <div>
                                    <label class="block text-[10px] font-bold text-green-300 uppercase mb-1">Pilih Paket</label>
                                    <select name="paket_category_id" required class="w-full bg-green-900/40 border border-green-600/50 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-yellow-400 cursor-pointer">
                                        <option value="" class="bg-green-900">-- Pilih Paket --</option>
                                        @foreach($packets as $p)
                                            <option value="{{ $p->id }}" class="bg-green-900">{{ $p->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-[10px] font-bold text-green-300 uppercase mb-1">Tanggal</label>
                                    <input type="date" name="schedule_date" required class="w-full bg-green-900/40 border border-green-600/50 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-yellow-400 cursor-pointer">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-bold text-green-300 uppercase mb-1">Menu Siang</label>
                                    <select name="lunch_menu_id" required class="w-full bg-green-900/40 border border-green-600/50 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-yellow-400 cursor-pointer">
                                        <option value="" class="bg-green-900">-- Pilih Menu --</option>
                                        @foreach($menus as $m)
                                            <option value="{{ $m->id }}" class="bg-green-900">{{ $m->nama_menu }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-[10px] font-bold text-green-300 uppercase mb-1">Menu Malam</label>
                                    <select name="dinner_menu_id" required class="w-full bg-green-900/40 border border-green-600/50 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-yellow-400 cursor-pointer">
                                        <option value="" class="bg-green-900">-- Pilih Menu --</option>
                                        @foreach($menus as $m)
                                            <option value="{{ $m->id }}" class="bg-green-900">{{ $m->nama_menu }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="w-full bg-yellow-400 hover:bg-yellow-300 text-green-900 font-bold py-2.5 rounded-xl transition shadow-lg flex justify-center items-center gap-2 mt-2 text-xs">
                                    <i class="bi bi-save"></i> Simpan ke Batch
                                </button>
                            </form>
                        </div>
                    </div>

                    {{-- TABEL RIWAYAT JADWAL --}}
                    <div class="xl:col-span-2">
                        <div class="bg-green-800/90 border border-green-700/70 rounded-3xl shadow-lg overflow-hidden min-h-[500px] flex flex-col">
                            <div class="px-6 py-4 border-b border-green-700/50 bg-green-900/30 flex justify-between items-center">
                                <h3 class="font-bold text-white text-sm">Jadwal Terdaftar</h3>
                                <span class="bg-green-900 border border-green-600/50 text-green-100 text-[10px] px-2 py-1 rounded-lg font-bold">
                                    Total: {{ $schedules->count() }}
                                </span>
                            </div>
                            
                            <div class="overflow-x-auto flex-1 scroll-thin">
                                <table class="w-full text-left text-xs text-green-100">
                                    <thead class="bg-green-900/50 text-green-300 uppercase font-bold text-[10px] tracking-wider border-b border-green-700/50">
                                        <tr>
                                            <th class="px-6 py-3">Tanggal</th>
                                            <th class="px-6 py-3">Paket</th>
                                            <th class="px-6 py-3">Siang</th>
                                            <th class="px-6 py-3">Malam</th>
                                            <th class="px-6 py-3 text-right">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-green-700/30">
                                        @forelse($schedules as $s)
                                        <tr class="hover:bg-green-900/20 transition duration-150 group">
                                            <td class="px-6 py-4 font-bold text-white whitespace-nowrap">
                                                {{ \Carbon\Carbon::parse($s->schedule_date)->translatedFormat('d M Y') }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <span class="inline-block bg-yellow-400/10 border border-yellow-400/30 text-yellow-200 text-[10px] px-2 py-0.5 rounded-md font-bold uppercase tracking-wide">
                                                    {{ $s->paketCategory->nama_kategori ?? '-' }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="flex items-center gap-2">
                                                    <i class="bi bi-sun text-orange-400"></i>
                                                    <span class="truncate max-w-[120px]">{{ $s->lunchMenu->nama_menu ?? '-' }}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="flex items-center gap-2">
                                                    <i class="bi bi-moon-stars text-indigo-300"></i>
                                                    <span class="truncate max-w-[120px]">{{ $s->dinnerMenu->nama_menu ?? '-' }}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                <div class="flex items-center justify-end gap-2">
                                                    {{-- Tombol Edit (Halaman) --}}
                                                    <a href="{{ route('admin.paket.schedules.edit', $s->id) }}" 
                                                       class="text-blue-300 hover:text-blue-100 transition p-1" title="Edit">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>

                                                    {{-- Tombol Hapus (POPUP CUSTOM) --}}
                                                    <button type="button" 
                                                        onclick="openDeleteModal('{{ route('admin.paket.schedules.destroy', $s->id) }}', '{{ \Carbon\Carbon::parse($s->schedule_date)->translatedFormat('d M Y') }}', '{{ $s->paketCategory->nama_kategori }}')"
                                                        class="text-red-300 hover:text-red-100 transition p-1" title="Hapus">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="px-6 py-12 text-center text-green-200/40">
                                                <i class="bi bi-calendar-x text-3xl mb-2 opacity-50 block"></i>
                                                <span class="text-xs">Belum ada jadwal batch dibuat.</span>
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

    {{-- MODAL DELETE (Sesuai Desain Gambar) --}}
    <div id="delete-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4">
        <div class="bg-[#1a412b] border border-green-800 rounded-3xl p-6 w-full max-w-sm shadow-2xl relative text-center">
            
            <h3 class="text-lg font-bold text-white mb-2">Hapus Jadwal?</h3>
            
            <p class="text-green-200/70 text-xs mb-6 leading-relaxed">
                Jadwal untuk paket <span id="del-paket" class="font-bold text-yellow-300"></span> 
                pada tanggal <span id="del-date" class="font-bold text-white"></span> 
                akan dihapus permanen.
            </p>

            <div class="flex items-center justify-center gap-3">
                {{-- Tombol Batal --}}
                <button type="button" onclick="closeDeleteModal()" 
                    class="px-6 py-2 rounded-xl bg-green-800 text-green-100 text-xs font-bold hover:bg-green-700 transition">
                    Batal
                </button>

                {{-- Form Delete --}}
                <form id="delete-form" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                        class="px-6 py-2 rounded-xl bg-red-600 text-white text-xs font-bold hover:bg-red-500 transition shadow-lg">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Script Modal Delete --}}
    <script>
        function openDeleteModal(actionUrl, dateStr, paketName) {
            const modal = document.getElementById('delete-modal');
            const form = document.getElementById('delete-form');
            const dateSpan = document.getElementById('del-date');
            const paketSpan = document.getElementById('del-paket');

            // Set Action Form
            form.action = actionUrl;
            
            // Set Text Info
            dateSpan.innerText = dateStr;
            paketSpan.innerText = paketName;

            // Show Modal
            modal.classList.remove('hidden');
        }

        function closeDeleteModal() {
            const modal = document.getElementById('delete-modal');
            modal.classList.add('hidden');
        }
    </script>

</body>
</html>