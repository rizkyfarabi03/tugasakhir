@extends('admin.create') {{-- Menggunakan layout dashboard --}}

@section('title', 'Tambah Data Damkar')

@section('content')
    <div class="p-4">
        <h4 class="mb-4">Tambah Data Pemadam Kebakaran</h4>
        <form action="{{ route('pos-damkar.store') }}" method="POST" class="max-w-xl">
            @csrf
            <div class="mb-4">
                <label class="block font-medium text-white mb-1">Nama Pos</label>
                <input type="text" name="nama_pos" class="form-control w-full px-3 py-2 rounded border border-gray-300" placeholder="Contoh: Pos Induk Banjarmasin" required>
            </div>

            <div class="mb-4">
                <label class="block font-medium text-white mb-1">Alamat</label>
                <input type="text" name="alamat" class="form-control w-full px-3 py-2 rounded border border-gray-300" placeholder="Contoh: Jl. Gatot Subroto No. 12" required>
            </div>


            <div class="mb-4">
                <label class="block font-medium text-white mb-1">Kecamatan</label>
                <select name="kecamatan" class="form-control w-full px-3 py-2 rounded border border-gray-300" required>
                    <option value="" disabled selected>Pilih Kecamatan</option>
                    <option value="Banjarmasin Utara">Banjarmasin Utara</option>
                    <option value="Banjarmasin Selatan">Banjarmasin Selatan</option>
                    <option value="Banjarmasin Tengah">Banjarmasin Tengah</option>
                    <option value="Banjarmasin Timur">Banjarmasin Timur</option>
                    <option value="Banjarmasin Barat">Banjarmasin Barat</option>
                </select>
            </div>


            <div class="mb-4">
                <label class="block font-medium text-white mb-1">Telepon</label>
                <input type="text" id="telepon" name="telepon" class="form-control w-full px-3 py-2 rounded border border-gray-300" placeholder="Silahkan cantumkan nomer" required>
            </div>

            <div class="mb-4">
                <label class="block font-medium text-white mb-1">Latitude</label>
                <input type="text" id="latitude" name="latitude" class="form-control w-full px-3 py-2 rounded border border-gray-300" placeholder="Klik di peta" required>
            </div>

            <div class="mb-4">
                <label class="block font-medium text-white mb-1">Longitude</label>
                <input type="text" id="longitude" name="longitude" class="form-control w-full px-3 py-2 rounded border border-gray-300" placeholder="Klik di peta" required>
            </div>

            <div class="mb-6">
                <label class="block font-medium text-white mb-2">Pilih Lokasi pada Peta</label>
                <div id="map" style="height: 300px; border-radius: 10px; overflow: hidden;"></div>
            </div>

            <div class="bg-gray-100 p-4 rounded">
            <button type="submit" class="btn btn-primary">
                Simpan
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
        const map = L.map('map').setView([-3.316694, 114.590111], 13); // Lokasi default Banjarmasin

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        let marker;

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
