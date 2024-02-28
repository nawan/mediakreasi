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
{{-- datatables css --}}
<link rel="stylesheet" href="{{ URL::asset('assets/bootstrap-5/css/buttons.dataTables.min.css') }}">
{{-- datatables css --}}
<link rel="stylesheet" href="{{ URL::asset('assets/bootstrap-5/css/dataTables.bootstrap.min.css') }}">
@endpush

{{-- Button Datatables --}}
<script type="text/javascript" src="{{ URL::asset('assets/bootstrap-5/js/dataTables.buttons.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/bootstrap-5/js/jszip.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/bootstrap-5/js/pdfmake.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/bootstrap-5/js/vfs_fonts.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/bootstrap-5/js/buttons.html5.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/bootstrap-5/js/buttons.print.min.js') }}"></script>

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
<script type="text/javascript">
    $(function() {
        $('[data-toggle="tooltip"]').tooltip();

        var table = $('#laporan-alat').DataTable({
            dom: 'Blfrtip',
            lengthMenu: [
                [ 10, 25, 50, -1 ],
                [ '10', '25', '50', 'Semua' ]
            ],
            responsive: true,
            fixedHeader: true,
            buttons: [
                    {
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'A4',
                    page: 'all',
                    search: 'none',
                    exportOptions: {
                        modifier: {
                            page: 'all',
                            search: 'none'   
                            }
                    }
                },
                    {
                    extend: 'excel',
                    orientation: 'landscape',
                    pageSize: 'A4'
                },
                    {
                    extend: 'csvHtml5',
                    orientation: 'landscape',
                    pageSize: 'A4'
                },
                    {
                    extend: 'print',
                    orientation: 'landscape',
                    pageSize: 'A4',
                    exportOptions: {
                    modifier: {
                        page: 'all',
                        search: 'none'   
                        }
                    }
                },
            ],
            rowReorder: {
                selector: 'td:nth-child(2)'
            },
            processing: true,
            serverSide: true,
            ajax: "{{ route('laporan.alat') }}",
            columnDefs: [{
                    targets: '_all',
                    className: 'dt-center',
            }],
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name',
                    render: function(data, type, full, meta) {
                        return "<span class=\"text-capitalize\">"+ data +"</span>";
                    }
                },
                {
                    data: 'foto_alat',
                    name: 'foto_alat',
                    render: function(data, type, full, meta) {
                        return "<img src=\"storage/" + data + "\" width=\"150\" height=\"100\"/>";
                    },
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'price',
                    name: 'price',
                    render: function(data, type, full, meta) {
                        return "<span class=\"text-capitalize\">rp "+ data +"</span>";
                    }
                },
                {
                    data: 'status_alat',
                    name: 'status_alat',
                    render: function(data, type, full, meta) {
                        if (data == 'READY') {
                            return "<span class=\"badge bg-success text-uppercase\">"+ data +"</span>";
                        }
                        else if (data == 'BOOKING') {
                            return "<span class=\"badge bg-warning text-uppercase\">"+ data +"</span>";
                        }
                        else if (data == 'TERPAKAI') {
                            return "<span class=\"badge bg-danger text-uppercase\">"+ data +"</span>";
                        }
                        else {
                            return "<span class=\"badge bg-info text-uppercase\">"+ data +"</span>";
                        }
                    }
                },
                {
                    data: 'note',
                    name: 'note',
                    orderable: true,
                    searchable: true,
                    render: function(data){
                    return "<div class=\"text-capitalize\">"+ data +"</div>";
                }
                },
                {
                    data: 'deskripsi',
                    name: 'deskripsi',
                    orderable: true,
                    searchable: true,
                    render: function(data){
                    return "<div class=\"text-capitalize\">"+ data +"</div>";
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

{{-- <h1 class="mt-4">Dashboard</h1>
<ol class="mb-4 breadcrumb">
    <li class="breadcrumb-item active">Home</li>
</ol> --}}

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Laporan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Laporan</li>
                        <li class="breadcrumb-item active"><a href="{{ route('laporan.alat') }}">Data Alat</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content mb-10">
        <div class="card mt-10 mb-5">
            <div class="card-header text-center fw-bold text-uppercase mb-10 bg-dark text-white">
                Data Alat
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover text-center align-middle stripe" id="laporan-alat">
                    <thead class="thead thead-light bg-gray-dark text-white table-bordered">
                        <tr class="text-center">
                            <th scope="col">No</th>
                            <th scope="col">Nama Alat</th>
                            <th scope="col">Foto</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Status</th>
                            <th scope="col">Note</th>
                            <th scope="col">Deskripsi</th>
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
    </section>
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