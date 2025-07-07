<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rekap Slip Gaji</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        h2 { text-align: center; }
        .periode { margin-top: 10px; }
    </style>
</head>
<body>
    <h2>Rekap Slip Gaji</h2>
    <p class="periode">
        Periode: {{ request('tanggal_mulai') }} s/d {{ request('tanggal_selesai') }}
    </p>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Karyawan</th>
                <th>Jabatan</th>
                <th>Periode</th>
                <th>Total Gaji Bersih</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($slips as $index => $slip)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $slip->karyawan->nama }}</td>
                <td>{{ $slip->karyawan->jabatan }}</td>
                <td>{{ $slip->tanggal_slip->format('F Y') }}</td>
                <td>Rp {{ number_format($slip->total_gaji_bersih, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
