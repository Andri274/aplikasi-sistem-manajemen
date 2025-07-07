<!DOCTYPE html>
<html lang="id" x-data="{ darkMode: false }" :class="{ 'dark': darkMode }" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT Harimurti Bagja Lestari</title>
    <script defer src="//unpkg.com/alpinejs"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/internal-vendor-mobile.css') }}">
    <style>
        /* Smooth Dark Mode */
        .dark .bg-white {
            background-color: #1f2937 !important;
        }

        .dark .text-gray-800 {
            color: #f9fafb !important;
        }

        .dark .border-green-600 {
            border-color: #374151 !important;
        }

        .dark .hover\:bg-green-600:hover {
            background-color: #4b5563 !important;
        }

        .dark .hover\:bg-blue-600:hover {
            background-color: #3b82f6 !important;
        }

        .dark .hover\:bg-red-100:hover {
            background-color: #b91c1c !important;
        }
    </style>
</head>

<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-100 flex h-full">

    {{-- Sidebar --}}
    <aside x-data="{ collapsed: false }" :class="collapsed ? 'w-16' : 'w-64'"
        class="bg-green-700 dark:bg-gray-800 text-white flex flex-col shadow-lg transition-all duration-300 ease-in-out">

        {{-- Logo + Nama Perusahaan --}}
        <div class="p-4 flex items-center justify-between border-b border-green-600 dark:border-gray-700">
            <div class="flex items-center space-x-3">
                <img src="{{ asset('logo.png') }}" alt="Logo" class="w-10 h-10 rounded-full object-cover shadow-md">
                <div x-show="!collapsed" class="leading-tight text-base font-extrabold tracking-wide">
                    <span class="text-white">PT</span>
                    <span class="text-yellow-300">Harimurti</span>
                    <span class="text-pink-200">Bagja</span>
                    <span class="text-green-200">Lestari</span>
                </div>
            </div>
            <button @click="collapsed = !collapsed"
                class="text-green-100 hover:text-white focus:outline-none transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path x-show="!collapsed" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 19l-7-7 7-7" />
                    <path x-show="collapsed" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>

        {{-- Menu --}}
        <nav class="flex-1 overflow-y-auto mt-4">
            <ul class="space-y-1 text-sm font-semibold px-2">
                @if (isInternal())
                    <li>
                        <a href="{{ route('internal.index') }}"
                            class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-green-600 dark:hover:bg-gray-700 transition">
                            <span>🏠</span>
                            <span x-show="!collapsed">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('internal.karyawan.index') }}"
                            class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-green-600 dark:hover:bg-gray-700 transition">
                            <span>👥</span>
                            <span x-show="!collapsed">Data Karyawan</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('internal.slip.index') }}"
                            class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-green-600 dark:hover:bg-gray-700 transition">
                            <span>💸</span>
                            <span x-show="!collapsed">Slip Gaji</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('internal.marketing.index') }}"
                            class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-green-600 dark:hover:bg-gray-700 transition">
                            <span>📊</span>
                            <span x-show="!collapsed">Laporan Penjualan</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('internal.pembelian.index') }}"
                            class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-blue-600 dark:hover:bg-gray-700 transition">
                            <span>📦</span>
                            <span x-show="!collapsed">Pembelian Bahan</span>
                        </a>
                    </li>
                    <ul class="space-y-2">
    <li>
        <a href="{{ route('internal.users.index') }}"
           class="block px-4 py-2 rounded hover:bg-gray-200 {{ request()->is('users*') ? 'bg-gray-300 font-bold' : '' }}">
            👤 User Management
        </a>
    </li>
    {{-- Link lain di sidebar --}}
</ul>

                    
                @endif

                {{-- Logout --}}
                <li class="mt-4">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="flex items-center space-x-3 px-3 py-2 w-full text-left text-red-400 hover:bg-red-100 dark:hover:bg-red-700 rounded-lg">
                            <span>🚪</span>
                            <span x-show="!collapsed">Logout</span>
                        </button>
                    </form>
                </li>
            </ul>
        </nav>

        {{-- Dark Mode Toggle --}}
        <div class="p-4 border-t border-green-600 dark:border-gray-700 flex justify-center">
            <button @click="darkMode = !darkMode" class="text-yellow-200 hover:text-white transition">
                🌙 <span x-show="!collapsed">Toggle Dark</span>
            </button>
        </div>
    </aside>

    {{-- Main Content + Topbar --}}
    <div class="flex-1 flex flex-col">
        {{-- Topbar --}}
        <header class="bg-white dark:bg-gray-800 shadow p-4 flex justify-between items-center">
            <h1 class="text-xl font-bold">@yield('title')</h1>
        </header>

        {{-- Main Content --}}
        <main class="p-6 flex-1 overflow-y-auto">
            @yield('content')
        </main>
    </div>
</body>

</html>
