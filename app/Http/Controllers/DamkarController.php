<?php

namespace App\Http\Controllers;

use Spatie\SimpleExcel\SimpleExcelWriter;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DamkarExport;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Damkar;
use Illuminate\Http\Request;

class DamkarController extends Controller
{
    public function exportExcel()
    {
        $damkars = Damkar::all();

        // Simpan sementara ke storage
        $path = storage_path('app/public/damkar.xlsx');

        SimpleExcelWriter::create($path)
            ->addRows($damkars->toArray());

        // Kembalikan ke user untuk download
        return response()->download($path)->deleteFileAfterSend(true);
    }

    public function exportPdf()
    {
        $damkars = Damkar::all();
        $pdf = Pdf::loadView('damkar.export-pdf', compact('damkars'));
        return $pdf->download('data-damkar.pdf');
    }
    public function index(Request $request)
    {
        $query = Damkar::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->input('search');
            $query->where('nama_pos', 'like', '%' . $search . '%')
                ->orWhere('alamat', 'like', '%' . $search . '%')
                ->orWhere('kecamatan', 'like', '%' . $search . '%')
                ->orWhere('telepon', 'like', '%' . $search . '%');
        }

        if ($request->filled('kecamatan')) {
        $query->where('kecamatan', $request->kecamatan);
        }   

        $damkars = $query->orderBy('id')->paginate(10)->withQueryString();

        // Ambil daftar kecamatan unik dari data damkar
        $listKecamatan = Damkar::select('kecamatan')->distinct()->pluck('kecamatan');

        return view('pages.data-damkar', compact('damkars', 'listKecamatan'));
    }

    public function create()
    {
        return view('pages.create-damkar');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pos' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'telepon' => 'required|numeric',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        Damkar::create($validated);

        return redirect()->route('pos-damkar.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function getByKecamatan($kecamatan)
    {
        $data = Damkar::where('kecamatan', $kecamatan)
            ->select('id', 'nama_pos')
            ->orderBy('nama_pos')
            ->get();

        return response()->json($data);
    }

    public function edit($id)
    {
        $damkar = Damkar::findOrFail($id);
        return view('pages.edit-damkar', compact('damkar'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_pos' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'telepon' => 'required|numeric',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $damkar = Damkar::findOrFail($id);
        $damkar->update($validated);

        return redirect()->route('pos-damkar.index')->with('success', 'Data berhasil diupdate.');
    }

    public function destroy($id)
    {
        $damkar = Damkar::findOrFail($id);
        $damkar->delete();

        return redirect()->route('pos-damkar.index')->with('success', 'Data berhasil dihapus.');
    }
}
