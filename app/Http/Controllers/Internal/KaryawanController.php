<?php

namespace App\Http\Controllers\Internal;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\KaryawanImport;

class KaryawanController extends Controller
{
    public function index()
    {
        if (!isInternal()) abort(403);
        $karyawans = Karyawan::all();
        return view('internal.karyawan.index', compact('karyawans'));
    }

    public function store(Request $request)
    {
        if (!isInternal()) abort(403);

        $request->validate([
            'nama'        => 'required',
            'nik'         => 'required|unique:karyawans',
            'jabatan'     => 'required',
            'no_rekening' => 'nullable|string|max:50',
        ]);

        Karyawan::create($request->only('nama', 'nik', 'jabatan', 'no_rekening'));

        return redirect()->route('internal.karyawan.index')->with('success', 'Berhasil tambah!');
    }

    public function update(Request $request, Karyawan $karyawan)
    {
        if (!isInternal()) abort(403);

        $request->validate([
            'nama'        => 'required',
            'nik'         => 'required|unique:karyawans,nik,' . $karyawan->id,
            'jabatan'     => 'required',
            'no_rekening' => 'nullable|string|max:50',
        ]);

        $karyawan->update($request->only('nama', 'nik', 'jabatan', 'no_rekening'));

        return redirect()->route('internal.karyawan.index')->with('success', 'Berhasil edit!');
    }

    public function destroy(Karyawan $karyawan)
    {
        if (!isInternal()) abort(403);
        $karyawan->delete();
        return redirect()->back()->with('success', 'Berhasil hapus!');
    }

    public function importForm()
    {
        if (!isInternal()) abort(403);
        return view('internal.karyawan.import');
    }

    public function import(Request $request)
    {
        if (!isInternal()) abort(403);

        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        Excel::import(new KaryawanImport, $request->file('file'));

        return redirect()->route('internal.karyawan.index')->with('success', 'Data karyawan berhasil diimport!');
    }
}
