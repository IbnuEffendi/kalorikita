<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Paket - Admin KaloriKita</title>

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

    @php $user = auth()->user(); @endphp

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

                {{-- Header --}}
                <section class="bg-green-800/90 border border-green-700/70 rounded-3xl p-6 shadow-xl relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-6 opacity-10 pointer-events-none"><i class="bi bi-pencil-square text-[8rem] text-white"></i></div>
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 relative z-10">
                        <div>
                            <h1 class="text-xl sm:text-2xl font-bold text-white tracking-tight">Edit Paket</h1>
                            <p class="text-xs text-green-200/80 mt-1">Ubah informasi utama paket (Nama, Deskripsi, Foto).</p>
                        </div>
                        <a href="{{ route('admin.paket.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-green-900/50 text-green-100 text-[10px] font-semibold border border-green-600/50 hover:bg-green-900 hover:text-white transition">
                            <i class="bi bi-arrow-left"></i> Batal
                        </a>
                    </div>
                </section>

                {{-- FORM EDIT --}}
                <div class="bg-green-800/90 border border-green-700/70 rounded-3xl p-8 shadow-xl">
                    
                    {{-- PERBAIKAN DI SINI: route('admin.paket.update') --}}
                    <form action="{{ route('admin.paket.update', $package->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6 max-w-4xl mx-auto">
                        @csrf
                        @method('PUT') 

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            
                            {{-- KOLOM KIRI --}}
                            <div class="space-y-5">
                                {{-- Nama Paket --}}
                                <div>
                                    <label class="text-[10px] font-bold text-green-300 uppercase mb-1 block">Nama Paket</label>
                                    <input type="text" name="nama_kategori" value="{{ old('nama_kategori', $package->nama_kategori) }}" required
                                        class="w-full rounded-xl bg-green-900/40 border border-green-600/50 px-4 py-2.5 text-xs text-white focus:outline-none focus:border-yellow-400 focus:ring-1 focus:ring-yellow-400">
                                </div>

                                {{-- Deskripsi --}}
                                <div>
                                    <label class="text-[10px] font-bold text-green-300 uppercase mb-1 block">Deskripsi</label>
                                    <textarea name="deskripsi" rows="5" required
                                        class="w-full rounded-xl bg-green-900/40 border border-green-600/50 px-4 py-2.5 text-xs text-white focus:outline-none focus:border-yellow-400 focus:ring-1 focus:ring-yellow-400">{{ old('deskripsi', $package->deskripsi) }}</textarea>
                                </div>

                                {{-- Keuntungan --}}
                                <div>
                                    <label class="text-[10px] font-bold text-green-300 uppercase mb-1 block">Keuntungan (Pisahkan Koma)</label>
                                    @php
                                        $keuntunganString = is_array($package->keuntungan) ? implode(', ', $package->keuntungan) : $package->keuntungan;
                                    @endphp
                                    <textarea name="keuntungan" rows="3" placeholder="Contoh: Menu Sehat, Gratis Ongkir"
                                        class="w-full rounded-xl bg-green-900/40 border border-green-600/50 px-4 py-2.5 text-xs text-white focus:outline-none focus:border-yellow-400 focus:ring-1 focus:ring-yellow-400">{{ old('keuntungan', $keuntunganString) }}</textarea>
                                </div>
                            </div>

                            {{-- KOLOM KANAN --}}
                            <div class="space-y-5">
                                
                                {{-- Preview Gambar --}}
                                <div>
                                    <label class="text-[10px] font-bold text-green-300 uppercase mb-2 block">Foto Saat Ini</label>
                                    @if($package->gambar)
                                        <div class="rounded-xl overflow-hidden border border-green-600/50 w-full h-32 relative group">
                                            <img src="{{ asset('storage/' . $package->gambar) }}" class="w-full h-full object-cover">
                                        </div>
                                    @else
                                        <div class="w-full h-32 bg-green-900/30 border border-green-600/30 rounded-xl flex items-center justify-center text-green-200/50 text-xs italic">
                                            Tidak ada gambar
                                        </div>
                                    @endif
                                </div>

                                {{-- Upload Gambar --}}
                                <div>
                                    <label class="text-[10px] font-bold text-green-300 uppercase mb-1 block">Ganti Foto (Opsional)</label>
                                    <input type="file" name="gambar"
                                        class="block w-full text-[10px] text-green-200 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-semibold file:bg-green-100 file:text-green-800 hover:file:bg-white transition cursor-pointer">
                                </div>

                                {{-- Harga Default (Optional Edit) --}}
                                @php $firstOption = $package->options->first(); @endphp
                                @if($firstOption)
                                    <div class="pt-4 border-t border-green-600/30 mt-4">
                                        <p class="text-xs text-yellow-300 font-bold mb-3">Edit Harga Dasar ({{ $firstOption->periode }})</p>
                                        
                                        <div class="grid grid-cols-2 gap-3">
                                            <div>
                                                <label class="text-[10px] font-bold text-green-300 uppercase mb-1 block">Harga (Rp)</label>
                                                <input type="number" name="harga" value="{{ $firstOption->harga }}"
                                                    class="w-full rounded-xl bg-green-900/40 border border-green-600/50 px-4 py-2.5 text-xs text-white focus:outline-none focus:border-yellow-400">
                                            </div>
                                            <div>
                                                <label class="text-[10px] font-bold text-green-300 uppercase mb-1 block">Durasi (Hari)</label>
                                                <input type="number" name="durasi_hari" value="{{ $firstOption->durasi_hari }}"
                                                    class="w-full rounded-xl bg-green-900/40 border border-green-600/50 px-4 py-2.5 text-xs text-white focus:outline-none focus:border-yellow-400">
                                            </div>
                                        </div>
                                        <p class="text-[10px] text-green-200/50 mt-2 italic">*Untuk menambah varian durasi lain, silakan buka menu <b>Detail</b>.</p>
                                    </div>
                                @endif

                            </div>
                        </div>

                        {{-- Tombol Simpan --}}
                        <div class="flex justify-end gap-3 pt-6 border-t border-green-700/50">
                            <a href="{{ route('admin.paket.index') }}"
                               class="px-5 py-2.5 text-xs rounded-xl bg-green-900 text-green-200 hover:bg-green-800 transition font-bold">
                                Batal
                            </a>

                            <button type="submit"
                                class="px-5 py-2.5 text-xs rounded-xl bg-yellow-400 text-green-900 font-bold hover:bg-yellow-300 transition shadow-lg">
                                Simpan Perubahan
                            </button>
                        </div>

                    </form>
                </div>

            </main>
        </div>
    </div>

</body>
</html>