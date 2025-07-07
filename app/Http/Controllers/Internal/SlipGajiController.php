<?php

namespace App\Http\Controllers\Internal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SlipGaji;
use App\Models\DetailGaji;
use App\Models\Karyawan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PDF;

class SlipGajiController extends Controller
{
    public function index()
    {
        if (!isInternal()) abort(403);
        $karyawans = Karyawan::all();
        $slips = SlipGaji::with('karyawan')->latest()->get();
        return view('internal.slip.index', compact('karyawans', 'slips'));
    }

    public function create()
    {
        if (!isInternal()) abort(403);
        $karyawans = Karyawan::all();
        return view('internal.slip.create', compact('karyawans'));
    }

    public function store(Request $request)
    {
        if (!isInternal()) abort(403);

        $request->validate([
            'karyawan_id'     => 'required|exists:karyawans,id',
            'periode_mulai'   => 'required|date',
            'periode_selesai' => 'required|date|after_or_equal:periode_mulai',
            'rekening'        => 'required|string|max:100',
        ]);

        DB::beginTransaction();
        try {
            $slip = SlipGaji::create([
                'karyawan_id'       => $request->karyawan_id,
                'periode_mulai'     => $request->periode_mulai,
                'periode_selesai'   => $request->periode_selesai,
                'total_pendapatan'  => 0,
                'total_potongan'    => 0,
                'total_bersih'      => 0,
                'rekening'          => $request->rekening,
            ]);

            $totalPendapatan = 0;
            foreach ($request->pendapatan ?? [] as $pendapatan) {
                $subtotal = $pendapatan['nilai'] * $pendapatan['jumlah'];
                $totalPendapatan += $subtotal;

                DetailGaji::create([
                    'slip_gaji_id'   => $slip->id,
                    'nama_komponen'  => $pendapatan['nama_komponen'],
                    'jumlah'         => $pendapatan['jumlah'],
                    'satuan'         => $pendapatan['satuan'],
                    'nilai'          => $pendapatan['nilai'],
                    'tipe'           => 'pendapatan',
                    'keterangan'     => $pendapatan['keterangan'],
                ]);
            }

            $totalPotongan = 0;
            foreach ($request->potongan ?? [] as $potongan) {
                $totalPotongan += $potongan['nilai'];

                DetailGaji::create([
                    'slip_gaji_id'   => $slip->id,
                    'nama_komponen'  => $potongan['nama_komponen'],
                    'nilai'          => $potongan['nilai'],
                    'tipe'           => 'potongan',
                    'keterangan'     => $potongan['keterangan'],
                ]);
            }

            $slip->update([
                'total_pendapatan' => $totalPendapatan,
                'total_potongan'   => $totalPotongan,
                'total_bersih'     => $totalPendapatan - $totalPotongan,
            ]);

            DB::commit();
            return redirect()->route('slip.index')->with('success', 'Slip gaji berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal menyimpan slip gaji.'])->withInput();
        }
    }

    public function show($id)
    {
        if (!isInternal()) abort(403);
        $slip = SlipGaji::with(['karyawan', 'detailGajis'])->findOrFail($id);
        return view('slip.index', compact('slip'));
    }

    public function destroy($id)
    {
        if (!isInternal()) abort(403);
        $slip = SlipGaji::findOrFail($id);
        $slip->delete();
        return redirect()->route('slip.index')->with('success', 'Slip berhasil dihapus');
    }

    public function cetak($id)
    {
        if (!isInternal()) abort(403);
        $slip = SlipGaji::with(['karyawan', 'detailGajis'])->findOrFail($id);

        $periodeText = \Carbon\Carbon::parse($slip->periode_mulai)->format('d') .
            '–' . \Carbon\Carbon::parse($slip->periode_selesai)->translatedFormat('d F Y');
        $mingguKe = \Carbon\Carbon::parse($slip->periode_mulai)->weekOfMonth;

        return \PDF::loadView('internal.slip.pdf', compact('slip', 'periodeText', 'mingguKe'))
            ->stream('Slip-Gaji-' . $slip->karyawan->nama . '.pdf');
    }
}