
<!-- CSS & Leaflet -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>

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

.fire-bg {
  position: fixed;
  top: 0; left: 0;
  width: 100%; height: 100%;
  overflow: hidden;
  z-index: -1; /* tetap di belakang konten */
  pointer-events: none;
}

.fire-bg span {
  position: absolute;
  bottom: -40px; /* start dari bawah layar */
  width: 10px;
  height: 10px;
  background: radial-gradient(circle, #ffcc00, #ff6600, #ff0000);
  border-radius: 50%;
  animation: rise 6s linear infinite;
  opacity: 0.7;
}

/* bikin posisi acak untuk tiap partikel */
.fire-bg span:nth-child(1)  { left: 10%; animation-delay: 0s;  animation-duration: 5s; }
.fire-bg span:nth-child(2)  { left: 20%; animation-delay: 1s;  animation-duration: 7s; }
.fire-bg span:nth-child(3)  { left: 30%; animation-delay: 2s;  animation-duration: 6s; }
.fire-bg span:nth-child(4)  { left: 40%; animation-delay: 3s;  animation-duration: 5s; }
.fire-bg span:nth-child(5)  { left: 50%; animation-delay: 4s;  animation-duration: 8s; }
.fire-bg span:nth-child(6)  { left: 60%; animation-delay: 1s;  animation-duration: 6s; }
.fire-bg span:nth-child(7)  { left: 70%; animation-delay: 2s;  animation-duration: 7s; }
.fire-bg span:nth-child(8)  { left: 80%; animation-delay: 3s;  animation-duration: 5s; }
.fire-bg span:nth-child(9)  { left: 90%; animation-delay: 4s;  animation-duration: 6s; }
.fire-bg span:nth-child(10) { left: 15%; animation-delay: 5s;  animation-duration: 7s; }
.fire-bg span:nth-child(11) { left: 25%; animation-delay: 2s;  animation-duration: 6s; }
.fire-bg span:nth-child(12) { left: 35%; animation-delay: 3s;  animation-duration: 8s; }
.fire-bg span:nth-child(13) { left: 45%; animation-delay: 1s;  animation-duration: 5s; }
.fire-bg span:nth-child(14) { left: 55%; animation-delay: 2s;  animation-duration: 6s; }
.fire-bg span:nth-child(15) { left: 65%; animation-delay: 4s;  animation-duration: 7s; }
.fire-bg span:nth-child(16) { left: 75%; animation-delay: 5s;  animation-duration: 5s; }
.fire-bg span:nth-child(17) { left: 85%; animation-delay: 3s;  animation-duration: 6s; }
.fire-bg span:nth-child(18) { left: 95%; animation-delay: 2s;  animation-duration: 7s; }
.fire-bg span:nth-child(19) { left: 5%;  animation-delay: 4s;  animation-duration: 5s; }
.fire-bg span:nth-child(20) { left: 50%; animation-delay: 6s;  animation-duration: 8s; }

@keyframes rise {
  0%   { transform: translateY(0) scale(1); opacity: 0.7; }
  50%  { transform: translateY(-50vh) scale(1.5); opacity: 0.9; }
  100% { transform: translateY(-100vh) scale(0.5); opacity: 0; }
}

  
  #map { height: 85vh; }

  .login-link {
    transition: all 0.3s ease;
  }

  .login-link:hover {
    color: #ffc107 !important;
    text-decoration: underline;
    cursor: pointer;
  }

  .navbar-toggler-icon {
    filter: invert(100%);
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
</style>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-dark">
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


<!-- Tambahkan di dalam body -->
<div class="fire-bg">
  <!-- 20 partikel api -->
  <span></span><span></span><span></span><span></span><span></span>
  <span></span><span></span><span></span><span></span><span></span>
  <span></span><span></span><span></span><span></span><span></span>
  <span></span><span></span><span></span><span></span><span></span>
</div>

<!-- Konten Statistik -->
<div class="container text-center my-5">
    <h2 class="mb-4" style="color:white;">Statistik Pos Damkar per Kecamatan</h2>
    <div class="row justify-content-center">
        <div class="col-md-6 mb-4">
            <canvas id="barChart"></canvas>
        </div>
        <div class="col-md-6 mb-4">
            <canvas id="pieChart"></canvas>
        </div>
    </div>

    <h4 class="mt-5 mb-3">Jumlah Pos Damkar per Kecamatan</h4>
    <table class="table table-bordered">
        <thead class="table-secondary">
            <tr>
                <th>No</th>
                <th>Nama Kecamatan</th>
                <th>Jumlah Pos Damkar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $i => $item)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $item->kecamatan }}</td>
                    <td>{{ $item->total }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Tabel Pos Damkar -->
<div class="container my-5">
  <center><h3 class="mb-4">Daftar Pos Damkar</h3></center>
  
  <form id="form-filter-kecamatan" class="mb-4">
    <div class="row">
        <div class="col-md-4">
            <label for="kecamatan" class="form-label">Filter Kecamatan</label>
            <select name="kecamatan" id="filter-kecamatan" class="form-select">
                <option value="">-- Semua Kecamatan --</option>
                @foreach ($list_kecamatan as $kec)
                    <option value="{{ $kec }}">{{ $kec }}</option>
                @endforeach
            </select>
        </div>
    </div>
</form>


<div id="damkar-table">
    <div class="table-responsive">
    <table class="table table-striped table-bordered align-middle">
      <thead class="table-dark text-center">
        <tr>
          <th>No</th>
          <th>Nama Pos</th>
          <th>Kecamatan</th>
          <th>Jumlah Anggota</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
    @foreach ($damkars as $index => $pos)
    <tr>
      <td class="text-center">{{ $damkars->firstItem() + $index }}</td>
      <td>{{ $pos->nama_pos }}</td>
      <td>{{ $pos->kecamatan }}</td>
      <td class="text-center">{{ $pos->anggota_count }}</td>
      <td class="text-center">
        <!-- Tombol Lihat Anggota -->
        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#anggotaModal{{ $pos->id }}">
          Lihat Anggota
        </button>
      </td>
    </tr>
    @endforeach
  </tbody>
  </table> <!-- penutup table di sini -->
</div>

{{-- <div id="pagination-links"> jangan dibungkus di dalam #damkar-table --}}
<div id="pagination-links" class="d-flex justify-content-center mt-3">
  {!! $damkars->withQueryString()->links('pagination::bootstrap-5') !!}
</div>

<!-- Modal Diletakkan Setelah Table -->
@foreach ($damkars as $pos)
<div class="modal fade" id="anggotaModal{{ $pos->id }}" tabindex="-1" aria-labelledby="anggotaModalLabel{{ $pos->id }}" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="anggotaModalLabel{{ $pos->id }}">Anggota Pos: {{ $pos->nama_pos }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        @php $anggotaPos = $pos->anggota; @endphp
        @if($anggotaPos->isEmpty())
          <p class="text-muted">Belum ada anggota tercatat.</p>
        @else
        <div class="table-responsive">
          <table class="table table-sm table-bordered">
            <thead class="table-secondary text-center">
              <tr>
                <th>No</th>
                <th>Nama</th>                
                <th>No Register</th>
              </tr>
            </thead>
            <tbody>
              @foreach($anggotaPos as $i => $a)
              <tr>
                <td class="text-center">{{ $i + 1 }}</td>
                <td>{{ $a->nama }}</td>
                <td>{{ $a->no_register }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        @endif
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
@endforeach

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const labels = @json($labels);
    const values = @json($values);

    const colors = labels.map(() => {
        const r = Math.floor(Math.random() * 255);
        const g = Math.floor(Math.random() * 255);
        const b = Math.floor(Math.random() * 255);
        return `rgba(${r}, ${g}, ${b}, 0.7)`;
    });

    const borderColors = colors.map(c => c.replace('0.7', '1'));

    // Bar Chart
    new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Jumlah Pos Damkar',
                data: values,
                backgroundColor: colors,
                borderColor: borderColors,
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    labels: {
                        color: "#dddddd" // warna legend lebih terang (abu muda)
                    }
                }
            },
            scales: {
                x: {
                    ticks: {
                        color: "#dddddd" // label kecamatan (sumbu X)
                    }
                },
                y: {
                    beginAtZero: true,
                    precision: 0,
                    ticks: {
                        color: "#dddddd" // angka di sumbu Y
                    }
                }
            }
        }
    });

    // Pie Chart
    new Chart(document.getElementById('pieChart'), {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                label: 'Persentase Pos Damkar',
                data: values,
                backgroundColor: colors,
                borderColor: borderColors,
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    labels: {
                        color: "#dddddd" // label legend di pie chart
                    }
                }
            }
        }
    });
