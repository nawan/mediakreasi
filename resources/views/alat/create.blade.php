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
                    <h1 class="m-0">Database Alat</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Database Alat</a></li>
                        <li class="breadcrumb-item active">Tambah Data</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="card mt-10 mb-5">
        <div class="card-header text-center fw-bold text-uppercase mb-10 bg-success text-white">
            Tambah Data Alat
        </div>
        <div class="card-group">
            <div class="card-body">
                <form action="{{ route('alat.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf()
                    <div class="row">
                        <div class="form-group mb-3 card-text col-md-12">
                            <label for="name" class="form-label">Nama Alat</label>
                            <input type="text" class="form-control count-chars text-uppercase @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" maxlength="50" data-max-chars="50">
                            <div class="fw-light text-muted justify-content-end d-flex"></div>
                            @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6 mb-3">
                            <label for="price" class="form-label">Harga Sewa</label>
                            <div class="input-group">
                                <div class="input-group-text">Rp</div>
                                <input type="text" class="form-control count-chars @error('price') is-invalid @enderror" name="price" id="currency" value="{{ old('price') }}" maxlength="15" data-max-chars="15">
                            </div>
                            <div class="fw-light text-muted justify-content-end d-flex"></div>
                            @error('price')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 mb-3">
                            <label for="status_alat" class="form-label">Status Alat</label>
                            <select class="form-select" id="status_alat" name="status_alat">
                                <option selected value="READY">Ready</option>
                                <option value="BOOKING">Booking</option>
                                <option value="TERPAKAI">Terpakai</option>
                                <option value="MAINTENANCE">Maintenance</option>
                                <option value="EVENT">Event</option>
                            </select>
                            <span class="text-sm fst-italic font-thin">jika status bernilai "Event" tidak ditampilkan pada data alat</span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="foto_alat" class="form-label">Foto Alat</label>
                        <img src="" class="mb-3 img-preview img-fluid col-sm-5" alt="">
                        <input class="form-control @error('foto_alat') is-invalid @enderror" type="file" id="image" name="foto_alat" onchange="previewImage()">
                        @error('foto_alat') 
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3 card-text">
                        <label for="note" class="form-label">Catatan</label>
                        <textarea rows="8" name="note" id="note-editor" class="form-control count-chars @error('note') @enderror" maxlength="600" data-max-chars="600">{{ old('note') }}</textarea>
                        <div class="fw-light text-muted justify-content-end d-flex"></div>
                        @error('note')
                        <span class="invalid-feedback">
                        {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3 card-text">
                        <label for="deskripsi" class="form-label">Deskripsi Alat</label>
                        <textarea rows="20" name="deskripsi" id="deskripsi-editor" class="form-control count-chars @error('deskripsi') @enderror" maxlength="600" data-max-chars="600">{{ old('deskripsi') }}</textarea>
                        <div class="fw-light text-muted justify-content-end d-flex"></div>
                        @error('deskripsi')
                        <span class="invalid-feedback">
                        {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-end mt-3 gap-2">
                        <a href="{{ route('alat.index') }}" class="btn btn-danger">Batal</a>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
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