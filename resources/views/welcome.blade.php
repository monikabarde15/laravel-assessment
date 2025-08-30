<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>My App</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
@if(app()->environment() !== 'testing')
    @vite('resources/css/app.css')
@endif
</head>
<body class="antialiased bg-gray-100 dark:bg-gray-900">

    <div class="min-h-screen flex flex-col items-center justify-center">
        {{-- Navbar --}}
        <div class="w-full flex justify-between items-center p-6 bg-white shadow">
            <h1 class="text-2xl font-bold text-red-500">My App</h1>
            <div>
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/home') }}" 
                           class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" 
                           class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
                            Login
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" 
                               class="ml-3 px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                                Register
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>

        {{-- Hero Section --}}
        <div class="text-center mt-20">
            <h2 class="text-4xl font-bold text-gray-800 dark:text-white">Welcome to My App 🚀</h2>
            <p class="mt-4 text-gray-600 dark:text-gray-300">
                This is a simple landing page built with Laravel & TailwindCSS.
            </p>

            <div class="mt-6">
                <a href="{{ route('login') }}" 
                   class="px-6 py-3 bg-red-500 text-white rounded-lg shadow hover:bg-red-600">
                    Get Started
                </a>
            </div>
        </div>
    </div>

</body>
</html>
