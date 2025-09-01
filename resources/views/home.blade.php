<!-- CSS & Leaflet -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Leaflet Core -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>

<!-- CSS & JS Leaflet Search -->
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-search/dist/leaflet-control-search.min.css" />
<script src="https://unpkg.com/leaflet-control-search/dist/leaflet-control-search.min.js"></script>

<!-- Leaflet Routing Machine -->
<link rel="stylesheet"href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>

<!-- Leaflet Fullscreen Plugin -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.fullscreen/1.6.0/Control.FullScreen.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.fullscreen/1.6.0/Control.FullScreen.min.js"></script>

<!-- Font Awesome 5 -->
<link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
  integrity="sha512-dBwexvY1QvI+4kvb6ncdAH3VcZq9RQaT7kHgIh0uhF2DkA0KIPY7gkgBsnErkgHsp9/99U5JF3d0E5eN0d5F6g=="
  crossorigin="anonymous"
  referrerpolicy="no-referrer"
/>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<meta name="viewport" content="width=device-width, initial-scale=1">


<style>
  body {
  margin: 0;
  min-height: 100vh; /* biar bisa lebih tinggi dari layar */
  background: linear-gradient(
    to top,
    rgba(137, 129, 129, 0.95),  /* hitam keabu-abuan */
    rgba(50, 50, 50, 0.9),   /* abu tua */
    rgba(80, 80, 80, 0.8),   /* abu sedang */
    rgba(120, 120, 120, 0.7) /* abu lebih terang */
  );
  background-attachment: fixed; /* biar efek gradasinya tetap */
}

  #map {
    height: 600px;
    margin: 30px auto; /* atas-bawah 30px, kiri-kanan center */
    max-width: 90%;
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
  }

  .leaflet-container:fullscreen {
    width: 100% !important;
    height: 100% !important;
  }

  .leaflet-control-zoom-fullscreen.fullscreen-icon::before {
    content: "\f065"; /* Fullscreen icon FA */
    font-family: "Font Awesome 6 Free";
    font-weight: 900;
    font-size: 18px;
    color: #333;
  }

  .kelurahan-popup {
    z-index: 2000 !important;
    background: none;
    border: none;
    box-shadow: none;
  }

  /* Card utama */
.layer-card {
  background: #fff;
  border-radius: 12px;
  width: 260px;
  font-family: Arial, sans-serif;
  box-shadow: 0 4px 10px rgba(0,0,0,0.15);
  position: relative;
  z-index: 2100;

  display: flex;
  flex-direction: column; /* header, body, footer vertikal */
  overflow: hidden;       /* biar animasi rapi */

   max-height: 50vh; /* 🔹 Batasi tinggi di desktop */
}

/* Header */
.layer-header {
  background: #000000;
  color: #fff;
  font-weight: bold;
  text-align: center;
  padding: 10px;
  font-size: 15px;
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 6px;
  cursor: pointer; /* supaya jelas bisa diklik */
}

.toggle-icon {
  transition: transform 0.3s ease;
}

/* saat panel aktif, panah berputar */
.layer-card.active .toggle-icon {
  transform: rotate(180deg);
}

/* Body */
.layer-body {
  flex: 1;
  overflow-y: auto;        /* scroll hanya kalau isi lebih panjang */
  padding: 10px 15px;
  max-height: 1000px;      /* default besar */
  transition: max-height 0.4s ease; /* animasi slide */
}

.kelurahan-section-title {
  font-size: 14px;
  font-weight: bold;
  margin-top: 10px;
  margin-bottom: 6px;
  color: #333;
}

/* Footer */
.layer-footer {
  padding: 10px;
  text-align: center;
  max-height: 200px;
  transition: max-height 0.4s ease; /* animasi slide */
}

.layer-footer .btn-delete {
  background: #e63946;
  color: #fff;
  border: none;
  padding: 8px 16px;
  border-radius: 8px;
  font-weight: bold;
  cursor: pointer;
  transition: 0.3s;
}
.layer-footer .btn-delete:hover {
  background: #c92a3a;
}
.layer-footer .btn-delete i {
  margin-left: 5px;
}

/* Checkbox */
.form-check-title {
  font-size: 14px;
  font-weight: bold;
  margin-bottom: 6px;
  color: #333;
  text-align: left;
}

.form-check-label {
  font-size: 14px;
  color: #333;
  cursor: pointer;
  user-select: none;
}
.form-check-input:checked {
  background-color: #28a745;
  border-color: #0062cc;
}

