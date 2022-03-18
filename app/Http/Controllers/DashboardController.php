<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\Outlet;
use App\Paket;
use App\Transaksi;


class DashboardController extends Controller
{
    public function dashboard() {
        $outlet = Outlet::all();
        $paket = Paket::all();
        $member = Member::all();
        $transaksi = Transaksi::where('status', '=', 'proses')->get();

        return view('sidebar.dashboard', compact('outlet','paket','member','transaksi'));
    }
}
