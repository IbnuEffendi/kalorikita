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
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body class="min-h-screen bg-white text-slate-900">
    <!-- NAVBAR -->
    <x-navbar></x-navbar>
    <!-- Demo filler content -->
    <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 pt-12 pb-0">
        <x-hero></x-hero>
        <x-display-lab></x-display-lab>
        <x-weekly-menu :menu-mingguan="$menuMingguan" />
        <x-display-membership></x-display-membership>
        <x-review></x-review>
    </main>
    <x-footer></x-footer>
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
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
    <script>
        const menuSwiper = new Swiper('.menuSwiper', {
            loop: true,
            slidesPerView: 3,
            spaceBetween: 16,
            // responsive
            breakpoints: {
                0:{
                    slidesPerView: 1,
                },
                640: {
                    slidesPerView: 2,
                },
                768: {
                    slidesPerView: 3,
                },
                1024: {
                    slidesPerView: 4,
                },
            },
            autoplay: {
                delay: 3500,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: '.swiper-button-next-custom',
                prevEl: '.swiper-button-prev-custom',
            },
        });
    </script>

</body>

</html>
