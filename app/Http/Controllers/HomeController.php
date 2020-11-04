<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Department;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function dashboard(Request $request)
    {   
        $users = User::join('user_roles', 'users.id', '=', 'user_roles.user_id')
                    ->join('roles', 'roles.id', '=', 'user_roles.role_id')
                    ->orderBy('user_roles.role_id')
                    ->select('users.id','users.name','roles.slug','user_roles.role_id','users.email','users.gender','users.phone','users.address')
                    ->paginate(5);
        $roles = Role::all();
        $departs = Department::all();
        return view('admin/user', compact('users', 'roles', 'departs'));
    }
    public function search(Request $request)
    {
        $searchs = $request->get('searchUser');
        $data = User::where('name','like','%'.$searchs.'%')->paginate(5);
        echo json_encode($data);
    }

    public function searchTable(Request $request)
    {   
        $searchs = $request->get('searchUser');
        $users = User::join('user_roles', 'users.id', '=', 'user_roles.user_id')
                    ->join('roles', 'roles.id', '=', 'user_roles.role_id')
                    ->select('users.id','users.name','roles.slug','users.email','users.gender','users.phone','users.address')
                    ->where('users.name','like','%'.$searchs.'%')->paginate(2);
        $users->appends(['searchUser' => $searchs]);
        $roles = Role::all();
        return view('admin/user', compact('users','searchs','roles'));
    }
    
    public function store(Request $request){
        $user = new User;
        $user->name = $request->name; 
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->gender = $request->gender;
        $user->phone = $request->phone;
        $user->address = $request->address;

        $user->save();
        
        $listUser = User::where('email','like', $request->email)->first();
        $idUser_role = $listUser->id;
        $role = $request->role;
        $depart = $request->depart;
        DB::table('user_roles')->insert([
            'user_id' => $idUser_role,
            'role_id' => $role
        ]);
        DB::table('department_users')->insert([
            'depa_id' => $depart,
            'user_id' => $idUser_role
        ]);

        return redirect('manager/user');
    }

    public function edit(Request $request){
        
        $data = User::find($request->id);
        
        echo json_encode($data);
    }

    public function update(Request $request){
        $update_users = User::find($request->id_update);
        $update_users->name = $request->name_update;
        $update_users->email = $request->email_update;
        $update_users->gender = $request->gender_update;
        $update_users->phone = $request->phone_update;
        $update_users->address = $request->address_update;
        $update_users->save();

        DB::table('user_roles')->where('user_id', $request->id_update)
                                ->update(['role_id' => $request->role_update]);

        return redirect('manager/user');
    }


   public function delete(Request $request)
    {
        User::destroy($request->id_delete);
        return redirect('manager/user');
    }
}
