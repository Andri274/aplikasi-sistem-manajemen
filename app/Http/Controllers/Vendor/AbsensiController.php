<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    public function index()
    {
         if (!isVendor() && !isAdmin()) abort(403);


        $karyawans = Karyawan::orderBy('nama')->get();
        $absensis = Absensi::with('karyawan')->latest()->get();

        return view('vendor.absensi.index', compact('karyawans', 'absensis'));
    }

    public function store(Request $request)
{
    if (!isVendor() && !isAdmin()) abort(403);

    $tanggal = $request->tanggal;
    $absensiData = $request->input('absensi', []);

    foreach ($absensiData as $data) {
        // Skip kalau gak ada jam masuk dan jam pulang dan keterangan
        if (empty($data['jam_masuk']) && empty($data['jam_pulang']) && empty($data['keterangan'])) {
            continue;
        }

        Absensi::updateOrCreate(
            [
                'tanggal' => $tanggal,
                'karyawan_id' => $data['karyawan_id'],
            ],
            [
                'jam_masuk' => $data['jam_masuk'] ?? null,
                'jam_pulang' => $data['jam_pulang'] ?? null,
                'keterangan' => $data['keterangan'] ?? null,
            ]
        );
    }

    return back()->with('success', 'Absensi berhasil disimpan.');

}

        
    
}
