<?php

namespace App\Exports;

use App\Models\Absensi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AbsensiExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Absensi::with('karyawan')->orderBy('tanggal', 'desc')->get();
    }

    public function headings(): array
    {
        return ['Nama', 'Tanggal', 'Jam Masuk', 'Jam Pulang', 'Keterangan'];
    }

    public function map($absensi): array
    {
        return [
            $absensi->karyawan->nama ?? '-',  // Nama Karyawan
            $absensi->tanggal,
            $absensi->jam_masuk ?? '-',
            $absensi->jam_pulang ?? '-',
            $absensi->keterangan ?? '-',
        ];
    }

    public function exportAbsensiPdf()
{
    $absensis = Absensi::with('karyawan')->orderByDesc('tanggal')->get();
    $pdf = PDF::loadView('internal.absensi.pdf', compact('absensis'));
    return $pdf->download('laporan-absensi.pdf');
}

}
