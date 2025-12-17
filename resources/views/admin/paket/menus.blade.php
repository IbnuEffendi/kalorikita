<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Menu - Admin KaloriKita</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body { font-family: 'Instrument Sans', sans-serif; }
        .scroll-thin::-webkit-scrollbar { height: 6px; width: 6px; }
        .scroll-thin::-webkit-scrollbar-thumb { background-color: rgba(251, 191, 36, 0.5); border-radius: 999px; }
        
        /* Custom Select Icon */
        select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%23ffffff' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.5rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
        }
    </style>
</head>

<body class="bg-green-700/60 min-h-screen">

    {{-- NAVBAR --}}
    <x-navbar></x-navbar>

    @php
        $user = auth()->user();
        $menus = $menus ?? collect([]); 
    @endphp

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="flex flex-col lg:flex-row gap-6">

            {{-- ================= SIDEBAR ================= --}}
            <aside class="w-full lg:w-64 bg-green-800/90 border border-green-700/70 rounded-3xl p-6 h-max flex-shrink-0 flex flex-col">
                {{-- Profile --}}
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-10 h-10 rounded-2xl bg-yellow-400 text-green-900 flex items-center justify-center font-extrabold shadow-md">
                        {{ strtoupper(mb_substr($user->name ?? 'A', 0, 1)) }}
                    </div>
                    <div>
                        <p class="text-sm font-bold text-white">{{ $user->name }}</p>
                        <p class="text-[11px] text-green-200/80">Admin</p>
                    </div>
                </div>

                {{-- Menu --}}
                <nav class="space-y-1 flex-1">
                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-3 rounded-xl text-sm font-medium text-green-100 hover:bg-green-700/50 transition">Dashboard</a>
                    <a href="{{ route('admin.orders.index') }}" class="block px-4 py-3 rounded-xl text-sm font-medium text-green-100 hover:bg-green-700/50 transition">Kelola Pesanan</a>
                    
                    {{-- Menu Paket Aktif --}}
                    <a href="{{ route('admin.paket.index') }}" class="block px-4 py-3 rounded-xl text-sm font-bold bg-white text-green-900 shadow-lg">Paket Katering</a>
                    
                    <a href="{{ route('admin.users.index') }}" class="block px-4 py-3 rounded-xl text-sm font-medium text-green-100 hover:bg-green-700/50 transition">Data Pengguna</a>
                    <a href="{{ route('admin.reports.index') }}" class="block px-4 py-3 rounded-xl text-sm font-medium text-green-100 hover:bg-green-700/50 transition">Laporan</a>
                    <a href="{{ route('admin.ai.logs') }}" class="block px-4 py-3 rounded-xl text-sm font-medium text-green-100 hover:bg-green-700/50 transition">Log KaloriLab (AI)</a>
                </nav>

                {{-- Footer Sidebar --}}
                <div class="mt-8 pt-6 border-t border-green-700/40">
                    <a href="{{ route('profil.dashboard') }}" class="block text-xs text-green-200/70 hover:text-white mb-3 pl-1 transition">Masuk sebagai Pengguna</a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="w-full py-3 rounded-xl bg-[#4c4232] text-white/90 text-xs font-semibold hover:bg-[#3e3629] transition shadow-md">Logout</button>
                    </form>
                </div>
            </aside>

            {{-- ================= KONTEN UTAMA ================= --}}
            <main class="flex-1 space-y-6">

                {{-- HEADER + TABS --}}
                <section class="bg-green-800/90 border border-green-700/70 rounded-3xl p-6 shadow-xl relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-6 opacity-10 pointer-events-none">
                        <i class="bi bi-egg-fried text-[8rem] text-white"></i>
                    </div>

                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 mb-6 relative z-10">
                        <div>
                            <h1 class="text-2xl font-bold text-white tracking-tight">Kelola Menu</h1>
                            <p class="text-xs text-green-200/80 mt-1">Input lengkap: Nutrisi, Kategori, dan Foto.</p>
                        </div>

                        {{-- Tombol Kembali --}}
                        <a href="{{ route('admin.paket.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-green-900/50 text-green-100 text-[10px] font-semibold border border-green-600/50 hover:bg-green-900 hover:text-white transition">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                    </div>

                    {{-- 3 TAB NAVIGASI --}}
                    <div class="flex flex-wrap items-center gap-2 relative z-10 border-t border-green-700/50 pt-4">
                        <a href="{{ route('admin.paket.index') }}" class="px-4 py-2 rounded-xl text-green-100 hover:bg-green-700/40 hover:text-white text-xs font-medium transition flex items-center gap-2">
                            <i class="bi bi-grid-fill"></i> Daftar Paket
                        </a>
                        {{-- Tab Aktif --}}
                        <a href="{{ route('admin.paket.menus') }}" class="px-4 py-2 rounded-xl bg-white text-green-900 text-xs font-bold shadow-md flex items-center gap-2">
                            <i class="bi bi-egg-fried"></i> Kelola Menu
                        </a>
                        <a href="{{ route('admin.paket.schedules') }}" class="px-4 py-2 rounded-xl text-green-100 hover:bg-green-700/40 hover:text-white text-xs font-medium transition flex items-center gap-2">
                            <i class="bi bi-calendar-week"></i> Kelola Batch
                        </a>
                    </div>
                </section>

                {{-- GRID KONTEN --}}
                <section class="grid grid-cols-1 xl:grid-cols-3 gap-6">
                    
                    {{-- FORM TAMBAH MENU (Kiri) --}}
                    <div class="xl:col-span-1">
                        <div class="bg-green-800/90 border border-green-700/70 rounded-3xl p-6 shadow-lg sticky top-6">
                            <h3 class="font-bold text-white mb-5 flex items-center gap-2 text-sm">
                                <i class="bi bi-plus-circle-fill text-yellow-400"></i> Tambah Menu
                            </h3>

                            @if(session('success'))
                                <div class="bg-emerald-500/20 border border-emerald-500/50 text-emerald-100 p-3 rounded-xl text-[10px] mb-4 flex items-center gap-2">
                                    <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                                </div>
                            @endif

                            {{-- Form mengarah ke admin.menus.store --}}
                            <form action="{{ route('admin.menus.store') }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                                @csrf
                                
                                <div>
                                    <label class="block text-[10px] font-bold text-green-300 uppercase mb-1">Nama Menu</label>
                                    <input type="text" name="nama_menu" required placeholder="Contoh: Nasi Goreng Telur"
                                        class="w-full bg-green-900/40 border border-green-600/50 rounded-xl px-4 py-2.5 text-xs text-white placeholder-green-100/30 focus:outline-none focus:border-yellow-400 focus:ring-1 focus:ring-yellow-400 transition">
                                </div>

                                <div class="grid grid-cols-2 gap-3">
                                    <div>
                                        <label class="block text-[10px] font-bold text-green-300 uppercase mb-1">Kategori</label>
                                        <select name="kategori" required class="w-full bg-green-900/40 border border-green-600/50 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-yellow-400 cursor-pointer">
                                            <option value="makan_pagi" class="bg-green-900">Makan Pagi</option>
                                            <option value="makan_siang" class="bg-green-900">Makan Siang</option>
                                            <option value="makan_malam" class="bg-green-900">Makan Malam</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-bold text-green-300 uppercase mb-1">Tipe</label>
                                        <select name="tipe_makanan" required class="w-full bg-green-900/40 border border-green-600/50 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-yellow-400 cursor-pointer">
                                            <option value="non_vegan" class="bg-green-900">Non-Vegan</option>
                                            <option value="vegan" class="bg-green-900">Vegan</option>
                                        </select>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-[10px] font-bold text-green-300 uppercase mb-1">Total Kalori (kkal)</label>
                                    <input type="number" name="kalori" required placeholder="520"
                                        class="w-full bg-green-900/40 border border-green-600/50 rounded-xl px-4 py-2.5 text-xs text-white placeholder-green-100/30 focus:outline-none focus:border-yellow-400 focus:ring-1 focus:ring-yellow-400 transition">
                                </div>

                                {{-- Nutrisi Grid --}}
                                <div class="grid grid-cols-3 gap-3">
                                    <div>
                                        <label class="block text-[10px] font-bold text-green-300 uppercase mb-1">Prot (g)</label>
                                        <input type="number" name="protein" required placeholder="18"
                                            class="w-full bg-green-900/40 border border-green-600/50 rounded-xl px-3 py-2.5 text-xs text-white placeholder-green-100/30 focus:outline-none focus:border-yellow-400 transition">
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-bold text-green-300 uppercase mb-1">Carb (g)</label>
                                        <input type="number" name="karbohidrat" required placeholder="65"
                                            class="w-full bg-green-900/40 border border-green-600/50 rounded-xl px-3 py-2.5 text-xs text-white placeholder-green-100/30 focus:outline-none focus:border-yellow-400 transition">
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-bold text-green-300 uppercase mb-1">Fat (g)</label>
                                        <input type="number" name="lemak" required placeholder="20"
                                            class="w-full bg-green-900/40 border border-green-600/50 rounded-xl px-3 py-2.5 text-xs text-white placeholder-green-100/30 focus:outline-none focus:border-yellow-400 transition">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-[10px] font-bold text-green-300 uppercase mb-1">Deskripsi Singkat</label>
                                    <textarea name="deskripsi" rows="2" placeholder="Deskripsi menu..."
                                        class="w-full bg-green-900/40 border border-green-600/50 rounded-xl px-4 py-2.5 text-xs text-white placeholder-green-100/30 focus:outline-none focus:border-yellow-400 focus:ring-1 focus:ring-yellow-400 transition"></textarea>
                                </div>

                                <div>
                                    <label class="block text-[10px] font-bold text-green-300 uppercase mb-1">Foto Menu</label>
                                    <input type="file" name="gambar" class="block w-full text-[10px] text-green-200 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-semibold file:bg-green-100 file:text-green-800 hover:file:bg-white transition cursor-pointer">
                                </div>

                                <button type="submit" class="w-full bg-yellow-400 hover:bg-yellow-300 text-green-900 font-bold py-2.5 rounded-xl transition shadow-lg flex justify-center items-center gap-2 mt-2 text-xs">
                                    <i class="bi bi-save"></i> Simpan Menu
                                </button>
                            </form>
                        </div>
                    </div>

                    {{-- LIST MENU (Kanan) --}}
                    <div class="xl:col-span-2">
                        <div class="bg-green-800/90 border border-green-700/70 rounded-3xl shadow-lg overflow-hidden min-h-[500px] flex flex-col">
                            <div class="px-6 py-4 border-b border-green-700/50 bg-green-900/30 flex justify-between items-center">
                                <h3 class="font-bold text-white text-sm">Daftar Menu Tersedia</h3>
                                <span class="bg-green-900 border border-green-600/50 text-green-100 text-[10px] px-2 py-1 rounded-lg font-bold">
                                    Total: {{ $menus->count() }}
                                </span>
                            </div>
                            
                            <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-4 overflow-y-auto scroll-thin max-h-[800px]">
                                @forelse($menus as $menu)
                                    <div class="flex flex-col gap-3 p-4 rounded-2xl border border-green-600/30 bg-green-900/20 hover:bg-green-900/40 transition group">
                                        
                                        <div class="flex items-start gap-4">
                                            {{-- Icon / Foto --}}
                                            <div class="w-16 h-16 rounded-xl bg-green-900/50 border border-green-700/50 flex-shrink-0 overflow-hidden relative flex items-center justify-center">
                                                @if(!empty($menu->gambar))
                                                    {{-- Logic Gambar: URL Eksternal (Seeder) atau Storage Lokal --}}
                                                    <img src="{{ Str::startsWith($menu->gambar, 'http') ? $menu->gambar : asset('storage/' . $menu->gambar) }}" class="w-full h-full object-cover">
                                                @else
                                                    <i class="bi bi-egg-fried text-2xl text-green-500/50"></i>
                                                @endif
                                            </div>

                                            <div class="flex-1 min-w-0">
                                                <h4 class="font-bold text-white text-sm truncate">{{ $menu->nama_menu ?? 'Tanpa Nama' }}</h4>
                                                
                                                <div class="flex gap-2 my-1">
                                                    <span class="text-[9px] uppercase px-1.5 py-0.5 rounded bg-blue-900/40 text-blue-200 border border-blue-500/30">
                                                        {{ str_replace('_', ' ', $menu->kategori ?? '-') }}
                                                    </span>
                                                    <span class="text-[9px] uppercase px-1.5 py-0.5 rounded {{ ($menu->tipe_makanan ?? '') == 'vegan' ? 'bg-green-900/60 text-green-200 border-green-500/30' : 'bg-red-900/40 text-red-200 border-red-500/30' }}">
                                                        {{ str_replace('_', ' ', $menu->tipe_makanan ?? '-') }}
                                                    </span>
                                                </div>

                                                <p class="text-[10px] text-green-200/60 line-clamp-2 leading-relaxed">
                                                    {{ $menu->deskripsi ?? 'Tidak ada deskripsi' }}
                                                </p>
                                            </div>
                                        </div>

                                        {{-- Nutrisi Grid --}}
                                        <div class="grid grid-cols-4 gap-2 pt-3 border-t border-green-700/30">
                                            <div class="text-center">
                                                <p class="text-[9px] text-green-300 uppercase">Kalori</p>
                                                <p class="text-xs font-bold text-white">{{ $menu->kalori }}</p>
                                            </div>
                                            <div class="text-center">
                                                <p class="text-[9px] text-green-300 uppercase">Prot</p>
                                                <p class="text-xs font-bold text-white">{{ $menu->protein }}g</p>
                                            </div>
                                            <div class="text-center">
                                                <p class="text-[9px] text-green-300 uppercase">Carb</p>
                                                <p class="text-xs font-bold text-white">{{ $menu->karbohidrat }}g</p>
                                            </div>
                                            <div class="text-center">
                                                <p class="text-[9px] text-green-300 uppercase">Fat</p>
                                                <p class="text-xs font-bold text-white">{{ $menu->lemak }}g</p>
                                            </div>
                                        </div>

                                        {{-- TOMBOL EDIT & HAPUS (Fix Route Name) --}}
                                        <div class="flex gap-2 mt-2 pt-2 border-t border-green-700/30">
                                            <a href="{{ route('admin.menus.edit', $menu->id) }}" class="flex-1 py-1.5 rounded-lg bg-green-900/50 text-green-100 text-[10px] font-semibold text-center hover:bg-green-800 transition">
                                                Edit
                                            </a>
                                            {{-- Tombol Hapus memanggil Modal --}}
                                            <button type="button" onclick="openDeleteModal({{ $menu->id }}, '{{ $menu->nama_menu }}')" class="flex-1 py-1.5 rounded-lg bg-red-900/30 text-red-200 text-[10px] font-semibold text-center hover:bg-red-900/50 transition">
                                                Hapus
                                            </button>
                                        </div>

                                    </div>
                                @empty
                                    <div class="col-span-full py-12 text-center text-green-200/40 flex flex-col items-center justify-center h-40">
                                        <i class="bi bi-egg-fried text-4xl mb-2 opacity-50 block"></i>
                                        <p class="text-sm">Belum ada data menu makanan.</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                </section>

            </main>

        </div>
    </div>

    {{-- MODAL HAPUS (Popup) --}}
    <div id="delete-modal" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-green-900 border border-green-700 rounded-3xl max-w-sm w-full p-6 shadow-2xl relative">
            <h3 class="text-lg font-bold text-white mb-2">Hapus Menu?</h3>
            <p class="text-sm text-green-200/70 mb-6">Menu <span id="delete-menu-name" class="text-yellow-400 font-semibold"></span> akan dihapus permanen.</p>
            
            {{-- Form Hapus mengarah ke admin.menus.destroy --}}
            <form id="delete-form" action="" method="POST" class="flex gap-3">
                @csrf @method('DELETE')
                <button type="button" onclick="closeModal()" class="flex-1 py-2.5 rounded-xl bg-green-800 text-green-100 text-xs font-bold hover:bg-green-700 transition">Batal</button>
                <button type="submit" class="flex-1 py-2.5 rounded-xl bg-red-600 text-white text-xs font-bold hover:bg-red-500 transition shadow-lg">Hapus</button>
            </form>
        </div>
    </div>

    <script>
        const deleteModal = document.getElementById('delete-modal');
        const deleteForm = document.getElementById('delete-form');
        const deleteMenuName = document.getElementById('delete-menu-name');

        function openDeleteModal(id, name) {
            // URL ini cocok dengan Route::delete('/paket-menus/{id}')
            deleteForm.action = "/admin/paket-menus/" + id; 
            deleteMenuName.textContent = name;
            deleteModal.classList.remove('hidden');
        }
        function closeModal() { deleteModal.classList.add('hidden'); }
        deleteModal.addEventListener('click', (e) => { if (e.target === deleteModal) closeModal(); });
    </script>

</body>
</html>