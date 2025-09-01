<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Spatie\SimpleExcel\SimpleExcelWriter;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Anggota;
use App\Models\Damkar;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    // Export ke Excel
    public function exportExcel()
    {
        $anggota = Anggota::all();
        $path = storage_path('app/public/anggota.xlsx');

        SimpleExcelWriter::create($path)
            ->addRows($anggota->toArray());

        return response()->download($path)->deleteFileAfterSend(true);
    }

    // Export ke PDF
    public function exportPdf()
    {
        $anggota = Anggota::all();
        $pdf = Pdf::loadView('exports.anggota-pdf', compact('anggota'));
        return $pdf->download('anggota.pdf');
    }


    public function index(Request $request)
    {
        $query = Anggota::with('damkar');

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                ->orWhere('nik', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('pos_damkar_id')) {
            $query->where('pos_damkar_id', $request->pos_damkar_id);
        }

        $anggota = $query->paginate(10)->appends($request->all());
        $damkars = Damkar::orderBy('nama_pos')->get();

        return view('anggota.index', compact('anggota', 'damkars'));
    }

    public function create()
    {
        $damkars = Damkar::all();
        $listKecamatan = Damkar::pluck('kecamatan')->unique()->sort()->values();

        return view('anggota.create', compact('damkars', 'listKecamatan'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'nullable|numeric|digits_between:8,20',
            'no_register' => 'required|string|max:100',
            'pos_damkar_id' => 'required|exists:damkars,id',
        ]);

        \App\Models\Anggota::create($request->all());

        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil ditambahkan.');
    }

        public function edit($id)
    {
        $anggota = Anggota::findOrFail($id);
        $damkars = Damkar::orderBy('nama_pos')->get();
        $listKecamatan = Damkar::pluck('kecamatan')->unique()->sort()->values();
        return view('anggota.edit', compact('anggota', 'damkars', 'listKecamatan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'nullable|numeric|digits_between:8,20',
            'no_register' => 'required|string|max:100',
            'pos_damkar_id' => 'required|exists:damkars,id',
        ]);

        $anggota = Anggota::findOrFail($id);
        $anggota->update([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'no_register' => $request->no_register,
            'pos_damkar_id' => $request->pos_damkar_id,
        ]);

        return redirect()->route('anggota.index')->with('success', 'Data anggota berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $damkar = Anggota::findOrFail($id);
        $damkar->delete();

        return redirect()->route('anggota.index')->with('success', 'Data berhasil dihapus.');
    }

}
