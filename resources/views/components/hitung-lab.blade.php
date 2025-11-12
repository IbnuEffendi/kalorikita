<section id="lab-section" class="relative overflow-hidden py-20 pt-20 bg-[#0B7932]" style="width: 100vw; margin-left: calc(60% - 60vw);">

  <div
    class="absolute top-0 left-0 w-[400px] h-[400px] bg-no-repeat z-0"
    style="
      background-image: url('/asset/kiri atas.png');
      background-position: top left;
      background-size: contain;
    ">
  </div>

  <div
    class="absolute bottom-0 right-0 w-[400px] h-[400px] bg-no-repeat z-0"
    style="
      background-image: url('/asset/kanan bawah.png');
      background-position: bottom right;
      background-size: contain;
    ">
  </div>

  <div class="relative z-10 max-w-5xl mx-auto p-8 md:p-12 bg-[#F4F4F4] bg-opacity-50 rounded-3xl">

    <div class="flex flex-col md:flex-row md:justify-center gap-16 md:gap-12 items-start">

      <div class="flex flex-col items-center justify-start">
        <div class="text-center">
          <h2 class="text-2xl font-semibold text-gray-900 mb-2">Informasi Personal</h2>
          <div class="h-1 w-16 bg-yellow-400 mx-auto mb-8"></div>
        </div>
        <div class="flex justify-center gap-10 mb-10">
          <label class="cursor-pointer">
            <input type="radio" name="gender" class="hidden peer" />
            <div
              class="flex flex-col items-center gap-2 border-2 border-transparent bg-white peer-checked:bg-[#DAEFA2] peer-checked:border-transparent rounded-2xl px-6 py-4 transition">
              <img src="/asset/laki.png" alt="Laki-laki" class="w-16 h-16 object-contain">
              <span class="text-sm font-medium text-gray-900">Laki-Laki</span>
            </div>
          </label>
          <label class="cursor-pointer">
            <input type="radio" name="gender" class="hidden peer" />
            <div
              class="flex flex-col items-center gap-2 border-2 border-transparent bg-white peer-checked:bg-[#DAEFA2] peer-checked:border-transparent rounded-2xl px-6 py-4 transition">
              <img src="/asset/perempuan.png" alt="Perempuan" class="w-16 h-16 object-contain">
              <span class="text-sm font-medium text-gray-900">Perempuan</span>
            </div>
          </label>
        </div>
        <span class="text-sm text-red-600 font-medium block mb-3 text-center">*Lengkapi Data Diri Anda</span>
        <div class="flex flex-col items-center space-y-4">
          <input type="text" placeholder="Usia"
            class="w-80 bg-white rounded-md px-4 py-2 text-center text-gray-900 placeholder:text-gray-500 focus:outline-none focus:ring-2 focus:ring-green-700">
          <input type="text" placeholder="Tinggi Badan (Cm)"
            class="w-80 bg-white rounded-md px-4 py-2 text-center text-gray-900 placeholder:text-gray-500 focus:outline-none focus:ring-2 focus:ring-green-700">
          <input type="text" placeholder="Berat Badan (Kg)"
            class="w-80 bg-white rounded-md px-4 py-2 text-center text-gray-900 placeholder:text-gray-500 focus:outline-none focus:ring-2 focus:ring-green-700">
        </div>
      </div>

      <div class="flex flex-col items-center justify-between h-full">
        <div class="text-center mb-10">
          <h3 class="text-2xl font-semibold text-gray-900 mb-2">Aktivitas</h3>
          <div class="h-1 w-12 bg-yellow-400 mx-auto mb-8"></div>
          <div class="grid grid-cols-3 gap-6 justify-center">
            <label class="cursor-pointer">
              <input type="radio" name="aktivitas" class="hidden peer" />
              <div
                class="w-28 h-20 flex items-center justify-center peer-checked:bg-[#DAEFA2] peer-checked:text-[#0B7932] peer-checked:border-transparent border-transparent bg-white text-gray-900 font-semibold rounded-xl transition">
                Ringan
              </div>
            </label>
            <label class="cursor-pointer">
              <input type="radio" name="aktivitas" class="hidden peer" />
              <div
                class="w-28 h-20 flex items-center justify-center peer-checked:bg-[#DAEFA2] peer-checked:text-[#0B7932] peer-checked:border-transparent border-transparent bg-white text-gray-900 font-semibold rounded-xl transition">
                Sedang
              </div>
            </label>
            <label class="cursor-pointer">
              <input type="radio" name="aktivitas" class="hidden peer" />
              <div
                class="w-28 h-20 flex items-center justify-center peer-checked:bg-[#DAEFA2] peer-checked:text-[#0B7932] peer-checked:border-transparent border-transparent bg-white text-gray-900 font-semibold rounded-xl transition">
                Berat
              </div>
            </label>
          </div>
        </div>
        <div class="w-[80%] h-0.5 bg-[#0B7932] mb-10"></div> 
        <div class="text-center">
          <h3 class="text-2xl font-semibold text-gray-900 mb-2">Tujuan</h3>
          <div class="h-1 w-12 bg-yellow-400 mx-auto mb-8"></div>
          <div class="grid grid-cols-3 gap-6 justify-center">
            <label class="cursor-pointer">
              <input type="radio" name="tujuan" class="hidden peer" />
              <div
                class="w-28 h-20 flex items-center justify-center peer-checked:bg-[#DAEFA2] peer-checked:text-[#0B7932] peer-checked:border-transparent border-transparent bg-white text-gray-900 font-semibold rounded-xl transition">
                Turun
              </div>
            </label>
            <label class="cursor-pointer">
              <input type="radio" name="tujuan" class="hidden peer" />
              <div
                class="w-28 h-20 flex items-center justify-center peer-checked:bg-[#DAEFA2] peer-checked:text-[#0B7932] peer-checked:border-transparent border-transparent bg-white text-gray-900 font-semibold rounded-xl transition">
                Pertahankan
              </div>
            </label>
            <label class="cursor-pointer">
              <input type="radio" name="tujuan" class="hidden peer" />
              <div
                class="w-28 h-20 flex items-center justify-center peer-checked:bg-[#DAEFA2] peer-checked:text-[#0B7932] peer-checked:border-transparent border-transparent bg-white text-gray-900 font-semibold rounded-xl transition">
                Naik
              </div>
            </label>
          </div>
        </div>
      </div>
    </div>

    <div class="relative flex justify-center gap-6 mt-12">
      <button
        class="bg-yellow-400 hover:bg-yellow-500 text-black font-semibold px-10 py-3 rounded-full shadow transition">Hitung</button>
      
      <button
        class="bg-white hover:bg-gray-100 text-[#0B7932] font-semibold px-10 py-3 rounded-full shadow transition border-2 border-[#0B7932]">Reset</button>
    </div>

  </div> </section>