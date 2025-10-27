<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lab Kalori | KaloriKita</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    html {
      scroll-behavior: smooth;
    }

    /* Background pattern full */
    .full-bg {
      background-image: url('/asset/pattern.png'); /* Ganti dengan path gambar kamu */
      background-repeat: no-repeat;
      background-size: cover;
      background-position: center;
      opacity: 0.5;
    }
  </style>
</head>

<body class="bg-white text-slate-900">

  <!-- HERO SECTION LAB KALORI -->
  <section class="relative flex flex-col items-center text-center min-h-screen overflow-hidden pt-20">
    <!-- Background -->
    <div class="absolute inset-0 full-bg"></div>

    <!-- Konten -->
    <div class="relative z-10 flex flex-col items-center justify-start max-w-3xl px-6 space-y-4 mt-[-80px]">
      <!-- Judul -->
      <h1 class="text-4xl md:text-5xl font-extrabold text-slate-900">
        Lab Kalori
      </h1>
      <p class="text-base md:text-lg text-slate-700">
        Hitung Kebutuhan Kalori Harianmu
      </p>

      <!-- Gambar -->
      <img src="/asset/lab-ilu.png" alt="Ilustrasi Lab Kalori" class="max-w-xs md:max-w-sm w-full mt-2">

      <!-- Tombol -->
      <a href="#lab-section"
        class="mt-8 bg-yellow-400 hover:bg-yellow-500 text-black font-bold text-lg py-3 px-10 rounded-full transition duration-300 shadow-md">
        Hitung Sekarang!
      </a>
    </div>
  </section>

</body>
</html>