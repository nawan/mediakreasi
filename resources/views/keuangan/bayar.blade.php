@push('style')
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
@endpush
<style>
    #allocate-table-body {
max-height : 300px;
overflow-y: auto;
}
</style>


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
                        <li class="breadcrumb-item"><a href="{{ route('keuangan.index') }}">Billing</a></li>
                        <li class="breadcrumb-item"> <a href="{{ route('keuangan.index') }}">Pembayaran</a></li>
                        <li class="breadcrumb-item active">Bayar</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="card mt-10 mb-5">
        <div class="card-header text-center fw-bold text-uppercase mb-10 bg-success text-white">
            Formulir Pembayaran Alat
        </div>
        <div class="card-group">
            <div class="card-body">
                <form action="{{ route('bayarAlat.store', $event->id) }}" method="POST" enctype="multipart/form-data" class="mb-4">
                    @csrf()
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
                                        <div class="card-bod col-md-6">
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
                                            <p class="card-text fw-bold m-0">Status Penyewaan</p>
                                            <p class="mb-2">
                                                <span class="text-uppercase">
                                                    @if($event->status_event == 'PENDING')
                                                    <span class="badge bg-warning">PENDING</span>
                                                    @elseif($event->status_event == 'PENDING EVENT')
                                                    <span class="badge bg-warning">PENDING</span>
                                                    @elseif($event->status_event == 'APPROVED')
                                                    <span class="badge bg-success">APPROVED</span>
                                                    @elseif($event->status_event == 'APPROVED EVENT')
                                                    <span class="badge bg-success">APPROVED</span>
                                                    @elseif($event->status_event == 'PAID')
                                                    <span class="badge bg-primary">LUNAS</span>
                                                    @elseif($event->status_event == 'DONE')
                                                    <span class="badge bg-info">SELESAI</span>
                                                    @elseif($event->status_event == 'DOWN PAYMENT')
                                                    <span class="badge bg-warning">DOWN PAYMENT</span>
                                                    @elseif($event->status_event == 'RETURNED EVENT')
                                                    <span class="badge bg-danger">BELUM BAYAR</span>
                                                    @elseif($event->status_event == 'RETURNED')
                                                    <span class="badge bg-danger">BELUM BAYAR</span>
                                                    @else
                                                    <span class="badge bg-secondary">DIBATALKAN</span>
                                                    @endif
                                                </span>
                                            </p>
                                        </div>
                                        <div class="card-group">
                                            <div class="card-body col-md-12 text-start">
                                                <p class="card-text fw-bold m-0">Catatan</p>
                                                <p class="fst-italic text-capitalize">{{ $event->note }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                            <!-- Modal -->
                            {{-- <div class="modal fade" id="detail{{ $event->id }}" tabindex="-1" role="dialog" aria-labelledby="detail{{ $event->id }}Label" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-info fw-bold text-uppercase">
                                    <h5 class="modal-title" id="detail{{ $event->id }}">Data Alat dan Crew</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card-group bg-light mt-10">
                                            <div class="card">
                                                <div class="card-header text-center text-uppercase fw-bold mb-3">
                                                    Alat
                                                </div>
                                                <div class="card-body modal-body text-center" style="400px">
                                                    <table class="table text-center align-middle" style="width:100%;">
                                                        <thead class="thead thead-light bg-gray-dark text-white table-bordered">
                                                            <tr class="text-center">
                                                                <th scope="col">No</th>
                                                                <th scope="col">Nama Alat</th>
                                                                <th scope="col">Harga Sewa</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @forelse($toolEvents as $toolEvent)
                                                            <tr class="text-center">
                                                                <th scope="row" class="align-middle">{{ $loop->iteration }}</th>
                                                                <td class="align-middle text-capitalize">
                                                                    {{ $toolEvent->tools_name }}
                                                                </td>
                                                                <td class="align-middle text-left">
                                                                    Rp {{ number_format($toolEvent->price, 0, ',', '.') }}
                                                                </td>
                                                            </tr>
                                                            @empty
                                                            <tr>
                                                                <td colspan="4" class="text-center">
                                                                    Data Kosong
                                                                </td>
                                                            </tr>
                                                            @endforelse
                                                            <tr>
                                                                <td colspan="3" class="text-uppercase fw-bold text-right">Jumlah Alat : {{ $jumlahAlat }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header text-center text-uppercase fw-bold mb-3">
                                                    Crew
                                                </div>
                                                <div class="card-body modal-body text-center modal-dialog-scrollable" style="400px">
                                                    <table class="table text-center align-middle" style="width:100%;">
                                                        <thead class="thead thead-light bg-gray-dark text-white table-bordered">
                                                            <tr class="text-center">
                                                                <th scope="col">No</th>
                                                                <th scope="col">Nama Crew</th>
                                                                <th scope="col">No Kontak</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @forelse($users as $user)
                                                            <tr class="text-center">
                                                                <th scope="row" class="align-middle">{{ $loop->iteration }}</th>
                                                                <td class="align-middle text-capitalize">
                                                                    {{ $user->crews_name }}
                                                                </td>
                                                                <td class="align-middle text-center">
                                                                    {{ $user->no_kontak }}
                                                                </td>
                                                            </tr>
                                                            @empty
                                                            <tr>
                                                                <td colspan="4" class="text-center">
                                                                    Data Kosong
                                                                </td>
                                                            </tr>
                                                            @endforelse
                                                            <tr>
                                                                <td colspan="3" class="text-uppercase fw-bold text-right">Jumlah Crew : {{ $jumlahCrew }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer bg-light">
                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                                </div>
                            </div> --}}

                        <div class="card-body col-md-12">
                            <div class="row mb-3 card-text">
                                <div class="form-group col-md-6" style="display:none">
                                    <input type="text" class="form-control text-capitalize count-chars @error('user_id') is-invalid @enderror" id="user_id" name="user_id" value="{{ old('user_id', $user->id) }}" maxlength="20" data-max-chars="20" hidden>
                                    @error('user_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6" style="display:none">
                                    <input type="text" class="form-control text-capitalize count-chars @error('tools_id') is-invalid @enderror" id="tools_id" name="tools_id" value="{{ old('tools_id', $alat->id) }}" maxlength="20" data-max-chars="20" hidden>
                                    @error('tools_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6" style="display:none">
                                    <input type="text" class="form-control text-capitalize count-chars @error('events_id') is-invalid @enderror" id="events_id" name="events_id" value="{{ $event->id }}" maxlength="20" data-max-chars="20" hidden>
                                    @error('events_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6" style="display: none">
                                    <input type="text" class="form-control text-capitalize count-chars @error('received_by') is-invalid @enderror" id="received_by" name="received_by" value="{{ auth()->user()->id; }}" maxlength="20" data-max-chars="20" hidden>
                                    @error('received_by')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6" style="display: none">
                                    <input type="text" class="form-control text-capitalize count-chars @error('duration') is-invalid @enderror" id="duration" name="duration" value="{{ $duration }}" maxlength="20" data-max-chars="20" hidden>
                                    @error('duration')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6" style="display: none">
                                    <input type="text" class="form-control text-capitalize count-chars @error('total_price') is-invalid @enderror" id="total_price" name="total_price" value="{{ $event->event_price }}" maxlength="20" data-max-chars="20" hidden>
                                    @error('total_price')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3 card-text">
                                <div class="form-group col-md-4">
                                    <label for="payment_status" class="form-label">Jenis Pembayaran</label>
                                    <select class="form-select" id="payment_status" name="payment_status">
                                        <option value="">-- Pilih Jenis Pembayaran --</option>
                                        <option value="DP">Down Payment</option>
                                        <option value="LUNAS">Full Payment</option>
                                    </select>
                                    @error('payment_status')
                                    <span class="invalid-feedback">
                                    {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="payment_method" class="form-label">Metode Pembayaran</label>
                                    <select class="form-select" id="payment_method" name="payment_method">
                                        <option value="">-- Pilih Metode Pembayaran --</option>
                                        <option value="tunai">Tunai</option>
                                        <option value="transfer">Transfer Bank</option>
                                        <option value="qris">QRIS GPN</option>
                                    </select>
                                    @error('payment_method')
                                    <span class="invalid-feedback">
                                    {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="payment_date" class="form-label">Tanggal Pembayaran</label>
                                    <input type="date" class="form-control @error('payment_date') is-invalid @enderror" name="payment_date" id="payment_date" value="{{ old('payment_date') }}">
                                    @error('date_start')
                                    <span class="invalid-feedback">
                                    {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3 card-text">
                                <div class="form-group col-md-4">
                                    <label for="payment_amount" class="form-label">Nominal Diterima</label>
                                    <div class="input-group">
                                        <div class="input-group-text">Rp</div>
                                        <input type="text" class="form-control count-chars @error('payment_amount') is-invalid @enderror" name="payment_amount" id="currency" value="{{ old('payment_amount') }}" maxlength="15" data-max-chars="15">
                                    </div>
                                    <div class="fw-light text-muted justify-content-end d-flex"></div>
                                    @error('price')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-8">
                                    <label for="payment_proof" class="form-label">Foto Bukti Pembayaran</label>
                                    <img src="" class="mb-3 img-preview img-fluid col-sm-5" alt="">
                                    <input class="form-control @error('payment_proof') is-invalid @enderror" type="file" id="image" name="payment_proof" onchange="previewImage()">
                                    @error('payment_proof') 
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 card-text" style="display:none">
                                <label for="exampleInputEmail1">Payment Code</label>
                                    @php
                                        $length = 4;    
                                        $alph_num =  substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$length);
                                        $num =  substr(str_shuffle('0123456789'),1,$length);
                                    @endphp
                                <input type="text" required name="payment_code" value="WHP-N-@php echo $alph_num;@endphp-@php echo $num;@endphp " class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-3 gap-2">
                            <a href="{{ route('keuangan.index') }}" class="btn btn-danger">Batal</a>
                            <button type="submit" class="btn btn-primary">Bayar</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
    <br>

    <script type="text/javascript" src="{{ URL::asset('plugins/jquery/jquery.min.js') }}"></script>
    {{-- currency script --}}
    <script type="text/javascript" src="{{ URL::asset('js/currency.js') }}"></script>
    {{-- form validation script --}}
    <script type="text/javascript" src="{{ URL::asset('js/form-validation.js') }}"></script>
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