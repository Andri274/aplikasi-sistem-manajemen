<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LaporanProduksiVendor;

class LaporanProduksiVendorController extends Controller
{
    public function index()
    {
        if (!isVendor() && !isAdmin()) abort(403);

        $laporans = LaporanProduksiVendor::latest()->get();
        return view('vendor.laporan.index', compact('laporans'));
    }

    public function store(Request $request)
    {
        if (!isVendor() && !isAdmin()) abort(403);

        $data = $request->validate([
            'tanggal' => 'required|date',
            'bahan_baku' => 'required|string',
            'qty_bahan_baku' => 'nullable|numeric',
            'mesin_1' => 'nullable|numeric',
            'mesin_2' => 'nullable|numeric',
            'mesin_3' => 'nullable|numeric',
            'mesin_besar' => 'nullable|numeric',
            'hasil_jadi' => 'nullable|numeric',
            'hasil_cacat' => 'nullable|numeric',
            'catatan' => 'nullable|string',
            'penanggung_jawab' => 'nullable|string',
            'waktu_kerja_tim' => 'nullable|string',
            'target_harian' => 'nullable|numeric',
        ]);

        // Hitung total produksi
        $data['mesin_1'] = $data['mesin_1'] ?? 0;
        $data['mesin_2'] = $data['mesin_2'] ?? 0;
        $data['mesin_3'] = $data['mesin_3'] ?? 0;
        $data['mesin_besar'] = $data['mesin_besar'] ?? 0;

        $data['total_produksi'] = $data['mesin_1'] + $data['mesin_2'] + $data['mesin_3'] + $data['mesin_besar'];

        // Hitung tercapai & belum tercapai
        $hasilJadi = $data['hasil_jadi'] ?? 0;
        $hasilCacat = $data['hasil_cacat'] ?? 0;
        $tercapai = $hasilJadi - $hasilCacat;
        $data['tercapai'] = max($tercapai, 0);
        $data['belum_tercapai'] = max($data['total_produksi'] - $data['tercapai'], 0);

        LaporanProduksiVendor::create($data);

        return redirect()->back()->with('success', 'Laporan berhasil disimpan.');
    }

    public function destroy($id)
    {
        if (!isVendor() && !isAdmin()) abort(403);

        $laporan = LaporanProduksiVendor::findOrFail($id);
        $laporan->delete();

        return redirect()->back()->with('success', 'Laporan berhasil dihapus.');
    }
}