/* Popup kelurahan */
.kelurahan-popup.leaflet-control {
  z-index: 2000 !important;
  background: transparent;
  border: none;
  box-shadow: none;
}
.kelurahan-popup label {
  cursor: pointer;
}

/* Mode mobile: body & footer default tertutup */
@media (max-width: 768px) {
  .layer-body,
  .layer-footer {
    max-height: 0;
    overflow: hidden;
  }
  .layer-card.active .layer-body {
    max-height: 50vh;     /* isi body bisa scroll */
    overflow-y: auto;     /* biar kelurahan bisa discroll */
  }
  .layer-card.active .layer-footer {
    max-height: 100px; /* slide down saat aktif */
  }
}

/* 🔹 Desktop: sembunyikan ikon toggle */
@media (min-width: 769px) {
  .toggle-icon {
    display: none;
  }
}


  /* Custom posisi search box di atas peta */
  .leaflet-control-search {
    position: absolute !important;
    left: 50% !important;
    top: 10px !important;
    transform: translateX(-50%);
    z-index: 1000;
  }
  
    .leaflet-bottom.leaflet-right .leaflet-control-kompas {
    margin: 10px;
  }

  .leaflet-control-kompas {
    background: transparent;
    border: none;
  }

  .login-link {
    transition: all 0.3s ease;
  }

  .login-link:hover {
    color: #ffc107 !important;
    text-decoration: underline;
    cursor: pointer;
  }

  /* Dropdown menu global */
  .navbar .dropdown-menu {
    border-radius: 8px;
    box-shadow: 0 0 8px rgba(0,0,0,0.1);
  }

  .navbar .form-check-input:checked {
    background-color: #0d6efd;
    border-color: #0d6efd;
  }

  #resetBtn {
    background-color: #dc3545;
    border: none;
    font-weight: bold;
    border-radius: 8px;
  }

  #resetBtn:hover {
    background-color: #c82333;
  }

  .navbar-nav .nav-link.active {
    background-color: #28a745;
    color: white !important;
    border-radius: 5px;
  }

  .navbar-nav .nav-link:hover {
    background-color: #218838;
    color: white !important;
  }

  #btn-lokasi.active {
    background-color: #218838;
    border-color: #1e7e34;
  }

  #btn-lokasi {
    width: 40px;
    height: 40px;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
  }

  #btn-lokasi.active {
    background-color: #1e7e34 !important;
  }

  footer {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    background-color: #ccc;
    color: #222;
    text-align: center;
    padding: 10px;
    font-size: 14px;
    z-index: 999;
  }

  /* === Tambahan khusus dropdown Filter Wilayah === */
  .dropdown-menu h6 {
    font-size: 14px;
    font-weight: bold;
    color: #003366;
    margin-bottom: 10px;
  }

  .dropdown-menu .form-check {
    margin-bottom: 8px;
  }

  .dropdown-menu .form-check-input {
    cursor: pointer;
  }

  .dropdown-menu .form-check-label {
    font-size: 14px;
    color: #333;
    cursor: pointer;
  }
</style>

<!-- Navbar -->
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand text-white" href="#">SIG Pemadam Kebakaran Kota Banjarmasin</a>
    
    <!-- Hamburger -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mx-auto">

        <!-- Beranda -->
        <li class="nav-item">
          <a class="nav-link text-white login-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}" id="nav-beranda">
            Beranda
          </a>
        </li>

        <!-- Dropdown Kecamatan -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-white login-link" href="#" id="kecamatanDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Wilayah
          </a>
          <div class="dropdown-menu dropdown-menu-end p-3" aria-labelledby="kecamatanDropdown" style="min-width: 250px; max-height: 400px; overflow-y: auto;">
             
             <!-- Tambahan checkbox untuk pilih semua -->
            <hr>
              <h6>Filter Wilayah Per Kecamatan</h6>

              <div class="form-check mb-2">
                  <input class="form-check-input" type="checkbox" id="wilayahSelectAll">
                  <label class="form-check-label fw-bold" for="wilayahSelectAll">Pilih Semua</label>
             </div>

              <hr>
              @foreach (['Barat', 'Selatan', 'Tengah', 'Timur', 'Utara'] as $kec)
              <div class="form-check">
                  <input class="form-check-input filter-wilayah" type="checkbox" value="Banjarmasin {{ $kec }}" id="wilayah{{ $kec }}">
                  <label class="form-check-label" for="wilayah{{ $kec }}">Banjarmasin {{ $kec }}</label>
              </div>
              @endforeach
              <hr>
              <button class="btn btn-secondary btn-sm mt-3 w-100" id="resetBtn">Reset Semua</button>
          </div>
        </li>


        <!-- Data Damkar -->
        <li class="nav-item">
          <a class="nav-link text-white login-link {{ request()->routeIs('statistik.index') ? 'active' : '' }}" href="{{ route('statistik.index') }}" id="nav-damkar">
            Data Damkar
          </a>
        </li>

        <!-- Kontak -->
        <li class="nav-item">
          <a class="nav-link text-white login-link" href="{{ url('/instagram') }}" target="_blank" rel="noopener noreferrer" id="nav-kontak">
            Kontak
          </a>
        </li>

        <!-- Panduan -->
        {{-- <li class="nav-item">
          <a class="nav-link text-white login-link" href="#" id="nav-panduan">
            Panduan
          </a>
        </li> --}}

        <!-- Lokasi Saya (Ikon Saja dengan Tooltip) -->
        <li class="nav-item">
          <button id="btn-lokasi" class="btn btn-success ms-2" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Lokasi Saya">
            <i class="fas fa-map-marker-alt"></i>
          </button>
        </li>


      </ul>

      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link text-white login-link {{ request()->routeIs('login') ? 'active' : '' }}" href="{{ route('login') }}" id="nav-login">
            Masuk
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="text-center my-4">
    <h5 class="fw-bold text-black">
        SIG Pemetaan Pos Pemadam Kebakaran Kota Banjarmasin
    </h5>
