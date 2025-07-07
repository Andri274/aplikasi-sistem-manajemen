@extends('layouts.main')

@section('content')
    <div class="max-w-5xl mx-auto px-4 py-6 bg-white rounded shadow">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-bold">Data Slip Gaji</h2>
            <a href="{{ route('internal.slip.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                + Buat Slip Gaji
            </a>
        </div>

        @if (session('success'))
            <div class="mb-4 px-4 py-2 bg-green-100 text-green-800 border border-green-300 rounded text-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full border text-sm">
                <thead class="bg-gray-100 text-center">
                    <tr>
                        <th class="border px-3 py-2">No</th>
                        <th class="border px-3 py-2">Nama</th>
                        <th class="border px-3 py-2">Periode</th>
                        <th class="border px-3 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($slips as $index => $slip)
                        <tr class="text-center">
                            <td class="border px-3 py-2">{{ $index + 1 }}</td>
                            <td class="border px-3 py-2">{{ $slip->karyawan->nama }}</td>
                            <td class="border px-3 py-2">{{ $slip->periode }}</td>
                            <td class="border px-3 py-2 space-x-1">
                                <a href="{{ route('internal.slip.cetak', $slip->id) }}"
                                    class="bg-green-600 hover:bg-green-700 text-white px-2 py-1 rounded">
                                    Cetak
                                </a>

                                <form action="{{ route('internal.slip.destroy', $slip->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin mau hapus?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-600 hover:bg-red-700 text-white px-2 py-1 rounded">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
