<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;
use App\Exports\UserExport;
use Illuminate\Pagination\Paginator;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Crypt;



class UserController extends Controller
{
    //tampil data
    public function show(){
        $data_user = User::with('roles')->paginate(5);
        // dd($data_user);
        return view('sidebar.user.user', compact('data_user'));
        
    }

    public function add() {
        $roles = Role::pluck('name')->all();
        // return $roles;
        // dd($roles);
        return view('sidebar.user.add-user', compact('roles'));
    }

    public function save(Request $request) {
        $validator = $request->validate([
            'name' => 'required|string|max:100',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6',],
            ],
            [
                'name.required' => 'Nama tidak boleh kosong!',
                'name.max' => 'Nama melebihi batas!',
    
                'email.required' => 'Email tidak boleh kosong!',
    
                'password.required' => 'password tidak boleh kosong!',
            ]);
            $input = $request->all();
            $input['password'] = Hash::make($input['password']);
    
            $user = User::create($input);
            $user->assignRole($request->input('roles'));

            return redirect()->route('show-user')->with('message-simpan','Data berhasil disimpan!');
    }
    
    public function edit($id)
    {
        $decryptedId = Crypt::decryptString($id);

        $user = User::findOrFail($decryptedId);
        $roles = Role::pluck('name')->all();
        $userRole = $user->roles->pluck('name')->all();
        return view('sidebar.user.update-user',compact('user','roles','userRole'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:users,name',
            'email' => 'required|email|unique:users,email,'.$id,
            'roles' => 'required'
        ],
        [
            'roles.required' => 'role harus di isi!',
        ]);
    
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
    
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('roles'));
        // return $request;
        // dd($request);
        return redirect()->route('show-user')
                        ->with('message-simpan','User berhasil diupdate');
    }
    
    public function delete($id) {
        $user = User::where('id',$id)->delete();

        return redirect()->back()->with('message-hapus','Data berhasil dihapus!');;
    }

    //export
    public function export() {
        return Excel::download(new UserExport, 'users.xlsx');
    }

}
