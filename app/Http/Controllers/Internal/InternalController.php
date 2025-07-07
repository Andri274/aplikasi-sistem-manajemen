<?php

namespace App\Http\Controllers\Internal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LaporanProduksiVendor;
use App\Models\Karyawan;
use App\Models\SlipGaji;
use App\Models\Absensi;
use App\Models\Marketing;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\KaryawanExport;
use App\Exports\ProduksiExport;
use App\Exports\SlipGajiExport;
use App\Http\Controllers\Vendor\AbsensiController;
use App\Exports\AbsensiExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class InternalController extends Controller
{
    public function index()
    {
        if (!isInternal()) abort(403);

        $totalProduksi = LaporanProduksiVendor::sum('total_produksi');
        $totalKaryawan = Karyawan::count();
        $totalAbsensiHariIni = Absensi::whereDate('tanggal', today())->count();

        // ✅ Ambil 5 Slip Gaji Terbaru
        $slipGajiTerbaru = SlipGaji::with('karyawan')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Data grafik produksi
        $produksi = LaporanProduksiVendor::selectRaw('DATE(tanggal) as tanggal, SUM(total_produksi) as total_per_hari')
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'asc')
            ->get();

        $labels = $produksi->pluck('tanggal');
        $data = $produksi->pluck('total_per_hari');

        return view('internal.index', compact(
            'totalProduksi',
            'totalKaryawan',
            'totalAbsensiHariIni',
            'labels',
            'data',
            'slipGajiTerbaru'
        ));
    }

    public function exportKaryawan()
    {
        return Excel::download(new KaryawanExport, 'Data-Karyawan.xlsx');
    }

    public function exportSlipExcel()
    {
        return Excel::download(new SlipGajiExport, 'Slip-Gaji.xlsx');
    }

    public function exportProduksiExcel()
    {
        return Excel::download(new ProduksiExport, 'Data-Produksi.xlsx');
    }

    public function exportAbsensiExcel()
    {
        return Excel::download(new AbsensiExport, 'Data-Absensi.xlsx');
    }

    public function exportAbsensiPdf()
    {
        $absensi = Absensi::with('karyawan')->orderBy('tanggal', 'desc')->get();
        $pdf = Pdf::loadView('internal.absensi.pdf', compact('absensi'));
        return $pdf->download('Absensi.pdf');
    }

    public function exportProduksiPdf()
    {
        $data = LaporanProduksiVendor::orderBy('tanggal', 'desc')->get();
        $pdf = Pdf::loadView('internal.produksi.pdf', compact('data'));
        return $pdf->download('Laporan-Produksi.pdf');
    }
}
