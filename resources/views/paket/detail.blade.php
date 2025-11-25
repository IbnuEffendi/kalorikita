<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail {{ $paket['nama'] }} - KaloriKita</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style> body { font-family: 'Instrument Sans', sans-serif; } </style>
</head>

<body class="bg-gray-50 text-slate-900 pb-32">

    <nav class="fixed top-0 w-full z-50 px-6 py-4 flex justify-between items-center text-white bg-green-900/90 backdrop-blur-sm shadow-sm transition-all">
        <a href="/paket" class="flex items-center gap-2 hover:text-yellow-400 transition">
            <i class='bx bx-arrow-back text-2xl'></i>
            <span class="font-semibold">Kembali</span>
        </a>
    </nav>

    <div class="relative w-full h-[40vh] md:h-[50vh]">
        <img src="{{ $paket['gambar'] }}" 
             class="w-full h-full object-cover" alt="{{ $paket['nama'] }}">
        
        <div class="absolute inset-0 bg-gradient-to-t from-green-900 via-green-900/40 to-transparent"></div>
        
        <div class="absolute bottom-0 left-0 w-full p-6 md:p-10">
            <div class="container mx-auto max-w-4xl">
                <span class="bg-yellow-400 text-green-900 font-bold px-3 py-1 rounded-full text-xs uppercase tracking-wider mb-3 inline-block">
                    {{ $paket['tag'] }}
                </span>
                <h1 class="text-3xl md:text-5xl font-bold text-white mb-2">{{ $paket['nama'] }}</h1>
                <p class="text-gray-200 text-lg flex items-center gap-2">
                    <i class='bx bx-time-five'></i> Durasi 1 Minggu (Senin - Jumat)
                </p>
            </div>
        </div>
    </div>

    <div class="container mx-auto max-w-4xl px-6 -mt-6 relative z-10">
        
        <div class="bg-white rounded-3xl shadow-xl p-6 md:p-10 border border-gray-100">
            
            <div class="mb-10">
                <h2 class="text-xl font-bold text-green-900 mb-4">Tentang Paket Ini</h2>
                <p class="text-gray-600 leading-relaxed">
                    {{ $paket['deskripsi'] }}
                </p>
            </div>

            <div class="grid grid-cols-3 gap-4 bg-green-50 p-4 rounded-2xl border border-green-100 mb-10">
                <div class="text-center">
                    <p class="text-xs text-gray-500 uppercase tracking-wider">Kalori</p>
                    <p class="font-bold text-lg text-green-900">{{ $paket['kalori'] }}</p>
                </div>
                <div class="text-center border-l border-green-200">
                    <p class="text-xs text-gray-500 uppercase tracking-wider">Protein</p>
                    <p class="font-bold text-lg text-green-900">{{ $paket['protein'] }}</p>
                </div>
                <div class="text-center border-l border-green-200">
                    <p class="text-xs text-gray-500 uppercase tracking-wider">Box</p>
                    <p class="font-bold text-lg text-green-900">{{ $paket['box'] }}x Makan</p>
                </div>
            </div>

            <div class="mb-10">
                <h2 class="text-xl font-bold text-green-900 mb-6">Fasilitas Paket</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex items-start gap-4 p-4 rounded-2xl bg-white border border-gray-100 shadow-sm">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center text-green-800">
                            <i class='bx bx-cycling text-2xl'></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-green-900">Gratis Ongkir</h3>
                            <p class="text-sm text-gray-600">Area Denpasar & Badung.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4 p-4 rounded-2xl bg-white border border-gray-100 shadow-sm">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center text-green-800">
                            <i class='bx bx-support text-2xl'></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-green-900">Konsultasi Admin</h3>
                            <p class="text-sm text-gray-600">Bantuan memantau progres.</p>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="border-dashed border-gray-300 my-8">

            <div>
                <h2 class="text-xl font-bold text-green-900 mb-4">Info Pengiriman</h2>
                <ul class="space-y-3 text-gray-600 text-sm">
                    <li class="flex items-center gap-2">
                        <i class='bx bx-time text-green-600 text-lg'></i>
                        <span>Makan Siang: <strong>10.00 - 12.00</strong></span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class='bx bx-time text-green-600 text-lg'></i>
                        <span>Makan Malam: <strong>16.00 - 18.00</strong></span>
                    </li>
                </ul>
            </div>

        </div>
    </div>

    <div class="fixed bottom-0 w-full bg-white border-t border-gray-200 p-4 z-40 shadow-[0_-5px_20px_rgba(0,0,0,0.05)]">
        <div class="container mx-auto max-w-4xl flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-xs mb-1">Total Harga Paket</p>
                <div class="flex items-end gap-2">
                    <span class="text-2xl font-bold text-green-900">Rp {{ number_format($paket['harga'], 0, ',', '.') }}</span>
                    <span class="text-gray-400 text-sm line-through mb-1">Rp {{ number_format($paket['harga_coret'], 0, ',', '.') }}</span>
                </div>
            </div>
            
            <a href="{{ route('paket.checkout', ['plan' => request()->segment(2)]) }}"
               class="bg-yellow-400 hover:bg-yellow-500 text-green-900 font-bold py-3 px-8 rounded-full transition shadow-md flex items-center gap-2 active:scale-95">
                Pesan Sekarang
                <i class='bx bx-chevron-right text-xl'></i>
            </a>
        </div>
    </div>

</body>
</html>