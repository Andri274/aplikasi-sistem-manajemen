<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Marketing</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 5px;
            text-align: left;
        }

        th {
            background-color: #f0f0f0;
        }

        .total {
            margin-top: 15px;
            text-align: right;
        }
    </style>
</head>

<body>
    <h2>Laporan Marketing</h2>
    <p>Tanggal cetak: {{ now()->format('d-m-Y H:i') }}</p>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Tanggal</th>
                <th>Customer</th>
                <th>Komoditi</th>
                <th>Budget</th>
                <th>Qty</th>
                <th>Price+Delivery</th>
                <th>Margin</th>
                <th>Payment Terms</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $i => $row)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $row->tanggal }}</td>
                    <td>{{ $row->nama_customer }}</td>
                    <td>{{ $row->nama_komoditi }}</td>
                    <td>Rp {{ number_format($row->budget, 0, ',', '.') }}</td>
                    <td>{{ $row->qty }}</td>
                    <td>Rp {{ number_format($row->price_with_delivery, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($row->margin, 0, ',', '.') }}</td>
                    <td>{{ $row->payment_of_terms }}</td>
                    <td>{{ $row->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        <p><strong>Total Budget:</strong> Rp {{ number_format($totalBudget, 0, ',', '.') }}</p>
        <p><strong>Total Qty:</strong> {{ $totalQty }}</p>
        <p><strong>Total Margin:</strong> Rp {{ number_format($totalMargin, 0, ',', '.') }}</p>
    </div>
</body>

</html>
