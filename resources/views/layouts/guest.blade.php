<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Konza TMS</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen flex">

        <!-- Left: Form Panel -->
        <div class="w-full lg:w-1/2 flex flex-col justify-center px-8 sm:px-16 py-12 bg-white dark:bg-gray-900">
            <div class="max-w-sm mx-auto w-full">
                <a href="/" class="block mb-10">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="Konza Technopolis" class="h-14">
                </a>

                {{ $slot }}
            </div>
        </div>

        <!-- Right: Branded Panel -->
        <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden">
            <img src="{{ asset('imgs/Konza-Cradle-scaled.jpg') }}" alt="Konza Technopolis" class="absolute inset-0 w-full h-full object-cover">

            <div class="absolute inset-0 bg-konza-green-500/70 mix-blend-multiply"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-konza-green-900/95 via-konza-green-900/50 to-transparent"></div>

            <div class="relative z-10 flex flex-col items-center justify-center h-full p-12 text-white text-center">
                <h2 class="text-3xl font-bold leading-tight mb-3">
                    Konza <span class="text-konza-green-400">Transport Management System</span>
                </h2>
                <p class="text-konza-green-50/90 text-lg max-w-md">

                </p>
            </div>
        </div>

    </div>
</body>

</html>