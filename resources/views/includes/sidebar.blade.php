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
    <img src="{{ URL::asset('/img/mediakreasi.png') }}" alt="Logo" class="brand-image img-circle elevation-3" style="width:50px">
    <span class="brand-text font-weight-light">Media Kreasi</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
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

                {{-- Menu Event --}}
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-calendar-alt"></i>
                    <p>
                        Event
                        <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('event.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon" style="color: transparent"></i>
                            <p>Tambah Event</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('event.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon" style="color: transparent"></i>
                            <p>Data Event</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('event.berjalan') }}" class="nav-link">
                            <i class="far fa-circle nav-icon" style="color: transparent"></i>
                            <p>Event Berjalan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('event.riwayat') }}" class="nav-link">
                            <i class="far fa-circle nav-icon" style="color: transparent"></i>
                            <p>Riwayat Event</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- Menu penyewaan --}}
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                        Penyewaan
                        <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('penyewaan.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon" style="color: transparent"></i>
                            <p>Data Sewa</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('alat.tersedia') }}" class="nav-link">
                            <i class="far fa-circle nav-icon" style="color: transparent"></i>
                            <p>Alat Tersedia</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('alat.terpakai') }}" class="nav-link">
                            <i class="far fa-circle nav-icon" style="color: transparent"></i>
                            <p>Alat Terpakai</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('alat.riwayat') }}" class="nav-link">
                            <i class="far fa-circle nav-icon" style="color: transparent"></i>
                            <p>Riwayat Sewa</p>
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
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('alat.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon" style="color: transparent"></i>
                            <p>Tambah Data</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('alat.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon" style="color: transparent"></i>
                            <p>Data Alat</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('alat.maintenance') }}" class="nav-link">
                            <i class="far fa-circle nav-icon" style="color: transparent"></i>
                            <p>Daftar Maintenance</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- Menu crew --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-user-tag"></i>
                    <p>
                        Crew
                        <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('crew.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon" style="color: transparent"></i>
                            <p>Tambah Data</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('crew.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon" style="color: transparent"></i>
                            <p>Data Crew</p>
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
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('user.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon" style="color: transparent"></i>
                            <p>Tambah Data</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon" style="color: transparent"></i>
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
                        Pembayaran
                        <i class="fas fa-angle-left right"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('keuangan.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon" style="color: transparent"></i>
                            <p>Bayar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('keuangan.downpayment') }}" class="nav-link">
                            <i class="far fa-circle nav-icon" style="color: transparent"></i>
                            <p>Pelunasan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('riwayat.pembayaran') }}" class="nav-link">
                            <i class="far fa-circle nav-icon" style="color: transparent"></i>
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
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('cetak.suratjalan') }}" class="nav-link">
                            <i class="far fa-circle nav-icon" style="color: transparent"></i>
                            <p>Surat Jalan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('cetak.buktibayar') }}" class="nav-link">
                            <i class="far fa-circle nav-icon" style="color: transparent"></i>
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
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('laporan.alat') }}" class="nav-link">
                            <i class="far fa-circle nav-icon" style="color: transparent"></i>
                            <p>Data Alat</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('laporan.client') }}" class="nav-link">
                            <i class="far fa-circle nav-icon" style="color: transparent"></i>
                            <p>Data Client</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('laporan.pembayaran') }}" class="nav-link">
                            <i class="far fa-circle nav-icon" style="color: transparent"></i>
                            <p>Data Pembayaran</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @if (auth()->user()->is_admin == '1')
                <li class="nav-item">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-user-check"></i>
                    <p>
                        Admin
                        <i class="fas fa-angle-left right"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon" style="color: transparent"></i>
                            <p>Tambah Admin</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon" style="color: transparent"></i>
                            <p>Data Admin</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @else
                    
                @endif
                <li class="nav-header text-uppercase font-weight-bold">Profil</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-user-alt"></i>
                    <p>
                        Profil Saya
                        <i class="fas fa-angle-left right"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('profile') }}" class="nav-link">
                            <i class="far fa-circle nav-icon" style="color: transparent"></i>
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

{{-- @push('script')
<script>
    /** add active class and stay opened when selected */
    var url = window.location;

    // for sidebar menu entirely but not cover treeview
    $('ul.nav-sidebar a').filter(function() {
        return this.href == url;
    }).addClass('active');

    // for treeview
    $('ul.nav-treeview a').filter(function() {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
    </script>
@endpush --}}

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
<script>
    /** add active class and stay opened when selected */
    var url = window.location;

    // for sidebar menu entirely but not cover treeview
    $('ul.nav-sidebar a').filter(function() {
        return this.href == url;
    }).addClass('active');

    // for treeview
    $('ul.nav-treeview a').filter(function() {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
    </script>
@endpush