
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin SIG Pemadam Kebakaran Kota BJM</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="AdminLTE/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="AdminLTE/dist/css/adminlte.min.css">

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="AdminLTE/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">SIG Pemadam Kebakaran Kota Banjarmasin</a>
      </li>
      {{-- <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> --}}
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="nav-link" style="color: black !important;">Logout</button>
          </form>
        </li>
      </ul>

      

      {{-- <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item"> --}}
            <!-- Message Start -->
            {{-- <div class="media">
              <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div> --}}
            <!-- Message End -->
          {{-- </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item"> --}}
            <!-- Message Start -->
            {{-- <div class="media">
              <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div> --}}
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          {{-- <a href="#" class="dropdown-item"> --}}
            <!-- Message Start -->
            {{-- <div class="media">
              <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div> --}}
            <!-- Message End -->
          </a>
          {{-- <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div> --}}
      </li>
      <!-- Notifications Dropdown Menu -->
      {{-- <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li> --}}
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
      <img src="AdminLTE/dist/img/DPKP.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">DAMKAR BJM</span>
    </a> 

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="#" class="d-block">Selamat Datang Admin</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      {{-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> --}}

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-header">EXAMPLES</li>
          <li class="nav-item">
            <a href="{{ route('damkar.index') }}" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Data Damkar
                {{-- <span class="badge badge-info right">2</span> --}}
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('anggota.index') }}" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                Data Anggota
              </p>
            </a>
          </li>
          {{-- <li class="nav-item">
            <a href="pages/kanban.html" class="nav-link">
              <i class="nav-icon fas fa-columns"></i>
              <p>
                Kanban Board
              </p>
            </a>
          </li> --}}
          
          {{-- <li class="nav-item">
            <a href="pages/kanban.html" class="nav-link">
              <i class="nav-icon far fa-plus-square"></i>
              <p>
                Extras
              </p>
            </a>
          </li>         
        </ul>
      </nav> --}}
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

<div class="wrapper d-flex flex-column min-vh-100">
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper flex-grow-1">
    @yield('content')

@isset($perKecamatan)
{{-- Small Box Statistik --}}
<div class="row">
    @foreach($perKecamatan as $namaKecamatan => $jumlah)
        <div class="col-lg-2 col-md-4 col-6">
            <div class="small-box 
                {{ $loop->iteration % 4 == 1 ? 'bg-primary' : ($loop->iteration % 4 == 2 ? 'bg-success' : ($loop->iteration % 4 == 3 ? 'bg-warning' : 'bg-danger')) }}">
                <div class="inner">
                    <h4>{{ $jumlah }}</h4>
                    <p>{{ $namaKecamatan }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-fire-extinguisher"></i>
                </div>
                <a href="{{ route('damkar.index', ['kecamatan' => $namaKecamatan]) }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    @endforeach
</div>

{{-- Chart Statistik --}}
<div class="row mt-4">
    <div class="col-md-5 offset-md-2"> {{-- col lebih kecil + ada margin kiri --}}
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Statistik Damkar per Kecamatan</h3>
            </div>
            <div class="card-body">
                <canvas id="chartKecamatan"></canvas>
            </div>
        </div>
    </div>
</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const kecamatanCtx = document.getElementById('chartKecamatan').getContext('2d');
    new Chart(kecamatanCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($perKecamatan->keys()) !!},
            datasets: [{
                label: 'Jumlah Damkar',
                data: {!! json_encode($perKecamatan->values()) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.8)'
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } }
        }
    });
</script>

{{-- Styling --}}
<style>
    .small-box {
        min-height: 110px;
        padding: 12px; /* padding lebih lega */
        margin-top: 10px; /* jarak dari atas */
        margin-left: 10px; /* jarak dari kiri */
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .small-box .inner {
        padding: 5px;
    }
    .small-box h4 {
        font-size: 1.5rem;
        margin: 0;
        font-weight: bold;
    }
    .small-box p {
        font-size: 0.9rem;
        margin: 0;
    }
    .small-box .icon {
        font-size: 40px;
        top: 10px;
        opacity: 0.4;
    }
    .small-box-footer {
        font-size: 0.8rem;
        padding: 4px;
    }
    .small-box:hover {
        transform: translateY(-4px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
</style>
@endisset


</div>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2025 <a href="https://adminlte.io">SIG Pemadam Kebakaran Kota Banjarmasin</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0
    </div>
  </footer>
</div>
</div>
<!-- ./wrapper -->


<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="AdminLTE/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="AdminLTE/dist/js/adminlte.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="AdminLTE/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="AdminLTE/plugins/raphael/raphael.min.js"></script>
<script src="AdminLTE/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="AdminLTE/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="AdminLTE/plugins/chart.js/Chart.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="AdminLTE/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="AdminLTE/dist/js/pages/dashboard2.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



<!-- Flash Message jika login/logout sukses -->
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
@stack('scripts')


</body>
</html>
