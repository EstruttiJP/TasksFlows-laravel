<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="font-sans bg-gray-100 overflow-hidden h-screen">
    @include('layout.components.header')
    <div class="flex h-full pt-16">
        @include('layout.components.sidebar')
        <main class="flex-1 p-4 pt-14  overflow-auto transition-all">
            @yield('content')
        </main>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const dropdownButton = document.querySelector('.dropdown button');
            const dropdownMenu = document.querySelector('#dropdown');
            dropdownButton.addEventListener('click', function () {
                dropdownMenu.classList.toggle('hidden');
            });
            document.addEventListener('click', function (e) {
                if (!dropdownButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
                    dropdownMenu.classList.add('hidden');
                }
            });
        })

        const menuButton = document.getElementById('menu-button');
        const sidebar = document.getElementById('mobile-menu');
        const line1 = document.getElementById('line1');
        const line2 = document.getElementById('line2');
        const line3 = document.getElementById('line3');

        let menuOpen = false;

        menuButton.addEventListener('click', () => {
            menuOpen = !menuOpen;
            sidebar.classList.toggle('-translate-x-full');

            if (menuOpen) {
                line1.classList.add('rotate-45', 'translate-y-2');
                line2.classList.add('opacity-0');
                line3.classList.add('-rotate-45', '-translate-y-2');
            } else {
                line1.classList.remove('rotate-45', 'translate-y-2');
                line2.classList.remove('opacity-0');
                line3.classList.remove('-rotate-45', '-translate-y-2');
            }
        });
    </script>
</body>

</html>