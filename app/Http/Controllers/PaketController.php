<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paket;
use App\Outlet;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;


class PaketController extends Controller
{
    //tampil data
    public function show(){
        $data = DB::table('outlets')->join('pakets','pakets.id_outlet', '=', 'outlets.id')->paginate(5);
        return view('sidebar.paket.paket', ['paket' => $data]);
        
    }

    public function add() {
        $outlet = Outlet::all();
        return view('sidebar.paket.add-paket', compact('outlet'));
        return view('sidebar.paket.add-paket');
    }

    public function save(Request $request) {
        $validator = $request->validate([
            'id_outlet' => 'required',
            'jenis' => 'required|string',
            'nama_paket'=>'required|string',
            'harga'=>'required|string',
            ],
            [
                'id_outlet.required' => 'Outlet tidak boleh kosong!',
    
                'jenis.required' => 'Jenis paket tidak boleh kosong!',

                'nama_paket.required' => 'Nama paket tidak boleh kosong!',
    
                'harga.required' => 'Harga paket tidak boleh kosong!',
                
            ]
        );
        $paket = Paket::create([
        'id_outlet'=>$request->get('id_outlet'),
        'jenis'=>$request->get('jenis'),
        'nama_paket'=>$request->get('nama_paket'),
        'harga'=>$request->get('harga'),
        ]);
        
        return redirect()->route('show-paket')->with('message-simpan','Data berhasil disimpan!');
    }

    //tampil edit data
    public function edit($id){
        $decryptedId = Crypt::decryptString($id);

        $paket = Paket::findOrFail($decryptedId);
        // $paket = DB::table('pakets')->select('*')->where('id', $decryptedId)->first();
        $outlet = DB::table('outlets')->select('id','nama')->get();
        return view('sidebar.paket.update-paket', compact('outlet','paket'));
    }

    //update data
    public function update(Request $request, $id){
        $validator = $request->validate([
            'id_outlet' => 'required',
            'jenis' => 'required',
            'nama_paket'=>'required|max:50',
            'harga'=>'required|string|max:11',
            ],
            [
                'id_outlet.required' => 'Harap pilih outlet!',
                
                'jenis.required' => 'Jenis paket tidak boleh kosong!',

                'nama_paket.required' => 'Nama paket tidak boleh kosong!',
                'nama_paket.max' => 'Nama paket terlalu panjang!',
    
                'harga.required' => 'Harga tidak boleh kosong!',
                'harga.max' => 'Harga melebihi batas!',
            ]
        );
        $paket = Paket::where('id',$id)->update([
            'id_outlet'=>$request->get('id_outlet'),
            'jenis'=>$request->get('jenis'),
            'nama_paket'=>$request->get('nama_paket'),
            'harga'=>$request->get('harga'),
                ]);
        return redirect()->route('show-paket')->with('message-update','Data berhasil diupdate!');
    }

    public function delete($id) {
        $paket = Paket::where('id',$id)->delete();

        return redirect()->back()->with('message-hapus','Data berhasil dihapus!');;
    }
}
