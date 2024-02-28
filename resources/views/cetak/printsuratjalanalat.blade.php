<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Print Surat Jalan Alat</title>
        {{-- bootstrap@5.3.0-alpha3 css --}}
        <link rel="stylesheet" href="{{ URL::asset('assets/bootstrap-5/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <style>
            @media print{
                @page {size: A4 potrait;}
            }
        </style>
    </head>
    <body>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    {{-- company title receipt --}}
                    <div class="invoice-title">
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
                    {{-- Header --}}
                    <div class="col-md-12 text-center mb-5">
                        <p class="text-uppercase fw-bold h5">Surat Persetujuan</p>
                    </div>
                    {{-- client title receipt --}}
                    <div class="row">
                        {{-- col 1 --}}
                        <div class="col-sm-6" style="font-size: 0.8rem">
                            <div class="text-muted">
                                <p class="h6 mb-1">Kami sewakan alat kepada :</p>
                                <p class="mb-1 fw-bold text-uppercase fst-italic" style="font-size: 1rem"> {{ $user->name }}</p>
                                <p class="mb-0 fst-italic">{{ $user->no_kontak }}</p>
                                <p class="mb-0 text-capitalize fst-italic">{{ $user->alamat }}</p>
                            </div>
                        </div>
                        {{-- col 2 --}}
                        <div class="col-sm-6" style="font-size: 0.8rem">
                            <div class="text-muted text-sm-end">
                                <p class="h6 fw-bold mb-1">Tanggal Approval</p>
                                <p class="fst-italic text-capitalize" style="font-size: 1rem">{{ \Carbon\Carbon::parse($event->update_at)->isoFormat('dddd, D MMMM Y') }}</p>
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
                                        <th class="text-center">Tanggal Sewa</th>
                                        <th class="text-center">Tanggal Kembali</th>
                                        <th class="text-center">Durasi</th>
                                        <th class="text-center">Tarif</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center text-uppercase">{{ $tool->name }}</td>
                                        <td class="text-center text-uppercase">{{ \Carbon\Carbon::parse($event->date_start)->isoFormat('dddd, D MMMM Y') }}</td>
                                        <td class="text-center text-uppercase">{{ \Carbon\Carbon::parse($event->date_end)->isoFormat('dddd, D MMMM Y') }}</td>
                                        <td class="text-center">{{ $duration }} Hari</td>
                                        <td class="text-center">Rp {{ number_format($event->event_price, 0, ',','.') }}</td>
                                        <td class="text-center">{{ $event->status_event }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{-- footer --}}
                    <div class="mt-5 mb-5">
                        <div class="p-2" style="border-left: 10px solid #85bde8;">
                            <p class="fst-italic mb-0">NB:</p>
                            <p class="fst-italic text-muted fw-bold mb-0" style="font-size: 0.8rem">1. Harap alat dikembalikan pada waktu yang sudah ditetapkan</p>
                            <p class="fst-italic text-muted fw-bold" style="font-size: 0.8rem">2. Segala bentuk kerusakan alat yang timbul karena kelalaian penggunaan akan ditanggung oleh penyewa</p>
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
                            Dokumen Dicetak Otomatis pada Hari {{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }} Pukul {{ Carbon\Carbon::now()->isoFormat('HH:mm:ss') }}
                        </footer>
                    </div>
                </div>
            </div>
        </div>
        <script>
            window.print();
        </script>
    </body>
    @stack('script')
</html>