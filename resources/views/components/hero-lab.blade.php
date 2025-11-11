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
      background-repeat: repeat;
      background-size: cover;
      background-position: top center;
      opacity: 1;
    }
  </style>
</head>

<body class="bg-white text-slate-900">

  <!-- HERO SECTION LAB KALORI -->
  <section class="relative min-h-screen flex items-center overflow-hidden full-bg">

    <!-- Konten -->
    <div class="relative z-10 container mx-auto px-4 md:px-10 grid md:grid-cols-2 gap-2 md:gap-4 items-center -mt-10 md:-mt-20">
    
      <!-- Bagian Teks -->
      <div class="text-left space-y-4 md:ml-20 lg:ml-24">
        <h1 class="text-4xl md:text-5xl font-extrabold text-slate-900 leading-tight">
          Lab Kalori
        </h1>
        <p class="text-base md:text-lg text-slate-700">
          Hitung Kebutuhan Kalori Harianmu
        </p>

        <a href="#lab-section"
          class="inline-block bg-yellow-400 hover:bg-yellow-500 text-black font-bold text-lg py-3 px-10 rounded-full transition duration-300 shadow-lg mt-6 md:mt-8">
          Hitung Sekarang!
        </a>
      </div>

      <!-- Bagian Gambar -->
      <div class="flex justify-center md:justify-start">
        <img src="/asset/lab-ilu2.png" 
             alt="Ilustrasi Lab Kalori" 
             class="w-[300px] sm:w-[380px] md:w-[480px] lg:w-[520px] drop-shadow-md md:-ml-10 lg:-ml-16">
      </div>

  </div>
</section>
</body>
</html>