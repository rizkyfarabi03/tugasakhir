<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Sistem Damkar' }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
</head>
<body class="bg-light">

    @include('layouts.navigation') {{-- Navigation kamu tetap bisa dipakai --}}

    <main class="container py-4">
        @isset($header)
            <div class="bg-white shadow rounded p-3 mb-4">
                {{ $header }}
            </div>
        @endisset

        {{ $slot }}
    </main>

</body>
</html>
