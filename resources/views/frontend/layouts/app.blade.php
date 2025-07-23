<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Smart Desa') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">

        {{-- Public-facing navigation header --}}
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                <a href="{{ route('home') }}" class="text-xl font-bold text-gray-800 dark:text-gray-200">
                    Logo Desa
                </a>
            </div>
        </header>

        <main>
            {{-- This correctly yields content from pages like home.blade.php --}}
            @yield('content')
        </main>

        {{-- Public-facing footer --}}
        <footer class="bg-white dark:bg-gray-800 mt-8 py-4">
            <div class="max-w-7xl mx-auto text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} {{ config('app.name', 'Smart Desa') }}. All Rights Reserved.
            </div>
        </footer>
    </div>
</body>

</html>
