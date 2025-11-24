<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kalori Tracker - KaloriKita</title>

    <link rel="preconnect" href="https.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
    
<body class="bg-gray-100 font-sans flex flex-col min-h-screen">

    <!-- 1. Panggil Navbar -->
    @include('components.navbar')

    <div class="flex flex-1 overflow-hidden">

        <!-- 2. Panggil Sidebar (kasih tau 'tracker' lagi aktif) -->
        @include('profil.sidebar', ['activePage' => 'tracker'])

        <!-- 3. Konten Utama (Kalori Tracker) -->
        <main class="w-3/4 bg-green-800 p-10 overflow-y-auto relative">
            
            <div class="relative z-10">
                <!-- Judul "Selamat Datang" tetap ada -->
                <h1 class="text-3xl font-bold text-white mb-8">Kalori Tracker</h1>
                
                <!-- 
                  Layout Grid untuk Konten
                  Kolom Kiri (2/3) dan Kolom Kanan (1/3)
                -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                    <!-- KOLOM KIRI (Span 2) -->
                    <div class="lg:col-span-2 space-y-6">

                        <!-- CARD: Target Nutrisi -->
                        <section class="bg-white p-6 rounded-2xl shadow-lg">
                            <h2 class="text-xl font-semibold text-gray-900 mb-4">Target Nutrisi</h2>
                            <div class="flex gap-2" id="target-nutrisi-btns">
                                <!-- Tombol Aktif: 'bg-green-800 text-white' -->
                                <button class="btn-target flex-1 rounded-full bg-green-800 px-6 py-2 text-sm font-semibold text-white transition-all">
                                    Diet
                                </button>
                                <button class="btn-target flex-1 rounded-full bg-gray-200 px-6 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-300 transition-all">
                                    Bulking
                                </button>
                                <button class="btn-target flex-1 rounded-full bg-gray-200 px-6 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-300 transition-all">
                                    Maintain
                                </button>
                            </div>
                        </section>

                        <!-- CARD: Kalori Hari Ini (Progress Bar) -->
                        <section class="bg-white p-6 rounded-2xl shadow-lg">
                            <div class="flex justify-between items-center mb-2">
                                <h2 class="text-xl font-semibold text-gray-900">Kalori Hari Ini</h2>
                                <span class="font-semibold text-green-800">1500 / 2000 Kkal</span>
                            </div>
                            <p class="text-sm text-gray-500 mb-4">Target harianmu 2000 Kkal.</p>
                            <!-- Progress Bar -->
                            <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden">
                                <div class="bg-yellow-400 h-4 rounded-full" style="width: 75%"></div>
                            </div>
                        </section>

                        <!-- CARD: Tanya AI -->
                        <section class="bg-white p-6 rounded-2xl shadow-lg">
                            <h2 class="text-xl font-semibold text-gray-900 mb-4">Tanya AI (Cari Kalori)</h2>
                            <form class="flex gap-2">
                                <input type="text" placeholder="Cth: Nasi Padang Rendang" class="flex-1 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                                <button type="submit" class="rounded-lg bg-green-800 px-6 py-2 text-sm font-semibold text-white hover:bg-green-700 transition-all">
                                    Tambah
                                </button>
                            </form>
                        </section>

                        <!-- CARD: Baru Ditambahkan -->
                        <section class="bg-white p-6 rounded-2xl shadow-lg">
                            <h2 class="text-xl font-semibold text-gray-900 mb-4">Baru Ditambahkan (Histori)</h2>
                            <div class="space-y-3">
                                <!-- Item 1 -->
                                <div class="flex justify-between items-center border-b pb-2">
                                    <div>
                                        <p class="font-medium text-gray-800">Ayam Panggang</p>
                                        <p class="text-sm text-gray-500">1 potong (100 gr)</p>
                                    </div>
                                    <span class="font-medium text-green-700">250 Kkal</span>
                                </div>
                                <!-- Item 2 -->
                                <div class="flex justify-between items-center border-b pb-2">
                                    <div>
                                        <p class="font-medium text-gray-800">Nasi Putih</p>
                                        <p class="text-sm text-gray-500">1 mangkok</p>
                                    </div>
                                    <span class="font-medium text-green-700">204 Kkal</span>
                                </div>
                            </div>
                        </section>

                    </div>

                    <!-- KOLOM KANAN (Span 1) -->
                    <div class="lg:col-span-1 space-y-6">

                        <!-- CARD: Ringkasan Mingguan -->
                        <section class="bg-white p-6 rounded-2xl shadow-lg">
                            <h2 class="text-xl font-semibold text-gray-900 mb-4">Ringkasan Mingguan</h2>
                            <div class="bg-gray-100 rounded-lg h-48 flex items-center justify-center text-gray-400">
                                (Placeholder Grafik Mingguan)
                            </div>
                        </section>

                        <!-- CARD: Hasil Analisis (Placeholder) -->
                        <section class="bg-white p-6 rounded-2xl shadow-lg">
                            <h2 class="text-xl font-semibold text-gray-900 mb-4">Hasil Analisis (dari Lab Kalori)</h2>
                            <div class="space-y-3">
                                <div class="flex justify-between text-gray-700">
                                    <span>BMR (Kebutuhan Dasar)</span>
                                    <strong class="text-gray-900">1800 Kkal</strong>
                                </div>
                                <div class="flex justify-between text-gray-700">
                                    <span>Kebutuhan Kalori Harian</span>
                                    <strong class="text-gray-900">2200 Kkal</strong>
                                </div>
                                <div class="pt-2">
                                    <h3 class="font-semibold text-gray-900">AI Insight:</h3>
                                    <!-- Placeholder Insight -->
                                    <p class="text-sm text-gray-600 mt-1">...</p>
                                </div>
                            </div>
                        </section>

                    </div>

                </div>
            </div>
        </main>

    </div> 
    
    <!-- 4. Panggil Pop-up Logout -->
    @include('profil.logout-modal')

    <!-- 5. Skrip JavaScript (Untuk Pengecek Login, Pop-up, dan Tombol Nutrisi) -->
    <script>
      document.addEventListener('DOMContentLoaded', () => {
        // Skrip Pengecek Login (Sama seperti halaman profil)
        const isLoggedIn = localStorage.getItem('isLoggedIn');
        if (isLoggedIn === 'true') {
          document.getElementById('nav-guest-desktop')?.classList.add('hidden');
          document.getElementById('nav-guest-desktop')?.classList.remove('flex');
          document.getElementById('nav-user-desktop')?.classList.remove('hidden');
          document.getElementById('nav-user-desktop')?.classList.add('flex');
          document.getElementById('nav-guest-mobile')?.classList.add('hidden');
          document.getElementById('nav-guest-mobile')?.classList.remove('flex');
          document.getElementById('nav-user-mobile')?.classList.remove('hidden');
          document.getElementById('nav-user-mobile')?.classList.add('flex');
        }
      
        // --- Skrip untuk Pop-up Logout (Sama seperti halaman profil) ---
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

        // --- Skrip BARU untuk Tombol Target Nutrisi ---
        const targetButtons = document.querySelectorAll('.btn-target');
        targetButtons.forEach(button => {
          button.addEventListener('click', () => {
            // 1. Hapus style 'aktif' dari semua tombol
            targetButtons.forEach(btn => {
              btn.classList.remove('bg-green-800', 'text-white');
              btn.classList.add('bg-gray-200', 'text-gray-700', 'hover:bg-gray-300');
            });
            
            // 2. Tambahkan style 'aktif' ke tombol yang diklik
            button.classList.add('bg-green-800', 'text-white');
            button.classList.remove('bg-gray-200', 'text-gray-700', 'hover:bg-gray-300');
          });
        });

      });
    </script>

</body>
</html>