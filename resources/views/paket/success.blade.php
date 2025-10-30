<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pesanan Berhasil | Kalori Kita</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>

  <body class="bg-[#D8E8A8] font-sans relative min-h-screen flex flex-col">

        <x-navbar></x-navbar>

    <!-- ========== PATTERN BACKGROUND (ATAS & SAMPING) ========== -->
    <!-- Ganti src="" dengan source gambar pattern kamu -->
    <!-- contoh: <img src="{{ asset('images/top-pattern.png') }}" ... /> -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden">
      <!-- Letakkan pattern dekorasi kiri -->
      <!-- <img src="" alt="pattern kiri" class="absolute left-0 top-1/3 w-40 opacity-80" /> -->

      <!-- Letakkan pattern dekorasi kanan -->
      <!-- <img src="" alt="pattern kanan" class="absolute right-0 bottom-10 w-40 opacity-80" /> -->
    </div>

    <!-- ========== KONTAINER UTAMA ========== -->
    <main class="flex-grow flex items-center justify-center px-4 py-16 relative z-10">
      <div
        class="bg-white rounded-3xl shadow-md text-center p-12 max-w-xl w-full border border-gray-200"
      >
        @if (session('success'))
        <div class="mb-6 bg-green-100 text-green-800 px-4 py-2 rounded-lg font-medium">
         {{ session('success') }}
     </div>
        @endif

        <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-8">
          Pesanan Berhasil!
        </h1>

        <!-- ICON CENTANG -->
        <div
          class="w-20 h-20 rounded-full bg-green-700 flex items-center justify-center mx-auto mb-10 shadow-sm"
        >
          <!-- Ganti dengan SVG atau image centang kamu -->
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-10 w-10 text-white"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            stroke-width="3"
          >
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
          </svg>
        </div>

        <!-- Tombol Navigasi -->
        <div class="flex justify-center gap-6">
          <a
            href="{{ url('/') }}"
            class="bg-[#FDCB5D] hover:bg-[#e3b84c] text-gray-800 font-medium rounded-full px-8 py-2.5 transition-all shadow-sm"
          >
            Home
          </a>

          <a
            href="{{ url('/pesanan-saya') }}"
            class="bg-[#FDCB5D] hover:bg-[#e3b84c] text-gray-800 font-medium rounded-full px-8 py-2.5 transition-all shadow-sm"
          >
            Pesanan Saya
          </a>
        </div>
      </div>
    </main>

   <x-footer></x-footer>