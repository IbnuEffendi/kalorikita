<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pesanan Berhasil | Kalori Kita</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <style>
        body { font-family: 'Instrument Sans', sans-serif; }
    </style>
</head>

<body class="bg-green-700 font-sans relative min-h-screen flex flex-col">

    {{-- NAVBAR --}}
    <x-navbar></x-navbar>

    <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none z-0">
        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-green-500/30 rounded-full blur-3xl mix-blend-screen animate-pulse"></div>
        <div class="absolute bottom-1/4 right-1/4 w-72 h-72 bg-yellow-500/20 rounded-full blur-3xl mix-blend-screen"></div>
    </div>

    <main class="flex-grow flex items-center justify-center px-4 py-16 relative z-10">
        
        <div class="bg-green-800/40 backdrop-blur-md rounded-3xl shadow-2xl text-center p-8 sm:p-12 max-w-lg w-full border border-green-600/30 relative overflow-hidden">
            
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-green-400/50 to-transparent"></div>

            @if (session('success'))
                <div class="mb-6 bg-emerald-500/20 border border-emerald-500/40 text-emerald-100 px-4 py-3 rounded-xl font-medium text-sm">
                    <i class="bi bi-check-circle mr-2"></i> {{ session('success') }}
                </div>
            @endif

            <div class="w-24 h-24 rounded-full bg-gradient-to-b from-green-500 to-green-700 flex items-center justify-center mx-auto mb-8 shadow-lg ring-4 ring-green-500/30">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white drop-shadow-md" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
            </div>

            <h1 class="text-3xl font-bold text-white mb-3 tracking-tight">
                Pembayaran Berhasil!
            </h1>
            <p class="text-green-100/80 mb-10 text-sm leading-relaxed">
                Terima kasih telah berlangganan. Paket katering kamu akan segera kami siapkan sesuai jadwal.
            </p>

            <div class="flex flex-col sm:flex-row justify-center gap-4">
                
                <a href="{{ url('/') }}" class="group relative px-6 py-3 rounded-full border border-green-400/50 text-green-100 font-semibold text-sm hover:bg-green-700/50 transition-all">
                    Kembali ke Home
                </a>

                <a href="{{ route('profil.myorder') }}" class="px-8 py-3 rounded-full bg-yellow-400 hover:bg-yellow-300 text-green-900 font-bold text-sm shadow-lg shadow-yellow-500/20 transform hover:-translate-y-1 transition-all">
                    Lihat Pesanan Saya
                </a>

            </div>

        </div>
    </main>

    {{-- FOOTER --}}
    <x-footer></x-footer>

</body>
</html>