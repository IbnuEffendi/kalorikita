<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Menu & Paket | Admin KaloriKita</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body class="bg-gray-200 font-sans">

    <x-sidebar-admin />

    <main class="ml-64 w-full p-10">

        <section class="bg-white p-6 rounded-xl shadow relative">
            <h2 class="text-2xl font-bold text-green-800 mb-4">Menu & Paket</h2>

            <div class="absolute top-4 right-4">
                <button class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow-md flex items-center gap-2">
                    <i class='bx bx-plus text-xl'></i> Tambah Paket Baru
                </button>
            </div>

            <table class="w-full border-collapse text-left mt-6">
                <thead>
                    <tr class="bg-gray-200 text-sm">
                        <th class="p-3">Nama Paket</th>
                        <th class="p-3">Kalori</th>
                        <th class="p-3">Harga</th>
                        <th class="p-3">Kategori</th>
                        <th class="p-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    <tr class="border-b">
                        <td class="p-3">Paket Pencoba</td>
                        <td class="p-3">1100 kkal</td>
                        <td class="p-3">Rp 150.000</td>
                        <td class="p-3">Diet</td>
                        <td class="p-3 flex gap-2">
                            <button class="px-2 py-1 bg-blue-500 text-white rounded">Edit</button>
                            <button class="px-2 py-1 bg-red-500 text-white rounded">Hapus</button>
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="p-3">Paket Maintain</td>
                        <td class="p-3">1300 kkal</td>
                        <td class="p-3">Rp 200.000</td>
                        <td class="p-3">Diet</td>
                        <td class="p-3 flex gap-2">
                            <button class="px-2 py-1 bg-blue-500 text-white rounded">Edit</button>
                            <button class="px-2 py-1 bg-red-500 text-white rounded">Hapus</button>
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="p-3">Paket Weightloss</td>
                        <td class="p-3">1000 kkal</td>
                        <td class="p-3">Rp 180.000</td>
                        <td class="p-3">Diet</td>
                        <td class="p-3 flex gap-2">
                            <button class="px-2 py-1 bg-blue-500 text-white rounded">Edit</button>
                            <button class="px-2 py-1 bg-red-500 text-white rounded">Hapus</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>

    </main>

</body>
</html>