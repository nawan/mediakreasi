<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Payment;
use App\Models\Tool;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, User $user)
    {
        $search = $request->search;
        $users = User::where('is_admin', '!=', 0)
            ->where('is_admin', '!=', 4)
            ->where('name', 'like', '%' . $search . '%')
            ->latest()
            ->paginate(5);

        return view('admin.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'is_admin' => 'required',
            // verifikasi apakah email sudah ada atau belum
            'email' => 'required|email:rfc,dns|unique:App\Models\User,email',
            'nik' => 'required',
            'no_kontak' => 'required',
            'image' => 'required',
            'alamat' => 'required',
            'password' => 'required',
        ]);

        $data['password'] = Hash::make($request->password);

        if ($request->file('image')) {
            $data['image'] = $request->file('image')->store('admin');
        }

        User::create($data);

        Alert::toast('Data Admin Berhasil Ditambahkan!', 'success');

        return redirect()->route('admin.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, Request $request)
    {
        $decryptID = Crypt::decrypt($id);
        $admin = User::find($decryptID);

        if ($request->ajax()) {
            $data = Payment::where('received_by', '=', $decryptID)
                ->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('tools_id', function (Payment $payment) {
                    $tool = Tool::find($payment->tools_id);
                    return $tool->name;
                })
                ->editColumn('user_id', function (Payment $payment) {
                    $user = user::find($payment->user_id);
                    return $user->name;
                })
                ->editColumn('date_start', function (Payment $payment) {
                    $event = Event::find($payment->events_id);
                    return Carbon::parse($event->date_start)->isoFormat('D MMMM Y');
                })
                ->editColumn('date_end', function (Payment $payment) {
                    $event = Event::find($payment->events_id);
                    return Carbon::parse($event->date_end)->isoFormat('D MMMM Y');
                })
                ->editColumn('payment_amount', function (Payment $payment) {
                    return number_format($payment->payment_amount, 0, ',', '.');
                })
                ->editColumn('payment_status', function (Payment $payment) {
                    return $payment->payment_status;
                })
                ->addColumn('action', function (Payment $payment) {
                    $encryptID = Crypt::encrypt($payment->id);
                    $btn = '<a href=' . route("keuangan.show", $encryptID) . ' class="btn btn-info btn-sm m-1" title="Lihat Pembayaran" data-toggle="tooltip" data-placement="top"><i class="fas fa-eye"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // $decryptID = Crypt::decrypt($id);
        // $user = User::find($decryptID);
        // return view('admin.edit', compact('user'));

        $decryptID = Crypt::decrypt($id);
        $user = User::find($decryptID);
        return view('admin.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $admin)
    {
        $data = $request->validate([
            'name' => 'required',
            'nik' => 'required',
            'alamat' => 'required',
            'no_kontak' => 'required',
            'is_admin' => 'required'
        ]);
        $data['password'] = Hash::make($request->password);
        $admin->name = $request->name;
        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $admin->image = $request->file('image')->store('admin');
        }
        $admin->update($data);

        Alert::toast('Data Admin Berhasil Diperbarui!', 'success');

        return redirect()->route('admin.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $admin)
    {
        if ($admin->image) {
            Storage::delete($admin->image);
        }
        User::destroy($admin->id);
        return redirect()->route('admin.index');
    }
}
