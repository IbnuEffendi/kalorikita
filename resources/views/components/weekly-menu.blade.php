<section class="bg-white py-12">
  <div class="max-w-7xl mx-auto px-6">
    <!-- Judul -->
    <h2 class="text-2xl font-bold text-black mb-6">Menu Mingguan</h2>

    <!-- Container Kuning -->
    <div class="bg-[#F4B400] rounded-3xl py-10 px-6 flex flex-col items-center space-y-8">
      <!-- Carousel -->
      <div class="flex items-center space-x-4">
        <!-- Tombol kiri -->
        <button class="bg-green-700 text-white rounded-full p-3 hover:bg-green-800 transition">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
            stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
          </svg>
        </button>

        <!-- Kartu Menu -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
          <!-- CARD 1 -->
          <div class="bg-white rounded-xl shadow-md overflow-hidden w-56">
            <!-- Gambar menu -->
            <!-- TODO: Ganti source gambar di bawah ini -->
            <img src="/asset/chicken-breast-salad.png"
              alt="Chicken Breast Salad" class="w-full h-40 object-cover">

            <div class="p-4">
              <h3 class="font-semibold text-gray-800">Chicken Breast Salad</h3>

              <div class="flex items-center text-sm text-gray-700 mt-1">
                <span class="mr-2">🔥</span>
                <span>220 kkal</span>
              </div>

              <div class="flex items-center text-sm text-gray-700">
                <span class="mr-2">🥗</span>
                <span>30 gr</span>
              </div>

              <div class="flex items-center justify-between mt-3">
                <div class="flex items-center bg-green-600 text-white px-2 py-1 rounded-md text-sm">
                  ⭐ <span class="ml-1">4.5</span>
                </div>
                <button class="text-red-500 text-xl">❤️</button>
              </div>
            </div>
          </div>

          <!-- Duplikat 3 kartu berikut -->
          <div class="bg-white rounded-xl shadow-md overflow-hidden w-56">
            <img src="/asset/greek-salad.png" alt="Greek Salad" class="w-full h-40 object-cover">
            <div class="p-4">
              <h3 class="font-semibold text-gray-800">Greek Salad</h3>
              <div class="flex items-center text-sm text-gray-700 mt-1">
                <span class="mr-2">🔥</span>
                <span>220 kkal</span>
              </div>
              <div class="flex items-center text-sm text-gray-700">
                <span class="mr-2">🥗</span>
                <span>30 gr</span>
              </div>
              <div class="flex items-center justify-between mt-3">
                <div class="flex items-center bg-green-600 text-white px-2 py-1 rounded-md text-sm">
                  ⭐ <span class="ml-1">4.5</span>
                </div>
                <button class="text-red-500 text-xl">❤️</button>
              </div>
            </div>
          </div>

          <div class="bg-white rounded-xl shadow-md overflow-hidden w-56">
            <img src="/asset/cobb-salad.png" alt="Cobb Salad" class="w-full h-40 object-cover">
            <div class="p-4">
              <h3 class="font-semibold text-gray-800">Cobb Salad</h3>
              <div class="flex items-center text-sm text-gray-700 mt-1">
                <span class="mr-2">🔥</span>
                <span>220 kkal</span>
              </div>
              <div class="flex items-center text-sm text-gray-700">
                <span class="mr-2">🥗</span>
                <span>30 gr</span>
              </div>
              <div class="flex items-center justify-between mt-3">
                <div class="flex items-center bg-green-600 text-white px-2 py-1 rounded-md text-sm">
                  ⭐ <span class="ml-1">4.5</span>
                </div>
                <button class="text-red-500 text-xl">❤️</button>
              </div>
            </div>
          </div>

          <div class="bg-white rounded-xl shadow-md overflow-hidden w-56">
            <img src="/asset/spring-roll-salad.png" alt="Spring Roll Salad" class="w-full h-40 object-cover">
            <div class="p-4">
              <h3 class="font-semibold text-gray-800">Spring Roll Salad</h3>
              <div class="flex items-center text-sm text-gray-700 mt-1">
                <span class="mr-2">🔥</span>
                <span>220 kkal</span>
              </div>
              <div class="flex items-center text-sm text-gray-700">
                <span class="mr-2">🥗</span>
                <span>30 gr</span>
              </div>
              <div class="flex items-center justify-between mt-3">
                <div class="flex items-center bg-green-600 text-white px-2 py-1 rounded-md text-sm">
                  ⭐ <span class="ml-1">4.5</span>
                </div>
                <button class="text-red-500 text-xl">❤️</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Tombol kanan -->
        <button class="bg-green-700 text-white rounded-full p-3 hover:bg-green-800 transition">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
            stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
          </svg>
        </button>
      </div>

      <!-- Tombol Lihat Semua Menu -->
      <a href="{{ url('/menu') }}"
        class="bg-green-700 hover:bg-green-800 text-white font-semibold py-3 px-8 rounded-full flex items-center space-x-2 transition">
        <span>Lihat Semua Menu</span>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
          stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
        </svg>
      </a>
    </div>
  </div>
</section>