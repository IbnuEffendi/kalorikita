<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Masuk - Platform Gaya Hidup Sehat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>

  <body class="bg-green-900 flex justify-center items-center min-h-screen font-sans">
    <div class="bg-white rounded-2xl shadow-lg flex overflow-hidden w-[900px] max-w-full">
      <div class="w-1/2 bg-green-800 text-white flex flex-col justify-center px-10 relative">
        <div class="absolute top-6 left-6 bg-green-700 text-white text-sm px-3 py-1 rounded-full">
          🌱 Platform Gaya Hidup Sehat
        </div>

        <div class="mt-16">
          <h1 class="text-4xl font-bold leading-tight">
            Lacak Kalori & <br />Atur Pola Makanmu
          </h1>
          <p class="text-sm mt-4 text-gray-200 leading-relaxed">
            Transparansi Nutrisi, Menu Sehat, Dan Tracker <br />
            Harian Dalam Satu Tempat. Cocok Untuk Diet, <br />
            Bulking, Dan Hidup Seimbang.
          </p>

          <ul class="mt-6 space-y-2 text-sm">
            <li class="flex items-start gap-2">✅ <span>Catat Makan Kurang Dari 10 Detik</span></li>
            <li class="flex items-start gap-2">✅ <span>Rekomendasi Porsi Sesuai Target</span></li>
            <li class="flex items-start gap-2">✅ <span>Progress Harian & Mingguan Yang Jelas</span></li>
          </ul>
        </div>
      </div>

      <div class="w-1/2 bg-white p-10 flex flex-col justify-center">
        <h2 class="text-2xl font-semibold mb-6">Masuk</h2>

        <form class="space-y-6">
          <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input
              type="email"
              id="email"
              placeholder="Email"
              class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400"
            />
          </div>

          <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Kata Sandi</label>
            <input
              type="password"
              id="password"
              placeholder="Kata Sandi"
              class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400"
            />
          </div>

          <button
            type="submit"
            id="tombol-masuk" 
            class="w-full bg-yellow-400 hover:bg-yellow-500 text-black font-semibold py-3 rounded-xl transition"
          >
            Masuk
          </button>

          <p class="text-left text-sm text-gray-800 font-semibold">Lupa Kata Sandi?</p>

          <div class="flex items-center my-4">
            <hr class="grow border-gray-200" />
            <span class="px-2 text-sm text-gray-500">atau</span>
            <hr class="grow border-gray-200" />
          </div>

          <button
            type="button"
            id="tombol-google"
            class="w-full border border-gray-300 rounded-xl py-3 flex items-center justify-center gap-3 text-gray-800 hover:bg-gray-50"
          >
            <img src="https://www.svgrepo.com/show/355037/google.svg"
             alt="Logo Google"
             class="w-6 h-6">
            <span class="font-semibold">Masuk dengan Google</span>
          </button>

          <p class="text-center text-sm mt-4 text-gray-600">
            Belum punya akun? <a href="{{ route('register') }}" class="text-black font-medium">Daftar</a>
          </p>
        </form>
      </div>
    </div>

    <div id="google-login-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 hidden">
        <div id="tutup-modal-bg" class="absolute inset-0"></div>
        
        <div class="bg-white rounded-lg shadow-xl border border-gray-200 w-full max-w-md p-8 text-center z-10 relative">
            
            <img src="{{ asset('asset/logo-nobg.png') }}" alt="Logo KaloriKita" class="h-20 mx-auto mb-4">
            
            <h1 class="text-2xl font-medium text-gray-900">Pilih akun</h1>
            
            <p class="text-gray-600 mt-2 mb-6">
              untuk melanjutkan ke <span class="font-semibold">KaloriKita</span>
            </p>

            <div class="space-y-3">
                
                <a href="#" id="tombol-login-google-palsu" class="flex items-center w-full p-3 border rounded-lg hover:bg-gray-50 transition-all">
                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACIAAAAiCAYAAAA6RwvCAAADKUlEQVR4AdzV4ZXUMAwE4IVKoBKgEqASoBKgEqAS6AT8+SK/idfJ7h1/eNyLYlsajcays/f88o/8/XdCXvxtY5/SEUU/tsLfmv1s9rtZjvzir5v/7ucxQghQRNEPrYJCfG06Hmt+8cJaD8DR5B4hyD83AgJWpL9arKxNd49cgnRoF5gXt4QgIuJdJCr6qa3fNHvW7OVk/OLNPR4dshF8w5mTMyGSJGcXFFDYDr8n0TYnkl8cDn4LXfDpjvEy/50J0YnCK2CnCpSvRsQptvxy4Aky54clxnxnR0KAixwJMjvNZEXqi4GvOX/i5NtE+YjJTXb/SggBrAPa632z+VHYuc9+RfhvicHPRv5KCKICOOO5Ey7ujqSBvzTLBwdc+vAUrgSP+EpIFpl3JjHbitiXo2uOj3AYRowxLeNZ5zILyV0okiTmdmIsI6Dm7kLmwLKKG2F0xpyNerOQt6Kbfd3GHJI4CQszF0p8YbIro94sJBOPChVhYstnzJYTxpeWvsFxJiSTV3Mk8x2a11m0OFa+qztyCm5BJNlaF9Kvrwvsd8S6wfqT96c74oXH0maMh0J68ODlQuaxIRuXbssRh9uWV4OcnXM+GgQAV0DOzezGbrMzW6gP/PlL2p3xSu6qd9qRvHTB06fEuA9+OxhhivtN4e+gg1fy4umwuSP5yY5PqyOPX3ZYhObHyIfIq4ehv3/0d3vNQkarWozyFTFfXU4X1f+dMmsmLr/R7B65eZ/GPZqF2FmJkZRfAUZtVyjJ+NPkiRMDnzG+Wg8RHLMQPudtZHbFzJHOwko48QyujCB4eXx4mDnLa7C8rMjdfGBkdoEMKR+zG5fTRTWW1bryYd01+Y7PmonvhK86AqhQAYlJEfy6ZoRNswn+W/mEZd6yIwAIFTNap9lNrldzeSsckbp3lXPUEUBkkozWZY6KOW9WfqPu1UXNoxA7FCF4JkScCGJyd1VMIeZ/TJkvikhi5DMc8vFYb7YfbgmBRuRMXUSEfPeYPHh58k9z7hFSBIgRInZ/XEim5TDi1oqLw8GL3bTHCCmyKqgY03L/YxS2Vpygwt81PkXIXcSPBf0BAAD//7kKrWcAAAAGSURBVAMAVkqzRexXe2IAAAAASUVORK5CYII=" alt="Google Account" class="w-10 h-10 rounded-full">
                    <div class="ml-4 text-left">
                        <p class="font-semibold text-gray-800">Kayla</p>
                        <p class="text-sm text-gray-500">emilykayla097@gmail.com</p>
                    </div>
                </a>

                <a href="#" id="tombol-akun-lain" class="flex items-center w-full p-3 border rounded-lg hover:bg-gray-50 transition-all">
                    <img src="https://www.svgrepo.com/show/355037/google.svg" alt="Logo Google" class="w-10 h-10 p-2 border rounded-full">
                    <div class="ml-4 text-left"> 
                        <p class="font-semibold text-gray-800">Gunakan akun Google</p>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <script>
      document.addEventListener('DOMContentLoaded', () => {
        
        // Ini adalah fungsi 'pura-pura login'
        const simulasiLogin = (event) => {
          event.preventDefault(); 
          localStorage.setItem('isLoggedIn', 'true');
          window.location.href = '/'; 
        };

        // Pasang fungsi tadi ke Tombol Masuk (biasa)
        const tombolMasuk = document.getElementById('tombol-masuk');
        if (tombolMasuk) {
          tombolMasuk.addEventListener('click', simulasiLogin);
        }

        // --- Logika untuk Pop-up Google ---
        
        // 1. Ambil elemen-elemen modal
        const modal = document.getElementById('google-login-modal');
        const bukaModalBtn = document.getElementById('tombol-google');
        const tutupModalBg = document.getElementById('tutup-modal-bg');
        const loginAkunPalsuBtn = document.getElementById('tombol-login-google-palsu');
        const loginAkunLainBtn = document.getElementById('tombol-akun-lain');

        // 2. Saat "Masuk dengan Google" diklik -> TAMPILKAN MODAL
        if (bukaModalBtn && modal) {
          bukaModalBtn.addEventListener('click', () => {
            modal.classList.remove('hidden');
          });
        }

        // 3. Saat background gelap diklik -> TUTUP MODAL
        if (tutupModalBg && modal) {
          tutupModalBg.addEventListener('click', () => {
            modal.classList.add('hidden');
          });
        }

        // 4. Saat akun palsu ATAU akun lain diklik -> LOGIN & TUTUP
        if (loginAkunPalsuBtn) {
          loginAkunPalsuBtn.addEventListener('click', simulasiLogin); 
        }
        if (loginAkunLainBtn) {
          loginAkunLainBtn.addEventListener('click', simulasiLogin);
        }

      });
    </script>
  </body>
</html>




