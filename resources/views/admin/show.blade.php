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

        var table = $('#riwayat-penerimaan').DataTable({
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
                    data: 'user_id',
                    name: 'user_id',
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
                    data: 'payment_amount',
                    name: 'payment_amount',
                    render: function(data, type, full, meta) {
                        return "<span class=\"text-capitalize\">Rp "+ data +"</span>";
                    }
                },
                {
                    data: 'payment_status',
                    name: 'payment_status',
                    render: function(data, type, full, meta) {
                        if (data == 'DP(LUNAS)') {
                            return "<span class=\"badge bg-warning text-uppercase\">dp lunas</span>";
                        } 
                        else if (data == 'PELUNASAN') {
                            return "<span class=\"badge bg-success text-uppercase\">pelunasan</span>";
                        } 
                        else if (data == 'DP') {
                            return "<span class=\"badge bg-warning text-uppercase\">dp</span>";
                        } 
                        else {
                            return "<span class=\"badge bg-info text-uppercase\">lunas</span>";
                        }
                    }
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true,
                    render: function(data){
                    return "<div class=\"d-inline-flex\">"+ data +"</div>";
                    }
                }
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
                    <h1 class="m-0">Admin</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Data Admin</a></li>
                        <li class="breadcrumb-item active">View</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="card mt-10 mb-5">
        <div class="card-header text-center fw-bold text-uppercase mb-10 bg-info text-white">
            Detail Data Admin
        </div>
        <div class="card-group bg-light mt-10">
            <div class="card-body text-center col-md-6">
                <div class="card-header text-center text-uppercase fw-bold bg-secondary text-white">
                    Foto Profil
                </div>
                <div class="card-body bg-white p-5" style="width:100%;max-heigth:600px">
                    <img src="{{ asset('storage/' . $admin->image) }}" class="rounded img-thumbnail" width="500" data-bs-toggle="modal" data-bs-target="#detail-foto">
                </div>
            </div>
            <div class="card-body col-md-6">
                <div class="card-header text-center text-uppercase fw-bold bg-secondary text-white">
                    Data Admin
                </div>
                <div class="card-body bg-white p-3" style="width:100%;max-heigth:600px">
                    <div class="card-text">
                        <p class="card-text fw-bold m-0">Nama Admin</p>
                        <p class="fst-italic text-capitalize mb-2">{{ $admin->name }}</p>
                        <p class="card-text fw-bold m-0">NIK</p>
                        <p class="fst-italic text-capitalize mb-2">{{ $admin->nik }}</p>
                        <p class="card-text fw-bold m-0">No Kontak</p>
                        <p class="fst-italic text-capitalize mb-2">{{ $admin->no_kontak }}</p>
                        <p class="card-text fw-bold m-0">Email</p>
                        <p class="fst-italic mb-2">{{ $admin->email }}</p>
                        <p class="card-text fw-bold m-0">Alamat</p>
                        <p class="fst-italic text-capitalize mb-2">{{ $admin->alamat }}</p>
                    </div>
                    <div class="d-flex justify-content-end mt-3 gap-2">
                        @php $encryptID = Crypt::encrypt($admin->id); @endphp
                        @if($admin->is_admin == '1')
                        <a href="{{ route('admin.edit', $encryptID) }}"class="btn btn-secondary m-1 disabled" title="Tulis Catatan" data-toggle="tooltip" data-placement="top"><i class="fas fa-edit"></i></a>
                        @else
                        <a href="{{ route('admin.edit', $encryptID) }}"class="btn btn-warning m-1" title="Tulis Catatan" data-toggle="tooltip" data-placement="top"><i class="fas fa-edit"></i></a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-body col-md-12">
                <div class="card-header text-center text-uppercase fw-bold bg-secondary text-white">
                    Riwayat Approval Pembayaran
                </div>
                <div class="card-body bg-white text-center p-3" style="width:100%; max-heigth:500px">
                    <table class="table text-center align-middle" id="riwayat-penerimaan" style="width:100%;">
                        <thead class="thead thead-light bg-gray-dark text-white table-bordered">
                            <tr class="text-center">
                                <th scope="col">No</th>
                                <th scope="col">Alat/Event</th>
                                <th scope="col">Client</th>
                                <th scope="col">Mulai</th>
                                <th scope="col">Selesai</th>
                                <th scope="col">Nominal</th>
                                <th scope="col">Jenis Bayar</th>
                                <th scope="col">View</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="8" class="text-center">
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