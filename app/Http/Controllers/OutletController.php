<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Outlet;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Exception;



class OutletController extends Controller
{
    //tampil data
    public function show(){
        $data = DB::table('outlets')->latest()->paginate(5);
        return view('sidebar.outlet.outlet', ['outlet' => $data]);
        
    }

    public function add() {
        return view('sidebar.outlet.add-outlet');
    }

    public function save(Request $request) {
        $validator = $request->validate([
            'nama' => 'required|string|max:100|unique:outlets,nama',
            'alamat' => 'required|string',
            'telp'=>'required|string|max:15|unique:outlets,telp',
            ],
            [
                'nama.required' => 'Nama outlet tidak boleh kosong!',
                'nama.max' => 'Nama melebihi batas!',
                'nama.unique' => 'Nama outlet telah terdaftar, coba nama lainnya',
    
                'alamat.required' => 'Alamat outlet tidak boleh kosong!',
    
                'telp.required' => 'Nomor telepon outlet tidak boleh kosong!',
                'telp.max' => 'Panjang nomor telepon melebihi batas!',
                'telp.unique' => 'Nomer telepon outlet telah terdaftar, coba nomer lainnya',
            ]);
            $outlet = Outlet::create([
                'nama'=>$request->get('nama'),
                'alamat'=>$request->get('alamat'),
                'telp'=>$request->get('telp'),
                ]);
                return redirect()->route('show-outlet')->with('message-simpan','Data berhasil disimpan!');
    }

    public function edit($id) {
        $decryptedId = Crypt::decryptString($id);

        $outlet = Outlet::findOrFail($decryptedId);
        // $outlet = DB::table('outlets')->where('id',$id)->first();
        return view('sidebar.outlet.update-outlet',['outlet' => $outlet]);
    }

    public function update(Request $request, $id) {
        $validator = $request->validate([
            'nama' => 'required|string|max:100|unique:outlets,nama,'.$id,
            'alamat' => 'required|string',
            'telp'=>'required|string|max:15|unique:outlets,telp,'.$id,
            ],
            [
                'nama.required' => 'Nama outlet tidak boleh kosong!',
                'nama.max' => 'Nama melebihi batas!',
                'nama.unique' => 'Nama outlet telah terdaftar, coba nama lainnya',
    
                'alamat.required' => 'Alamat outlet tidak boleh kosong!',
    
                'telp.required' => 'Nomor telepon outlet tidak boleh kosong!',
                'telp.max' => 'Panjang nomor telepon melebihi batas!',
                'telp.unique' => 'Nomer telepon outlet telah terdaftar, coba nomer lainnya',

            ]
        );
        $outlet = Outlet::where('id',$id)->update([
                	'nama'=>$request->get('nama'),
                	'alamat'=>$request->get('alamat'),
                	'telp'=>$request->get('telp'),
                ]);
        return redirect()->route('show-outlet')->with('message-update','Data berhasil diupdate!');
    }
    
    public function delete($id) {
        try {
            $outlet = Outlet::where('id',$id)->delete();
        return redirect()->back()->with('message-hapus','Data berhasil dihapus!');;
        } catch(Exception $e) {
            return redirect()->back()->with('message-gagal','Data gagal dihapus, data sedang digunakan ditransaksi!');
        }
        
    }
}
