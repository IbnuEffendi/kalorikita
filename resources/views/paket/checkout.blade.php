<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pemesanan | MealPlan</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>

  <body class="bg-[#F4F8F2] font-sans relative">

     <x-navbar></x-navbar>

    <!-- ===================== HEADER SECTION ===================== -->
    <section class="relative bg-green-800 text-white py-16">
      <div class="absolute inset-0">
        <img
          src="/asset/header-paket.jpeg"
          class="w-full h-full object-cover"
        />
        <div class="absolute inset-0 bg-green-900/60"></div>
      </div>

      <div class="relative max-w-6xl mx-auto px-6 text-left">
        <h1 class="text-4xl font-bold mb-2">Pemesanan</h1>
        <p class="text-lg font-medium">
          Pilih Paket Yang Kamu Inginkan, Lalu Pesan Sekarang!
        </p>
      </div>
    </section>

    <!-- ===================== PROGRESS BAR ===================== -->
    <section class="max-w-6xl mx-auto px-6 mt-10">
      <div class="flex items-center justify-center space-x-6 text-sm font-medium text-gray-600">
        <!-- Step 1 -->
        <div class="flex items-center space-x-2">
          <div class="w-6 h-6 rounded-full bg-green-600 text-white flex items-center justify-center text-xs font-semibold">
            1
          </div>
          <span>Data & Pengiriman</span>
        </div>

        <div class="w-16 h-0.5 bg-gray-300"></div>

        <!-- Step 2 -->
        <div class="flex items-center space-x-2">
          <div class="w-6 h-6 rounded-full bg-green-600 text-white flex items-center justify-center text-xs font-semibold">
            2
          </div>
          <span>Pembayaran</span>
        </div>

        <div class="w-16 h-0.5 bg-gray-300"></div>

        <!-- Step 3 -->
        <div class="flex items-center space-x-2">
          <div class="w-6 h-6 rounded-full border-2 border-gray-400 text-gray-500 flex items-center justify-center text-xs font-semibold">
            3
          </div>
          <span>Konfirmasi</span>
        </div>
      </div>
    </section>

    <!-- ===================== FORM & SUMMARY ===================== -->
    <section class="max-w-6xl mx-auto px-6 py-12 flex flex-col lg:flex-row gap-10 relative z-10">
      <!-- LEFT: FORM -->
      <div class="bg-white shadow-md rounded-2xl p-8 flex-1">
        <h2 class="text-2xl font-bold text-gray-800 mb-8">Detail Pesanan</h2>

        <form id="orderForm" class="space-y-6" method="POST" action="#">
          <!-- Paket -->
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Paket</label>
            <select
              id="paketSelect"
              class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-green-500 focus:outline-none"
            >
              <option value="">Pilih paket...</option>
              <option value="pencoba">Paket Pencoba</option>
              <option value="maintain">Paket Maintain</option>
              <option value="weightloss">Paket Weight Loss</option>
              <option value="musclegain">Paket Muscle Gain</option>
              <option value="vegetarian">Paket Vegetarian</option>
              <option value="customdiet">Paket Custom Diet</option>
            </select>
          </div>

          <!-- Nama Lengkap -->
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
            <input
              type="text"
              class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-green-500 focus:outline-none"
              placeholder="Masukkan nama lengkap"
              required
            />
          </div>

          <!-- Alamat -->
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat Pengiriman</label>
            <textarea
              rows="3"
              class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-green-500 focus:outline-none"
              placeholder="Jalan, RT/RW, Kel/Desa, Kota, Kode Pos"
              required
            ></textarea>
          </div>

          <!-- Catatan -->
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Catatan (opsional)</label>
            <input
              type="text"
              class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-green-500 focus:outline-none"
              placeholder="Misal: tanpa pedas, alergi udang"
            />
          </div>

          <!-- Metode Pembayaran -->
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-3">Metode Pembayaran</label>
            <div class="grid grid-cols-3 gap-3">
              <button type="button" class="py-3 border border-gray-300 rounded-xl text-gray-700 font-semibold bg-gray-50 hover:bg-gray-100 transition">
                Transfer
              </button>
              <button type="button" class="py-3 border border-gray-300 rounded-xl text-gray-700 font-semibold bg-gray-50 hover:bg-gray-100 transition">
                QRIS
              </button>
              <button type="button" class="py-3 border border-gray-300 rounded-xl text-gray-700 font-semibold bg-gray-50 hover:bg-gray-100 transition">
                Kartu Kredit
              </button>
            </div>
          </div>

          <!-- Voucher -->
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Voucher</label>
            <div class="flex gap-3">
              <input
                type="text"
                placeholder="KODEPROMO"
                class="flex-1 border border-gray-300 rounded-lg p-3 placeholder-gray-400 focus:ring-2 focus:ring-green-500 focus:outline-none"
              />
              <button
                type="button"
                class="px-5 py-3 bg-gray-100 border border-gray-300 rounded-lg font-semibold text-gray-700 hover:bg-gray-200 transition"
              >
                Terapkan
              </button>
            </div>
          </div>
        </form>
      </div>

      <!-- RIGHT: RINGKASAN -->
      <div class="lg:w-1/3">
        <div class="bg-white shadow-md rounded-2xl p-6">
          <h3 class="text-xl font-semibold text-gray-800 mb-6">Ringkasan</h3>

          <div class="space-y-3 text-gray-700">
            <div class="flex justify-between">
              <span>Paket Maintain</span>
              <span class="font-medium">Rp 200.000</span>
            </div>
            <div class="flex justify-between">
              <span>Ongkir</span>
              <span class="text-green-600 font-medium">Gratis</span>
            </div>
            <div class="flex justify-between">
              <span>Diskon</span>
              <span class="text-red-500 font-medium">- Rp 20.000</span>
            </div>
            <div class="border-t border-gray-200 pt-3 flex justify-between items-center">
              <span class="font-bold text-gray-800 text-lg">Total</span>
              <span class="font-extrabold text-black text-lg">Rp 180.000</span>
            </div>
          </div>

          <!-- Tombol Bayar Sekarang -->
          <a
            href="{{ route('pesanan.success') }}"
            class="block w-full mt-8 py-3 bg-[#FDCB5D] hover:bg-[#e6b94d] text-black font-semibold rounded-xl text-center transition"
          >
            Bayar Sekarang
          </a>

          <p class="text-sm text-gray-500 text-center mt-4">
            Pembayaran aman & terenkripsi
          </p>
        </div>
      </div>
    </section>

    <!-- ===================== DOODLE KIRI BAWAH ===================== -->
    <div
      class="pointer-events-none fixed bottom-0 left-0 w-[220px] h-[220px] opacity-60 bg-no-repeat bg-contain"
      style="background-image:url('/asset/doodle-left.png');">
      <!-- ganti /asset/doodle-left.png dgn file kamu -->
<div
  class="pointer-events-none fixed bottom-0 left-0 w-[380px] h-[380px] opacity-60 bg-no-repeat bg-contain"
  style="background-image:url('/asset/kiri bawah.png'); background-position: bottom left; transform: translate(-10px, 10px);">
</div>


<div
  class="pointer-events-none fixed bottom-[-50px] right-[-50px] w-[380px] h-[380px] opacity-60 bg-no-repeat bg-contain"
  style="background-image:url('/asset/kanan bawah.png');">
</div>

    </div>
  </body>
</html>
