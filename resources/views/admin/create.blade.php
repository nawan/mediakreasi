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
                    <h1 class="m-0">Admin</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item active">Tambah Admin</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="card mt-10 mb-5">
        <div class="card-header text-center fw-bold text-uppercase mb-10 bg-success text-white">
            Tambah Admin
        </div>
        <div class="card-group">
            <div class="card-body">
                <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf()
                    <div class="row">
                        <div class="form-group col-md-6 mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control count-chars text-uppercase @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" maxlength="20" data-max-chars="20">
                            <div class="fw-light text-muted justify-content-end d-flex"></div>
                            @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 mb-3">
                            <label for="nik" class="form-label">NIK</label>
                            <input type="number" class="form-control count-chars @error('nik') is-invalid @enderror" id="nik" name="nik" value="{{ old('nik') }}" maxlength="16" data-max-chars="16">
                            <div class="fw-light text-muted justify-content-end d-flex"></div>
                            @error('nik')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4 mb-3">
                            <label for="no_kontak" class="form-label">No Kontak</label>
                            <input type="number" class="form-control count-chars @error('no_kontak') is-invalid @enderror" id="no_kontak" name="no_kontak" value="{{ old('no_kontak') }}" maxlength="13" data-max-chars="13">
                            <div class="fw-light text-muted justify-content-end d-flex"></div>
                            @error('no_kontak')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control count-chars @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}" placeholder="nama@email.com" maxlength="20" data-max-chars="20">
                            <div class="fw-light text-muted justify-content-end d-flex"></div>
                            @error('email')
                            <span class="invalid-feedback">
                            {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4 mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" data-toggle="password" class="form-control count-chars @error('password') is-invalid @enderror" id="password" name="password" value="{{ old('password') }}" maxlength="20" data-max-chars="20">
                            <div class="fw-light text-muted justify-content-end d-flex"></div>
                            @error('password')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Foto Profil</label>
                        <img src="" class="mb-3 img-preview img-fluid col-sm-5" alt="">
                        <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
                        @error('image') 
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control text-capitalize count-chars @error('alamat') is-invalid @enderror" id="alamat" name="alamat" value="{{ old('alamat') }}" maxlength="100" data-max-chars="100"></textarea>
                        <div class="fw-light text-muted justify-content-end d-flex"></div>
                        @error('alamat')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="is_admin" class="form-label">Level Admin</label>
                        <select class="form-select @error('is_admin') is-invalid @enderror" id="is_admin" name="is_admin">
                            <option value="3">Staff</option>
                            <option value="2">Supervisor</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-end mt-3 gap-3">
                        <a href="{{ route('admin.index') }}" class="btn btn-danger">Batal</a>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

{{-- form validation script --}}
<script type="text/javascript" src="{{ URL::asset('js/form-validation.js') }}"></script>

@push('script')
{{-- form validation script --}}
<script type="text/javascript" src="{{ URL::asset('js/form-validation.js') }}"></script>
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="js/pages/dashboard.js"></script>
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