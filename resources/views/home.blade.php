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
<style>
  /* === Base Body === */
  body {
    margin: 0;
    min-height: 100vh; /* biar bisa lebih tinggi dari layar */
    background: linear-gradient(
      to top,
      rgba(137, 129, 129, 0.95),  /* hitam keabu-abuan */
      rgba(50, 50, 50, 0.9),      /* abu tua */
      rgba(80, 80, 80, 0.8),      /* abu sedang */
      rgba(120, 120, 120, 0.7)    /* abu lebih terang */
    );
    background-attachment: fixed; /* biar efek gradasinya tetap */
  }

  /* === Map Styling === */
  #map {
    height: 600px;
    margin: 30px auto;
    max-width: 90%;
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
  }

  .leaflet-container:fullscreen {
    width: 100% !important;
    height: 100% !important;
  }

  /* === Leaflet Controls === */
  .leaflet-control.wilayah-popup {
    margin-left: 25px !important;
  }

  .leaflet-control-zoom-fullscreen.fullscreen-icon::before {
    content: "\f065"; /* Fullscreen icon FA */
    font-family: "Font Awesome 6 Free";
    font-weight: 900;
    font-size: 18px;
    color: #333;
  }

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

  /* === Popup Kelurahan === */
  .kelurahan-popup {
    z-index: 2000 !important;
    max-width: 280px;
    background: #fff;
    border-radius: 10px;
    font-size: 14px;
    overflow: hidden;
    border: none;
    box-shadow: none;
  }

  .kelurahan-popup .layer-card {
    display: flex;
    flex-direction: column;
  }

  /* === Card Utama === */
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
    max-height: 50vh;       /* Batasi tinggi di desktop */
  }

  /* Header */
  .layer-header {
    background: #000;
    color: #fff;
    font-weight: bold;
    text-align: center;
    padding: 10px;
    font-size: 15px;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 6px;
    cursor: pointer;
  }

  .toggle-icon {
    transition: transform 0.3s ease;
  }

  .layer-card.active .toggle-icon {
    transform: rotate(180deg);
  }

  /* Body Filter Wilayah */
.layer-body {
  flex: 1;
  overflow-y: auto;
  padding: 10px 15px;
  max-height: 250px; /* batas tinggi */
  transition: max-height 0.4s ease;
}
/* ==== Katalog Layer ==== */
#wilayahBody {
  max-height: none !important;  /* jangan dibatasi */
  overflow-y: visible !important; /* biar gak muncul scroll */
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
    transition: max-height 0.4s ease;
    background: #f7f7f7;
  }

  .layer-footer .btn-delete {
    background: #dc3545;
    color: #fff;
    border: none;
    padding: 8px 16px;
    border-radius: 8px;
    font-weight: bold;
    cursor: pointer;
    font-size: 13px;
    transition: 0.3s;
  }
  .layer-footer .btn-delete:hover {
    background: #c82333;
  }
  .layer-footer .btn-delete i {
    margin-left: 5px;
  }

  /* === Checkbox === */
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

  /* === Responsive === */
  @media (max-width: 768px) {
    .kelurahan-popup {
      max-width: 95vw;
      width: auto;
      right: 5px !important;
      top: 60px !important;
    }

    .layer-body {
      max-height: 40vh;
    }

    .layer-footer .btn-delete {
      width: 100%;
      padding: 10px;
      font-size: 14px;
    }
  }

  @media (min-width: 769px) {
    .toggle-icon {
      display: none;
    }
  }

  /* === Navbar & Dropdown === */
  .navbar .dropdown-menu {
    border-radius: 8px;
    box-shadow: 0 0 8px rgba(0,0,0,0.1);
  }

  .navbar .form-check-input:checked {
    background-color: #0d6efd;
    border-color: #0d6efd;
  }

  .navbar-nav .nav-link.active {
    background-color: #28a745;
    color: #fff !important;
    border-radius: 5px;
  }

  .navbar-nav .nav-link:hover {
    background-color: #218838;
    color: #fff !important;
  }

  /* === Buttons === */
  #resetBtn {
    background-color: #dc3545;
    border: none;
    font-weight: bold;
    border-radius: 8px;
  }
  #resetBtn:hover {
    background-color: #c82333;
  }

  #btn-lokasi {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    padding: 6px 16px;
    border-radius: 8px;
    width: auto !important;
    height: auto !important;
  }
  #btn-lokasi.active {
    background-color: #1e7e34 !important;
    border-color: #1e7e34;
  }

  /* === Footer === */
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

  /* === Dropdown Filter Wilayah === */
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

  /* === Login Link === */
  .login-link {
    transition: all 0.3s ease;
  }
  .login-link:hover {
    color: #ffc107 !important;
    text-decoration: underline;
    cursor: pointer;
  }
