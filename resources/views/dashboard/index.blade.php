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
        {{-- sweet alert2 css --}}
        <link rel="stylesheet" href="{{ URL::asset('assets/sweet-alert/css/sweetalert2.min.css') }}" />
        {{-- bootstrap@5.3.0-alpha3 css --}}
        <link rel="stylesheet" href="{{ URL::asset('assets/bootstrap-5/css/bootstrap.min.css') }}" />
@endpush

@extends('layouts.main')

@section('content')

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="img/mediakreasi-full.png" alt="AdminLTELogo" width="300">
    </div>

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 connectedSortable">
                    <div class="card bg-gradient-success small-box">
                        <div class="card-header">
                            <div class="card-title">
                                Total Pendapatan
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="inner">
                                <h3>
                                    Rp {{ number_format($total_pendapatan, 0, ',', '.') }}
                                </h3>
                                <p class="fw-bold fst-italic h3">dari {{ $jumlah_payment }} transaksi pembayaran</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-dollar-sign"></i>
                            </div>
                        </div>
                        <div class="card-footer text-center small-box-footer">
                            <a href="{{ route('riwayat.pembayaran') }}" target="_blank" class="text-decoration-none text-white">Info Lengkap <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="card bg-gradient-danger small-box">
                        <div class="card-header">
                            <div class="card-title">
                                Total Belum Bayar
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="inner">
                                <h3>
                                    Rp {{ number_format($total_piutang, 0, ',', '.') }}
                                </h3>
                                <p class="fw-bold fst-italic h3">dari {{ $jumlah_piutang }} approval event / alat</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-credit-card"></i>
                            </div>
                        </div>
                        <div class="card-footer text-center small-box-footer">
                            <a href="{{ route('keuangan.index') }}" target="_blank" class="text-decoration-none text-white">Info Lengkap <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" style="height: 100%">
                    <section class="connectedSortable">
                        <!-- Calendar -->
                        <div class="card bg-gradient-lightblue">
                            <div class="card-header border-0">
                                <h3 class="card-title">
                                <i class="far fa-calendar-alt"></i>
                                Kalender
                                </h3>
                                <!-- tools card -->
                                <div class="card-tools">
                                    <!-- button with a dropdown -->
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">
                                        <i class="fas fa-bars"></i>
                                        </button>
                                        <div class="dropdown-menu" role="menu">
                                        <a href="{{ route('event.create') }}" target="_blank" class="dropdown-item">Tambah Event</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="{{ route('event.index') }}" target="_blank" class="dropdown-item">Lihat Event</a>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-primary btn-sm" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                <!-- /. tools -->
                            </div>
                            <!-- /.card-header -->
                                <div class="card-body pt-0">
                                    <!--The calendar -->
                                    <div id="calendar" style="width: 100%"></div>
                                </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-4 text-center">
                                        <div id="sparkline-1"></div>
                                        <div class="text-white">Event</div>
                                    </div>
                                    <!-- ./col -->
                                    <div class="col-4 text-center">
                                        <div id="sparkline-2"></div>
                                        <div class="text-white">Sewa Alat</div>
                                    </div>
                                    <!-- ./col -->
                                    <div class="col-4 text-center">
                                        <div id="sparkline-3"></div>
                                        <div class="text-white">Crew</div>
                                    </div>
                                <!-- ./col -->
                                </div>
                                <!-- /.row -->
                            </div>
                        </div>
                    </section>
                </div>
            </div>

            @if(auth()->user()->is_admin == '1')
            <!-- Widget Approval -->
            <div class="row connectedSortable">
                <div class="col-md-6">
                    <div class="card bg-gradient-info small-box">
                        <div class="card-header border-0">
                            <div class="card-title">
                                Approval Sewa Alat
                            </div>
                            <div class="card-tools">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">
                                    <i class="fas fa-bars"></i>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                    <a href="{{ route('alat.tersedia') }}" target="_blank" class="dropdown-item">Booking Alat</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="{{ route('penyewaan.index') }}" target="_blank" class="dropdown-item">Lihat Data Sewa</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="inner">
                                @if($approval_penyewaan == 0)
                                    <h4>
                                        Belum Ada Data Sewa
                                    </h4>
                                @else
                                    <h4>
                                    {{ $approval_penyewaan }} Menunggu Approval
                                    </h4>
                                @endif
                            </div>
                            <div class="icon">
                                <i class="fa fa-check"></i>
                            </div>
                        </div>
                        <div class="card-footer text-center small-box-footer">
                            <a href="{{ route('penyewaan.index') }}" target="_blank" class="text-decoration-none text-white">Info Lengkap <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card bg-gradient-info small-box">
                        <div class="card-header border-0">
                            <div class="card-title">
                                Approval Event
                            </div>
                            <div class="card-tools">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">
                                    <i class="fas fa-bars"></i>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                    <a href="{{ route('event.create') }}" target="_blank" class="dropdown-item">Buat Event</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="{{ route('event.index') }}" target="_blank" class="dropdown-item">Approval Event</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="inner text-sm">
                            @if($approval_event == 0)
                                <h4>
                                    Belum Ada Data Event
                                </h4>
                            @else
                                <h4>
                                {{ $approval_event }} Menunggu Approval
                                </h4>
                            @endif
                            </div>
                            <div class="icon">
                                <i class="fa fa-check"></i>
                            </div>
                        </div>
                        <div class="card-footer text-center small-box-footer">
                            <a href="{{ route('event.index') }}" target="_blank" class="text-decoration-none text-white">Info Lengkap <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            @else
            @endif

            <!-- Widget Return -->
            <div class="row connectedSortable">
                <div class="col-md-6">
                    <div class="card bg-gradient-primary small-box">
                        <div class="card-header border-0">
                            <div class="card-title">
                                Konfirmasi Event Selesai
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="inner">
                            @if($jumlah_event == 0)
                                <h4>
                                    Belum Ada Event
                                </h4>
                            @else
                                <h3>
                                {{ $jumlah_event }} Event Berjalan
                                </h3>
                            @endif
                            </div>
                            <div class="icon">
                                <i class="fa fa-sync-alt"></i>
                            </div>
                        </div>
                        <div class="card-footer text-center small-box-footer">
                            <a href="{{ route('event.berjalan') }}" target="_blank" class="text-decoration-none text-white">Info Lengkap <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-md-6">
                    <div class="card bg-gradient-primary small-box">
                        <div class="card-header border-0">
                            <div class="card-title">
                                Konfirmasi Pengembalian Alat
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="inner">
                            @if($alat_terpakai == 0)
                                <h4>
                                    Belum Ada Alat Terpakai
                                </h4>
                            @else
                                <h3>
                                {{ $alat_terpakai }} Alat Terpakai
                                </h3>
                            @endif
                            </div>
                            <div class="icon">
                                <i class="fa fa-sync-alt"></i>
                            </div>
                        </div>
                        <div class="card-footer text-center small-box-footer">
                            <a href="{{ route('alat.terpakai') }}" target="_blank" class="text-decoration-none text-white">Info Lengkap <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- row 2 -->
            <div class="row connectedSortable">
                <div class="col-md-4">
                    <div class="card bg-gradient-info small-box">
                        <div class="card-header border-0">
                            <div class="card-title">
                                Total Data Peralatan
                            </div>
                            <div class="card-tools">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">
                                    <i class="fas fa-bars"></i>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                    <a href="{{ route('alat.create') }}" target="_blank" class="dropdown-item">Tambah Alat</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="{{ route('alat.index') }}" target="_blank" class="dropdown-item">Lihat Alat</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="inner">
                                <h3>
                                {{ $jumlah_alat }} Alat
                                </h3>
                            </div>
                            <div class="icon">
                                <i class="fa fa-toolbox"></i>
                            </div>
                        </div>
                        <div class="card-footer text-center small-box-footer">
                            <a href="{{ route('alat.index') }}" target="_blank" class="text-decoration-none text-white">Info Lengkap <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-md-4">
                    <div class="card bg-gradient-fuchsia small-box">
                        <div class="card-header border-0">
                            <div class="card-title">
                                Total Data Event
                            </div>
                            <div class="card-tools">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">
                                    <i class="fas fa-bars"></i>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                    <a href="{{ route('event.create') }}" target="_blank" class="dropdown-item">Tambah Event</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="{{ route('event.index') }}" target="_blank" class="dropdown-item">Lihat Event</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="inner">
                                <h3>
                                {{ $data_event }} Event
                                </h3>
                            </div>
                            <div class="icon">
                                <i class="fa fa-music"></i>
                            </div>
                        </div>
                        <div class="card-footer text-center small-box-footer">
                            <a href="{{ route('event.index') }}" target="_blank" class="text-decoration-none text-white">Info Lengkap <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-md-4">
                    <!-- small box -->
                    <div class="card bg-gradient-warning small-box">
                        <div class="card-header border-0">
                            <div class="card-title">
                                Total Client
                            </div>
                            <div class="card-tools">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">
                                    <i class="fas fa-bars"></i>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                    <a href="{{ route('user.create') }}" target="_blank" class="dropdown-item">Tambah Client</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="{{ route('user.index') }}" target="_blank" class="dropdown-item">Lihat Client</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="inner">
                                <h3>
                                {{ $jumlah_client }} Client
                                </h3>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                        </div>
                        <div class="card-footer text-center small-box-footer">
                            <a href="{{ route('user.index') }}" target="_blank" class="text-decoration-none text-white">Info Lengkap <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
            
    </section>

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
    {{-- sweet alert2 js --}}
    <script type="text/javascript" src="{{ URL::asset('assets/sweet-alert/js/sweetalert2.all.min.js') }}"></script>
    {{-- sweet alert js --}}
    <script type="text/javascript" src="{{ URL::asset('assets/sweet-alert/js/sweetalert.min.js') }}"></script>
    {{-- bootstrap password jscript --}}
    <script type="text/javascript" src="{{ URL::asset('assets/bootstrap-5/js/bootstrap-show-password.min.js') }}"></script>
    {{-- image preview js --}}
    <script type="text/javascript">
        function previewImage(){
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview');
            imgPreview.style.display = 'block';
            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);
            oFReader.onload = function(oFREvent){
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
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
@endsection