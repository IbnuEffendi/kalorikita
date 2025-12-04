<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pilih Paket Langgananmu | KaloriKita</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>

  <body class="bg-[#F4F8F2] font-sans">

    {{-- NAVBAR COMPONENT --}}
    <x-navbar></x-navbar>
      
    <section class="relative w-full">
      <div class="absolute inset-0">
        <img
          src="/asset/header-paket.jpeg"
          class="w-full h-full object-cover"
          alt="Header Paket"
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

    <section class="relative max-w-6xl mx-auto px-6 py-14">
      
      <div
        class="absolute bottom-0 left-0 w-[250px] opacity-30 pointer-events-none"
        style="background-image: url('{{ asset('images/doodle-left.png') }}'); background-size: contain; background-repeat: no-repeat; height: 200px;">
      </div>

      <div
        class="absolute bottom-0 right-0 w-[250px] opacity-30 pointer-events-none"
        style="background-image: url('{{ asset('images/doodle-right.png') }}'); background-size: contain; background-repeat: no-repeat; height: 200px;">
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mb-14 relative z-10">
        
        {{-- LOOPING DATA DARI DATABASE (Controller) --}}
        @foreach ($categories as $cat)
          <div class="bg-white rounded-2xl shadow-md hover:shadow-lg transition-all border border-[#E5E7EB] p-6 flex flex-col relative h-full">
            
            {{-- LABEL DISKON (DI-HIDE DULU) --}}
            {{-- 
            <span class="absolute -top-3 right-6 bg-[#FDCB5D] text-[12px] font-semibold px-3 py-1 rounded-full ring-1 ring-gray-200">
              Diskon 20%
            </span> 
            --}}

            {{-- NAMA PAKET --}}
            <h3 class="font-semibold text-lg text-gray-800">{{ $cat->nama_kategori }}</h3>
            
            {{-- DESKRIPSI PAKET --}}
            <p class="text-sm text-gray-600 mt-1 line-clamp-2 h-10">{{ $cat->deskripsi }}</p>

            <div class="mt-6">
              {{-- HARGA PAKET --}}
              <div class="flex items-end gap-2">
                <span class="text-sm text-gray-500 mb-1">Mulai</span>
                <span class="text-sm text-gray-700 mb-1">Rp</span>
                <span class="text-[30px] font-extrabold tracking-tight text-black leading-none">
                  {{-- Ambil harga termurah dari opsi --}}
                  {{ number_format($cat->options->min('harga'), 0, ',', '.') }}
                </span>
                <span class="ml-auto text-xs text-gray-500 mb-1">/Minggu</span>
              </div>

              {{-- TOMBOL DETAIL --}}
              {{-- Note: Ganti '#' dengan route detail jika sudah ada, misal: route('paket.detail', $cat->slug) --}}
              <a
                href="{{ route('paket.detail', $cat->slug) }}"
                class="mt-4 block rounded-full bg-[#2F6F3B] text-white text-center font-semibold py-2 hover:bg-[#24582E] transition shadow-md transform hover:-translate-y-1">
                Lihat Detail & Pesan
              </a>

              {{-- KEUNTUNGAN PAKET (Looping JSON) --}}
              <div class="mt-5 border-t pt-4 border-gray-100">
                <p class="font-semibold text-gray-800 text-sm">Keuntungan Paket.</p>
                <ul class="mt-2 space-y-2 text-sm text-gray-700">
                  @if($cat->keuntungan)
                    @foreach ($cat->keuntungan as $benefit)
                      <li class="flex items-start gap-2">
                        <span class="h-1.5 w-1.5 rounded-full bg-gray-900 inline-block mt-1.5 flex-shrink-0"></span>
                        {{ $benefit }}
                      </li>
                    @endforeach
                  @endif
                </ul>
              </div>

            </div>
          </div>
        @endforeach

      </div>

    </section>

    {{-- FOOTER COMPONENT --}}
    <x-footer></x-footer>

  </body>
</html>