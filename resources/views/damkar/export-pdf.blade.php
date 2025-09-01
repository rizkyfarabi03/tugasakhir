<!DOCTYPE html>
<html>
<head>
    <title>Data Damkar</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #333; padding: 6px; text-align: left; font-size: 12px; }
    </style>
</head>
<body>
    <h2>Data Pos Damkar</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pos</th>
                <th>Alamat</th>
                <th>Kecamatan</th>
                <th>Telepon</th>
            </tr>
        </thead>
        <tbody>
            @foreach($damkars as $i => $d)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $d->nama_pos }}</td>
                    <td>{{ $d->alamat }}</td>
                    <td>{{ $d->kecamatan }}</td>
                    <td>{{ $d->telepon }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
