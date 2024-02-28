<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Tool;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class PenyewaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Event::where('status_event', '=', 'PENDING')
                ->orWhere('status_event', '=', 'CANCELED')
                ->latest()->get();
            // $data = Event::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('user_id', function (Event $event) {
                    $user = User::find($event->user_id);
                    return  $user->name;
                })
                ->editColumn('tool_id', function (Event $event) {
                    $tool = Tool::find($event->tools_id);
                    return Str::limit($tool->name, 10);
                    //return $tool->name;
                })
                ->editColumn('date_start', function (Event $event) {
                    return Carbon::parse($event->date_start)->isoFormat('D MMMM Y');
                })
                ->editColumn('date_end', function (Event $event) {
                    return Carbon::parse($event->date_end)->isoFormat('D MMMM Y');
                })
                ->editColumn('status_event', function (Event $event) {
                    return $event->status_event;
                })
                ->editColumn('event_price', function (Event $event) {
                    return number_format($event->event_price, 0, ',', '.');
                })
                ->addColumn('action', function (Event $event) {
                    $encryptID = Crypt::encrypt($event->id);
                    if (auth()->user()->is_admin == '1') {
                        if ($event->status_event == 'APPROVED') {
                            $btn = '<a href=' . route("penyewaan.edit", $encryptID) . ' class="edit btn btn-warning btn-sm m-1" title="Edit Penyewaan" data-toggle="tooltip" data-placement="top"><i class="fas fa-edit"></i></a>';
                            $btn = $btn . '<a href=' . route("penyewaan.show", $encryptID) . ' class="btn btn-info btn-sm m-1" title="Lihat Penyewaan" data-toggle="tooltip" data-placement="top"><i class="fas fa-eye"></i></a>';
                            $btn = $btn . '<form class="d-inline m-1" title="Cancel Penyewaan" data-toggle="tooltip" data-placement="top" action=' . route("penyewaan.cancel", $event->id) . ' method="POST">
                            <input type="hidden" name="_token" value=' . csrf_token() . '>
                            <input type="hidden" name="status_event" value="CANCELED">
                            <button class="btn btn-outline-danger btn-sm" type="submit"><i class="far fa-times-circle"></i></button>
                            </form>';
                        } else {
                            $btn = '<a href=' . route("penyewaan.edit", $encryptID) . ' class="edit btn btn-warning btn-sm m-1" title="Edit Penyewaan" data-toggle="tooltip" data-placement="top"><i class="fas fa-edit"></i></a>';
                            $btn = $btn . '<a href=' . route("penyewaan.show", $encryptID) . ' class="btn btn-info btn-sm m-1" title="Lihat Penyewaan" data-toggle="tooltip" data-placement="top"><i class="fas fa-eye"></i></a>';
                            // $btn = $btn . '<form class="d-inline m-1" action=' . route("penyewaan.approve", $event->id) . ' method="POST">
                            // <input type="hidden" name="_token" value=' . csrf_token() . '>
                            // <input type="hidden" name="status_event" value="APPROVED">
                            // <button class="btn btn-outline-success btn-sm" title="Approve Penyewaan" data-toggle="tooltip" data-placement="top" type="submit"><i class="far fa-check-circle"></i></button>
                            // </form>';
                            $btn = $btn . '<button type="button" data-id="' . $event->id . '" id="' . $event->id . '" class="btn btn-success approveSewa"
                            data-price="' . $event->event_price . '" 
                            data-toggle="modal" data-target="#my_modal">
                            <i class="far fa-check-circle"></i></button>';
                            $btn = $btn . '<form class="d-inline m-1" title="Cancel Penyewaan" data-toggle="tooltip" data-placement="top" action=' . route("penyewaan.cancel", $event->id) . ' method="POST">
                            <input type="hidden" name="_token" value=' . csrf_token() . '>
                            <input type="hidden" name="status_event" value="CANCELED">
                            <button class="btn btn-outline-danger btn-sm" type="submit"><i class="far fa-times-circle"></i></button>
                            </form>';
                        }
                    } else {
                        if ($event->status_event == 'APPROVED') {
                            $btn = '<a href=' . route("penyewaan.edit", $encryptID) . ' class="edit btn btn-warning btn-sm m-1" title="Edit Penyewaan" data-toggle="tooltip" data-placement="top"><i class="fas fa-edit"></i></a>';
                            $btn = $btn . '<a href=' . route("penyewaan.show", $encryptID) . ' class="btn btn-info btn-sm m-1" title="Lihat Penyewaan" data-toggle="tooltip" data-placement="top"><i class="fas fa-eye"></i></a>';
                            $btn = $btn . '<form class="d-inline m-1" title="Cancel Penyewaan" data-toggle="tooltip" data-placement="top" action=' . route("penyewaan.cancel", $event->id) . ' method="POST">
                            <input type="hidden" name="_token" value=' . csrf_token() . '>
                            <input type="hidden" name="status_event" value="CANCELED">
                            <button class="btn btn-outline-danger btn-sm" type="submit"><i class="far fa-times-circle"></i></button>
                            </form>';
                        } else {
                            $btn = '<a href=' . route("penyewaan.edit", $encryptID) . ' class="edit btn btn-warning btn-sm m-1" title="Edit Penyewaan" data-toggle="tooltip" data-placement="top"><i class="fas fa-edit"></i></a>';
                            $btn = $btn . '<form class="d-inline m-1" title="Cancel Penyewaan" data-toggle="tooltip" data-placement="top" action=' . route("penyewaan.cancel", $event->id) . ' method="POST">
                            <input type="hidden" name="_token" value=' . csrf_token() . '>
                            <input type="hidden" name="status_event" value="CANCELED">
                            <button class="btn btn-outline-danger btn-sm" type="submit"><i class="far fa-times-circle"></i></button>
                            </form>';
                        }
                    }
                    return $btn;
                })
                ->rawColumns(['action', 'modal'])
                ->make(true);
        }
        return view('penyewaan.index');
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
        $event = Event::find($decryptID);
        $user = User::find($event->user_id);
        $alat = Tool::find($event->tools_id);

        return view('penyewaan.show', compact('event', 'user', 'alat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $decryptID = Crypt::decrypt($id);
        $event = Event::find($decryptID);
        $user = User::find($event->user_id);
        $alat = Tool::find($event->tools_id);

        return view('penyewaan.edit', compact('event', 'user', 'alat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update_penyewaan(Request $request, Event $event)
    {
        $data = $request->validate([
            'date_start' => 'required',
            'date_end' => 'required',
            'note' => 'required',
        ]);

        $tool = Tool::find($request->tools_id);
        $date_start = new DateTime($request->date_start);
        $date_end = new DateTime($request->date_end);
        $duration = $date_start->diff($date_end);
        $data['event_price'] = $tool->price * ($duration->days + 1);

        $event->update($data);

        Alert::toast('Data Sewa Berhasil Diperbarui', 'success');

        return redirect()->route('penyewaan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function approve(Request $request)
    {
        $event = Event::find($request->id);
        $tool = Tool::find($event->tools_id);
        if ($tool->jml_stok == 1) {
            $event->status_event = 'APPROVED';
            $event->event_price = $request->harga_alat;
            if ($request->note == '') {
                $event->note = $event->note;
            } else {
                $event->note = $request->note;
            }
            $event->save();

            $tool->jml_stok = 0;
            $tool->status_alat = "TERPAKAI";
            $tool->save();

            Alert::toast('Approval Sewa Alat Berhasil Diproses', 'success');
        } else {
            Alert::toast('Gagal Sewa Karena Alat Telah Digunakan', 'error');
        }

        return redirect()->route('penyewaan.index');
    }

    public function cancel(Request $request, Event $event)
    {
        $event->update([
            'status_event' => $request->status_event
        ]);

        $tool = Tool::find($event->tools_id);
        $tool->jml_stok = 1;
        $tool->status_alat = "READY";
        $tool->save();

        Alert::toast('Pembatalan Sewa Alat Telah Diproses', 'error');

        return redirect()->route('penyewaan.index');
    }
}
