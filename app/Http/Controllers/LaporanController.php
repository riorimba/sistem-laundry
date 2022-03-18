<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MemberExport;
use App\Exports\OutletExport;
use App\Exports\PaketExport;
use App\Exports\TransaksiExport;
use App\Exports\UserExport;

class LaporanController extends Controller
{
    //tampil data laporan
    public function show(){
        return view('sidebar.laporan.laporan');
    }

    public function memberExport() {
        return Excel::download(new MemberExport, 'member.xlsx');
    }
    public function outletExport() {
        return Excel::download(new OutletExport, 'outlet.xlsx');
    }
    public function paketExport() {
        return Excel::download(new PaketExport, 'paket.xlsx');
    }
    public function transaksiExport() {
        return Excel::download(new TransaksiExport, 'transaksi.xlsx');
    }
    public function userExport() {
        return Excel::download(new UserExport, 'user.xlsx');
    }
}
