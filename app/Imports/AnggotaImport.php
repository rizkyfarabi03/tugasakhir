<?php

namespace App\Imports;

use App\Models\Anggota;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AnggotaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Anggota([
            'pos_damkar_id' => $row['pos_damkar_id'],
            'nama'          => $row['nama'],
            'nik' => $row['nik'] ?? null, // default null kalau tidak ada
            'no_register'   => $row['no_register'],
        ]);
    }
}
