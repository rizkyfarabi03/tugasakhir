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
    max-height: 45vh;   /* batas maksimal tinggi */
    font-family: Arial, sans-serif;
    box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    position: relative;
    z-index: 2100;

    display: flex;
    flex-direction: column; /* header, body, footer vertikal */
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
  }

  /* Body */
  .layer-body {
    flex: 1;
    overflow-y: auto;     /* scroll hanya kalau isi lebih panjang */
    padding: 10px 15px;
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
    margin-top: 0px;
    margin-bottom: 6px;
    color: #333;
    margin: 0 0 5px 0; /* hilangkan margin kiri */
    padding-left: 0;   /* kalau ada padding bawaan */
    text-align: left;  /* pastikan rata kiri */
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

  /* Custom posisi search box di atas peta */
  .leaflet-control-search {
    position: absolute !important;
    left: 50% !important;
    top: 10px !important;
    transform: translateX(-50%);
    z-index: 1000;
  }

  .kelurahan-popup.leaflet-control {
    z-index: 2000 !important;
    background: transparent; /* atau white kalau mau langsung card */
    border: none;
    box-shadow: none;
  }

  .kelurahan-popup label {
    cursor: pointer;
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

<body class="hold-transition login-page">

  <!-- Particles Background -->
  <div id="particles-js"></div>

  <div class="container my-5 position-relative" style="z-index: 2;">
    <div class="text-center mb-4">
        <h2 class="fw-bold fade-in">SIG Pemadam Kebakaran Kota Banjarmasin</h2>
        <p class="text-muted fade-in delay">Klik peta untuk melihat lokasi pos damkar dan detail wilayah</p>
    </div>

    <div class="map-card mx-auto" style="max-width: 900px; cursor:pointer;"
         onclick="window.location.href='{{ route('home') }}'">
      <div class="card-body p-0">
        <div id="mapPreview" style="height: 400px; width: 100%; border-radius: 20px;"></div>
      </div>
    </div>
  </div>

  <!-- Leaflet -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

  <!-- Particles.js -->
  <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>

  <style>
    body {
      margin: 0;
      background: url('{{ asset('img/beranda.jpg') }}') no-repeat center center fixed;
      background-size: cover;
      overflow-x: hidden;
    }

    /* Particles layer */
    #particles-js {
      position: fixed;
      width: 100%;
      height: 100%;
      top: 0; left: 0;
      z-index: 1;
    }

    /* Animasi fade in */
    .fade-in {
      opacity: 0;
      transform: translateY(20px);
      animation: fadeInUp 1s ease forwards;
      color: #fff;
      text-shadow: 2px 2px 6px rgba(0,0,0,0.7);
    }

    .fade-in.delay {
      animation-delay: 0.5s;
      color: #fff !important;
    }

    @keyframes fadeInUp {
      to { opacity: 1; transform: translateY(0); }
    }

    /* Card efek glassmorphism */
    .map-card {
      background: rgba(255, 255, 255, 0.12);
      backdrop-filter: blur(14px);
      border-radius: 20px;
      overflow: hidden;
      transition: all 0.3s ease-in-out;
      box-shadow: 0 8px 20px rgba(0,0,0,0.4);
      animation: zoomIn 0.8s ease;
    }
    .map-card:hover {
      transform: scale(1.03);
      box-shadow: 0 12px 25px rgba(255, 80, 50, 0.7);
    }

    @keyframes zoomIn {
      from { transform: scale(0.8); opacity: 0; }
      to { transform: scale(1); opacity: 1; }
    }
  </style>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      // Inisialisasi map
      var map = L.map('mapPreview').setView([-3.3186, 114.5944], 12);
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap'
      }).addTo(map);

      L.marker([-3.3186, 114.5944]).addTo(map)
        .bindPopup("Peta Damkar Kota Banjarmasin")
        .openPopup();

      // Particles.js
      particlesJS("particles-js", {
        "particles": {
          "number": { "value": 80 },
          "color": { "value": ["#ff4500", "#ff6347", "#ffa500"] },
          "shape": { "type": "circle" },
          "opacity": {
            "value": 0.7,
            "random": true
          },
          "size": {
            "value": 4,
            "random": true
          },
          "line_linked": { "enable": false },
          "move": {
            "enable": true,
            "speed": 1.5,
            "direction": "top",
            "random": true,
            "straight": false,
            "out_mode": "out"
          }
        },
        "interactivity": {
          "events": {
            "onhover": { "enable": true, "mode": "repulse" }
          }
        },
        "retina_detect": true
      });
    });
  </script>
</body>



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