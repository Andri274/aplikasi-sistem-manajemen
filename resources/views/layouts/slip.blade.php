<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Slip Gaji')</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-sm">

    <div class="min-h-screen flex flex-col">
        <header class="bg-blue-700 text-white px-6 py-4 shadow">
            <h1 class="text-lg font-semibold">💼 Sistem Slip Gaji - @yield('title')</h1>
        </header>

        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>

</body>

</html>
