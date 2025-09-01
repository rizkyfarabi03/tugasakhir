<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Damkar;


class AdminController extends Controller
{
    public function dashboard()
    {
    $perKecamatan = Damkar::selectRaw('kecamatan, COUNT(*) as total')
        ->groupBy('kecamatan')
        ->pluck('total', 'kecamatan'); // hasil: ['Banjarmasin Timur' => 3, dst]

    return view('admin.dashboard', compact('perKecamatan'));
}
}
