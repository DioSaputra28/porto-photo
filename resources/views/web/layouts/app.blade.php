<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>OJJ | Photographer</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet" />
    <!-- Remix Icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet" />
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1A2321', // Deep Dark Green
                        secondary: '#0F1413', // Darker Green
                        accent: '#FF6B4A', // Coral
                        'accent-hover': '#E85A3A',
                        text: '#F4F4F4', // Off-white
                        muted: '#A0A0A0', // Grey
                        brandyellow: '#F4D03F',
                    },
                    fontFamily: {
                        heading: ['Playfair Display', 'serif'],
                        body: ['Inter', 'sans-serif'],
                    },
                    animation: {
                        'spin-slow': 'spin 10s linear infinite',
                        'float': 'float 6s ease-in-out infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': {
                                transform: 'translateY(0)'
                            },
                            '50%': {
                                transform: 'translateY(-10px)'
                            },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        /* Custom Utilities not easily in Tailwind */
        .arch-image {
            border-radius: 200px 200px 0 0;
        }

        .text-curved-path {
            animation: spin 10s linear infinite;
        }
    </style>
</head>

<body class="bg-primary text-text font-body leading-relaxed overflow-x-hidden">

    @include('web.layouts.navbar')

    @yield('content')

    @include('web.layouts.footer')

    <!-- Custom Scripts -->
    <script src="{{ asset('js/front/script.js') }}"></script>
</body>

</html>