<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Buat Akun - Platform Gaya Hidup Sehat</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body class="bg-green-900 flex justify-center items-center min-h-screen font-sans">
    <div class="bg-white rounded-2xl shadow-lg flex overflow-hidden w-[900px] max-w-full">
      <div
        class="w-1/2 bg-green-800 text-white flex flex-col justify-center px-10 relative"
      >
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
            <li class="flex items-start gap-2">
              ✅ <span>Catat Makan Kurang Dari 10 Detik</span>
            </li>
            <li class="flex items-start gap-2">
              ✅ <span>Rekomendasi Porsi Sesuai Target</span>
            </li>
            <li class="flex items-start gap-2">
              ✅ <span>Progress Harian & Mingguan Yang Jelas</span>
            </li>
          </ul>
        </div>
      </div>

      <div class="w-1/2 bg-white p-10 flex flex-col justify-center">
        <h2 class="text-2xl font-semibold mb-6">Buat Akun</h2>

        <form class="space-y-4">
          <div>
            <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
            <input
              type="text"
              id="nama"
              placeholder="Nama Lengkap"
              class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400"
            />
          </div>

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

          <div>
            <label for="confirm-password" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Kata Sandi</label>
            <input
              type="password"
              id="confirm-password"
              placeholder="Kata Sandi"
              class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400"
            />
          </div>

          <div class="flex items-center text-sm">
            <input
              type="checkbox"
              id="agree"
              class="mr-2"
            />
            <label for="agree">
              Saya setuju dengan <a href="#" class="text-yellow-600 font-medium">Syarat</a> &
              <a href="#" class="text-yellow-600 font-medium">Kebijakan Privasi</a>
            </label>
          </div>

          <button
            type="submit"
            id="tombol-daftar"
            class="w-full bg-yellow-400 hover:bg-yellow-500 text-white font-semibold py-2 rounded-md transition"
          >
            Daftar
          </button>
        </form>

        <div class="flex items-center my-6">
          <hr class="grow border-gray-300" />
          <span class="px-2 text-sm text-gray-500">atau</span>
          <hr class="grow border-gray-300" />
        </div>

        <button
          id="tombol-google"
          class="w-full border border-gray-300 rounded-md py-2 flex items-center justify-center gap-2 text-gray-700 hover:bg-gray-50"
        >
          <span class="font-medium">Daftar dengan Google</span>
        </button>

        <p class="text-center text-sm mt-6 text-gray-600">
          Sudah punya akun?
          <a href="/login" class="text-black font-medium">Masuk</a>
        </p>
      </div>
    </div>

    <script>
      document.addEventListener('DOMContentLoaded', () => {
        
        // Ini adalah fungsi 'pura-pura daftar & login'
        const simulasiDaftar = (event) => {
          // 1. Mencegah form kirim data (karena kita cuma pura-pura)
          event.preventDefault(); 
          
          // 2. Buat "Tanda Pengenal" di browser
          localStorage.setItem('isLoggedIn', 'true');

          // 3. Arahkan user ke Halaman Home
          // (Ganti '/' dengan halaman home kamu jika beda, misal 'index.html')
          window.location.href = '/'; 
        };

        // Pasang fungsi tadi ke Tombol Daftar
        const tombolDaftar = document.getElementById('tombol-daftar');
        if (tombolDaftar) {
          tombolDaftar.addEventListener('click', simulasiDaftar);
        }

        // Pasang fungsi tadi ke Tombol Google
        const tombolGoogle = document.getElementById('tombol-google');
        if (tombolGoogle) {
          tombolGoogle.addEventListener('click', simulasiDaftar);
        }

      });
    </script>
  </body>
</html>