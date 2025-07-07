<?php

namespace App\Http\Controllers\Internal;


use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MarketingExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Marketing;

class MarketingController extends Controller
{
    public function __construct()
    {
        if (!isAdmin()) abort(403);
    }

    public function index()
    {
        $data = Marketing::orderBy('tanggal', 'desc')->get();
        $totalBudget = $data->sum('budget');
        $totalQty = $data->sum('qty');
        $totalMargin = $data->sum('margin');

        return view('internal.marketing.index', compact('data', 'totalBudget', 'totalQty', 'totalMargin'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'nama_customer' => 'nullable|string|max:255',
            'nama_komoditi' => 'nullable|string|max:255',
            'budget' => 'nullable|numeric|min:0',
            'qty' => 'nullable|numeric|min:0',
            'source' => 'nullable|string|max:255',
            'price_source' => 'nullable|numeric|min:0',
            'tracking' => 'nullable|numeric|min:0',
            'payment_of_terms' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',
        ]);

        $validated['price_with_delivery'] = ($validated['price_source'] ?? 0) + ($validated['tracking'] ?? 0);
        $validated['margin'] = ($validated['budget'] ?? 0) - $validated['price_with_delivery'];

        Marketing::create($validated);

        return redirect()->route('internal.marketing.index')->with('success', 'Data marketing berhasil disimpan.');
    }

    public function edit($id)
    {
        $data = Marketing::orderBy('tanggal', 'desc')->get();
        $editing = Marketing::findOrFail($id);
        $totalBudget = $data->sum('budget');
        $totalQty = $data->sum('qty');
        $totalMargin = $data->sum('margin');

        return view('internal.marketing.index', compact('data', 'editing', 'totalBudget', 'totalQty', 'totalMargin'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'nama_customer' => 'nullable|string|max:255',
            'nama_komoditi' => 'nullable|string|max:255',
            'budget' => 'nullable|numeric|min:0',
            'qty' => 'nullable|numeric|min:0',
            'source' => 'nullable|string|max:255',
            'price_source' => 'nullable|numeric|min:0',
            'tracking' => 'nullable|numeric|min:0',
            'payment_of_terms' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',
        ]);

        $validated['price_with_delivery'] = ($validated['price_source'] ?? 0) + ($validated['tracking'] ?? 0);
        $validated['margin'] = ($validated['budget'] ?? 0) - $validated['price_with_delivery'];

        $marketing = Marketing::findOrFail($id);
        $marketing->update($validated);

        return redirect()->route('internal.marketing.index')->with('success', 'Data marketing berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $marketing = Marketing::findOrFail($id);
        $marketing->delete();

        return redirect()->route('internal.marketing.index')->with('success', 'Data marketing berhasil dihapus.');
    }

    public function exportPdf()
    {
        $data = Marketing::orderBy('tanggal', 'desc')->get();
        $totalBudget = $data->sum('budget');
        $totalQty = $data->sum('qty');
        $totalMargin = $data->sum('margin');

        $pdf = Pdf::loadView('internal.marketing.pdf', compact('data', 'totalBudget', 'totalQty', 'totalMargin'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('laporan_marketing_' . now()->format('Ymd_His') . '.pdf');
    }

    public function exportExcel()
    {
        return Excel::download(new MarketingExport, 'laporan_marketing_' . now()->format('Ymd_His') . '.xlsx');
    }
}
