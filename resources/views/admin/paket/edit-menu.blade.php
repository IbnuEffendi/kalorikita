<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Menu - Admin KaloriKita</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body { font-family: 'Instrument Sans', sans-serif; }
        .scroll-thin::-webkit-scrollbar { height: 6px; width: 6px; }
        .scroll-thin::-webkit-scrollbar-thumb { background-color: rgba(251, 191, 36, 0.5); border-radius: 999px; }
        select { appearance: none; background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%23ffffff' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e"); background-position: right 0.5rem center; background-repeat: no-repeat; background-size: 1.5em 1.5em; }
    </style>
</head>

<body class="bg-green-700/60 min-h-screen">

    <x-navbar></x-navbar>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col lg:flex-row gap-6">

            {{-- SIDEBAR (Sama persis dengan halaman lain) --}}
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
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="w-full py-3 rounded-xl bg-[#4c4232] text-white/90 text-xs font-semibold hover:bg-[#3e3629] transition shadow-md">Logout</button>
                    </form>
                </div>
            </aside>

            {{-- KONTEN UTAMA --}}
            <main class="flex-1 space-y-6">
                
                {{-- HEADER --}}
                <section class="bg-green-800/90 border border-green-700/70 rounded-3xl p-6 shadow-xl relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-6 opacity-10 pointer-events-none"><i class="bi bi-pencil-square text-[8rem] text-white"></i></div>
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 mb-6 relative z-10">
                        <div>
                            <h1 class="text-2xl font-bold text-white tracking-tight">Edit Menu Makanan</h1>
                            <p class="text-xs text-green-200/80 mt-1">Perbarui informasi nutrisi, kategori, atau foto menu.</p>
                        </div>
                        <a href="{{ route('admin.paket.menus') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-green-900/50 text-green-100 text-[10px] font-semibold border border-green-600/50 hover:bg-green-900 hover:text-white transition">
                            <i class="bi bi-arrow-left"></i> Batal & Kembali
                        </a>
                    </div>
                </section>

                {{-- FORM EDIT --}}
                <div class="bg-green-800/90 border border-green-700/70 rounded-3xl p-8 shadow-lg">
                    <form action="{{ route('admin.menus.update', $menu->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5 max-w-4xl mx-auto">
                        @csrf
                        @method('PUT') 
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Kolom Kiri --}}
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-[10px] font-bold text-green-300 uppercase mb-1">Nama Menu</label>
                                    <input type="text" name="nama_menu" value="{{ old('nama_menu', $menu->nama_menu) }}" required
                                        class="w-full bg-green-900/40 border border-green-600/50 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-yellow-400">
                                </div>
                                
                                <div class="grid grid-cols-2 gap-3">
                                    <div>
                                        <label class="block text-[10px] font-bold text-green-300 uppercase mb-1">Kategori</label>
                                        {{-- HANYA ADA MAKAN SIANG DAN MALAM --}}
                                        <select name="kategori" required class="w-full bg-green-900/40 border border-green-600/50 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-yellow-400">
                                            <option value="makan_siang" {{ $menu->kategori == 'makan_siang' ? 'selected' : '' }} class="bg-green-900">Makan Siang</option>
                                            <option value="makan_malam" {{ $menu->kategori == 'makan_malam' ? 'selected' : '' }} class="bg-green-900">Makan Malam</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-bold text-green-300 uppercase mb-1">Tipe</label>
                                        <select name="tipe_makanan" required class="w-full bg-green-900/40 border border-green-600/50 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-yellow-400">
                                            <option value="non_vegan" {{ $menu->tipe_makanan == 'non_vegan' ? 'selected' : '' }} class="bg-green-900">Non-Vegan</option>
                                            <option value="vegan" {{ $menu->tipe_makanan == 'vegan' ? 'selected' : '' }} class="bg-green-900">Vegan</option>
                                        </select>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-[10px] font-bold text-green-300 uppercase mb-1">Deskripsi</label>
                                    <textarea name="deskripsi" rows="4" class="w-full bg-green-900/40 border border-green-600/50 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-yellow-400">{{ old('deskripsi', $menu->deskripsi) }}</textarea>
                                </div>
                            </div>

                            {{-- Kolom Kanan (Nutrisi & Foto) --}}
                            <div class="space-y-4">
                                <div class="grid grid-cols-2 gap-3">
                                    <div>
                                        <label class="block text-[10px] font-bold text-green-300 uppercase mb-1">Total Kalori</label>
                                        <input type="number" name="kalori" value="{{ old('kalori', $menu->kalori) }}" required
                                            class="w-full bg-green-900/40 border border-green-600/50 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-yellow-400">
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-bold text-green-300 uppercase mb-1">Protein (g)</label>
                                        <input type="number" name="protein" value="{{ old('protein', $menu->protein) }}" required
                                            class="w-full bg-green-900/40 border border-green-600/50 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-yellow-400">
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-bold text-green-300 uppercase mb-1">Karbohidrat (g)</label>
                                        <input type="number" name="karbohidrat" value="{{ old('karbohidrat', $menu->karbohidrat) }}" required
                                            class="w-full bg-green-900/40 border border-green-600/50 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-yellow-400">
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-bold text-green-300 uppercase mb-1">Lemak (g)</label>
                                        <input type="number" name="lemak" value="{{ old('lemak', $menu->lemak) }}" required
                                            class="w-full bg-green-900/40 border border-green-600/50 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-yellow-400">
                                    </div>
                                </div>

                                {{-- Preview Foto Lama --}}
                                <div>
                                    <label class="block text-[10px] font-bold text-green-300 uppercase mb-2">Foto Saat Ini</label>
                                    @if($menu->gambar)
                                        <div class="w-full h-24 rounded-xl overflow-hidden border border-green-600/50 bg-green-900/30 flex items-center justify-center">
                                            {{-- Support URL Seeder & Storage --}}
                                            <img src="{{ Str::startsWith($menu->gambar, 'http') ? $menu->gambar : asset('storage/' . $menu->gambar) }}" class="h-full object-cover">
                                        </div>
                                    @else
                                        <p class="text-xs text-green-200/50 italic">Belum ada foto</p>
                                    @endif
                                </div>

                                <div>
                                    <label class="block text-[10px] font-bold text-green-300 uppercase mb-1">Ganti Foto (Opsional)</label>
                                    <input type="file" name="gambar" class="block w-full text-[10px] text-green-200 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-semibold file:bg-green-100 file:text-green-800 hover:file:bg-white transition cursor-pointer">
                                </div>
                            </div>
                        </div>

                        <div class="pt-4 border-t border-green-700/50 flex justify-end gap-3">
                            <a href="{{ route('admin.paket.menus') }}" class="px-6 py-2.5 rounded-xl bg-green-900 text-green-100 text-xs font-bold hover:bg-green-800 transition">Batal</a>
                            <button type="submit" class="px-6 py-2.5 rounded-xl bg-yellow-400 text-green-900 text-xs font-bold hover:bg-yellow-300 transition shadow-lg">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>

            </main>
        </div>
    </div>
</body>
</html>