<?php

namespace App\Http\Controllers\Internal;

use App\Http\Controllers\Controller;
use App\Models\Absensi;

class AbsensiController extends Controller
{
    public function index()
    {
        if (!isInternal()) abort(403);

        $absensis = Absensi::with('karyawan')->latest()->paginate(10);
        return view('internal.absensi.index', compact('absensis'));
    }
}
