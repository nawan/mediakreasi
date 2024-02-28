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
{{-- <script type="text/javascript">
    $(function() {
        $('[data-toggle="tooltip"]').tooltip();

        var table = $('#data_event_alat').DataTable({
            responsive: true,
            rowReorder: {
                selector: 'td:nth-child(2)'
            },
            processing: true,
            serverSide: true,
            ajax: "{{ route('event.alat') }}",
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
                    data: 'note',
                    name: 'note',
                    render: function(data, type, full, meta) {
                        return "<span class=\"text-capitalize\">"+ data +"</span>";
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
</script> --}}


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
                        <li class="breadcrumb-item">Event</li>
                        <li class="breadcrumb-item"><a href="{{ route('event.index') }}">Data Event</a></li>
                        <li class="breadcrumb-item active">Tambah Crew</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="row mt-10 mb-5">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header text-center fw-bold text-uppercase mb-10 bg-success text-white">
                        tambah crew {{ $event->nama_event }}
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover text-center align-middle stripe" id="data_event_alat" style="width:100%;">
                            <thead class="thead thead-light bg-gray-dark text-white table-bordered">
                                <tr class="text-center">
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Foto</th>
                                    <th scope="col">No Kontak</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                <tr class="text-center">
                                    <th scope="row" class="align-middle">{{ $loop->iteration }}</th>
                                    <td class="align-middle text-capitalize">
                                        {{ $user->name }}
                                    </td>
                                    <td class="align-middle text-capitalize">
                                        <img src="{{ asset('storage/' . $user->image) }}" width="75" alt="">
                                    </td>
                                    <td class="align-middle">
                                        {{ $user->no_kontak }}
                                    </td>
                                    <td class="align-middle">
                                        {{-- @if($user->id == 26)
                                        <form class="d-inline m-1" action= "{{ route('event.tambahCrew',  ['event_id' => $event->id, 'crew_id' => $user->id]) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-secondary btn-sm disabled" title="Tambah Alat" data-toggle="tooltip" data-placement="top" type="submit"><i class="fa fa-plus-square"></i> Tambah</button>
                                        </form>
                                        @else
                                        <form class="d-inline m-1" action= "{{ route('event.tambahCrew',  ['event_id' => $event->id, 'crew_id' => $user->id]) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-success btn-sm" title="Tambah Alat" data-toggle="tooltip" data-placement="top" type="submit"><i class="fa fa-plus-square"></i> Tambah</button>
                                        </form>
                                        @endif --}}
                                        <form class="d-inline m-1" action= "{{ route('event.tambahCrew',  ['event_id' => $event->id, 'crew_id' => $user->id]) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-success btn-sm" title="Tambah Alat" data-toggle="tooltip" data-placement="top" type="submit"><i class="fa fa-plus-square"></i> Tambah</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">
                                        Data Masih Kosong
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card-header text-center fw-bold text-uppercase mb-10 bg-success text-white">
                    <i class="fa fa-cart-plus"></i> cart
                </div>
                <div class="card-body bg-white">
                    <table class="table text-center align-middle" id="data_event_alat" style="width:100%;">
                        <thead class="thead thead-light bg-gray-dark text-white table-bordered">
                            <tr class="text-center">
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">No Kontak</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($crewEvents as $crewEvent)
                            <tr class="text-center">
                                <th scope="row" class="align-middle">{{ $loop->iteration }}</th>
                                <td class="align-middle text-capitalize">
                                    {{ $crewEvent->crews_name }} 
                                </td>
                                <td class="align-middle text-left">
                                    {{ $crewEvent->no_kontak }}
                                </td>
                                <td class="align-middle">
                                    <form class="d-inline m-1" action= "{{ route('event.deleteCrew', ['event_id' => $event->id, 'crewEvents_id' => $crewEvent->id]) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <input name="_method" type="hidden" value="DELETE">
                                        <button class="btn btn-outline-danger btn-sm" title="Hapus Alat" data-toggle="tooltip" data-placement="top" type="submit"><i class="fa fa-trash-alt"></i></button>
                                    </form>
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
                                <td colspan="2" class="fw-bold text-left">Total Crew</td>
                                <td colspan="2" class="fw-bold text-left">{{ $jumlahCrew }}</td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-right">
                                    @php $encryptID = Crypt::encrypt($event->id); @endphp
                                    @if($jumlahCrew == 0)
                                        <form class="d-inline m-1" action= "{{ route('event.submitCrew',$encryptID) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-sm btn-outline-secondary disabled" title="Submit" data-toggle="tooltip" data-placement="top" type="submit"><i class="fa fa-check"></i> Checkout</button>
                                        </form>
                                    @else
                                        <form class="d-inline m-1" action= "{{ route('event.submitCrew',$encryptID) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-sm btn-outline-primary" title="Submit" data-toggle="tooltip" data-placement="top" type="submit"><i class="fa fa-check"></i> Checkout</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    {{ $crewEvents->links() }}
                </div>
            </div>
        </div>
    </section>

    {{-- <div class="card mt-10 mb-5">
        <div class="card-header text-center fw-bold text-uppercase mb-10 bg-dark text-white">
           tambah crew {{ $event->nama_event }}
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover text-center align-middle stripe" id="data_event_alat" style="width:100%;">
                <thead class="thead thead-light bg-gray-dark text-white table-bordered">
                    <tr class="text-center">
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Foto</th>
                        <th scope="col">No Kontak</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr class="text-center">
                        <th scope="row" class="align-middle">{{ $loop->iteration }}</th>
                        <td class="align-middle text-capitalize">
                            {{ $user->name }}
                        </td>
                        <td class="align-middle text-capitalize">
                            <img src="{{ asset('storage/' . $user->image) }}" width="75" alt="">
                        </td>
                        <td class="align-middle">
                            {{ $user->no_kontak }}
                        </td>
                        <td class="align-middle">
                            <form class="d-inline m-1" action= "{{ route('event.tambahCrew',  ['event_id' => $event->id, 'crew_id' => $user->id]) }}" method="POST">
                                @csrf
                                <button class="btn btn-success btn-sm" title="Tambah Alat" data-toggle="tooltip" data-placement="top" type="submit"><i class="fa fa-plus-square"></i> Tambah</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">
                            Data Masih Kosong
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $users->links() }}
        </div>
    </div> --}}

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