<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Paket Katering - Admin KaloriKita</title>

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
            background-color: rgba(251, 191, 36, 0.5);
            border-radius: 999px;
        }
    </style>
</head>

<body class="bg-green-700/60">

    {{-- NAVBAR UTAMA --}}
    <x-navbar></x-navbar>

    @php
        $user = auth()->user();

        /** Dummy data jika controller belum mengirim $packages */
        $packages = $packages ?? [
            [
                'id' => 1,
                'name' => 'Paket Maintain 7 Hari',
                'slug' => 'maintain-7',
                'price' => 300000,
                'days' => 7,
                'status' => 'active',
                'description' => 'Paket untuk menjaga berat badan dengan pola makan seimbang selama 7 hari.',
            ],
            [
                'id' => 2,
                'name' => 'Paket Defisit 14 Hari',
                'slug' => 'defisit-14',
                'price' => 540000,
                'days' => 14,
                'status' => 'inactive',
                'description' => 'Paket diet kalori defisit untuk membantu penurunan berat badan.',
            ],
        ];
    @endphp

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="flex flex-col lg:flex-row gap-6">

            {{-- SIDEBAR ADMIN --}}
            <aside class="w-full lg:w-64 bg-green-800/90 border border-green-700/70 rounded-3xl p-5 h-max">

                {{-- Profile --}}
                <div class="flex items-center gap-3 mb-6">
                    <div
                        class="w-10 h-10 rounded-2xl bg-yellow-400 text-green-900 flex items-center justify-center font-extrabold">
                        {{ strtoupper(mb_substr($user->name ?? 'A', 0, 1)) }}
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-white">{{ $user->name }}</p>
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

                {{-- HEADER + TOMBOL AKSI --}}
                <section class="bg-green-800/90 border border-green-700/70 rounded-3xl p-6 shadow-xl">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <h1 class="text-xl sm:text-2xl font-semibold text-white">Paket Katering</h1>
                            <p class="text-xs text-green-100/70 mt-1">
                                Kelola daftar paket katering untuk pelanggan.
                            </p>
                        </div>

                        <div class="flex flex-wrap gap-2 justify-start md:justify-end">
                            {{-- Tombol Buat Paket Baru --}}
                            <a href="{{ route('admin.paket.create') }}"
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-yellow-400 text-green-900 font-semibold text-xs hover:bg-yellow-300">
                                + Buat Paket Baru
                            </a>

                            {{-- Tombol Kelola Menu (master menu) --}}
                            <a href="{{ route('admin.menu.index') }}"
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/80 text-green-900 font-semibold text-xs hover:bg-white">
                                Kelola Menu
                            </a>

                            {{-- Tombol Kelola Batch / Jadwal --}}
                            <a href="{{ route('admin.batch.index') }}"
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-green-900 text-yellow-300 font-semibold text-xs hover:bg-green-800">
                                Kelola Batch
                            </a>
                        </div>
                    </div>
                </section>

                {{-- CARD LIST PAKET --}}
                <section class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

                    @foreach ($packages as $p)
                        @php
                            $statusColor =
                                $p['status'] === 'active'
                                    ? 'bg-emerald-400/20 text-emerald-200 border-emerald-400/40'
                                    : 'bg-red-400/20 text-red-200 border-red-400/40';
                        @endphp

                        <div
                            class="bg-green-800/90 border border-green-700/70 rounded-3xl p-5 shadow-xl flex flex-col justify-between">

                            {{-- Nama Paket --}}
                            <div>
                                <h2 class="text-lg font-semibold text-white">{{ $p['name'] }}</h2>
                                <p class="text-[11px] text-green-100/70 mb-3">
                                    {{ $p['description'] }}
                                </p>

                                <div class="flex items-center gap-2 mb-4">
                                    <span class="text-yellow-300 font-bold text-lg">
                                        Rp {{ number_format($p['price'], 0, ',', '.') }}
                                    </span>
                                    <span class="text-green-100/60 text-xs">
                                        / {{ $p['days'] }} hari
                                    </span>
                                </div>

                                <span
                                    class="inline-flex px-3 py-1 rounded-full border text-[11px] font-semibold {{ $statusColor }}">
                                    {{ $p['status'] === 'active' ? 'Aktif' : 'Tidak Aktif' }}
                                </span>
                            </div>

                            {{-- Aksi --}}
                            <div class="mt-5 flex flex-wrap gap-2">
                                <a href="{{ route('admin.paket.edit', $p['id']) }}"
                                    class="px-4 py-2 rounded-full text-xs font-semibold bg-white/10 text-green-50 border border-green-500/60 hover:bg-white/20">
                                    Edit
                                </a>

                                <a href="{{ route('admin.paket.show', $p['id']) }}"
                                    class="px-4 py-2 rounded-full text-xs font-semibold bg-white/10 text-green-50 border border-green-500/60 hover:bg-white/20">
                                    Detail
                                </a>

                                <button type="button"
                                    onclick="openDeleteModal({{ $p['id'] }}, @js($p['name']))"
                                    class="px-4 py-2 rounded-full text-xs font-semibold bg-red-500/20 text-red-200 border border-red-400/40 hover:bg-red-500/30">
                                    Hapus
                                </button>
                            </div>

                        </div>
                    @endforeach

                </section>

            </main>

        </div>
    </div>

    {{-- MODAL HAPUS PAKET --}}
    <div id="delete-modal"
        class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center p-4">

        <div class="bg-green-800 border border-green-700 rounded-3xl max-w-md w-full p-6 shadow-xl relative">

            {{-- Close Button --}}
            <button id="close-delete-modal"
                class="absolute top-3 right-3 text-yellow-300 text-xl font-bold hover:text-yellow-200">
                ✕
            </button>

            <h3 class="text-xl font-semibold text-yellow-400 mb-3">
                Hapus Paket?
            </h3>

            <p class="text-sm text-green-100 leading-relaxed mb-5">
                Apakah kamu yakin ingin menghapus paket <span id="delete-package-name" class="font-semibold"></span>?
                Tindakan ini tidak dapat dibatalkan.
            </p>

            {{-- FORM DELETE --}}
            <form id="delete-form" action="" method="POST" class="flex items-center justify-end gap-3">
                @csrf
                @method('DELETE')

                <button type="button" id="cancel-delete"
                    class="px-4 py-2 rounded-full bg-green-900 text-green-100 text-xs font-semibold hover:bg-green-800 transition">
                    Batal
                </button>

                <button type="submit"
                    class="px-4 py-2 rounded-full bg-red-500 text-white text-xs font-semibold hover:bg-red-600 transition">
                    Hapus
                </button>
            </form>
        </div>
    </div>

    <script>
        const deleteModal = document.getElementById('delete-modal');
        const closeDeleteModal = document.getElementById('close-delete-modal');
        const cancelDelete = document.getElementById('cancel-delete');
        const deleteForm = document.getElementById('delete-form');
        const deletePackageName = document.getElementById('delete-package-name');

        // Buka modal
        function openDeleteModal(id, name) {
            deleteForm.action = "/admin/paket/" + id; // route('admin.paket.destroy', id)
            deletePackageName.textContent = name;
            deleteModal.classList.remove('hidden');
        }

        // Tutup modal
        function closeModal() {
            deleteModal.classList.add('hidden');
        }

        closeDeleteModal.addEventListener('click', closeModal);
        cancelDelete.addEventListener('click', closeModal);

        deleteModal.addEventListener('click', (e) => {
            if (e.target === deleteModal) closeModal();
        });
    </script>

</body>

</html>
