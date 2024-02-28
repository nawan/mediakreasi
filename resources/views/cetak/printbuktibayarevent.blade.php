



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Bukti Bayar Event</title>
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
            <div class="card" id="print_receipt">
                <div class="card-body">
                    {{-- company title receipt --}}
                    <div class="invoice-title">
                        <div class="mb-2">
                            <img src="{{ URL::asset('/assets/img/mediakreasi-full.png') }}" class="navbar-brand-img" data-holder-rendered="true" height="auto" width="300px" />
                        </div>
                        <div class="text-muted mb-3" style="font-size: 0.8rem">
                            <p class="mb-0">Cangkring RT 03 Mulyodadi Bambanglipuro</p>
                            <p class="mb-1">Bantul Yogyakarta 55764</p>
                            <p class="mb-1"> <i class="fa fa-phone"></i> 081904146417</p>
                        </div>
                    </div>
                    <hr class="my-2">
                    {{-- client title receipt --}}
                    <div class="row">
                        {{-- col 1 --}}
                        <div class="col-sm-6" style="font-size: 0.8rem">
                            <div class="text-muted">
                                <p class="h6 mb-1">Telah diterima pembayaran dari :</p>
                                <p class="mb-1 fw-bold text-uppercase fst-italic" style="font-size: 1rem"> {{ $user->name }}</p>
                                <p class="mb-0 fst-italic">{{ $user->no_kontak }}</p>
                                <p class="mb-0 text-capitalize fst-italic">{{ $user->alamat }}</p>
                            </div>
                        </div>
                        {{-- col 2 --}}
                        <div class="col-sm-6" style="font-size: 0.8rem">
                            <div class="text-muted text-sm-end">
                                <p class="h6 fw-bold mb-1">Kode Pembayaran</p>
                                <p class="fst-italic text-uppercase mb-2" style="font-size: 1rem">{{ $payment->payment_code }}</p>
                                <p class="h6 fw-bold mb-1">Tanggal Pembayaran</p>
                                <p class="fst-italic text-capitalize" style="font-size: 1rem">{{ \Carbon\Carbon::parse($payment->payment_date)->isoFormat('dddd, D MMMM Y') }}</p>
                            </div>
                        </div>
                    </div>
                    {{-- order sumary --}}
                    <div class="py-2 mt-2">
                        <div class="table-responsive">
                            <p class="fst-italic" style="font-size: 1rem">Dengan detail event sebagai berikut :</p>
                            <table class="table align-middle nowrap mb-0" style="font-size: 0.8rem">
                                <thead>
                                    <tr class="bg-light">
                                        <th class="text-center">Kategori Event</th>
                                        <th class="text-center">Jenis Bayar</th>
                                        <th class="text-center">Metode Bayar</th>
                                        <th class="text-center">Durasi</th>
                                        <th class="text-end">TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center text-uppercase">{{ $tool->name }}</td>
                                        <td class="text-center text-uppercase">{{ $payment->payment_status }}</td>
                                        <td class="text-center text-uppercase">{{ $payment->payment_method }}</td>
                                        <td class="text-center">{{ $payment->duration }} Hari</td>
                                        <td class="text-end">Rp {{ number_format($payment->payment_amount, 0, ',','.') }}</td>
                                        @php
                                        //simple tax math
                                        $vat_tax = 0.1;
                                        $taxable_payment = $payment->payment_amount;
                                        $tax = $vat_tax * $taxable_payment;
                                        $without_tax = $taxable_payment - $tax;
                                        @endphp
                                    </tr>
                                    <tfoot>
                                        <tr class="fw-bold fst-italic">
                                            <td></td>
                                            <td colspan="3" class="text-end">Subtotal</td>
                                            <td colspan="2" class="text-end">Rp {{ number_format($without_tax, 0, ',','.') }}</td>
                                        </tr>
                                        <tr class="fw-bold fst-italic">
                                            <td></td>
                                            <td colspan="3" class="text-end">Pajak 10%</td>
                                            <td colspan="2" class="text-end">Rp {{ number_format($tax, 0, ',', '.') }}</td>
                                        </tr>
                                        <tr class="fw-bold fst-italic" style="font-size: 1.25rem">
                                            <td></td>
                                            <td colspan="3" class="text-end">*Total Pembayaran</td>
                                            <td colspan="2" class="text-end">Rp {{ number_format($taxable_payment, 0, ',', '.') }}</td>
                                        </tr>
                                    </tfoot>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{-- footer --}}
                    <div class="mt-5 mb-5">
                        <div class="p-2" style="border-left: 10px solid #85bde8;">
                            <p class="fst-italic mb-0">NB:</p>
                            <p class="fst-italic text-muted fw-bold" style="font-size: 0.8rem">*Tarif event Sudah Termasuk Pajak PPN Sebesar 10%</p>
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
                                <p class="fw-bold">Event Organizer,</p>
                                <br><br>
                                <p class="fw-bold text-capitalize" style="font-size: 1rem">{{ $user->name }}</p>
                            </div>
                        </div>
                    </div>
                    <hr class="my-1">
                    <div class="row fst-italic text-muted" style="font-size: 0.6rem">
                        <div class="col-sm-6 text-start">
                            Halaman 1
                        </div>
                        <div class="col-sm-6 text-end">
                            Nota Dicetak Otomatis pada Hari {{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }} Pukul {{ Carbon\Carbon::now()->isoFormat('HH:mm:ss') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        {{-- page 2 --}}
        <div class="col-lg-12">
            <div class="card" id="print_receipt">
                <div class="card-body">
                    {{-- company title receipt --}}
                    <div class="invoice-title">
                        <div class="mb-2">
                            <img src="{{ URL::asset('/assets/img/mediakreasi-full.png') }}" class="navbar-brand-img" data-holder-rendered="true" height="auto" width="300px" />
                        </div>
                        <div class="text-muted">
                            <p class="mb-0">Cangkring RT 03 Mulyodadi Bambanglipuro</p>
                            <p class="mb-1">Bantul Yogyakarta 55764</p>
                            <p class="mb-1"> <i class="fa fa-phone"></i> 081904146417</p>
                        </div>
                    </div>
                    <hr class="my-2">
                    {{-- client title receipt --}}
                    <div class="col-md-12 text-center">
                        <p class="text-uppercase fw-bold h5">deskripsi event</p>
                        <p class="text-capitalize text-muted fst-italic">
                            code :
                            <span class="text-uppercase">
                                {{ $payment->payment_code }}
                            </span>
                        </p>
                    </div>
                    {{-- order sumary --}}
                    <div class="py-2 mt-2">
                        <div class="row">
                            {{-- col 1 --}}
                            <div class="col-sm-6" style="font-size: 0.8rem">
                                <div class="text-muted">
                                    <p class="h6 fw-bold mb-1">Tanggal Mulai</p>
                                    <p class="fst-italic text-capitalize mb-2" style="font-size: 1rem">
                                        {{ \Carbon\Carbon::parse($event->date_start)->isoFormat('dddd, D MMMM Y') }}
                                    </p>
                                    <p class="h6 fw-bold mb-1">Tanggal Selesai</p>
                                    <p class="fst-italic text-capitalize" style="font-size: 1rem">
                                        {{ \Carbon\Carbon::parse($event->date_end)->isoFormat('dddd, D MMMM Y') }}
                                    </p>
                                </div>
                            </div>
                            {{-- col 2 --}}
                            <div class="col-sm-6" style="font-size: 0.8rem">
                                <div class="text-muted text-sm-end">
                                    <p class="h6 fw-bold mb-1">Jumlah Crew</p>
                                    <p class="fst-italic text-capitalize mb-2" style="font-size: 1rem">{{ $jumlah_crew }} Orang</p>
                                    <p class="h6 fw-bold mb-1">Jumlah Alat</p>
                                    <p class="fst-italic text-capitalize" style="font-size: 1rem">{{ $jumlah_alat }} Unit</p>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            {{-- <p class="h6 fw-bold text-muted mb-1">Tanggal Mulai</p>
                            <p class="fst-italic text-capitalize text-muted mb-2" style="font-size: 1rem">
                                {{ \Carbon\Carbon::parse($event->date_start)->isoFormat('dddd, D MMMM Y') }}
                            </p>
                            <p class="h6 fw-bold text-muted mb-1">Tanggal Selesai</p>
                            <p class="fst-italic text-capitalize text-muted" style="font-size: 1rem">
                                {{ \Carbon\Carbon::parse($event->date_end)->isoFormat('dddd, D MMMM Y') }}
                            </p> --}}
                            <table class="table align-middle nowrap mb-0" style="font-size: 0.8rem">
                                <thead>
                                    <tr class="bg-light">
                                        {{-- <th class="text-center">No</th> --}}
                                        <th class="text-center" style="width: 20%">Nama Event</th>
                                        <th class="text-center" style="width: 20%">Note</th>
                                        <th class="text-center" style="width: 30%">Daftar Alat</th>
                                        <th class="text-center" style="width: 30%">Daftar Crew</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center text-capitalize" style="width: 20%">{{ $event->nama_event }}</td>
                                        <td class="text-center text-capitalize" style="width: 20%">{{ $event->note }}</td>
                                        <td class="text-center" style="width: 30%">
                                            @forelse($tool_event as $tool_events)
                                            <span class="text-muted fst-italic text-capitalize">
                                                {{ $tool_events->tools_name }} ,
                                            </span>
                                            @empty
                                            <p class="text-muted fst-italic">
                                                Daftar Alat Tidak Tersedia
                                            </p>
                                            @endforelse
                                        </td>
                                        <td class="text-center" style="width: 30%">
                                            @forelse($crew_event as $crew_events)
                                            <span class="text-muted fst-italic text-capitalize">
                                                {{ $crew_events->crews_name }} ,
                                            </span>
                                            @empty
                                            <p class="text-muted fst-italic">
                                                Daftar Alat Tidak Tersedia
                                            </p>
                                            @endforelse
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{-- footer --}}
                    <div class="mt-5 mb-5">
                        <div class="p-2" style="border-left: 10px solid #85bde8;">
                            <p class="fst-italic mb-0">NB:</p>
                            <p class="fst-italic text-muted fw-bold" style="font-size: 0.8rem">Crew bisa digantikan oleh orang lain pada situasi darurat</p>
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
                                <p class="fw-bold">Event Organizer,</p>
                                <br><br>
                                <p class="fw-bold text-capitalize" style="font-size: 1rem">{{ $user->name }}</p>
                            </div>
                        </div>
                    </div>
                    <hr class="my-1">
                    <div class="row fst-italic">
                    <div class="row fst-italic text-muted" style="font-size: 0.6rem">
                        <div class="col-sm-6 text-start">
                            Halaman 2
                        </div>
                        <div class="col-sm-6 text-end">
                            Nota Dicetak Otomatis pada Hari {{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }} Pukul {{ Carbon\Carbon::now()->isoFormat('HH:mm:ss') }}
                        </div>
                    </div>
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