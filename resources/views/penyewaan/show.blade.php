@push('style')
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
@endpush

@extends('layouts.main')

@section('content')

{{-- <h1 class="mt-4">Dashboard</h1>
<ol class="mb-4 breadcrumb">
    <li class="breadcrumb-item active">Home</li>
</ol> --}}

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Penyewaan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Penyewaan</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('penyewaan.index') }}">Data Sewa</a></li>
                        <li class="breadcrumb-item active">View</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="card mt-10 mb-5">
        <div class="card-header text-center fw-bold text-uppercase mb-10 bg-info text-white">
            View Data Booking Alat
        </div>
        <div class="card-group">
            <div class="card-body col-md-6 bg-light mt-3">
                <div class="card-header text-center text-white text-uppercase fw-bold bg-secondary">
                    {{ $user->name }}
                </div>
                <div class="card-body bg-white">
                    <div class="card-group">
                        <div class="card-bod col-md-6">
                            <div class="card-img mt-5">
                                @if($user->image)  
                                <img src="{{ asset('storage/' . $user->image) }}" class="rounded mx-auto d-block img-thumbnail mb-2" width="250" alt="">
                                @else
                                <img src="{{ $user->gravatar }}" width="300" alt="">
                                @endif
                            </div>
                        </div>
                        <div class="card-body col-md-6">
                            <p class="card-text fw-bold m-0">Tanggal Pinjam</p>
                            <p class="fst-italic mb-2">{{ \Carbon\Carbon::parse($event->date_start)->isoFormat('dddd, D MMMM Y') }}</p>
                            <p class="card-text fw-bold m-0">Tanggal Kembali</p>
                            <p class="fst-italic mb-2">{{ \Carbon\Carbon::parse($event->date_end)->isoFormat('dddd, D MMMM Y') }}</p>
                            <p class="card-text fw-bold m-0">Tujuan Pemakaian</p>
                            <p class="fst-italic text-capitalize mb-2">{{ $event->note }}</p>
                            <p class="card-text fw-bold m-0">Total Biaya</p>
                            <p class="fst-italic text-capitalize mb-2">
                                Rp {{ number_format($event->event_price, 0, ',', '.') }}
                            </p>
                        </div>
                        <div class="card-footer bg-white d-flex align-items-center justify-content-between fw-bold">
                            @php $encryptID = Crypt::encrypt($user->id); @endphp
                            <a href="{{ route('user.show', $encryptID) }}" class="btn-sm btn-info fw-bold text-decoration-none">Lihat Detail Client
                                <i class="fas fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body col-md-6 bg-light mt-3">
                <div class="card-header text-center text-white text-uppercase fw-bold bg-secondary">
                    {{ $alat->name }}
                </div>
                <div class="card-body bg-white">
                    <div class="card-group">
                        <div class="card-bod col-md-6">
                            <div class="card-img mt-5">
                                <img src="{{ asset('storage/' . $alat->foto_alat) }}" class="rounded mx-auto d-block img-thumbnail mb-2" width="250" alt="">
                            </div>
                        </div>
                        <div class="card-body col-md-6">
                            <p class="card-text fw-bold m-0">Tanggal Pinjam</p>
                            <p class="fst-italic mb-2">{{ \Carbon\Carbon::parse($event->date_start)->isoFormat('dddd, D MMMM Y') }}</p>
                            <p class="card-text fw-bold m-0">Tanggal Kembali</p>
                            <p class="fst-italic mb-2">{{ \Carbon\Carbon::parse($event->date_end)->isoFormat('dddd, D MMMM Y') }}</p>
                            <p class="card-text fw-bold m-0">Status Alat</p>
                            <p class="mb-2">
                                <span class="text-uppercase">
                                    @if($event->status_event == 'PENDING')
                                    <span class="badge bg-warning">PENDING</span>
                                    @elseif($event->status_event == 'APPROVED')
                                    <span class="badge bg-success">APPROVED</span>
                                    @elseif($event->status_event == 'PAID')
                                    <span class="badge bg-primary">LUNAS</span>
                                    @elseif($event->status_event == 'DONE')
                                    <span class="badge bg-info">KEMBALI</span>
                                    @else
                                    <span class="badge bg-secondary">DIBATALKAN</span>
                                    @endif
                                </span>
                            </p>
                            <p class="card-text fw-bold m-0">Harga Sewa per Hari</p>
                            <p class="fst-italic text-capitalize mb-2">
                                Rp {{ number_format($alat->price, 0, ',', '.') }}
                            </p>
                        </div>
                        <div class="card-footer bg-white d-flex align-items-center justify-content-between fw-bold">
                            @php $encryptID = Crypt::encrypt($alat->id); @endphp
                            <a href="{{ route('alat.show', $encryptID) }}" class="btn-sm btn-info fw-bold text-decoration-none">Lihat Detail Alat
                                <i class="fas fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body bg-light d-flex justify-content-end">
                <a href="{{ route('penyewaan.index') }}" class="btn btn-primary"><span class="text-white">Kembali</span></a>
            </div>
        </div>
    </div>

{{-- form validation script --}}
<script type="text/javascript" src="{{ URL::asset('js/form-validation.js') }}"></script>
{{-- currency script --}}
<script type="text/javascript" src="{{ URL::asset('js/currency.js') }}"></script>
{{-- textarea editor --}}
{{-- <script type="text/javascript" src="{{ URL::asset('ckeditor/ckeditor.js') }}"></script> --}}
<script src="//cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('note-editor');
</script>
<script type="text/javascript">
    CKEDITOR.replace('deskripsi-editor');
</script>

@push('script')
    <!-- jQuery -->
    {{-- <script type="text/javascript" src="{{ URL::asset('plugins/jquery/jquery.min.js') }}"></script> --}}
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
    {{-- jquery jscript --}}
    <script type="text/javascript" src="{{ URL::asset('assets/jquery/jquery-3.6.4.slim.js') }}"></script>
    {{-- bootstrap password jscript --}}
    <script type="text/javascript" src="{{ URL::asset('assets/bootstrap-5/js/bootstrap-show-password.min.js') }}"></script>
@endpush
@endsection