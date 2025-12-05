<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Log KaloriLab (AI) - Admin KaloriKita</title>

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
         * $log = [
         *   'id'             => 1,
         *   'user_id'        => 3,
         *   'user_name'      => 'Ibnu Effendi',
         *   'user_email'     => 'ibnu@example.com',
         *   'user_phone'     => '08xxxx',
         *   'gender'         => 'L',
         *   'age'            => 18,
         *   'height'         => 160,
         *   'weight'         => 45,
         *   'activity_level' => 'Sedang',
         *   'goal'           => 'defisit', // defisit / maintain / surplus
         *   'bmi'            => 17.6,
         *   'bmr'            => 1400,
         *   'calorie_target' => 2200,
         *   'protein_target' => 110,
         *   'carb_target'    => 280,
         *   'fat_target'     => 60,
         *   'status'         => 'success', // success / error
         *   'error_message'  => null,
         *   'model'          => 'gemini-2.0-flash',
         *   'tokens_input'   => 800,
         *   'tokens_output'  => 450,
         *   'insight'        => 'Teks insight lengkap dari AI...',
         *   'created_at'     => '2025-12-05 10:20:00',
         *   'updated_at'     => '2025-12-05 10:21:00',
         *   'raw_payload'    => null, // opsional JSON input/response
         * ];
         */

        $log = $log ?? [];

        function lg($row, $key, $default = null) {
            if (is_array($row)) {
                return $row[$key] ?? $default;
            }
            if (is_object($row)) {
                return $row->{$key} ?? $default;
            }
            return $default;
        }

        $id        = lg($log, 'id');
        $userId    = lg($log, 'user_id');
        $userName  = lg($log, 'user_name', 'Pengguna');
        $userEmail = lg($log, 'user_email', '-');
        $userPhone = lg($log, 'user_phone', '-');

        $gender   = lg($log, 'gender', null);
        $age      = lg($log, 'age', null);
        $height   = lg($log, 'height', null);
        $weight   = lg($log, 'weight', null);
        $activity = lg($log, 'activity_level', '-');
        $goal     = lg($log, 'goal', '-');

        $bmi      = lg($log, 'bmi', null);
        $bmr      = lg($log, 'bmr', null);
        $cal      = lg($log, 'calorie_target', null);
        $prot     = lg($log, 'protein_target', null);
        $carb     = lg($log, 'carb_target', null);
        $fat      = lg($log, 'fat_target', null);

        $status      = lg($log, 'status', 'success');
        $errorMsg    = lg($log, 'error_message', null);
        $model       = lg($log, 'model', '-');
        $tokensIn    = lg($log, 'tokens_input', null);
        $tokensOut   = lg($log, 'tokens_output', null);
        $insight     = lg($log, 'insight', null);
        $rawPayload  = lg($log, 'raw_payload', null);

        $createdAt = lg($log, 'created_at', null);
        $updatedAt = lg($log, 'updated_at', null);

        if ($createdAt instanceof \Carbon\Carbon) {
            $createdFormatted = $createdAt->format('d M Y H:i');
        } elseif ($createdAt) {
            $createdFormatted = date('d M Y H:i', strtotime($createdAt));
        } else {
            $createdFormatted = '-';
        }

        if ($updatedAt instanceof \Carbon\Carbon) {
            $updatedFormatted = $updatedAt->format('d M Y H:i');
        } elseif ($updatedAt) {
            $updatedFormatted = date('d M Y H:i', strtotime($updatedAt));
        } else {
            $updatedFormatted = '-';
        }

        // label goal
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

        // status badge
        if ($status === 'error') {
            $statusLabel = 'Error';
            $statusColor = 'bg-red-400/20 text-red-200 border-red-400/40';
        } else {
            $statusLabel = 'Berhasil';
            $statusColor = 'bg-emerald-400/20 text-emerald-200 border-emerald-400/40';
        }

        $genderLabel = match ($gender) {
            'L', 'l', 'male'   => 'Laki-laki',
            'P', 'p', 'female' => 'Perempuan',
            default            => '-',
        };
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
                       {{ request()->routeIs('admin.ai.*') || request()->routeIs('admin.ai.logs') || request()->routeIs('admin.ai.logs.show') ? 'bg-white text-green-900 font-semibold' : 'text-green-100 hover:bg-green-700/70' }}">
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
                            <p class="text-[11px] text-green-100/70 mb-1">
                                <a href="{{ route('admin.ai.logs') }}" class="hover:underline">Log KaloriLab (AI)</a>
                                <span class="mx-1">/</span>
                                <span class="text-green-100/50">Detail Log</span>
                            </p>
                            <h1 class="text-xl sm:text-2xl font-semibold text-white">
                                Log #{{ $id ?? '-' }}
                            </h1>
                            <p class="text-xs text-green-100/70 mt-1">
                                Dibuat: {{ $createdFormatted }} • Diperbarui: {{ $updatedFormatted }}
                            </p>
                        </div>

                        <div class="flex flex-wrap gap-2 justify-end">
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full border text-[11px] font-semibold {{ $statusColor }}">
                                Status: {{ $statusLabel }}
                            </span>

                            @if ($goalLabel !== '-')
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full border text-[11px] font-semibold bg-yellow-400/20 text-yellow-100 border-yellow-400/40">
                                    Tujuan: {{ $goalLabel }}
                                </span>
                            @endif

                            <a href="{{ route('admin.ai.logs') }}"
                               class="inline-flex items-center px-4 py-2 rounded-full bg-green-900/80 text-green-50 text-xs font-semibold hover:bg-green-900">
                                ‹ Kembali
                            </a>
                        </div>
                    </div>
                </section>

                {{-- GRID UTAMA --}}
                <section class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                    {{-- KIRI: Info pengguna + input --}}
                    <div class="lg:col-span-1 space-y-6">

                        {{-- Info Pengguna --}}
                        <div class="bg-green-800/90 border border-green-700/70 rounded-3xl p-5 shadow-xl">
                            <h2 class="text-sm font-semibold text-white mb-3">Informasi Pengguna</h2>

                            <p class="text-[13px] font-semibold text-green-50">
                                {{ $userName }}
                            </p>
                            <p class="text-[11px] text-green-100/80 mt-1">{{ $userEmail }}</p>
                            <p class="text-[11px] text-green-100/80 mt-1">Telp: {{ $userPhone }}</p>

                            @if ($userId)
                                <a href="{{ route('admin.users.show', $userId) }}"
                                   class="mt-3 inline-flex items-center px-4 py-2 rounded-full bg-white/10 text-[11px] text-green-50 border border-green-500/60 hover:bg-white/20 transition">
                                    Lihat Profil Pengguna
                                </a>
                            @endif
                        </div>

                        {{-- Input Awal --}}
                        <div class="bg-green-800/90 border border-green-700/70 rounded-3xl p-5 shadow-xl">
                            <h2 class="text-sm font-semibold text-white mb-3">Data Input KaloriLab</h2>

                            <dl class="grid grid-cols-1 gap-y-2 text-xs text-green-100/85">
                                <div>
                                    <dt class="text-green-200/70">Jenis Kelamin</dt>
                                    <dd class="font-semibold">{{ $genderLabel }}</dd>
                                </div>
                                <div>
                                    <dt class="text-green-200/70">Usia</dt>
                                    <dd class="font-semibold">{{ $age ? $age . ' tahun' : '-' }}</dd>
                                </div>
                                <div>
                                    <dt class="text-green-200/70">Tinggi Badan</dt>
                                    <dd class="font-semibold">{{ $height ? $height . ' cm' : '-' }}</dd>
                                </div>
                                <div>
                                    <dt class="text-green-200/70">Berat Badan</dt>
                                    <dd class="font-semibold">{{ $weight ? $weight . ' kg' : '-' }}</dd>
                                </div>
                                <div>
                                    <dt class="text-green-200/70">Aktivitas Fisik</dt>
                                    <dd class="font-semibold">{{ $activity }}</dd>
                                </div>
                                <div>
                                    <dt class="text-green-200/70">Tujuan</dt>
                                    <dd class="font-semibold">{{ $goalLabel }}</dd>
                                </div>
                            </dl>
                        </div>

                        {{-- Info Teknis AI --}}
                        <div class="bg-green-800/90 border border-green-700/70 rounded-3xl p-5 shadow-xl">
                            <h2 class="text-sm font-semibold text-white mb-3">Info Teknis AI</h2>

                            <dl class="grid grid-cols-1 gap-y-2 text-xs text-green-100/85">
                                <div>
                                    <dt class="text-green-200/70">Model</dt>
                                    <dd class="font-semibold">{{ $model }}</dd>
                                </div>
                                <div>
                                    <dt class="text-green-200/70">Token Input</dt>
                                    <dd class="font-semibold">
                                        {{ $tokensIn !== null ? number_format($tokensIn, 0, ',', '.') : '-' }}
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-green-200/70">Token Output</dt>
                                    <dd class="font-semibold">
                                        {{ $tokensOut !== null ? number_format($tokensOut, 0, ',', '.') : '-' }}
                                    </dd>
                                </div>
                            </dl>

                            @if ($errorMsg)
                                <div class="mt-3 text-[11px] text-red-200/90 bg-red-900/40 border border-red-600/60 rounded-2xl px-3 py-2">
                                    <p class="font-semibold mb-1">Pesan Error:</p>
                                    <p>{{ $errorMsg }}</p>
                                </div>
                            @endif
                        </div>

                    </div>

                    {{-- KANAN: Hasil & Insight --}}
                    <div class="lg:col-span-2 space-y-6">

                        {{-- Ringkasan hasil numerik --}}
                        <div class="bg-green-800/90 border border-green-700/70 rounded-3xl p-6 shadow-xl">
                            <h2 class="text-sm font-semibold text-white mb-3">Ringkasan Hasil Perhitungan</h2>

                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 text-xs text-green-100/85">
                                <div
                                    class="rounded-2xl bg-green-900/60 border border-green-600/70 px-4 py-3 flex flex-col gap-1">
                                    <p class="text-[11px] text-green-200/80">BMI</p>
                                    <p class="text-lg font-semibold text-yellow-300">
                                        {{ $bmi !== null ? number_format($bmi, 1) : '-' }}
                                    </p>
                                </div>

                                <div
                                    class="rounded-2xl bg-green-900/60 border border-green-600/70 px-4 py-3 flex flex-col gap-1">
                                    <p class="text-[11px] text-green-200/80">BMR</p>
                                    <p class="text-lg font-semibold text-yellow-300">
                                        {{ $bmr !== null ? number_format($bmr, 0, ',', '.') . ' kkal' : '-' }}
                                    </p>
                                </div>

                                <div
                                    class="rounded-2xl bg-green-900/60 border border-green-600/70 px-4 py-3 flex flex-col gap-1">
                                    <p class="text-[11px] text-green-200/80">Target Kalori</p>
                                    <p class="text-lg font-semibold text-yellow-300">
                                        {{ $cal !== null ? number_format($cal, 0, ',', '.') . ' kkal' : '-' }}
                                    </p>
                                </div>

                                <div
                                    class="rounded-2xl bg-green-900/60 border border-green-600/70 px-4 py-3 flex flex-col gap-1">
                                    <p class="text-[11px] text-green-200/80">Rasio Makro</p>
                                    <p class="text-[11px] font-semibold text-green-100">
                                        P: {{ $prot ?? '-' }} g • K: {{ $carb ?? '-' }} g • L: {{ $fat ?? '-' }} g
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- Insight Lengkap --}}
                        <div class="bg-green-800/90 border border-green-700/70 rounded-3xl p-6 shadow-xl">
                            <div class="flex items-center justify-between mb-3">
                                <h2 class="text-sm font-semibold text-white">Insight Lengkap KaloriLab</h2>
                                <a href="/kalori-lab"
                                   class="inline-flex items-center px-4 py-2 rounded-full bg-yellow-400 text-green-900 text-xs font-semibold hover:bg-yellow-300 transition">
                                    Buka KaloriLab
                                </a>
                            </div>

                            @if ($insight)
                                <div class="text-xs text-green-100 leading-relaxed max-h-[320px] overflow-y-auto scroll-thin pr-1 whitespace-pre-line">
                                    {{ $insight }}
                                </div>
                            @else
                                <p class="text-xs text-green-100/80">
                                    Belum ada teks insight yang tersimpan untuk log ini.
                                </p>
                            @endif
                        </div>

                        {{-- Raw Payload (opsional debug) --}}
                        @if ($rawPayload)
                            <div class="bg-green-800/90 border border-green-700/70 rounded-3xl p-6 shadow-xl">
                                <h2 class="text-sm font-semibold text-white mb-3">Raw Payload (Debug)</h2>
                                <div class="bg-green-950/80 rounded-2xl p-3 text-[11px] text-green-50 font-mono max-h-64 overflow-y-auto scroll-thin">
                                    <pre class="whitespace-pre-wrap break-all">{{ $rawPayload }}</pre>
                                </div>
                                <p class="text-[10px] text-green-100/60 mt-2">
                                    Bagian ini hanya untuk keperluan debugging internal (tidak ditampilkan ke pengguna biasa).
                                </p>
                            </div>
                        @endif

                    </div>

                </section>

            </main>

        </div>
    </div>

</body>

</html>