</div>



    <!-- Peta -->
<div id="map"></div>

<script>
  var map = L.map('map', {
    fullscreenControl: true,
    fullscreenControlOptions: {
      position: 'topleft'
    },
    center: [-3.3186, 114.5908],
    zoom: 12
  });

  // Basemap options
  const osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; OpenStreetMap contributors'
  });

  const googleStreets = L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
    maxZoom: 20,
    subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
    attribution: '&copy; Google Maps'
  });

  const googleSat = L.tileLayer('https://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
    maxZoom: 20,
    subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
    attribution: '&copy; Google Satellite'
  });

  // Set default layer
  osm.addTo(map);

  // Add Layer control
  const baseLayers = {
    "OpenStreetMap": osm,
    "Google Maps": googleStreets,
    "Google Satellite": googleSat
  };

 const layerControl = L.control.layers(baseLayers, null, {
    position: 'topright',
    collapsed: true // collapsed agar jadi tombol kecil
  }).addTo(map);


  // GeoJSON load
  const geojsonLayers = {};
  const kecamatanBounds = {};
  const defaultView = {
    center: [-3.3186, 114.5908],
    zoom: 12
  };

  function loadGeoJSON(url, fillColor, kecamatanName) {
    fetch(url)
      .then(response => response.json())
      .then(data => {
        const layer = L.geoJSON(data, {
          style: {
            color: 'black',
            weight: 1,
            fillColor: fillColor,
            fillOpacity: 0.5
          }
        });
        layer.addTo(map);
        geojsonLayers[kecamatanName] = layer;
        kecamatanBounds[kecamatanName] = layer.getBounds();
      })
      .catch(error => console.error('Gagal load GeoJSON dari ' + url, error));
  }

  loadGeoJSON('/geojson/BanjarmasinTimur.geojson', '#ff6666', 'Banjarmasin Timur');
  loadGeoJSON('/geojson/BanjarmasinBarat.geojson', '#14A3C7', 'Banjarmasin Barat');
  loadGeoJSON('/geojson/BanjarmasinUtaraa.geojson', '#ffcc66', 'Banjarmasin Utara');
  loadGeoJSON('/geojson/BanjarmasinSelatan.geojson', '#66cc66', 'Banjarmasin Selatan');
  loadGeoJSON('/geojson/BanjarmasinTengah.geojson', '#cc66cc', 'Banjarmasin Tengah');

  // Icon Damkar
  const damkarIcon = L.icon({
    iconUrl: '/img/fire.png',
    iconSize: [40, 40],
    iconAnchor: [20, 40],
    popupAnchor: [0, -40]
  });

  const posDamkar = @json($damkars);
  const allMarkers = [];

  posDamkar.forEach(pos => {
    const marker = L.marker([pos.latitude, pos.longitude], { icon: damkarIcon })
      marker.bindPopup(`
        <div class="table-responsive">
          <table class="table table-sm table-bordered mb-0">
            <thead class="table-secondary">
              <tr>
                <th colspan="2" class="text-center" style="font-size: 16px;">${pos.nama_pos}</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><strong>Alamat</strong></td>
                <td>${pos.alamat}</td>
              </tr>
              <tr>
                <td><strong>Kecamatan</strong></td>
                <td>${pos.kecamatan}</td>
              </tr>
              <tr>
                <td><strong>Telepon</strong></td>
                <td>${pos.telepon ?? '-'}</td>
              </tr>
            </tbody>
          </table>
        </div>
      `);

    marker.kecamatan = pos.kecamatan;
    marker.kategori = 'damkar';
    // marker.addTo(map);
    allMarkers.push(marker);
  });

    // --- SEARCH CONTROL ---
    var searchControl = L.Control.extend({
      onAdd: function () {
        var div = L.DomUtil.create('div', 'search-box');
        div.innerHTML = `
          <input type="text" id="searchInput" class="form-control form-control-sm" placeholder="Cari Pos Damkar...">
        `;
        return div;
      }
    });

    // Tambahkan ke peta, posisinya di kiri atas
    map.addControl(new searchControl({ position: 'topleft' }));


  // Fungsi Search
  document.addEventListener("input", function (e) {
    if (e.target && e.target.id === "searchInput") {
      let query = e.target.value.toLowerCase();
      let found = false;

      allMarkers.forEach(marker => {
        if (marker.getPopup().getContent().toLowerCase().includes(query) && query.length > 2) {
          map.setView(marker.getLatLng(), 16);
          marker.openPopup();
          found = true;
        }
      });
    }
  });


  function filterMarkers() {
    const selectedKecamatan = Array.from(document.querySelectorAll('.filter-wilayah:checked')).map(cb => cb.value);
    const damkarEnabled = document.getElementById('filterDamkar')?.checked;

    allMarkers.forEach(marker => {
      if (marker.kategori === 'damkar') {
        if (damkarEnabled && selectedKecamatan.includes(marker.kecamatan)) {
          map.addLayer(marker);
        } else {
          map.removeLayer(marker);
        }
      }
    });
  }


  function filterWilayah() {
    const allWilayahCheckboxes = document.querySelectorAll('.filter-wilayah');
    const selected = Array.from(allWilayahCheckboxes).filter(cb => cb.checked).map(cb => cb.value);
    const totalSelected = selected.length;
    const totalWilayah = allWilayahCheckboxes.length;

    let lastSelectedKecamatan = null;

    for (let kec in geojsonLayers) {
        const wilayahChecked = selected.includes(kec);
        if (wilayahChecked) {
            map.addLayer(geojsonLayers[kec]);
            lastSelectedKecamatan = kec;
        } else {
            map.removeLayer(geojsonLayers[kec]);
        }
    }

    // Zoom map
    if (totalSelected === 0 || totalSelected === totalWilayah) {
        map.setView(defaultView.center, defaultView.zoom);
    } else if (lastSelectedKecamatan && kecamatanBounds[lastSelectedKecamatan]) {
        map.fitBounds(kecamatanBounds[lastSelectedKecamatan]);
    }

    // Tampilkan panel kelurahan hanya kalau ada 1 kecamatan dipilih
    const kelurahanPanel = document.querySelector('.kelurahan-popup');
    if (selected.length === 1 && kelurahanFilesMap[selected[0]]) {
        if (kelurahanPanel) kelurahanPanel.style.display = 'block';
        setupKelurahanCheckboxes(selected[0]);
    } else {
        if (kelurahanPanel) kelurahanPanel.style.display = 'none';
        const popupContainer = document.querySelector('.kelurahan-popup .kelurahan-list');
        if (popupContainer) popupContainer.innerHTML = '';
        for (let file in kelurahanLayerMap) {
            map.removeLayer(kelurahanLayerMap[file]);
        }
    }

    // Filter damkar sesuai kecamatan
    filterMarkers();
}

