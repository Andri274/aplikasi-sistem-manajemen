@extends('layouts.main')

@section('title', 'Laporan Produksi Vendor')

@section('content')
    <h1 class="text-xl font-bold mb-4">📦 Laporan Produksi Vendor</h1>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded shadow">
            <thead class="bg-gray-100 text-left">
                <tr>
                    <th class="p-2">Tanggal</th>
                    <th class="p-2">Vendor</th>
                    <th class="p-2">Hasil Jadi</th>
                    <th class="p-2">Cacat</th>
                    <th class="p-2">Total Produksi</th>
                    <th class="p-2">Penanggung Jawab</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($laporans as $laporan)
                    <tr class="border-b">
                        <td class="p-2">{{ \Carbon\Carbon::parse($laporan->tanggal)->format('d M Y') }}</td>
                        <td class="p-2">{{ $laporan->vendor->nama ?? '-' }}</td>
                        <td class="p-2">{{ number_format($laporan->hasil_jadi, 0) }} Kg</td>
                        <td class="p-2">{{ number_format($laporan->hasil_cacat, 0) }} Kg</td>
                        <td class="p-2">{{ number_format($laporan->total_produksi, 0) }} Kg</td>
                        <td class="p-2">{{ $laporan->penanggung_jawab }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-2 text-center text-gray-500">Belum ada data produksi vendor.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
