<section id="lab-section" class="relative overflow-hidden py-20 bg-[#DAEFA2]">

  <!-- PATTERN KIRI ATAS -->
  <div
    class="absolute top-0 left-0 w-full h-[55%] bg-no-repeat bg-cover z-0"
    style="
      background-image: url('/asset/bg-lab1.png');
      background-position: top left;
      background-size: contain;
      clip-path: polygon(0 0, 100% 0, 100% 75%, 0 90%);
    ">
  </div>

  <!-- PATTERN KANAN BAWAH -->
  <div
    class="absolute bottom-0 left-0 w-full h-[55%] bg-no-repeat bg-cover z-0"
    style="
      background-image: url('/asset/bg-lab2.png');
      background-position: bottom right;
      background-size: contain;
      clip-path: polygon(0 20%, 100% 10%, 100% 100%, 0 100%);
    ">
  </div>

  <!-- KONTEN UTAMA -->
  <div class="relative z-10 max-w-6xl mx-auto px-10 grid md:grid-cols-2 gap-16 items-start justify-center">

    <!-- KIRI - INFORMASI PERSONAL -->
    <div class="flex flex-col items-center justify-start md:ml-12">
      <div class="text-center">
        <h2 class="text-2xl font-semibold text-gray-900 mb-2">Informasi Personal</h2>
        <div class="h-1 w-16 bg-yellow-400 mx-auto mb-8"></div>
      </div>

      <!-- PILIH GENDER -->
      <div class="flex justify-center gap-10 mb-10">
        <label class="cursor-pointer">
          <input type="radio" name="gender" class="hidden peer" />
          <div
            class="flex flex-col items-center gap-2 border-2 border-transparent peer-checked:border-green-500 peer-checked:bg-green-50 rounded-2xl px-6 py-4 transition">
            <img src="/asset/laki.png" alt="Laki-laki" class="w-16 h-16 object-contain">
            <span class="text-sm font-medium">Laki-Laki</span>
          </div>
        </label>

        <label class="cursor-pointer">
          <input type="radio" name="gender" class="hidden peer" />
          <div
            class="flex flex-col items-center gap-2 border-2 border-transparent peer-checked:border-green-500 peer-checked:bg-green-50 rounded-2xl px-6 py-4 transition">
            <img src="/asset/perempuan.png" alt="Perempuan" class="w-16 h-16 object-contain">
            <span class="text-sm font-medium">Perempuan</span>
          </div>
        </label>
      </div>

      <!-- INPUT DATA DIRI -->
      <span class="text-sm text-red-600 font-medium block mb-3 text-center">*Lengkapi Data Diri Anda</span>
      <div class="flex flex-col items-center space-y-4">
        <input type="text" placeholder="Usia"
          class="w-80 border border-green-600 rounded-md px-4 py-2 text-center focus:outline-none focus:ring-2 focus:ring-green-500">
        <input type="text" placeholder="Tinggi Badan (Cm)"
          class="w-80 border border-green-600 rounded-md px-4 py-2 text-center focus:outline-none focus:ring-2 focus:ring-green-500">
        <input type="text" placeholder="Berat Badan (Kg)"
          class="w-80 border border-green-600 rounded-md px-4 py-2 text-center focus:outline-none focus:ring-2 focus:ring-green-500">
      </div>
    </div>

    <!-- KANAN - AKTIVITAS & TUJUAN -->
    <div class="flex flex-col items-center justify-between md:-ml-8 h-full">
      <!-- AKTIVITAS -->
      <div class="text-center mb-10">
        <h3 class="text-2xl font-semibold text-gray-900 mb-2">Aktivitas</h3>
        <div class="h-1 w-12 bg-yellow-400 mx-auto mb-8"></div>
        <div class="grid grid-cols-3 gap-6 justify-center">
          <label class="cursor-pointer">
            <input type="radio" name="aktivitas" class="hidden peer" />
            <div
              class="w-28 h-20 flex items-center justify-center peer-checked:bg-green-100 peer-checked:text-green-800 peer-checked:border-green-500 border border-gray-300 bg-gray-100 text-gray-700 font-semibold rounded-xl transition">
              Ringan
            </div>
          </label>

          <label class="cursor-pointer">
            <input type="radio" name="aktivitas" class="hidden peer" />
            <div
              class="w-28 h-20 flex items-center justify-center peer-checked:bg-green-100 peer-checked:text-green-800 peer-checked:border-green-500 border border-gray-300 bg-gray-100 text-gray-700 font-semibold rounded-xl transition">
              Sedang
            </div>
          </label>

          <label class="cursor-pointer">
            <input type="radio" name="aktivitas" class="hidden peer" />
            <div
              class="w-28 h-20 flex items-center justify-center peer-checked:bg-green-100 peer-checked:text-green-800 peer-checked:border-green-500 border border-gray-300 bg-gray-100 text-gray-700 font-semibold rounded-xl transition">
              Berat
            </div>
          </label>
        </div>
      </div>

      <div class="w-[80%] h-0.5 bg-[#0B7932] mb-10"></div>

      <!-- TUJUAN -->
      <div class="text-center">
        <h3 class="text-2xl font-semibold text-gray-900 mb-2">Tujuan</h3>
        <div class="h-1 w-12 bg-yellow-400 mx-auto mb-8"></div>
        <div class="grid grid-cols-3 gap-6 justify-center">
          <label class="cursor-pointer">
            <input type="radio" name="tujuan" class="hidden peer" />
            <div
              class="w-28 h-20 flex items-center justify-center peer-checked:bg-green-100 peer-checked:text-green-800 peer-checked:border-green-500 border border-gray-300 bg-gray-100 text-gray-700 font-semibold rounded-xl transition">
              Turun
            </div>
          </label>

          <label class="cursor-pointer">
            <input type="radio" name="tujuan" class="hidden peer" />
            <div
              class="w-28 h-20 flex items-center justify-center peer-checked:bg-green-100 peer-checked:text-green-800 peer-checked:border-green-500 border border-gray-300 bg-gray-100 text-gray-700 font-semibold rounded-xl transition">
              Pertahankan
            </div>
          </label>

          <label class="cursor-pointer">
            <input type="radio" name="tujuan" class="hidden peer" />
            <div
              class="w-28 h-20 flex items-center justify-center peer-checked:bg-green-100 peer-checked:text-green-800 peer-checked:border-green-500 border border-gray-300 bg-gray-100 text-gray-700 font-semibold rounded-xl transition">
              Naik
            </div>
          </label>
        </div>
      </div>
    </div>
  </div>

  <!-- TOMBOL -->
  <div class="relative flex justify-center gap-6 mt-20 z-10">
    <button
      class="bg-yellow-400 hover:bg-yellow-500 text-black font-semibold px-10 py-3 rounded-full shadow transition">Hitung</button>
    <button
      class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold px-10 py-3 rounded-full shadow transition">Reset</button>
  </div>
</section>