// Sembunyikan panel saat awal load
document.addEventListener("DOMContentLoaded", function () {
    const kelurahanPanel = document.querySelector('.kelurahan-popup');
    if (kelurahanPanel) kelurahanPanel.style.display = 'none';
});

// Event listener kecamatan
document.querySelectorAll('.filter-wilayah').forEach(cb => {
    cb.addEventListener('change', filterWilayah);
});

// Tombol reset
document.getElementById('resetBtn').addEventListener('click', function () {
    document.querySelectorAll('.filter-wilayah').forEach(cb => cb.checked = false);
    filterWilayah();
});

// --- FUNGSI RENDER PANEL KELURAHAN ---
function renderKelurahanPanel() {
  const container = document.querySelector('.kelurahan-popup');
  if (!container) return;

  container.innerHTML = `
    <div class="layer-card">
      <div class="layer-header" onclick="toggleLayer()">
        <span>Katalog Layer</span>
        <i class="fa fa-layer-group"></i>
         <i class="fa fa-chevron-down toggle-icon"></i>
      </div>

      <div class="layer-body" id="layerBody">
        <div class="form-check">
          <div class="form-check-title">Filter Ikon</div>
          <input class="form-check-input" type="checkbox" id="filterDamkar">
          <label class="form-check-label" for="filterDamkar">Tampilkan Damkar</label>
        </div>

        <div class="kelurahan-section">
          <div class="kelurahan-section-title" id="kelurahan-title">Kelurahan</div>
          <div class="kelurahan-list"></div>
        </div>
      </div>

      <div class="layer-footer" id="layerFooter">
        <button class="btn-delete" onclick="hapusSemuaFilter()">
          <i class="fa fa-trash"></i> Bersihkan Semua
        </button>
      </div>
    </div>

  `;

  const damkarCb = document.getElementById('filterDamkar');
  if (damkarCb) {
    damkarCb.addEventListener('change', filterMarkers);
  }
}


