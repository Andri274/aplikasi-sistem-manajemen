@extends('layouts.main')

@section('content')
    <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-4">Detail Slip Gaji</h2>

        {{-- Informasi Karyawan --}}
        <div class="mb-4">
            <p><strong>Nama:</strong> {{ $slip->karyawan->nama }}</p>
            <p><strong>NIK:</strong> {{ $slip->karyawan->nik }}</p>
            <p><strong>Jabatan:</strong> {{ $slip->karyawan->jabatan }}</p>
            <p><strong>Periode:</strong> {{ tanggalIndo($slip->periode_mulai) }} - {{ tanggalIndo($slip->periode_selesai) }}
            </p>
        </div>

        {{-- Rincian Komponen --}}
        <div class="mb-6">
            <h3 class="font-semibold mb-2">Rincian Komponen</h3>

            @if ($slip->detailGajis->isEmpty())
                <p class="text-gray-600 italic">Tidak ada data komponen</p>
            @else
                <table class="w-full border border-gray-300 text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border p-2">Nama Komponen</th>
                            <th class="border p-2">Tipe</th>
                            <th class="border p-2">Keterangan</th>
                            <th class="border p-2">Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($slip->detailGajis as $detail)
                            <tr>
                                <td class="border p-2">{{ $detail->nama_komponen }}</td>
                                <td class="border p-2">{{ ucfirst($detail->tipe ?? '-') }}</td>
                                <td class="border p-2">{{ $detail->keterangan ?? '-' }}</td>
                                <td class="border p-2 text-right">Rp{{ number_format($detail->nilai, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        {{-- Total --}}
        <div class="bg-gray-50 p-4 rounded border">
            <p><strong>Total Pendapatan:</strong> Rp{{ number_format($slip->total_pendapatan, 0, ',', '.') }}</p>
            <p><strong>Total Potongan:</strong> Rp{{ number_format($slip->total_potongan, 0, ',', '.') }}</p>
            <p><strong>Total Bersih:</strong> Rp{{ number_format($slip->total_bersih, 0, ',', '.') }}</p>
        </div>

        <div class="mt-6">
            <a href="{{ route('slip.index') }}" class="text-sm text-blue-600 hover:underline">← Kembali ke daftar</a>
        </div>
    </div>
@endsection
