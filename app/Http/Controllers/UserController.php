<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Tool;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, User $users)
    {
        if ($request->ajax()) {
            $data = User::where('is_admin', '=', 0)
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

                    $btn = '<form class="d-inline m-1" action=' . route("user.destroy", $user->id) . ' method="POST">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value=' . csrf_token() . '>
                        <button class="btn btn-danger btn-sm btn-flat" type="submit" title="Hapus" data-toggle="tooltip" data-placement="top" onclick="deleteConfirm(event)"><i class="fas fa-trash"></i></button>
                        </form>';
                    $btn = $btn . '<a href=' . route("user.edit", $encryptID) . ' class="edit btn btn-warning btn-sm m-1" title="Edit" data-toggle="tooltip" data-placement="top"><i class="fas fa-edit"></i></a>';
                    $btn = $btn . '<a href=' . route("user.show", $encryptID) . ' class="btn btn-info btn-sm m-1" title="Lihat" data-toggle="tooltip" data-placement="top"><i class="fas fa-eye"></i></a>';

                    return $btn;
                })
                ->rawColumns(['action', 'modal'])
                ->make(true);
        }
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email:rfc,dns|unique:App\Models\User,email',
            'nik' => 'required|unique:App\Models\User,nik',
            'no_kontak' => 'required',
            'alamat' => 'required',
            'image' => 'required|image'
        ]);

        $data['password'] = Crypt::encrypt(Str::random(8));
        if ($request->file('image')) {
            $data['image'] = $request->file('image')->store('users');
        }

        User::create($data);

        Alert::toast('Data Client Berhasil Ditambahkan!', 'success');

        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, Request $request)
    {
        $decryptID = Crypt::decrypt($id);
        $user = User::find($decryptID);
        if ($request->ajax()) {
            $data = Event::where('user_id', '=', $decryptID)
                ->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('tools_id', function (Event $event) {
                    $tool = Tool::find($event->tools_id);
                    return $tool->name;
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
                ->editColumn('note', function (Event $event) {
                    return $event->note;
                })
                ->editColumn('status_event', function (Event $event) {
                    return $event->status_event;
                })
                ->make(true);
        }

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $decryptID = Crypt::decrypt($id);
        $user = User::find($decryptID);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required',
            'nik' => 'required',
            'alamat' => 'required',
            'no_kontak' => 'required',
        ]);
        $data['password'] = Hash::make($request->password);
        $user->name = $request->name;
        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $user->image = $request->file('image')->store('users');
        }
        $user->update($data);

        Alert::toast('Data Client Berhasil Diperbarui!', 'success');

        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->image) {
            Storage::delete($user->image);
        }
        User::destroy($user->id);
        return redirect()->route('user.index');
    }

    public function getdataklien(Request $request)
    {
        // $data = User::where('is_admin', '=', 0)
        //     ->latest()->get();

        // return DataTables::of($data)->make(true);
        if ($request->ajax()) {
            $data = User::where('is_admin', '=', 0)
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

                    $btn = '<form class="d-inline m-1" action=' . route("user.destroy", $user->id) . ' method="POST">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value=' . csrf_token() . '>
                        <button class="btn btn-danger btn-sm btn-flat" type="submit" title="Hapus Pembayaran" data-toggle="tooltip" data-placement="top" onclick="deleteConfirm(event)"><i class="fas fa-trash"></i></button>
                        </form>';
                    $btn = $btn . '<a href=' . route("user.edit", $encryptID) . ' class="edit btn btn-warning btn-sm m-1" title="Edit Pembayaran" data-toggle="tooltip" data-placement="top"><i class="fas fa-edit"></i></a>';
                    $btn = $btn . '<a href=' . route("user.show", $encryptID) . ' class="btn btn-info btn-sm m-1" title="Lihat Pembayaran" data-toggle="tooltip" data-placement="top"><i class="fas fa-eye"></i></a>';

                    return $btn;
                })
                ->rawColumns(['action', 'modal'])
                ->make(true);
        }
        return view('users.tampildata');
    }
}
