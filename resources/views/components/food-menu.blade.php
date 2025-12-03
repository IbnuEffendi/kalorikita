<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Menu Kami | KaloriKita</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <style>
        .card-img {
            margin-top: -70px;
        }
    </style>
</head>

<body class="bg-[#F7F7F7] text-gray-800">

    <x-navbar></x-navbar>

    <section class="relative bg-green-900 overflow-hidden pb-20">
        <div class="max-w-6xl mx-auto px-6 py-16 relative z-10">
            
            <div class="text-center mb-20">
                <h2 class="text-3xl font-bold text-white mb-2">Menu Kami</h2>
                <div class="w-20 h-[3px] bg-[#FBBF24] mx-auto rounded"></div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-16 justify-items-center">

                @foreach ($menus as $m)
                <div class="bg-white rounded-3xl shadow-lg p-6 text-center relative w-full max-w-sm hover:shadow-xl hover:scale-[1.03] transition duration-300">

                    <!-- Gambar diperbesar -->
                    <img src="{{ $m->gambar }}" 
                        alt="{{ $m->nama_menu }}"
                        class="w-52 h-52 object-cover mx-auto rounded-3xl shadow-lg card-img">

                    <h3 class="text-xl font-semibold text-[#155C2E] mt-8">
                        {{ $m->nama_menu }}
                    </h3>

                    <p class="text-sm text-gray-600 mt-2 line-clamp-2 px-3">
                        {{ $m->deskripsi }}
                    </p>

                    <div class="flex justify-center space-x-8 mt-6 text-green-700">

                        <div class="flex items-center space-x-1">
                            <i class="fas fa-fire text-[#F97316]"></i>
                            <span class="font-semibold text-sm">{{ $m->kalori }} kkal</span>
                        </div>

                        <div class="flex items-center space-x-1">
                            <i class="fas fa-dumbbell text-[#F97316]"></i>
                            <span class="font-semibold text-sm">{{ $m->protein }} gr</span>
                        </div>

                    </div>

                    <div class="flex justify-between items-center mt-6 px-4">
                        <div class="flex items-center bg-[#155C2E] text-white rounded-full px-3 py-1 text-sm space-x-1">
                            <i class="fas fa-star text-[#FBBF24]"></i>
                            <span>4.5</span>
                        </div>

                        <button class="text-[#E63946] text-xl hover:scale-110 transition">
                            <i class="fas fa-heart"></i>
                        </button>
                    </div>
                </div>
                @endforeach

            </div>

            <div class="mt-14 flex justify-center text-white">
                {{ $menus->links() }}
            </div>

        </div>
    </section>

</body>
</html>
