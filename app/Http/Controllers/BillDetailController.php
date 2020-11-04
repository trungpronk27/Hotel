<?php

namespace App\Http\Controllers;

use App\DetailBills;
use App\Department;
use App\Role;
use App\KindOfRoom;
use App\Customers;
use App\Bill;
use App\Room;
use Illuminate\Http\Request;

class BillDetailController extends Controller
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
        $customers = Customers::all();
        $bills = Bill::leftjoin("rooms","rooms.id", "=", "bills.rooms_id")
                        ->join("customers", "customers.id", "=", "bills.cus_id")
                        ->select("bills.id","bills.cus_id", "bills.rooms_id", "bills.time", "bills.checkin", "bills.checkout", "bills.sum", "customers.full_name as cusName", "rooms.id as idRoom", "rooms.name as roomName")
                        ->where("bills.status", "=", 0)
                        ->get();
        $kindOfRooms = KindOfRoom::all();
        $billDetails = DetailBills::leftjoin("bills","bills.id", "=", "detail_bills.bill_id")
                        ->join("services", "services.id", "=", "detail_bills.service_id")
                        ->join("rooms", "rooms.id", "=", "bills.rooms_id")
                        ->select("detail_bills.id", "rooms.name as roomName", "services.service", "detail_bills.quantity", "detail_bills.total")
                        ->paginate(10);
        return view('admin/serviceBills', compact('departments', 'roles', 'kindOfRooms','customers','bills','billDetails'));
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BillDetail  $billDetail
     * @return \Illuminate\Http\Response
     */
    public function show(BillDetail $billDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BillDetail  $billDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(BillDetail $billDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BillDetail  $billDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BillDetail $billDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BillDetail  $billDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(BillDetail $billDetail)
    {
        //
    }
}
