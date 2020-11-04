<?php

namespace App\Http\Controllers;

use App\Department;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::join("roles","roles.id", "=", "departments.role_id")
                        ->select("departments.id", "departments.name", "roles.name as roleName","departments.role_id")
                        ->orderBy("departments.id")
                        ->paginate(5);
        $users = User::join("department_users", "department_users.user_id", "=", "users.id")
                    ->join("departments", "departments.id", "=", "department_users.depa_id")
                    ->select("users.name","departments.id as depa_id")
                    ->get();
        $roles = Role::all();
        return view('admin/departments', compact('departments', 'roles', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $department = new Department;
        $department->name = $request->name;
        $department->role_id = $request->role;
        $department->save();
        return redirect('manager/departments');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        $update_depart = Department::find($request->id_update);
        $update_depart->name = $request->name_update;
        $update_depart->role_id = $request->role_update;
        $update_depart->save(); 
        return redirect('manager/departments');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Department::destroy($request->id_delete);
        return redirect('manager/departments');
    }
}
