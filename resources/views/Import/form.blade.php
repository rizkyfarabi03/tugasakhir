<!DOCTYPE html>
<html>
<head>
    <title>Import Anggota</title>
</head>
<body>
    <h2>Upload CSV Anggota</h2>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if(session('error'))
        <p style="color: red; white-space: pre-line;">{{ session('error') }}</p>
    @endif

    <form action="/import-anggota" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="csv_file" accept=".csv" required>
        <button type="submit">Import</button>
    </form>
</body>
</html>
