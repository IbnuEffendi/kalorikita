<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Reset Kata Sandi - KaloriKita</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-green-900 flex justify-center items-center min-h-screen font-sans">

  <div class="bg-white rounded-2xl shadow-lg flex overflow-hidden w-[950px] max-w-full min-h-[600px]">

    <div class="w-1/2 bg-green-800 text-white flex flex-col justify-center px-10 py-24 relative">
      <div class="absolute top-8 left-8 bg-green-700 text-white text-sm px-3 py-1 rounded-full">
        🌱 Keamanan Akun
      </div>

      <div class="mt-10">
        <h1 class="text-4xl font-bold leading-tight">
          Mulai Lembaran <br />Baru
        </h1>

        <p class="text-sm mt-6 text-gray-200 leading-relaxed">
          Buat kata sandi baru yang kuat dan unik untuk <br>
          menjaga keamanan data kesehatanmu.
        </p>

        <ul class="mt-8 space-y-3 text-sm">
          <li class="flex items-start gap-2">✅ <span>Minimal 8 Karakter</span></li>
          <li class="flex items-start gap-2">✅ <span>Kombinasi Huruf & Angka</span></li>
          <li class="flex items-start gap-2">✅ <span>Rahasiakan dari Orang Lain</span></li>
        </ul>
      </div>
    </div>

    <div class="w-1/2 bg-white px-10 py-24 flex flex-col justify-center">

      @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif

      <h2 class="text-3xl font-semibold mb-2">Buat Kata Sandi Baru</h2>
      <p class="text-sm text-gray-600 mb-8">
        Silakan masukkan kata sandi baru kamu di bawah ini.
      </p>

      <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email }}">

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Kata Sandi Baru</label>
          <input 
            type="password" 
            name="password" 
            placeholder="Minimal 8 karakter" 
            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-yellow-400 outline-none transition"
            required 
            autofocus
          />
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Ulangi Kata Sandi</label>
          <input 
            type="password" 
            name="password_confirmation" 
            placeholder="Ketik ulang kata sandi baru" 
            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-yellow-400 outline-none transition"
            required 
          />
        </div>

        <button type="submit" class="w-full bg-yellow-400 hover:bg-yellow-500 text-black font-semibold py-3 rounded-xl transition shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
          Simpan Kata Sandi
        </button>
      </form>

    </div>
  </div>

</body>
</html>