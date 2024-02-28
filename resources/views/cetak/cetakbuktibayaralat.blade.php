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
                    <h1 class="m-0">Cetak</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('cetak.buktibayar') }}">Cetak</a></li>
                        <li class="breadcrumb-item">Bukti Bayar</li>
                        <li class="breadcrumb-item active">Print</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="card mt-10 mb-5">
        <div class="card-header text-center fw-bold text-uppercase text-white bg-dark mb-10">
            Cetak Bukti Pembayaran
        </div>
        <div class="card-body bg-light mt-10">
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card" id="print_receipt">
                                <div class="card-body">
                                    {{-- company title receipt --}}
                                    <div class="invoice-title">
                                        <h4 class="float-end">
                                            @php $encryptID = Crypt::encrypt($payment->id); @endphp
                                            <a href="{{ route("print.buktibayaralat", $encryptID) }}" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i> Cetak</a>
                                        </h4>
                                        <div class="mb-2">
                                            <img src="{{ URL::asset('/assets/img/mediakreasi-full.png') }}" class="navbar-brand-img" data-holder-rendered="true" height="auto" width="400px" />
                                        </div>
                                        <div class="text-muted">
                                            <p class="mb-0">Cangkring RT 03 Mulyodadi Bambanglipuro</p>
                                            <p class="mb-1">Bantul Yogyakarta 55764</p>
                                            <p class="mb-1"> <i class="fa fa-phone"></i> 081904146417</p>
                                        </div>
                                    </div>
                                    <hr class="my-2">
                                    {{-- client title receipt --}}
                                    <div class="row">
                                        {{-- col 1 --}}
                                        <div class="col-sm-6" style="font-size: 0.8rem">
                                            <div class="text-muted">
                                                <p class="h6 mb-1">Telah diterima pembayaran dari :</p>
                                                <p class="mb-1 fw-bold text-uppercase fst-italic" style="font-size: 1rem"> {{ $user->name }}</p>
                                                <p class="mb-0 fst-italic">{{ $user->no_kontak }}</p>
                                                <p class="mb-0 text-capitalize fst-italic">{{ $user->alamat }}</p>
                                            </div>
                                        </div>
                                        {{-- col 2 --}}
                                        <div class="col-sm-6" style="font-size: 0.8rem">
                                            <div class="text-muted text-sm-end">
                                                <p class="h6 fw-bold mb-1">Kode Pembayaran</p>
                                                <p class="fst-italic text-uppercase mb-2" style="font-size: 1rem">{{ $payment->payment_code }}</p>
                                                <p class="h6 fw-bold mb-1">Tanggal Pembayaran</p>
                                                <p class="fst-italic text-capitalize" style="font-size: 1rem">{{ \Carbon\Carbon::parse($payment->payment_date)->isoFormat('dddd, D MMMM Y') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- order sumary --}}
                                    <div class="py-2 mt-2">
                                        <div class="table-responsive">
                                            <p class="fst-italic" style="font-size: 1rem">Dengan detail sewa alat sebagai berikut :</p>
                                            <table class="table align-middle nowrap mb-0" style="font-size: 0.8rem">
                                                <thead>
                                                    <tr class="bg-light">
                                                        <th class="text-center">Nama Alat</th>
                                                        <th class="text-center">Jenis Bayar</th>
                                                        <th class="text-center">Metode Bayar</th>
                                                        <th class="text-center">Durasi</th>
                                                        <th class="text-center">Tarif per Hari</th>
                                                        <th class="text-left">TOTAL</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="text-center text-uppercase">{{ $tool->name }}</td>
                                                        <td class="text-center text-uppercase">{{ $payment->payment_status }}</td>
                                                        <td class="text-center text-uppercase">{{ $payment->payment_method }}</td>
                                                        <td class="text-center">{{ $payment->duration }} Hari</td>
                                                        <td class="text-center">Rp {{ number_format($tool->price, 0, ',','.') }}</td>
                                                        <td class="text-left">Rp {{ number_format($payment->payment_amount, 0, ',','.') }}</td>
                                                        @php
                                                        //simple tax math
                                                        $vat_tax = 0.1;
                                                        $taxable_payment = $payment->payment_amount;
                                                        $tax = $vat_tax * $taxable_payment;
                                                        $without_tax = $taxable_payment - $tax;
                                                        @endphp
                                                    </tr>
                                                    <tfoot>
                                                        <tr class="fw-bold fst-italic">
                                                            <td></td>
                                                            <td colspan="3" class="text-end">Subtotal</td>
                                                            <td colspan="2" class="text-end">Rp {{ number_format($without_tax, 0, ',','.') }}</td>
                                                        </tr>
                                                        <tr class="fw-bold fst-italic">
                                                            <td></td>
                                                            <td colspan="3" class="text-end">Pajak 10%</td>
                                                            <td colspan="2" class="text-end">Rp {{ number_format($tax, 0, ',', '.') }}</td>
                                                        </tr>
                                                        <tr class="fw-bold fst-italic" style="font-size: 1.25rem">
                                                            <td></td>
                                                            <td colspan="3" class="text-end">*Total Pembayaran</td>
                                                            <td colspan="2" class="text-end">Rp {{ number_format($taxable_payment, 0, ',', '.') }}</td>
                                                        </tr>
                                                    </tfoot>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    {{-- footer --}}
                                    <div class="mt-5 mb-5">
                                        <div class="p-2" style="border-left: 10px solid #85bde8;">
                                            <p class="fst-italic mb-0">NB:</p>
                                            <p class="fst-italic text-muted fw-bold" style="font-size: 0.8rem">*Harga Sewa Alat Sudah Termasuk Pajak PPN Sebesar 10%</p>
                                        </div>
                                    </div>
                                    {{-- sign --}}
                                    <div class="row mt-1" style="font-size: 0.8rem">
                                        <div class="col-sm-6">
                                            <div class="text-center">
                                                <p class="fw-bold">Hormat Kami,</p>
                                                <br><br>
                                                <p class="fw-bold text-capitalize" style="font-size: 1rem">{{ auth()->user()->name; }}</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="text-center">
                                                <p class="fw-bold">Penyewa,</p>
                                                <br><br>
                                                <p class="fw-bold text-capitalize" style="font-size: 1rem">{{ $user->name }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="my-1">
                                    <div class="row fst-italic">
                                        <footer class="text-muted text-end" style="font-size: 0.75rem;">
                                            Nota Dicetak Otomatis pada Hari {{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }} Pukul {{ Carbon\Carbon::now()->isoFormat('HH:mm:ss') }}
                                        </footer>
                                    </div>
                                </div>
                            </div>
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