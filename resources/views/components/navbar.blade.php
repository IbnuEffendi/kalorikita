<header class="sticky top-0 z-50 bg-white/80 backdrop-blur border-b border-slate-400/60 drop-shadow-lg">
  <nav class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8" aria-label="KaloriKita">
    <div class="flex h-16 items-center justify-between">
      <a href="{{ url('/') }}" class="flex items-center gap-3 shrink-0 group" aria-label="KaloriKita Home">
        <img src="{{ asset('asset/logo-nobg.png') }}" alt="logo" class="h-24">
      </a>

      <ul class="hidden md:flex items-center gap-7 text-[15px] font-medium">
        <li>
          <a href="{{ url('/') }}"
             class="hover:text-green-800 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-green-700/40 rounded px-1 py-1">
            Home
          </a>
        </li>
        <li>
          <a href="{{ url('/menu') }}"
             class="hover:text-green-800 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-green-700/40 rounded px-1 py-1">
            Menu
          </a>
        </li>
        <li>
          <a href="{{ route('paket.list') }}"
             class="hover:text-green-800 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-green-700/40 rounded px-1 py-1">
            Paket
          </a>
        </li>
        <li>
          <a href="{{ url('/kalori-lab') }}"
             class="inline-flex items-center gap-2 rounded-full bg-yellow-400 px-4 py-1 text-sm font-semibold hover:bg-yellow-300 active:translate-y-[1px] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-yellow-500/50">
            Lab Kalori
          </a>
        </li>
      </ul>

      <div class="hidden md:flex items-center gap-3">
        <a href="{{ route('paket.list') }}"
           class="btn inline-flex items-center gap-2 rounded-full bg-yellow-400 px-5 py-2 text-sm font-semibold text-slate-900 hover:bg-yellow-300 active:translate-y-[1px] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-yellow-500/60">
          Beli Paket
        </a>

        <div id="nav-guest-desktop" class="flex items-center gap-3">
          <a href="{{ route('login') }}"
             class="btn inline-flex items-center rounded-full border-2 border-green-800 px-6 py-2 text-sm font-semibold text-green-800 hover:bg-green-50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-green-700/40">
            Masuk
          </a>
          <a href="{{ route('register') }}"
             class="btn inline-flex items-center rounded-full bg-green-800 px-6 py-2 text-sm font-semibold text-white hover:bg-green-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-green-700/60">
            Daftar
          </a>
        </div>

        <div id="nav-user-desktop" class="hidden items-center gap-3">
          <a href="{{ url('/profil') }}"
             class="btn inline-flex items-center rounded-full bg-green-800 px-6 py-2 text-sm font-semibold text-white hover:bg-green-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-green-700/60">
            Profil Saya
          </a>
        </div>
      </div>
      <button id="menuBtn"
              class="md:hidden inline-flex h-10 w-10 items-center justify-center rounded-md hover:bg-slate-100 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-green-700/40"
              aria-label="Buka menu">
        <svg id="menuIcon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-6 w-6">
          <path d="M4 6h16v2H4zm0 5h16v2H4zm0 5h16v2H4z"/>
        </svg>
      </button>
    </div>

    <div id="mobileMenu" class="md:hidden hidden border-t border-slate-200/60 py-3">
      <div class="flex flex-col gap-2 py-2">
        <a href="{{ url('/') }}" class="px-2 py-2 rounded hover:bg-slate-50">Home</a>
        <a href="{{ url('/menu') }}" class="px-2 py-2 rounded hover:bg-slate-50">Menu</a>
        <a href="{{ route('paket.list') }}" class="px-2 py-2 rounded hover:bg-slate-50">Paket</a>

        <a href="{{ url('/kalori-lab') }}"
           class="inline-flex items-center gap-2 self-start rounded-full bg-yellow-400 px-4 py-2 text-sm font-semibold shadow-[inset_0_-2px_0_rgba(0,0,0,.15)] hover:bg-yellow-300">
          Lab Kalori
        </a>

        <div class="mt-2 flex items-center gap-3">
          <a href="{{ route('paket.list') }}"
             class="btn inline-flex items-center gap-2 rounded-full bg-yellow-400 px-5 py-2 text-sm font-semibold text-slate-900 hover:bg-yellow-300 active:translate-y-[1px]">
            Beli Paket
          </a>

          <div id="nav-guest-mobile" class="flex items-center gap-3">
            <a href="{{ route('login') }}"
               class="btn inline-flex items-center rounded-full border-2 border-green-800 px-5 py-2 text-sm font-semibold text-green-800 hover:bg-green-50">
              Masuk
            </a>
            <a href="{{ route('register') }}"
               class="btn inline-flex items-center rounded-full bg-green-800 px-5 py-2 text-sm font-semibold text-white hover:bg-green-700">
              Daftar
            </a>
          </div>

          <div id="nav-user-mobile" class="hidden items-center gap-3">
            <a href="{{ url('/profil') }}"
               class="btn inline-flex items-center rounded-full bg-green-800 px-5 py-2 text-sm font-semibold text-white hover:bg-green-700">
              Profil Saya
            </a>
          </div>
        </div>
      </div>
    </div>
    </nav>
</header>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const btn = document.getElementById('menuBtn');
    const menu = document.getElementById('mobileMenu');
    if (btn && menu) {
      btn.addEventListener('click', () => {
        menu.classList.toggle('hidden');
      });
    }
  });
</script>