</style>

<style>
/* Tombol ? tengah atas peta */
.help-btn {
  position: absolute;
  top: 10px;
  left: 50%;                  /* pindah ke tengah */
  transform: translateX(-50%); /* biar benar-benar center */
  background: #006400;
  color: #fff;
  border-radius: 50%;
  padding: 10px 12px;
  font-size: 20px;
  cursor: pointer;
  z-index: 1000;
  box-shadow: 0 3px 8px rgba(0,0,0,0.3);
}


/* Popup petunjuk utama (tengah layar) */
.help-popup {
  position: absolute;
  top: 70px;                 /* lebih dekat ke atas */
  left: 50%;
  transform: translateX(-50%);
  background: #fff;
  border-radius: 12px;
  padding: 10px 14px;        /* padding lebih kecil */
  width: 440px;              /* diperkecil dari 340px */
  max-width: 100%;            /* lebih ramping di layar kecil */
  z-index: 1000;
  box-shadow: 0 4px 12px rgba(0,0,0,0.2);
  font-size: 13px;           /* lebih kecil */
  line-height: 1.6;          /* rapat tapi tetap terbaca */
}

.help-popup h5 {
  margin-bottom: 10px;
  color: #006400;
  font-weight: bold;
}

.help-popup ul {
  margin: 0;
  padding-left: 18px;
}

.help-popup .close-btn {
  margin-top: 10px;
  background: #006400;
  color: #fff;
  border: none;
  border-radius: 6px;
  padding: 6px 12px;
  cursor: pointer;
}

/* 🔹 Tooltip petunjuk kecil (untuk ikon peta) */
.help-popup.tooltip {
  padding: 8px 12px;
  width: auto;
  max-width: 220px;
  font-size: 13px;
  border-radius: 8px;
}

/* Tooltip posisi kanan */
.help-popup.right {
  top: 50%;
  left: 110%;
  transform: translateY(-50%);
}

/* Tooltip posisi atas */
.help-popup.top {
  bottom: 110%;
  left: 50%;
  top: auto;
  transform: translateX(-50%);
}

/* Panah kecil */
.help-popup.tooltip::after {
  content: "";
  position: absolute;
  width: 0; 
  height: 0; 
  border-style: solid;
}

/* Panah untuk tooltip kanan */
.help-popup.right::after {
  top: 50%;
  left: -6px;
  transform: translateY(-50%);
  border-width: 6px;
  border-color: transparent #fff transparent transparent;
}

