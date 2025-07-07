<?php
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RekapSlipGajiExport implements FromView
{
    protected $slips;

    public function __construct($slips)
    {
        $this->slips = $slips;
    }

    public function view(): View
    {
        return view('internal.rekap-slip-gaji.excel', [
            'slips' => $this->slips
        ]);
    }
}
