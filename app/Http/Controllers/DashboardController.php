<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Event;
use App\Models\Tool;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request, Payment $payment)
    {
        //total pendapatan
        $payment = Payment::latest()->get();
        $jumlah_payment = $payment->count();
        $total_pendapatan = $payment->sum('payment_amount');

        //total yang belum bayar
        $piutang = Event::where('status_event', '=', 'APPROVED')
            ->orwhere('status_event', '=', 'APPROVED EVENT')
            ->orWhere('status_event', '=', 'RETURNED')
            ->orWhere('status_event', '=', 'RETURNED EVENT')
            ->latest()->get();
        $jumlah_piutang = $piutang->count();
        $total_piutang = $piutang->sum('event_price');

        //total client
        $jumlah_client = User::where('is_admin', '=', '0')
            ->count();

        //total alat
        $jumlah_alat = Tool::where('status_alat', '!=', 'EVENT')
            ->count();

        //data event
        $data_event = Event::where([
            ['nama_event', '!=', 'PERSONAL'],
            ['status_event', '=', 'APPROVED EVENT']
        ])
            ->orWhere([
                ['nama_event', '!=', 'PERSONAL'],
                ['status_event', '=', 'PENDING EVENT']
            ])
            ->count();

        //konfirmasi event selesai
        $jumlah_event = Event::where([
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
            ->count();

        //konfirmasi alat kembali
        $alat_terpakai = Event::where([
            ['nama_event', '=', 'PERSONAL'],
            ['status_event', '=', 'APPROVED']
        ])
            ->orWhere([
                ['nama_event', '=', 'PERSONAL'],
                ['status_event', '=', 'DOWN PAYMENT']
            ])
            ->orWhere([
                ['nama_event', '=', 'PERSONAL'],
                ['status_event', '=', 'PAID']
            ])
            ->count();

        $approval_event = Event::where('status_event', '=', 'PENDING EVENT')
            ->count();

        $approval_penyewaan = Event::where('status_event', '=', 'PENDING')
            ->count();


        return view('dashboard.index', compact(
            'total_pendapatan',
            'jumlah_payment',
            'jumlah_piutang',
            'total_piutang',
            'jumlah_client',
            'jumlah_alat',
            'data_event',
            'jumlah_event',
            'alat_terpakai',
            'approval_event',
            'approval_penyewaan'
        ));
    }
}