/* Panah untuk tooltip atas */
.help-popup.top::after {
  bottom: -6px;
  left: 50%;
  transform: translateX(-50%);
  border-width: 6px;
  border-color: #fff transparent transparent transparent;
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
          <a class="nav-link text-white login-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}" id="nav-beranda" title="Halaman awal aplikasi ini">
            Beranda
          </a>
        </li>

        <!-- Dropdown Kecamatan -->
        {{-- <li class="nav-item dropdown">
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
        </li> --}}

        <!-- Menu Wilayah -->
        <li class="nav-item">
          <a class="nav-link text-white login-link {{ request()->routeIs('home') ? 'active' : '' }}"
            href="{{ route('home') }}"
            id="nav-beranda"
            title="Halaman Icon Damkar dan Segmentasi Wilayah">
            Wilayah
          </a>
        </li>


        <!-- Data Damkar -->
        <li class="nav-item">
          <a class="nav-link text-white login-link {{ request()->routeIs('statistik.index') ? 'active' : '' }}" href="{{ route('statistik.index') }}" id="nav-damkar"title="Akses untuk menuju statistik dan data anggota">
            Data Damkar
          </a>
        </li>

        <!-- Kontak -->
        <li class="nav-item">
          <a class="nav-link text-white login-link" href="{{ url('/instagram') }}" target="_blank" rel="noopener noreferrer" id="nav-kontak" title="Akses untuk menuju sosmed disdamkardat">
            Kontak
          </a>
        </li>

        <!-- Panduan -->
        {{-- <li class="nav-item">
          <a class="nav-link text-white login-link" href="#" id="nav-panduan">
            Panduan
          </a>
        </li> --}}

        <!-- Lokasi Damkar Terdekat -->
        <li class="nav-item">
          <button id="btn-lokasi" class="btn btn-success ms-2 d-flex align-items-center" 
                  data-bs-toggle="tooltip" data-bs-placement="bottom" title="Mencari lokasi Damkar Terdekat">
            <i class="fas fa-map-marker-alt me-2"></i> 
            <span>Lokasi Damkar Terdekat</span>
          </button>
        </li>



      </ul>

      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link text-white login-link {{ request()->routeIs('login') ? 'active' : '' }}" href="{{ route('login') }}" id="nav-login" title="Akses admin untuk mengelola data">
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
<div id="map">
<div id="helpBtn" class="help-btn" onclick="toggleHelp()">
 <i class="fa fa-question-circle"></i> 
</div>

<!-- Popup Petunjuk -->
<div id="helpPopup" class="help-popup">
  <h5>📖 Petunjuk Penggunaan Peta Damkar</h5>
  <ul>
    <li>Gunakan tombol <b>+</b> dan <b>-</b> untuk <b>zoom in/out</b> peta.</li>
    <li>Klik ikon <b>⛶</b> untuk membuka <b>Fullscreen</b> peta.</li>
    <li>Gunakan Fitur  <b>cari dikiri atas</b> untuk <b>mencari damkar</b> di peta.</li>
    <li>Klik ikon di kanan atas
      <span class="leaflet-control-layers-toggle" 
            style="display:inline-block; width:20px; height:20px; vertical-align:middle;"></span> 
      untuk <b>ganti mode peta</b> (OSM, Google Maps, Satellite).
    </li>
    <li>Klik marker <b>🚒 Pos Damkar</b> untuk melihat detail lokasi & informasi.</li>
    <li>Pop Up <b> Katalog Layer</b> dibagian kiri peta untuk memilih dan menampilkan icon damkar dan peta Kecamatan di Banjarmasin.</li>
    <li>Pakai <b> Filter Kelurahan</b> untuk menampilkan batas wilayah tiap Kelurahan.<b>(klik salah satu kecamatan dulu baru pop ini tampil)</b></li>
    <li>Gunakan tombol <b>🔄 Reset</b> untuk kembali ke mode peta awal.</li>     
    <li>Buka menu <b> Wilayah</b> untuk menampilkan batas Kecamatan & Kelurahan.</li>
    <li>Buka menu <b>Data Damkar</b> untuk melihat daftar Pos Damkar.</li>
    <li>Buka menu <b>Kontak</b> untuk terhubung ke <b>Sosial Media Disdamkarmat</b>.</li>
    <li>Aktifkan lokasi Anda untuk menampilkan <b>Pos Damkar terdekat</b> dari posisi saat ini.</li>
    <li>Buka menu <b> Masuk</b> untuk login ke Halaman Admin.</li>

  </ul>
  <button onclick="toggleHelp()" class="close-btn">Tutup</button>
</div>




</div>

<!-- Tempatkan di atas peta -->
<div class="wilayah-popup"></div>


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
  collapsed: true
}).addTo(map);

