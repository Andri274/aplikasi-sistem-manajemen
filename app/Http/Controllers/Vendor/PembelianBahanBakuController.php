<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\PembelianBahanBaku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PembelianBahanBakuExport;


class PembelianBahanBakuController extends Controller
{
    public function index()
    {
         if (!isVendor() && !isAdmin()) abort(403);


        $data = PembelianBahanBaku::latest()->get();
        return view('vendor.pembelian.index', compact('data'));
    }

    public function store(Request $request)
    {       
        // dd(Auth::user());
        if (Auth::user()->role !== 'vendor') abort(403);

        $validated = $request->validate([
            'tanggal' => 'required|date',
            'nama_bahan' => 'required|string',
            'jumlah' => 'required|numeric',
            'satuan' => 'required|string',
            'harga_satuan' => 'required|integer',
            'supplier' => 'required|string',
            'no_faktur' => 'nullable|string',
            'bukti_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'keterangan' => 'nullable|string',
        ]);

        $validated['total_harga'] = $validated['jumlah'] * $validated['harga_satuan'];

        if ($request->hasFile('bukti_file')) {
            $validated['bukti_file'] = $request->file('bukti_file')->store('bukti_pembelian', 'public');
        }

        PembelianBahanBaku::create($validated);

        return redirect()->route('vendor.pembelian.index')->with('success', 'Data pembelian berhasil disimpan.');
    }

    public function destroy($id)
    {
        if (Auth::user()->role !== 'vendor') abort(403);

        $data = PembelianBahanBaku::findOrFail($id);

        if ($data->bukti_file) {
            Storage::disk('public')->delete($data->bukti_file);
        }

        $data->delete();

        return redirect()->route('vendor.pembelian.index')->with('success', 'Data berhasil dihapus.');
    }

    public function exportPdf()
    {
         if (!isVendor() && !isAdmin()) abort(403);


        $data = PembelianBahanBaku::latest()->get();
        $pdf = Pdf::loadView('vendor.pembelian.pdf', compact('data'));
        return $pdf->download('laporan_pembelian_vendor.pdf');
    }

    public function exportExcel()
    {
         if (!isVendor() && !isAdmin()) abort(403);


        return Excel::download(new PembelianBahanBakuExport, 'laporan_pembelian_vendor.xlsx');
    }
}
