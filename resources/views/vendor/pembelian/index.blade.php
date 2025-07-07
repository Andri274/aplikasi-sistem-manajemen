@extends('layouts.vendor')

@section('content')
    <h2 class="text-xl font-bold mb-4">📦 Pembelian Bahan Baku</h2>

    {{-- Notif sukses --}}
    @if (session('success'))
        <div class="bg-green-200 text-green-800 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- FORM INPUT --}}
    <form action="{{ route('vendor.pembelian.store') }}" method="POST" enctype="multipart/form-data"
        class="bg-white p-4 rounded shadow mb-6">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="font-semibold">Tanggal Pembelian</label>
                <input type="date" name="tanggal" class="w-full border px-2 py-1 rounded" required>
            </div>
            <div>
                <label class="font-semibold">Nama Bahan Baku</label>
                <input type="text" name="nama_bahan" class="w-full border px-2 py-1 rounded" required>
            </div>
            <div>
                <label class="font-semibold">Jumlah</label>
                <input type="number" step="0.01" name="jumlah" class="w-full border px-2 py-1 rounded" required>
            </div>
            <div>
                <label class="font-semibold">Satuan</label>
                <input type="text" name="satuan" placeholder="kg, liter, karung..."
                    class="w-full border px-2 py-1 rounded" required>
            </div>
            <div>
                <label class="font-semibold">Harga per Satuan</label>
                <input type="number" name="harga_satuan" class="w-full border px-2 py-1 rounded" required>
            </div>
            <div>
                <label class="font-semibold">Supplier</label>
                <input type="text" name="supplier" class="w-full border px-2 py-1 rounded" required>
            </div>
            <div>
                <label class="font-semibold">No Faktur (Opsional)</label>
                <input type="text" name="no_faktur" class="w-full border px-2 py-1 rounded">
            </div>
            <div>
                <label class="font-semibold">Bukti Pembelian (Opsional)</label>
                <input type="file" name="bukti_file" class="w-full border px-2 py-1 rounded">
            </div>
            <div class="md:col-span-2">
                <label class="font-semibold">Keterangan</label>
                <textarea name="keterangan" class="w-full border px-2 py-1 rounded" rows="2"></textarea>
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Simpan
            </button>
        </div>
    </form>

    {{-- TABEL DATA --}}
    {{-- TABEL DATA --}}
    <div class="bg-white p-4 rounded shadow overflow-x-auto">
        <div class="flex justify-between items-center mb-2">
            <h3 class="font-semibold">Riwayat Pembelian</h3>
            <div class="flex gap-2">
                <a href="{{ route('vendor.pembelian.export.pdf') }}"
                    class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                    📄 Export PDF
                </a>
                <a href="{{ route('vendor.pembelian.export.excel') }}"
                    class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">
                    📊 Export Excel
                </a>
            </div>
        </div>

        <table class="min-w-full border text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-2 py-1">#</th>
                    <th class="border px-2 py-1">Tanggal</th>
                    <th class="border px-2 py-1">Bahan</th>
                    <th class="border px-2 py-1">Jumlah</th>
                    <th class="border px-2 py-1">Satuan</th>
                    <th class="border px-2 py-1">Harga/Satuan</th>
                    <th class="border px-2 py-1">Total</th>
                    <th class="border px-2 py-1">Supplier</th>
                    <th class="border px-2 py-1">Faktur</th>
                    <th class="border px-2 py-1">Bukti</th>
                    <th class="border px-2 py-1">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $i => $row)
                    <tr>
                        <td class="border px-2 py-1 text-center">{{ $i + 1 }}</td>
                        <td class="border px-2 py-1">{{ \Carbon\Carbon::parse($row->tanggal)->format('Y-m-d') }}</td>
                        <td class="border px-2 py-1">{{ $row->nama_bahan }}</td>
                        <td class="border px-2 py-1 text-right">{{ $row->jumlah }}</td>
                        <td class="border px-2 py-1">{{ $row->satuan }}</td>
                        <td class="border px-2 py-1">Rp{{ number_format($row->harga_satuan) }}</td>
                        <td class="border px-2 py-1">Rp{{ number_format($row->total_harga) }}</td>
                        <td class="border px-2 py-1">{{ $row->supplier }}</td>
                        <td class="border px-2 py-1">{{ $row->no_faktur ?? '-' }}</td>
                        <td class="border px-2 py-1 text-center">
                            @if ($row->bukti_file)
                                <a href="{{ asset('storage/' . $row->bukti_file) }}" target="_blank"
                                    class="text-blue-600 underline">Lihat</a>
                            @else
                                -
                            @endif
                        </td>
                        <td class="border px-2 py-1 text-center">
                            <form method="POST" action="{{ route('vendor.pembelian.destroy', $row->id) }}"
                                onsubmit="return confirm('Yakin mau hapus?')">
                                @csrf @method('DELETE')
                                <button class="text-red-600 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="border text-center py-2">Belum ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    </div>
@endsection
