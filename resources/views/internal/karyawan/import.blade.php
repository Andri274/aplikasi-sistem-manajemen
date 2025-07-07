@extends('layouts.main')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow mt-6">
    <h1 class="text-2xl font-bold mb-4">⬆️ Import Data Karyawan</h1>
    <p class="text-gray-600 mb-6">
        Upload file Excel (.xlsx, .xls) atau CSV untuk menambahkan karyawan secara massal.
    </p>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
            ✅ {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>❌ {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('internal.karyawan.import') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Pilih File</label>
            <input type="file" name="file" accept=".xlsx,.xls,.csv" 
                   class="block w-full text-sm text-gray-700 border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300" required>
        </div>
        <div class="flex justify-end space-x-2">
            <a href="{{ route('internal.karyawan.index') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
               🔙 Kembali
            </a>
            <button type="submit" 
                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                📤 Upload & Import
            </button>
        </div>
    </form>
</div>
@endsection
