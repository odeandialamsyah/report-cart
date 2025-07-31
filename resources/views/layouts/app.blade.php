<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="..." crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    @include('layouts.navigation')

    <!-- Page Heading -->
    @isset($header)
        <header class="flex bg-white shadow dark:bg-gray-800">
            <button id="toggleSidebar"
                class="mx-auto max-w-7xl flex-none px-4 py-6 text-xl text-gray-700 focus:outline-none sm:px-6 lg:px-8">
                <i class="fa fa-bars"></i>
            </button>
            <div class="mx-auto max-w-7xl flex-1 px-4 py-6 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endisset
    <div class="flex min-h-screen bg-gray-100 dark:bg-gray-900">

        @php $role = auth()->user()->role; @endphp

        <x-side-bar :role="$role" />

        <!-- Page Content -->
        <main class="flex-1 p-6 transition-all duration-300">
            {{ $slot }}
        </main>
    </div>
    
    <script>
        const toggleBtn = document.getElementById('toggleSidebar');
        const sidebar = document.getElementById('sidebar');
        toggleBtn?.addEventListener('click', () => {
            sidebar.classList.toggle('hidden');
        });
    </script>
</body>

</html>
