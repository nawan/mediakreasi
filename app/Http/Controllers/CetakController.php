<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Crew_events;
use App\Models\Event;
use App\Models\Payment;
use App\Models\Tool;
use App\Models\Tool_events;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\DataTables;

class CetakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
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
    public function destroy(string $id)
    {
        //
    }

    public function buktibayar(Request $request)
    {
        if ($request->ajax()) {
            $data = Payment::where('payment_status', '=', 'LUNAS')
                ->orWhere('payment_status', '=', 'PELUNASAN')
                ->orWhere('payment_status', '=', 'DP(LUNAS)')
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
                ->editColumn('events_id', function (Payment $payment) {
                    $event = Event::find($payment->events_id);
                    return $event->nama_event;
                })
                ->editColumn('payment_status', function (Payment $payment) {
                    return $payment->payment_status;
                })
                ->editColumn('payment_amount', function (Payment $payment) {
                    return number_format($payment->payment_amount, 0, '.', '.');
                })
                ->addColumn('action', function (Payment $payment) {
                    $encryptID = Crypt::encrypt($payment->id);
                    $event = Event::find($payment->events_id);
                    if ($event->nama_event == 'PERSONAL') {
                        $btn = '<a href=' . route("cetak.previewbuktibayaralat", $encryptID) . ' class="btn btn-primary btn-sm m-1" title="Cetak Bukti Bayar" data-toggle="tooltip" data-placement="top"><i class="fa fa-print"></i> Cetak</a>';
                    } else {
                        $btn = '<a href=' . route("cetak.previewbuktibayarevent", $encryptID) . ' class="btn btn-primary btn-sm m-1" title="Cetak Bukti Bayar" data-toggle="tooltip" data-placement="top"><i class="fa fa-print"></i> Cetak</a>';
                    }
                    return $btn;
                })
                ->rawColumns(['action', 'modal'])
                ->make(true);
        }
        return view('cetak.buktibayar');
    }

    public function prevBuktiBayarAlat(String $id)
    {
        $decryptID = Crypt::decrypt($id);
        $payment = Payment::find($decryptID);
        $tool = Tool::find($payment->tools_id);
        $user = User::find($payment->user_id);
        return view('cetak.cetakbuktibayaralat', compact('payment', 'tool', 'user'));
    }

    public function cetakBuktiBayarAlat(String $id)
    {
        $decryptID = Crypt::decrypt($id);
        $payment = Payment::find($decryptID);
        $tool = Tool::find($payment->tools_id);
        $user = User::find($payment->user_id);
        return view('cetak.printbuktibayaralat', compact('payment', 'tool', 'user'));
    }

    public function prevBuktiBayarEvent(String $id)
    {
        $decryptID = Crypt::decrypt($id);
        $payment = Payment::find($decryptID);
        $event = Event::find($payment->events_id);
        $tool_event = Tool_events::where('events_id', '=', $event->id)
            ->latest()->get();
        $crew_event = Crew_events::where('events_id', '=', $event->id)
            ->latest()->get();
        $jumlah_alat = Tool_events::where('events_id', '=', $event->id)
            ->count();
        $jumlah_crew = Crew_events::where('events_id', '=', $event->id)
            ->count();
        $tool = Tool::find($payment->tools_id);
        $user = User::find($payment->user_id);
        return view('cetak.cetakbuktibayarevent', compact('payment', 'event', 'tool', 'user', 'tool_event', 'crew_event', 'jumlah_alat', 'jumlah_crew'));
    }

    public function cetakBuktiBayarEvent(String $id)
    {
        $decryptID = Crypt::decrypt($id);
        $payment = Payment::find($decryptID);
        $event = Event::find($payment->events_id);
        $tool_event = Tool_events::where('events_id', '=', $event->id)
            ->latest()->get();
        $crew_event = Crew_events::where('events_id', '=', $event->id)
            ->latest()->get();
        $jumlah_alat = Tool_events::where('events_id', '=', $event->id)
            ->count();
        $jumlah_crew = Crew_events::where('events_id', '=', $event->id)
            ->count();
        $tool = Tool::find($payment->tools_id);
        $user = User::find($payment->user_id);
        return view('cetak.printbuktibayarevent', compact('payment', 'event', 'tool', 'user', 'tool_event', 'crew_event', 'jumlah_alat', 'jumlah_crew'));
    }

    public function suratjalan(Request $request)
    {
        if ($request->ajax()) {
            $data = Event::where('status_event', '=', 'APPROVED EVENT')
                ->orWhere('status_event', '=', 'APPROVED')
                ->orWhere('status_event', '=', 'PAID')
                ->orWhere('status_event', '=', 'DOWN PAYMENT')
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
                ->editColumn('nama_event', function (Event $event) {
                    return $event->nama_event;
                })
                ->editColumn('status_event', function (Event $event) {
                    return $event->status_event;
                })
                ->editColumn('duration', function (Event $event) {
                    $date_start = new DateTime($event->date_start);
                    $date_end = new DateTime($event->date_end);
                    $diff = $date_start->diff($date_end);
                    $duration = $diff->days + 1;
                    return $duration;
                })
                ->addColumn('action', function (Event $event) {
                    $encryptID = Crypt::encrypt($event->id);
                    if ($event->nama_event == 'PERSONAL') {
                        $btn = '<a href=' . route("cetak.previewsuratjalanalat", $encryptID) . ' class="btn btn-primary btn-sm m-1" title="Cetak Bukti Bayar" data-toggle="tooltip" data-placement="top"><i class="fa fa-print"></i> Cetak</a>';
                    } else {
                        $btn = '<a href=' . route("cetak.previewsuratjalanevent", $encryptID) . ' class="btn btn-primary btn-sm m-1" title="Cetak Bukti Bayar" data-toggle="tooltip" data-placement="top"><i class="fa fa-print"></i> Cetak</a>';
                    }
                    return $btn;
                })
                ->rawColumns(['action', 'modal'])
                ->make(true);
        }
        return view('cetak.suratjalan');
    }

    public function prevSuratJalanEvent(String $id)
    {
        $decryptID = Crypt::decrypt($id);
        $event = Event::find($decryptID);
        $tool = Tool::find($event->tools_id);
        $user = User::find($event->user_id);

        $date_start = new DateTime($event->date_start);
        $date_end = new DateTime($event->date_end);
        $diff = $date_start->diff($date_end);
        $duration = $diff->days + 1;

        $tool_event = Tool_events::where('events_id', '=', $event->id)
            ->latest()->get();
        $crew_event = Crew_events::where('events_id', '=', $event->id)
            ->latest()->get();
        $jumlah_alat = Tool_events::where('events_id', '=', $event->id)
            ->count();
        $jumlah_crew = Crew_events::where('events_id', '=', $event->id)
            ->count();

        return view('cetak.cetaksuratjalanevent', compact(
            'event',
            'tool',
            'user',
            'duration',
            'tool_event',
            'crew_event',
            'jumlah_alat',
            'jumlah_crew'
        ));
    }

    public function prevSuratJalanAlat(String $id)
    {
        $decryptID = Crypt::decrypt($id);
        $event = Event::find($decryptID);
        $tool = Tool::find($event->tools_id);
        $user = User::find($event->user_id);

        $date_start = new DateTime($event->date_start);
        $date_end = new DateTime($event->date_end);
        $diff = $date_start->diff($date_end);
        $duration = $diff->days + 1;

        return view('cetak.cetaksuratjalanalat', compact('event', 'tool', 'user', 'duration'));
    }

    public function cetakSuratJalanAlat(String $id)
    {
        $decryptID = Crypt::decrypt($id);
        $event = Event::find($decryptID);
        $tool = Tool::find($event->tools_id);
        $user = User::find($event->user_id);

        $date_start = new DateTime($event->date_start);
        $date_end = new DateTime($event->date_end);
        $diff = $date_start->diff($date_end);
        $duration = $diff->days + 1;

        return view('cetak.printsuratjalanalat', compact('event', 'tool', 'user', 'duration'));
    }

    public function cetakSuratJalanEvent(String $id)
    {
        $decryptID = Crypt::decrypt($id);
        $event = Event::find($decryptID);
        $tool = Tool::find($event->tools_id);
        $user = User::find($event->user_id);

        $date_start = new DateTime($event->date_start);
        $date_end = new DateTime($event->date_end);
        $diff = $date_start->diff($date_end);
        $duration = $diff->days + 1;

        $tool_event = Tool_events::where('events_id', '=', $event->id)
            ->latest()->get();
        $crew_event = Crew_events::where('events_id', '=', $event->id)
            ->latest()->get();
        $jumlah_alat = Tool_events::where('events_id', '=', $event->id)
            ->count();
        $jumlah_crew = Crew_events::where('events_id', '=', $event->id)
            ->count();

        return view('cetak.printsuratjalanevent', compact(
            'event',
            'tool',
            'user',
            'duration',
            'tool_event',
            'crew_event',
            'jumlah_alat',
            'jumlah_crew'
        ));
    }
}