// =============== Petunjuk Mode Peta ===============
const InfoControl = L.control({ position: "topright" });

InfoControl.onAdd = function (map) {
  const div = L.DomUtil.create("div", "map-hint");
  div.innerHTML = `
    <div style="
      background: rgba(0,0,0,0.7); 
      color: #fff; 
      padding: 6px 10px; 
      border-radius: 6px; 
      font-size: 13px; 
      max-width: 200px;
    ">
      Klik ikon layer (<i class="fa fa-layer-group"></i>) di kanan atas untuk ganti mode peta.
      <br><small></small>
    </div>
  `;
  return div;
};
InfoControl.addTo(map);

// =============== Petunjuk + Tombol Reset (Custom Control) ===============
const InfoResetControl = L.Control.extend({
  options: { position: "topright" }, // posisinya permanen di kanan atas

  onAdd: function (map) {
    const container = L.DomUtil.create("div", "leaflet-bar map-hint");

    // styling container
    container.style.display = "flex";
    container.style.alignItems = "center";
    container.style.background = "rgba(0,0,0,0.7)";
    container.style.color = "#fff";
    container.style.padding = "6px 10px";
    container.style.borderRadius = "6px";
    container.style.fontSize = "13px";
    container.style.marginTop = "5px";

    // teks petunjuk
    const text = L.DomUtil.create("div", "", container);
    text.innerHTML = `
      Klik ikon di sebelah kanan ini <br>
      untuk kembali ke mode peta awal.
    `;
    text.style.flex = "1";

    // tombol reset
    const button = L.DomUtil.create("a", "", container);
    button.innerHTML = '<i class="fas fa-rotate-left"></i>';
    button.href = "#";
    button.title = "Kembali ke tampilan peta awal (OpenStreetMap)";
    button.style.background = "#28a745";
    button.style.color = "#fff";
    button.style.padding = "6px 8px";
    button.style.borderRadius = "4px";
    button.style.marginLeft = "8px";

    // klik reset
    L.DomEvent.on(button, "click", function (e) {
      L.DomEvent.stopPropagation(e);
      L.DomEvent.preventDefault(e);

      // 🔹 Hapus hanya basemap yang aktif
      map.eachLayer(function (layer) {
        if (layer instanceof L.TileLayer) {
          map.removeLayer(layer);
        }
      });

      // 🔹 Tambahkan default OSM
      osm.addTo(map);

      // 🔹 Pastikan layerControl tetap ada
      // if (!map.hasLayer(layerControl)) {
      //   layerControl.addTo(map);
      // }
    });

    return container;
  }
});

// Tambahkan ke map
map.addControl(new InfoResetControl());




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
          <input type="text" id="searchInput" class="form-control form-control-sm" placeholder="Cari Pos Damkar..."title="Cari lokasi damkar yang diinginkan">
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
    if(marker.kategori==='damkar'){
      if(damkarEnabled && (selectedKecamatan.length===0 || selectedKecamatan.includes(marker.kecamatan))){
        map.addLayer(marker);
      } else map.removeLayer(marker);
    }
  });
}


