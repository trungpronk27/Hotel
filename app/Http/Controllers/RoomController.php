<?php

namespace App\Http\Controllers;

use App\Room;
use App\Department;
use App\Role;
use App\KindOfRoom;
use App\Customers;
use App\Bill;
use App\DetailBills;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $rooms = Room::join("kind_of_rooms","kind_of_rooms.id", "=", "rooms.kindOfRoom")
                        ->select("rooms.id","kind_of_rooms.kind_of_room as kinds","rooms.kindOfRoom","rooms.name","rooms.isUsed","rooms.isCleaned","rooms.isFixed","kind_of_rooms.price as price")
                        ->orderBy("rooms.name","ASC")
                        ->paginate(9);
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
        return view('admin/room', compact('departments', 'roles', 'rooms','kindOfRooms','customers','bills','billDetails'));
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

    public function search(Request $request)
    {
        $searchs = $request->get('searchRoom');
        $data = Room::where('name','like','%'.$searchs.'%')->paginate(5);
        echo json_encode($data);
    }

    public function searchTable(Request $request)
    {   
        $searchs = $request->get('searchRoom');
        $rooms = Room::join("kind_of_rooms","kind_of_rooms.id", "=", "rooms.kindOfRoom")
                        ->select("rooms.id","kind_of_rooms.kind_of_room as kinds","rooms.kindOfRoom","rooms.name","rooms.isUsed","rooms.isCleaned","rooms.isFixed")
                        ->orderBy("rooms.name","ASC")
                    ->where('rooms.name','like','%'.$searchs.'%')->paginate(2);
        $rooms->appends(['searchRoom' => $searchs]);
        $departments = Department::join("roles","roles.id", "=", "departments.role_id")
                        ->select("departments.id", "departments.name", "roles.name as roleName")
                        ->get();
        $roles = Role::all();
        $kindOfRooms = KindOfRoom::get();
        return view('admin/room', compact('departments', 'roles', 'rooms','kindOfRooms'));
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
        $room = new Room;
        $room->kindOfRoom = $request->kindOfRoom;
        $room->name = $request->name;
        $room->save();
        return redirect('admin/rooms');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        //
        $update_room = Room::find($request->id_update);
        $update_room->name = $request->name_update;
        $update_room->kindOfRoom = $request->kind_update;
        if ($request->isUsed == null) {
            $update_room->isUsed = 0;
        } else {
            $update_room->isUsed = $request->isUsed;
        }
        if ($request->isCleaned == null) {
            $update_room->isCleaned = 0;
        } else {
            $update_room->isCleaned = $request->isCleaned;
        }
        if ($request->isFixed == null) {
            $update_room->isFixed = 0;
        } else {
            $update_room->isFixed = $request->isFixed;
        }
        $update_room->save(); 
        return redirect('admin/rooms');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room, Request $request)
    {
        //
        Room::destroy($request->id_delete);
        return redirect('admin/rooms');
    }
}
