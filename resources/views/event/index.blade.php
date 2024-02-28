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
{{-- currency script --}}
<script type="text/javascript" src="{{ URL::asset('js/currency.js') }}"></script>
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

        var table = $('#data_event').DataTable({
            responsive: true,
            rowReorder: {
                selector: 'td:nth-child(2)'
            },
            processing: true,
            serverSide: true,
            ajax: "{{ route('event.index') }}",
            columnDefs: [{
                    targets: '_all',
                    className: 'dt-center',
            }],
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'user_id',
                    name: 'user_id',
                    render: function(data, type, full, meta) {
                        return "<span class=\"text-capitalize\">"+ data +"</span>";
                    }
                },
                {
                    data: 'nama_event',
                    name: 'nama_event',
                    render: function(data, type, full, meta) {
                        return "<span class=\"text-capitalize\">"+ data +"</span>";
                    }
                },
                {
                    data: 'date_start',
                    name: 'date_start'
                },
                {
                    data: 'date_end',
                    name: 'date_end'
                },
                {
                    data: 'status_event',
                    name: 'status_event',
                    render: function(data, type, full, meta) {
                        if (data == 'PENDING EVENT') {
                            return "<span class=\"badge bg-warning\">PENDING</span>";
                        }
                        else if (data == 'APPROVED EVENT') {
                            return "<span class=\"badge bg-success\">APPROVED</span>";
                        }
                        else if (data == 'CANCELED EVENT') {
                            return "<span class=\"badge bg-danger\">CANCEL</span>";
                        }
                        else {
                            return "<span class=\"badge bg-info\">"+ data +"</span>";
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
                },
            ],
            language: {
                "sProcessing":   "Memproses...",
                "sLoadingRecords": "Memuat...",
                "sLengthMenu":   "Tampilan _MENU_ Baris",
                "sZeroRecords":  "Data Kosong",
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
    
    $(document).on("click", ".updateEvent", function (e) {
        var id = $(this).data('id');
            $('#my_modal').find('#eventid').val(id);
            $('#my_modal #harga_event').attr("value", $(this).attr("data-price"));
            $('#my_modal #harga_crew').attr("value", $(this).attr("data-crew"));
            //$('#my_modal #note').attr("value", $(this).attr("data-note"));
            $('#my_modal #note').setAttribute('value', 'data-note');
            //document.getElementById("input_box").setAttribute('value', 'data-note');
            $('#note').val(data.note);
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
                    <h1 class="m-0">Event</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('penyewaan.index') }}">Event</a></li>
                        <li class="breadcrumb-item active">Data Event</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="card mt-10 mb-5">
        <div class="card-header text-center fw-bold text-uppercase mb-10 bg-dark text-white">
            Data Event
        </div>
        <div class="card-body">
            <div class="d-flex mt-4 mb-3">
                <a href="{{ route('event.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus-square"></i> Tambah Event</a>
            </div>
            <table class="table table-bordered table-hover text-center align-middle stripe" id="data_event" style="width:100%;">
                <thead class="thead thead-light bg-gray-dark text-white table-bordered">
                    <tr class="text-center">
                        <th scope="col">No</th>
                        <th scope="col">Penanggungjawab</th>
                        <th scope="col">Nama Event</th>
                        <th scope="col">Mulai</th>
                        <th scope="col">Selesai</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
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

    {{-- Modal --}}
    <div class="modal fade" id="my_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header row d-flex">
                    <div class="justify-content-start col-md-6">
                        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-info-circle"></i> Konfirmasi Approval</h4>
                    </div>
                    <div class="justify-content-end col-md-6">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                </div>
                <div class="modal-body">
                    <form action="{{ route('event.approve') }}" method="POST">
                        @csrf()
                        <div class="form-group">
                            <input type="hidden" name="eventid" id="eventid">
                        </div>
                        <div class="form-group">
                            <label for="price" class="form-label">Total Harga Sewa Alat<span class="fst-italic text-danger" style="font-size: 0.8rem">*</span></label>
                            <div class="input-group">
                                <div class="input-group-text">Rp</div>
                                <input type="number" class="form-control count-chars" name="harga_event" id="harga_event" maxlength="15" data-max-chars="15">
                            </div>
                            <div class="fw-light text-muted justify-content-end d-flex"></div>
                        </div>
                        <div class="form-group">
                            <label for="price" class="form-label">Tarif Crew<span class="fst-italic text-danger" style="font-size: 0.8rem">*</span></label>
                            <div class="input-group">
                                <div class="input-group-text">Rp</div>
                                <input type="number" class="form-control count-chars" name="harga_crew" id="harga_crew" maxlength="15" data-max-chars="15">
                            </div>
                            <div class="fw-light text-muted justify-content-end d-flex"></div>
                        </div>
                        <div class="form-group">
                            <label for="note" class="form-label">Catatan</label>
                            <textarea rows="8" name="note" id="note" class="form-control count-chars" maxlength="600" data-max-chars="600"></textarea>
                            <div class="fw-light text-muted justify-content-end d-flex"></div>
                        </div>
                        <p class="fst-italic text-danger" style="font-size: 0.8rem">*form diatas diisi ketika terdapat perubahan harga dan wajib mengisi catatan</p>
                        <br>
                        <div class="col-sm text-right">
                            <button type="submit" class="btn btn-outline-primary"><i class="far fa-check-circle"></i> Approve</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    

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