// --- Inisialisasi global supaya tidak error ---
window.kelurahanLayerMap = window.kelurahanLayerMap || {};
window.kelurahanFilesMap = window.kelurahanFilesMap || {
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



// =================== FUNGSI FILTER ===================
function filterWilayah(){
  const selected = Array.from(document.querySelectorAll('.filter-wilayah:checked')).map(cb=>cb.value);
  let lastSelected = null;

  // tampilkan/sembunyi layer kecamatan
  for(let kec in geojsonLayers){
    if(selected.includes(kec)){ map.addLayer(geojsonLayers[kec]); lastSelected=kec; }
    else map.removeLayer(geojsonLayers[kec]);
  }

  // zoom otomatis
  if(selected.length===0 || selected.length===document.querySelectorAll('.filter-wilayah').length)
    map.setView(defaultView.center, defaultView.zoom);
  else if(lastSelected && kecamatanBounds[lastSelected])
    map.fitBounds(kecamatanBounds[lastSelected]);

  // tampilkan popup kelurahan jika 1 kecamatan dipilih
  const kelurahanPanel = document.querySelector('.kelurahan-popup');
  if(selected.length===1 && window.kelurahanFilesMap[selected[0]]){
    if(kelurahanPanel) kelurahanPanel.style.display='block';
    setupKelurahanCheckboxes(selected[0]);
  } else {
    if(kelurahanPanel) kelurahanPanel.style.display='none';
    const listContainer = document.querySelector('.kelurahan-popup .kelurahan-list');
    if(listContainer) listContainer.innerHTML='';
    for(let file in window.kelurahanLayerMap) map.removeLayer(window.kelurahanLayerMap[file]);
  }

  filterMarkers();
}

// document.addEventListener("DOMContentLoaded", function () {
//   // centang semua kecamatan default
//   document.querySelectorAll('.filter-wilayah').forEach(cb => cb.checked = true);

//   // centang damkar default
//   document.getElementById('filterDamkar').checked = true;

//   // panggil filterWilayah -> otomatis manggil filterMarkers()
//   filterWilayah();
// });

// // Event listener kecamatan
// document.querySelectorAll('.filter-wilayah').forEach(cb => {
//     cb.addEventListener('change', filterWilayah);
// });

// // Tombol reset
// document.getElementById('resetBtn').addEventListener('click', function () {
//     document.querySelectorAll('.filter-wilayah').forEach(cb => cb.checked = false);
//     filterWilayah();
// });

// =================== LEAFLET CONTROL ===================
L.Control.Wilayah = L.Control.extend({
  onAdd: function (map) {
    const container = L.DomUtil.create("div", "leaflet-control wilayah-popup");

    container.innerHTML = `
      <div class="layer-card" title="Fitur untuk menampilkan icon dan wilayah">
        <!-- Header -->
        <div class="layer-header" onclick="toggleWilayahPanel()">
          <span>Katalog Layer</span>
          <i class="fa fa-map-marker-alt"></i>
          <i class="fa fa-chevron-down toggle-icon"></i>
        </div>

        <!-- Body -->
        <div class="layer-body" id="wilayahBody">
          <!-- Filter ikon -->
          <div class="form-check">
            <div class="form-check-title">Filter Ikon</div>
            <input class="form-check-input" type="checkbox" id="filterDamkar" checked>
            <label class="form-check-label" for="filterDamkar">Tampilkan Damkar</label>
          </div>

          <hr>

          <!-- Pilih semua -->
          <div class="form-check mb-2">
            <input class="form-check-input" type="checkbox" id="wilayahSelectAllMap">
            <label class="form-check-label fw-bold" for="wilayahSelectAllMap">Pilih Semua</label>
          </div>

          <hr>

          <!-- Daftar wilayah -->
          <div class="wilayah-list">
            ${["Barat", "Selatan", "Tengah", "Timur", "Utara"]
              .map((kec, i) => {
                const id = `wilayahMap-${i}`;
                return `
                  <div class="form-check">
                    <input class="form-check-input filter-wilayah" type="checkbox" 
                          value="Banjarmasin ${kec}" id="${id}" checked>
                    <label class="form-check-label" for="${id}">
                      Banjarmasin ${kec}
                    </label>
                  </div>
                `;
              })
              .join("")}
          </div>
          <hr>

          <!-- Tombol reset -->
          <button class="btn btn-sm btn-danger w-100 mt-2" id="resetWilayahBtn">
            <i class="fa fa-trash"></i> Reset Semua
          </button>
        </div>
      </div>
    `;

    // stop propagation biar klik gak ganggu map
    L.DomEvent.disableClickPropagation(container);

    // === EVENT HANDLER ===
    const filterDamkar = container.querySelector("#filterDamkar");
    const selectAll = container.querySelector("#wilayahSelectAllMap");
    const wilayahChecks = container.querySelectorAll(".filter-wilayah");

    // Damkar checkbox
    filterDamkar.addEventListener("change", () => {
      filterMarkers(); // 🔥 trigger ulang filter damkar
    });

    // Reset semua
    container.querySelector("#resetWilayahBtn").addEventListener("click", () => {
      wilayahChecks.forEach(cb => cb.checked = false);
      selectAll.checked = false;
        // uncheck filter damkar juga
      const filterDamkar = container.querySelector("#filterDamkar");
      if (filterDamkar) filterDamkar.checked = false;

      // refresh ulang
      filterWilayah();
      filterMarkers();
    });


    // Pilih semua
    selectAll.addEventListener("change", function () {
      wilayahChecks.forEach(cb => cb.checked = this.checked);
      filterWilayah();
      filterMarkers();
    });

    // Checkbox per wilayah
    wilayahChecks.forEach(cb => {
      cb.checked = true; // ✅ centang semua default
      cb.addEventListener("change", function () {
        if (!this.checked) {
          selectAll.checked = false;
        } else if ([...wilayahChecks].every(c => c.checked)) {
          selectAll.checked = true;
        }
        filterWilayah();
        filterMarkers();
      });
    });

    // === Inisialisasi awal ===
    selectAll.checked = true;
    wilayahChecks.forEach(cb => cb.checked = true);

    // langsung render default layer + marker
setTimeout(() => {
  filterWilayah();
  filterMarkers();   // ✅ pastikan damkar langsung muncul
}, 0);

    

    return container;
  },

  onRemove: function (map) {
    // opsional cleanup
  },
});

// Register ke Leaflet
L.control.wilayah = function (opts) {
  return new L.Control.Wilayah(opts);
};

// Tambahkan ke map
L.control.wilayah({ position: "topleft" }).addTo(map);

// Toggle tampil/hidden body
function toggleWilayahPanel() {
  const body = document.getElementById("wilayahBody");
  if (!body) return;
  body.style.display = body.style.display === "none" ? "block" : "none";
}


// --- FUNGSI RENDER PANEL KELURAHAN ---
// function renderKelurahanPanel() {
//   const container = document.querySelector('.kelurahan-popup');
//   if (!container) return;

//   container.innerHTML = `
//     <div class="layer-card">
//       <div class="layer-header" onclick="toggleLayer()">
//         <span>Filter Kelurahan</span>
//         <i class="fa fa-layer-group"></i>
//          <i class="fa fa-chevron-down toggle-icon"></i>
//       </div>

//       <div class="layer-body" id="layerBody">
        

//         <div class="kelurahan-section">
//           <div class="kelurahan-section-title" id="kelurahan-title">Kelurahan</div>
//           <div class="kelurahan-list"></div>
//         </div>
//       </div>

//       <div class="layer-footer" id="layerFooter">
//         <button class="btn-delete" onclick="hapusSemuaFilter()">
//           <i class="fa fa-trash"></i> Bersihkan Semua
//         </button>
//       </div>
//     </div>

//   `;

//   const damkarCb = document.getElementById('filterDamkar');
//   if (damkarCb) {
//     damkarCb.addEventListener('change', filterMarkers);
//   }
// }


// --- FUNGSI HAPUS SEMUA FILTER ---
// function hapusSemuaFilter() {
//     // Uncheck semua filter ikon & kelurahan
//   document.querySelectorAll('#filterDamkar, .kelurahan-checkbox').forEach(cb => {
//     cb.checked = false;
//   });

//   // Jalankan ulang filter
//   if (typeof filterMarkers === "function") filterMarkers();
//   if (typeof filterWilayah === "function") filterWilayah();

//   console.log("🔄 Filter ikon & kelurahan sudah direset");
// }



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
  // Buat elemen div Leaflet control
  const div = L.DomUtil.create('div', 'kelurahan-popup leaflet-bar leaflet-control shadow-sm');
  div.style.display = 'block'; // Bisa diubah ke 'none' jika ingin awal tersembunyi

   // 🔹 Default tersembunyi
  div.style.display = 'none';
  // Isi HTML gabungan
  div.innerHTML = `
    <div class="layer-card">
      <div class="layer-header" onclick="toggleKelurahanPanel()">
        <span>Filter Kelurahan</span>
        <i class="fa fa-layer-group"></i>
        <i class="fa fa-chevron-down toggle-icon" id="kelurahanIcon"></i>
      </div>

      <div class="layer-body" id="kelurahanBody">

        <div class="kelurahan-section">
          <div class="kelurahan-section-title" id="kelurahan-title">Kelurahan</div>
          <div class="kelurahan-list"></div>
        </div>
      </div>

      
    </div>
  `;

  // Mencegah event klik ke peta saat interaksi dengan kontrol
  L.DomEvent.disableClickPropagation(div);
  L.DomEvent.disableScrollPropagation(div);

  return div;
};

