<?php

namespace App\Http\Controllers\Internal;

use App\Http\Controllers\Controller;
use App\Models\LaporanProduksiVendor;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanProduksiVendorController extends Controller
{
    public function index()
    {
        if (!isInternal()) abort(403);

        // Ambil data + JOIN ke vendor
        $laporans = LaporanProduksiVendor::with('vendor')
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('internal.produksi.index', compact('laporans'));
    }

    public function cetakPDF()
    {
        if (!isInternal()) abort(403);

        // Ambil data untuk PDF
        $laporans = LaporanProduksiVendor::with('vendor')
            ->orderBy('tanggal', 'desc')
            ->get();

        $pdf = Pdf::loadView('internal.produksi.pdf', compact('laporans'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('Rekap-Laporan-Produksi-Vendor.pdf');
    }
}
