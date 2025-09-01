<!DOCTYPE html>
<html>
<head>
    <title>Import Damkar</title>
</head>
<body>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger" style="white-space: pre-wrap;">{{ session('error') }}</div>
    @endif


    <form action="{{ route('import.csv') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="csv_file" accept=".csv" required>
        <button type="submit">Import</button>
    </form>
</body>
</html>
