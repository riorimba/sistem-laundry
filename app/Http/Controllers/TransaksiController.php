<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi;
use App\DetailTransaksi;
use App\Outlet;
use App\Member;
use App\Paket;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use App\Exports\TransaksisExport;
use Maatwebsite\Excel\Facades\Excel;

class TransaksiController extends Controller
{
    public function show(){
        $transaksi = DB::table('transaksis')->select('transaksis.id as id_transaksi','transaksis.*','outlets.*','members.*',"pakets.*")
                                           ->join('outlets','outlets.id', '=', 'transaksis.id_outlet')
                                           ->join('members','members.id', '=', 'transaksis.id_member')
                                           ->join('pakets','pakets.id', '=', 'transaksis.id_paket')->paginate(5);
        return view('sidebar.transaksi.transaksi', compact('transaksi'));
    }

    public function add(){
        $outlet = Outlet::all();
        $member = Member::all();
        $paket = Paket::all();
        return view('sidebar.transaksi.add-transaksi', compact('outlet','member','paket'));
    }

    //simpan data
    public function save(Request $request){        
        //Tabel Transaksi
        $validator = $request->validate([
            'id_outlet' => 'required',
            'id_member' => 'required|string',
            'id_paket' => 'required|string',
            'qty' => 'required|min:1',
            'tgl'=>'required',
            'batas_waktu'=>'required',
            'tgl_bayar'=>'',
            'status'=>'required',
            'dibayar'=>'required',
            ],
            [
                'id_outlet.required' => 'Outlet tidak boleh kosong!',
                'id_member.required' => 'Nama member tidak boleh kosong!',
                'id_paket.required' => 'Jenis paket tidak boleh kosong!',
                'qty.required' => 'Berat tidak boleh kosong!',
                'qty.min' => 'Berat minimal min:! kg',
                'tgl.required' => 'Tanggal transaksi tidak boleh kosong!',
                'batas_waktu.required' => 'Batas waktu tidak boleh kosong!',
                'status.required' => 'Status tidak boleh kosong!',  
                'dibayar.required' => 'Status bayar tidak boleh kosong!',  
            ]
        );
        
        $transaksi = Transaksi::create([
        'id_outlet'=>$request->get('id_outlet'),
        'id_member'=>$request->get('id_member'),
        'id_paket'=>$request->get('id_paket'),
        'qty'=>$request->get('qty'),
        'tgl'=>$request->get('tgl'),
        'batas_waktu'=>$request->get('batas_waktu'),
        'tgl_bayar'=>$request->get('tgl_bayar'),
        'status'=>$request->get('status'),
        'dibayar'=>$request->get('dibayar'),
        ]);
        
        $id = $request->get('id_paket');
        $paket = Paket::all()->find($id);

        $detail = DetailTransaksi::create([
        'id_transaksi' => $transaksi->id,
        'subtotal' => $transaksi->qty * $paket->harga,
        'keterangan' => '',
        ]);
        
        return redirect()->route('show-transaksi')->with('message-simpan','Data berhasil disimpan!');
    }

    //tampil edit data
    public function edit($id){
        $transaksi = DB::table('transaksis')->select('*')->where('id', $id)->first();
        $outlet = DB::table('outlets')->select('id','nama')->get();
        $member = DB::table('members')->select('id','nama_member')->get();
        $paket = DB::table('pakets')->select('id','nama_paket')->get();
        return view('sidebar.transaksi.update-transaksi', compact('transaksi','outlet','member','paket'));

    }

    //update data
    public function update(Request $request, $id){
        $validator = $request->validate([
            'id_outlet' => 'required',
            'id_member' => 'required|string',
            'id_paket' => 'required|string',
            'qty' => 'required|min:1',
            'tgl'=>'required',
            'batas_waktu'=>'required',
            'tgl_bayar'=>'',
            'status'=>'required',
            'dibayar'=>'required',
            ],
            [
                'id_outlet.required' => 'Outlet tidak boleh kosong!',
                'id_member.required' => 'Nama member tidak boleh kosong!',
                'id_paket.required' => 'Jenis paket tidak boleh kosong!',
                'qty.required' => 'Berat tidak boleh kosong!',
                'qty.min' => 'Berat minimal min:! kg',
                'tgl.required' => 'Tanggal transaksi tidak boleh kosong!',
                'batas_waktu.required' => 'Batas waktu tidak boleh kosong!',
                'status.required' => 'Status tidak boleh kosong!',  
                'dibayar.required' => 'Status bayar tidak boleh kosong!',  
            ]
        );
        $transaksi = Transaksi::where('id',$id)->update([
            'id_outlet'=>$request->get('id_outlet'),
            'id_member'=>$request->get('id_member'),
            'id_paket'=>$request->get('id_paket'),
            'qty'=>$request->get('qty'),
            'tgl'=>$request->get('tgl'),
            'batas_waktu'=>$request->get('batas_waktu'),
            'tgl_bayar'=>$request->get('tgl_bayar'),
            'status'=>$request->get('status'),
            'dibayar'=>$request->get('dibayar'),
                ]);

            $id_paket = $request->get('id_paket');
            $paket = Paket::all()->find($id_paket);

            $detail = DetailTransaksi::where('id_transaksi',$id)->update([
            'id_transaksi' => $id,
            'subtotal' => $request->get('qty') * $paket->harga,
            'keterangan' => '',
            ]);
        return redirect()->route('show-transaksi')->with('message-update','Data berhasil diupdate!');
    }

    //hapus data
    public function delete($id){
        $detail = DetailTransaksi::where('id_transaksi',$id)->delete();
        $transaksi = Transaksi::where('id',$id)->delete();
        
        return redirect()->back()->with('message-hapus','Data berhasil dihapus!');
    }

    public function detailTransaksi($id) {
        $transaksi = DB::table('transaksis')->select('*')->where('id', $id)->first();
        $outlet = DB::table('outlets')->where('id', $transaksi->id_outlet)->get();
        $member = DB::table('members')->where('id', $transaksi->id_member)->get();
        $paket  = DB::table('pakets')->where('id', $transaksi->id_paket)->get();

        $detail = DB::table('detail_transaksis')->where('id_transaksi', $id)->first();
        return view('sidebar.transaksi.detail-transaksi', compact('transaksi','outlet','member','paket','detail',));
    }
    
    //Export
    public function export() {
        return Excel::download(new TransaksisExport, 'Laporan-Transaksi.xlsx');
    }
}
