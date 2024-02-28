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
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="card mt-10 mb-5">
        <div class="card-header text-center fw-bold text-uppercase mb-10 bg-warning text-white">
            Edit Data Booking Alat {{ $alat->name }}
        </div>
        <div class="card-group">
            <div class="card-body mt-3">
                <form action="{{ route('datasewa.update', $event->id) }}" method="POST" enctype="multipart/form-data" class="mb-4">
                    @csrf()
                    @method('PUT')
                        <div class="row">
                            <div class="mb-3 card-text form-group col-md-4">
                                <label for="user_id" class="form-label">Nama Client</label>
                                <input type="text" class="form-control text-capitalize count-chars @error('user_id') is-invalid @enderror" id="user_id" name="user_id" value="{{ old('user_id', $user->id) }}" maxlength="20" data-max-chars="20" hidden>
                                <input type="text" class="form-control text-capitalize count-chars @error('user_name') is-invalid @enderror" id="user_name" name="user_name" value="{{ old('user_name', $user->name) }}" maxlength="20" data-max-chars="20" readonly>
                                <div class="fw-light text-muted justify-content-end d-flex"></div>
                                @error('user_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 card-text form-group col-md-8">
                                <label for="name" class="form-label">Nama Alat</label>
                                <input type="text" class="form-control text-capitalize count-chars @error('tools_id') is-invalid @enderror" id="tools_id" name="tools_id" value="{{ old('tools_id', $alat->id) }}" maxlength="20" data-max-chars="20" hidden>
                                <input type="text" class="form-control text-capitalize count-chars @error('tools_name') is-invalid @enderror" id="tools_name" name="tools_name" value="{{ old('tools_name', $alat->name) }}" maxlength="20" data-max-chars="20" readonly>
                                <div class="fw-light text-muted justify-content-end d-flex"></div>
                                @error('tools_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 card-text form-group col-md-4">
                                <label for="event_price" class="form-label">Harga Sewa per Hari</label>
                                <input type="number" class="form-control count-chars @error('event_price') is-invalid @enderror" name="event_price" id="event_price" value="{{ old('price', $alat->price) }}" maxlength="10" data-max-chars="10" hidden>
                                <input type="text" class="form-control count-chars @error('view_price') is-invalid @enderror" name="view_price" id="view_price" value="Rp {{ number_format($alat->price, 0, ',', '.') }}" maxlength="10" data-max-chars="10" readonly>
                                <div class="fw-light text-muted justify-content-end d-flex"></div>
                                @error('event_price')
                                <span class="invalid-feedback">
                                {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3 card-text form-group col-md-4">
                                <label for="date_start" class="form-label">Tanggal Pinjam</label>
                                <input type="date" class="form-control @error('date_start') is-invalid @enderror" name="date_start" id="date_start" value="{{ old('date_start') }}">
                                @error('date_start')
                                <span class="invalid-feedback">
                                {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3 card-text form-group col-md-4">
                                <label for="date_end" class="form-label">Tanggal Kembali</label>
                                <input type="date" class="form-control @error('date_end') is-invalid @enderror" name="date_end" id="date_end" value="{{ old('date_end') }}">
                                @error('date_end')
                                <span class="invalid-feedback">
                                {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group card-text col-md-6 mb-3">
                                <label for="foto_alat" class="form-label">Foto Alat</label>
                                <input type="hidden" name="oldFoto_alat" value="{{ $alat->foto_alat }}">
                                @if($alat->foto_alat)
                                <img src="{{ asset('storage/' . $alat->foto_alat) }}" class="img-preview img-fluid mb-3 col-md-12 col-sm-5 d-block" width="600" alt=""> 
                                @else
                                <img src="" class="img-preview img-fluid mb-3 col-md-6" alt="">
                                @endif
                                @error('foto_alat') 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group card-text col-md-6 mb-3 mt-2">
                                <label for="note_alat" class="form-label">Note</label>
                                <div class="card-body bg-warning p-3" style="width:100%;max-heigth:600px">
                                    <div class="card-text">{!! html_entity_decode($alat->note, ENT_QUOTES, 'UTF-8' ) !!}</div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 card-text">
                            <label for="note" class="form-label">Tujuan Pemakaian</label>
                            <textarea name="note" id="note" class="form-control text-capitalize count-chars @error('note') @enderror" maxlength="100" data-max-chars="100">{{ old('note', $event->note) }}</textarea>
                            <div class="fw-light text-muted justify-content-end d-flex"></div>
                            @error('note')
                            <span class="invalid-feedback">
                            {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end mt-3 gap-2">
                            <a href="{{ route('penyewaan.index') }}" class="btn btn-danger">Batal</a>
                            <button type="submit" class="btn btn-success">Update</button>
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