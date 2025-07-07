@extends('layouts.vendor')

@section('content')
    <div class="p-4 text-center">
        <h1 class="text-xl font-bold mb-4">Dashboard Divisi Produksi</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            {{-- Card Produksi --}}
            <a href="{{ route('vendor.laporan.index') }}"
                class="block bg-white shadow rounded-lg p-4 hover:bg-green-50 transition">
                <h2 class="text-lg font-semibold text-green-600">📦 Input Produksi</h2>
                <p class="text-gray-600 text-sm">Catat hasil produksi woodpellet</p>
            </a>

            {{-- Card Absensi --}}
            <a href="{{ route('vendor.absensi.index') }}"
                class="block bg-white shadow rounded-lg p-4 hover:bg-blue-50 transition">
                <h2 class="text-lg font-semibold text-blue-600">📝 Input Absensi</h2>
                <p class="text-gray-600 text-sm">Kelola data absensi karyawan</p>
            </a>

            {{-- Card Pembelian --}}
            <a href="{{ route('vendor.pembelian.index') }}"
                class="block bg-white shadow rounded-lg p-4 hover:bg-yellow-50 transition">
                <h2 class="text-lg font-semibold text-yellow-600">💰 Input Pembelian</h2>
                <p class="text-gray-600 text-sm">Catat transaksi pembelian bahan baku</p>
            </a>

            {{-- Card Logout --}}
            <form action="{{ route('logout') }}" method="POST"
                class="block bg-white shadow rounded-lg p-4 hover:bg-red-50 transition">
                @csrf
                <button type="submit" class="w-full text-left">
                    <h2 class="text-lg font-semibold text-red-600">🚪 Logout</h2>
                    <p class="text-gray-600 text-sm">Keluar dari akun vendor</p>
                </button>
            </form>
        </div>
    </div>
@endsection
