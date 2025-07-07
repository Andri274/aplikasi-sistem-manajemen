<?php

namespace App\Exports;

use App\Models\Marketing;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class MarketingExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Marketing::orderBy('tanggal', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            '#',
            'Tanggal',
            'Customer',
            'Komoditi',
            'Budget',
            'Qty',
            'Price+Delivery',
            'Margin',
            'Payment Terms',
            'Status',
        ];
    }

    public function map($row): array
    {
        static $i = 1;
        return [
            $i++,
            $row->tanggal,
            $row->nama_customer,
            $row->nama_komoditi,
            number_format($row->budget, 0, ',', '.'),
            $row->qty,
            number_format($row->price_with_delivery, 0, ',', '.'),
            number_format($row->margin, 0, ',', '.'),
            $row->payment_of_terms,
            $row->status,
        ];
    }
}
