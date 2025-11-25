<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Lupa Kata Sandi - KaloriKita</title>
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    input:focus {
      outline: none;
      box-shadow: 0 0 0 3px rgba(255, 223, 0, 0.4);
    }
  </style>
</head>

<body class="bg-green-900 flex justify-center items-center min-h-screen font-sans">

  <!-- CONTAINER -->
  <div class="bg-white rounded-2xl shadow-lg flex overflow-hidden w-[950px] max-w-full min-h-[600px]">

    <!-- ================================================= -->
    <!-- BAGIAN KIRI – DIPERPANJANG & DISESUAIKAN LOGIN -->
    <!-- ================================================= -->
    <div class="w-1/2 bg-green-800 text-white flex flex-col justify-center px-10 py-24 relative">

      <div class="absolute top-8 left-8 bg-green-700 text-white text-sm px-3 py-1 rounded-full">
        🌱 Platform Gaya Hidup Sehat
      </div>

      <div class="mt-10">
        <h1 class="text-4xl font-bold leading-tight">
          Lacak Kalori & <br />Atur Pola Makanmu
        </h1>

        <p class="text-sm mt-6 text-gray-200 leading-relaxed">
          Transparansi Nutrisi, Menu Sehat, Dan Tracker <br/>
          Harian Dalam Satu Tempat. Cocok Untuk Diet, <br/>
          Bulking, Dan Hidup Seimbang.
        </p>

        <ul class="mt-8 space-y-3 text-sm">
          <li class="flex items-start gap-2">✅ <span>Catat Makan Kurang Dari 10 Detik</span></li>
          <li class="flex items-start gap-2">✅ <span>Rekomendasi Porsi Sesuai Target</span></li>
          <li class="flex items-start gap-2">✅ <span>Progress Harian & Mingguan Yang Jelas</span></li>
        </ul>
      </div>

    </div>



    <!-- ===================================== -->
    <!-- BAGIAN KANAN – OTP / Reset Password -->
    <!-- ===================================== -->
    <div class="w-1/2 bg-white px-10 py-24 flex flex-col justify-center">

      <!-- STEP 1 — LUPA KATA SANDI -->
      <div id="step-forgot">
        <h2 class="text-3xl font-semibold mb-4">Lupa Kata Sandi</h2>
        <p class="text-sm text-gray-600 mb-8">
          Masukkan email terdaftar dan kami akan mengirimkan kode untuk reset kata sandimu.
        </p>

        <form onsubmit="return false" class="space-y-7">

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input
              id="emailForgot"
              type="email"
              placeholder="Email kamu"
              class="w-full border border-gray-300 rounded-md px-3 py-2"
            />
          </div>

          <button onclick="goOTP()" class="w-full bg-yellow-400 hover:bg-yellow-500 text-black font-semibold py-3 rounded-xl transition">
            Kirim Kode Reset
          </button>

          <p class="text-sm text-gray-800 font-semibold mt-4 cursor-pointer text-center"
             onclick="goLogin()">
            Kembali ke Masuk
          </p>
        </form>
      </div>



      <!-- STEP 2 — OTP VERIFIKASI -->
      <div id="step-otp" class="hidden">
        <h2 class="text-3xl font-semibold mb-4">Verifikasi Email</h2>

        <p class="text-sm text-gray-600 mb-8">
          Kami mengirim 6 digit kode ke email:
          <span id="showEmail" class="font-semibold text-gray-800"></span>
        </p>

        <div class="flex gap-3 mb-8">
          <input maxlength="1" class="otp border rounded-md w-12 h-12 text-center" />
          <input maxlength="1" class="otp border rounded-md w-12 h-12 text-center" />
          <input maxlength="1" class="otp border rounded-md w-12 h-12 text-center" />
          <input maxlength="1" class="otp border rounded-md w-12 h-12 text-center" />
          <input maxlength="1" class="otp border rounded-md w-12 h-12 text-center" />
          <input maxlength="1" class="otp border rounded-md w-12 h-12 text-center" />
        </div>

        <button onclick="goReset()" class="w-full bg-yellow-400 hover:bg-yellow-500 text-black font-semibold py-3 rounded-xl transition">
          Verifikasi
        </button>

        <p class="text-sm text-gray-600 mt-4 cursor-pointer text-center">Kirim ulang kode</p>
      </div>



      <!-- STEP 3 — RESET PASSWORD -->
      <div id="step-reset" class="hidden">
        <h2 class="text-3xl font-semibold mb-4">Buat Kata Sandi Baru</h2>

        <form onsubmit="return false" class="space-y-7">

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Kata Sandi Baru</label>
            <input id="pw1" type="password" placeholder="Minimal 8 karakter" class="w-full border border-gray-300 rounded-md px-3 py-2" />
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Kata Sandi</label>
            <input id="pw2" type="password" placeholder="Ulangi kata sandi" class="w-full border border-gray-300 rounded-md px-3 py-2" />
          </div>

          <button onclick="savePw()" class="w-full bg-yellow-400 hover:bg-yellow-500 text-black font-semibold py-3 rounded-xl transition">
            Simpan Kata Sandi
          </button>

          <p id="successReset" class="hidden text-green-700 font-semibold text-center mt-4">
            Kata sandi berhasil diubah! Silakan masuk.
          </p>
        </form>
      </div>

    </div>
  </div>



  <!-- SCRIPT -->
  <script>
    const step1 = document.getElementById("step-forgot");
    const step2 = document.getElementById("step-otp");
    const step3 = document.getElementById("step-reset");

    function goOTP() {
      const email = document.getElementById("emailForgot").value;
      if (!email) return alert("Masukkan email dulu");

      document.getElementById("showEmail").innerText = email;

      step1.classList.add("hidden");
      step2.classList.remove("hidden");

      document.querySelector(".otp").focus();
    }

    function goReset() {
      step2.classList.add("hidden");
      step3.classList.remove("hidden");
    }

    function savePw() {
      const p1 = document.getElementById("pw1").value;
      const p2 = document.getElementById("pw2").value;

      if (p1.length < 8) return alert("Minimal 8 karakter!");
      if (p1 !== p2) return alert("Konfirmasi tidak cocok!");

      document.getElementById("successReset").classList.remove("hidden");

      setTimeout(() => {
        goLogin();
      }, 1500);
    }

    function goLogin() {
      window.location.href = "{{ route('login') }}";
    }
  </script>

</body>
</html>