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
                    <h1 class="m-0">Keuangan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('keuangan.index') }}">Keuangan</a></li>
                        <li class="breadcrumb-item"> <a href="{{ route('keuangan.index') }}">Pembayaran</a></li>
                        <li class="breadcrumb-item active">Pelunasan</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="card mt-10 mb-20">
        <div class="card-header text-center fw-bold text-uppercase mb-10 bg-success text-white">
            Formulir Pelunasan Alat
        </div>
        <div class="card-group">
            <div class="card-body">
                <form action="{{ route('pelunasanAlat.store', $payment->id) }}" method="POST" enctype="multipart/form-data" class="mb-4">
                    @csrf()
                        <div class="card-group">
                            <div class="card-body text-center align-middle col-md-6">
                                <div class="card-header text-white text-uppercase fw-bold bg-secondary">
                                    {{ $user->name }}
                                </div>
                                <div class="card-body bg-light">
                                    <div class="card-group">
                                        <div class="card-body col-md-6">
                                            <div class="card-img mt-2">
                                                @if($user->image)  
                                                <img src="{{ asset('storage/' . $user->image) }}" class="rounded mx-auto d-block img-thumbnail mb-2" width="250" alt="">
                                                @else
                                                <img src="{{ $user->gravatar }}" width="300" alt="">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="card-body col-md-6">
                                            <p class="card-text fw-bold m-0">Nomor Kontak</p>
                                            <p class="fst-italic mb-2">{{ $user->no_kontak}}</p>
                                            <p class="card-text fw-bold m-0">Alamat</p>
                                            <p class="fst-italic text-capitalize mb-2">{{ $user->alamat }}</p>
                                            <p class="card-text fw-bold m-0">Durasi Sewa</p>
                                            <p class="fst-italic text-capitalize mb-2">
                                                {{ $duration }} Hari
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body text-center align-middle col-md-6">
                                <div class="card-header text-white text-uppercase fw-bold bg-secondary">
                                    {{ $alat->name }}
                                </div>
                                <div class="card-body bg-light">
                                    <div class="card-group">
                                        <div class="card-body col-md-6">
                                            <div class="card-img mt-2">
                                                <img src="{{ asset('storage/' . $alat->foto_alat) }}" class="rounded mx-auto d-block img-thumbnail mb-2" width="250" alt="">
                                            </div>
                                        </div>
                                        <div class="card-body col-md-6">
                                            <p class="card-text fw-bold m-0">Tanggal Pinjam</p>
                                            <p class="fst-italic mb-2">{{ \Carbon\Carbon::parse($event->date_start)->isoFormat('dddd, D MMMM Y') }}</p>
                                            <p class="card-text fw-bold m-0">Tanggal Kembali</p>
                                            <p class="fst-italic mb-2">{{ \Carbon\Carbon::parse($event->date_end)->isoFormat('dddd, D MMMM Y') }}</p>
                                            <p class="card-text fw-bold m-0">Total Harga Sewa </p>
                                            <p class="fst-italic text-capitalize mb-2">
                                                Rp {{ number_format($event->event_price, 0, ',', '.') }}
                                            </p>
                                            <p class="card-text fw-bold m-0">Status Penyewaan</p>
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
                                                    @elseif($event->status_event == 'DOWN PAYMENT')
                                                    <span class="badge bg-warning">DOWN PAYMENT</span>
                                                    @else
                                                    <span class="badge bg-secondary">DIBATALKAN</span>
                                                    @endif
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body col-md-12">
                            <div class="card-header text-white text-uppercase text-center fw-bold bg-secondary">
                                down payment
                            </div>
                            <div class="card-body bg-light">
                                <div class="card-group">
                                    <div class="card-body col-md-6">
                                        <div class="card-img mt-2">
                                            <img src="{{ asset('storage/' . $payment->payment_proof) }}" class="rounded mx-auto d-block img-thumbnail mb-2" width="250" alt="">
                                        </div>
                                    </div>
                                    <div class="card-body col-md-6">
                                        <p class="card-text fw-bold m-0">Jumlah Down Payment</p>
                                        <p class="fst-italic mb-2">
                                            Rp {{ number_format($payment->payment_amount, 0, ',', '.') }}
                                        </p>
                                        <p class="card-text fw-bold m-0">Tanggal Bayar</p>
                                        <p class="fst-italic mb-2">{{ \Carbon\Carbon::parse($payment->payment_date)->isoFormat('dddd, D MMMM Y') }}</p>
                                        <p class="card-text fw-bold m-0">Jumlah Kekurangan</p>
                                        <p class="fst-italic text-capitalize mb-2">
                                            Rp {{ number_format(($payment->total_price) - ($payment->payment_amount), 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body col-md-12">
                            <div class="row mb-3 card-text">
                                <div class="form-group col-md-6" style="display:none">
                                    <input type="text" class="form-control text-capitalize count-chars @error('user_id') is-invalid @enderror" id="user_id" name="user_id" value="{{ old('user_id', $user->id) }}" maxlength="20" data-max-chars="20" hidden>
                                    @error('user_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6" style="display:none">
                                    <input type="text" class="form-control text-capitalize count-chars @error('tools_id') is-invalid @enderror" id="tools_id" name="tools_id" value="{{ old('tools_id', $alat->id) }}" maxlength="20" data-max-chars="20" hidden>
                                    @error('tools_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6" style="display:none">
                                    <input type="text" class="form-control text-capitalize count-chars @error('events_id') is-invalid @enderror" id="events_id" name="events_id" value="{{ $event->id }}" maxlength="20" data-max-chars="20" hidden>
                                    @error('events_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6" style="display: none">
                                    <input type="text" class="form-control text-capitalize count-chars @error('received_by') is-invalid @enderror" id="received_by" name="received_by" value="{{ auth()->user()->id; }}" maxlength="20" data-max-chars="20" hidden>
                                    @error('received_by')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6" style="display: none">
                                    <input type="text" class="form-control text-capitalize count-chars @error('duration') is-invalid @enderror" id="duration" name="duration" value="{{ $duration }}" maxlength="20" data-max-chars="20" hidden>
                                    @error('duration')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6" style="display: none">
                                    <input type="text" class="form-control text-capitalize count-chars @error('total_price') is-invalid @enderror" id="total_price" name="total_price" value="{{ $event->event_price }}" maxlength="20" data-max-chars="20" hidden>
                                    @error('total_price')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6" style="display: none">
                                    <input type="text" class="form-control text-capitalize @error('payment_status') is-invalid @enderror" id="payment_status" name="payment_status" value="PELUNASAN" maxlength="20" data-max-chars="20" hidden>
                                    @error('payment_status')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3 card-text">
                                <div class="form-group col-md-4">
                                    <label for="payment_method" class="form-label">Metode Pembayaran</label>
                                    <select class="form-select" id="payment_method" name="payment_method">
                                        <option value="">-- Pilih Metode Pembayaran --</option>
                                        <option value="tunai">Tunai</option>
                                        <option value="transfer">Transfer Bank</option>
                                        <option value="qris">QRIS GPN</option>
                                    </select>
                                    @error('payment_method')
                                    <span class="invalid-feedback">
                                    {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="payment_date" class="form-label">Tanggal Pembayaran</label>
                                    <input type="date" class="form-control @error('payment_date') is-invalid @enderror" name="payment_date" id="payment_date" value="{{ old('payment_date') }}">
                                    @error('date_start')
                                    <span class="invalid-feedback">
                                    {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="payment_amount" class="form-label">Nominal Diterima</label>
                                    <div class="input-group">
                                        <div class="input-group-text">Rp</div>
                                        <input type="text" class="form-control count-chars @error('payment_amount') is-invalid @enderror" name="payment_amount" id="currency" value="{{ old('payment_amount') }}" maxlength="15" data-max-chars="15">
                                    </div>
                                    <div class="fw-light text-muted justify-content-end d-flex"></div>
                                    @error('price')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3 card-text">
                                <div class="form-group col-md-12">
                                    <label for="payment_proof" class="form-label">Foto Bukti Pembayaran</label>
                                    <img src="" class="mb-3 img-preview img-fluid col-sm-5" alt="">
                                    <input class="form-control @error('payment_proof') is-invalid @enderror" type="file" id="image" name="payment_proof" onchange="previewImage()">
                                    @error('payment_proof') 
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 card-text" style="display:none">
                                <label for="exampleInputEmail1">Payment Code</label>
                                    @php
                                        $length = 4;    
                                        $alph_num =  substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$length);
                                        $num =  substr(str_shuffle('0123456789'),1,$length);
                                    @endphp
                                <input type="text" required name="payment_code" value="WHP-N-@php echo $alph_num;@endphp-@php echo $num;@endphp " class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-3 gap-2">
                            <a href="{{ route('keuangan.index') }}" class="btn btn-danger">Batal</a>
                            <button type="submit" class="btn btn-primary">Bayar</button>
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