<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
        </style>
    @endif
</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">

    <div class="section min-h-screen flex flex-col justify-center">
        <div class="content">
            <h1 class="text-center text-3xl ">
                Selamat Datang!
            </h1>
            <div class="logo flex justify-center">
                <img src="{{ asset('img/ependuduk.png') }}" width="50%" alt="Logo">
            </div>
            <div class="flex justify-center">
                @if (Route::has('login'))
                    <nav class="-mx-3 ">
                        @auth
                            <a href="{{ url('/dashboard') }}"
                                class="">
                                <button type="button" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-full border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Dashboard</button>
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="">
                                <button type="button" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-full border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Login</button>
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="">
                                    <button type="button" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-full border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Register</button>
                                </a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </div>
        </div>
    </div>
</body>

</html>