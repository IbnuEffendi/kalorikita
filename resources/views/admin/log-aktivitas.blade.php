<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Log Aktivitas | Admin KaloriKita</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body class="bg-gray-200 font-sans">

    <x-sidebar-admin />

    <main class="ml-64 w-full p-10">

        <section class="bg-white p-6 rounded-xl shadow">
            <h2 class="text-2xl font-bold text-green-800 mb-4">Log Aktivitas</h2>

            <table class="w-full border-collapse text-left">
                <thead>
                    <tr class="bg-gray-200 text-sm">
                        <th class="p-3">Waktu</th>
                        <th class="p-3">Admin</th>
                        <th class="p-3">Aksi</th>
                        <th class="p-3">Detail</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    <tr class="border-b">
                        <td class="p-3">21 Oktober 2025, 14:22</td>
                        <td class="p-3">Maria Pertiwi</td>
                        <td class="p-3">Mengubah harga paket</td>
                        <td class="p-3">Salad, Smoothies</td>
                    </tr>
                </tbody>
            </table>
        </section>

    </main>

</body>
</html>