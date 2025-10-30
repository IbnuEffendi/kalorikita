<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Masuk - Platform Gaya Hidup Sehat</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>

  <body class="bg-green-900 flex justify-center items-center min-h-screen font-sans">
    <div class="bg-white rounded-2xl shadow-lg flex overflow-hidden w-[900px] max-w-full">
      <!-- KIRI (SAMA PERSIS DENGAN REGISTER) -->
      <div class="w-1/2 bg-green-800 text-white flex flex-col justify-center px-10 relative">
        <!-- Badge -->
        <div class="absolute top-6 left-6 bg-green-700 text-white text-sm px-3 py-1 rounded-full">
          🌱 Platform Gaya Hidup Sehat
        </div>

        <!-- PATTERN BACKGROUND (optional) -->
        <!-- TODO: kalau pakai gambar pattern, taruh style inline di div KIRI:
             style="background-image:url('PATH/ke/pattern.png'); background-repeat:no-repeat; background-position:bottom left; background-size:contain;" -->

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

        <!-- DOODLE BAWAH (optional) -->
        <!-- TODO: kalau pakai doodle gambar, tambahkan:
             <img src="PATH/ke/doodle.png" alt="food doodle" class="absolute bottom-4 left-4 w-40 opacity-70" /> -->
      </div>

      <!-- KANAN (FORM MASUK) -->
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

          <button type="submit" class="w-full bg-yellow-400 hover:bg-yellow-500 text-black font-semibold py-3 rounded-xl transition">
            Masuk
          </button>

          <p class="text-left text-sm text-gray-800 font-semibold">Lupa Kata Sandi?</p>

          <div class="flex items-center my-4">
            <hr class="flex-grow border-gray-200" />
            <span class="px-2 text-sm text-gray-500">atau</span>
            <hr class="flex-grow border-gray-200" />
          </div>

          <button
            type="button"
            class="w-full border border-gray-300 rounded-xl py-3 flex items-center justify-center gap-3 text-gray-800 hover:bg-gray-50"
          >
            <!-- TODO: ganti dengan logo Google -->
            <!-- <img src="PATH/ke/google-logo.svg" alt="Google" class="w-5 h-5" /> -->
            <span class="font-semibold">Masuk dengan Google</span>
          </button>

          <p class="text-center text-sm mt-4 text-gray-600">
            Belum punya akun? <a href="register.html" class="text-black font-medium">Daftar</a>
          </p>
        </form>
      </div>
    </div>
  </body>
</html>
