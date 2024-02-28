<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Payment;
use App\Models\Tool;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class LaporanController extends Controller
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

    public function alat(Request $request)
    {
        if ($request->ajax()) {
            $data = Tool::where('status_alat', '!=', 'EVENT')
                ->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('name', function (Tool $tool) {
                    return $tool->name;
                })
                ->editColumn('foto_alat', function (Tool $tool) {
                    return $tool->foto_alat;
                })
                ->editColumn('price', function (Tool $tool) {
                    return number_format($tool->price, 0, ',', '.');
                })
                ->editColumn('status_alat', function (Tool $tool) {
                    return $tool->status_alat;
                })
                ->editColumn('note', function (Tool $tool) {
                    return Str::limit(strip_tags($tool->note), 50);
                })
                ->editColumn('deskripsi', function (Tool $tool) {
                    return Str::limit(strip_tags($tool->deskripsi), 50);
                })
                ->make(true);
        }
        return view('laporan.alat');
    }

    public function client(Request $request)
    {
        if ($request->ajax()) {
            $data = user::where('is_admin', '=', '0')
                ->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('name', function (User $user) {
                    return $user->name;
                })
                ->editColumn('nik', function (User $user) {
                    return $user->nik;
                })
                ->editColumn('ktp', function (User $user) {
                    return $user->image;
                })
                ->editColumn('no_kontak', function (User $user) {
                    return $user->no_kontak;
                })
                ->editColumn('email', function (User $user) {
                    return $user->email;
                })
                ->editColumn('alamat', function (User $user) {
                    return $user->alamat;
                })
                ->editColumn('date_start', function (User $user) {
                    return Carbon::parse($user->date_start)->isoFormat('D MMMM Y');
                })
                ->make(true);
        }
        return view('laporan.client');
    }

    public function pembayaran(Request $request)
    {
        if ($request->ajax()) {
            $data = Payment::latest()
                ->get();
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
                ->editcolumn('payment_code', function (Payment $payment) {
                    return $payment->payment_code;
                })
                ->editcolumn('payment_amount', function (Payment $payment) {
                    return number_format($payment->payment_amount, 0, ',', '.');
                })
                ->editColumn('payment_proof', function (Payment $payment) {
                    return $payment->payment_proof;
                })
                ->editColumn('payment_status', function (Payment $payment) {
                    return $payment->payment_status;
                })
                ->editColumn('duration', function (Payment $payment) {
                    return $payment->duration;
                })
                ->editColumn('payment_date', function (Payment $payment) {
                    return Carbon::parse($payment->payment_date)->isoFormat('D MMMM Y');
                })
                ->editColumn('received_by', function (Payment $payment) {
                    $user = User::find($payment->received_by);
                    return $user->name;
                })
                ->make(true);
        }
        return view('laporan.pembayaran');
    }
}