// --- FUNGSI HAPUS SEMUA FILTER ---
function hapusSemuaFilter() {
    // Uncheck semua filter ikon & kelurahan
  document.querySelectorAll('#filterDamkar, .kelurahan-checkbox').forEach(cb => {
    cb.checked = false;
  });

  // Jalankan ulang filter
  if (typeof filterMarkers === "function") filterMarkers();
  if (typeof filterWilayah === "function") filterWilayah();

  console.log("🔄 Filter ikon & kelurahan sudah direset");
}



// --- RESET FILTER FUNGSIONALITAS ---
function resetFilter() {
    document.querySelectorAll('.filter-icon, .filter-wilayah, .kelurahan-checkbox').forEach(cb => cb.checked = false);

    // Hapus semua layer kelurahan dari peta
    for (let file in kelurahanLayerMap) {
        if (kelurahanLayerMap[file]) map.removeLayer(kelurahanLayerMap[file]);
    }

    if (userMarker) {
        map.removeLayer(userMarker);
        userMarker = null;
    }
    // Hapus marker damkar terdekat
    if (nearestMarker) {
        map.removeLayer(nearestMarker);
        nearestMarker = null;
    }
    // Hapus rute
    if (routingControl) {
        map.removeControl(routingControl);
        routingControl = null;
    }


    filterMarkers();
    filterWilayah();

    // Render ulang panel kelurahan
    renderKelurahanPanel();

    // Kembalikan view ke posisi default
    if (typeof defaultView !== 'undefined') {
        map.setView(defaultView.center, defaultView.zoom);
    }
}

// --- INISIALISASI KETIKA DOM SIAP ---
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.filter-icon').forEach(cb => cb.addEventListener('change', filterMarkers));
    document.querySelectorAll('.filter-wilayah').forEach(cb => cb.addEventListener('change', filterWilayah));
    document.getElementById('resetBtn').addEventListener('click', resetFilter);

    zoomToKecamatan();
    kelurahanPopupControl.addTo(map);

    // Panel langsung muncul waktu load awal
    renderKelurahanPanel();
});
</script>

<!-- STYLE DITARUH DI LUAR SCRIPT -->
<style>
  .search-box {
  background: white;
  padding: 3px;
  border-radius: 6px;
  box-shadow: 0 2px 6px rgba(0,0,0,0.3);
  margin-top: 0 !important; /* geser ke bawah dikit biar ga nabrak tombol zoom */
  margin-left: 52px !important; /* geser ke kanan supaya pas di samping tombol zoom */
   transform: translateY(-90px); /* angkat biar sejajar dengan tombol + */
}

.search-box input {
  width: 160px;
  font-size: 13px;
}
</style>


