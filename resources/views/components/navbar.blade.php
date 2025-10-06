<header class="sticky top-0 z-50 bg-white/80 backdrop-blur border-b border-slate-400/60 drop-shadow-lg">
    <nav class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8" aria-label="KaloriKita">
        <div class="flex h-16 items-center justify-between">
            <!-- Left: Logo -->
            <a href="#" class="flex items-center gap-3 shrink-0 group" aria-label="KaloriKita Home">
                <img src="asset/logo-nobg.png" alt="logo" class="h-24">
            </a>

            <!-- Center: Desktop menu -->
            <ul class="hidden md:flex items-center gap-7 text-[15px] font-medium">
                <li><a href="#"
                        class="hover:text-green-800 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-green-700/40 rounded px-1 py-1">Home</a>
                </li>
                <li><a href="#"
                        class="hover:text-green-800 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-green-700/40 rounded px-1 py-1">Menu</a>
                </li>
                <li><a href="#"
                        class="hover:text-green-800 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-green-700/40 rounded px-1 py-1">Paket</a>
                </li>
                <li>
                    <a href="#"
                        class="inline-flex items-center gap-2 rounded-full bg-yellow-400 px-4 py-1 text-sm font-semibold hover:bg-yellow-300 active:translate-y-[1px] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-yellow-500/50">
                        Lab Kalori
                    </a>
                </li>
            </ul>

            <!-- Right: CTAs -->
            <div class="hidden md:flex items-center gap-3">
                <a href="#"
                    class="btn inline-flex items-center gap-2 rounded-full bg-yellow-400 px-5 py-2 text-sm font-semibold text-slate-900  hover:bg-yellow-300 active:translate-y-[1px] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-yellow-500/60">
                    Beli Paket
                </a>
                <a href="#"
                    class="btn inline-flex items-center rounded-full border-2 border-green-800 px-6 py-2 text-sm font-semibold text-green-800 hover:bg-green-50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-green-700/40">Masuk</a>
                <a href="#"
                    class="btn inline-flex items-center rounded-full bg-green-800 px-6 py-2 text-sm font-semibold text-white hover:bg-green-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-green-700/60">Daftar</a>
            </div>

            <!-- Mobile hamburger -->
            <button id="menuBtn"
                class="md:hidden inline-flex h-10 w-10 items-center justify-center rounded-md hover:bg-slate-100 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-green-700/40"
                aria-label="Buka menu">
                <svg id="menuIcon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="h-6 w-6">
                    <path d="M4 6h16v2H4zm0 5h16v2H4zm0 5h16v2H4z" />
                </svg>
            </button>
        </div>

        <!-- Mobile menu -->
        <div id="mobileMenu" class="md:hidden hidden border-t border-slate-200/60 py-3">
            <div class="flex flex-col gap-2 py-2">
                <a href="#" class="px-2 py-2 rounded hover:bg-slate-50">Home</a>
                <a href="#" class="px-2 py-2 rounded hover:bg-slate-50">Menu</a>
                <a href="#" class="px-2 py-2 rounded hover:bg-slate-50">Paket</a>
                <a href="#"
                    class="inline-flex items-center gap-2 self-start rounded-full bg-yellow-400 px-4 py-2 text-sm font-semibold shadow-[inset_0_-2px_0_rgba(0,0,0,.15)] hover:bg-yellow-300">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4">
                        <path
                            d="M9 2a1 1 0 0 0 0 2v3.382L3.553 18.105A2.5 2.5 0 0 0 5.823 22h12.354a2.5 2.5 0 0 0 2.27-3.895L14 7.382V4a1 1 0 0 0 0-2H9Zm2 7.236 5.764 9.987a.5.5 0 0 1-.437.75H5.973a.5.5 0 0 1-.438-.75L11 9.236Z" />
                    </svg>
                    Lab Kalori
                </a>
                <div class="mt-2 flex items-center gap-3">
                    <a href="#"
                        class="btn inline-flex items-center gap-2 rounded-full bg-yellow-400 px-4 py-2 text-sm font-semibold text-slate-900 shadow-[inset_0_-2px_0_rgba(0,0,0,.15)] hover:bg-yellow-300">
                        Beli Paket
                    </a>
                    <a href="#"
                        class="btn inline-flex items-center rounded-full border-2 border-green-800 px-5 py-2 text-sm font-semibold text-green-800 hover:bg-green-50">Masuk</a>
                    <a href="#"
                        class="btn inline-flex items-center rounded-full bg-green-800 px-5 py-2 text-sm font-semibold text-white hover:bg-green-700">Daftar</a>
                </div>
            </div>
        </div>
    </nav>
</header>
