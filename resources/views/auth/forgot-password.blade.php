<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Lupa Kata Sandi - KaloriKita</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-green-900 flex justify-center items-center min-h-screen font-sans">

  <div class="bg-white rounded-2xl shadow-lg flex overflow-hidden w-[950px] max-w-full min-h-[600px]">

    <div class="w-1/2 bg-green-800 text-white flex flex-col justify-center px-10 py-24 relative">
      <div class="absolute top-8 left-8 bg-green-700 text-white text-sm px-3 py-1 rounded-full">
        🌱 Platform Gaya Hidup Sehat
      </div>

      <div class="mt-10">
        <h1 class="text-4xl font-bold leading-tight">
          Lacak Kalori & <br />Atur Pola Makanmu
        </h1>
        <p class="text-sm mt-6 text-gray-200 leading-relaxed">
          Kembalikan akses akunmu dengan mudah dan aman. <br>
          Kami akan mengirimkan tautan reset ke emailmu.
        </p>
      </div>
    </div>

    <div class="w-1/2 bg-white px-10 py-24 flex flex-col justify-center">

      @if (session('status'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6">
            <strong class="font-bold">Berhasil!</strong>
            <span class="block sm:inline">{{ session('status') }}</span>
        </div>
      @endif

      @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif

      <h2 class="text-3xl font-semibold mb-4">Lupa Kata Sandi</h2>
      <p class="text-sm text-gray-600 mb-8">
        Masukkan email terdaftar dan kami akan mengirimkan <strong>Link Reset</strong> ke emailmu.
      </p>

      <form method="POST" action="{{ route('password.email') }}" class="space-y-7">
        @csrf  <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
          <input 
            name="email" 
            type="email" 
            placeholder="Email kamu" 
            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-yellow-400 outline-none"
            value="{{ old('email') }}" 
            required
          />
        </div>

        <button type="submit" class="w-full bg-yellow-400 hover:bg-yellow-500 text-black font-semibold py-3 rounded-xl transition shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
          Kirim Link Reset
        </button>

        <a href="{{ route('login') }}" class="block text-sm text-gray-800 font-semibold mt-4 text-center hover:underline">
           Kembali ke Masuk
        </a>
      </form>
      
    </div>
  </div>

</body>
</html>