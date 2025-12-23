<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'SecureShop') }}</title>
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <!-- Fallback to Tailwind CDN for instant styling -->
            <script src="https://cdn.tailwindcss.com"></script>
            <script>
                tailwind.config = {
                    theme: {
                        extend: {
                            fontFamily: {
                                sans: ['Instrument Sans', 'sans-serif'],
                            }
                        }
                    }
                }
            </script>
        @endif
    </head>
    <body class="antialiased bg-white text-gray-900 font-sans selection:bg-indigo-500 selection:text-white">
        
        <div class="relative min-h-screen flex flex-col">
            
            <!-- Navbar -->
            <nav class="w-full py-6 px-6 lg:px-16 flex justify-between items-center z-20">
                <!-- Logo -->
                <div class="flex items-center gap-2">
                    <x-application-logo class="block h-10 w-auto text-indigo-600 fill-current" />
                    <span class="text-xl font-bold tracking-tight text-gray-900">SecureShop</span>
                </div>

                <!-- Auth Links -->
                <div class="flex items-center gap-6">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition">Log in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-5 py-2.5 bg-gray-900 text-white text-sm font-medium rounded-lg hover:bg-gray-800 transition shadow-md">
                                    Get Started
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </nav>

            <!-- Hero Section -->
            <main class="flex-grow flex items-center justify-center px-6 lg:px-16 relative overflow-hidden">
                
                <!-- Background decoration bubbles -->
                <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-indigo-50 rounded-full blur-3xl opacity-50 pointer-events-none"></div>
                <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 bg-pink-50 rounded-full blur-3xl opacity-50 pointer-events-none"></div>

                <div class="max-w-7xl w-full grid grid-cols-1 lg:grid-cols-2 gap-16 items-center z-10">
                    
                    <!-- Left Content -->
                    <div class="text-center lg:text-left space-y-8">
                        <div class="inline-flex items-center px-3 py-1 rounded-full bg-indigo-50 text-indigo-600 text-xs font-semibold tracking-wide uppercase border border-indigo-100">
                            Secure & Reliable
                        </div>
                        <h1 class="text-5xl lg:text-7xl font-bold leading-tight text-gray-900">
                            Secure shopping <br>
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">made simple.</span>
                        </h1>
                        <p class="text-lg text-gray-500 leading-relaxed max-w-lg mx-auto lg:mx-0">
                            Discover a curated marketplace protected by industry-standard security. 
                            Shop with confidence using 2FA, encrypted payments, and real-time tracking.
                        </p>
                        
                        <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="px-8 py-4 bg-indigo-600 text-white text-base font-semibold rounded-xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-200">
                                    Browse Products
                                </a>
                            @else
                                <a href="{{ route('register') }}" class="px-8 py-4 bg-indigo-600 text-white text-base font-semibold rounded-xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-200">
                                    Start Shopping
                                </a>
                                <a href="{{ route('login') }}" class="px-8 py-4 bg-white text-gray-700 border border-gray-200 text-base font-semibold rounded-xl hover:bg-gray-50 transition">
                                    Log In
                                </a>
                            @endauth
                        </div>

                        <!-- Stats / Trust Indicators -->
                        <div class="pt-8 flex items-center justify-center lg:justify-start gap-8 border-t border-gray-100">
                            <div>
                                <p class="text-2xl font-bold text-gray-900">PCI-DSS</p>
                                <p class="text-sm text-gray-500">Compliant</p>
                            </div>
                            <div class="w-px h-10 bg-gray-200"></div>
                            <div>
                                <p class="text-2xl font-bold text-gray-900">2FA</p>
                                <p class="text-sm text-gray-500">Protection</p>
                            </div>
                            <div class="w-px h-10 bg-gray-200"></div>
                            <div>
                                <p class="text-2xl font-bold text-gray-900">SSL</p>
                                <p class="text-sm text-gray-500">Encrypted</p>
                            </div>
                        </div>
                    </div>

                    <!-- Right Image -->
                    <div class="relative hidden lg:block h-full">
                        <div class="absolute inset-0 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-3xl transform rotate-3 opacity-10"></div>
                        <img 
                            src="https://images.unsplash.com/photo-1483985988355-763728e1935b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" 
                            alt="Fashion E-commerce" 
                            class="relative rounded-3xl shadow-2xl object-cover w-full h-[600px] transform hover:-translate-y-2 transition duration-500 border border-gray-100"
                        >
                        
                        <!-- Floating Badge -->
                        <div class="absolute -bottom-6 -left-6 bg-white p-4 rounded-xl shadow-xl border border-gray-100 flex items-center gap-3">
                            <div class="bg-green-100 p-2 rounded-full text-green-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 font-semibold uppercase">Security Status</p>
                                <p class="text-sm font-bold text-gray-900">Protected</p>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            
            <footer class="py-6 text-center text-sm text-gray-400">
                &copy; {{ date('Y') }} SecureShop. All rights reserved.
            </footer>
        </div>
    </body>
</html>