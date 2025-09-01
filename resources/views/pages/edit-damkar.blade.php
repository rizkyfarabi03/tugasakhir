@extends('admin.create') {{-- Menggunakan layout dashboard --}}

@section('title', 'Edit Data Damkar')

@section('content')
    <div class="p-4">
        <form action="{{ route('pos-damkar.update', $damkar->id) }}" method="POST" class="max-w-xl">
            @csrf
            @method('PUT')

            <h4 class="mb-4">Edit Data Pemadam Kebakaran</h4>
            <div class="mb-4">
                <label class="block font-medium text-white mb-1">Nama Pos</label>
                <input type="text" name="nama_pos" class="form-control w-full px-3 py-2 rounded border border-gray-300"
                    value="{{ old('nama_pos', $damkar->nama_pos) }}" required>
            </div>

            <div class="mb-4">
                <label class="block font-medium text-white mb-1">Alamat</label>
                <input type="text" name="alamat" class="form-control w-full px-3 py-2 rounded border border-gray-300"
                    value="{{ old('alamat', $damkar->alamat) }}" required>
            </div>

            <div class="mb-4">
                <label class="block font-medium text-white mb-1">Kecamatan</label>
                <select name="kecamatan" class="form-control w-full px-3 py-2 rounded border border-gray-300" required>
                    <option value="" disabled>Pilih Kecamatan</option>
                    @foreach (['Banjarmasin Utara', 'Banjarmasin Selatan', 'Banjarmasin Tengah', 'Banjarmasin Timur', 'Banjarmasin Barat'] as $kec)
                        <option value="{{ $kec }}" {{ old('kecamatan', $damkar->kecamatan) == $kec ? 'selected' : '' }}>
                            {{ $kec }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-medium text-white mb-1">Telepon</label>
                <input type="text" id="telepon" name="telepon"
                    class="form-control w-full px-3 py-2 rounded border border-gray-300"
                    value="{{ old('telepon', $damkar->telepon) }}" required>
            </div>

            <div class="mb-4">
                <label class="block font-medium text-white mb-1">Latitude</label>
                <input type="text" id="latitude" name="latitude"
                    class="form-control w-full px-3 py-2 rounded border border-gray-300"
                    value="{{ old('latitude', $damkar->latitude) }}" required>
            </div>

            <div class="mb-4">
                <label class="block font-medium text-white mb-1">Longitude</label>
                <input type="text" id="longitude" name="longitude"
                    class="form-control w-full px-3 py-2 rounded border border-gray-300"
                    value="{{ old('longitude', $damkar->longitude) }}" required>
            </div>

            <div class="mb-6">
                <label class="block font-medium text-white mb-2">Pilih Lokasi pada Peta</label>
                <div id="map" style="height: 300px; border-radius: 10px; overflow: hidden;"></div>
            </div>

            <div class="bg-gray-100 p-4 rounded text-end">
                <button type="submit" class="btn btn-primary">
                    Simpan Perubahan
                </button>
                <a href="{{ route('damkar.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>

    {{-- Leaflet --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>

    <script>
        const lat = parseFloat('{{ $damkar->latitude }}');
        const lng = parseFloat('{{ $damkar->longitude }}');
        const map = L.map('map').setView([lat, lng], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        let marker = L.marker([lat, lng]).addTo(map);

        map.on('click', function(e) {
            const { lat, lng } = e.latlng;

            if (marker) {
                map.removeLayer(marker);
            }

            marker = L.marker([lat, lng]).addTo(map);

            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;
        });
    </script>
@endsection
