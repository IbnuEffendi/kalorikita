<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pilih Paket Langgananmu | KaloriKita</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>

  <body class="bg-[#F4F8F2] font-sans">

      <x-navbar></x-navbar>
      
    <!-- ===================== HERO SECTION ===================== -->
    <section class="relative w-full">
      <div class="absolute inset-0">
        <!-- TODO: isi source gambar hero background -->
        <img
          src="/asset/header-paket.jpeg"
          class="w-full h-full object-cover"
        />
        <div class="absolute inset-0 bg-[#1F5A34]/50"></div>
      </div>

      <div class="relative text-left text-white py-14 max-w-6xl mx-auto px-6">
        <h1 class="text-3xl md:text-4xl font-extrabold mb-3">
          Pilih Paket Langgananmu
        </h1>
        <p class="text-lg md:text-xl font-medium">
          Menu Sehat Dikirim Setiap Hari, Kalori Jelas, Makro Pas Targetmu
        </p>
      </div>
    </section>

    <!-- ===================== CARD SECTION ===================== -->
    <section class="relative max-w-6xl mx-auto px-6 py-14">
      <!-- Doodle background kiri bawah -->
      <div
        class="absolute bottom-0 left-0 w-[250px] opacity-30 pointer-events-none"
        style="background-image: url('{{ asset('images/doodle-left.png') }}'); background-size: contain; background-repeat: no-repeat; height: 200px;">
      </div>

      <!-- Doodle background kanan bawah -->
      <div
        class="absolute bottom-0 right-0 w-[250px] opacity-30 pointer-events-none"
        style="background-image: url('{{ asset('images/doodle-right.png') }}'); background-size: contain; background-repeat: no-repeat; height: 200px;">
      </div>

      @php
        $paketList = [
          [
            'nama' => 'Pencoba',
            'slug' => 'pencoba',
            'harga' => 300000,
            'desc' => 'Cocok untuk kamu yang mau cobain menu Kalorikita.',
            'keuntungan' => ['Akses Penuh Lab Kalori', '10 Makanan (5x Makan Siang, 5x Makan Malam)']
          ],
          [
            'nama' => 'Maintain',
            'slug' => 'maintain',
            'harga' => 350000,
            'desc' => 'Buat kamu yang ingin menjaga berat badan ideal.',
            'keuntungan' => ['Kalori Seimbang', 'Menu Bervariasi']
          ],
          [
            'nama' => 'Weight Loss',
            'slug' => 'weightloss',
            'harga' => 400000,
            'desc' => 'Program diet sehat untuk turunkan berat badan.',
            'keuntungan' => ['Menu Rendah Kalori', 'Dibimbing Ahli Gizi']
          ],
        ];
      @endphp

      <!-- Grid Kartu Paket -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mb-14 relative z-10">
        @foreach ($paketList as $paket)
          <div class="bg-white rounded-2xl shadow-md hover:shadow-lg transition-all border border-[#E5E7EB] p-6 flex flex-col relative">
            <span class="absolute -top-3 right-6 bg-[#FDCB5D] text-[12px] font-semibold px-3 py-1 rounded-full ring-1 ring-gray-200">
              Diskon 20%
            </span>

            <h3 class="font-semibold text-lg text-gray-800">{{ $paket['nama'] }}</h3>
            <p class="text-sm text-gray-600 mt-1">{{ $paket['desc'] }}</p>

            <div class="mt-6">
              <div class="flex items-end gap-2">
                <span class="text-sm text-gray-700">Rp</span>
                <span class="text-[30px] font-extrabold tracking-tight text-black">
                  {{ number_format($paket['harga'], 0, ',', '.') }}
                </span>
                <span class="ml-auto text-xs text-gray-500">/Minggu</span>
              </div>

              <a
                href="{{ route('paket.detail', $paket['slug']) }}"
                class="mt-4 block rounded-full bg-[#2F6F3B] text-white text-center font-semibold py-2 hover:bg-[#24582E] transition shadow-md transform hover:-translate-y-1">
                Lihat Detail & Pesan
              </a>

              <div class="mt-5">
                <p class="font-semibold text-gray-800">Keuntungan Paket.</p>
                <ul class="mt-2 space-y-2 text-sm text-gray-700">
                  @foreach ($paket['keuntungan'] as $benefit)
                    <li class="flex items-center gap-2">
                      <span class="h-1.5 w-1.5 rounded-full bg-gray-900 inline-block"></span>
                      {{ $benefit }}
                    </li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
        @endforeach
      </div>

      <!-- ===================== PAGINATION ===================== -->
      <div class="mt-12 flex items-center justify-center gap-4 relative z-10">
        <button
          class="w-10 h-10 flex items-center justify-center bg-[#2F6F3B] text-white rounded-md shadow-md hover:bg-[#24582E] transition">
          ◀
        </button>
        <button class="w-12 h-12 flex items-center justify-center bg-[#2F6F3B] text-white rounded-xl font-extrabold shadow-md">
          1
        </button>
        <button class="w-12 h-12 flex items-center justify-center bg-white ring-1 ring-gray-200 rounded-xl hover:bg-gray-100 transition">
          2
        </button>
        <button class="w-12 h-12 flex items-center justify-center bg-white ring-1 ring-gray-200 rounded-xl hover:bg-gray-100 transition">
          3
        </button>
        <button
          class="w-10 h-10 flex items-center justify-center bg-[#2F6F3B] text-white rounded-md shadow-md hover:bg-[#24582E] transition">
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