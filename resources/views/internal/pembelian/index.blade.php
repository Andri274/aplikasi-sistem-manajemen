@extends('layouts.main')

@section('title', 'Pembelian Bahan Baku')

@section('content')
<div class="container mx-auto px-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Laporan Pembelian Bahan Baku</h1>
        <div class="space-x-2">
            <a href="{{ route('internal.pembelian.export.pdf') }}" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                Export PDF
            </a>
            <a href="{{ route('internal.pembelian.export.excel') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Export Excel
            </a>
        </div>
    </div>

    @if($data->isEmpty())
        <div class="text-center text-gray-500">
            Tidak ada data pembelian.
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($data as $item)
                <div class="bg-white shadow rounded-lg p-4 border">
                    <h2 class="text-lg font-semibold text-gray-800 mb-2">{{ $item->nama_bahan }}</h2>
                    <p class="text-gray-600"><span class="font-medium">Tanggal:</span> {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</p>
                    <p class="text-gray-600"><span class="font-medium">Jumlah:</span> {{ $item->jumlah }} {{ $item->satuan }}</p>
                    <p class="text-gray-600"><span class="font-medium">Harga Satuan:</span> Rp{{ number_format($item->harga_satuan, 0, ',', '.') }}</p>
                    <p class="text-gray-600"><span class="font-medium">Total Harga:</span> Rp{{ number_format($item->total_harga, 0, ',', '.') }}</p>
                    <p class="text-gray-600"><span class="font-medium">Supplier:</span> {{ $item->supplier }}</p>
                    @if($item->no_faktur)
                        <p class="text-gray-600"><span class="font-medium">No Faktur:</span> {{ $item->no_faktur }}</p>
                    @endif
                    @if($item->keterangan)
                        <p class="text-gray-600"><span class="font-medium">Keterangan:</span> {{ $item->keterangan }}</p>
                    @endif
                    @if($item->bukti_file)
                        <p class="mt-2">
                            <a href="{{ asset('storage/' . $item->bukti_file) }}" target="_blank" class="text-blue-600 hover:underline">
                                📎 Lihat Bukti Pembelian
                            </a>
                        </p>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
