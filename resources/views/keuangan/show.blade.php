@push('style')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{ URL::asset('plugins/fontawesome-free/css/all.min.css') }}">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
{{-- datatables css --}}
<link rel="stylesheet" href="{{ URL::asset('assets/bootstrap-5/css/dataTables.bootstrap.min.css') }}">
{{-- datatables responsive css --}}
<link rel="stylesheet" href="{{ URL::asset('assets/bootstrap-5/css/responsive.dataTables.min.css') }}">
{{-- datatables row order css --}}
<link rel="stylesheet" href="{{ URL::asset('assets/bootstrap-5/css/rowReorder.dataTables.min.css') }}">
{{-- sweet alert2 css --}}
<link rel="stylesheet" href="{{ URL::asset('assets/sweet-alert/css/sweetalert2.min.css') }}" />
{{-- bootstrap@5.3.0-alpha3 css --}}
<link rel="stylesheet" href="{{ URL::asset('assets/bootstrap-5/css/bootstrap.min.css') }}" />
@endpush

<script type="text/javascript" src="{{ URL::asset('plugins/jquery/jquery.min.js') }}"></script>
{{-- jquery datatables --}}
<script type="text/javascript" src="{{ URL::asset('assets/bootstrap-5/js/jquery.dataTables.min.js') }}"></script>
{{-- datatables js --}}
<script type="text/javascript" src="{{ URL::asset('assets/bootstrap-5/js/dataTables.bootstrap4.min.js') }}"></script>
{{-- datatables responsive js --}}
<script type="text/javascript" src="{{ URL::asset('assets/bootstrap-5/js/dataTables.responsive.min.js') }}"></script>
{{-- datatables row order js --}}
<script type="text/javascript" src="{{ URL::asset('assets/bootstrap-5/js/dataTables.rowReorder.min.js') }}"></script>
{{-- sweet alert2 js --}}
<script type="text/javascript" src="{{ URL::asset('assets/sweet-alert/js/sweetalert2.all.min.js') }}"></script>
{{-- sweet alert js --}}
<script type="text/javascript" src="{{ URL::asset('assets/sweet-alert/js/sweetalert.min.js') }}"></script>
<!-- Bootstrap 5 -->
<script type="text/javascript" src="{{ URL::asset('assets/bootstrap-5/js/bootstrap.bundle.min.js') }}"></script>
<script>
    window.deleteConfirm = function (e) {
    e.preventDefault();
    var form = e.target.form;
    swal({
        title: 'Apakah Anda Yakin?',
        text: 'Data akan dihapus permanen jika Anda melanjutkan proses',
        icon: 'warning',
        buttons: ["Batal", "Hapus"],
        dangerMode: true,
        timer: false,
    })
    .then((willDelete) => {
        if (willDelete) {
            form.submit();
            swal("Data Berhasil Dihapus", {
                icon: "success",
            });
        }
        else {
            swal("Anda Membatalkan Proses", {
                icon: "error",
            });
        }
    });
}
</script>

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
                    <h1 class="m-0">Billing</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Billing</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('riwayat.pembayaran') }}">Riwayat</a></li>
                        <li class="breadcrumb-item active">View Detail</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="card mt-10 mb-10">
        <div class="card-header text-center fw-bold text-uppercase mb-10 bg-info text-white">
            View Detail Pembayaran
        </div>
        <div class="card-body">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body col-md-12">
                <div class="card-header text-white text-uppercase text-center fw-bold bg-secondary">
                    Bukti Bayar
                </div>
                <div class="card-body bg-light">
                    <div class="card-group">
                        <div class="card-body col-md-6">
                            <div class="card-img mt-2">
                                <img src="{{ asset('storage/' . $payment->payment_proof) }}" class="rounded mx-auto d-block img-thumbnail mb-2" width="250" alt="">
                            </div>
                        </div>
                        <div class="card-body col-md-6">
                            <p class="card-text fw-bold mb-2">Kode Pembayaran : 
                                <span class="fst-italic fw-normal text-uppercase">
                                    {{ $payment->payment_code }}
                                </span>
                            </p>
                            <p class="card-text fw-bold mb-2">Nominal Pembayaran : 
                                <span class="fst-italic fw-normal text-capitalize">
                                    Rp {{ number_format($payment->payment_amount, 0, ',', '.') }}
                                </span>
                            </p>
                            <p class="card-text fw-bold mb-2">Status Pembayaran : 
                                <span class="text-uppercase fw-normal">
                                    @if($payment->payment_status == 'DP')
                                    <span class="badge bg-warning">DOWN PAYMENT</span>
                                    @elseif($payment->payment_status == 'DP(LUNAS)')
                                    <span class="badge bg-success">PELUNASAN</span>
                                    @elseif($payment->payment_status == 'PELUNASAN')
                                    <span class="badge bg-success">PELUNASAN</span>
                                    @else
                                    <span class="badge bg-success">LUNAS</span>
                                    @endif
                                </span>
                            </p>
                            <p class="card-text fw-bold mb-2">Tanggal Bayar : 
                                <span class="fst-italic fw-normal text-capitalize">
                                    {{ \Carbon\Carbon::parse($payment->payment_date)->isoFormat('dddd, D MMMM Y') }}
                                </span>
                            </p>
                            <p class="card-text fw-bold mb-2">Metode Pembayaran : 
                                <span class="fst-italic fw-normal text-uppercase">
                                    {{ $payment->payment_method }}
                                </span>
                            </p>
                            <p class="card-text fw-bold mb-2">Diterima Oleh : 
                                <span class="fst-italic text-capitalize text-primary">
                                    @php $encryptID = Crypt::encrypt($received_by->id); @endphp
                                    <a href="{{ route('admin.show',$encryptID) }}">
                                        {{ $received_by->name }} <i class="fa fa-check-circle fst-italic"></i>
                                    </a>
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>

@push('script')
    <!-- jQuery UI 1.11.4 -->
    <script type="text/javascript" src="{{ URL::asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script type="text/javascript" src="{{ URL::asset('js/adminlte.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script type="text/javascript" src="{{ URL::asset('js/demo.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script type="text/javascript" src="{{ URL::asset('js/pages/dashboard.js') }}"></script>
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
@endpush
@endsection