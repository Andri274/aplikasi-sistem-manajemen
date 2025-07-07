<?php

namespace App\Exports;

use App\Models\SlipGaji;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SlipGajiExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return SlipGaji::with('karyawan')->get()->map(function ($slip) {
            return [
                'Nama'      => $slip->karyawan->nama,
                'NIK'       => $slip->karyawan->nik,
                'no_rekening'   => $slip->karyawan->no_rekening,
                'Jabatan'   => $slip->karyawan->jabatan,
                'Periode'   => $slip->periode_mulai . ' s/d ' . $slip->periode_selesai,
                'Gaji Bersih' => number_format($slip->total_bersih),
            ];
        });
    }

    public function headings(): array
    {
        return ['Nama', 'NIK', 'Jabatan', 'Periode', 'Gaji Bersih'];
    }
}
