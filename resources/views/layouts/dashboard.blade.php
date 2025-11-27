<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard - KaloriKita')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Tailwind CDN (kalau kamu sudah pakai Vite, tinggal ganti) --}}
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <style>
        body { font-family: 'Instrument Sans', sans-serif; }
    </style>
</head>
<body class="bg-green-900 text-white min-h-screen flex flex-col">

    {{-- NAVBAR UTAMA --}}
    <x-navbar></x-navbar>

    {{-- WRAPPER DASHBOARD --}}
    <div class="flex-1 w-full">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 lg:py-10">
            <div class="flex flex-col lg:flex-row gap-6 lg:gap-8">

                {{-- SIDEBAR --}}
                <aside
                    class="w-full lg:w-64 bg-green-800/80 border border-green-600/40 rounded-2xl p-4 lg:p-5 shadow-xl backdrop-blur-sm">
                    
                    {{-- Profil singkat --}}
                    <div class="flex items-center gap-3 mb-5 pb-4 border-b border-green-600/40">
                        <div
                            class="w-11 h-11 rounded-full bg-yellow-400 text-green-900 flex items-center justify-center font-bold text-lg uppercase">
                            {{ substr(auth()->user()->name ?? 'U', 0, 1) }}
                        </div>
                        <div class="min-w-0">
                            <p class="text-sm font-semibold truncate">
                                {{ auth()->user()->name ?? 'User KaloriKita' }}
                            </p>
                            <p class="text-[11px] text-green-200 capitalize">
                                {{ auth()->user()->role ?? 'user' }}
                            </p>
                        </div>
                    </div>

                    {{-- MENU NAV --}}
                    @php
                        $menuItems = [
                            [
                                'label' => 'Dashboard',
                                'route' => 'profil.dashboard',
                                'icon'  => 'home',
                            ],
                            [
                                'label' => 'Pesanan Saya',
                                'route' => 'profil.myorder',
                                'icon'  => 'order',
                            ],
                            [
                                'label' => 'Kalori Tracker',
                                'route' => 'profil.kalori.tracker',
                                'icon'  => 'fire',
                            ],
                            [
                                'label' => 'Paket Katering',
                                'route' => 'paket.list',
                                'icon'  => 'box',
                            ],
                            [
                                'label' => 'KaloriLab (AI)',
                                'route' => 'kalori-lab',
                                'icon'  => 'lab',
                            ],
                        ];
                    @endphp

                    <nav class="space-y-1 mb-6">
                        @foreach ($menuItems as $item)
                            @php
                                $isActive = request()->routeIs($item['route']);
                            @endphp
                            <a href="{{ route($item['route']) }}"
                               class="flex items-center gap-3 px-3 py-2 rounded-xl text-sm font-medium
                               transition-all
                               {{ $isActive
                                    ? 'bg-yellow-400 text-green-900 shadow-md'
                                    : 'text-green-100 hover:bg-green-700/80 hover:text-white' }}">
                                {{-- Ikon sederhana pakai SVG kecil --}}
                                @switch($item['icon'])
                                    @case('home')
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M3 12l9-9 9 9M5 10v10h5v-6h4v6h5V10"/>
                                        </svg>
                                        @break
                                    @case('order')
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M4 5h16M4 9h16M4 15h10M4 19h6"/>
                                        </svg>
                                        @break
                                    @case('fire')
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M12 3C7 8 17 10 12 21c-5-2-7-6-7-9a7 7 0 0114 0c0 3-2 7-7 9"/>
                                        </svg>
                                        @break
                                    @case('box')
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M3 7l9-4 9 4-9 4-9-4z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M3 7v10l9 4 9-4V7"/>
                                        </svg>
                                        @break
                                    @case('lab')
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M9 3v5.5L5.5 17A2 2 0 007.4 20h9.2a2 2 0 001.9-3L15 8.5V3"/>
                                        </svg>
                                        @break
                                @endswitch

                                <span class="truncate">{{ $item['label'] }}</span>
                            </a>
                        @endforeach
                    </nav>

                    {{-- STATUS GOOGLE & LOGOUT --}}
                    <div class="space-y-3 border-t border-green-600/40 pt-4">
                        @auth
                            @if (!auth()->user()->google_id)
                                <a href="{{ route('google.login') }}"
                                   class="flex items-center justify-center gap-2 w-full text-[11px] font-semibold
                                          bg-white text-green-900 rounded-full py-2 px-3 hover:bg-yellow-300
                                          transition shadow">
                                    <svg class="w-4 h-4" viewBox="0 0 24 24">
                                        <path fill="#EA4335"
                                              d="M12 10.2v3.9h5.4c-.2 1.2-.9 2.3-1.9 3.1l3.1 2.4C20.5 18.2 21.2 16.2 21.2 14c0-.7-.1-1.3-.2-1.9H12z"/>
                                        <path fill="#34A853"
                                              d="M6.5 14.3l-.8.6-2.5 1.9C4.5 19.5 8 21.6 12 21.6c2.4 0 4.5-.8 6-2.1l-3.1-2.4c-.8.5-1.8.8-2.9.8-2.2 0-4-1.5-4.6-3.6z"/>
                                        <path fill="#4A90E2"
                                              d="M3.2 8.8C2.5 10 2.1 11.4 2.1 12.8c0 1.4.4 2.8 1.1 4l3.4-2.6c-.2-.5-.3-1-.3-1.5 0-.5.1-1 .3-1.5z"/>
                                        <path fill="#FBBC05"
                                              d="M12 4.9c1.3 0 2.4.4 3.3 1.3l2.5-2.5C16.4 2.4 14.3 1.6 12 1.6c-4 0-7.5 2.1-9.3 5.3l3.4 2.6C6 6.4 7.8 4.9 10 4.9z"/>
                                    </svg>
                                    <span>Hubungkan Google</span>
                                </a>
                            @else
                                <div class="flex items-center gap-2 text-[11px] text-green-100">
                                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                                    <span>Akun sudah terhubung ke Google</span>
                                </div>
                            @endif
                        @endauth

                        <form action="{{ route('logout') }}" method="POST" class="mt-1">
                            @csrf
                            <button type="submit"
                                    class="w-full flex items-center justify-center gap-2 text-[11px] font-semibold
                                           px-3 py-2 rounded-full border border-red-400 text-red-300
                                           hover:bg-red-500 hover:text-white hover:border-transparent
                                           transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M15 3h4a2 2 0 012 2v14a2 2 0 01-2 2h-4"/>
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M10 17l5-5-5-5"/>
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M15 12H3"/>
                                </svg>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </aside>

                {{-- KONTEN DINAMIS DASHBOARD --}}
                <main class="flex-1">
                    @yield('content')
                </main>

            </div>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
