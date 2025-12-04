<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $category->nama_kategori }} | Detail Paket</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <style>
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>
<body class="bg-[#F4F8F2] font-sans pb-20">

    <x-navbar></x-navbar>

    {{-- HERO SECTION --}}
    <div class="relative w-full h-[400px] md:h-[450px]">
        {{-- GAMBAR DINAMIS (Beda tiap paket) --}}
        <img src="{{ $category->gambar_background }}" 
             class="w-full h-full object-cover brightness-50"
             alt="Background {{ $category->nama_kategori }}">
        
        <div class="absolute inset-0 bg-gradient-to-r from-[#1F5A34]/90 to-transparent"></div>

        <div class="absolute inset-0 max-w-6xl mx-auto px-6 flex flex-col justify-center h-full">
            <a href="{{ route('paket.list') }}" class="text-white/80 hover:text-white mb-6 inline-flex items-center gap-2 transition w-fit">
                <i class="fas fa-arrow-left"></i> Kembali ke Menu
            </a>

            {{-- LABEL DINAMIS (Popular, Best Value, High Protein) --}}
            <div class="mb-4">
                <span class="bg-yellow-400 text-black text-xs font-bold px-3 py-1 rounded-full tracking-wide uppercase shadow-md">
                    {{ $category->label_paket }}
                </span>
            </div>

            <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-3">
                Paket {{ $category->nama_kategori }}
            </h1>

            {{-- TARGET SPESIFIK (Dari Database) --}}
            <div class="flex items-center gap-2 text-white/90 text-lg font-medium">
                <i class="fas fa-bullseye text-[#FDCB5D]"></i>
                <span>Target: {{ $category->target_program }}</span>
            </div>
        </div>
    </div>

    {{-- CONTENT SECTION --}}
    <main class="max-w-6xl mx-auto px-6 -mt-20 relative z-10 grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        {{-- KOLOM KIRI --}}
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white rounded-3xl shadow-sm p-8">
                <h2 class="text-[#1F5A34] text-xl font-bold mb-4">Tentang Paket Ini</h2>
                <div class="text-gray-600 leading-relaxed mb-8 text-[15px]">
                    {!! $category->deskripsi_lengkap !!}
                </div>

                {{-- INFO GIZI --}}
                <div class="bg-[#F4FDF6] border border-[#DCFCE7] rounded-2xl p-6 flex flex-col md:flex-row justify-between items-center text-center divide-y md:divide-y-0 md:divide-x divide-green-200 gap-4 md:gap-0">
                    <div class="flex-1 px-4 w-full">
                        <span class="text-xs text-gray-500 font-bold tracking-wider uppercase block mb-1">KALORI / HARI</span>
                        <span class="text-[#1F5A34] text-xl font-extrabold">{{ $category->range_kalori }}</span>
                    </div>
                    <div class="flex-1 px-4 w-full">
                        <span class="text-xs text-gray-500 font-bold tracking-wider uppercase block mb-1">PROTEIN / HARI</span>
                        <span class="text-[#1F5A34] text-xl font-extrabold">{{ $category->level_protein }}</span>
                    </div>
                    <div class="flex-1 px-4 w-full">
                        <span class="text-xs text-gray-500 font-bold tracking-wider uppercase block mb-1">BOX</span>
                        <span class="text-[#1F5A34] text-xl font-extrabold" id="display-box">Loading...</span>
                    </div>
                </div>
            </div>

            {{-- FASILITAS & INFO PENGIRIMAN --}}
            <div class="bg-white rounded-3xl shadow-sm p-8">
                <h2 class="text-[#1F5A34] text-xl font-bold mb-6">Fasilitas Paket</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                    <div class="flex items-center gap-4 p-4 border border-gray-100 rounded-xl bg-gray-50">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center text-[#1F5A34]">
                            <i class="fas fa-motorcycle text-lg"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-sm">Gratis Ongkir</h4>
                            <p class="text-xs text-gray-500">Area Denpasar & Badung</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 p-4 border border-gray-100 rounded-xl bg-gray-50">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center text-[#1F5A34]">
                            <i class="fas fa-headset text-lg"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-sm">Konsultasi Admin</h4>
                            <p class="text-xs text-gray-500">Bantuan memantau progres</p>
                        </div>
                    </div>
                </div>

                <div class="border-t-2 border-dashed border-gray-100 my-6"></div>

                <h2 class="text-[#1F5A34] text-xl font-bold mb-4">Info Pengiriman</h2>
                <div class="space-y-3">
                    <div class="flex items-center gap-3 text-gray-600">
                        <i class="far fa-clock text-green-600"></i>
                        <span class="text-sm"><strong class="text-gray-800">Makan Siang:</strong> 10.00 - 12.00 WITA</span>
                    </div>
                    <div class="flex items-center gap-3 text-gray-600">
                        <i class="far fa-clock text-green-600"></i>
                        <span class="text-sm"><strong class="text-gray-800">Makan Malam:</strong> 16.00 - 18.00 WITA</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- SIDEBAR KANAN --}}
        <div class="lg:col-span-1">
            <div class="bg-white rounded-3xl shadow-lg p-6 sticky top-24 border border-gray-100">
                <div class="mb-5 pb-5 border-b border-gray-100">
                    <p class="text-xs text-gray-400 mb-1">Pemesanan atas nama:</p>
                    <h3 class="font-bold text-gray-800 text-lg truncate">
                        {{ Auth::check() ? Auth::user()->name : 'Guest (Tamu)' }}
                    </h3>
                </div>

                <p class="text-sm font-bold text-gray-700 mb-3">Pilih Durasi Langganan:</p>
                <div class="grid grid-cols-3 gap-2 mb-6">
                    @foreach($category->options as $option)
                        <button 
                            onclick="pilihPaket(this)"
                            data-durasi="{{ $option->durasi_hari }}"
                            data-harga="{{ $option->harga }}"
                            data-id="{{ $option->id }}"
                            class="paket-btn border border-gray-200 rounded-xl py-2 px-1 text-sm font-bold text-gray-500 hover:border-[#1F5A34] hover:text-[#1F5A34] transition bg-white">
                            {{ $option->durasi_hari }} Hari
                        </button>
                    @endforeach
                </div>

                <div class="mb-6">
                    <p class="text-gray-400 text-xs mb-1">Total Harga Paket</p>
                    <div class="flex items-end gap-2">
                        <span class="text-3xl font-extrabold text-[#1F5A34]" id="display-harga">Rp 0</span>
                    </div>
                </div>

                <form action="{{ route('paket.checkout') }}" method="POST" class="mb-4">
                    @csrf
                    <input type="hidden" name="paket_option_id" id="input-paket-id">
                    <button type="submit" class="w-full bg-yellow-400 hover:bg-yellow-600 text-black font-bold py-3.5 rounded-full shadow-md transition transform hover:-translate-y-0.5 flex justify-center items-center gap-2">
                        Pesan Sekarang <i class="fas fa-chevron-right text-xs"></i>
                    </button>
                </form>

                <div onclick="toggleModal('konsulModal')" class="cursor-pointer border border-gray-200 rounded-xl p-3 flex items-center gap-3 hover:bg-gray-50 transition group">
                    <div class="w-10 h-10 bg-blue-50 rounded-full flex items-center justify-center text-blue-600 group-hover:bg-blue-100 transition">
                        <i class="fas fa-user-md text-lg"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-xs text-gray-500">Masih bingung?</p>
                        <p class="text-sm font-bold text-blue-600">Tanya Admin</p>
                    </div>
                    <i class="fas fa-chevron-right text-gray-300"></i>
                </div>
            </div>
        </div>
    </main>

    {{-- MODAL KONSULTASI --}}
    <div id="konsulModal" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm transition-opacity" onclick="toggleModal('konsulModal')"></div>
        <div class="relative bg-white w-full max-w-md mx-auto mt-24 md:mt-32 rounded-3xl shadow-2xl p-6 md:p-8 m-4 animate-fade-in-up">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-gray-900">Konsultasi Gratis</h3>
                <button onclick="toggleModal('konsulModal')" class="text-gray-400 hover:text-red-500"><i class="fas fa-times text-xl"></i></button>
            </div>
            <form>
                <div class="space-y-4">
                    <div class="bg-blue-50 p-3 rounded-lg text-xs text-blue-700 mb-2">
                        Silakan isi data diri, tim Ahli Gizi kami akan menghubungi via WhatsApp.
                    </div>
                    <input type="text" value="{{ Auth::check() ? Auth::user()->name : '' }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:border-green-500 text-sm" placeholder="Nama Lengkap">
                    <input type="text" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:border-green-500 text-sm" placeholder="No WhatsApp (Contoh: 0812...)">
                    <textarea rows="3" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:border-green-500 text-sm" placeholder="Ceritakan target atau keluhanmu..."></textarea>
                    <button type="button" onclick="alert('Permintaan konsultasi terkirim!')" class="w-full bg-[#1F5A34] text-white font-bold py-3 rounded-xl hover:bg-[#164226] transition shadow-lg">Kirim Data</button>
                </div>
            </form>
        </div>
    </div>

    {{-- SCRIPT JAVASCRIPT --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const firstBtn = document.querySelector('.paket-btn');
            if(firstBtn) pilihPaket(firstBtn);
        });

        function pilihPaket(element) {
            document.querySelectorAll('.paket-btn').forEach(btn => {
                btn.classList.remove('border-[#1F5A34]', 'bg-[#F4FDF6]', 'text-[#1F5A34]');
                btn.classList.add('border-gray-200', 'text-gray-500', 'bg-white');
            });
            element.classList.remove('border-gray-200', 'text-gray-500', 'bg-white');
            element.classList.add('border-[#1F5A34]', 'bg-[#F4FDF6]', 'text-[#1F5A34]');

            const durasi = parseInt(element.getAttribute('data-durasi'));
            const harga = parseInt(element.getAttribute('data-harga'));
            const totalBox = durasi * 2;

            document.getElementById('display-box').innerText = totalBox + " Box";
            document.getElementById('input-paket-id').value = element.getAttribute('data-id');
            const formatter = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 });
            document.getElementById('display-harga').innerText = formatter.format(harga);
        }

        function toggleModal(id){
            document.getElementById(id).classList.toggle("hidden");
            document.body.classList.toggle("overflow-hidden");
        }
    </script>
</body>
</html>