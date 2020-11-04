<?php

namespace App\Http\Controllers;

use App\Customers;
use App\Department;
use App\Role;
use App\KindOfRoom;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $departments = Department::join("roles","roles.id", "=", "departments.role_id")
                        ->select("departments.id", "departments.name", "roles.name as roleName")
                        ->get();
        $roles = Role::all();
        $customers = Customers::paginate(5);
        return view('admin/customer', compact('departments', 'roles', 'customers'));
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
        //
        $cus = new Customers;
        $cus->full_name = $request->fullname;
        $cus->gender = $request->gender;
        $cus->identity = $request->identity;
        $cus->phone = $request->phone;
        $cus->save();
        return redirect('admin/customer');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customers  $customers
     * @return \Illuminate\Http\Response
     */
    public function show(Customers $customers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customers  $customers
     * @return \Illuminate\Http\Response
     */
    public function edit(Customers $customers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customers  $customers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customers $customers)
    {
        //
        $cus = Customers::find($request->id_update);
        $cus->full_name = $request->fullname_update;
        $cus->gender = $request->gender_update;
        $cus->identity = $request->identity_update;
        $cus->phone = $request->phone_update;
        $cus->save();
        return redirect('admin/customer');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customers  $customers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customers $customers,Request $request)
    {
        //
        Customers::destroy($request->id_delete);
        return redirect('admin/customer');
    }
}
