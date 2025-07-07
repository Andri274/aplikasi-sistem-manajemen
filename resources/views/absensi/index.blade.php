@extends('layouts.main')

@section('content')
    <div class="max-w-4xl mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4 text-gray-800">Form Input Absensi</h1>

        <form action="{{ route('absensi.store') }}" method="POST" class="space-y-4 bg-white p-6 rounded-xl shadow">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- Nama Karyawan --}}
                <div>
                    <label for="karyawan_id" class="block text-sm font-medium text-gray-700">Nama Karyawan</label>
                    <select name="karyawan_id" id="karyawan_id"
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Pilih Karyawan --</option>
                        @foreach ($karyawan as $k)
                            <option value="{{ $k->id }}">{{ $k->nama }} ({{ $k->jabatan }})</option>
                        @endforeach
                    </select>
                </div>

                {{-- Tanggal --}}
                <div>
                    <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal"
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                {{-- Jam Masuk --}}
                <div>
                    <label for="jam_masuk" class="block text-sm font-medium text-gray-700">Jam Masuk</label>
                    <input type="time" name="jam_masuk" id="jam_masuk"
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                {{-- Jam Keluar --}}
                <div>
                    <label for="jam_keluar" class="block text-sm font-medium text-gray-700">Jam Keluar</label>
                    <input type="time" name="jam_keluar" id="jam_keluar"
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                {{-- Keterangan --}}
                <div class="md:col-span-2">
                    <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
                    <input type="text" name="keterangan" id="keterangan" placeholder="Contoh: Izin, Sakit, Alpha..."
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>

            <div class="pt-4">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                    Simpan Absensi
                </button>
            </div>
        </form>
    </div>
@endsection
