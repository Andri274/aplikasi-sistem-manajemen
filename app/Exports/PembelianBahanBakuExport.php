<?php

namespace App\Exports;

use App\Models\PembelianBahanBaku;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PembelianBahanBakuExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return PembelianBahanBaku::select(
            'tanggal',
            'nama_bahan',
            'jumlah',
            'satuan',
            'harga_satuan',
            'total_harga',
            'supplier',
            'no_faktur',
            'keterangan'
        )->get();
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Nama Bahan',
            'Jumlah',
            'Satuan',
            'Harga/Satuan',
            'Total Harga',
            'Supplier',
            'No Faktur',
            'Keterangan'
        ];
    }
}
