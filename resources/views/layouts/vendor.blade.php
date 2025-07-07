<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor - @yield('title')</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body class="flex bg-gray-100">
    {{-- Sidebar --}}
    <aside class="w-64 bg-green-700 text-white flex-shrink-0">
        <div class="p-4 text-2xl font-bold border-b border-green-600">
            PT <span class="text-orange-400">Harimurti</span> Bagja Lestari
        </div>
        <nav class="p-4 space-y-2">
            <a href="{{ route('vendor.index') }}" class="block px-3 py-2 rounded hover:bg-green-600">🏠 Dashboard</a>
            <a href="{{ route('vendor.laporan.index') }}" class="block px-3 py-2 rounded hover:bg-green-600">📦 Laporan
                Produksi</a>
            <a href="{{ route('vendor.absensi.index') }}" class="block px-3 py-2 rounded hover:bg-green-600">📋
                Absensi</a>
            <a href="{{ route('vendor.pembelian.index') }}" class="block px-3 py-2 rounded hover:bg-green-600">🛒
                Pembelian</a>
            <form action="{{ route('logout') }}" method="POST" class="mt-4">
                @csrf
                <button type="submit" class="w-full px-3 py-2 rounded bg-red-600 hover:bg-red-700">🚪 Logout</button>
            </form>
        </nav>
    </aside>

    {{-- Content --}}
    <main class="flex-1 p-6">
        @yield('content')
    </main>
</body>

</html>
