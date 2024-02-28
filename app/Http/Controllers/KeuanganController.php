<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Crew_events;
use App\Models\Event;
use App\Models\Payment;
use App\Models\Tool;
use App\Models\Tool_events;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;

class KeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Event::where('status_event', '=', 'APPROVED')
                ->orwhere('status_event', '=', 'APPROVED EVENT')
                ->orWhere('status_event', '=', 'RETURNED')
                ->orWhere('status_event', '=', 'RETURNED EVENT')
                ->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('user_id', function (Event $event) {
                    $user = User::find($event->user_id);
                    return $user->name;
                })
                ->editColumn('tools_id', function (Event $event) {
                    $tool = Tool::find($event->tools_id);
                    return $tool->name;
                })
                ->editColumn('duration', function (Event $event) {
                    $date_start = new DateTime($event->date_start);
                    $date_end = new DateTime($event->date_end);
                    $diff = $date_start->diff($date_end);
                    $duration = $diff->days + 1;
                    return $duration;
                })
                ->editColumn('status_event', function (Event $event) {
                    return $event->status_event;
                })
                ->editColumn('event_price', function (Event $event) {
                    return number_format($event->event_price, 0, ',', '.');
                })
                ->addColumn('action', function (Event $event) {
                    $encryptID = Crypt::encrypt($event->id);
                    $btn =  '<a href=' . route("keuangan.bayar", $encryptID) . ' class="btn btn-primary btn-sm m-1" title="Bayar" data-toggle="tooltip" data-placement="top"><i class="fa fa-plus-square"></i> Bayar</a>';

                    return $btn;
                })
                ->rawColumns(['action', 'modal'])
                ->make(true);
        }

        return view('keuangan.index');
    }

    public function downpayment(Request $request)
    {
        if ($request->ajax()) {
            $data = Payment::where('payment_status', '=', 'DP')
                ->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('user_id', function (Payment $payment) {
                    $user = User::find($payment->user_id);
                    return $user->name;
                })
                ->editColumn('tools_id', function (Payment $payment) {
                    $tool = Tool::find($payment->tools_id);
                    return $tool->name;
                })
                ->editColumn('duration', function (Payment $payment) {
                    $event = Event::find($payment->events_id);
                    $date_start = new DateTime($event->date_start);
                    $date_end = new DateTime($event->date_end);
                    $diff = $date_start->diff($date_end);
                    $duration = $diff->days + 1;
                    return $duration;
                })
                ->editColumn('payment_status', function (Payment $payment) {
                    return $payment->payment_status;
                })
                ->editColumn('total_price', function (Payment $payment) {
                    return number_format(($payment->total_price) - ($payment->payment_amount), 0, ',', '.');
                })
                ->addColumn('action', function (Payment $payment) {
                    $encryptID = Crypt::encrypt($payment->id);
                    $btn =  '<a href=' . route("keuangan.pelunasan", $encryptID) . ' class="btn btn-primary btn-sm m-1" title="Pelunasan" data-toggle="tooltip" data-placement="top"><i class="fa fa-plus-square"></i> Bayar</a>';

                    return $btn;
                })
                ->rawColumns(['action', 'modal'])
                ->make(true);
        }

        return view('keuangan.downpayment');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $decryptID = Crypt::decrypt($id);
        $payment = Payment::find($decryptID);

        $user = User::find($payment->user_id);
        $alat = Tool::find($payment->tools_id);
        $event = Event::find($payment->events_id);

        $received_by = User::find($payment->received_by);

        $date_start = new DateTime($event->date_start);
        $date_end = new DateTime($event->date_end);
        $diff = $date_start->diff($date_end);
        $duration = $diff->days + 1;

        return view('keuangan.show', compact('payment', 'user', 'alat', 'event', 'duration', 'received_by'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        if ($payment->payment_proof) {
            Storage::delete($payment->payment_proof);
        }
        Payment::destroy($payment->id);

        Alert::toast('Data pembayaran Berhasil Dihapus', 'success');

        return redirect()->route('riwayat.pembayaran');
    }

    public function bayar(Request $request, Event $event, String $id)
    {
        $decryptID = Crypt::decrypt($id);

        $event = Event::find($decryptID);
        $alat = Tool::find($event->tools_id);
        $user = User::find($event->user_id);

        $toolEvents = Tool_events::where('events_id', '=', $event->id)
            ->latest()->paginate();
        $jumlahAlat = Tool_events::where('events_id', '=', $event->id)->count();

        $users = Crew_events::where('events_id', '=', $event->id)
            ->get();
        $jumlahCrew = Crew_events::where('events_id', '=', $event->id)->count();

        $date_start = new DateTime($event->date_start);
        $date_end = new DateTime($event->date_end);
        $diff = $date_start->diff($date_end);
        $duration = $diff->days + 1;

        return view('keuangan.bayar', compact('event', 'alat', 'user', 'duration', 'toolEvents', 'users', 'jumlahCrew', 'jumlahAlat'));
    }

    public function pelunasanAlat(Request $request, Event $event, Payment $payment, String $id)
    {
        $decryptID = Crypt::decrypt($id);

        $payment = Payment::find($decryptID);
        $event = Event::find($payment->events_id);
        $alat = Tool::find($payment->tools_id);
        $user = User::find($payment->user_id);
        //$payment = Payment::find($payment->events_id);

        $date_start = new DateTime($event->date_start);
        $date_end = new DateTime($event->date_end);
        $diff = $date_start->diff($date_end);
        $duration = $diff->days + 1;

        return view('keuangan.pelunasan', compact('event', 'alat', 'user', 'payment', 'duration'));
    }

    public function pelunasanAlat_store(Request $request, String $id)
    {
        $data = $request->validate([
            'user_id' => 'required',
            'tools_id' => 'required',
            'events_id' => 'required',
            'payment_method' => 'required',
            'payment_status' => 'required',
            'duration' => 'required',
            'total_price' => 'required',
            'payment_amount' => 'required',
            'payment_date' => 'required',
            'received_by' => 'required',
            'payment_code' => 'required',
            'payment_proof' => 'required|image'
        ]);

        $data['payment_amount'] = Str::replace('.', '', $request->payment_amount);

        if ($request->file('payment_proof')) {
            $data['payment_proof'] = $request->file('payment_proof')->store('payments');
        }

        $payment = Payment::find($id);
        $payment->payment_status = 'DP(LUNAS)';
        $payment->save();

        $event = Event::find($request->events_id);
        if ($event->status_event == 'DOWN PAYMENT' && $request->payment_status == 'PELUNASAN') {
            Payment::create($data);
            $event->status_event = 'PAID';
            $event->save();
        } elseif ($event->status_event == 'RETURNED' && $request->payment_status == 'PELUNASAN') {
            Payment::create($data);
            $event->status_event = 'DONE';
            $event->save();
        } elseif ($event->status_event == 'RETURNED EVENT' && $request->payment_status == 'PELUNASAN') {
            Payment::create($data);
            $event->status_event = 'DONE';
            $event->save();
        } else {
            Payment::create($data);
            $event->status_event = 'PAID';
            $event->save();
        }

        Alert::toast('Pelunasan Sewa Alat Berhasil Diproses', 'success');

        return redirect()->route('riwayat.pembayaran');
    }

    public function bayarAlat_store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required',
            'tools_id' => 'required',
            'events_id' => 'required',
            'payment_method' => 'required',
            'payment_status' => 'required',
            'duration' => 'required',
            'total_price' => 'required',
            'payment_amount' => 'required',
            'payment_date' => 'required',
            'received_by' => 'required',
            'payment_code' => 'required',
            'payment_proof' => 'required|image'
        ]);

        $data['payment_amount'] = Str::replace('.', '', $request->payment_amount);

        if ($request->file('payment_proof')) {
            $data['payment_proof'] = $request->file('payment_proof')->store('payments');
        }

        $event = Event::find($request->events_id);
        if ($event->status_event == 'RETURNED' && $request->payment_status == 'LUNAS') {
            Payment::create($data);
            $event->status_event = 'DONE';
            $event->save();
        } elseif ($event->status_event == 'RETURNED EVENT' && $request->payment_status == 'LUNAS') {
            Payment::create($data);
            $event->status_event = 'DONE';
            $event->save();
        } elseif ($event->status_event == 'RETURNED' && $request->payment_status == 'DP') {
            Payment::create($data);
            $event->status_event = 'DOWN PAYMENT';
            $event->save();
        } elseif ($event->status_event == 'RETURNED EVENT' && $request->payment_status == 'DP') {
            Payment::create($data);
            $event->status_event = 'DOWN PAYMENT';
            $event->save();
        } elseif ($event->status_event == 'APPROVED' && $request->payment_status == 'LUNAS') {
            Payment::create($data);
            $event->status_event = 'PAID';
            $event->save();
        } elseif ($event->status_event == 'APPROVED EVENT' && $request->payment_status == 'LUNAS') {
            Payment::create($data);
            $event->status_event = 'PAID';
            $event->save();
        } elseif ($event->status_event == 'APPROVED' && $request->payment_status == 'DP') {
            Payment::create($data);
            $event->status_event = 'DOWN PAYMENT';
            $event->save();
        } elseif ($event->status_event == 'APPROVED EVENT' && $request->payment_status == 'DP') {
            Payment::create($data);
            $event->status_event = 'DOWN PAYMENT';
            $event->save();
        } else {
            Payment::create($data);
            $event->status_event = 'PAID';
            $event->save();
        }

        Alert::toast('Pembayaran Sewa Alat Berhasil Diproses', 'success');

        return redirect()->route('riwayat.pembayaran');
    }

    public function history(Request $request)
    {
        //$payment = Payment::all();
        if ($request->ajax()) {
            $data = Payment::where('payment_status', '=', 'PELUNASAN')
                ->orWhere('payment_status', '=', 'DP(LUNAS)')
                ->orWhere('payment_status', '=', 'LUNAS')
                ->orWhere('payment_status', '=', 'DP')
                ->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('user_id', function (Payment $payment) {
                    $user = User::find($payment->user_id);
                    return $user->name;
                })
                ->editColumn('tools_id', function (Payment $payment) {
                    $tool = Tool::find($payment->tools_id);
                    return $tool->name;
                })
                ->editColumn('payment_amount', function (Payment $payment) {
                    return number_format($payment->payment_amount, 0, ',', '.');
                })
                ->editColumn('payment_method', function (Payment $payment) {
                    return $payment->payment_method;
                })
                ->editColumn('payment_status', function (Payment $payment) {
                    return $payment->payment_status;
                })
                ->editColumn('payment_date', function (Payment $payment) {
                    return Carbon::parse($payment->payment_date)->isoFormat('D MMMM Y');
                })
                ->addColumn('action', function (Payment $payment) {
                    $encryptID = Crypt::encrypt($payment->id);
                    if (auth()->user()->is_admin == '1') {
                        $btn = '<form class="d-inline m-1" action=' . route("keuangan.destroy", $payment->id) . ' method="POST">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value=' . csrf_token() . '>
                        <button class="btn btn-danger btn-sm btn-flat" type="submit" title="Hapus Pembayaran" data-toggle="tooltip" data-placement="top" onclick="deleteConfirm(event)"><i class="fas fa-trash"></i></button>
                        </form>';
                        $btn = $btn . '<a href=' . route("keuangan.show", $encryptID) . ' class="btn btn-info btn-sm m-1" title="Lihat Pembayaran" data-toggle="tooltip" data-placement="top"><i class="fas fa-eye"></i></a>';
                    } else {
                        $btn = '<a href=' . route("keuangan.show", $encryptID) . ' class="btn btn-info btn-sm m-1" title="Lihat Pembayaran" data-toggle="tooltip" data-placement="top"><i class="fas fa-eye"></i></a>';
                    }
                    return $btn;
                })
                ->rawColumns(['action', 'modal'])
                ->make(true);
        }
        return view('keuangan.history');
    }
}
