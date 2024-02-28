@push('style')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ URL::asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ URL::asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ URL::asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ URL::asset('plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ URL::asset('css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ URL::asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ URL::asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ URL::asset('plugins/summernote/summernote-bs4.min.css') }}">
@endpush

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link text-decoration-none">
    <img src="{{ URL::asset('/img/nawansite.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Warehouse Pro</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
            <img src="img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info text-capitalize text-lg font-weight-bold text-white">
                {{ auth()->user()->name; }}
            </div>
        </div> --}}

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
                <li class="nav-header text-uppercase font-weight-bold">Home</li>
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                    </a>
                </li>
                <li class="nav-header text-uppercase font-weight-bold">Data</li>

                {{-- Menu penyewaan --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                        Penyewaan
                        <i class="fas fa-angle-left right"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview ml-4">
                        <li class="nav-item">
                            <a href="{{ route('penyewaan.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Booking</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('alat.riwayat') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Riwayat Sewa</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('alat.terpakai') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Alat Terpakai</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('alat.tersedia') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Alat Tersedia</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- Menu database alat --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-database"></i>
                    <p>
                        Database Alat
                        <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview ml-4">
                        <li class="nav-item">
                            <a href="{{ route('alat.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Tambah Data</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('alat.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Data Alat</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- Menu client --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        Client
                        <i class="fas fa-angle-left right"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview ml-4">
                        <li class="nav-item">
                            <a href="{{ route('user.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Tambah Data</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Data Client</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- Menu keuangan --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-money-check"></i>
                    <p>
                        Keuangan
                        <i class="fas fa-angle-left right"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview ml-4">
                        <li class="nav-item">
                            <a href="{{ route('keuangan.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Pembayaran</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('riwayat.pembayaran') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Riwayat</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- Menu cetak --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-print"></i>
                    <p>
                        Cetak
                        <i class="fas fa-angle-left right"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview ml-4">
                        <li class="nav-item">
                            <a href="{{ route('cetak.suratjalan') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Surat Jalan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('cetak.buktibayar') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Bukti Bayar</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- Menu laporan --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-clipboard-list"></i>
                    <p>
                        Laporan
                        <i class="fas fa-angle-left right"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview ml-4">
                        <li class="nav-item">
                            <a href="{{ route('laporan.alat') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Data Alat</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('laporan.client') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Data Client</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('laporan.pembayaran') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Data Pembayaran</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-user-check"></i>
                    <p>
                        Admin
                        <i class="fas fa-angle-left right"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview ml-4">
                        <li class="nav-item">
                            <a href="{{ route('admin.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Tambah Admin</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Data Admin</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header text-uppercase font-weight-bold">Profil</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-user-alt"></i>
                    <p>
                        Profil Saya
                        <i class="fas fa-angle-left right"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview ml-4">
                        <li class="nav-item">
                            <a href="{{ route('profile') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Edit Profil</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
        {{-- <form method="POST" class="nav-link" action="{{ route('logout') }}">
            @csrf
            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                    this.closest('form').submit();">
                                    <i class="fas fa-sign-out-alt"></i>
                                    {{ __('Logout') }}
            </x-dropdown-link>
        </form> --}}
    </div>
    <!-- /.sidebar -->
</aside>

@push('script')
<!-- jQuery -->
<script type="text/javascript" src="{{ URL::asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script type="text/javascript" src="{{ URL::asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script type="text/javascript" src="{{ URL::asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script type="text/javascript" src="{{ URL::asset('plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script type="text/javascript" src="{{ URL::asset('plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script type="text/javascript" src="{{ URL::asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script type="text/javascript" src="{{ URL::asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script type="text/javascript" src="{{ URL::asset('plugins/moment/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script type="text/javascript" src="{{ URL::asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script type="text/javascript" src="{{ URL::asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script type="text/javascript" src="{{ URL::asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script type="text/javascript" src="{{ URL::asset('js/adminlte.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script type="text/javascript" src="{{ URL::asset('js/demo.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script type="text/javascript" src="{{ URL::asset('js/pages/dashboard.js') }}"></script>
@endpush