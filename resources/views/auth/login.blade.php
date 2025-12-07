<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Masuk - KaloriKita</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-green-900 flex justify-center items-center min-h-screen font-sans">
    <div class="bg-white rounded-2xl shadow-lg flex overflow-hidden w-[900px] max-w-full">

        <!-- LEFT SIDE -->
        <div class="w-1/2 bg-green-800 text-white flex flex-col justify-center px-10 relative">
            <div class="absolute top-6 left-6 bg-green-700 text-white text-sm px-3 py-1 rounded-full">
                🌱 Platform Gaya Hidup Sehat
            </div>

            <div class="mt-16">
                <h1 class="text-4xl font-bold leading-tight">
                    Lacak Kalori & <br />Atur Pola Makanmu
                </h1>
                <p class="text-sm mt-4 text-gray-200 leading-relaxed">
                    Transparansi Nutrisi, Menu Sehat, Dan Tracker <br />
                    Harian Dalam Satu Tempat. Cocok Untuk Diet, <br />
                    Bulking, Dan Hidup Seimbang.
                </p>

                <ul class="mt-6 space-y-2 text-sm">
                    <li class="flex items-start gap-2">✅ <span>Catat Makan Kurang Dari 10 Detik</span></li>
                    <li class="flex items-start gap-2">✅ <span>Rekomendasi Porsi Sesuai Target</span></li>
                    <li class="flex items-start gap-2">✅ <span>Progress Harian & Mingguan Yang Jelas</span></li>
                </ul>
            </div>
        </div>

        <!-- RIGHT SIDE -->
        <div class="w-1/2 bg-white p-10 flex flex-col justify-center">
            <h2 class="text-2xl font-semibold mb-6">Masuk</h2>

            <form method="POST" action="{{ route('login.process') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" id="email" name="email" placeholder="Email"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400"
                        required />
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Kata Sandi</label>
                    <input type="password" id="password" name="password" placeholder="Kata Sandi"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400"
                        required />
                </div>

                @if ($errors->any())
                    <div class="mb-4 rounded-lg bg-red-100 text-red-700 px-4 py-2 text-sm">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <button type="submit"
                    class="w-full bg-yellow-400 hover:bg-yellow-500 text-black font-semibold py-3 rounded-xl transition">
                    Masuk
                </button>

                <a href="{{ route('password.request') }}"
                    class="text-left text-sm text-gray-800 font-semibold hover:underline">
                    <span class="block mt-2">Lupa Kata Sandi?</span>
                </a>

                <div class="flex items-center my-4">
                    <hr class="grow border-gray-200" />
                    <span class="px-2 text-sm text-gray-500">atau</span>
                    <hr class="grow border-gray-200" />
                </div>

                <!-- 🔥 Tombol Google yang BENAR -->
                <a href="{{ route('google.login') }}"
                    class="w-full border border-gray-300 rounded-xl py-3 flex items-center justify-center gap-3 text-gray-800 hover:bg-gray-50">
                    <img src="https://www.svgrepo.com/show/355037/google.svg" class="w-6 h-6">
                    <span class="font-semibold">Masuk dengan Google</span>
                </a>

                <p class="text-center text-sm mt-4 text-gray-600">
                    Belum punya akun? <a href="{{ route('register') }}" class="text-black font-medium">Daftar</a>
                </p>
            </form>
        </div>
    </div>
</body>

</html>
