<?php

namespace App\Exports;

use App\Models\Damkar;
use Maatwebsite\Excel\Concerns\FromCollection;

class DamkarExport implements FromCollection
{
    public function collection()
    {
        // Data yang akan diexport ke Excel
        return Damkar::all(['nama_pos', 'alamat', 'kecamatan', 'telepon']);
    }
}
