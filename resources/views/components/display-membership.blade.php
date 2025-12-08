<section class="bg-[url(/asset/bg-home3.png)] bg-cover pb-32">

    <div class="relative z-10 max-w-7xl mx-auto text-center pt-16 px-4">
        <h2 class="text-3xl font-bold text-gray-900 mb-2">
            Pilih Paket Langganan Sekarang
        </h2>
        <p class="text-gray-800 mb-12 max-w-3xl mx-auto">
            <span class="font-semibold">Kalorikita</span> Hadir Dengan Berbagai
            Pilihan Paket Yang Bisa Kamu Pilih
            <span class="font-semibold">Sesuai Dengan Preferensi Kamu</span>, Pilih
            Paket Untuk Dapatkan
            <span class="font-semibold">Akses Penuh.</span>
        </p>

        <div class="flex flex-col md:flex-row justify-center items-stretch gap-8">
            
            @foreach($packets as $paket)
            
            @php
                // AMBIL DATA HARGA DARI TABEL RELASI (PaketOption)
                // Kita ambil opsi pertama sebagai harga tampilan utama
                $opsi = $paket->options->first();
            @endphp

            <div class="bg-white shadow-xl rounded-3xl p-6 w-80 relative hover:shadow-xl transition border-2 border-green-800 flex flex-col">
                
                @if((isset($paket->diskon) && $paket->diskon > 0) || (isset($opsi->diskon) && $opsi->diskon > 0))
                    <div class="discount flex justify-end">
                        <span class="bg-yellow-400 text-sm font-semibold px-3 py-1 rounded-full">
                            Diskon {{ $paket->diskon ?? $opsi->diskon }}%
                        </span>
                    </div>
                @else
                    <div class="h-8"></div> @endif

                <h3 class="text-xl font-bold mb-1 text-left">{{ $paket->nama_kategori }}</h3>
                
                <p class="text-gray-600 text-sm mb-4 text-left">
                    {{ $paket->deskripsi }}
                </p>
                
                <div class="text-left mb-4">
                    <span class="text-gray-500 text-sm font-medium">Mulai</span>
                    <p class="text-2xl font-bold inline-block">
                        Rp <span class="text-3xl">
                            {{ number_format($opsi->harga ?? 0, 0, ',', '.') }}
                        </span>
                        <span class="text-base font-normal text-gray-700">
                            {{ $opsi->periode ?? '/Minggu' }}
                        </span>
                    </p>
                </div>
                
                <div class="mt-auto">
                    <a href="{{ route('paket.detail', $paket->slug ?? '#') }}">
                        <button class="bg-green-700 hover:bg-green-800 text-white font-semibold py-2 px-6 rounded-full w-full transition shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            Lihat Detail & Pesan
                        </button>
                    </a>
                </div>
                
                <div class="mt-6 text-left">
                    <p class="font-semibold mb-1">Keuntungan Paket.</p>
                    <ul class="text-sm text-gray-700 space-y-1">
                        @if(is_array($paket->keuntungan) || is_object($paket->keuntungan))
                            @foreach($paket->keuntungan as $feature)
                                <li>● {{ $feature }}</li>
                            @endforeach
                        @endif
                    </ul>
                </div>

            </div>
            
            @endforeach
            </div>
    </div>

    <div class="absolute bottom-0 right-0 w-[350px] h-[350px] opacity-25 pointer-events-none select-none">
        <img src="/asset/buah.png" alt="tomat" class="absolute bottom-4 right-8 w-40 rotate-12" />
    </div>

    <style>
        .clip-path-diagonal {
            clip-path: polygon(0 50%, 100% 0, 100% 100%, 0% 100%);
        }
    </style>
</section>