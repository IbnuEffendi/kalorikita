<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Transaksi | Admin KaloriKita</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body class="bg-gray-200 font-sans">

    <x-sidebar-admin />

    <main class="ml-64 w-full p-10">

        <section class="bg-white p-6 rounded-xl shadow">
            <h2 class="text-2xl font-bold text-green-800 mb-4">Transaksi</h2>

            <div class="flex items-center gap-4 mb-4">
                <select class="px-3 py-2 bg-green-600 text-white rounded-lg shadow">
                    <option>Semua Status</option>
                    <option>Menunggu</option>
                    <option>Diproses</option>
                    <option>Selesai</option>
                    <option>Dibatalkan</option>
                </select>

                <input type="date" class="px-3 py-2 bg-green-600 text-white rounded-lg shadow">
            </div>

            <table class="w-full border-collapse text-left">
                <thead>
                    <tr class="bg-gray-200 text-sm">
                        <th class="p-3">ID</th>
                        <th class="p-3">Pengguna</th>
                        <th class="p-3">Total</th>
                        <th class="p-3">Status</th>
                        <th class="p-3">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    <tr class="border-b">
                        <td class="p-3">#001</td>
                        <td class="p-3">Alex</td>
                        <td class="p-3">Rp 200.000</td>
                        <td class="p-3">Menunggu</td>
                        <td class="p-3">21/10/2025</td>
                    </tr>
                </tbody>
            </table>
        </section>

    </main>

</body>
</html>