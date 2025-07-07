@extends('layouts.internal')

@section('title', 'Rekap Slip Gaji')

@section('content')
    <div class="space-y-6">
        <h1 class="text-2xl font-bold">Rekap Slip Gaji</h1>

        <form method="GET" action="{{ route('rekap.index') }}" class="flex flex-wrap gap-2">
            <input type="date" name="tanggal_mulai" value="{{ request('tanggal_mulai') }}" class="border rounded p-2">
            <input type="date" name="tanggal_selesai" value="{{ request('tanggal_selesai') }}" class="border rounded p-2">
            <input type="text" name="nama" placeholder="Nama Karyawan" value="{{ request('nama') }}"
                class="border rounded p-2">
            <select name="jabatan" class="border rounded p-2">
                <option value="">-- Semua Jabatan --</option>
                <option value="Admin" {{ request('jabatan') == 'Admin' ? 'selected' : '' }}>Admin</option>
                <option value="Operator" {{ request('jabatan') == 'Operator' ? 'selected' : '' }}>Operator</option>
            </select>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Tampilkan</button>
        </form>

        <div class="flex gap-2 my-4">
            <a href="{{ route('rekap.export.pdf', request()->all()) }}" class="bg-red-600 text-white px-4 py-2 rounded">⬇
                Export PDF</a>
            <a href="{{ route('rekap.export.excel', request()->all()) }}" class="bg-blue-600 text-white px-4 py-2 rounded">⬇
                Export Excel</a>
        </div>

        <table class="table-auto w-full border-collapse border">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border px-4 py-2">No</th>
                    <th class="border px-4 py-2">Nama</th>
                    <th class="border px-4 py-2">Jabatan</th>
                    <th class="border px-4 py-2">Periode</th>
                    <th class="border px-4 py-2">Total Gaji Bersih</th>
                    <th class="border px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($slips as $index => $slip)
                    <tr>
                        <td class="border px-4 py-2">{{ $slips->firstItem() + $index }}</td>
                        <td class="border px-4 py-2">{{ $slip->karyawan->nama }}</td>
                        <td class="border px-4 py-2">{{ $slip->karyawan->jabatan }}</td>
                        <td class="border px-4 py-2">{{ $slip->tanggal_slip->format('F Y') }}</td>
                        <td class="border px-4 py-2">Rp {{ number_format($slip->total_gaji_bersih, 0, ',', '.') }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('slip.show', $slip->id) }}" class="text-blue-600">👁 View</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="border px-4 py-2 text-center">Tidak ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $slips->links() }}
        </div>
    </div>
@endsection
