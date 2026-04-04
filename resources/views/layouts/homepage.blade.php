<!DOCTYPE html>
<html class="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'HOMELIVING')</title>

    <script>
        (function () {
            const root = document.documentElement;
            const key = 'homeliving-theme';
            try {
                const saved = localStorage.getItem(key);
                if (saved === 'dark' || saved === 'light') {
                    root.classList.remove('dark', 'light');
                    root.classList.add(saved);
                    return;
                }
            } catch (e) {}
            root.classList.add('dark');
        })();
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;900&amp;display=swap" rel="stylesheet"/>

    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#d46211",
                        "primary-dark": "#b0510e",
                        "background-light": "#f3efeb",
                        "background-dark": "#1a0f0a",
                    },
                    backgroundImage: {
                        'premium-gradient': 'linear-gradient(135deg, #e67e22 0%, #d46211 100%)',
                    },
                    fontFamily: {
                        "display": ["Manrope", "sans-serif"],
                        "body": ["Inter", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.75rem",
                        "lg": "1.25rem",
                        "xl": "1.75rem",
                        "2xl": "2.25rem",
                        "full": "9999px"
                    },
                    boxShadow: {
                        'warm': '0 20px 40px -15px rgba(212, 98, 17, 0.3)',
                    }
                },
            },
        }
    </script>

    <style>
        .material-symbols-outlined {
            font-family: "Material Symbols Outlined";
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            font-style: normal;
            line-height: 1;
            display: inline-block;
        }

        body {
            font-family: "Manrope", sans-serif;
            min-height: 100vh;
        }

        html.dark body {
            background: #1a0f0a;
            color: #fff;
        }

        html.light body {
            background: #f3efeb;
            color: #1b1c1b;
        }

        .glass-morphism {
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
        }

        html.dark .glass-morphism {
            background: rgba(40, 25, 15, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        html.light .glass-morphism {
            background: rgba(255, 255, 255, 0.72);
            border: 1px solid rgba(229, 215, 202, 0.6);
            box-shadow: 0 16px 40px rgba(132, 74, 22, 0.08);
        }

        .product-glass-card {
            backdrop-filter: blur(22px);
            -webkit-backdrop-filter: blur(22px);
            transition: border-color 0.3s ease, box-shadow 0.3s ease, transform 0.3s ease;
        }

        html.dark .product-glass-card {
            background: linear-gradient(145deg, rgba(47, 28, 18, 0.8) 0%, rgba(33, 20, 14, 0.86) 100%);
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 16px 30px -20px rgba(212, 98, 17, 0.35), inset 0 1px 0 rgba(255, 255, 255, 0.08);
        }

        html.dark .product-glass-card:hover {
            border-color: rgba(212, 98, 17, 0.4);
            box-shadow: 0 20px 34px -18px rgba(212, 98, 17, 0.45), inset 0 1px 0 rgba(255, 255, 255, 0.12);
        }

        html.light .product-glass-card {
            background: rgba(255, 255, 255, 0.76);
            border: 1px solid rgba(229, 215, 202, 0.6);
            box-shadow: 0 14px 28px -20px rgba(150, 90, 36, 0.24), inset 0 1px 0 rgba(255, 255, 255, 0.85);
        }

        html.light .product-glass-card:hover {
            border-color: rgba(212, 98, 17, 0.25);
            box-shadow: 0 18px 34px -18px rgba(150, 90, 36, 0.3), inset 0 1px 0 rgba(255, 255, 255, 0.92);
        }

        .product-media-shell {
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        html.dark .product-media-shell {
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        html.light .product-media-shell {
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(229, 215, 202, 0.62);
        }

        .premium-text-gradient {
            background: linear-gradient(135deg, #f39c12 0%, #d46211 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        input[type="range"].price-range-input {
            width: 100%;
            height: 18px;
            cursor: pointer;
            -webkit-appearance: none;
            appearance: none;
            -moz-appearance: none;
            background: transparent !important;
            accent-color: #d46211 !important;
            color: #d46211 !important;
            --range-progress: 0%;
            --range-track-empty: rgba(255, 255, 255, 0.16);
        }

        html.light input[type="range"].price-range-input {
            --range-track-empty: rgba(0, 0, 0, 0.16);
        }

        input[type="range"].price-range-input:focus {
            outline: none;
        }

        input[type="range"].price-range-input::-webkit-slider-runnable-track {
            -webkit-appearance: none;
            height: 6px;
            border-radius: 9999px;
            background: linear-gradient(
                to right,
                #d46211 0%,
                #d46211 var(--range-progress),
                var(--range-track-empty) var(--range-progress),
                var(--range-track-empty) 100%
            ) !important;
            border: 0;
            box-shadow: none;
        }

        input[type="range"].price-range-input::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 20px;
            height: 20px;
            margin-top: -7px;
            border-radius: 9999px;
            border: 2px solid #1a0f0a;
            background: linear-gradient(135deg, #e67e22 0%, #d46211 100%) !important;
            box-shadow: 0 2px 6px rgba(212, 98, 17, 0.5);
            cursor: pointer;
        }

        html.light input[type="range"].price-range-input::-webkit-slider-thumb {
            border-color: #ffffff;
        }

        input[type="range"].price-range-input::-moz-range-track {
            height: 6px;
            border-radius: 9999px;
            background: transparent !important;
            border: 0;
            box-shadow: none;
        }

        input[type="range"].price-range-input::-moz-range-progress {
            height: 6px;
            border-radius: 9999px;
            background: #d46211 !important;
            border: 0;
        }

        input[type="range"].price-range-input::-moz-range-thumb {
            width: 20px;
            height: 20px;
            border: 2px solid #1a0f0a;
            border-radius: 9999px;
            background: linear-gradient(135deg, #e67e22 0%, #d46211 100%) !important;
            box-shadow: 0 2px 6px rgba(212, 98, 17, 0.5);
            cursor: pointer;
        }

        html.light input[type="range"].price-range-input::-moz-range-thumb {
            border-color: #ffffff;
        }

        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .dark-select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
        }

        html.dark .dark-select {
            background-color: rgba(255, 255, 255, 0.08);
            color: #fff;
            border-color: rgba(255, 255, 255, 0.16);
        }

        html.dark .dark-select option {
            background-color: #2a1d14;
            color: #fff;
        }

        html.light .dark-select option {
            background-color: #ffffff;
            color: #1b1c1b;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>

    @yield('head')
    @livewireStyles
</head>
<body class="font-display transition-colors duration-300 selection:bg-primary selection:text-white pb-24 md:pb-0">
    <div class="fixed inset-0 pointer-events-none z-0 overflow-hidden">
        <div class="absolute -top-[10%] -left-[5%] w-[50%] h-[50%] bg-orange-900/20 rounded-full blur-[140px]"></div>
        <div class="absolute top-[20%] -right-[10%] w-[60%] h-[60%] bg-amber-900/15 rounded-full blur-[160px]"></div>
        <div class="absolute bottom-0 left-[20%] w-[70%] h-[50%] bg-primary/10 rounded-full blur-[120px]"></div>
    </div>

    <x-navbar />

    @yield('content')

    <x-footer />
    <x-bottom-navbar />

    @livewireScripts
    @yield('scripts')
</body>
</html>
