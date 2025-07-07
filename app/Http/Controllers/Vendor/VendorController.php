<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LaporanProduksiVendor;

class VendorController extends Controller
{
    public function index()
    {
        if (!isVendor() && !isAdmin()) abort(403);

        // Ambil ringkasan dashboard
        $totalProduksi = LaporanProduksiVendor::sum('total_produksi'); // benerin nama kolom
        $laporans = LaporanProduksiVendor::latest()->take(5)->get();   // ambil 5 terakhir

        return view('vendor.index', compact('totalProduksi', 'laporans'));
    }
}
