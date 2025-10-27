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
      class="relative bg-[#F7F7F7] min-h-screen bg-cover bg-no-repeat"
      style="background-image: url('/asset/menu-pattern.png');"
    >
      <!-- Ganti '/asset/menu-pattern.png' dengan file pattern background kamu -->

      <div class="max-w-6xl mx-auto px-6 py-16">
        <!-- Judul -->
        <div class="text-center mb-12">
          <h2 class="text-3xl font-bold text-[#155C2E] mb-2">Menu Kami</h2>
          <div class="w-20 h-[3px] bg-[#FBBF24] mx-auto rounded"></div>
        </div>

        <!-- Grid Menu -->
        <div
          class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10 justify-items-center"
        >
          <!-- 1. Salad -->
          <div
            class="bg-white rounded-2xl shadow-md p-4 text-center hover:scale-105 transition-transform duration-300 w-full max-w-sm"
          >
            <!-- GANTI GAMBAR DI SINI -->
            <img
              src="/asset/salad1.png"
              alt="Salad"
              class="w-36 h-36 object-cover mx-auto -mt-12 rounded-full shadow-lg border-4 border-white"
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
              src="/asset/smoothies1.png"
              alt="Smoothies"
              class="w-36 h-36 object-cover mx-auto -mt-12 rounded-full shadow-lg border-4 border-white"
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
              src="/asset/salad2.png"
              alt="Salad"
              class="w-36 h-36 object-cover mx-auto -mt-12 rounded-full shadow-lg border-4 border-white"
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
              src="/asset/salad-buah.png"
              alt="Salad Buah"
              class="w-36 h-36 object-cover mx-auto -mt-12 rounded-full shadow-lg border-4 border-white"
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
              src="/asset/salad3.png"
              alt="Salad"
              class="w-36 h-36 object-cover mx-auto -mt-12 rounded-full shadow-lg border-4 border-white"
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
              src="/asset/smoothies2.png"
              alt="Smoothies"
              class="w-36 h-36 object-cover mx-auto -mt-12 rounded-full shadow-lg border-4 border-white"
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

        <!-- Pagination -->
        <div class="flex justify-center items-center space-x-3 mt-10">
          <button
            class="bg-[#155C2E] text-white px-3 py-1 rounded-full hover:scale-105 transition-transform"
          >
            <i class="fas fa-chevron-left"></i>
          </button>
          <button
            class="bg-[#155C2E] text-white w-8 h-8 rounded-lg font-semibold"
          >
            1
          </button>
          <button
            class="border border-[#155C2E] w-8 h-8 rounded-lg font-semibold text-[#155C2E]"
          >
            2
          </button>
          <button
            class="border border-[#155C2E] w-8 h-8 rounded-lg font-semibold text-[#155C2E]"
          >
            3
          </button>
          <button
            class="bg-[#155C2E] text-white px-3 py-1 rounded-full hover:scale-105 transition-transform"
          >
            <i class="fas fa-chevron-right"></i>
          </button>
        </div>
      </div>
    </section>

    <!-- FOOTER -->
    <x-footer></x-footer>
  </body>
</html>