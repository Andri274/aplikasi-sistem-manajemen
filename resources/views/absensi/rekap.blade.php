@extends('layouts.main')

@section('content')
    <div class="container mt-4">
        <h4>Rekap Absensi Per Minggu</h4>

        <form method="GET" class="mb-3">
            <label>Pilih Minggu:</label>
            <input type="date" name="tanggal" class="form-control d-inline w-auto" value="{{ $tanggal }}">
            <button class="btn btn-primary">Tampilkan</button>
        </form>

        <p><strong>Periode:</strong> {{ $start->format('d M Y') }} - {{ $end->format('d M Y') }}</p>

        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Hadir</th>
                    <th>Izin</th>
                    <th>Sakit</th>
                    <th>Alpha</th>
                    <th>Total Hari</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rekap as $row)
                    <tr>
                        <td>{{ $row['nama'] }}</td>
                        <td>{{ $row['hadir'] }}</td>
                        <td>{{ $row['izin'] }}</td>
                        <td>{{ $row['sakit'] }}</td>
                        <td>{{ $row['alpha'] }}</td>
                        <td>{{ $row['total'] }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data absensi minggu ini.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
