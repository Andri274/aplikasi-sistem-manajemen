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
                <td>{{ $slip->total_gaji_bersih }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