</script>


<script>
    function loadDamkar(kecamatan, pageUrl = null) {
        $.ajax({
            url: pageUrl || "{{ route('statistik.filter') }}",
            data: { kecamatan: kecamatan },
            success: function (data) {
                $('#damkar-table').html(data.table);
                $('#pagination-links').html(data.pagination);
            },
            error: function () {
                console.error('Gagal memuat data.');
            }
        });
    }

    // Saat dropdown diganti
    $('#filter-kecamatan').on('change', function () {
        let selected = $(this).val();

        if (selected) {
            loadDamkar(selected);
        } else {
            // Jika tidak ada filter, reload seluruh halaman (reset default)
            location.href = "{{ route('statistik.index') }}";
        }
    });

    // Saat klik link pagination
    $(document).on('click', '.pagination a', function (e) {
        let kecamatan = $('#filter-kecamatan').val();

        if (!kecamatan) {
            // Kalau tidak sedang filter, biarkan default link jalan (full reload)
            return;
        }

        e.preventDefault(); // blok default click hanya saat filter aktif
        let url = $(this).attr('href');
        loadDamkar(kecamatan, url);
    });
</script>




<!-- Footer -->
<footer>
    <p>&copy; 2025 <strong>SIG Pemadam Kebakaran Kota Banjarmasin</strong>. All rights About Fire.</p>
    {{-- <p>Built with ❤️ by <a href="https://www.instagram.com/rizkyfarabi_" target="_blank" style="color: #07655f; text-decoration: none;">Muhammad Rizky</a></p> --}}
</footer>
