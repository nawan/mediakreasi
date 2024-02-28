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
                    <h1 class="m-0">Admin</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item active">Data Admin</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="card mt-10 mb-5">
            <div class="card-header text-center fw-bold text-uppercase mb-10 bg-dark text-white">
                Data Admin
            </div>
            <div class="card-body">
                <div class="d-flex mt-4 mb-3">
                    <a href="{{ route('admin.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus-square"></i> Tambah Admin</a>
                </div>
                <div class="justify-content-center">
                    <form action="{{ route('admin.index') }}" method="GET">
                        <div class="row">
                            <div class="col">
                                <div class="input-group mb-3">
                                    <input type="text" value="{{ Request::input('search') }}" class="form-control" placeholder="Nama Admin..." name="search">
                                    <button class="btn btn-primary" type="submit">Cari</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <table class="table table-hover mb-2">
                        <thead class="thead-light">
                            <tr class="text-center">
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Foto</th>
                            <th scope="col">No Kontak</th>
                            <th scope="col">Terdaftar Sejak</th>
                            <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($users as $user)
                            <tr class="text-center">
                            <th scope="row" class="align-middle">{{ $loop->iteration }}</th>
                                <td class="align-middle">
                                <div class="position-relative text-capitalize">
                                {{ $user->name }}
                                    @if($user->is_admin == '1')
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        admin
                                        
                                    </span>
                                    @elseif($user->is_admin == '2')
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-info">
                                        supervisor
                                        
                                    </span>
                                    @elseif($user->is_admin == '3')
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                                        staff
                                        
                                    </span>
                                    @endif
                                    </div>
                                    <div style="visibility: hidden">{{ $user->is_admin }}</div>
                                </td>
                                <td>
                                    @if($user->image)  
                                    <img src="{{ asset('storage/' . $user->image) }}" width="75" alt="">
                                    @else
                                    <img src="{{ $user->gravatar }}" width="50" class="rounded-circle" alt="">
                                    @endif
                                </td>
                                <td class="align-middle">
                                    {{ $user->email }}
                                </td>
                                <td class="align-middle">
                                    {{ \Carbon\Carbon::parse($user->created_at)->diffForHumans() }}
                                </td>
                                <td class="align-middle">
                                    @php $encryptID = Crypt::encrypt($user->id); @endphp
                                    @if($user->is_admin == '1')
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Info" data-bs-toggle="modal" data-bs-target="#detail{{ $user->id }}">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    @elseif(Auth::user()->is_admin == '1')
                                        <form method="POST" action="{{ route('admin.destroy', $user->id) }}" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <input name="_method" type="hidden" value="DELETE">
                                            <button type="submit" class="btn btn-sm btn-danger btn-flat show_confirm" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="deleteConfirm(event)"><i class="fa fa-trash"></i></button>
                                        </form>
                                        <a href="{{ route('admin.edit',$encryptID) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Info" data-bs-toggle="modal" data-bs-target="#detail{{ $user->id }}">
                                            <i class="fa fa-eye"></i>
                                            </button>
                                    @elseif(Auth::user()->is_admin == '2')
                                        <form method="POST" action="{{ route('admin.destroy', $user->id) }}" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <input name="_method" type="hidden" value="DELETE">
                                            <button type="submit" class="btn btn-sm btn-danger btn-flat show_confirm" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="deleteConfirm(event)"><i class="fa fa-trash"></i></button>
                                        </form>
                                        <a href="{{ route('admin.edit',$encryptID) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Info" data-bs-toggle="modal" data-bs-target="#detail{{ $user->id }}">
                                            <i class="fa fa-eye"></i>
                                            </button>
                                    @else
                                        
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Info" data-bs-toggle="modal" data-bs-target="#detail{{ $user->id }}">
                                            <i class="fa fa-eye"></i></button>
                                    @endif
                                </td>
    
                            <!-- Modal -->
                                <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="detail{{ $user->id }}" tabindex="-1" aria-labelledby="detail{{ $user->id }}Label" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-xl">
                                        <div class="modal-content">
                                            <div class="card mt-10">
                                                <div class="card-header text-center fw-bold text-uppercase mb-10 bg-info text-white">
                                                        Detail Data Admin
                                                </div>
                                                <div class="card-group bg-light mt-10">
                                                    <div class="card">
                                                        <div class="card-header text-center text-uppercase fw-bold mb-3">
                                                            Foto Profil
                                                        </div>
                                                        <div class="card-body text-center" style="400px">
                                                            <p class="card-title text-capitalize fw-bold mb-3 h4">
                                                                @if($user->image)  
                                                                <img src="{{ asset('storage/' . $user->image) }}" class="rounded mx-auto" width="400" alt="">
                                                                @else
                                                                <img src="{{ $user->gravatar }}" class="rounded mx-auto" width="400" alt="">
                                                                @endif
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-header text-center text-uppercase fw-bold mb-3">
                                                            Data Admin
                                                        </div>
                                                        <div class="cad-body text-center mb-3" style="400px">
                                                            <p class="card-text fw-bold m-0">Nama</p>
                                                            <p class="fst-italic text-capitalize mb-2">{{ $user->name }}</p>
                                                            <p class="card-text fw-bold m-0">NIK</p>
                                                            <p class="fst-italic text-uppercase mb-2">{{ $user->nik }}</p>
                                                            <p class="card-text fw-bold m-0">No Kontak</p>
                                                            <p class="fst-italic text-uppercase mb-2"><a href="https://wa.me/" target="_blank">{{ $user->no_kontak  }}</a></p>
                                                            <p class="card-text fw-bold m-0">Email</p>
                                                            <p class="fst-italic mb-2">{{ $user->email }}</p>
                                                            <p class="card-text fw-bold m-0">Alamat</p>
                                                            <p class="fst-italic text-capitalize mb-2">{{ $user->alamat }}</p>
                                                            <p class="card-text fw-bold m-0">Terdaftar Sejak</p>
                                                            <p class="fst-italic mb-2">{{ \Carbon\Carbon::parse($user->created_at)->diffForHumans() }}</p>
                                                            <button type="button" class="btn btn-info btn-sm mb-3"><a href="{{ route('admin.show', $encryptID) }}" class="text-white" style="text-decoration: none">Lihat Detail</a></button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer bg-light">
                                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </tr>
        
                        @empty
                        <tr>
                            <td colspan="6" class="text-center mt-2 mb-2">
                                <span class="fst-italic">Data Tidak Ditemukan</span><br><br>
                                <a href="{{ route('admin.index') }}" class="btn btn-info btn-sm"><i class="fa fa-recycle"></i> Refresh</a>
                            </td>
                        </tr>
                        @endforelse
                        </tbody>
                    </table>
                    {{ $users->links() }}
            </div>
        </div>
    </section>

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