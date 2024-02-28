
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('assets/bootstrap-5/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/bootstrap-5/css/dataTables.bootstrap5.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/bootstrap-5/css/responsive.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/bootstrap-5/css/jquery.dataTables.min.css') }}"> --}}

{{-- <link rel="stylesheet" src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}">
<link rel="stylesheet" src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}">
<link rel="stylesheet" src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}">
<link rel="stylesheet" src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}">
<link rel="stylesheet" src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}">

<link rel="stylesheet" src="{{ asset('plugins/jszip/jszip.min.js') }}">

<link rel="stylesheet" src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}">

<link rel="stylesheet" src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}">

<link rel="stylesheet" src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}">
<link rel="stylesheet" src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"> --}}

{{-- <style>
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        margin: 0;
        padding: 0;
    }
</style> --}}


@extends('layouts.main')

@section('content')


<div class="card mt-10 mb-5">
    <div class="card-header text-center fw-bold text-uppercase mb-10 bg-dark text-white">
        Data Client
    </div>
    <div class="card-body">
        <div class="d-flex mt-4 mb-3">
            <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus-square"></i> Tambah Data Client</a>
        </div>
        <table class="table table-bordered table-hover text-center align-middle stripe" id="data-client" style="width:100%;">
            <thead class="thead thead-light bg-secondary text-white table-bordered">
                <tr class="text-center">
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Foto KTP</th>
                    <th scope="col">No Kontak</th>
                    <th scope="col">Terdaftar Sejak</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="6" class="text-center">
                        Data Masih Kosong
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

{{-- <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script> --}}

{{-- <script type="text/javascript" src="plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script type="text/javascript" src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="plugins/jszip/jszip.min.js"></script>
<script type="text/javascript" src="plugins/pdfmake/pdfmake.min.js"></script>
<script type="text/javascript" src="plugins/pdfmake/vfs_fonts.js"></script>
<script type="text/javascript" src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script type="text/javascript" src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script> --}}

{{-- <script type="text/javascript" src="{{ URL::asset('plugins/jquery/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/jszip/jszip.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script> --}}

{{-- <script type="text/javascript" src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script> --}}


<script type="text/javascript" src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<!-- AdminLTE App -->
<script type="text/javascript" src="{{ asset('js/adminlte.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script type="text/javascript" src="{{ asset('js/demo.js') }}"></script>



<script type="text/javascript">
    $(function() {

        var table = $('#data-client').DataTable({
            responsive: true,
            rowReorder: {
                selector: 'td:nth-child(2)'
            },
            processing: true,
            serverSide: true,
            ajax: "{{ route('user.index') }}",
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
                    data: 'image',
                    name: 'image',
                    render: function(data, type, full, meta) {
                        return "<img src=\"storage/" + data + "\" width=\"120\" height=\"60\"/>";
                    },
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'no_kontak',
                    name: 'no_kontak',
                    render: function(data, type, full, meta) {
                        return "<span class=\"text-uppercase\">"+ data +"</span>";
                    }
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true,
                    render: function(data){
                    return "<div class=\"d-inline-flex\">"+data+"</div>"
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

@endsection


