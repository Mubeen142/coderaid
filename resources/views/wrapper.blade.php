<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title') - CodeRaid</title>
    <link rel="icon" href="https://imgur.com/oJDxg2r.png">

    {{-- meta tags --}}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Meta Description Tag: Affects click-through rates from search results -->
    <meta name="description" content="Tool for Rust to start code raiding">
    <meta name="theme-color" content="#4f46e5">
    <meta name="keywords" content="rust, coderaid">

    <!-- Meta Robots Tag: Controls search engine crawling and indexing -->
    <meta name="robots" content="index, follow">

    <!-- Open Graph Tags: Enhances visibility and engagement on social media platforms -->
    <meta property="og:title" content="CodeRaid">
    <meta property="og:description" content="Start coderaiding in rust">
    <meta property="og:image" content="https://imgur.com/oJDxg2r.png">

    <!-- Custom CSS -->
    {{-- @vite(['resources/css/app.css','resources/js/app.js']) --}}

    <!-- Google tag (gtag.js) -->
    {{-- <script async src="https://www.googletagmanager.com/gtag/js?id=##"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', '##');
    </script> --}}

    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                    "50": "#fef2f2",
                    "100": "#fee2e2",
                    "200": "#fecaca",
                    "300": "#fca5a5",
                    "400": "#f87171",
                    "500": "#ef4444",
                    "600": "#dc2626",
                    "700": "#cb402b",
                    "800": "#b83a27",
                    "900": "#7f1d1d"
                    },
                        gray: {
                            "50": "#F9FAFB",
                            "100": "#F3F4F6",
                            "200": "#E5E7EB",
                            "300": "#D1D5DB",
                            "400": "#9CA3AF",
                            "500": "#6B7280",
                            "600": "#4B5563",
                            "700": "#374151",
                            "800": "#1F2937",
                            "900": "#111827"
                        },
                    }
                },
                fontFamily: {
                    'body': [
                        'Inter',
                        'ui-sans-serif',
                        'system-ui',
                        '-apple-system',
                        'system-ui',
                        'Segoe UI',
                        'Roboto',
                        'Helvetica Neue',
                        'Arial',
                        'Noto Sans',
                        'sans-serif',
                        'Apple Color Emoji',
                        'Segoe UI Emoji',
                        'Segoe UI Symbol',
                        'Noto Color Emoji'
                    ],
                    'sans': [
                        'Inter',
                        'ui-sans-serif',
                        'system-ui',
                        '-apple-system',
                        'system-ui',
                        'Segoe UI',
                        'Roboto',
                        'Helvetica Neue',
                        'Arial',
                        'Noto Sans',
                        'sans-serif',
                        'Apple Color Emoji',
                        'Segoe UI Emoji',
                        'Segoe UI Symbol',
                        'Noto Color Emoji'
                    ]
                }
            }
        }

        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
        }
    </script>
    @yield('header')
</head>

<body class="bg-white dark:bg-gray-900 antialiased ">
    @yield('content')
</body>

</html>