<section class="bg-white py-12">
  <div class="max-w-7xl mx-auto px-6">
    <h2 class="text-2xl font-bold text-black mb-6">Menu Mingguan</h2>

    <div class="bg-[#F4B400] rounded-3xl py-10 px-6">
      <!-- Swiper container -->
      <div class="swiper menuSwiper">
        <div class="swiper-wrapper">
          @forelse ($menuMingguan as $menu)
            <div class="swiper-slide flex justify-center">
              <div class="bg-white rounded-xl shadow-xl overflow-hidden w-56">
                <img
                  src="{{ $menu->gambar }}"
                  alt="{{ $menu->nama_menu }}"
                  class="w-full h-40 object-cover"
                >
                <div class="p-4">
                  <h3 class="font-semibold text-gray-800 truncate">{{ $menu->nama_menu }}</h3>

                  <div class="flex items-center text-sm text-gray-700 mt-1">
                    <span class="mr-2">🔥</span>
                    <span>{{ $menu->kalori ? $menu->kalori . ' kkal' : '-' }}</span>
                  </div>

                  <div class="flex items-center text-sm text-gray-700">
                    <span class="mr-2">🥗</span>
                    <span>{{ $menu->protein ? $menu->protein . ' gr' : '-' }}</span>
                  </div>

                  <div class="flex items-center justify-between mt-3">
                    <div class="flex items-center
                      {{ $menu->tipe_makanan === 'vegan' ? 'bg-green-600' : 'bg-orange-400' }}
                      text-white px-2 py-1 rounded-md text-sm">
                      <span class="text-xs capitalize">
                        {{ $menu->tipe_makanan === 'vegan' ? 'Vegan' : 'Non Vegan' }}
                      </span>
                    </div>
                    <button class="text-red-500 text-xl">❤️</button>
                  </div>
                </div>
              </div>
            </div>
          @empty
            <p class="text-white text-sm">Belum ada menu.</p>
          @endforelse
        </div>

        <!-- tombol next / prev -->
        <div class="swiper-button-next text-green-700"></div>
        <div class="swiper-button-prev text-green-700"></div>

      </div>

      <!-- Tombol Lihat Semua Menu -->
      <div class="flex justify-center mt-10">
        <a href="/menu"
          class="bg-green-700 hover:bg-green-800 text-white font-semibold py-3 px-8 rounded-full flex items-center space-x-2 transition">
          <span>Lihat Semua Menu</span>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
            stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
          </svg>
        </a>
      </div>
    </div>
  </div>
</section>
