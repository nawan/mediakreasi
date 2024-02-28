<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Crew_events;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use RealRashid\SweetAlert\Facades\Alert;

class CrewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, User $user)
    {
        if ($request->ajax()) {
            $data = User::where('is_admin', '=', 4)
                ->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('name', function (User $user) {
                    return $user->name;
                })
                ->editColumn('image', function (User $user) {
                    return $user->image;
                })
                ->editColumn('no_kontak', function (User $user) {
                    return $user->no_kontak;
                })
                ->editColumn('created_at', function (User $user) {
                    return Carbon::parse($user->created_at)->isoFormat('D MMMM Y');
                })
                ->addColumn('action', function (User $user) {
                    $encryptID = Crypt::encrypt($user->id);

                    $btn = '<form class="d-inline m-1" action=' . route("crew.destroy", $user->id) . ' method="POST">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value=' . csrf_token() . '>
                        <button class="btn btn-danger btn-sm btn-flat" type="submit" title="Hapus Pembayaran" data-toggle="tooltip" data-placement="top" onclick="deleteConfirm(event)"><i class="fas fa-trash"></i></button>
                        </form>';
                    $btn = $btn . '<a href=' . route("crew.edit", $encryptID) . ' class="edit btn btn-warning btn-sm m-1" title="Edit Pembayaran" data-toggle="tooltip" data-placement="top"><i class="fas fa-edit"></i></a>';
                    $btn = $btn . '<a href=' . route("crew.show", $encryptID) . ' class="btn btn-info btn-sm m-1" title="Lihat Pembayaran" data-toggle="tooltip" data-placement="top"><i class="fas fa-eye"></i></a>';

                    return $btn;
                })
                ->rawColumns(['action', 'modal'])
                ->make(true);
        }
        return view('crew.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('crew.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'is_admin' => 'required',
            'email' => 'required|email:rfc,dns|unique:App\Models\User,email',
            'nik' => 'required|unique:App\Models\User,nik',
            'no_kontak' => 'required',
            'alamat' => 'required',
            'image' => 'required|image'
        ]);

        $data['password'] = Crypt::encrypt(Str::random(8));
        if ($request->file('image')) {
            $data['image'] = $request->file('image')->store('crews');
        }

        User::create($data);

        Alert::toast('Data Crew Berhasil Ditambahkan!', 'success');

        return redirect()->route('crew.index')->with('message', 'Data Crew Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, Request $request)
    {
        $decryptID = Crypt::decrypt($id);
        $crew = User::find($decryptID);
        if ($request->ajax()) {
            $data = Crew_events::where('user_id', '=', $decryptID)
                ->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('events_id', function (Crew_events $crew_events) {
                    $event = Event::find($crew_events->events_id);
                    return $event->nama_event;
                })
                ->editColumn('client', function (Crew_events $crew_events) {
                    $event = Event::find($crew_events->events_id);
                    $user = User::find($event->user_id);
                    return $user->name;
                    //return $event->user_id;
                })
                ->editColumn('date_start', function (Crew_events $crew_events) {
                    $event = Event::find($crew_events->events_id);
                    return Carbon::parse($event->date_start)->isoFormat('D MMMM Y');
                })
                ->editColumn('date_end', function (Crew_events $crew_events) {
                    $event = Event::find($crew_events->events_id);
                    return Carbon::parse($event->date_end)->isoFormat('D MMMM Y');
                })
                ->make(true);
        }

        return view('crew.show', compact('crew'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $decryptID = Crypt::decrypt($id);
        $user = User::find($decryptID);
        return view('crew.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $crew)
    {
        $data = $request->validate([
            'name' => 'required',
            'nik' => 'required',
            'alamat' => 'required',
            'no_kontak' => 'required',
        ]);
        $data['password'] = Hash::make($request->password);
        $crew->name = $request->name;
        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $crew->image = $request->file('image')->store('crews');
        }
        $crew->update($data);

        Alert::toast('Data Crew Berhasil Diperbarui!', 'success');

        return redirect()->route('crew.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $crew)
    {
        if ($crew->image) {
            Storage::delete($crew->image);
        }
        User::destroy($crew->id);
        return redirect()->route('crew.index');
    }
}
