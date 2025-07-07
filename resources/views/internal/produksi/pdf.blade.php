<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Produksi</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #999;
            padding: 6px;
            text-align: left;
        }

        th {
            background-color: #eee;
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <h2>Laporan Produksi Woodpellet</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Bahan Baku</th>
                <th>Total Produksi</th>
                <th>Mesin 1</th>
                <th>Mesin 2</th>
                <th>Mesin 3</th>
                <th>Mesin Besar</th>
                <th>Qty Bahan</th>
                <th>Hasil Jadi</th>
                <th>PJ</th>
                <th>Catatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $i => $item)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ tanggalIndo($item->tanggal) }}</td>
                    <td>{{ $item->bahan_baku }}</td>
                    <td>{{ $item->total_produksi }}</td>
                    <td>{{ $item->mesin_1 }}</td>
                    <td>{{ $item->mesin_2 }}</td>
                    <td>{{ $item->mesin_3 }}</td>
                    <td>{{ $item->mesin_besar }}</td>
                    <td>{{ $item->qty_bahan_baku }}</td>
                    <td>{{ $item->hasil_jadi }}</td>
                    <td>{{ $item->penanggung_jawab }}</td>
                    <td>{{ $item->catatan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
