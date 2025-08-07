<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{
    isSidebarOpen: window.innerWidth >= 768,
    toggleSidebar() { this.isSidebarOpen = !this.isSidebarOpen }
}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

    {{-- Fonts & CSS --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

    {{-- Aset Vite & JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="font-sans antialiased">
    <div class="flex h-screen bg-gray-100">

        {{-- Sidebar --}}
        <aside
            class="w-64 flex-shrink-0 bg-white border-r border-gray-200 p-5 transform md:transform-none transition-transform duration-200 ease-in-out"
            :class="{ '-translate-x-full': !isSidebarOpen, 'translate-x-0': isSidebarOpen }">
            <div class="mb-10 text-center">
                <a href="{{ route('backend.dashboard') }}">
                    <h1 class="text-2xl font-bold text-gray-800">SmartDesa </h1>
                </a>
            </div>

            <nav>
                <ul class="flex flex-col space-y-2">
                    <li>
                        <a href="{{ route('backend.dashboard') }}"
                            class="flex items-center px-4 py-2.5 rounded-lg transition duration-200 text-gray-600 hover:bg-gray-100
                      {{ request()->routeIs('backend.dashboard') ? 'bg-green-500 text-white hover:bg-green-600' : '' }}">
                            <i
                                class="fas fa-tachometer-alt w-5 h-5 mr-3 text-gray-500 {{ request()->routeIs('backend.dashboard') ? 'text-white' : '' }}"></i>
                            <span>Dashboard3</span>
                        </a>
                    </li>

                    {{dd('ada')}}
                    @if (isset($moduls))
                    @foreach ($moduls as $modul)
                    <li>
                        <div x-data="{ open: false }">
                            <button @click="open = !open"
                                class="w-full flex justify-between items-center px-4 py-2.5 rounded-lg transition duration-200 text-left text-gray-600 hover:bg-gray-100">
                                <span class="flex items-center">
                                    <i class="{{ $modul->icon }} w-5 h-5 mr-3 text-gray-500"></i>
                                    <span>{{ $modul->name }}</span>
                                </span>
                                <svg class="w-4 h-4 transform transition-transform" :class="{ 'rotate-180': open }"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                            <div x-show="open" x-transition class="mt-1 pl-8 space-y-1">
                                <ul class="flex flex-col space-y-1">
                                    {{dd($permission)}}
                                    @foreach ($permissions as $permission)
                                    @if ($permission->modul_id == $modul->id && $permission->menu)
                                    <li>
                                        @if (!empty($permission->menu->url) && Route::has($permission->menu->url))
                                        <a href="{{ route($permission->menu->url) }}"
                                            class="block px-4 py-2 rounded-lg text-sm transition duration-200 {{ request()->routeIs($permission->menu->url.'*') ? 'font-semibold text-green-600' : 'text-gray-500 hover:text-gray-800 hover:bg-gray-100' }}">
                                            {{ $permission->menu->name }}
                                        </a>
                                        @endif
                                    </li>
                                    @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </li>
                    @endforeach
                    @endif
                </ul>
            </nav>
        </aside>

        {{-- Konten Utama --}}
        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="flex justify-between items-center p-4 sm:p-6 bg-white border-b border-gray-200">
                <div class="flex items-center">
                    <button @click="toggleSidebar" class="md:hidden text-gray-500 focus:outline-none mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                    <h2 class="text-xl font-semibold text-gray-800">{{ $title ?? 'Dashboard' }}</h2>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-500 hidden sm:block">
                        Selamat datang, {{ Auth::guard('admin')->user()->name }}
                    </span>
                    <form method="POST" action="{{ route('backend.auth.logout') }}">
                        @csrf
                        <button type="submit"
                            class="text-sm font-medium text-gray-600 hover:text-red-500 transition">Logout</button>
                    </form>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-4 sm:p-6">
                @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
                @endif
                @if (session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-md" role="alert">
                    <p>{{ session('error') }}</p>
                </div>
                @endif

                {{ $slot }}
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>