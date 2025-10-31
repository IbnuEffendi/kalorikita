<section class="bg-white py-12">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-2xl font-bold text-black mb-6">Menu Mingguan</h2>

        <div class="bg-yellow-400 rounded-3xl py-10">
            <!-- Swiper container -->
            <div class="swiperContainer px-10 flex justify-between items-center">
                <button class="swiper-button-prev-custom mr-5">
                    <!-- Ikon kiri -->
                    <svg width="32" height="32" viewBox="0 0 62 69" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M5 42.9239C-1.66667 39.0749 -1.66667 29.4524 5 25.6034L47 1.35471C53.6667 -2.4943 62 2.31696 62 10.015L62 58.5124C62 66.2104 53.6667 71.0216 47 67.1726L5 42.9239Z"
                            fill="#0B7932" />
                    </svg>
                </button>
                <div class="swiper menuSwiper ">
                    <div class="swiper-wrapper">
                        @forelse ($menuMingguan as $menu)
                            <div class="swiper-slide flex justify-center ">
                                <div class="bg-white rounded-xl drop-shadow-xl rop-shadow-white-500/50 overflow-hidden w-56">
                                    <img src="{{ $menu->gambar }}" alt="{{ $menu->nama_menu }}"
                                        class="w-full h-40 object-cover">
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
                                            <div
                                                class="flex items-center
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

                </div>
                <button class="swiper-button-next-custom ml-5">
                    <!-- Ikon kanan -->
                    <svg width="32" height="32" viewBox="0 0 62 69" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M57 25.6033C63.6667 29.4523 63.6667 39.0748 57 42.9238L15 67.1725C8.33333 71.0215 -3.21348e-06 66.2103 -2.87699e-06 58.5123L-7.57103e-07 10.0148C-4.20613e-07 2.31684 8.33333 -2.49442 15 1.35459L57 25.6033Z"
                            fill="#0B7932" />
                    </svg>
                </button>
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
