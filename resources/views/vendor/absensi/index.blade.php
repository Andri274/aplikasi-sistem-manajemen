@extends('layouts.vendor')

@section('content')
    <div class="max-w-6xl mx-auto p-6 bg-white rounded shadow">
        <h2 class="text-xl font-bold mb-4">Absensi Harian - {{ now()->translatedFormat('l, d F Y') }}</h2>
        @if (session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('vendor.absensi.store') }}" method="POST" class="mb-6">
            @csrf
            <input type="date" name="tanggal" class="border px-3 py-1 rounded" required>

            <table class="w-full mt-4 text-sm border">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-2 py-1">Nama</th>
                        <th class="border px-2 py-1">Jam Masuk</th>
                        <th class="border px-2 py-1">Jam Pulang</th>
                        <th class="border px-2 py-1">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($karyawans as $karyawan)
                        <tr>
                            <td class="border px-2 py-1">{{ $karyawan->nama }}</td>
                            <td class="border px-2 py-1">
                                <input type="time" name="absensi[{{ $karyawan->id }}][jam_masuk]"
                                    class="border px-2 py-1 w-full">
                            </td>
                            <td class="border px-2 py-1">
                                <input type="time" name="absensi[{{ $karyawan->id }}][jam_pulang]"
                                    class="border px-2 py-1 w-full">
                            </td>
                            <td class="border px-2 py-1">
                                <input type="text" name="absensi[{{ $karyawan->id }}][keterangan]"
                                    class="border px-2 py-1 w-full">
                                <input type="hidden" name="absensi[{{ $karyawan->id }}][karyawan_id]"
                                    value="{{ $karyawan->id }}">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <button type="submit" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded">Simpan Absensi</button>
        </form>
        <h3 class="text-lg font-bold mb-2">Riwayat Absensi Terbaru</h3>

        <table class="w-full border text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-2 py-1">Tanggal</th>
                    <th class="border px-2 py-1">Nama</th>
                    <th class="border px-2 py-1">Masuk</th>
                    <th class="border px-2 py-1">Pulang</th>
                    <th class="border px-2 py-1">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($absensis as $absen)
                    <tr>
                        <td class="border px-2 py-1">{{ $absen->tanggal }}</td>
                        <td class="border px-2 py-1">{{ $absen->karyawan->nama }}</td>
                        <td class="border px-2 py-1">
                            {{ $absen->jam_masuk ? \Carbon\Carbon::parse($absen->jam_masuk)->format('H:i') : '-' }}
                        </td>
                        <td class="border px-2 py-1">
                            {{ $absen->jam_pulang ? \Carbon\Carbon::parse($absen->jam_pulang)->format('H:i') : '-' }}
                        </td>

                        <td class="border px-2 py-1">{{ $absen->keterangan ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection
