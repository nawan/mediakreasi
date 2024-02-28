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
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class AlatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
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
                ->addColumn('action', function (Tool $tool) {
                    $encryptID = Crypt::encrypt($tool->id);

                    $btn = '<form class="d-inline m-1" action=' . route("alat.destroy", $tool->id) . ' method="POST">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value=' . csrf_token() . '>
                    <button class="btn btn-danger btn-sm btn-flat" type="submit" title="Hapus Data Alat" data-toggle="tooltip" data-placement="top" onclick="deleteConfirm(event)"><i class="fas fa-trash"></i></button>
                    </form>';
                    $btn = $btn . '<a href=' . route("alat.edit", $encryptID) . ' class="edit btn btn-warning btn-sm m-1" title="Edit Data Alat" data-toggle="tooltip" data-placement="top"><i class="fas fa-edit"></i></a>';
                    $btn = $btn . '<a href=' . route("alat.show", $encryptID) . ' class="btn btn-info btn-sm m-1" title="View Data Alat" data-toggle="tooltip" data-placement="top"><i class="fas fa-eye"></i></a>';

                    return $btn;
                })
                ->rawColumns(['action', 'modal'])
                ->make(true);
        }
        return view('alat.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('alat.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'status_alat' => 'required',
            'price' => 'required',
            'foto_alat' => 'required|image',
            'note' => 'required',
            'deskripsi' => 'required',
        ]);

        $timestamp = Carbon::now()->timestamp;
        $ref_id = Str::random(5);
        $random_number = Str::random(8);
        $combine = $timestamp . $ref_id . $random_number;
        $unique_code = uniqid($combine);

        $data['jml_stok'] = 1;
        $data['kode_alat'] = $unique_code;
        $data['price'] = Str::replace('.', '', $request->price);
        if ($request->file('foto_alat')) {
            $data['foto_alat'] = $request->file('foto_alat')->store('alat');
        }

        Tool::create($data);

        Alert::toast('Data Alat Berhasil Ditambahkan', 'success');

        return redirect()->route('alat.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $decryptID = Crypt::decrypt($id);
        $alat = Tool::find($decryptID);

        return view('alat.show', compact('alat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $decryptID = Crypt::decrypt($id);
        $alat = Tool::find($decryptID);

        return view('alat.edit', compact('alat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tool $alat)
    {
        $data = $request->validate([
            'name' => 'required',
            'status_alat' => 'required',
            'jml_stok' => 'required',
            'note' => 'required',
            'deskripsi' => 'required'
        ]);

        $data['price'] = Str::replace('.', '', $request->price);
        if ($request->file('foto_alat')) {
            if ($request->oldFoto_alat) {
                Storage::delete($request->oldFoto_alat);
            }
            $data['foto_alat'] = $request->file('foto_alat')->store('alat');
        }

        $alat->update($data);

        Alert::toast('Data Alat Berhasil Diperbarui', 'success');

        return redirect()->route('alat.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tool $alat)
    {
        if ($alat->foto_alat) {
            Storage::delete($alat->foto_alat);
        }

        Tool::destroy($alat->id);
        return redirect()->route('alat.index');
    }

    public function maintenance(Request $request)
    {
        if ($request->ajax()) {
            $data = Tool::where('status_alat', '=', 'maintenance')
                ->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('name', function (Tool $tool) {
                    return $tool->name;
                })
                ->editColumn('foto_alat', function (Tool $tool) {
                    return $tool->foto_alat;
                })
                ->editColumn('status_alat', function (Tool $tool) {
                    return $tool->status_alat;
                })
                // ->editColumn('data1', function ($data) {
                //     return Str::limit($data->data1, 50);
                // })
                ->editColumn('note', function (Tool $tool) {
                    return Str::limit(strip_tags($tool->note), 50);
                    //return html_entity_decode($tool->note, ENT_COMPAT, 'UTF-8');
                    //return htmlspecialchars_decode($tool->note);
                    //return Str::limit(htmlspecialchars_decode($tool->note), 100);
                    //return $tool->note;
                })
                ->addColumn('action', function (Tool $tool) {
                    $encryptID = Crypt::encrypt($tool->id);

                    $btn = '<a href=' . route("note_maintenance", $encryptID) . ' class="btn btn-warning m-1" title="Catatan Maintenance" data-toggle="tooltip" data-placement="top"><i class="fas fa-edit"></i></a>';
                    $btn = $btn . '<a href=' . route("alat.view_maintenance", $encryptID) . ' class="btn btn-info m-1" title="Lihat Pembayaran" data-toggle="tooltip" data-placement="top"><i class="fas fa-eye"></i></a>';
                    $btn = $btn . '<form class="d-inline m-1" action=' . route("alat.ready", $tool->id) . ' method="POST">
                    <input type="hidden" name="_token" value=' . csrf_token() . '>
                    <input type="hidden" name="status_alat" value="ready">
                    <button class="btn btn-outline-success" title="Maintenance Clear" data-toggle="tooltip" data-placement="top" type="submit"><i class="far fa-check-circle"></i></button>
                    </form>';
                    return $btn;
                })
                ->rawColumns(['action', 'modal'])
                ->make(true);
        }
        return view('alat.maintenance');
    }

    //{route('alat.view_maintenance')}
    public function view_maintenance(string $id)
    {
        $decryptID = Crypt::decrypt($id);
        $alat = Tool::find($decryptID);

        return view('alat.view_maintenance', compact('alat'));
    }

    //{route('alat.note_maintenance')}
    public function note_maintenance($id)
    {
        $decryptID = Crypt::decrypt($id);
        $alat = Tool::find($decryptID);
        //$note = Tool::find($decryptID);

        return view('alat.note_maintenance', compact('alat'));
    }

    //{route('alat.update_maintenance')}
    public function update_maintenance(Request $request, Tool $alat)
    {
        $data = $request->validate([
            'name' => 'required',
            'status_alat' => 'required',
            'note' => 'required'
        ]);

        $alat->update($data);

        Alert::toast('Catatan Maintenance Alat Berhasil Diperbarui', 'success');

        return redirect()->route('alat.maintenance');
    }

    //{route('alat.ready')}
    public function clear_maintenance(Request $request, Tool $alat)
    {
        $alat->update([
            'status_alat' => $request->status_alat
        ]);

        Alert::toast('Status Alat Berhasil Diperbarui', 'success');

        return redirect()->route('alat.index');
    }

    public function available(Request $request)
    {
        if ($request->ajax()) {
            $data = Tool::where('status_alat', '=', 'READY')
                ->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('name', function (Tool $tool) {
                    return $tool->name;
                })
                ->editColumn('foto_alat', function (Tool $tool) {
                    return $tool->foto_alat;
                })
                ->editColumn('note', function (Tool $tool) {
                    //return html_entity_decode($tool->note);
                    return Str::limit(strip_tags(str_replace('&nbsp;', ' ', $tool->note)), 50);
                    //return Str::limit($tool->note, 50);
                    //return html_entity_decode(Str::words($tool->note, 50), ENT_QUOTES, 'UTF-8');
                })
                ->editColumn('status_alat', function (Tool $tool) {
                    return $tool->status_alat;
                })
                ->editColumn('price', function (Tool $tool) {
                    return number_format($tool->price, 0, ',', '.');
                })
                ->addColumn('action', function (Tool $tool) {
                    $encryptID = Crypt::encrypt($tool->id);
                    $btn = '<a href=' . route("alat.booking", $encryptID) . ' class="btn btn-primary btn-sm" title="Booking" data-toggle="tooltip" data-placement="top"><i class="fa fa-plus-square"></i> Booking</a>';
                    return $btn;
                })
                ->rawColumns(['action', 'modal'])
                ->make(true);
        }
        return view('penyewaan.available');
    }

    public function booking(string $id)
    {
        $decryptID = Crypt::decrypt($id);

        $alat = Tool::find($decryptID);
        $user = User::where('is_admin', '=', '0')
            ->latest()->get();
        $event = Event::all();

        $note = strip_tags(str_replace('&nbsp;', ' ', $alat->note));

        return view('penyewaan.booking', compact('alat', 'user', 'event', 'note'));
    }

    public function booking_store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required',
            'tools_id' => 'required',
            'date_start' => 'required',
            'date_end' => 'required',
            'note' => 'required',
        ]);
        $data['nama_event'] = 'PERSONAL';
        $data['daftar_alat'] = $request->tools_name;
        $data['daftar_crew'] = 'NO CREW';
        $data['status_event'] = 'PENDING';
        $date_start = new DateTime($request->date_start);
        $date_end = new DateTime($request->date_end);
        $duration = $date_start->diff($date_end);
        //$tool = Tool::find($request->tool_id);
        $data['event_price'] = $request->price * ($duration->days + 1);

        Event::create($data);

        Alert::toast('Booking Alat Berhasil Diproses', 'success');

        return redirect()->route('penyewaan.index');
    }

    public function used(Request $request)
    {
        if ($request->ajax()) {
            $data = Event::where('status_event', '=', 'APPROVED')
                ->orWhere('status_event', '=', 'APPROVED EVENT')
                ->orWhere('status_event', '=', 'DOWN PAYMENT')
                ->orWhere('status_event', '=', 'PAID')
                ->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('tool_id', function (Event $event) {
                    $tool = Tool::find($event->tools_id);
                    return $tool->name;
                    //return $event->tools_id;
                })
                ->editColumn('foto_alat', function (Event $event) {
                    $tool = Tool::find($event->tools_id);
                    return $tool->foto_alat;
                    //return $event->user_id;
                })
                ->editColumn('user_id', function (Event $event) {
                    $user = User::find($event->user_id);
                    return $user->name;
                    //return $event->user_id;
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
                    if ($event->nama_event == 'PERSONAL') {
                        $btn = '<a href=' . route("penyewaan.show", $encryptID) . ' class="btn btn-info m-1" title="View Data Sewa" data-toggle="tooltip" data-placement="top"><i class="fas fa-eye"></i></a>';
                        // $btn = $btn . '<form class="d-inline m-1" action=' . route("penyewaan.kembali", $event->id) . ' method="POST">
                        // <input type="hidden" name="_token" value=' . csrf_token() . '>
                        // <input type="hidden" name="status_event">
                        // <button class="btn btn-primary" title="Telah Kembali" data-toggle="tooltip" data-placement="top" type="submit"><i class="far fa-check-circle"></i></button>
                        // </form>';
                        $btn = $btn . '<button type="button" data-id="' . $event->id . '" id="' . $event->id . '" class="btn btn-primary returned"
                        data-toggle="modal" data-target="#my_modal">
                        <i class="far fa-check-circle"></i></button>';
                        return $btn;
                    } else {
                        $btn = '<a href=' . route("event.show", $encryptID) . ' class="btn btn-info m-1" title="View Daftar Alat" data-toggle="tooltip" data-placement="top"><i class="fas fa-eye"></i></a>';
                        return $btn;
                    }
                })
                ->rawColumns(['action', 'modal'])
                ->make(true);
        }
        return view('penyewaan.used');
    }

    public function kembali(Request $request)
    {
        $event = Event::find($request->id);
        if ($event->status_event == 'PAID') {
            $event->update([
                'status_event' => 'DONE'
            ]);

            $tool = Tool::find($event->tools_id);
            $tool->jml_stok = '1';
            $tool->status_alat = 'READY';
            if ($request->note == '') {
                $event->note = $event->note;
            } else {
                $event->note = $request->note;
            }
            $tool->save();

            Alert::toast('Proses penyewaan selesai, alat kembali ke gudang', 'success');
            return redirect()->route('alat.riwayat');
        } else {
            $event->update([
                'status_event' => 'RETURNED'
            ]);

            $tool = Tool::find($event->tools_id);
            $tool->jml_stok = '1';
            $tool->status_alat = 'READY';
            if ($request->note == '') {
                $event->note = $event->note;
            } else {
                $event->note = $request->note;
            }
            $tool->save();

            Alert::toast('Alat kembali ke gudang, namun client belum membayar biaya sewa', 'success');
            //return redirect ke halaman pembayaran
            return redirect()->route('alat.riwayat');
        }
    }

    public function record(Request $request)
    {
        $event = Event::all();
        if ($request->ajax()) {
            $data = Event::where('status_event', '=', 'DONE')
                ->orWhere('status_event', '=', 'RETURNED')
                ->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('tool_id', function (Event $event) {
                    $tool = Tool::find($event->tools_id);
                    return $tool->name;
                    //return $event->tools_id;
                })
                ->editColumn('user_id', function (Event $event) {
                    $user = User::find($event->user_id);
                    return $user->name;
                    //return $event->user_id;
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
                        $btn = '<form class="d-inline m-1" action=' . route("penyewaan.destroy", $event->id) . ' method="POST">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value=' . csrf_token() . '>
                        <button class="btn btn-danger btn-sm btn-flat" type="submit" title="Hapus Transaksi" data-toggle="tooltip" data-placement="top" onclick="deleteConfirm(event)"><i class="fas fa-trash"></i></button>
                        </form>';
                        $btn = $btn . '<a href=' . route("penyewaan.show", $encryptID) . ' class="btn btn-info btn-sm m-1" title="Lihat Transaksi" data-toggle="tooltip" data-placement="top"><i class="fas fa-eye"></i></a>';
                    } else {
                        $btn = '<a href=' . route("penyewaan.show", $encryptID) . ' class="btn btn-info btn-sm m-1" title="Lihat Transaksi" data-toggle="tooltip" data-placement="top"><i class="fas fa-eye"></i></a>';
                    }
                    return $btn;
                })
                ->rawColumns(['action', 'modal'])
                ->make(true);
        }
        return view('penyewaan.record', compact('event'));
    }
}
