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
<script type="text/javascript">
    $(function() {
        $('[data-toggle="tooltip"]').tooltip();

        var table = $('#riwayat-sewa').DataTable({
            responsive: true,
            rowReorder: {
                selector: 'td:nth-child(2)'
            },
            processing: true,
            serverSide: true,
            //ajax: "{{ route('cetak.suratjalan') }}",
            columnDefs: [{
                    targets: '_all',
                    className: 'dt-center',
            }],
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'tools_id',
                    name: 'tools_id',
                    render: function(data, type, full, meta) {
                        return "<span class=\"text-capitalize\">"+ data +"</span>";
                    }
                },
                {
                    data: 'date_start',
                    name: 'date_start',
                    render: function(data, type, full, meta) {
                        return "<span class=\"text-capitalize\">"+ data +"</span>";
                    }
                },
                {
                    data: 'date_end',
                    name: 'date_end',
                    render: function(data, type, full, meta) {
                        return "<span class=\"text-capitalize\">"+ data +"</span>";
                    }
                },
                {
                    data: 'event_price',
                    name: 'event_price',
                    render: function(data, type, full, meta) {
                        return "<span class=\"text-capitalize\">Rp "+ data +"</span>";
                    }
                },
                {
                    data: 'note',
                    name: 'note',
                    render: function(data, type, full, meta) {
                        return "<span class=\"text-capitalize\">"+ data +"</span>";
                    }
                },
                {
                    data: 'status_event',
                    name: 'status_event',
                    render: function(data, type, full, meta) {
                        if (data == 'APPROVED EVENT') {
                            return "<span class=\"badge bg-success text-uppercase\">APPROVED</span>";
                        } 
                        else if (data == 'APPROVED') {
                            return "<span class=\"badge bg-success text-uppercase\">APPROVED</span>";
                        } 
                        else if (data == 'CANCELED') {
                            return "<span class=\"badge bg-secondary text-uppercase\">BATAL</span>";
                        } 
                        else if (data == 'CANCELED EVENT') {
                            return "<span class=\"badge bg-secondary text-uppercase\">BATAL</span>";
                        } 
                        else if (data == 'DOWN PAYMENT') {
                            return "<span class=\"badge bg-warning text-uppercase\">BAYAR DP</span>";
                        } 
                        else if (data == 'PAID') {
                            return "<span class=\"badge bg-info text-uppercase\">LUNAS</span>";
                        } 
                        else if (data == 'PENDING') {
                            return "<span class=\"badge bg-warning text-uppercase\">PENDING</span>";
                        } 
                        else {
                            return "<span class=\"badge bg-danger text-uppercase\">BELUM BAYAR</span>";
                        }
                    }
                },
            ],
            language: {
                "sProcessing":   "Memproses...",
                "sLoadingRecords": "Memuat...",
                "sLengthMenu":   "Tampilan _MENU_ Baris",
                "sZeroRecords":  "Data yang Anda cari tidak ditemukan",
                "sInfo":         "Menampilkan _START_-_END_ dari _TOTAL_ Baris",
                "sInfoEmpty":    "Data Kosong",
                "sInfoFiltered": "(dari keseluruhan data)",
                "sInfoPostFix":  "",
                "sSearch":       "Cari Data:",
                "sUrl":          "",
                "oPaginate": {
                    "sFirst":    "<<",
                    "sPrevious": "<",
                    "sNext":     ">",
                    "sLast":     ">>"
                },
                "aria": {
                    "sortAscending":  ": Tampilan kolom ascending",
                    "sortDescending": ": Tampilan kolom descending"
                }
            }
        });

    });
</script>

@extends('layouts.main')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Client</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Client</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Data Client</a></li>
                        <li class="breadcrumb-item active">View</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="card mt-10 mb-5">
        <div class="card-header text-center fw-bold text-uppercase mb-10 bg-info text-white">
            Detail Data Client
        </div>
        <div class="card-group bg-light mt-10">
            <div class="card-body text-center col-md-6">
                <div class="card-header text-center text-uppercase fw-bold bg-secondary text-white">
                    Foto KTP
                </div>
                <div class="card-body bg-white p-5" style="width:100%;max-heigth:600px">
                    <img src="{{ asset('storage/' . $user->image) }}" class="rounded img-thumbnail" width="500" data-bs-toggle="modal" data-bs-target="#detail-foto">
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
            <div class="card-body col-md-6">
                <div class="card-header text-center text-uppercase fw-bold bg-secondary text-white">
                    Data Client
                </div>
                <div class="card-body bg-white p-3" style="width:100%;max-heigth:600px">
                    <div class="card-text">
                        <p class="card-text fw-bold m-0">Nama Client</p>
                        <p class="fst-italic text-capitalize mb-2">{{ $user->name }}</p>
                        <p class="card-text fw-bold m-0">NIK</p>
                        <p class="fst-italic text-capitalize mb-2">{{ $user->nik }}</p>
                        <p class="card-text fw-bold m-0">No Kontak</p>
                        <p class="fst-italic text-capitalize mb-2">{{ $user->no_kontak }}</p>
                        <p class="card-text fw-bold m-0">Email</p>
                        <p class="fst-italic mb-2">{{ $user->email }}</p>
                        <p class="card-text fw-bold m-0">Alamat</p>
                        <p class="fst-italic text-capitalize mb-2">{{ $user->alamat }}</p>
                    </div>
                    <div class="d-flex justify-content-end mt-3 gap-2">
                        @php $encryptID = Crypt::encrypt($user->id); @endphp
                        <a href="{{ route('user.edit', $encryptID) }}"class="btn btn-warning m-1" title="Tulis Catatan" data-toggle="tooltip" data-placement="top"><i class="fas fa-edit"></i></a>
                    </div>
                </div>
            </div>
            <div class="card-body col-md-12">
                <div class="card-header text-center text-uppercase fw-bold bg-secondary text-white">
                    Riwayat Penyewaan
                </div>
                <div class="card-body bg-white text-center p-3" style="width:100%; max-heigth:500px">
                    <table class="table text-center align-middle" id="riwayat-sewa" style="width:100%;">
                        <thead class="thead thead-light bg-gray-dark text-white table-bordered">
                            <tr class="text-center">
                                <th scope="col">No</th>
                                <th scope="col">Alat/Event</th>
                                <th scope="col">Mulai</th>
                                <th scope="col">Selesai</th>
                                <th scope="col">Total Bayar</th>
                                <th scope="col">Note</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="7" class="text-center">
                                    Data Masih Kosong
                                </td>
                            </tr>
                        </tbody>
                    </table>
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