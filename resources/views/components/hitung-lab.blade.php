<section id="lab-section" class="relative bg-white overflow-hidden">
<!-- PATTERN KIRI ATAS -->
  <div
    class="absolute top-0 left-0 w-full h-full bg-no-repeat bg-contain z-0"
    style="background-image: url('/asset/bg-lab1.png');
           background-position: top left;
           background-size: 100%">
  </div>

  <!-- PATTERN KANAN BAWAH -->
  <div
    class="absolute bottom-0 right-0 w-full h-full bg-no-repeat bg-contain z-0"
    style="background-image: url('/asset/bg-lab2.png');
           background-position: bottom right;
           background-size: 100%">
  </div>

  <!-- Konten utama -->
  <div class="relative max-w-4xl mx-auto py-16 px-6 flex flex-col items-center space-y-10">

    <!-- Personal Information -->
    <div class="text-center">
      <h2 class="text-lg font-semibold text-white mb-1">Personal Information</h2>
      <div class="h-1 w-12 bg-yellow-400 mx-auto mb-6"></div>

      <div class="flex justify-center gap-10 mb-10">
        <div class="flex flex-col items-center space-y-2">
          <img src="/asset/laki.png" alt="Laki-laki" class="w-16 h-16 object-contain">
          <span class="text-sm font-medium">Laki-Laki</span>
        </div>
        <div class="flex flex-col items-center space-y-2">
          <img src="/asset/perempuan.png" alt="Perempuan" class="w-16 h-16 object-contain">
          <span class="text-sm font-medium">Perempuan</span>
        </div>
      </div>

      <!-- Input fields (sudah diperbaiki) -->
      <div class="flex items-center justify-center space-x-6 mt-6">
        <!-- Ikon orang di kiri -->
        <img src="/asset/person-icon.png" alt="Person Icon" class="w-44 h-44 object-contain">

        <!-- Form di kanan -->
        <div class="flex flex-col items-center space-y-3">
          <span class="text-xs text-red-600 font-medium">*Lengkapi Data Diri Anda</span>
          <input type="text" placeholder="Usia"
            class="w-64 border border-green-600 rounded-md px-4 py-2 text-center focus:outline-none focus:ring-2 focus:ring-green-500">
          <input type="text" placeholder="Tinggi Badan"
            class="w-64 border border-green-600 rounded-md px-4 py-2 text-center focus:outline-none focus:ring-2 focus:ring-green-500">
          <input type="text" placeholder="Berat Badan"
            class="w-64 border border-green-600 rounded-md px-4 py-2 text-center focus:outline-none focus:ring-2 focus:ring-green-500">
        </div>
      </div>
    </div>

    <!-- Aktivitas Section -->
    <div class="w-full text-center mt-10">
      <h3 class="text-lg font-semibold text-gray-900">Aktivitas</h3>
      <div class="h-1 w-10 bg-yellow-400 mx-auto mb-6"></div>

      <div class="grid grid-cols-3 gap-5 justify-center max-w-md mx-auto">
        <button class="bg-green-100 text-green-800 font-semibold py-4 rounded-md border border-green-300">Ringan</button>
        <button class="bg-gray-100 text-gray-700 font-semibold py-4 rounded-md">Sedang</button>
        <button class="bg-gray-100 text-gray-700 font-semibold py-4 rounded-md">Berat</button>
      </div>
    </div>

    <!-- Tujuan Section -->
    <div class="w-full text-center mt-10">
      <h3 class="text-lg font-semibold text-gray-900">Tujuan</h3>
      <div class="h-1 w-10 bg-yellow-400 mx-auto mb-6"></div>

      <div class="grid grid-cols-3 gap-5 justify-center max-w-md mx-auto">
        <button class="bg-green-100 text-green-800 font-semibold py-4 rounded-md border border-green-300">Turun</button>
        <button class="bg-gray-100 text-gray-700 font-semibold py-4 rounded-md">Pertahankan</button>
        <button class="bg-gray-100 text-gray-700 font-semibold py-4 rounded-md">Naik</button>
      </div>
    </div>

    <!-- Buttons -->
    <div class="flex justify-center gap-6 mt-10">
      <button
        class="bg-yellow-400 hover:bg-yellow-500 text-black font-semibold px-8 py-2 rounded-full shadow transition">Hitung</button>
      <button
        class="border border-gray-400 text-gray-800 font-semibold px-8 py-2 rounded-full hover:bg-gray-100 transition">Reset</button>
    </div>
  </div>
</section>