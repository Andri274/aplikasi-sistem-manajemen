<?php
namespace App\Http\Controllers\Internal;

use App\Http\Controllers\Controller;
use App\Models\SlipGaji;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RekapSlipGajiExport;
use Illuminate\Http\Request;

class RekapSlipGajiController extends Controller
{
    public function index(Request $request)
    {
        if (!isInternal()) abort(403);

        $slips = SlipGaji::with('karyawan')
            ->when($request->tanggal_mulai && $request->tanggal_selesai, function ($q) use ($request) {
                $q->whereBetween('tanggal_slip', [$request->tanggal_mulai, $request->tanggal_selesai]);
            })
            ->when($request->nama, fn($q) => $q->whereHas('karyawan', fn($k) => $k->where('nama', 'like', "%{$request->nama}%")))
            ->when($request->jabatan, fn($q) => $q->whereHas('karyawan', fn($k) => $k->where('jabatan', $request->jabatan)))
            ->orderBy('tanggal_slip', 'desc')
            ->paginate(20);

        return view('internal.rekap-slip-gaji.index', compact('slips'));
    }

    public function exportPDF(Request $request)
    {
        if (!isInternal()) abort(403);

        $slips = $this->getFilteredSlips($request);

        $pdf = Pdf::loadView('internal.rekap-slip-gaji.pdf', compact('slips'));
        return $pdf->download('Rekap-Slip-Gaji.pdf');
    }

    public function exportExcel(Request $request)
    {
        if (!isInternal()) abort(403);

        $slips = $this->getFilteredSlips($request);

        return Excel::download(new RekapSlipGajiExport($slips), 'Rekap-Slip-Gaji.xlsx');
    }

    private function getFilteredSlips(Request $request)
    {
        return SlipGaji::with('karyawan')
            ->when($request->tanggal_mulai && $request->tanggal_selesai, function ($q) use ($request) {
                $q->whereBetween('tanggal_slip', [$request->tanggal_mulai, $request->tanggal_selesai]);
            })
            ->when($request->nama, fn($q) => $q->whereHas('karyawan', fn($k) => $k->where('nama', 'like', "%{$request->nama}%")))
            ->when($request->jabatan, fn($q) => $q->whereHas('karyawan', fn($k) => $k->where('jabatan', $request->jabatan)))
            ->orderBy('tanggal_slip', 'desc')
            ->get();
    }
}
