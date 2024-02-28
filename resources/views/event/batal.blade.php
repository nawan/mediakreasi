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
                    <h1 class="m-0">Event</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Event</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('event.index') }}">Data Event</a></li>
                        <li class="breadcrumb-item active">View Detail</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="card mt-10 mb-5">
        <div class="card-header text-center fw-bold text-uppercase mb-10 bg-danger text-white">
            Konfirmasi Pembatalan Event
        </div>
        <div class="card-body col-md-12 bg-light">
            <div class="card-group">
                <div class="card-body col-md-6">
                    <div class="card-img mt-2">
                        <img src="{{ asset('storage/' . $user->image) }}" class="rounded mx-auto d-block img-thumbnail mb-2" width="250" alt="">
                    </div>
                </div>
                <div class="card-body col-md-6">
                    <p class="card-text fw-bold mb-2">Nama Event : 
                        <span class="fst-italic fw-normal text-capitalize">
                            {{ $event->nama_event }}
                        </span>
                    </p>
                    <p class="card-text fw-bold mb-2">Penanggungjawab : 
                        <span class="fst-italic fw-normal text-capitalize">
                            {{ $user->name }}
                        </span>
                    </p>
                    <p class="card-text fw-bold mb-2">Harga Total : 
                        <span class="fst-italic fw-normal text-capitalize">
                            Rp {{ number_format($event->event_price, 0, ',', '.') }}
                        </span>
                    </p>
                    <p class="card-text fw-bold mb-2">Status Pembayaran : 
                        <span class="text-uppercase fw-normal">
                            @if($event->status_event == 'PENDING EVENT')
                            <span class="badge bg-warning">PENDING</span>
                            @elseif($event->status_event == 'APPROVED EVENT')
                            <span class="badge bg-success">APPROVE</span>
                            @elseif($event->status_event == 'CANCELED EVENT')
                            <span class="badge bg-danger">CANCEL</span>
                            @elseif($event->status_event == 'RETURNED EVENT')
                            <span class="badge bg-danger">BELUM BAYAR</span>
                            @elseif($event->status_event == 'PAID')
                            <span class="badge bg-success">LUNAS</span>
                            @elseif($event->status_event == 'DOWN PAYMENT')
                            <span class="badge bg-warning">DOWN PAYMENT</span>
                            @else
                            <span class="badge bg-info">SELESAI</span>
                            @endif
                        </span>
                    </p>
                    <p class="card-text fw-bold mb-2">Tanggal Mulai : 
                        <span class="fst-italic fw-normal text-capitalize">
                            {{ \Carbon\Carbon::parse($event->date_start)->isoFormat('dddd, D MMMM Y') }}
                        </span>
                    </p>
                    <p class="card-text fw-bold mb-2">Tanggal Selesai : 
                        <span class="fst-italic fw-normal text-capitalize">
                            {{ \Carbon\Carbon::parse($event->date_end)->isoFormat('dddd, D MMMM Y') }}
                        </span>
                    </p>
                    <p class="card-text fw-bold m-0">Deskripsi :</p>
                    <p class="fst-italic text-capitalize">
                        {!! html_entity_decode($event->note, ENT_QUOTES, 'UTF-8' ) !!}
                    </p>
                </div>
            </div>
        </div>
        <div class="card-group">
            <div class="card-body">
                <div class="card-body col-md-12 bg-light" style="display: none">
                    @php $encryptID = Crypt::encrypt($event->id); @endphp
                    <form action="{{ route('event.cancel', $encryptID) }}" method="POST" enctype="multipart/form-data">
                        @csrf()
                        <table class="table text-center align-middle" style="width:100%;">
                                <input type="hidden" name="status_event">
                                <input type="hidden" name="status_alat" value="READY">
                                <input type="hidden" name="jml_stok" value="1">
                                <thead class="thead thead-light bg-gray-dark text-white table-bordered">
                                    <tr class="text-center">
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Harga Sewa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($toolEvents as $toolEvent)
                                    <tr class="text-center">
                                        <th scope="row" class="align-middle">{{ $loop->iteration }}</th>
                                        <td class="align-middle text-capitalize">
                                            <input type="hidden" name="tools_id[]" value="{{ $toolEvent->tools_id }}">
                                            {{ $toolEvent->tools_name }}
                                        </td>
                                        <td class="align-middle text-right">
                                            Rp {{ number_format($toolEvent->price, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center">
                                            Data Masih Kosong
                                        </td>
                                    </tr>
                                    @endforelse
                                    <tr>
                                        <td colspan="2" class="fw-bold text-right">Total Harga </td>
                                        <td colspan="1" class="fw-bold text-right">Rp {{ number_format($total, 0, ',', '.') }}</td>
                                    </tr>
                                </tbody>
                        </table>
                </div>
                <div class="d-flex justify-content-end mt-3 gap-2">
                    <a href="{{ route('event.index') }}" class="btn btn-primary">Kembali</a>
                    <button type="submit" class="btn btn-danger"><i class="far fa-times-circle"></i> Batalkan Event</button>
                </div>
            </form>
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