<script>
  // --- kontrol popup kelurahan ---
  const kelurahanPopupControl = L.control({ position: 'topright' });

  kelurahanPopupControl.onAdd = function (map) {
    const div = L.DomUtil.create('div', 'kelurahan-popup leaflet-bar leaflet-control shadow-sm');
    div.style.display = 'none'; // 🔹 Awal tersembunyi
    
    div.innerHTML = `
      <div class="kelurahan-section">
        <div class="kelurahan-section-title">Filter Ikon</div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="filterDamkar">
          <label class="form-check-label" for="filterDamkar">Tampilkan Damkar</label>
        </div>
      </div>
      <div class="kelurahan-section">
        <div class="kelurahan-section-title" id="kelurahan-title">Kelurahan</div>
        <div class="kelurahan-list"></div>
      </div>
    `;
    return div;
  };

  kelurahanPopupControl.addTo(map);

  const kelurahanLayerMap = {};
  const kelurahanFilesMap = {
    'Banjarmasin Timur': [
      "Banua Anyar.geojson",
      "Karang Mekarr.geojson",
      "Kebun Bunga.geojson",
      "Kuripan.geojson",
      "Pekapuran Raya.geojson",
      "Pemurus Luar.geojson",
      "Pengambangan.geojson",
      "Sungai Bilu.geojson",
      "Sungai Lulut.geojson"
    ],
    'Banjarmasin Barat': [
      "Basirih.geojson",
      "Belitung Selatan.geojson",
      "Belitung Utara.geojson",
      "Kuin Cerucuk.geojson",
      "Kuin Selatan.geojson",
      "Pelambuan.geojson",
      "Telaga Biru.geojson",
      "Telawang.geojson",
      "Teluk Tiram.geojson"
    ],
    'Banjarmasin Utara': [
      "Alalak Selatan.geojson",
      "Alalak Tengah.geojson",
      "Alalak Utara.geojson",
      "Antasan Kecil Timur.geojson",
      "Kuin Utara.geojson",
      "Pangeran.geojson",
      "Sungai Andai.geojson",
      "Sungai Jingah.geojson",
      "Sungai Miai.geojson",
      "Surgi Mufti.geojson"
    ],
    'Banjarmasin Selatan': [
      "Basirih Selatan.geojson",
      "Kelayan Barat.geojson",
      "Kelayan Dalam.geojson",
      "Kelayan Selatan.geojson",
      "Kelayan Tengah.geojson",
      "Kelayan Timur.geojson",
      "Mantuil.geojson",
      "Murung Raya.geojson",
      "Pekauman.geojson",
      "Pemurus Baru.geojson",
      "Pemurus Dalam.geojson",
      "Tanjung Pagar.geojson"
    ],
    'Banjarmasin Tengah': [
      "Antasan Besar.geojson",
      "Gadang.geojson",
      "Kelayan Luar.geojson",
      "Kertak Baru Ilir.geojson",
      "Kertak Baru Ulu.geojson",
      "Mawar.geojson",
      "Melayu.geojson",
      "Pasar Lama.geojson",
      "Pekapuran Laut.geojson",
      "Seberang Mesjid.geojson",
      "Sungai Baru.geojson",
      "Teluk Dalam.geojson"
    ]
  };

  const kelurahanColors = [
    '#FF7F7F', '#FFBF00', '#90EE90', '#87CEFA',
    '#DDA0DD', '#FFA07A', '#B0C4DE', '#E6E6FA',
    '#F08080', '#98FB98', '#D8BFD8', '#FFD700'
  ];

  function setupKelurahanCheckboxes(namaKecamatan) {
    const listContainer = document.querySelector('.kelurahan-list');
    const title = document.getElementById('kelurahan-title');
    if (!listContainer || !title) return;

    title.innerText = `Kelurahan ${namaKecamatan}`;
    listContainer.innerHTML = ''; // kosongkan list

    // Hapus semua layer kelurahan sebelumnya
    for (let file in kelurahanLayerMap) {
        if (kelurahanLayerMap[file]) map.removeLayer(kelurahanLayerMap[file]);
    }
    Object.keys(kelurahanLayerMap).forEach(k => delete kelurahanLayerMap[k]);

    const folder = 'kelurahan';
    const kelurahanFiles = kelurahanFilesMap[namaKecamatan] || [];

    kelurahanFiles.forEach((file, index) => {
        const name = file.replace('.geojson', '');
        const safeId = `kelurahan-${name.replace(/\s+/g, '-')}`;
        const color = kelurahanColors[index % kelurahanColors.length];

        const checkboxHTML = document.createElement('div');
        checkboxHTML.className = 'form-check mb-1';
        checkboxHTML.innerHTML = `
            <input class="form-check-input kelurahan-checkbox" type="checkbox" value="${file}" id="${safeId}">
            <label class="form-check-label small" for="${safeId}">${name}</label>
        `;
        listContainer.appendChild(checkboxHTML);

        setTimeout(() => {
            const checkbox = document.getElementById(safeId);
            if (checkbox) {
                checkbox.addEventListener('change', function (e) {
                    const geojsonPath = `/geojson/${folder}/${encodeURIComponent(file)}`;

                    if (e.target.checked) {
                        // 1. Sembunyikan semua kecamatan
                        for (let nama in geojsonLayers) {
                            map.removeLayer(geojsonLayers[nama]);
                        }

                        // 2. Sembunyikan kelurahan lain
                        for (let f in kelurahanLayerMap) {
                            map.removeLayer(kelurahanLayerMap[f]);
                        }

                        // 3. Tampilkan kelurahan yang dipilih
                        if (!kelurahanLayerMap[file]) {
                            fetch(geojsonPath)
                                .then(res => res.json())
                                .then(data => {
                                    const layer = L.geoJSON(data, {
                                        filter: function (feature) {
                                            // 🔎 hanya tampilkan kelurahan yang ada di Kota Banjarmasin
                                            return feature.properties.WADMKK === "Kota Banjarmasin";
                                        },
                                        style: { 
                                                color: "#333333",     // garis tegas hitam/abu tua
                                                weight: 2.5,          // agak tebal
                                                fillColor: color,     // pakai warna dari kelurahanColors
                                                fillOpacity: 0.5
                                            }
                                        }).bindPopup(`<strong>${name}</strong>`);

                                    layer.addTo(map);
                                    kelurahanLayerMap[file] = layer;

                                    // Zoom ke kelurahan
                                    const bounds = layer.getBounds();
                                    if (bounds.isValid()) {
                                        map.fitBounds(bounds, { padding: [30, 30], maxZoom: 16, animate: true });
                                    } else {
                                        map.setView([-3.3186, 114.5908], 14); // fallback
                                    }
                                })
                                .catch(err => console.error(`Gagal memuat ${file}:`, err));
                        } else {
                            map.addLayer(kelurahanLayerMap[file]);
                            map.fitBounds(kelurahanLayerMap[file].getBounds());
                        }

                    } else {
                        // Kalau kelurahan di-uncheck → hapus layer kelurahan
                        if (kelurahanLayerMap[file]) {
                            map.removeLayer(kelurahanLayerMap[file]);
                        }

                        // Tampilkan lagi kecamatan besar
                        if (geojsonLayers[namaKecamatan]) {
                            map.addLayer(geojsonLayers[namaKecamatan]);
                            // Zoom balik ke batas kecamatan
                            map.fitBounds(geojsonLayers[namaKecamatan].getBounds());
                        }
                    }
                });
            }
        }, 0);
    });
}