kelurahanPopupControl.addTo(map);

function toggleKelurahanPanel() {
  const body = document.getElementById("kelurahanBody");
  const icon = document.getElementById("kelurahanIcon");

  if (!body) return;

  if (body.style.display === "none" || body.style.display === "") {
    body.style.display = "block";
    if (icon) {
      icon.classList.remove("fa-chevron-down");
      icon.classList.add("fa-chevron-up");
    }
  } else {
    body.style.display = "none";
    if (icon) {
      icon.classList.remove("fa-chevron-up");
      icon.classList.add("fa-chevron-down");
    }
  }
}


// --- Fungsi hapus semua filter ---
function hapusSemuaFilter() {
  const damkarCheckbox = document.getElementById('filterDamkar');
  if (damkarCheckbox) damkarCheckbox.checked = false;

  // Kosongkan daftar kelurahan jika perlu
  const kelurahanList = document.querySelector('.kelurahan-list');
  if (kelurahanList) kelurahanList.innerHTML = '';

  // Bisa tambahkan logika untuk hide marker dsb
}

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

        const checkbox = document.getElementById(safeId);
        if (checkbox) {
    checkbox.addEventListener('change', function (e) {
        const geojsonPath = `/geojson/${folder}/${encodeURIComponent(file)}`;

        if (e.target.checked) {
            // ✅ Jangan hapus layer kecamatan
            // ✅ Jangan hapus kelurahan lain, biar bisa tampil bareng

            // Tampilkan kelurahan yang dipilih
            fetch(geojsonPath)
                .then(res => res.json())
                .then(data => {
                    const layer = L.geoJSON(data, {
                        filter: f => f.properties.WADMKK === "Kota Banjarmasin",
                        style: {
                            color: "#333",
                            weight: 2.5,
                            fillColor: color,
                            fillOpacity: 0.5
                        }
                    }).bindPopup(`<strong>${name}</strong>`);

                    layer.addTo(map);
                    kelurahanLayerMap[file] = layer;

                    // ❌ Tidak perlu fitBounds
                })
                .catch(err => console.error(`Gagal memuat ${file}:`, err));
        } else {
            // Kelurahan di-uncheck → hapus layernya saja
            if (kelurahanLayerMap[file]) {
                map.removeLayer(kelurahanLayerMap[file]);
                delete kelurahanLayerMap[file];
            }
        }
    });
}

    });

    // Tampilkan panel kelurahan otomatis saat 1 kecamatan dipilih
    const kelurahanPanel = document.querySelector('.kelurahan-popup');
    if(kelurahanPanel) kelurahanPanel.style.display = 'block';
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

<script>
  function toggleHelp() {
  const popup = document.getElementById("helpPopup");
  popup.style.display = (popup.style.display === "block") ? "none" : "block";
}

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
