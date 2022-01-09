<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Outlet;
use Illuminate\Support\Facades\validator;

class OutletController extends Controller
{
    //add
    public function store(Request $request) {
        $validator = validator::make($request->all(), [
            'nama_outlet' => 'required|string|max:255',
            'alamat' => 'required|string',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }        
        $Outlet = Outlet::create([
            'nama_outlet'=>$request->get('nama_outlet'),
            'alamat'=>$request->get('alamat'),
        ]);
        if($Outlet) {
            return response()->json(['status' => 'data outlet berhasil ditambahkan']);
        }else {
            return response()->json(['status' => 'data outlet gagal ditambahkan']);
        }
    }

    //show
    public function show() {
        $Outlet = Outlet::get();
        return response()->json($Outlet);
    }

    //update
    public function update(Request $req, $id) {
        //validasi
        $validator = validator::make($req->all(),[
            'nama_outlet' => 'required|string|max:255',
            'alamat' => 'required|string',
        ]);
        if($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $Outlet = Outlet::where('id', $id)->update([
            'nama_outlet' => $req->get('nama_outlet'),
            'alamat' => $req->get('alamat'),
        ]);
        if($outlet) {
            return response()->json(['status' => 'data outlet berhasil diperbarui']);
        }else {
            return response()->json(['status' => 'data outlet gagal diperbarui']);
        }
    }

    //delete
    public function delete($id) {
        $Outlet = Outlet::where('id', $id)->delete();
        if($Outlet) {
            return response()->json(['status' => 'data outlet berhasil dihapus']);
        }else {
            return response()->json(['status' => 'data outlet gagal dihapus']);
        }
    }
}
