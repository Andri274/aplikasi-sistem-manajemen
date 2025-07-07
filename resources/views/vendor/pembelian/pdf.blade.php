<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Pembelian</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 4px;
            text-align: left;
        }
    </style>
</head>

<body>
    <h2>Laporan Pembelian Bahan Baku</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Tanggal</th>
                <th>Bahan</th>
                <th>Jumlah</th>
                <th>Satuan</th>
                <th>Harga/Sat</th>
                <th>Total</th>
                <th>Supplier</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $i => $d)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $d->tanggal }}</td>
                    <td>{{ $d->nama_bahan }}</td>
                    <td>{{ $d->jumlah }}</td>
                    <td>{{ $d->satuan }}</td>
                    <td>Rp{{ number_format($d->harga_satuan) }}</td>
                    <td>Rp{{ number_format($d->total_harga) }}</td>
                    <td>{{ $d->supplier }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
