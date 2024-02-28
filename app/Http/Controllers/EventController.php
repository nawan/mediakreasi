<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Crew_events;
use App\Models\Event;
use App\Models\Tool;
use App\Models\Tool_events;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Event::where([
                ['nama_event', '!=', 'PERSONAL'],
                ['status_event', '=', 'PENDING EVENT']
            ])
                ->orWhere([
                    ['nama_event', '!=', 'PERSONAL'],
                    ['status_event', '=', 'CANCELED EVENT']
                ])
                ->latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('user_id', function (Event $event) {
                    $user = User::find($event->user_id);
                    return $user->name;
                })
                ->editColumn('nama_event', function (Event $event) {
                    return $event->nama_event;
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
                ->addColumn('action', function (Event $event) {
                    $encryptID = Crypt::encrypt($event->id);
                    if (auth()->user()->is_admin == '1') {
                        if ($event->daftar_alat == 'EMPTY' && $event->daftar_crew == 'EMPTY') {
                            $btn = '<a href=' . route("event.alat", $encryptID) . ' class="edit btn btn-primary btn-sm m-1" title="Tambah Alat" data-toggle="tooltip" data-placement="top"><i class="fa fa-plus-square"></i> Alat</a>';
                            $btn = $btn . '<a href=' . route("event.crew", $encryptID) . ' class="edit btn btn-primary btn-sm m-1" title="Tambah Crew" data-toggle="tooltip" data-placement="top"><i class="fa fa-plus-square"></i> Crew</a>';
                            return $btn;
                        } else if ($event->status_event == 'APPROVED EVENT' && $event->daftar_alat == 'EMPTY') {
                            $btn = '<a href=' . route("event.show", $encryptID) . ' class="btn btn-info btn-sm m-1" title="Lihat Event" data-toggle="tooltip" data-placement="top"><i class="fas fa-eye"></i></a>';
                            $btn = $btn . '<a href=' . route("event.konfirmbatal", $encryptID) . ' class="btn btn-outline-danger m-1" title="Event Batal" data-toggle="tooltip" data-placement="top"><i class="far fa-times-circle"></i></a>';
                            return $btn;
                        } else if ($event->status_event == 'APPROVED EVENT') {
                            $btn = '<a href=' . route("event.show", $encryptID) . ' class="btn btn-info btn-sm m-1" title="Lihat Event" data-toggle="tooltip" data-placement="top"><i class="fas fa-eye"></i></a>';
                            $btn = $btn . '<a href=' . route("event.konfirmbatal", $encryptID) . ' class="btn btn-outline-danger m-1" title="Event Batal" data-toggle="tooltip" data-placement="top"><i class="far fa-times-circle"></i></a>';
                            return $btn;
                        } else if ($event->status_event == 'CANCELED EVENT') {
                            $btn = '<form class="d-inline m-1" action=' . route("event.hapus", $event->id) . ' method="POST">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value=' . csrf_token() . '>
                            <button class="btn btn-danger btn-sm btn-flat" type="submit" title="Hapus Data Event" data-toggle="tooltip" data-placement="top" onclick="deleteConfirm(event)"><i class="fas fa-trash"></i></button>
                            </form>';
                            $btn = $btn . '<a href=' . route("event.show", $encryptID) . ' class="btn btn-info btn-sm m-1" title="Lihat Event" data-toggle="tooltip" data-placement="top"><i class="fas fa-eye"></i></a>';
                            return $btn;
                        } else if ($event->daftar_alat == 'EMPTY') {
                            $btn = '<a href=' . route("event.alat", $encryptID) . ' class="edit btn btn-primary btn-sm m-1" title="Tambah Alat" data-toggle="tooltip" data-placement="top"><i class="fa fa-plus-square"></i> Alat</a>';
                            return $btn;
                        } else if ($event->daftar_crew == 'EMPTY') {
                            $btn = '<a href=' . route("event.crew", $encryptID) . ' class="edit btn btn-primary btn-sm m-1" title="Tambah Crew" data-toggle="tooltip" data-placement="top"><i class="fa fa-plus-square"></i> Crew</a>';
                            return $btn;
                        } else {
                            $btn = '<a href=' . route("event.show", $encryptID) . ' class="btn btn-info m-1" title="Lihat Event" data-toggle="tooltip" data-placement="top"><i class="fas fa-eye"></i></a>';
                            $btn = $btn . '<button type="button" data-id="' . $event->id . '" id="' . $event->id . '" class="btn btn-success updateEvent"
                                data-price="' . $event->event_price . '" 
                                data-crew="0"
                                data-note="' . $event->note . '"
                                data-toggle="modal" data-target="#my_modal">
                                <i class="far fa-check-circle"></i></button>';
                            $btn = $btn . '<a href=' . route("event.konfirmbatal", $encryptID) . ' class="btn btn-outline-danger m-1" title="Event Batal" data-toggle="tooltip" data-placement="top"><i class="far fa-times-circle"></i></a>';
                            return $btn;
                        }
                    } else {
                        if ($event->daftar_alat == 'EMPTY' && $event->daftar_crew == 'EMPTY') {
                            $btn = '<a href=' . route("event.alat", $encryptID) . ' class="edit btn btn-primary btn-sm m-1" title="Tambah Alat" data-toggle="tooltip" data-placement="top"><i class="fa fa-plus-square"></i> Alat</a>';
                            $btn = $btn . '<a href=' . route("event.crew", $encryptID) . ' class="edit btn btn-primary btn-sm m-1" title="Tambah Crew" data-toggle="tooltip" data-placement="top"><i class="fa fa-plus-square"></i> Crew</a>';
                            return $btn;
                        } else if ($event->status_event == 'APPROVED EVENT' && $event->daftar_alat == 'EMPTY') {
                            $btn = '<a href=' . route("event.show", $encryptID) . ' class="btn btn-info btn-sm m-1" title="Lihat Event" data-toggle="tooltip" data-placement="top"><i class="fas fa-eye"></i></a>';
                            $btn = $btn . '<a href=' . route("event.konfirmbatal", $encryptID) . ' class="btn btn-outline-danger m-1" title="Event Batal" data-toggle="tooltip" data-placement="top"><i class="far fa-times-circle"></i></a>';
                            return $btn;
                        } else if ($event->status_event == 'APPROVED EVENT') {
                            $btn = '<a href=' . route("event.show", $encryptID) . ' class="btn btn-info btn-sm m-1" title="Lihat Event" data-toggle="tooltip" data-placement="top"><i class="fas fa-eye"></i></a>';
                            $btn = $btn . '<a href=' . route("event.konfirmbatal", $encryptID) . ' class="btn btn-outline-danger m-1" title="Event Batal" data-toggle="tooltip" data-placement="top"><i class="far fa-times-circle"></i></a>';
                            return $btn;
                        } else if ($event->status_event == 'CANCELED EVENT') {
                            $btn = '<form class="d-inline m-1" action=' . route("event.hapus", $event->id) . ' method="POST">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value=' . csrf_token() . '>
                            <button class="btn btn-danger btn-sm btn-flat" type="submit" title="Hapus Data Event" data-toggle="tooltip" data-placement="top" onclick="deleteConfirm(event)"><i class="fas fa-trash"></i></button>
                            </form>';
                            $btn = $btn . '<a href=' . route("event.show", $encryptID) . ' class="btn btn-info btn-sm m-1" title="Lihat Event" data-toggle="tooltip" data-placement="top"><i class="fas fa-eye"></i></a>';
                            return $btn;
                        } else if ($event->daftar_alat == 'EMPTY') {
                            $btn = '<a href=' . route("event.alat", $encryptID) . ' class="edit btn btn-primary btn-sm m-1" title="Tambah Alat" data-toggle="tooltip" data-placement="top"><i class="fa fa-plus-square"></i> Alat</a>';
                            return $btn;
                        } else if ($event->daftar_crew == 'EMPTY') {
                            $btn = '<a href=' . route("event.crew", $encryptID) . ' class="edit btn btn-primary btn-sm m-1" title="Tambah Crew" data-toggle="tooltip" data-placement="top"><i class="fa fa-plus-square"></i> Crew</a>';
                            return $btn;
                        } else {
                            $btn = '<a href=' . route("event.show", $encryptID) . ' class="btn btn-info m-1" title="Lihat Event" data-toggle="tooltip" data-placement="top"><i class="fas fa-eye"></i></a>';
                            $btn = $btn . '<a href=' . route("event.konfirmbatal", $encryptID) . ' class="btn btn-outline-danger m-1" title="Event Batal" data-toggle="tooltip" data-placement="top"><i class="far fa-times-circle"></i></a>';
                            return $btn;
                        }
                    }
                })
                ->rawColumns(['action', 'modal', 'tambahAlat', 'tambahCrew'])
                ->make(true);
        }
        return view('event.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::where('is_admin', '=', '0')
            ->latest()->get();

        $cat_event = Tool::where('status_alat', '=', 'EVENT')
            ->latest()->get();

        return view('event.create', compact('user', 'cat_event'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_event' => 'required',
            'user_id' => 'required',
            'tools_id' => 'required',
            'date_start' => 'required',
            'date_end' => 'required',
            'note' => 'required',
        ]);

        $data['daftar_alat'] = 'EMPTY';
        $data['daftar_crew'] = 'EMPTY';
        $data['event_price'] = 0;
        $data['status_event'] = 'PENDING EVENT';

        $id = Event::create($data)->id;

        $encryptID = Crypt::encrypt($id);

        Alert::toast('Event Berhasil Dibuat, Selanjutnya Silahkan Tambahkan Data Alat dan Crew', 'success');

        //return redirect()->route('event.index');
        return redirect()->route('event.show', $encryptID);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $decryptID = Crypt::decrypt($id);
        $event = Event::find($decryptID);
        $user = User::find($event->user_id);
        $toolEvents = Tool_events::where('events_id', '=', $event->id)
            ->latest()->paginate();
        $crewEvents = Crew_events::where('events_id', '=', $event->id)
            ->latest()
            ->paginate();

        return view('event.show', compact('event', 'user', 'toolEvents', 'crewEvents'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $decryptID = Crypt::decrypt($id);
        $event = Event::find($decryptID);
        $user = User::where('is_admin', '=', '0')
            ->orWhere('id', '=', $event->user_id)
            ->latest()->get();

        $cat_event = Tool::where('status_alat', '=', 'EVENT')
            ->orWhere('id', '=', $event->tools_id)
            ->latest()->get();

        return view('event.edit', compact('event', 'user', 'cat_event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $data = $request->validate([
            'nama_event' => 'required',
            'date_start' => 'required',
            'date_end' => 'required',
            'note' => 'required',
        ]);

        $date_start = new DateTime($request->date_start);
        $date_end = new DateTime($request->date_end);
        $duration = $date_start->diff($date_end);

        $toolEvents = Tool_events::where('events_id', '=', $event->id)
            ->latest()->get();

        $total = $toolEvents->sum('price');

        $data['event_price'] = $total * ($duration->days + 1);

        $event->update($data);
        $encryptID = Crypt::encrypt($event->id);

        Alert::toast('Data Event Berhasil Diperbarui', 'success');
        return redirect()->route('event.show', $encryptID);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Event::destroy($id);
        Alert::toast('Data Event Telah Dihapus', 'success');
        return redirect()->route('event.index');
    }

    public function eventAlat(Request $request, Tool $tool, String $id)
    {
        $decryptID = Crypt::decrypt($id);
        $event = Event::find($decryptID);

        $tools = Tool::where('status_alat', '=', 'READY')
            ->latest()
            ->paginate();

        $toolEvents = Tool_events::where('events_id', '=', $decryptID)
            ->latest()
            ->paginate();

        $total = $toolEvents->sum('price');
        $jumlah = Tool_events::where('events_id', '=', $decryptID)->count();

        return view('event.tools', compact('event', 'tools', 'toolEvents', 'total', 'jumlah'));
    }

    public function eventCrew(Request $request, User $user, String $id)
    {
        $decryptID = Crypt::decrypt($id);
        $event = Event::find($decryptID);

        $users = user::where('is_admin', '=', '4')
            ->get();

        $crewEvents = Crew_events::where('events_id', '=', $decryptID)
            ->latest()->paginate(10);

        $jumlahCrew = Crew_events::where('events_id', '=', $decryptID)->count();
        // $statusCrew = Crew_events::where('events_id', '=', $decryptID);
        // $crewID = $statusCrew->user_id;


        return view('event.crews', compact('event', 'users', 'crewEvents', 'jumlahCrew'));
    }

    public function tambahAlat(Request $request, $event_id, $alat_id)
    {

        $tool = Tool::find($alat_id);
        if ($tool->jml_stok == 1) {
            $tool->jml_stok = 0;
            $tool->status_alat = "TERPAKAI";
            $tool->save();

            $data['events_id'] = $event_id;
            $data['tools_id'] = $alat_id;
            $data['tools_name'] = $tool->name;
            $data['price'] = $tool->price;

            Tool_events::create($data);

            Alert::toast('Data Alat Berhasil Ditambahkan', 'success');
        } else {
            Alert::toast('Gagal, Data Alat Telah Terpakai', 'error');
        }

        $encryptID = Crypt::encrypt($event_id);

        return redirect()->route('event.alat', $encryptID);
    }

    public function tambahCrew(Request $request, $event_id, $crew_id)
    {
        $crew = User::find($crew_id);

        $data['events_id'] = $event_id;
        $data['user_id'] = $crew_id;
        $data['crews_name'] = $crew->name;
        $data['no_kontak'] = $crew->no_kontak;

        Crew_events::create($data);

        $encryptID = Crypt::encrypt($event_id);

        Alert::toast('Data Crew Berhasil Ditambahkan', 'success');

        return redirect()->route('event.crew', $encryptID);
    }

    public function eventBerjalan(Request $request)
    {
        if ($request->ajax()) {
            $data = Event::where([
                ['nama_event', '!=', 'PERSONAL'],
                ['status_event', '=', 'DOWN PAYMENT']
            ])
                ->orWhere([
                    ['nama_event', '!=', 'PERSONAL'],
                    ['status_event', '=', 'PAID']
                ])
                ->orWhere([
                    ['nama_event', '!=', 'PERSONAL'],
                    ['status_event', '=', 'APPROVED EVENT']
                ])
                ->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('event_name', function (Event $event) {
                    return $event->nama_event;
                })
                ->editColumn('user_id', function (Event $event) {
                    $user = User::find($event->user_id);
                    return $user->name;
                })
                ->editColumn('image', function (Event $event) {
                    $user = User::find($event->user_id);
                    return $user->image;
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
                ->addColumn('action', function (Event $event) {
                    $encryptID = Crypt::encrypt($event->id);
                    $btn = '<a href=' . route("event.show", $encryptID) . ' class="btn btn-info m-1" title="View Daftar Alat" data-toggle="tooltip" data-placement="top"><i class="fas fa-eye"></i></a>';
                    $btn = $btn . '<a href=' . route("event.konfirmasi", $encryptID) . ' class="btn btn-primary m-1" title="Event Selesai" data-toggle="tooltip" data-placement="top"><i class="far fa-check-circle"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action', 'modal'])
                ->make(true);
        }

        return view('event.event');
    }

    public function eventRiwayat(Request $request)
    {
        if ($request->ajax()) {
            $data = Event::where([
                ['nama_event', '!=', 'PERSONAL'],
                ['status_event', '=', 'DONE']
            ])
                ->orWhere([
                    ['nama_event', '!=', 'PERSONAL'],
                    ['status_event', '=', 'RETURNED EVENT']
                ])
                ->latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('user_id', function (Event $event) {
                    $user = User::find($event->user_id);
                    return $user->name;
                })
                ->editColumn('nama_event', function (Event $event) {
                    return $event->nama_event;
                })
                ->editColumn('date_start', function (Event $event) {
                    return Carbon::parse($event->date_start)->isoFormat('D MMMM Y');
                })
                ->editColumn('date_end', function (Event $event) {
                    return Carbon::parse($event->date_end)->isoFormat('D MMMM Y');
                })
                ->editColumn('event_price', function (Event $event) {
                    return number_format($event->event_price, 0, ',', '.');
                })
                ->addColumn('action', function (Event $event) {
                    $encryptID = Crypt::encrypt($event->id);

                    if (auth()->user()->is_admin == '1') {
                        $btn = '<form class="d-inline m-1" action=' . route("event.hapusRiwayat", $event->id) . ' method="POST">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value=' . csrf_token() . '>
                        <button class="btn btn-danger btn-sm btn-flat" type="submit" title="Hapus Riwayat" data-toggle="tooltip" data-placement="top" onclick="deleteConfirm(event)"><i class="fas fa-trash"></i></button>
                        </form>';
                        $btn = $btn . '<a href=' . route("event.show", $encryptID) . ' class="btn btn-info btn-sm m-1" title="Lihat Event" data-toggle="tooltip" data-placement="top"><i class="fas fa-eye"></i></a>';
                    } else {
                        $btn = '<a href=' . route("penyewaan.show", $encryptID) . ' class="btn btn-info btn-sm m-1" title="Lihat Transaksi" data-toggle="tooltip" data-placement="top"><i class="fas fa-eye"></i></a>';
                    }
                    return $btn;
                })
                ->rawColumns(['action', 'modal'])
                ->make(true);
        }
        return view('event.record');
    }

    public function submitTambahAlat(String $event_id, Request $request)
    {
        $decryptID = Crypt::decrypt($event_id);
        $event = Event::find($decryptID);
        $date_start = new DateTime($event->date_start);
        $date_end = new DateTime($event->date_end);
        $duration = $date_start->diff($date_end);
        $event->update([
            'daftar_alat' => $request->daftar_alat,
            'event_price' => $request->total * ($duration->days + 1)
        ]);

        Alert::toast('Daftar Cart Alat Berhasil Ditambahkan', 'success');

        return redirect()->route('event.show', $event_id);
    }

    public function submitTambahCrew(String $event_id)
    {
        $decryptID = Crypt::decrypt($event_id);
        $event = Event::find($decryptID);
        $event->daftar_crew = "FILLED";
        $event->save();

        Alert::toast('Daftar Cart Crew Berhasil Ditambahkan', 'success');

        return redirect()->route('event.show', $event_id);
    }

    public function deleteTambahAlat($event_id, $toolEvents_id)
    {
        $alat = Tool_events::find($toolEvents_id);
        $alat_id = $alat->tools_id;

        $tools = Tool::find($alat_id);
        $tools->status_alat = "READY";
        $tools->jml_stok = "1";
        $tools->save();

        Tool_events::destroy($toolEvents_id);

        $encryptID = Crypt::encrypt($event_id);

        Alert::toast('Daftar Cart Alat Berhasil Dihapus', 'success');

        return redirect()->route('event.alat', $encryptID);
    }

    public function deleteTambahCrew($event_id, $crewEvents_id)
    {
        Crew_events::destroy($crewEvents_id);

        $encryptID = Crypt::encrypt($event_id);

        Alert::toast('Daftar Cart Crew Berhasil Dihapus', 'success');

        return redirect()->route('event.crew', $encryptID);
    }

    public function konfirmasiApprove(String $id)
    {
        return view('event.approve');
    }

    public function approved(Request $request)
    {
        $event = Event::find($request->eventid);
        $harga_event = $request->harga_event;
        $harga_crew = $request->harga_crew;
        $total = $harga_event + $harga_crew;
        $event->status_event = 'APPROVED EVENT';
        $event->event_price = $total;
        if ($request->note == '') {
            $event->note = $event->note;
        } else {
            $event->note = $request->note;
        }
        $event->save();

        Alert::toast('Event Telah Disetujui !', 'success');
        return redirect()->route('event.index');
    }

    public function canceled(String $id, Request $request)
    {
        $decryptID = Crypt::decrypt($id);
        $event = Event::find($decryptID);
        $event->update([
            'status_event' => 'CANCELED EVENT'
        ]);

        foreach ($alat_id = $request->tools_id as $key => $value) {
            if ($alat_id[$key] != '') {

                Tool::where('id', $alat_id[$key])
                    ->update(
                        [
                            'id' => $value,
                            'status_alat' => "READY",
                            'jml_stok' => 1,
                        ]
                    );
            }
        }

        Alert::toast('Event Telah Dibatalkan', 'success');
        return redirect()->route('event.index');
    }

    public function konfirmasiBatal(String $id)
    {
        $decryptID = Crypt::decrypt($id);
        $event = Event::find($decryptID);
        $user = User::find($event->user_id);
        $toolEvents = Tool_events::where('events_id', '=', $event->id)
            ->get();
        $crewEvents = Crew_events::where('events_id', '=', $event->id)
            ->get();

        $total = $toolEvents->sum('price');

        return view('event.batal', compact('event', 'user', 'toolEvents', 'crewEvents', 'total'));
    }

    public function konfirmasiSelesai(String $id)
    {
        $decryptID = Crypt::decrypt($id);
        $event = Event::find($decryptID);
        $user = User::find($event->user_id);
        $toolEvents = Tool_events::where('events_id', '=', $event->id)
            ->get();

        $total = $toolEvents->sum('price');

        return view('event.konfirmasi', compact('event', 'user', 'toolEvents', 'total'));
    }

    public function eventSelesai(String $id, Request $request)
    {
        $decryptID = Crypt::decrypt($id);
        $event = Event::find($decryptID);

        if ($event->status_event == 'PAID') {
            $event->update([
                'status_event' => 'DONE'
            ]);
        } else {
            $event->update([
                'status_event' => 'RETURNED EVENT'
            ]);
        }


        foreach ($alat_id = $request->tools_id as $key => $value) {
            if ($alat_id[$key] != '') {

                Tool::where('id', $alat_id[$key])
                    ->update(
                        [
                            'id' => $value,
                            'status_alat' => "READY",
                            'jml_stok' => 1,
                        ]
                    );
            }
        }

        Alert::toast('Event selesai dan alat kembali ke gudang', 'success');
        return redirect()->route('event.riwayat');
    }

    public function deleteRiwayat($id)
    {
        Event::destroy($id);
        Alert::toast('Data Riwayat Event Telah Dihapus', 'success');
        return redirect()->route('event.riwayat');
    }

    public function hapusEvent($id)
    {
        Event::destroy($id);
        Alert::toast('Data Event Telah Dihapus', 'success');
        return redirect()->route('event.index');
    }
}
