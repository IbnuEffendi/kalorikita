<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Lab Kalori | KaloriKita</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            plugins: [
                function({
                    addUtilities
                }) {
                    addUtilities({
                        '.line-clamp-3': {
                            display: '-webkit-box',
                            '-webkit-box-orient': 'vertical',
                            '-webkit-line-clamp': '3',
                            overflow: 'hidden',
                        }
                    });
                }
            ]
        };
    </script>

</head>

<body class="min-h-screen bg-white text-slate-900">
    <!-- NAVBAR -->
    <x-navbar></x-navbar>

    <!-- ISI HALAMAN LAB KALORI -->
    <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 bg-green-700/90">
        <!-- Bagian 1: Hero / Judul Halaman -->
        <x-hitung-lab></x-hitung-lab>
    </main>

    <!-- FOOTER -->
    <x-footer></x-footer>
</body>

</html>
