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
    @vite('resources/css/app.css', 'resources/js/app.js')
</head>

<body class="bg-primary text-text font-body leading-relaxed overflow-x-hidden">

    @include('web.layouts.navbar')

    @yield('content')

    @include('web.layouts.footer')

    <!-- Custom Scripts -->
    <script src="{{ asset('js/front/script.js') }}"></script>
</body>

</html>