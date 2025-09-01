<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Damkar;

class StatistikController extends Controller
{
    public function index(Request $request)
    {
        // Ambil data statistik agregat per kecamatan (untuk chart)
        $data = Damkar::selectRaw('kecamatan, COUNT(*) as total')
                    ->groupBy('kecamatan')
                    ->get();

        $labels = $data->pluck('kecamatan');
        $values = $data->pluck('total');

        // Ambil list kecamatan unik untuk dropdown
        $list_kecamatan = Damkar::select('kecamatan')->distinct()->pluck('kecamatan');

        // Filter data damkar berdasarkan kecamatan (jika ada)
        $damkars = Damkar::withCount('anggota')
            ->when($request->kecamatan, function ($query) use ($request) {
                $query->where('kecamatan', $request->kecamatan);
            })
            ->paginate(10);

        return view('statistik.index', compact('labels', 'values', 'damkars', 'data', 'list_kecamatan'));
    }
   public function filter(Request $request)
    {
    $damkars = Damkar::withCount('anggota')
    ->when($request->kecamatan, fn($q) => $q->where('kecamatan', $request->kecamatan))
    ->paginate(10);

    // Render isi tabel dan pagination
    $table = view('statistik.partial-table', compact('damkars'))->render();
    $pagination = $damkars->withQueryString()->links('pagination::bootstrap-5')->render();

    return response()->json([
        'table' => $table,
        'pagination' => $pagination,
    ]);
}

}
