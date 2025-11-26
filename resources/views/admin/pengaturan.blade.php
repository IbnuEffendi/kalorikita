<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pengaturan | Admin KaloriKita</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body class="bg-gray-200 font-sans">

    <x-sidebar-admin />

    <main class="ml-64 w-full p-10">

        <section class="bg-white p-6 rounded-xl shadow">
            <h2 class="text-2xl font-bold text-green-800 mb-4">Pengaturan</h2>

            <div class="space-y-6">

                <!-- Mode Gelap -->
                <div class="p-4 border rounded-xl bg-gray-50">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-semibold text-green-900">Mode Gelap</p>
                            <p class="text-sm text-gray-600 -mt-1">Ubah tampilan ke latar gelap</p>
                        </div>

                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-300 rounded-full peer peer-checked:bg-green-600 transition"></div>
                            <div class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full peer-checked:translate-x-5 transition"></div>
                        </label>
                    </div>
                </div>

                <!-- Notifikasi Email -->
                <div class="p-4 border rounded-xl bg-gray-50">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-semibold text-green-900">Notifikasi Email</p>
                            <p class="text-sm text-gray-600 -mt-1">Dapatkan ringkasan harian dan transaksi</p>
                        </div>

                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-300 rounded-full peer peer-checked:bg-green-600 transition"></div>
                            <div class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full peer-checked:translate-x-5 transition"></div>
                        </label>
                    </div>
                </div>

                <!-- Autentikasi Dua Langkah -->
                <div class="p-4 border rounded-xl bg-gray-50">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-semibold text-green-900">Autentikasi Dua Langkah</p>
                            <p class="text-sm text-gray-600 -mt-1">Tambahkan lapisan keamanan tambahan</p>
                        </div>

                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-300 rounded-full peer peer-checked:bg-green-600 transition"></div>
                            <div class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full peer-checked:translate-x-5 transition"></div>
                        </label>
                    </div>
                </div>

                <!-- Bahasa -->
                <div class="p-4 border rounded-xl bg-gray-50">
                    <p class="font-semibold text-green-900">Bahasa</p>
                    <p class="text-sm text-gray-600 -mt-1 mb-2">Pilih bahasa antarmuka</p>

                    <select class="px-3 py-2 bg-green-600 text-white rounded-lg shadow">
                        <option>Indonesia</option>
                        <option>English</option>
                    </select>
                </div>

                <!-- Tombol -->
                <div class="flex items-center gap-4 pt-4">
                    <button class="px-4 py-2 bg-yellow-400 text-black font-semibold rounded-lg shadow">Simpan Perubahan</button>
                    <button class="px-4 py-2 bg-gray-300 text-black font-semibold rounded-lg shadow">Reset</button>
                </div>

            </div>
        </section>

    </main>

</body>
</html>