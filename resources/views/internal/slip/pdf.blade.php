<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Slip Gaji</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            margin: 30px;
            color: #333;
        }

        .header {
            display: flex;
            align-items: flex-start;
            gap: 20px;
        }

        .logo img {
            width: 90px;
        }

        .company-info {
            font-size: 12px;
            line-height: 1.4;
        }

        .company-info h1 {
            font-size: 16px;
            margin: 0 0 4px 0;
        }

        hr {
            border: 1px solid #000;
            margin: 10px 0 20px;
        }

        h2 {
            text-align: center;
            font-size: 18px;
            margin-bottom: 15px;
        }

        .karyawan-info p {
            margin: 2px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        th {
            background-color: #f0f0f0;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .total-box {
            margin-top: 10px;
            font-size: 13px;
            text-align: right;
            font-weight: bold;
            line-height: 1.5;
        }

        .ttd {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
            font-size: 12px;
        }
    </style>
</head>

<body>

    {{-- HEADER --}}
    <div class="header">
        <div class="logo">
            <img src="{{ public_path('logo.png') }}" alt="Logo">
        </div>
        <div class="company-info">
            <h1>
                <span style="color:black;">PT</span>
                <span style="color:#16a34a;">Harimurti</span>
                <span style="color:#f97316;">Bagja</span>
                <span style="color:#16a34a;">Lestari</span>
            </h1>
            <div>
                Gedung Menara 165 Lantai 17 Unit A<br>
                Jl T.B Simatupang Kav .1<br>
                Kel. Cilandak Timur Kec. Pasar Minggu<br>
                Jakarta Selatan, DKI Jakarta 12560<br>
                Telp (021) 38820031
            </div>
        </div>
    </div>

    <hr>
    <h2>SLIP GAJI</h2>

    {{-- IDENTITAS --}}
    <div class="karyawan-info">
        <p><strong>Nama</strong> : {{ $slip->karyawan->nama }}</p>
        <p><strong>NIK</strong> : {{ $slip->karyawan->nik }}</p>
        <p><strong>Jabatan</strong> : {{ $slip->karyawan->jabatan }}</p>
        <p><strong>Periode</strong> : {{ \Carbon\Carbon::parse($slip->periode_mulai)->format('d M Y') }} –
            {{ \Carbon\Carbon::parse($slip->periode_selesai)->format('d M Y') }}</p>
        <p><strong>Minggu Ke</strong> : {{ \Carbon\Carbon::parse($slip->periode_mulai)->weekOfMonth }}</p>
        <p><strong>No Rekening</strong> : {{ $slip->rekening ?? '-' }}</p>

    </div>

    {{-- TABEL PENDAPATAN --}}
    <h4 style="margin-top: 20px;">Pendapatan</h4>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Komponen Gaji</th>
                <th>Masuk</th>
                <th>Nilai</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @php $totalPendapatan = 0; @endphp
            @foreach ($slip->detailGajis->where('tipe', 'pendapatan') as $i => $d)
                @php $jumlah = ($d->nilai ?? 0) * ($d->jumlah ?? 0); @endphp
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $d->nama_komponen }}</td>
                    <td>{{ $d->jumlah }} {{ $d->satuan }}</td>
                    <td class="text-right">Rp{{ number_format($d->nilai, 0, ',', '.') }}</td>
                    <td class="text-right">Rp{{ number_format($jumlah, 0, ',', '.') }}</td>
                    <td>{{ $d->keterangan }}</td>
                </tr>
                @php $totalPendapatan += $jumlah; @endphp
            @endforeach
        </tbody>
    </table>

    {{-- TABEL POTONGAN --}}
    <h4 style="margin-top: 20px;">Potongan</h4>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Jenis Potongan</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @php $totalPotongan = 0; @endphp
            @forelse ($slip->detailGajis->where('tipe', 'potongan') as $i => $p)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $p->nama_komponen }}</td>
                    <td class="text-right">Rp{{ number_format($p->nilai, 0, ',', '.') }}</td>
                    <td>{{ $p->keterangan }}</td>
                </tr>
                @php $totalPotongan += $p->nilai; @endphp
            @empty
                <tr>
                    <td colspan="4" class="text-center">Tidak ada potongan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- TOTAL --}}
    <div class="total-box">
        Total Pendapatan: Rp{{ number_format($totalPendapatan, 0, ',', '.') }}<br>
        Total Potongan: Rp{{ number_format($totalPotongan, 0, ',', '.') }}<br>
        Gaji Bersih: Rp{{ number_format($totalPendapatan - $totalPotongan, 0, ',', '.') }}
    </div>

    {{-- TTD --}}
    <table style="width: 100%; margin-top: 50px; border-collapse: collapse;">
        <tr>
            <td style="border: none; text-align: left;">
                Mengetahui,<br><br><br><br>
                ____________________
            </td>
            <td style="border: none; text-align: right;">
                Keuangan,<br><br><br><br>
                ____________________
            </td>
        </tr>
    </table>


</body>

</html>
