<!DOCTYPE html>
<html class="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>@yield('title', 'Auth | HOMELIVING')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&amp;family=Inter:wght@300;400;500;600&amp;display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "surface-container-low": "#f6f3f1",
                        "surface-container": "#f0edeb",
                        "secondary-container": "#e5ded9",
                        "tertiary-container": "#837163",
                        "secondary": "#625e5a",
                        "primary-fixed": "#ffdbca",
                        "inverse-surface": "#31302f",
                        "surface-dim": "#dcd9d8",
                        "surface-tint": "#9d4400",
                        "inverse-primary": "#ffb68f",
                        "on-secondary-fixed-variant": "#4a4642",
                        "on-background": "#1b1c1b",
                        "surface": "#fcf9f7",
                        "on-tertiary-fixed-variant": "#534438",
                        "surface-container-highest": "#e5e2e0",
                        "primary-fixed-dim": "#ffb68f",
                        "surface-container-lowest": "#ffffff",
                        "outline-variant": "#dec0b2",
                        "tertiary-fixed": "#f5dece",
                        "on-secondary": "#ffffff",
                        "on-primary-fixed-variant": "#773200",
                        "error-container": "#ffdad6",
                        "secondary-fixed-dim": "#ccc5c0",
                        "inverse-on-surface": "#f3f0ee",
                        "primary": "#994200",
                        "surface-container-high": "#eae8e6",
                        "on-error-container": "#93000a",
                        "surface-variant": "#e5e2e0",
                        "on-primary": "#ffffff",
                        "error": "#ba1a1a",
                        "on-secondary-fixed": "#1e1b18",
                        "on-surface-variant": "#574238",
                        "tertiary": "#69594c",
                        "on-secondary-container": "#66625e",
                        "on-primary-container": "#fffbff",
                        "surface-bright": "#fcf9f7",
                        "on-tertiary-fixed": "#25190f",
                        "on-primary-fixed": "#331100",
                        "on-surface": "#1b1c1b",
                        "tertiary-fixed-dim": "#d8c3b2",
                        "primary-container": "#c05500",
                        "secondary-fixed": "#e8e1dc",
                        "outline": "#8b7266",
                        "background": "#fcf9f7",
                        "on-tertiary-container": "#fffbff",
                        "on-error": "#ffffff",
                        "on-tertiary": "#ffffff"
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    fontFamily: {
                        "headline": ["Manrope"],
                        "body": ["Inter"],
                        "label": ["Inter"]
                    }
                },
            },
        };
    </script>

    <style>
        .material-symbols-outlined {
            font-family: "Material Symbols Outlined";
            font-variation-settings: "FILL" 0, "wght" 400, "GRAD" 0, "opsz" 24;
            font-style: normal;
            line-height: 1;
            display: inline-block;
        }
    </style>
    @yield('head')
</head>
<body class="@yield('body_class', 'bg-surface font-body text-on-surface selection:bg-primary-fixed min-h-screen')">
    @yield('content')
</body>
</html>
