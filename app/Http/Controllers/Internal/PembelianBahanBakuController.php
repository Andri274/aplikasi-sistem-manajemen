<?php

namespace App\Http\Controllers\Internal;

use App\Http\Controllers\Controller;
use App\Models\PembelianBahanBaku;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PembelianBahanBakuExport;

class PembelianBahanBakuController extends Controller
{
    public function index()
    {
        if (!isAdmin()) abort(403);

        $data = PembelianBahanBaku::latest()->get();
        return view('internal.pembelian.index', compact('data'));
    }

    public function exportPdf()
    {
        $data = PembelianBahanBaku::latest()->get();
        $pdf = Pdf::loadView('internal.pembelian.pdf', compact('data'))->setPaper('a4', 'landscape');
        return $pdf->download('laporan_pembelian_internal.pdf');
    }

    public function exportExcel()
    {
        return Excel::download(new PembelianBahanBakuExport, 'laporan_pembelian_internal.xlsx');
    }
}
