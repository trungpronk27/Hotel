<?php

namespace App\Http\Controllers;

use App\KindOfRoom;
use App\Department;
use App\User;
use App\Role;
use Illuminate\Http\Request;

class KindOfRoomController extends Controller
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
        $kinds= KindOfRoom::paginate(5);
        $roles = Role::all();
        return view('admin/kindOfRoom', compact('departments', 'roles', 'kinds'));
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
        $kind = new KindOfRoom;
        $kind->kind_of_room = $request->kind;
        $kind->price = $request->price;
        $kind->max_people = $request->maxPeople;
        $kind->save();
        return redirect('admin/kindOfRoom');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\KindOfRoom  $kindOfRoom
     * @return \Illuminate\Http\Response
     */
    public function show(KindOfRoom $kindOfRoom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\KindOfRoom  $kindOfRoom
     * @return \Illuminate\Http\Response
     */
    public function edit(KindOfRoom $kindOfRoom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\KindOfRoom  $kindOfRoom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KindOfRoom $kindOfRoom)
    {
        //
        $update_kind = KindOfRoom::find($request->id_update);
        $update_kind->kind_of_room = $request->kind_update;
        $update_kind->price = $request->price_update;
        $update_kind->max_people = $request->maxPeople_update;
        $update_kind->save(); 
        return redirect('admin/kindOfRoom');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\KindOfRoom  $kindOfRoom
     * @return \Illuminate\Http\Response
     */
    public function destroy(KindOfRoom $kindOfRoom)
    {
        //
    }
}
