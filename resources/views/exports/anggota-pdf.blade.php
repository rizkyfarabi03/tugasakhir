<h3>Data Anggota</h3>
<table border="1" cellpadding="5" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>NIK</th>
            <th>No Register</th>
            <th>Pos Damkar</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($anggota as $a)
            <tr>
                <td>{{ $a->id }}</td>
                <td>{{ $a->nama }}</td>
                <td>{{ $a->nik }}</td>
                <td>{{ $a->no_register }}</td>
                <td>{{ $a->posDamkar->nama_pos ?? '-' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
