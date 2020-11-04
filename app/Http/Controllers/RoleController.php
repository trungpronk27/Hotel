<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Department;
use DB;

class RoleController extends Controller
{
    public function index(Request $request)
    {   
        $users = User::join('user_roles', 'users.id', '=', 'user_roles.user_id')
                    ->join('roles', 'roles.id', '=', 'user_roles.role_id')
                    ->select('users.id','users.name','roles.slug','users.email','users.gender','users.phone','users.address')
                    ->get();
        $roles = Role::paginate(5);
        $departs = Department::all();
        return view('admin/role', compact('users', 'roles', 'departs'));
    }
    
    public function store(Request $request){
        $role = new Role;
        $role->name = $request->name;
        $role->slug = $request->slug;
        if (count($request->juris) == 0) {
          $role->permissions = "{none}";
        } else {
          $arr = array();
          foreach ($request->juris as $value) {
            $arr[$value] = true;
          }
          $role->permissions = json_encode($arr);
        }
        $role->save();
        return redirect('manager/role');   
    }

   //  public function edit(Request $request){
        
   //      $data = User::find($request->id);
        
   //      echo json_encode($data);
   //  }

   //  public function update(Request $request){
   //      $update_users = User::find($request->id_update);
   //      $update_users->name = $request->name_update;
   //      $update_users->email = $request->email_update;
   //      $update_users->gender = $request->gender_update;
   //      $update_users->phone = $request->phone_update;
   //      $update_users->address = $request->address_update;
   //      $update_users->save();
   //      return redirect('admin/role');
   //  }


   // public function delete(Request $request)
   //  {
   //      User::destroy($request->id_delete);
   //      return redirect('admin/role');
   //  }
}