function toggleLayer() {
  document.querySelector(".layer-card").classList.toggle("active");
}


  // --- Filter ikon damkar ---
  // Jalankan filter ulang ketika checkbox Damkar diubah
    const filterDamkarCheckbox = document.getElementById('filterDamkar');
    if (filterDamkarCheckbox) {
      filterDamkarCheckbox.addEventListener('change', filterMarkers);
    }

    // Jalankan filter ulang ketika filter kecamatan diubah
    document.querySelectorAll('.filter-icon').forEach(cb => {
      cb.addEventListener('change', filterMarkers);
    });


  function zoomToKecamatan(namaKecamatan) {
    if (kecamatanBounds[namaKecamatan]) {
      map.fitBounds(kecamatanBounds[namaKecamatan]);
    }

    for (let nama in geojsonLayers) {
      if (nama === namaKecamatan) {
        map.addLayer(geojsonLayers[nama]);
      } else {
        map.removeLayer(geojsonLayers[nama]);
      }
    }

    if (kelurahanFilesMap[namaKecamatan]) {
      setupKelurahanCheckboxes(namaKecamatan);
    } else {
      const listContainer = document.querySelector('.kelurahan-list');
      if (listContainer) listContainer.innerHTML = '';
      for (let file in kelurahanLayerMap) {
        map.removeLayer(kelurahanLayerMap[file]);
      }
    }
  }
</script>

<script>
const KompasControl = L.Control.extend({
  onAdd: function () {
    const img = L.DomUtil.create('img');
    img.src = '/img/kompas.png'; // ganti sesuai path gambar kamu
    img.style.width = '80px';
    img.style.height = '80px';
    return img;
  },

  onRemove: function () {}
});

L.control.kompas = function (opts) {
  return new KompasControl(opts);
};
L.control.kompas({ position: 'bottomright' }).addTo(map);
</script>

<script>
// --- Fungsi cari pos damkar terdekat ---
function findNearestDamkar(userLat, userLng, damkars) {
    let nearest = null;
    let minDistance = Infinity;

    damkars.forEach(pos => {
        const distance = Math.sqrt(
            Math.pow(userLat - pos.lat, 2) + Math.pow(userLng - pos.lng, 2)
        );

        if (distance < minDistance) {
            minDistance = distance;
            nearest = pos;
        }
    });

    return nearest;
}

let userMarker = null;
let routingControl = null;
let nearestMarker = null;

