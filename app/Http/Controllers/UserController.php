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
        $user = User::find($id);
        $roles = Role::pluck('name')->all();
        $userRole = $user->roles->pluck('name')->all();
        // return $user, $roles, $userRole;
        // dd($user, $roles, $userRole);
        return view('sidebar.user.update-user',compact('user','roles','userRole'));
    }

    // public function edit(User $user) 
    // {
    //     return view('sidebar.user.update-user', [
    //         'user' => $user,
    //         'userRole' => $user->roles->pluck('name')->toArray(),
    //         'roles' => Role::latest()->get()
    //     ]);
    // }

    // public function edit($id) {
    //     $user = DB::table('users')->where('id',$id)->first();
    //     return view('sidebar.user.update-user',['user' => $user]);
    // }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            // 'password' => 'same:confirm-password',
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

    // public function update(Request $request, $id) {
    //     $validator = $request->validate([
    //         'name' => 'required|string|max:100',
    //         'email' => 'required|string',
    //         'password'=>'required|string|max:15',
    //         ],
    //         [
    //             'name.required' => 'Nama  tidak boleh kosong!',
    //             'name.max' => 'Nama melebihi batas!',
    
    //             'email.required' => 'email tidak boleh kosong!',
    
    //             'password.required' => 'password tidak boleh kosong!',
    //         ]
    //     );
    //     $user = User::where('id',$id)->update([
    //             	'name'=>$request->get('name'),
    //             	'email'=>$request->get('email'),
    //             	'password'=>Hash::make($request->get('password')),
    //             ]);
    //     return redirect()->route('show-user')->with('message-update','Data berhasil diupdate!');
    // }
    
    public function delete($id) {
        $user = User::where('id',$id)->delete();

        return redirect()->back()->with('message-hapus','Data berhasil dihapus!');;
    }

    //export
    public function export() {
        return Excel::download(new UserExport, 'users.xlsx');
    }

}
