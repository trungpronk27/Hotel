<?php

namespace App\Http\Controllers;

use App\Bill;
use App\Room;
use App\Customers;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $bill = new Bill;
        $bill->cus_id = $request->cus_bill;
        $bill->rooms_id = $request->idroom_bill;
        $bill->time = $request->time_bill;
        $bill->checkin = $request->checkin_bill;
        $bill->checkout = Carbon::create($request->checkin_bill)->addHours($request->time_bill);
        $bill->sum = $request->price_bill * $request->time_bill; 
        $bill->save();

        $update_room = Room::find($request->idroom_bill);
        $update_room->isUsed = 1;
        $update_room->save(); 

        return redirect('admin/rooms');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function show(Bill $bill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function edit(Bill $bill, Request $request)
    {
        //
        $idGet = $request->id;
        $data['billGet'] = Bill::leftjoin("rooms","rooms.id", "=", "bills.rooms_id")
                        ->join("customers", "customers.id", "=", "bills.cus_id")
                        ->select("bills.id","bills.cus_id", "bills.rooms_id", "bills.time", "bills.checkin", "bills.checkout", "bills.sum", "customers.full_name as cusName", "rooms.id as idRoom", "rooms.name as roomName", "bills.status")
                        ->where([["bills.status", "=", "0"],
                            ["bills.id", "=", $idGet],])
                        ->get();
        $data['billGet'][0]->checkin = date("Y-m-d\TH:i", strtotime( $data['billGet'][0]->checkin));
        $data['billGet'][0]->checkout = date("Y-m-d\TH:i", strtotime( $data['billGet'][0]->checkout));
        echo json_encode($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bill $bill)
    {
        
        $bill = Bill::find($request->idbill_update);
        $bill->cus_id = $request->cus_bill_update;
        $bill->time = $request->time_bill_update;
        $bill->checkin = $request->checkin_bill_update;
        $bill->checkout = Carbon::create($request->checkin_bill_update)->addHours($request->time_bill);
        $bill->sum = $request->roomcharge * $request->time_bill_update; 
        $bill->status = $request->status;
        $bill->save();

        if ($request->status == 1) {
            $update_room = Room::find($request->idroom);
            $update_room->isUsed = 0;
            $update_room->isCleaned = 0;
            $update_room->save();
        }

        return redirect('admin/rooms');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bill $bill, Request $request)
    {
        //
        Bill::destroy($request->idBillDelete);

        $room = Room::find($request->idBillRoomDelete);
        $room->isUsed = 0;
        $room->save();
        return redirect('admin/rooms');
    }
}
