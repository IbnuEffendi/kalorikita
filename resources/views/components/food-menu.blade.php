<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Menu Kami | KaloriKita</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <script
      src="https://kit.fontawesome.com/a076d05399.js"
      crossorigin="anonymous"
    ></script>
  </head>

  <body class="bg-[#F7F7F7] text-gray-800">
    <!-- NAVBAR -->
    <x-navbar></x-navbar>

    <!-- SECTION: MENU KAMI -->
    <section
      class="relative bg-green-900 overflow-hidden"
    >
      <div class="max-w-6xl mx-auto px-6 py-16 relative z-10">
        <!-- Judul -->
        <div class="text-center mb-20">
          <h2 class="text-3xl font-bold text-white mb-2">Menu Kami</h2>
          <div class="w-20 h-[3px] bg-[#FBBF24] mx-auto rounded"></div>
        </div>

        <!-- Grid Menu -->
        <div
          class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10 justify-items-center mt-20"
        >
          <!-- 1. Salad -->
          <div
            class="bg-white rounded-2xl shadow-md p-4 text-center hover:scale-105 transition-transform duration-300 w-full max-w-sm"
          >
            <!-- GANTI GAMBAR DI SINI -->
            <img
              src="/asset/food1.png"
              alt="Salad"
              class="w-27 h-27 object-cover mx-auto -mt-20"
            />
            <h3 class="text-lg font-semibold text-[#155C2E] mt-4">Salad</h3>
            <p class="text-sm text-gray-600 mt-1">
              <span class="font-semibold">Salad Sayur</span> Bernutrisi, Dengan
              Campuran Alpukat, Telur, Jamur Dan Potongan Salmon
            </p>

            <div
              class="flex justify-between items-center mt-4 px-4 text-[#155C2E] font-semibold"
            >
              <div class="flex items-center space-x-2">
                <i class="fas fa-fire text-[#F97316]"></i>
                <span>220 kkal</span>
              </div>
              <div class="flex items-center space-x-2">
                <i class="fas fa-dumbbell text-[#F97316]"></i>
                <span>30 gr</span>
              </div>
            </div>

            <div class="flex justify-between items-center mt-4 px-4">
              <div
                class="flex items-center bg-[#155C2E] text-white rounded-full px-3 py-1 text-sm space-x-1"
              >
                <i class="fas fa-star text-[#FBBF24]"></i>
                <span>4.5</span>
              </div>
              <button class="text-[#E63946]">
                <i class="fas fa-heart"></i>
              </button>
            </div>
          </div>

          <!-- 2. Smoothies -->
          <div
            class="bg-white rounded-2xl shadow-md p-4 text-center hover:scale-105 transition-transform duration-300 w-full max-w-sm"
          >
            <!-- GANTI GAMBAR DI SINI -->
            <img
              src="/asset/food2.png"
              alt="Smoothies"
              class="w-27 h-27 object-cover mx-auto -mt-20"
            />
            <h3 class="text-lg font-semibold text-[#155C2E] mt-4">Smoothies</h3>
            <p class="text-sm text-gray-600 mt-1">
              <span class="font-semibold">Smoothies</span> Segar Bernutrisi,
              Disediakan Dari Buah-Buahan Segar, Yogurt, Dan Chia Seed.
            </p>

            <div
              class="flex justify-between items-center mt-4 px-4 text-[#155C2E] font-semibold"
            >
              <div class="flex items-center space-x-2">
                <i class="fas fa-fire text-[#F97316]"></i>
                <span>240 kkal</span>
              </div>
              <div class="flex items-center space-x-2">
                <i class="fas fa-dumbbell text-[#F97316]"></i>
                <span>30 gr</span>
              </div>
            </div>

            <div class="flex justify-between items-center mt-4 px-4">
              <div
                class="flex items-center bg-[#155C2E] text-white rounded-full px-3 py-1 text-sm space-x-1"
              >
                <i class="fas fa-star text-[#FBBF24]"></i>
                <span>4.5</span>
              </div>
              <button class="text-[#E63946]">
                <i class="fas fa-heart"></i>
              </button>
            </div>
          </div>

          <!-- 3. Salad -->
          <div
            class="bg-white rounded-2xl shadow-md p-4 text-center hover:scale-105 transition-transform duration-300 w-full max-w-sm"
          >
            <!-- GANTI GAMBAR DI SINI -->
            <img
              src="/asset/food3.png"
              alt="Salad"
              class="w-27 h-27 object-cover mx-auto -mt-20"
            />
            <h3 class="text-lg font-semibold text-[#155C2E] mt-4">Salad</h3>
            <p class="text-sm text-gray-600 mt-1">
              <span class="font-semibold">Salad Sayur</span> Bernutrisi, Dengan
              Campuran Alpukat, Telur, Jagung, Dan Potongan Sayur Lain
            </p>

            <div
              class="flex justify-between items-center mt-4 px-4 text-[#155C2E] font-semibold"
            >
              <div class="flex items-center space-x-2">
                <i class="fas fa-fire text-[#F97316]"></i>
                <span>220 kkal</span>
              </div>
              <div class="flex items-center space-x-2">
                <i class="fas fa-dumbbell text-[#F97316]"></i>
                <span>30 gr</span>
              </div>
            </div>

            <div class="flex justify-between items-center mt-4 px-4">
              <div
                class="flex items-center bg-[#155C2E] text-white rounded-full px-3 py-1 text-sm space-x-1"
              >
                <i class="fas fa-star text-[#FBBF24]"></i>
                <span>4.5</span>
              </div>
              <button class="text-[#E63946]">
                <i class="fas fa-heart"></i>
              </button>
            </div>
          </div>

          <!-- 4. Salad Buah -->
          <div
            class="bg-white rounded-2xl shadow-md p-4 text-center hover:scale-105 transition-transform duration-300 w-full max-w-sm"
          >
            <!-- GANTI GAMBAR DI SINI -->
            <img
              src="/asset/food4.png"
              alt="Salad Buah"
              class="w-27 h-27 object-cover mx-auto -mt-20"
            />
            <h3 class="text-lg font-semibold text-[#155C2E] mt-4">Salad Buah</h3>
            <p class="text-sm text-gray-600 mt-1">
              <span class="font-semibold">Salad Buah</span> Bernutrisi Dan
              Menyehatkan, Dengan Buah-Buahan Segar Dan Madu
            </p>

            <div
              class="flex justify-between items-center mt-4 px-4 text-[#155C2E] font-semibold"
            >
              <div class="flex items-center space-x-2">
                <i class="fas fa-fire text-[#F97316]"></i>
                <span>240 kkal</span>
              </div>
              <div class="flex items-center space-x-2">
                <i class="fas fa-dumbbell text-[#F97316]"></i>
                <span>30 gr</span>
              </div>
            </div>

            <div class="flex justify-between items-center mt-4 px-4">
              <div
                class="flex items-center bg-[#155C2E] text-white rounded-full px-3 py-1 text-sm space-x-1"
              >
                <i class="fas fa-star text-[#FBBF24]"></i>
                <span>4.5</span>
              </div>
              <button class="text-[#E63946]">
                <i class="fas fa-heart"></i>
              </button>
            </div>
          </div>

          <!-- 5. Salad -->
          <div
            class="bg-white rounded-2xl shadow-md p-4 text-center hover:scale-105 transition-transform duration-300 w-full max-w-sm"
          >
            <!-- GANTI GAMBAR DI SINI -->
            <img
              src="/asset/food5.png"
              alt="Salad"
              class="w-25 h-25 object-cover mx-auto -mt-20"
            />
            <h3 class="text-lg font-semibold text-[#155C2E] mt-4">Salad</h3>
            <p class="text-sm text-gray-600 mt-1">
              <span class="font-semibold">Salad Sayur</span> Segar Berisi Aneka
              Sayuran Hijau, Dilengkapi Potongan Ayam Panggang, Keju, Dan
              Dressing Ringan Yang Menyehatkan
            </p>

            <div
              class="flex justify-between items-center mt-4 px-4 text-[#155C2E] font-semibold"
            >
              <div class="flex items-center space-x-2">
                <i class="fas fa-fire text-[#F97316]"></i>
                <span>220 kkal</span>
              </div>
              <div class="flex items-center space-x-2">
                <i class="fas fa-dumbbell text-[#F97316]"></i>
                <span>30 gr</span>
              </div>
            </div>

            <div class="flex justify-between items-center mt-4 px-4">
              <div
                class="flex items-center bg-[#155C2E] text-white rounded-full px-3 py-1 text-sm space-x-1"
              >
                <i class="fas fa-star text-[#FBBF24]"></i>
                <span>4.5</span>
              </div>
              <button class="text-[#E63946]">
                <i class="fas fa-heart"></i>
              </button>
            </div>
          </div>

          <!-- 6. Smoothies -->
          <div
            class="bg-white rounded-2xl shadow-md p-4 text-center hover:scale-105 transition-transform duration-300 w-full max-w-sm"
          >
            <!-- GANTI GAMBAR DI SINI -->
            <img
              src="/asset/food6.png"
              alt="Smoothies"
              class="w-27 h-27 object-cover mx-auto -mt-20"
            />
            <h3 class="text-lg font-semibold text-[#155C2E] mt-4">Smoothies</h3>
            <p class="text-sm text-gray-600 mt-1">
              <span class="font-semibold">Smoothies</span> Sehat Dengan Campuran
              Buah Segar Dan Yogurt, Kaya Serat, Serta Menyegarkan Untuk
              Mendukung Aktivitas Harian
            </p>

            <div
              class="flex justify-between items-center mt-4 px-4 text-[#155C2E] font-semibold"
            >
              <div class="flex items-center space-x-2">
                <i class="fas fa-fire text-[#F97316]"></i>
                <span>240 kkal</span>
              </div>
              <div class="flex items-center space-x-2">
                <i class="fas fa-dumbbell text-[#F97316]"></i>
                <span>30 gr</span>
              </div>
            </div>

            <div class="flex justify-between items-center mt-4 px-4">
              <div
                class="flex items-center bg-[#155C2E] text-white rounded-full px-3 py-1 text-sm space-x-1"
              >
                <i class="fas fa-star text-[#FBBF24]"></i>
                <span>4.5</span>
              </div>
              <button class="text-[#E63946]">
                <i class="fas fa-heart"></i>
              </button>
            </div>
          </div>
        </div>

      <!-- ===================== PAGINATION ===================== -->
      <div class="mt-12 flex items-center justify-center gap-4 relative z-10">
        <button
          class="w-10 h-10 flex items-center justify-center bg-green-700 text-white rounded-md shadow-md hover:bg-green-800 transition">
          ◀
        </button>
        <button class="w-12 h-12 flex items-center justify-center bg-green-700 text-white rounded-xl font-extrabold shadow-md">
          1
        </button>
        <button class="w-12 h-12 flex items-center justify-center bg-white ring-gray-200 rounded-xl hover:bg-gray-100 transition">
          2
        </button>
        <button class="w-12 h-12 flex items-center justify-center bg-white ring-1 ring-gray-200 rounded-xl hover:bg-gray-100 transition">
          3
        </button>
        <button
          class="w-10 h-10 flex items-center justify-center bg-green-700 text-white rounded-md shadow-md hover:bg-green-800 transition">
          ▶
        </button>
      </div>
    </section>
  </body>
</html>

    <!-- FOOTER -->
    <x-footer></x-footer>
  </body>
</html>