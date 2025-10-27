<!-- Footer Section -->
<footer class="relative bg-[#1B1B1B] text-white py-12 bg-cover bg-no-repeat"
        style="background-image: url('/asset/footer-pattern.png');"> 
        <!-- ganti '/asset/footer-pattern.png' dengan path pattern kamu -->
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-8 items-start">
        
        <!-- Kolom 1: Logo dan alamat -->
        <div>
            <!-- Ganti src logo di bawah ini dengan path logo kamu -->
            <!-- contoh: <img src="{{ asset('images/logo.png') }}" alt="Kalori Kita" class="mb-4 w-32"> -->
            <img src="/asset/logo-nobg.png" alt="Kalori Kita" class="mb-4 w-32"> <!-- ganti dengan path logomu -->
            
            <p class="text-sm leading-relaxed text-gray-300">
                Jl. Udayana No. 9, Jimbaran, Kuta Selatan,<br>
                Badung, Bali, 80361
            </p>

            <!-- Sosial Media -->
            <div class="flex items-center space-x-4 mt-5">
                <a href="#" class="bg-[#3AB54A] p-2 rounded-full hover:scale-105 transition-transform">
                    <i class="fab fa-facebook-f text-white text-sm"></i>
                </a>
                <a href="#" class="bg-[#3AB54A] p-2 rounded-full hover:scale-105 transition-transform">
                    <i class="fab fa-twitter text-white text-sm"></i>
                </a>
                <a href="#" class="bg-[#3AB54A] p-2 rounded-full hover:scale-105 transition-transform">
                    <i class="fab fa-pinterest-p text-white text-sm"></i>
                </a>
                <a href="#" class="bg-[#3AB54A] p-2 rounded-full hover:scale-105 transition-transform">
                    <i class="fab fa-instagram text-white text-sm"></i>
                </a>
            </div>
        </div>

        <!-- Kolom 2: Tentang Kami -->
        <div class="mt-8 md:mt-0">
            <h3 class="font-semibold text-white mb-2 relative">
                Tentang Kami
                <span class="absolute left-0 bottom-0 w-6 h-[2px] bg-[#3AB54A] mt-1"></span>
            </h3>
        </div>

        <!-- Kolom 3: Bantuan -->
        <div class="mt-8 md:mt-0">
            <h3 class="font-semibold text-white mb-2 relative">
                Bantuan
                <span class="absolute left-0 bottom-0 w-6 h-[2px] bg-[#3AB54A] mt-1"></span>
            </h3>
        </div>

        <!-- Kolom 4: Kontak -->
        <div class="mt-8 md:mt-0">
            <h3 class="font-semibold text-white mb-2 relative">
                Kontak
                <span class="absolute left-0 bottom-0 w-6 h-[2px] bg-[#3AB54A] mt-1"></span>
            </h3>
            <div class="flex items-center mt-3 space-x-2">
                <i class="fas fa-phone-alt text-white"></i>
                <span class="text-sm text-gray-300">0866545435789</span>
            </div>
        </div>
    </div>
</footer>

<!-- Tambahkan Font Awesome untuk ikon -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>