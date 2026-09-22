<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Konza Move') }} - Smart Mobility. Simplified.</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .animate-pulse-slow {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }
    </style>
</head>

<body class="font-sans antialiased bg-gray-50 h-full">
    <div class="min-h-full flex flex-col">
        <!-- Header -->
        <!-- Added @click.outside to close menu when clicking outside the header -->
        <header x-data="{ open: false }" @click.outside="open = false" class="bg-white border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <!-- Logo -->
                    <div class="flex items-center space-x-3">
                        <div class="flex-shrink-0">
                            <img class="h-10 w-auto" src="{{ asset('imgs/logo.png') }}" alt="{{ config('app.name') }}">
                        </div>
                        <span class="text-xl font-bold text-gray-600">Konza <span class="text-konza-green-600">Move</span></span>
                    </div>

                    <!-- Desktop Navigation -->
                    <div class="hidden md:flex items-center space-x-8">
                        <a href="#" class="text-gray-600 hover:text-gray-900 font-medium">Home</a>
                        <a href="#features" class="text-gray-600 hover:text-gray-900 font-medium">Features</a>

                        <!-- Status Badge -->
                        <div class="flex items-center space-x-2 bg-konza-green-50 px-3 py-1.5 rounded-full">
                            <span class="relative flex h-2 w-2">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-konza-green-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-konza-green-500"></span>
                            </span>
                            <span class="text-sm font-medium text-konza-green-700">System Online</span>
                        </div>

                        @if (Route::has('login'))
                        @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a>
                        @else
                        <!-- Updated button to exact green from first prompt (#166534 / hover #14532d) -->
                        <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-base font-medium rounded-lg text-white bg-[#166534] hover:bg-[#14532d] transition shadow-lg hover:shadow-xl">
                            Log in
                            <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                        @endauth
                        @endif
                    </div>


                    <!-- Mobile menu button -->
                    <div class="-mr-2 flex items-center md:hidden">
                        <button @click="open = ! open" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500" aria-controls="mobile-menu" aria-expanded="false">
                            <span class="sr-only">Open main menu</span>
                            <!-- Icon when menu is closed -->
                            <svg x-show="!open" class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                            <!-- Icon when menu is open -->
                            <!-- FIXED: Removed the "hidden" class so the X icon shows up properly -->
                            <svg x-show="open" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile menu -->
            <div x-show="open" class="md:hidden" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">
                <div class="pt-2 pb-3 space-y-1">
                    <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Home</a>
                    <a href="#features" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Features</a>
                    @if (Route::has('login'))
                    @auth
                    <a href="{{ url('/dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Dashboard</a>
                    @else
                    <!-- Updated mobile Log in button with the green -->
                    <a href="{{ route('login') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white bg-[#166534] hover:bg-[#14532d]">Log in</a>

                    @endauth
                    @endif
                </div>
            </div>
        </header>

        <!-- Hero Section -->
        <main class="flex-1">
            <div class="relative overflow-hidden">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-20">
                    <div class="lg:grid lg:grid-cols-2 lg:gap-8 items-center">
                        <!-- Left Column - Content -->
                        <div>
                            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-gray-900">
                                Smart Mobility.
                                <span class="text-konza-green-600">Simplified.</span>
                            </h1>
                            <p class="mt-4 text-lg sm:text-xl text-gray-600 leading-relaxed max-w-2xl">
                                A centralized Transport Management System to request, assign, and manage your entire fleet operations with real-time efficiency.
                            </p>

                            <!-- Feature Grid -->
                            <div class="mt-8 space-y-3">
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-lg bg-konza-green-50 flex items-center justify-center">
                                        <svg class="h-5 w-5 text-konza-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                    </div>
                                    <div>
                                        <span class="font-semibold text-gray-900">Instant Requests:</span>
                                        <span class="text-gray-600">Book vehicles in seconds.</span>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-lg bg-konza-green-50 flex items-center justify-center">
                                        <svg class="h-5 w-5 text-konza-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <span class="font-semibold text-gray-900">Fuel Management:</span>
                                        <span class="text-gray-600">Track consumption and costs.</span>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-lg bg-konza-green-50 flex items-center justify-center">
                                        <svg class="h-5 w-5 text-konza-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <span class="font-semibold text-gray-900">Fleet Analytics:</span>
                                        <span class="text-gray-600">Monitor performance live.</span>
                                    </div>
                                </div>
                            </div>

                            <!-- CTA Buttons -->
                            <div class="mt-10 flex flex-col sm:flex-row gap-4">
                                @if (Route::has('login'))
                                @auth
                                <!-- Updated to exact green -->
                                <a href="{{ url('/dashboard') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-[#166534] hover:bg-[#14532d] transition shadow-lg hover:shadow-xl">
                                    Go to Dashboard
                                    <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>
                                </a>
                                @else
                                <!-- Updated to exact green -->
                                <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-[#166534] hover:bg-[#14532d] transition shadow-lg hover:shadow-xl">
                                    Log in to KonzaMove
                                    <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>
                                </a>

                                @endauth
                                @endif
                            </div>
                        </div>

                        <!-- Right Column - Hero Image of Konza -->
                        <div class="mt-12 lg:mt-0">
                            <div class="relative rounded-2xl shadow-2xl overflow-hidden border border-gray-200">
                                <!-- Main Photo -->
                                <img src="{{ asset('imgs/Konza-Cradle-scaled.jpg') }}"
                                    alt="Konza Technopolis – Smart City"
                                    class="w-full h-auto object-cover aspect-[4/3] hover:scale-105 transition-transform duration-700">

                                <!-- Gradient Overlay -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>

                                <!-- Overlay Content -->
                                <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                                    <div class="flex items-end justify-between">
                                        <div>
                                            <p class="text-sm font-medium tracking-wide uppercase opacity-80">Konza Technopolis</p>
                                            <h3 class="text-2xl font-bold leading-tight">Africa’s Silicon Savannah</h3>
                                        </div>
                                        <div class="bg-white/20 backdrop-blur-sm rounded-lg px-4 py-2 text-sm font-medium border border-white/10 flex items-center gap-2">
                                            <span class="inline-block w-2 h-2 bg-konza-green-400 rounded-full animate-pulse"></span>
                                            Live
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Features Section -->
            <div id="features" class="py-12 bg-gray-50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center">
                        <h2 class="text-3xl font-bold text-gray-900">Everything you need to manage your fleet</h2>
                        <p class="mt-4 text-lg text-gray-600">Streamline vehicle requests, assignments, fuel logging, and service tracking in one place.</p>
                    </div>

                    <div class="mt-12 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                        <!-- Feature Card 1 -->
                        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200 hover:shadow-md transition">
                            <div class="h-12 w-12 rounded-lg bg-konza-green-50 flex items-center justify-center mb-4">
                                <svg class="h-6 w-6 text-konza-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900">Vehicle Requests</h3>
                            <p class="mt-2 text-gray-600">Submit and track vehicle requests with real-time status updates.</p>
                        </div>

                        <!-- Feature Card 2 -->
                        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200 hover:shadow-md transition">
                            <div class="h-12 w-12 rounded-lg bg-konza-green-50 flex items-center justify-center mb-4">
                                <svg class="h-6 w-6 text-konza-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900">Fuel Management</h3>
                            <p class="mt-2 text-gray-600">Monitor fuel consumption, track expenses, and optimize usage.</p>
                        </div>

                        <!-- Feature Card 3 -->
                        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200 hover:shadow-md transition">
                            <div class="h-12 w-12 rounded-lg bg-konza-green-50 flex items-center justify-center mb-4">
                                <svg class="h-6 w-6 text-konza-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900">Service Tracking</h3>
                            <p class="mt-2 text-gray-600">Schedule and track vehicle maintenance and service history.</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="flex items-center space-x-3">
                        <img class="h-8 w-auto" src="{{ asset('imgs/logo.png') }}" alt="{{ config('app.name') }}">
                        <span class="text-sm text-gray-500">&copy; {{ date('Y') }} Konza Technopolis. All rights reserved.</span>
                    </div>
                    <div class="flex space-x-6 mt-4 md:mt-0">
                        <a href="#" class="text-sm text-gray-500 hover:text-gray-900">Privacy Policy</a>
                        <a href="#" class="text-sm text-gray-500 hover:text-gray-900">Terms of Service</a>
                        <a href="mailto:support@konza.go.ke" class="text-sm text-gray-500 hover:text-gray-900">support@konza.go.ke</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Alpine.js for mobile menu -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>

</html>