// Fungsi hapus route
function clearRoute() {
    if (routingControl) {
        map.removeControl(routingControl);
        routingControl = null;
    }
}

// Fungsi buat route baru
function createRoute(userLat, userLng, nearestPos) {
    clearRoute(); // pastikan route lama hilang
    routingControl = L.Routing.control({
        waypoints: [
            L.latLng(userLat, userLng),
            L.latLng(nearestPos.lat, nearestPos.lng)
        ],
        routeWhileDragging: false,
        addWaypoints: false,
        draggableWaypoints: false,
        position: 'bottomleft' // ✅ ubah posisi disini kalau mau
    }).addTo(map);

    routingControl.on('routingerror', function(e) {
        console.error('Routing error:', e);
        alert('Gagal membuat rute. Server routing mungkin sedang bermasalah.');
    });
}

// Tombol Lokasi
document.getElementById('btn-lokasi').addEventListener('click', function () {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            const userLat = position.coords.latitude;
            const userLng = position.coords.longitude;

            // Hapus marker user lama
            if (userMarker) {
                map.removeLayer(userMarker);
            }

            // Tambahkan marker lokasi user
            userMarker = L.marker([userLat, userLng])
                .addTo(map)
                .bindPopup("Lokasi Anda")
                .openPopup();

            // Cari pos damkar terdekat
            const nearestPos = findNearestDamkar(userLat, userLng, damkarLocations);

            if (nearestPos) {
                // Hapus marker pos lama
                if (nearestMarker) {
                    map.removeLayer(nearestMarker);
                }

                // Tambahkan marker pos damkar terdekat
                nearestMarker = L.marker([nearestPos.lat, nearestPos.lng])
                    .addTo(map)
                    .bindPopup(`🚒 Pos Damkar Terdekat: <strong>${nearestPos.name}</strong>`)
                    .openPopup();

                // Buat route baru
                createRoute(userLat, userLng, nearestPos);
            }

            // Zoom fokus ke lokasi user
            map.setView([userLat, userLng], 14);

        }, function (err) {
            alert("Gagal mendapatkan lokasi: " + err.message);
        });
    } else {
        alert("Browser tidak mendukung geolokasi.");
    }
});

// Highlight menu aktif di navbar
document.addEventListener("DOMContentLoaded", function () {
    const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
    const lokasiBtn = document.getElementById('btn-lokasi');

    [...navLinks, lokasiBtn].forEach(item => {
        item.addEventListener('click', function () {
            [...navLinks, lokasiBtn].forEach(el => el.classList.remove('active'));
            this.classList.add('active');
        });
    });
});
</script>

<!-- Data Pos Damkar -->
<script>
const damkarLocations = @json(
    $damkars->map(fn($d) => [
        'name' => $d->nama_pos,
        'lat'  => (float) $d->latitude,
        'lng'  => (float) $d->longitude
    ])->values()->toArray()
);
</script>

<!-- ... kode HTML & Map ... -->

<script>
document.addEventListener("DOMContentLoaded", function() {
    const selectAll = document.getElementById("wilayahSelectAll");
    const wilayahChecks = document.querySelectorAll(".filter-wilayah");
    const resetBtn = document.getElementById("resetBtn");

    // fungsi apply filter → panggil dua-duanya
    function applyFilter() {
        if (typeof filterMarkers === "function") {
            filterMarkers();
        }
        if (typeof filterWilayah === "function") {
            filterWilayah();
        }
    }

    // Master checkbox → check/uncheck semua
    if (selectAll) {
        selectAll.addEventListener("change", function() {
            wilayahChecks.forEach(cb => cb.checked = this.checked);
             filterWilayah();
        });
    }

    // Kalau user cek manual → sinkronkan "Pilih Semua"
    wilayahChecks.forEach(cb => {
        cb.addEventListener("change", function() {
            const allChecked = Array.from(wilayahChecks).every(x => x.checked);
            selectAll.checked = allChecked;
             
        });
    });   
});
</script>



<footer>
  <p>&copy; 2025 <strong>SIG Pemadam Kebakaran Kota Banjarmasin</strong>. All rights About Fire.</p>
  {{-- <p>Built with ❤️ by <a href="https://www.instagram.com/rizkyfarabi_" target="_blank" style="color: #07655f; text-decoration: none;">Muhammad Rizky</a></p> --}}
</footer>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('status'))
<script>
  Swal.fire({
    icon: 'success',
    title: '{{ session('status') }}',
    showConfirmButton: false,
    timer: 2000
  });
</script>
@endif
