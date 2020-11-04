<?php

namespace App\Http\Controllers;

use App\Services;
use App\Role;
use App\Department;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $kind = $request->get('kind');
        $services = Services::where('kind', "=", $kind)->paginate(5);
        $roles = Role::all();
        $departs = Department::all();
        return view("admin/services", compact('services','roles','departs','kind'));
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
        $services = new Services;
        $kind = $request->kind;
        $services->service = $request->service;
        $services->kind = $kind;
        $services->price = $request->price;
        $services->unit = $request->unit;
        $services->save();
        return redirect('admin/services?kind='.$kind);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Services  $services
     * @return \Illuminate\Http\Response
     */
    public function show(Services $services)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Services  $services
     * @return \Illuminate\Http\Response
     */
    public function edit(Services $services)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Services  $services
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Services $services)
    {
        //
        $service_update = Services::find($request->id_update);
        $kind = $request->kind_update;
        $service_update->service = $request->service_update;
        $service_update->price = $request->price_update;
        $service_update->unit = $request->unit_update;
        $service_update->save(); 
        return redirect('admin/services?kind='.$kind);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Services  $services
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        Services::destroy($request->id_delete);
        $kind = $request->kind_delete;
        return redirect('admin/services?kind='.$kind);
    }
}
