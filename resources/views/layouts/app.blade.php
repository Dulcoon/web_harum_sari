<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="w-full overflow-x-hidden ">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

  <!-- Scripts -->
  @vite(['resources/js/chart.js'])
  @vite(['resources/js/wilayah.js'])
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script>
</head>

<body class="font-sans antialiased">
  <div class="bg-gray-100 dark:bg-gray-900 h-full">
    @include('layouts.navigation')

    <!-- Page Heading -->
<!-- Page Heading -->
@isset($header)
<header class="w-full bg-white dark:bg-gray-900  p-4 pt-24 sm:ml-64">
  <div class="max-w-7xl py-3 px-4 sm:px-6 lg:px-8">
    <!-- Breadcrumb -->
    <nav class="flex" aria-label="Breadcrumb">
      <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
        <li class="inline-flex items-center">
          <a href="{{route('penduduk.index')}}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
            <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
              <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
            </svg>
            Home
          </a>
        </li>
        
        <li aria-current="page">
          <div class="flex items-center">
            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
            </svg>
            <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">{{ $header }}</span>
          </div>
        </li>
      </ol>
    </nav>
    <!-- End Breadcrumb -->

    <!-- Page Content -->
    
  </div>
</header>
@endisset


    <!-- Page Content -->
    <main class="lg:ml-60 h-full">
      {{ $slot }}
    </main>
  </div>
  <script>
    // Select the toggle button and icons
    const themeToggle = document.getElementById('theme-toggle');
    const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
    const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');

    // Check the user's current theme
    const currentTheme = localStorage.getItem('theme') || 'light';

    // Apply the theme on load
    if (currentTheme === 'dark') {
        document.documentElement.classList.add('dark');
        themeToggleDarkIcon.classList.remove('hidden');
    } else {
        document.documentElement.classList.remove('dark');
        themeToggleLightIcon.classList.remove('hidden');
    }

    // Toggle theme on button click
    themeToggle.addEventListener('click', () => {
        themeToggleLightIcon.classList.toggle('hidden');
        themeToggleDarkIcon.classList.toggle('hidden');

        if (document.documentElement.classList.contains('dark')) {
        document.documentElement.classList.remove('dark');
        localStorage.setItem('theme', 'light');
        } else {
        document.documentElement.classList.add('dark');
        localStorage.setItem('theme', 'dark');
        }
    });
  </script>

</body>

</html>