@push('style')
    {{-- <meta name="csrf-token" content="{{ csrf_token }}"> --}}
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ URL::asset('css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    {{-- bootstrap@5.3.0-alpha3 css --}}
    <link rel="stylesheet" href="{{ URL::asset('assets/bootstrap-5/css/bootstrap.min.css') }}" />
    {{-- sweet alert2 css --}}
    <link rel="stylesheet" href="{{ URL::asset('assets/sweet-alert/css/sweetalert2.min.css') }}" />
@endpush

@extends('layouts.main')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Database Alat</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Database Alat</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('alat.index') }}">Data Alat</a></li>
                        <li class="breadcrumb-item active">View</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="card mt-10 mb-5">
        <div class="card-header text-center fw-bold text-uppercase mb-10 bg-info text-white">
            Detail Data Alat
        </div>
        <div class="card-group bg-light mt-10">
            <div class="card-body text-center col-md-6">
                <div class="card-header text-center text-uppercase fw-bold bg-secondary text-white">
                    Foto Alat
                </div>
                <div class="card-body bg-white p-5" style="width:100%;max-heigth:600px">
                    <img src="{{ asset('storage/' . $alat->foto_alat) }}" class="rounded img-thumbnail" width="500" data-bs-toggle="modal" data-bs-target="#detail-foto">
                </div>
    
                    {{-- modal view show foto --}}
                    {{-- <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="detail-foto" tabindex="-1" aria-labelledby="Foto Alat {{ $alat->name }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="close text-black" data-bs-dismiss="modal"><i class="fa fa-close" style="font-size: 2rem;">&#xf00d;</i></button>
                                </div>
                                <div class="modal-body d-flex justify-content-center">
                                    <img src="{{ asset('storage/' . $alat->foto_alat) }}" style="width:100%;max-width:600px">
                                </div>
                            </div>
                        </div>
                    </div> --}}
            </div>
            <div class="card-body text-center col-md-6">
                <div class="card-header text-center text-uppercase fw-bold bg-secondary text-white">
                    Data Alat
                </div>
                <div class="card-body bg-white p-3" style="width:100%;max-heigth:600px">
                    <p class="card-text fw-bold m-0">Nama Alat</p>
                    <p class="fst-italic text-capitalize mb-2">{{ $alat->name }}</p>
                    <p class="card-text fw-bold m-0">Kode Alat</p>
                    <p class="fst-italic text-capitalize mb-2">{{ $alat->kode_alat }}</p>
                    <p class="card-text fw-bold m-0">Harga Sewa</p>
                    <p class="fst-italic text-capitalize mb-2">Rp {{ number_format($alat->price, 0, ',', '.') }}</p>
                    <p class="card-text fw-bold m-0">Status Alat</p>
                    <p class="fst-italic text-uppercase mb-2">
                        @if($alat->status_alat == 'READY')
                        <span class="badge bg-success text-uppercase">ready</span>
                        @elseif($alat->status_alat == 'BOOKING')
                        <span class="badge bg-warning text-uppercase">booking</span>
                        @elseif($alat->status_alat == 'TERPAKAI')
                        <span class="badge bg-danger text-uppercase">terpakai</span>
                        @else
                        <span class="badge bg-info text-uppercase">maintenance</span>
                        @endif
                    </p>
                    <p class="card-text fw-bold m-0">Tanggal Registrasi Alat</p>
                    <p class="fst-italic text-capitalize mb-2">{{ \Carbon\Carbon::parse($alat->created_at)->isoFormat('dddd, D MMMM Y') }}</p>
                    <div class="d-flex justify-content-end mt-2">
                        @php $encryptID = Crypt::encrypt($alat->id); @endphp
                        <a href="{{ route('alat.edit', $encryptID) }}"class="btn btn-sm btn-warning m-1" title="Edit Alat" data-toggle="tooltip" data-placement="top"><i class="fas fa-edit"></i></a>
                    </div>
                </div>
            </div>
            <div class="card-body col-md-12">
                <div class="card-header text-center text-uppercase fw-bold bg-secondary text-white">
                    Note
                </div>
                <div class="card-body bg-white p-3" style="width:100%; max-heigth:500px">
                    <p class="fst-italic text-capitalize mb-2">{!! html_entity_decode($alat->note, ENT_QUOTES, 'UTF-8' ) !!}</p>
                </div>
            </div>
            <div class="card-body col-md-12">
                <div class="card-header text-center text-uppercase fw-bold bg-secondary text-white">
                    Spesifikasi
                </div>
                <div class="card-body bg-white p-3" style="width:100%; max-heigth:500px">
                    <p class="fst-italic text-capitalize mb-2">{!! html_entity_decode($alat->deskripsi, ENT_QUOTES, 'UTF-8' ) !!}</p>
                </div>
            </div>
        </div>
    </div>
    
{{-- form validation script --}}
<script type="text/javascript" src="{{ URL::asset('js/form-validation.js') }}"></script>
{{-- currency script --}}
<script type="text/javascript" src="{{ URL::asset('js/currency.js') }}"></script>
{{-- jquery --}}
<script type="text/javascript" src="{{ URL::asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 5 -->
<script type="text/javascript" src="{{ URL::asset('assets/bootstrap-5/js/bootstrap.bundle.min.js') }}"></script>

@push('script')
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
    {{-- image preview js --}}
    <script>
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
@endpush
@endsection