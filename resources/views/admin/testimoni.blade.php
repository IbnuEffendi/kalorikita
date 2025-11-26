<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Testimoni | Admin KaloriKita</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body class="bg-gray-200 font-sans">

    <x-sidebar-admin />

    <main class="ml-64 w-full p-10">

        <section class="bg-white p-6 rounded-xl shadow">
            <h2 class="text-2xl font-bold text-green-800 mb-4">Testimoni Pengguna</h2>

            <table class="w-full border-collapse text-left">
                <thead>
                    <tr class="bg-gray-200 text-sm">
                        <th class="p-3">Nama</th>
                        <th class="p-3">Pesan</th>
                        <th class="p-3">Rating</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    <tr class="border-b">
                        <td class="p-3">Alex Jelex</td>
                        <td class="p-3">Makanannya berkualitas, sangat bagus.</td>
                        <td class="p-3">5/5</td>
                    </tr>
                </tbody>
            </table>
        </section>

    </main>

</body>
</html>