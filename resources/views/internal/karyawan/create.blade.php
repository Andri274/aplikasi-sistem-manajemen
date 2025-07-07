@extends('layouts.main')

@section('content')
    <div class="max-w-lg mx-auto space-y-6">
        {{-- Form Tambah Karyawan --}}
        <div class="bg-white p-4 rounded shadow-sm">
            <h2 class="text-lg font-bold mb-3">Tambah Karyawan</h2>
            <form action="{{ route('internal.karyawan.store') }}" method="POST" class="space-y-3">
                @csrf

                <div>
                    <label class="block text-sm font-medium mb-1">Nama Lengkap</label>
                    <input type="text" name="nama"
                        class="w-full border rounded px-2 py-1 text-sm focus:outline-none focus:ring focus:ring-blue-200"
                        required>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">NIK</label>
                    <input type="text" name="nik"
                        class="w-full border rounded px-2 py-1 text-sm focus:outline-none focus:ring focus:ring-blue-200"
                        required>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Jabatan</label>
                    <input type="text" name="jabatan"
                        class="w-full border rounded px-2 py-1 text-sm focus:outline-none focus:ring focus:ring-blue-200"
                        required>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Jenis Kelamin</label>
                    <select name="jenis_kelamin"
                        class="w-full border rounded px-2 py-1 text-sm focus:outline-none focus:ring focus:ring-blue-200"
                        required>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Tanggal Masuk</label>
                    <input type="date" name="tanggal_masuk"
                        class="w-full border rounded px-2 py-1 text-sm focus:outline-none focus:ring focus:ring-blue-200"
                        required>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Rekening</label>
                    <input type="text" name="rekening"
                        class="w-full border rounded px-2 py-1 text-sm focus:outline-none focus:ring focus:ring-blue-200">
                </div>

                <div class="text-right">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white text-sm px-3 py-1 rounded">💾
                        Simpan</button>
                </div>
            </form>
        </div>

        {{-- Form Import Excel --}}
        <div class="bg-white p-4 rounded shadow-sm">
            <h2 class="text-lg font-bold mb-3">Import Data Karyawan</h2>
            <form action="{{ route('internal.karyawan.import') }}" method="POST" enctype="multipart/form-data"
                class="space-y-3">
                @csrf
                <div>
                    <label class="block text-sm font-medium mb-1">Upload File Excel</label>
                    <input type="file" name="file" accept=".xlsx,.xls,.csv"
                        class="w-full border rounded px-2 py-1 text-sm focus:outline-none focus:ring focus:ring-green-200"
                        required>
                </div>
                <div class="text-right">
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white text-sm px-3 py-1 rounded">⬆
                        Import</button>
                </div>
            </form>
        </div>
    </div>
@endsection
