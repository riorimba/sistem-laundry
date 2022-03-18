<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi;
use App\Paket;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

class DetailTransaksiController extends Controller
{
    public function show(){
        $detail = DB::table('detail_transaksis')->first();
        return view('sidebar.transaksi.detail-transaksi', compact('detail'));
    }

    //tampil tambah
    public function tambah(){
        $transaksi = Transaksi::all();
        $paket = Paket::all();
        return view('detail-tambah', compact('transaksi','paket'));
    }
}
