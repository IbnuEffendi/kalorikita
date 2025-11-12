<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pesanan Saya - KaloriKita</title>

    <link rel="preconnect" href="https.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
    
<body class="bg-gray-100 font-sans flex flex-col min-h-screen">

    @include('components.navbar')

    <div class="flex flex-1 overflow-hidden">

        @include('profil.sidebar', ['activePage' => 'pesanan'])

        <main class="w-3/4 bg-[#DAEFA2] p-10 overflow-y-auto relative">
            
            <div class="absolute inset-0 bg-repeat opacity-30" style="background-image: url('{{ asset('/asset/pattern1flip.png') }}')"></div>

            <div class="relative z-10">
                <h1 class="text-3xl font-bold text-gray-900 mb-8">Pesanan Saya</h1>
                
                <section class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    
                    <nav class="flex border-b border-gray-200">
                        <a href="#" class="px-6 py-4 border-b-2 border-green-700 text-green-700 font-semibold text-sm">
                            Semua
                        </a>
                        <a href="#" class="px-6 py-4 border-b-2 border-transparent text-gray-500 hover:text-black hover:border-gray-400 text-sm">
                            Menunggu Pesanan
                        </a>
                        <a href="#" class="px-6 py-4 border-b-2 border-transparent text-gray-500 hover:text-black hover:border-gray-400 text-sm">
                            Diproses
                        </a>
                        <a href="#" class="px-6 py-4 border-b-2 border-transparent text-gray-500 hover:text-black hover:border-gray-400 text-sm">
                            Terkirim
                        </a>
                        <a href="#" class="px-6 py-4 border-b-2 border-transparent text-gray-500 hover:text-black hover:border-gray-400 text-sm">
                            Dibatalkan
                        </a>
                    </nav>
                    
                    <div class="text-center py-20 px-10">
                        <h3 class="text-xl font-semibold text-gray-700 mb-2">Tidak ada pesanan</h3>
                        <p class="text-gray-500 mb-6">Anda belum memiliki riwayat pesanan.</p>
                        
                        <a href="{{ route('paket.list') }}" class="rounded-full bg-yellow-400 px-8 py-3 text-sm font-semibold text-black hover:bg-yellow-300 transition-all">
                            Lanjut Berbelanja
                        </a>
                    </div>
                    
                </section>
            </div>
        </main>

    </div> 
    
    @include('profil.logout-modal')

    <script>
      document.addEventListener('DOMContentLoaded', () => {
        // Skrip Pengecek Login
        const isLoggedIn = localStorage.getItem('isLoggedIn');
        if (isLoggedIn === 'true') {
          // Desktop
          document.getElementById('nav-guest-desktop')?.classList.add('hidden');
          document.getElementById('nav-guest-desktop')?.classList.remove('flex');
          document.getElementById('nav-user-desktop')?.classList.remove('hidden');
          document.getElementById('nav-user-desktop')?.classList.add('flex');
          // Mobile
          document.getElementById('nav-guest-mobile')?.classList.add('hidden');
          document.getElementById('nav-guest-mobile')?.classList.remove('flex');
          document.getElementById('nav-user-mobile')?.classList.remove('hidden');
          document.getElementById('nav-user-mobile')?.classList.add('flex');
        }
      
        // --- Skrip untuk Pop-up Logout ---
        const modal = document.getElementById('logout-modal');
        const bukaModalBtn = document.getElementById('tombol-logout-palsu'); 
        const batalBtn = document.getElementById('batal-logout-btn');       
        const yaKeluarBtn = document.getElementById('ya-keluar-btn');     

        if (bukaModalBtn && modal) {
          bukaModalBtn.addEventListener('click', (e) => {
            e.preventDefault(); 
            modal.classList.remove('hidden'); 
          });
        }
        if (batalBtn && modal) {
          batalBtn.addEventListener('click', () => {
            modal.classList.add('hidden'); 
          });
        }
        if (yaKeluarBtn) {
          yaKeluarBtn.addEventListener('click', () => {
            localStorage.removeItem('isLoggedIn'); 
            window.location.href = '/'; 
          });
        }

        // (Kita tidak butuh skrip ganti foto di halaman ini)
      });
    </script>

</body>
</html>