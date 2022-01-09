<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paket;
use Illuminate\Support\Facades\validator;

class PaketController extends Controller
{
    //add
    public function store(Request $request) {
        $validator = validator::make($request->all(), [
            'nama_paket' => 'required|string|max:255',
            'harga' => 'required|integer',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }        
        $paket = paket::create([
            'nama_paket'=>$request->get('nama_paket'),
            'harga'=>$request->get('harga'),
        ]);
        if($paket) {
            return response()->json(['status' => 'data paket berhasil ditambahkan']);
        }else {
            return response()->json(['status' => 'data paket gagal ditambahkan']);
        }
    }

    //show
    public function show() {
        $outlet = paket::get();
        return response()->json($outlet);
    }

    //update
    public function update(Request $req, $id) {
        //validasi
        $validator = validator::make($req->all(),[
            'nama_paket' => 'required|string|max:255',
            'harga' => 'required|integer',
        ]);
        if($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $outlet = paket::where('id', $id)->update([
            'nama_paket' => $req->get('nama_paket'),
            'harga' => $req->get('harga'),
        ]);
        if($outlet) {
            return response()->json(['status' => 'data paket berhasil diperbarui']);
        }else {
            return response()->json(['status' => 'data paket gagal diperbarui']);
        }
    }

    //delete
    public function delete($id) {
        $outlet = paket::where('id', $id)->delete();
        if($outlet) {
            return response()->json(['status' => 'data paket berhasil dihapus']);
        }else {
            return response()->json(['status' => 'data paket gagal dihapus']);
        }
    }
}
