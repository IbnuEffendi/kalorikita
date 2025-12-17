<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Jadwal - Admin KaloriKita</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body { font-family: 'Instrument Sans', sans-serif; }
        
        /* Custom Select Icon (White) */
        select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%23ffffff' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.5rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
        }
        
        /* Custom Date Icon (White) */
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

            {{-- SIDEBAR (Sama seperti halaman lain) --}}
            <aside class="w-full lg:w-64 bg-green-800/90 border border-green-700/70 rounded-3xl p-6 h-max flex-shrink-0">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-10 h-10 rounded-2xl bg-yellow-400 text-green-900 flex items-center justify-center font-extrabold shadow-md">
                        {{ strtoupper(mb_substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <div>
                        <p class="text-sm font-bold text-white">{{ auth()->user()->name }}</p>
                        <p class="text-[11px] text-green-200/80">Admin</p>
                    </div>
                </div>
                <nav class="space-y-1">
                    <a href="{{ route('admin.paket.schedules') }}" class="block px-4 py-3 rounded-xl text-sm font-bold bg-white text-green-900 shadow-lg hover:bg-green-50 transition">
                        <i class="bi bi-arrow-left mr-2"></i> Kembali ke List
                    </a>
                </nav>
            </aside>

            {{-- KONTEN UTAMA --}}
            <main class="flex-1 space-y-6">

                {{-- Header --}}
                <section class="bg-green-800/90 border border-green-700/70 rounded-3xl p-6 shadow-xl relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-6 opacity-10 pointer-events-none">
                        <i class="bi bi-pencil-square text-[8rem] text-white"></i>
                    </div>
                    <div class="relative z-10">
                        <h1 class="text-2xl font-bold text-white tracking-tight">Edit Jadwal Menu</h1>
                        <p class="text-xs text-green-200/80 mt-1">Ubah tanggal atau menu makanan untuk jadwal ini.</p>
                    </div>
                </section>

                {{-- FORM EDIT --}}
                <div class="bg-green-800/90 border border-green-700/70 rounded-3xl p-8 shadow-xl">
                    
                    {{-- Route mengarah ke method UPDATE di Controller --}}
                    <form action="{{ route('admin.paket.schedules.update', $schedule->id) }}" method="POST" class="space-y-6 max-w-4xl">
                        @csrf
                        @method('PUT') {{-- PENTING: Method PUT untuk Update --}}

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            {{-- 1. Pilih Paket --}}
                            <div>
                                <label class="block text-[10px] font-bold text-green-300 uppercase mb-2">Paket Katering</label>
                                <select name="paket_category_id" class="w-full bg-green-900/40 border border-green-600/50 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-yellow-400 cursor-pointer">
                                    @foreach($packets as $p)
                                        <option value="{{ $p->id }}" class="bg-green-900" 
                                            {{ $p->id == $schedule->paket_category_id ? 'selected' : '' }}>
                                            {{ $p->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- 2. Pilih Tanggal --}}
                            <div>
                                <label class="block text-[10px] font-bold text-green-300 uppercase mb-2">Tanggal</label>
                                <input type="date" name="schedule_date" value="{{ $schedule->schedule_date }}" 
                                    class="w-full bg-green-900/40 border border-green-600/50 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-yellow-400 cursor-pointer">
                            </div>

                            {{-- 3. Menu Siang --}}
                            <div>
                                <label class="block text-[10px] font-bold text-green-300 uppercase mb-2">Menu Siang</label>
                                <select name="lunch_menu_id" class="w-full bg-green-900/40 border border-green-600/50 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-yellow-400 cursor-pointer">
                                    @foreach($menus as $m)
                                        <option value="{{ $m->id }}" class="bg-green-900"
                                            {{ $m->id == $schedule->lunch_menu_id ? 'selected' : '' }}>
                                            {{ $m->nama_menu }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- 4. Menu Malam --}}
                            <div>
                                <label class="block text-[10px] font-bold text-green-300 uppercase mb-2">Menu Malam</label>
                                <select name="dinner_menu_id" class="w-full bg-green-900/40 border border-green-600/50 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-yellow-400 cursor-pointer">
                                    @foreach($menus as $m)
                                        <option value="{{ $m->id }}" class="bg-green-900"
                                            {{ $m->id == $schedule->dinner_menu_id ? 'selected' : '' }}>
                                            {{ $m->nama_menu }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="pt-6 border-t border-green-700/50 flex justify-end gap-3">
                            <a href="{{ route('admin.paket.schedules') }}" class="px-6 py-2.5 rounded-xl bg-green-900 text-green-200 text-xs font-bold hover:bg-green-800 transition">
                                Batal
                            </a>
                            <button type="submit" class="px-6 py-2.5 rounded-xl bg-yellow-400 text-green-900 text-xs font-bold hover:bg-yellow-300 transition shadow-lg">
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