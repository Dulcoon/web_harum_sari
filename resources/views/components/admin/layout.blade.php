@props([
    'title' => 'Admin',
    'htmlClass' => 'dark',
    'contentClass' => 'space-y-8 px-8 py-8',
    'topbarPlaceholder' => 'Search analytics...',
    'topbarSearchAction' => null,
    'topbarSearchName' => 'q',
    'topbarSearchValue' => '',
    'adminName' => null,
    'adminRole' => 'Chief Curator',
    'showThemeToggle' => true,
])

<!DOCTYPE html>
<html class="{{ $htmlClass }}" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ $title }} | HOMELIVING</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    @livewireStyles

    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#d46211",
                        "primary-deep": "#994200",
                        "sand": "#9a6c4c",
                        "surface-soft": "rgba(255,255,255,0.72)",
                        "surface-dark": "rgba(255,255,255,0.04)",
                        "border-soft": "rgba(255,255,255,0.38)",
                        "border-dark": "rgba(255,255,255,0.08)",
                        "accent": "#d46211",
                    },
                    fontFamily: {
                        "display": ["Manrope", "sans-serif"],
                        "body": ["Inter", "sans-serif"],
                    }
                }
            }
        }
    </script>

    <style>
        :root {
            color-scheme: light;
        }

        html.dark {
            color-scheme: dark;
        }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
        }

        h1, h2, h3, h4 {
            font-family: 'Manrope', sans-serif;
        }

        .material-symbols-outlined {
            font-family: 'Material Symbols Outlined';
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            font-style: normal;
            line-height: 1;
            display: inline-block;
            vertical-align: middle;
        }

        html.dark body {
            background: radial-gradient(circle at top right, rgba(212, 98, 17, 0.12), transparent 38%),
                        radial-gradient(circle at bottom center, rgba(212, 98, 17, 0.08), transparent 52%),
                        #221810;
        }

        html:not(.dark) body {
            background: radial-gradient(circle at 10% 0%, #fffbf8 0%, #f9f4ed 45%, #f5eee5 100%);
        }

        .blob {
            position: fixed;
            z-index: -1;
            pointer-events: none;
            border-radius: 9999px;
            filter: blur(90px);
            opacity: 0.35;
        }

        .blob-1 {
            width: 520px;
            height: 520px;
            top: -140px;
            right: -130px;
            background: #f7e4d2;
        }

        .blob-2 {
            width: 420px;
            height: 420px;
            bottom: -80px;
            left: -120px;
            background: #fdf2e7;
        }

        html.dark .blob {
            opacity: 0.22;
        }

        html.dark .blob-1,
        html.dark .blob-2 {
            background: #d46211;
        }
    </style>

    {{ $head ?? '' }}
</head>
<body class="text-[#1b1c1b] antialiased font-body dark:text-white">
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>

    <x-admin.sidebar />

    <main class="ml-72 min-h-screen">
        <x-admin.topbar
            :placeholder="$topbarPlaceholder"
            :search-action="$topbarSearchAction"
            :search-name="$topbarSearchName"
            :search-value="$topbarSearchValue"
            :admin-name="$adminName"
            :admin-role="$adminRole"
            :show-theme-toggle="$showThemeToggle"
        />

        @if(session('success') || session('error') || session('warning') || session('info'))
            <div class="pointer-events-none fixed right-4 top-24 z-[110] w-[min(420px,calc(100vw-2rem))] space-y-3 lg:right-8">
                @if(session('success'))
                    <x-admin.flash-toast type="success" :message="session('success')" />
                @endif
                @if(session('error'))
                    <x-admin.flash-toast type="error" :message="session('error')" />
                @endif
                @if(session('warning'))
                    <x-admin.flash-toast type="warning" :message="session('warning')" />
                @endif
                @if(session('info'))
                    <x-admin.flash-toast type="info" :message="session('info')" />
                @endif
            </div>
        @endif

        <div class="{{ $contentClass }}">
            {{ $slot }}
        </div>
    </main>

    {{ $scripts ?? '' }}
    @livewireScripts
</body>
</html>
