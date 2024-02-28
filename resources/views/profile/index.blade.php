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
                    <h1 class="m-0">Profile</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Profil Saya</a></li>
                        <li class="breadcrumb-item active">Edit Profile</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="row mt-10 mb-5">
            <div class="col-md-4 col-xl-7 mb-4">
                <div class="card">
                    <div class="card-header text-center fw-bold text-uppercase mb-10 bg-warning text-white">
                    Edit Data Profil
                    </div>
                    <div class="card-group">
                        <div class="card-body">
                            <form action="{{ route('profile.change_profile') }}" method="POST" enctype="multipart/form-data">
                                @csrf()
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama</label>
                                        <input type="text" class="form-control text-uppercase count-chars @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $data->name) }}" maxlength="20" data-max-chars="20">
                                        <div class="fw-light text-muted justify-content-end d-flex"></div>
                                        @error('name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="nik" class="form-label">NIK</label>
                                        <input type="number" class="form-control count-chars @error('nik') is-invalid @enderror" id="nik" name="nik" value="{{ old('nik', $data->nik) }}" maxlength="16" data-max-chars="16">
                                        <div class="fw-light text-muted justify-content-end d-flex"></div>
                                        @error('nik')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="no_kontak" class="form-label">No Kontak/HP</label>
                                        <input type="number" class="form-control count-chars @error('no_kontak') is-invalid @enderror" id="no_kontak" name="no_kontak" value="{{ old('no_kontak', $data->no_kontak) }}">
                                        @error('no_kontak')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email', $data->email) }}" readonly>
                                        @error('email')
                                        <span class="invalid-feedback">
                                        {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Foto</label>
                                        <input type="hidden" name="oldImage" value="{{ $data->image }}">
                                        @if($data->image)
                                        <img src="{{ asset('storage/' . $data->image) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block" alt=""> 
                                        @else
                                        <img src="" class="img-preview img-fluid mb-3 col-sm-5" alt="">
                                        @endif
                                        <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
                                        @error('image') 
                                        <div class="invalid-feedback">
                                        {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="alamat" class="form-label">Alamat</label>
                                        <textarea rows="5" name="alamat" id="alamat" class="form-control text-capitalize count-chars @error('alamat') @enderror" maxlength="100" data-max-chars="100">{{ old('alamat', $data->alamat) }}</textarea>
                                        <div class="fw-light text-muted justify-content-end d-flex"></div>
                                        @error('alamat')
                                        <span class="invalid-feedback">
                                        {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-success">Update</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xl-5 mb4">
                <div class="card">
                    <div class="card-header text-center fw-bold text-uppercase mb-10 bg-warning text-white">
                    Ganti Password
                    </div>
                    <div class="card-group">
                        <div class="card-body">
                            <form action="{{ route('change_password.change') }}" method="POST" enctype="multipart/form-data">
                                @csrf()
                                    <div class="mb-3">
                                        <label for="old_password" class="form-label">Password Lama</label>
                                        <input type="password" data-toggle="password" required class="form-control password @error('old_password') is-invalid @enderror" name="old_password" id="old_password" >
                                        @error('old_password')
                                        <span class="invalid-feedback">
                                        {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password Baru</label>
                                        <input type="password" data-toggle="password" required class="form-control password @error('password') is-invalid @enderror" name="password" id="password" >
                                        @error('password')
                                        <span class="invalid-feedback">
                                        {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                        <input type="password" data-toggle="password" required class="form-control password @error('password') is-invalid @enderror" name="password_confirmation" id="password_confirmation" >
                                        @error('password_confirmation')
                                        <span class="invalid-feedback">
                                        {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-success">Update</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
    {{-- sweet alert success notification --}}
    @if(Session::has('message'))
    <script>
        swal("Sukses","{{ Session::get('message') }}", 'success',{
            button:true,
            button:"OK",
            timer:false,
        });
    </script>
    @elseif(Session::has('error'))
    <script>
    swal("Gagal","{{ Session::get('error') }}", 'error',{
        button:true,
        button:"OK",
        timer:false,
    });
    </script>
    @endif
    {{-- validation form --}}
    <script type="text/javascript" src="{{ URL::asset('js/form-validation.js') }}"></script>
@endpush
@endsection