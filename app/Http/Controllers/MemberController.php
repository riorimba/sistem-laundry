<?php

namespace App\Http\Controllers;
use App\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Hashids\Hashids;
use Illuminate\Support\Facades\Crypt;
use Exception;


class MemberController extends Controller
{
    //tampil data member
    public function show(){
        $data = DB::table('members')->latest()->paginate(5);
        // return $data;
        return view('sidebar.member.member',['member' => $data]);
    }

    //tampilan tambah data
    public function add(){
        return view('sidebar.member.add-member') ;
    }

    //simpan data
    public function save(Request $request){
        $validator = $request->validate([
            'nama_member' => 'required|string|max:100|unique:members,nama_member',
            'alamat' => 'required|string',
            'jenis_kelamin'=>'required',
            'telp'=>'required|string|max:15|unique:members,telp',
            ],
            [
                'nama_member.required' => 'Nama member tidak boleh kosong!',
                'nama_member.max' => 'Nama melebihi batas!',
                'nama_member.unique' => 'Nama member telah terdaftar, coba nama lainnya',
    
                'alamat.required' => 'Alamat member tidak boleh kosong!',

                'jenis_kelamin.required' => 'Jenis kelamin member tidak boleh kosong!',
    
                'telp.required' => 'Nomor telepon member tidak boleh kosong!',
                'telp.max' => 'Panjang nomor telepon melebihi batas!',
                'telp.unique' => 'Nomer telepon member telah terdaftar, coba nomer lainnya',
            ]
        );
        $member = Member::create([
        'nama_member'=>$request->get('nama_member'),
        'alamat'=>$request->get('alamat'),
        'jenis_kelamin'=>$request->get('jenis_kelamin'),
        'telp'=>$request->get('telp'),
        ]);
        // dd($member);
        return redirect()->route('show-member')->with('message-simpan','Data berhasil disimpan!');
    }

    //tampil edit data
    public function edit($id){
        $decryptedId = Crypt::decryptString($id);

        $member = Member::findOrFail($decryptedId);
        return view('sidebar.member.update-member',['member' => $member]);
    }

    //update data
    public function update(Request $request, $id){
        $validator = $request->validate([
            'nama_member' => 'required|string|max:100|unique:members,nama_member,'.$id,
            'alamat' => 'required|string',
            'jenis_kelamin'=>'required',
            'telp'=>'required|string|max:15|unique:members,nama_member,'.$id,
            ],
            [
                'nama_member.required' => 'Nama member tidak boleh kosong!',
                'nama_member.max' => 'Nama melebihi batas!',
                'nama_member.unique' => 'Nama member telah terdaftar, coba nama lainnya',
                
                'alamat.required' => 'Alamat member tidak boleh kosong!',

                'jenis_kelamin.required' => 'Jenis kelamin member tidak boleh kosong!',
    
                'telp.required' => 'Nomor telepon member tidak boleh kosong!',
                'telp.max' => 'Panjang nomor telepon melebihi batas!',
                'telp.unique' => 'Nomer telepon member telah terdaftar, coba nomer lainnya',
            ]
        );
        $member = Member::where('id',$id)->update([
                	'nama_member'=>$request->get('nama_member'),
                	'alamat'=>$request->get('alamat'),
                    'jenis_kelamin'=>$request->get('jenis_kelamin'),
                	'telp'=>$request->get('telp'),
                ]);
        return redirect()->route('show-member')->with('message-update','Data berhasil diupdate!');
    }

    //hapus data
    public function delete($id){
        try {
            $member = Member::where('id',$id)->delete();
            return redirect()->back()->with('message-hapus','Data berhasil dihapus!');
        } catch(Exception $e) {
            return redirect()->back()->with('message-gagal','Data gagal dihapus, data sedang digunakan ditransaksi!');
        }
        
    }
}
