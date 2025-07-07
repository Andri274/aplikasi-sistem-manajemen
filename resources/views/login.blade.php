<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login - PT Harimurti Bagja Lestari</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">
        <div class="text-center mb-6">
            <img src="{{ asset('logo.png') }}" class="w-20 h-20 mx-auto mb-2" alt="Logo Perusahaan">
            <h1 class="text-xl font-bold text-gray-700">PT Harimurti Bagja Lestari</h1>
        </div>

        @if (session('error'))
            <div class="bg-red-100 text-red-600 px-4 py-2 rounded mb-4 text-sm">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.process') }}">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 text-sm mb-1">Email atau No HP</label>
                <input type="text" name="login" value="{{ old('login') }}" required autofocus
                    class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-500 text-sm">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm mb-1">Password</label>
                <input type="password" name="password" required
                    class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-500 text-sm">
            </div>

            <div class="flex items-center justify-between mb-4">
                <label class="text-sm text-gray-600 flex items-center">
                    <input type="checkbox" name="remember" class="mr-1">
                    Ingat saya
                </label>
            </div>

            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded transition">
                Login
            </button>
        </form>
    </div>

</body>

</html>
