<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;

class AnggotaImportController extends Controller
{
    public function import(Request $request)
    {
        set_time_limit(300);

        $request->validate([
            'csv_file' => 'required|mimes:csv,txt',
        ]);

        $file = $request->file('csv_file');
        $csvData = array_map('str_getcsv', file($file));
        $header = array_map('strtolower', $csvData[0]);
        unset($csvData[0]);

        $successCount = 0;
        $errorMessages = [];

        foreach ($csvData as $index => $row) {
            $rowData = array_combine($header, $row);

            // Validasi minimal: pos_damkar_id dan nama wajib
            if (empty($rowData['pos_damkar_id']) || empty($rowData['nama'])) {
                $errorMessages[] = "Baris " . ($index + 2) . ": Pos Damkar ID dan Nama wajib diisi.";
                continue;
            }

            // Kalau NIK ada → cek duplikat NIK
            if (!empty($rowData['nik'])) {
                $existing = Anggota::where('nik', $rowData['nik'])->first();
                if ($existing) {
                    $errorMessages[] = "Baris " . ($index + 2) . ": NIK sudah ada.";
                    continue;
                }
            } else {
                // Kalau NIK kosong → cek duplikat berdasarkan pos_damkar_id + nama
                $existing = Anggota::where('pos_damkar_id', $rowData['pos_damkar_id'])
                    ->where('nama', $rowData['nama'])
                    ->first();
                if ($existing) {
                    $errorMessages[] = "Baris " . ($index + 2) . ": Anggota dengan nama '{$rowData['nama']}' sudah ada di Pos Damkar ID {$rowData['pos_damkar_id']}.";
                    continue;
                }
            }

            try {
                Anggota::create([
                    'pos_damkar_id' => $rowData['pos_damkar_id'],
                    'nama'          => $rowData['nama'],
                    'nik'           => $rowData['nik'] ?? null,
                    'no_register'   => $rowData['no_register'] ?? null,
                ]);
                $successCount++;
            } catch (\Exception $e) {
                $errorMessages[] = "Baris " . ($index + 2) . ": Error simpan data: " . $e->getMessage();
            }
        }

        $message = "Import selesai. Berhasil: $successCount data.";
        if (count($errorMessages) > 0) {
            $message .= " Ada error:\n" . implode("\n", $errorMessages);
            return back()->with('error', $message);
        }

        return back()->with('success', $message);
    }

    public function form()
    {
        return view('import.form');
    }
}


