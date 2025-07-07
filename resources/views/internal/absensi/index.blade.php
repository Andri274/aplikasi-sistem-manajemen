{{-- internal/absensi/index.blade.php --}}
@extends('layouts.main')

@section('title', 'Data Absensi Karyawan')

@section('content')
    <div class="space-y-6">
        <h1 class="text-xl font-bold text-gray-800">Rekap Absensi</h1>

        <div class="bg-white shadow rounded-xl p-6">
            <table class="w-full border">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border p-2">Tanggal</th>
                        <th class="border p-2">Nama</th>
                        <th class="border p-2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($absensis as $absen)
                        <tr>
                            <td class="border p-2">{{ \Carbon\Carbon::parse($absen->tanggal)->format('d M Y') }}</td>
                            <td class="border p-2">{{ $absen->karyawan->nama }}</td>
                            <td class="border p-2">{{ $absen->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
