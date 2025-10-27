<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>KaloriKita</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Optional: smooth hover transitions */
        .btn {
            @apply transition ease-out duration-200;
        }
    </style>
</head>

<body class="min-h-screen bg-white text-slate-900">
    <!-- NAVBAR -->
    <x-navbar></x-navbar>
    <!-- Demo filler content -->
    <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12">
        <x-hero></x-hero>
        <x-display-lab></x-display-lab>
        <x-weekly-menu></x-weekly-menu>
        <x-display-membership></x-display-membership>
        <x-review></x-review>
    </main>
    <x-footer></x-footer>

    <script>
        const btn = document.getElementById('menuBtn');
        const menu = document.getElementById('mobileMenu');
        const icon = document.getElementById('menuIcon');
        btn?.addEventListener('click', () => {
            menu.classList.toggle('hidden');
            // toggle icon hamburger <-> X
            const isOpen = !menu.classList.contains('hidden');
            icon.innerHTML = isOpen ?
                '<path d="M6 6l12 12M6 18L18 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>' :
                '<path d="M4 6h16v2H4zm0 5h16v2H4zm0 5h16v2H4z"/>';
            btn.setAttribute('aria-expanded', String(isOpen));
        });
    </script>
</body>

</html>
