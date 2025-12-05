<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log KaloriLab (AI) - Admin KaloriKita</title>

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
            background-color: rgba(251, 191, 36, 0.4);
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
         * Controller diharapkan mengirim:
         *
         * $logs = [
         *   [
         *     'id'          => 1,
         *     'user_name'  => 'Ibnu Effendi',
         *     'user_email' => 'ibnu@example.com',
         *     'user_id'    => 3,
         *     'created_at' => '2025-12-05 10:20:00',
         *     'bmi'        => 19.5,
         *     'bmr'        => 1450,
         *     'calorie_target' => 2200,
         *     'goal'       => 'defisit', // defisit / maintain / surplus
         *     'activity_level' => 'Sedang',
         *     'status'     => 'success', // success / error
         *     'error_message' => null,
         *   ],
         *   ...
         * ];
         */

        $logs = $logs ?? [];

        function lget($row, $key, $default = null)
        {
            if (is_array($row)) {
                return $row[$key] ?? $default;
            }
            if (is_object($row)) {
                return $row->{$key} ?? $default;
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
                       {{ request()->routeIs('admin.ai.*') || request()->routeIs('admin.ai.logs') ? 'bg-white text-green-900 font-semibold' : 'text-green-100 hover:bg-green-700/70' }}">
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

                {{-- HEADER --}}
                <section class="bg-green-800/90 border border-green-700/60 rounded-3xl p-6 shadow-xl">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <h1 class="text-xl sm:text-2xl font-semibold text-white">Log KaloriLab (AI)</h1>
                            <p class="text-xs text-green-100/70 mt-1">
                                Pantau penggunaan fitur KaloriLab oleh pengguna: siapa yang pakai, kapan, dan hasilnya.
                            </p>
                        </div>

                        <div class="flex flex-wrap gap-2 text-xs">
                            <div
                                class="px-3 py-2 rounded-2xl bg-green-900/70 border border-green-600/70 text-green-100/90">
                                <p class="text-[10px] uppercase tracking-wide text-green-200/70">Total Log</p>
                                <p class="font-semibold text-sm">{{ is_countable($logs) ? count($logs) : 0 }}</p>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- FILTER BAR --}}
                <section class="bg-green-800/90 border border-green-700/60 rounded-3xl p-6 shadow-xl text-xs">
                    <h2 class="text-sm font-semibold text-white mb-3">Filter</h2>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
                        <div>
                            <label class="block text-green-100/80 mb-1">Cari Pengguna</label>
                            <input type="text" placeholder="Nama atau email..."
                                class="w-full rounded-2xl border border-green-600/60 bg-green-900/60 text-green-50 px-3 py-2 text-xs placeholder:text-green-200/40 focus:outline-none focus:ring-1 focus:ring-yellow-300">
                        </div>

                        <div>
                            <label class="block text-green-100/80 mb-1">Status</label>
                            <select
                                class="w-full rounded-2xl border border-green-600/60 bg-green-900/60 text-green-50 px-3 py-2 text-xs focus:outline-none focus:ring-1 focus:ring-yellow-300">
                                <option value="">Semua</option>
                                <option value="success">Berhasil</option>
                                <option value="error">Error</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-green-100/80 mb-1">Goal</label>
                            <select
                                class="w-full rounded-2xl border border-green-600/60 bg-green-900/60 text-green-50 px-3 py-2 text-xs focus:outline-none focus:ring-1 focus:ring-yellow-300">
                                <option value="">Semua</option>
                                <option value="defisit">Defisit</option>
                                <option value="maintain">Maintain</option>
                                <option value="surplus">Surplus</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-green-100/80 mb-1">Rentang Tanggal</label>
                            <input type="date"
                                class="w-full rounded-2xl border border-green-600/60 bg-green-900/60 text-green-50 px-3 py-2 text-xs focus:outline-none focus:ring-1 focus:ring-yellow-300">
                        </div>
                    </div>

                    <div class="mt-4 flex justify-end gap-2">
                        <button
                            class="px-4 py-2 rounded-full bg-green-900 text-green-100 hover:bg-green-800 transition">
                            Reset
                        </button>
                        <button
                            class="px-4 py-2 rounded-full bg-yellow-400 text-green-900 font-semibold hover:bg-yellow-300 transition">
                            Terapkan Filter
                        </button>
                    </div>
                </section>

                {{-- TABEL LOG --}}
                <section class="bg-green-800/90 border border-green-700/60 rounded-3xl p-6 shadow-xl">

                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-sm font-semibold text-white">Daftar Log KaloriLab</h2>
                        <span class="text-[11px] text-green-100/70">
                            {{ is_countable($logs) ? count($logs) : 0 }} log
                        </span>
                    </div>

                    @if (!is_countable($logs) || count($logs) === 0)
                        <div
                            class="border border-dashed border-green-600/80 rounded-2xl p-6 text-center text-xs text-green-100/80">
                            <p>Belum ada log KaloriLab.</p>
                            <p class="text-green-100/60 mt-1">
                                Saat pengguna menggunakan KaloriLab dan menyimpan hasilnya, log akan muncul di sini.
                            </p>
                        </div>
                    @else
                        <div class="overflow-x-auto scroll-thin">
                            <table class="min-w-full text-xs text-left text-green-50">
                                <thead>
                                    <tr class="border-b border-green-700/80 text-[11px] uppercase text-green-200/70">
                                        <th class="py-2 pr-4">Waktu</th>
                                        <th class="py-2 pr-4">Pengguna</th>
                                        <th class="py-2 pr-4">Goal</th>
                                        <th class="py-2 pr-4">Target Kalori</th>
                                        <th class="py-2 pr-4">BMI / BMR</th>
                                        <th class="py-2 pr-4">Status</th>
                                        <th class="py-2 pr-4 text-right">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-green-700/70">
                                    @foreach ($logs as $log)
                                        @php
                                            $id = lget($log, 'id');
                                            $userName = lget($log, 'user_name', 'Pengguna');
                                            $userEmail = lget($log, 'user_email', '-');
                                            $userId = lget($log, 'user_id');
                                            $goal = lget($log, 'goal', '-');
                                            $activity = lget($log, 'activity_level', '-');
                                            $calTarget = lget($log, 'calorie_target', null);
                                            $bmi = lget($log, 'bmi', null);
                                            $bmr = lget($log, 'bmr', null);
                                            $status = lget($log, 'status', 'success');
                                            $errorMsg = lget($log, 'error_message', null);
                                            $createdAt = lget($log, 'created_at', null);

                                            if ($createdAt instanceof \Carbon\Carbon) {
                                                $createdFormatted = $createdAt->format('d M Y H:i');
                                            } elseif ($createdAt) {
                                                $createdFormatted = date('d M Y H:i', strtotime($createdAt));
                                            } else {
                                                $createdFormatted = '-';
                                            }

                                            // goal label
                                            switch ($goal) {
                                                case 'defisit':
                                                    $goalLabel = 'Defisit (Turun BB)';
                                                    break;
                                                case 'surplus':
                                                    $goalLabel = 'Surplus (Naik BB)';
                                                    break;
                                                case 'maintain':
                                                    $goalLabel = 'Maintain (Stabil)';
                                                    break;
                                                default:
                                                    $goalLabel = '-';
                                                    break;
                                            }

                                            // status label
                                            if ($status === 'error') {
                                                $statusLabel = 'Error';
                                                $statusColor = 'bg-red-400/20 text-red-200 border-red-400/40';
                                            } else {
                                                $statusLabel = 'Berhasil';
                                                $statusColor =
                                                    'bg-emerald-400/20 text-emerald-200 border-emerald-400/40';
                                            }
                                        @endphp

                                        <tr class="hover:bg-green-900/40 transition">
                                            <td class="py-3 pr-4 align-top">
                                                <p class="text-[11px] text-green-100/80">
                                                    {{ $createdFormatted }}
                                                </p>
                                            </td>

                                            <td class="py-3 pr-4 align-top">
                                                <p class="font-semibold text-[13px]">{{ $userName }}</p>
                                                <p class="text-[11px] text-green-200/70">{{ $userEmail }}</p>
                                                @if ($activity)
                                                    <p class="text-[10px] text-green-200/60 mt-0.5">
                                                        Aktivitas: {{ $activity }}
                                                    </p>
                                                @endif
                                            </td>

                                            <td class="py-3 pr-4 align-top">
                                                <p class="text-[11px] text-green-100/85">{{ $goalLabel }}</p>
                                            </td>

                                            <td class="py-3 pr-4 align-top">
                                                @if ($calTarget)
                                                    <p class="text-[13px] font-semibold text-yellow-300">
                                                        {{ $calTarget }} kkal
                                                    </p>
                                                @else
                                                    <p class="text-[11px] text-green-100/70">-</p>
                                                @endif
                                            </td>

                                            <td class="py-3 pr-4 align-top">
                                                <p class="text-[11px] text-green-100/80">
                                                    BMI:
                                                    <span class="font-semibold">
                                                        {{ $bmi !== null ? number_format($bmi, 1) : '-' }}
                                                    </span>
                                                </p>
                                                <p class="text-[11px] text-green-100/80">
                                                    BMR:
                                                    <span class="font-semibold">
                                                        {{ $bmr !== null ? number_format($bmr, 0) . ' kkal' : '-' }}
                                                    </span>
                                                </p>
                                            </td>

                                            <td class="py-3 pr-4 align-top">
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full border text-[11px] font-semibold {{ $statusColor }}">
                                                    {{ $statusLabel }}
                                                </span>

                                                @if ($errorMsg)
                                                    <p class="mt-1 text-[10px] text-red-200/80 max-w-xs">
                                                        {{ Str::limit($errorMsg, 60) }}
                                                    </p>
                                                @endif
                                            </td>

                                            <td class="py-3 pr-0 align-top">
                                                <div class="flex flex-col items-end gap-1">
                                                    {{-- nanti bisa diarahkan ke halaman detail log kalau kamu buat --}}
                                                    <a href="{{ route('admin.ai.logs.show', $id) }}"
                                                        class="inline-flex items-center px-3 py-1 rounded-full bg-white/10 text-[11px] text-green-50 border border-green-500/60 hover:bg-white/20 transition">
                                                        Lihat Insight Lengkap
                                                    </a>


                                                    @if ($userId)
                                                        <a href="{{ route('admin.users.show', $userId) }}"
                                                            class="inline-flex items-center px-3 py-1 rounded-full bg-green-900/80 text-[11px] text-green-50 border border-green-600/60 hover:bg-green-900 transition">
                                                            Profil Pengguna
                                                        </a>
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
                                <button class="px-3 py-1 rounded-full bg-yellow-400 text-green-900 font-semibold">
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
