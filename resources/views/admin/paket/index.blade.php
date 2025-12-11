<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Paket Katering - Admin KaloriKita</title>

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
        // Ambil data asli dari database dengan relasi options
        $packages = $packages ?? \App\Models\PaketCategory::with('options')->get(); 
    @endphp

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="flex flex-col lg:flex-row gap-6">

            {{-- SIDEBAR ADMIN (Sesuai kode kamu) --}}
            <aside class="w-full lg:w-64 bg-green-800/90 border border-green-700/70 rounded-3xl p-5 h-max flex-shrink-0">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-2xl bg-yellow-400 text-green-900 flex items-center justify-center font-extrabold">
                        {{ strtoupper(mb_substr($user->name ?? 'A', 0, 1)) }}
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-white">{{ $user->name }}</p>
                        <p class="text-[11px] text-green-100/70">Admin</p>
                    </div>
                </div>
                <nav class="space-y-2 text-sm">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center justify-between px-3 py-2 rounded-xl text-green-100 hover:bg-green-700/70">Dashboard</a>
                    <a href="{{ route('admin.orders.index') }}" class="flex items-center justify-between px-3 py-2 rounded-xl text-green-100 hover:bg-green-700/70">Kelola Pesanan</a>
                    
                    {{-- Menu Aktif --}}
                    <a href="{{ route('admin.paket.index') }}" class="flex items-center justify-between px-3 py-2 rounded-xl bg-white text-green-900 font-semibold shadow-lg">Paket Katering</a>
                    
                    <a href="{{ route('admin.users.index') }}" class="flex items-center justify-between px-3 py-2 rounded-xl text-green-100 hover:bg-green-700/70">Data Pengguna</a>
                    <a href="{{ route('admin.reports.index') }}" class="flex items-center justify-between px-3 py-2 rounded-xl text-green-100 hover:bg-green-700/70">Laporan</a>
                    <a href="{{ route('admin.ai.logs') }}" class="flex items-center justify-between px-3 py-2 rounded-xl text-green-100 hover:bg-green-700/70">Log KaloriLab (AI)</a>
                    
                    <div class="border-t border-green-700/60 my-3"></div>
                    
                    <a href="{{ route('profil.dashboard') }}" class="flex items-center justify-between px-3 py-2 rounded-xl text-[11px] text-green-100 hover:bg-green-700/70">Masuk sebagai Pengguna</a>
                    
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="w-full mt-3 px-3 py-2 rounded-xl bg-red-900/50 text-red-100 text-xs hover:bg-red-800/70">Logout</button>
                    </form>
                </nav>
            </aside>

            {{-- KONTEN UTAMA --}}
            <main class="flex-1 space-y-6">

                {{-- HEADER + TABS --}}
                <section class="bg-green-800/90 border border-green-700/70 rounded-3xl p-6 shadow-xl relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-4 opacity-10 pointer-events-none">
                        <i class="bi bi-box-seam text-9xl text-white"></i>
                    </div>

                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6 relative z-10">
                        <div>
                            <h1 class="text-xl sm:text-2xl font-semibold text-white">Paket Katering</h1>
                            <p class="text-xs text-green-100/70 mt-1">Kelola daftar paket katering, menu, dan jadwal batch.</p>
                        </div>

                        <a href="{{ route('admin.paket.create') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-yellow-400 text-green-900 font-semibold text-xs hover:bg-yellow-300 transition shadow-lg">
                            <i class="bi bi-plus-lg"></i> Buat Paket Baru
                        </a>
                    </div>

                    {{-- 3 TAB NAVIGASI --}}
                    <div class="flex items-center gap-1 border-t border-green-700/50 pt-4 relative z-10">
                        {{-- Tab 1 (Aktif) --}}
                        <a href="{{ route('admin.paket.index') }}" class="px-4 py-2 rounded-xl bg-white text-green-900 text-xs font-bold shadow-sm flex items-center gap-2">
                            <i class="bi bi-grid-fill"></i> Daftar Paket
                        </a>
                        <a href="{{ route('admin.paket.menus') }}" class="px-4 py-2 rounded-xl text-green-100 hover:bg-green-700/50 hover:text-white text-xs font-medium transition flex items-center gap-2">
                            <i class="bi bi-egg-fried"></i> Kelola Menu
                        </a>
                        <a href="{{ route('admin.paket.schedules') }}" class="px-4 py-2 rounded-xl text-green-100 hover:bg-green-700/50 hover:text-white text-xs font-medium transition flex items-center gap-2">
                            <i class="bi bi-calendar-week"></i> Kelola Batch
                        </a>
                    </div>
                </section>

                {{-- CARD LIST PAKET --}}
                <section class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

                    @forelse ($packages as $p)
                        @php
                            $isActive = ($p->status ?? 'active') === 'active';
                            $statusClass = $isActive ? 'bg-emerald-400/20 text-emerald-200 border-emerald-400/40' : 'bg-red-400/20 text-red-200 border-red-400/40';
                            $statusText = $isActive ? 'Aktif' : 'Non-Aktif';
                        @endphp

                        <div class="bg-green-800/90 border border-green-700/70 rounded-3xl p-5 shadow-xl flex flex-col justify-between group hover:border-green-500/50 transition duration-300">

                            <div>
                                <div class="flex justify-between items-start mb-1">
                                    <h2 class="text-lg font-semibold text-white group-hover:text-yellow-300 transition">
                                        {{ $p->nama_kategori }}
                                    </h2>
                                    <span class="inline-flex px-2 py-0.5 rounded-full border text-[10px] font-semibold {{ $statusClass }}">
                                        {{ $statusText }}
                                    </span>
                                </div>

                                <p class="text-[11px] text-green-100/70 mb-4 line-clamp-2 h-8">
                                    {{ $p->deskripsi }}
                                </p>

                                {{-- [UPDATE] LIST HARGA (TABEL MINI) --}}
                                <div class="bg-green-900/40 border border-green-600/30 rounded-xl p-3 mb-4">
                                    <p class="text-[10px] font-bold text-green-300 uppercase mb-2">Pilihan Durasi:</p>
                                    
                                    @if($p->options->count() > 0)
                                        <div class="space-y-1.5">
                                            @foreach($p->options as $opt)
                                                <div class="flex justify-between items-center text-xs border-b border-green-700/30 last:border-0 pb-1 last:pb-0">
                                                    <span class="text-green-100">
                                                        {{ $opt->periode }} 
                                                        <span class="text-[10px] text-green-100/50">({{ $opt->durasi_hari }}hr)</span>
                                                    </span>
                                                    <span class="font-bold text-yellow-300">
                                                        Rp {{ number_format($opt->harga, 0, ',', '.') }}
                                                    </span>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-[10px] text-red-300 italic">Belum ada opsi harga.</p>
                                    @endif
                                </div>
                            </div>

                            {{-- Tombol Aksi --}}
                            <div class="mt-2 flex flex-wrap gap-2 pt-4 border-t border-green-700/40">
                                <a href="{{ route('admin.paket.edit', $p->id) }}" class="flex-1 text-center px-3 py-2 rounded-xl text-xs font-semibold bg-white/5 text-green-100 border border-green-500/30 hover:bg-white/10 transition">
                                    Edit
                                </a>
                                <a href="{{ route('admin.paket.show', $p->id) }}" class="flex-1 text-center px-3 py-2 rounded-xl text-xs font-semibold bg-green-600 text-white border border-green-500 hover:bg-green-500 transition shadow-lg">
                                    Detail
                                </a>
                                <button type="button" onclick="openDeleteModal({{ $p->id }}, '{{ $p->nama_kategori }}')" class="px-3 py-2 rounded-xl text-xs font-semibold bg-red-500/20 text-red-200 border border-red-400/40 hover:bg-red-500/30 transition">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>

                        </div>
                    @empty
                        <div class="col-span-full py-12 text-center text-green-200/50">
                            <i class="bi bi-box-seam text-4xl mb-2 block opacity-50"></i>
                            <p class="text-sm">Belum ada paket katering yang dibuat.</p>
                        </div>
                    @endforelse

                </section>

            </main>

        </div>
    </div>

    {{-- MODAL HAPUS --}}
    <div id="delete-modal" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-green-800 border border-green-700 rounded-3xl max-w-md w-full p-6 shadow-xl relative">
            <button id="close-delete-modal" class="absolute top-3 right-3 text-yellow-300 text-xl font-bold hover:text-yellow-200">✕</button>
            <h3 class="text-xl font-semibold text-yellow-400 mb-3">Hapus Paket?</h3>
            <p class="text-sm text-green-100 leading-relaxed mb-5">
                Apakah kamu yakin ingin menghapus paket <span id="delete-package-name" class="font-semibold text-white"></span>?
                <br><span class="text-red-300 text-xs italic">Semua opsi harga dan jadwal terkait juga akan terhapus.</span>
            </p>
            <form id="delete-form" action="" method="POST" class="flex items-center justify-end gap-3">
                @csrf @method('DELETE')
                <button type="button" id="cancel-delete" class="px-4 py-2 rounded-full bg-green-900 text-green-100 text-xs font-semibold hover:bg-green-800 transition">Batal</button>
                <button type="submit" class="px-4 py-2 rounded-full bg-red-500 text-white text-xs font-semibold hover:bg-red-600 transition shadow-lg">Ya, Hapus</button>
            </form>
        </div>
    </div>

    <script>
        const deleteModal = document.getElementById('delete-modal');
        const closeDeleteModal = document.getElementById('close-delete-modal');
        const cancelDelete = document.getElementById('cancel-delete');
        const deleteForm = document.getElementById('delete-form');
        const deletePackageName = document.getElementById('delete-package-name');

        function openDeleteModal(id, name) {
            deleteForm.action = "/admin/paket/" + id; 
            deletePackageName.textContent = name;
            deleteModal.classList.remove('hidden');
        }
        function closeModal() { deleteModal.classList.add('hidden'); }

        closeDeleteModal.addEventListener('click', closeModal);
        cancelDelete.addEventListener('click', closeModal);
        deleteModal.addEventListener('click', (e) => { if (e.target === deleteModal) closeModal(); });
    </script>

    {{-- ALERT SUCCESS --}}
    @if(session('success'))
        <div class="fixed bottom-4 right-4 bg-emerald-600 text-white px-6 py-3 rounded-xl shadow-2xl animate-bounce text-xs font-bold z-50">
            <i class="bi bi-check-circle mr-2"></i> {{ session('success') }}
        </div>
    @endif

</body>
</html>