<?php

namespace App\Exports;

use App\Models\LaporanProduksiWoodpellet;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProduksiExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return LaporanProduksiWoodpellet::select([
            'tanggal',
            'bahan_baku',
            'total_produksi',
            'mesin_1',
            'mesin_2',
            'mesin_3',
            'mesin_besar',
            'tercapai_persen',
            'belum_tercapai',
            'waktu_kerja_tim',
            'qty_bahan_baku',
            'hasil_jadi',
            'hasil_cacat',
            'catatan',
            'penanggung_jawab',
        ])->get();
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Bahan Baku',
            'Total Produksi',
            'Mesin 1',
            'Mesin 2',
            'Mesin 3',
            'Mesin Besar',
            '% Tercapai',
            'Belum Tercapai',
            'Waktu Kerja Tim',
            'Qty Bahan Baku',
            'Hasil Jadi',
            'Hasil Cacat',
            'Catatan',
            'Penanggung Jawab',
        ];
    }
}
