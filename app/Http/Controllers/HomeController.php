<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Damkar;

class HomeController extends Controller
{
    public function index()
    {
    $damkars = Damkar::all();
    $listKecamatan = Damkar::select('kecamatan')->distinct()->pluck('kecamatan');

    return view('home', compact('damkars', 'listKecamatan'));
    }
}
