<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Pengguna - KaloriKita</title>

    <link rel="preconnect" href="https.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
    
<body class="bg-gray-100 font-sans flex flex-col min-h-screen">

    @include('components.navbar')

    <div class="flex flex-1 overflow-hidden">

        @include('profil.sidebar', ['activePage' => 'profil'])

        <main class="w-3/4 bg-[#DAEFA2] p-10 overflow-y-auto relative">
            
            <div class="absolute inset-0 bg-repeat opacity-30" style="background-image: url('{{ asset('/asset/pattern1flip.png') }}')"></div>

            <div class="relative z-10">
                <h1 class="text-3xl font-bold text-gray-900 mb-8">Selamat Datang!</h1>
                
                <div class="space-y-6">

                    <section class="bg-white p-8 rounded-2xl shadow-lg">
                        <h2 class="text-2xl font-semibold text-gray-900 mb-6">Profil Saya</h2>
                        
                        <div class="flex flex-col md:flex-row items-start gap-8">
                            
                            <div class="w-full md:w-1/3 flex flex-col items-center">
                                <img id="foto-profil-preview" src="{{ asset('asset/default-profil.png') }}" alt="Foto Profil" class="w-32 h-32 rounded-full object-cover border-4 border-gray-200">
                                <input type="file" id="ganti-foto-input" class="hidden" accept="image/*">
                                <label for="ganti-foto-input" class="mt-4 cursor-pointer rounded-full bg-yellow-400 px-6 py-2 text-sm font-semibold text-black hover:bg-yellow-300 transition-all">
                                    Ganti Foto
                                </label>
                            </div>
                            
                            <form class="w-full md:w-2/3 space-y-4">
                                <div>
                                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                                    <input type="text" placeholder="Masukkan Nama Lengkap Anda" id="nama" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                    <input type="email" placeholder="Masukkan Email Anda" id="email" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                                </div>
                                <div>
                                    <label for="telepon" class="block text-sm font-medium text-gray-700 mb-1">No. HP</label>
                                    <input type="tel" placeholder="Masukkan No. HP Aktif" id="telepon" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                                </div>
                                <div>
                                    <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                                    <textarea id="alamat" placeholder="Masukkan Alamat Lengkap Anda" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"></textarea>
                                </div>
                                
                                <div class="pt-2">
                                    <button type="submit" class="rounded-full bg-green-800 px-8 py-2 text-sm font-semibold text-white hover:bg-green-700 transition-all">
                                        Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </section>

                    <section class="bg-white p-8 rounded-2xl shadow-lg">
                        <h2 class="text-2xl font-semibold text-gray-900 mb-4">Pesanan Terakhir</h2>
                        <div class="space-y-3 text-gray-700">

                           <div class="text-center py-8 text-gray-500">
                               <p>Anda belum memiliki riwayat pesanan.</p>
                           </div>
                           </div>
                    </section>
                </div>
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

        // --- Skrip untuk Ganti Foto (Preview) ---
        const inputFoto = document.getElementById('ganti-foto-input');
        const previewFoto = document.getElementById('foto-profil-preview');
        
        if (inputFoto && previewFoto) {
          inputFoto.addEventListener('change', () => {
            const file = inputFoto.files[0];
            if (file) {
              previewFoto.src = URL.createObjectURL(file);
            }
          });
        }
      });
    </script>

</body>
</html>