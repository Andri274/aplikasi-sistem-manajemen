<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pembelian Bahan Baku</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #999; padding: 8px; text-align: left; }
        th { background-color: #f3f4f6; }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Laporan Pembelian Bahan Baku</h2>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Nama Bahan</th>
                <th>Jumlah</th>
                <th>Satuan</th>
                <th>Harga Satuan</th>
                <th>Total Harga</th>
                <th>Supplier</th>
                <th>No Faktur</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
                <tr>
                    <td>{{ $row->tanggal }}</td>
                    <td>{{ $row->nama_bahan }}</td>
                    <td>{{ $row->jumlah }}</td>
                    <td>{{ $row->satuan }}</td>
                    <td>Rp {{ number_format($row->harga_satuan, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($row->total_harga, 0, ',', '.') }}</td>
                    <td>{{ $row->supplier }}</td>
                    <td>{{ $row->no_faktur }}</td>
                    <td>{{ $row->keterangan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
