<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Damkar;
use Illuminate\Support\Facades\Validator;

class CSVImportController extends Controller
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

            // Validasi data latitude & longitude
            if (empty($rowData['latitude']) || empty($rowData['longitude']) ||
                !is_numeric($rowData['latitude']) || !is_numeric($rowData['longitude'])) {
                $errorMessages[] = "Baris " . ($index + 2) . ": Latitude atau longitude tidak valid.";
                continue;
            }

            // Cek data duplikat
            $existing = Damkar::where('nama_pos', $rowData['nama_pos'])
                              ->where('latitude', $rowData['latitude'])
                              ->where('longitude', $rowData['longitude'])
                              ->first();

            if ($existing) {
                $errorMessages[] = "Baris " . ($index + 2) . ": Data sudah ada, dilewati.";
                continue;
            }

            try {
                // Insert data baru
                Damkar::create([
                    'nama_pos'  => $rowData['nama_pos'],
                    'alamat'    => $rowData['alamat'],
                    'kecamatan' => $rowData['kecamatan'],
                    'telepon'   => $rowData['telepon'] ?? null,
                    'latitude'  => $rowData['latitude'],
                    'longitude' => $rowData['longitude'],
                ]);
                $successCount++;
            } catch (\Exception $e) {
                $errorMessages[] = "Baris " . ($index + 2) . ": Gagal menyimpan data. Error: " . $e->getMessage();
            }
        }

        $message = "Import selesai. Berhasil: $successCount data.";
        if (count($errorMessages) > 0) {
            $message .= " Namun ada error pada beberapa baris:\n" . implode("\n", $errorMessages);
            return back()->with('error', $message);
        }

        return back()->with('success', $message);
    }
}
