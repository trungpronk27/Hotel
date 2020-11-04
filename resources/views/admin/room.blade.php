@extends('template.first')
@section('tab')
<ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro">
    <li><a data-toggle="tab" href="#Home"><i class="notika-icon notika-finance"></i>MANAGER</a>
    </li>
    <li><a data-toggle="tab" href="#mailbox"><i class="notika-icon notika-house"></i>HOME</a>
    </li>
    </li>
    <li><a data-toggle="tab" href="#Interface"><i class="notika-icon notika-menus"></i>DEPARTMENT</a>
    </li>
    <li class="active"><a data-toggle="tab" href="#Rooms"><i class="notika-icon notika-windows"></i>ROOMS</a>
    </li>
    <li><a data-toggle="tab" href="#Forms"><i class="notika-icon notika-form"></i>SERVICES</a>
    </li>
    <li><a class="nav-link" href="customer"><i class="notika-icon notika-social"></i>CUSTOMER</a>
    </li>
    <li><a class="nav-link" href="recruitment"><i class="notika-icon notika-edit"></i>RECRUITMENT</a>
    </li>
</ul>
<div class="tab-content custom-menu-content">
    <div id="Home" class="tab-pane notika-tab-menu-bg animated flipInX">
        <ul class="nav nav-tabs notika-main-menu-dropdown" >
          <li class="nav-item">
            <a class="nav-link" href="user">USERS</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="role">ROLES</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="departments">DEPARTMENTS</a>
          </li>
        </ul>
    </div>   
    <div id="mailbox" class="tab-pane notika-tab-menu-bg animated flipInX">
        <ul class="nav nav-tabs notika-main-menu-dropdown">
            <li><a href="inbox.html">INTRODUCE</a>
            </li>
            <li><a href="view-email.html">NEWS</a>
            </li>
        </ul>
    </div>
    <div id="Interface" class="tab-pane notika-tab-menu-bg animated flipInX">
        <ul class="nav nav-tabs notika-main-menu-dropdown">
            @foreach($departments as $depart)
            <li><a href="/admin/detailsDepart?depart={{$depart->name}}">{{ $depart->name }}</a></li>
            @endforeach
        </ul>
    </div>
    <div id="Forms" class="tab-pane notika-tab-menu-bg animated flipInX">
        <ul class="nav nav-tabs notika-main-menu-dropdown">
            <li>
                <a class="nav-link" href="/admin/services?kind=1">FOODS AND DRINKS</a>
            </li>
            <li>
                <a class="nav-link" href="/admin/services?kind=2">ENTERTAINMENT</a>
            </li>
            <li>
                <a class="nav-link" href="/admin/serviceBills">SERVICE BILLS</a>
            </li>
        </ul>
    </div>
    <div id="Rooms" class="tab-pane in active notika-tab-menu-bg animated flipInX">
        <ul class="nav nav-tabs notika-main-menu-dropdown">
            <li class="active">
                <a class="nav-link" href="/admin/rooms">ROOMS</a>
            </li>
            <li>
                <a class="nav-link" href="/admin/kindOfRoom">KIND OF ROOMS</a>
            </li>
        </ul>
    </div>
</div>
@endsection
@section('content')
<!-- Begin Page Content -->

<!-- Page Heading -->
<!-- Content Row -->
<div class="tab-content">
    <div class="tab-pane active" id="departments">
        <div class="modal fade" id="addCus">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">ADD CUSTOMER</h4>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body row">
                        <div>
                            <form id="postCus" action="/{{ Request::path() }}/bills/store" method="POST">
                                @csrf
                                <input type="text" name="idroom_bill" id="idroom_bill" hidden>
                                <strong class="col-sm-2"></strong>
                                <strong class="col-sm-3" style="margin: 5px 0px;">Room*</strong>
                                <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                                <input class="col-sm-5" type="text" name="room_bill" style="height: 25px;margin-top: 5px" id="room_bill">
                                <div class="col-sm-12">
                                    <strong class="col-sm-2"></strong>
                                    <strong class="col-sm-3" style="margin: 5px 0px;">Customer*</strong>
                                    <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                                    <input list="listCus" name="cus_bill" class="col-sm-5" style="height: 25px;  margin-top: 5px">
                                    <datalist class="col-sm-5" id="listCus">
                                        @foreach($customers as $cus)
                                            <option value="{{ $cus->id }}">{{ $cus->full_name }}</option>
                                        @endforeach
                                    </datalist>
                                </div>
                                <strong class="col-sm-2"></strong>
                                <strong class="col-sm-3" style="margin: 5px 0px;">Time*</strong>
                                <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                                <input class="col-sm-5" type="number" name="time_bill" style="height: 25px;margin-top: 5px" id="time_bill">
                                <strong class="col-sm-2"></strong>
                                <strong class="col-sm-3" style="margin: 5px 0px;">Check in*</strong>
                                <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                                <input class="col-sm-5" type="datetime-local" name="checkin_bill" style="height: 25px;margin-top: 5px" id="checkin_bill">
                                <input type="text" name="price_bill" id="price_bill" hidden>
                            </form>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-dark"  onclick="event.preventDefault();
                        document.getElementById('postCus').submit();">
                            ADD
                        </button>
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="addSer">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">SERVICES</h4>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body row">
                        <div>
                            <!-- <form id="postCus" action="/{{ Request::path() }}/bills/store" method="POST">
                                @csrf
                                <input type="text" name="idroom_bill" id="idroom_bill" hidden>
                                <strong class="col-sm-2"></strong>
                                <strong class="col-sm-3" style="margin: 5px 0px;">Room*</strong>
                                <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                                <input class="col-sm-5" type="text" name="room_bill" style="height: 25px;margin-top: 5px" id="room_bill">
                                <div class="col-sm-12">
                                    <strong class="col-sm-2"></strong>
                                    <strong class="col-sm-3" style="margin: 5px 0px;">Customer*</strong>
                                    <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                                    <input list="listCus" name="cus_bill" class="col-sm-5" style="height: 25px;  margin-top: 5px">
                                    <datalist class="col-sm-5" id="listCus">
                                        @foreach($customers as $cus)
                                            <option value="{{ $cus->id }}">{{ $cus->full_name }}</option>
                                        @endforeach
                                    </datalist>
                                </div>
                                <strong class="col-sm-2"></strong>
                                <strong class="col-sm-3" style="margin: 5px 0px;">Time*</strong>
                                <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                                <input class="col-sm-5" type="number" name="time_bill" style="height: 25px;margin-top: 5px" id="time_bill">
                                <strong class="col-sm-2"></strong>
                                <strong class="col-sm-3" style="margin: 5px 0px;">Check in*</strong>
                                <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                                <input class="col-sm-5" type="datetime-local" name="checkin_bill" style="height: 25px;margin-top: 5px" id="checkin_bill">
                                <input type="text" name="price_bill" id="price_bill" hidden>
                            </form> -->
                            <table class="table col-sm-12">
                                <caption class="text-center"><strong>SERVICE BILLS</strong></caption>
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="text-center"><input type="checkbox" id="checkAll" onclick="checkAllID()"></th>
                                        <th class="text-center">STT</th>
                                        <th class="text-center">Room</th>
                                        <th class="text-center">Service</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach( $billDetails as $key => $billDetail)
                                    <tr>
                                        <td><input type="checkbox"></td>
                                        <td>{{ ($billDetails->currentPage()-1)*10 + $key+1 }}</td>
                                        <td>{{ $billDetail->roomName }}</td>
                                        <td>{{ $billDetail->service }}</td>
                                        <td>{{ $billDetail->quantity }}</td>
                                        <td>{{ $billDetail->total }}</td>
                                        <td>
                                            @if( $billDetail->status == 0)
                                            Chưa thanh toán
                                            @else
                                            Đã thanh toán
                                            @endif
                                        </td>

                                        <td>
                                            <i class="fas fa-edit" data-id="{{ $billDetail->id}}"></i>
                                            |
                                            <i class="fas fa-trash" data-id="{{ $billDetail->id}}"></i>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td data-toggle="modal" data-target="#add" colspan="10"><strong>Add</strong></td>
                                    </tr>
                                </tbody> 
                                <tr>{{ $billDetails->links() }}</tr>         
                            </table>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-dark"  onclick="event.preventDefault();
                        document.getElementById('postCus').submit();">
                            ADD
                        </button>
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="updateCus">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">UPDATE BILL</h4>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body row">
                        <div>
                            <form id="postBillUpdate">
                                @csrf
                                <div class="col-sm-12">
                                    <strong class="col-sm-2"></strong>
                                    <strong class="col-sm-3" style="margin: 5px 0px;">ID*</strong>
                                    <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                                    <input class="col-sm-5" type="text" name="idbill_update" id="idbill_update" readonly>
                                </div>
                                <strong class="col-sm-2"></strong>
                                <strong class="col-sm-3" style="margin: 5px 0px;">Room*</strong>
                                <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                                <input class="col-sm-5" type="text" name="room_bill_update" style="height: 25px;margin-top: 5px" id="room_bill_update" readonly>
                                <div class="col-sm-12">
                                    <strong class="col-sm-2"></strong>
                                    <strong class="col-sm-3" style="margin: 5px 0px;">Customer*</strong>
                                    <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                                    <input list="listCus" name="cus_bill_update" class="col-sm-5" style="height: 25px;  margin-top: 5px" id="cus_bill_update">
                                    <datalist class="col-sm-5" id="listCus">
                                        @foreach($customers as $cus)
                                            <option value="{{ $cus->id }}">{{ $cus->full_name }}</option>
                                        @endforeach
                                    </datalist>
                                </div>
                                <strong class="col-sm-2"></strong>
                                <strong class="col-sm-3" style="margin: 5px 0px;">Time*</strong>
                                <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                                <input class="col-sm-5" type="number" name="time_bill_update" style="height: 25px;margin-top: 5px" id="time_bill_update">
                                <strong class="col-sm-2"></strong>
                                <strong class="col-sm-3" style="margin: 5px 0px;">Check in*</strong>
                                <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                                <input class="col-sm-5" type="datetime-local" name="checkin_bill_update" style="height: 25px;margin-top: 5px" id="checkin_bill_update">
                                <strong class="col-sm-2"></strong>
                                <strong class="col-sm-3" style="margin: 5px 0px;">Check out*</strong>
                                <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                                <input class="col-sm-5" type="datetime-local" name="checkout_bill" style="height: 25px;margin-top: 5px" id="checkout_bill" readonly>
                                <strong class="col-sm-2"></strong>
                                <strong class="col-sm-3" style="margin: 5px 0px;">Price*</strong>
                                <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                                <input class="col-sm-5" type="text" name="price_bill_update" style="height: 25px;margin-top: 5px" id="price_bill_update" readonly>
                                <div class="col-sm-12">
                                    <strong class="col-sm-2"></strong>
                                    <strong class="col-sm-3" style="margin: 5px 0px;">Status*</strong>
                                    <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                                    <select name="status" id="status" class="col-sm-5">
                                        <option value="0">Chưa thanh toán</option>
                                        <option value="1">Đã Thanh Toán</option>
                                    </select>
                                </div>
                                <input type="text" name="roomcharge" id="roomcharge" hidden>
                                <input type="text" name="idroom" id="idroom" hidden>
                            </form>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-dark"  onclick="event.preventDefault();
                        document.getElementById('postBillUpdate').submit();">
                            Update
                        </button>
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="deleteBillForm">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">DELETE BILL</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body row">
                        <form id="postDeleteBill" action="/{{ Request::path() }}/bills/delete" method="POST">
                            @csrf
                            <input class="col-sm-1" type="text" name="idBillDelete" style="height: 25px; margin-top: 5px" id="idBillDelete" readonly="true" hidden><br>
                            <input class="col-sm-1" type="text" name="idBillRoomDelete" style="height: 25px; margin-top: 5px" id="idBillRoomDelete" readonly="true" hidden><br>
                            <strong class="col-sm-1"></strong>
                            <strong class="col-sm-4" style="margin: 5px 0px;">Bạn có chắc muốn xóa đơn ?</strong>
                        </form>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark"  data-dismiss="modal" onclick="event.preventDefault();document.getElementById('postDeleteBill').submit();">
                            Delete
                        </button>
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="add">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">ADD ROOM</h4>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body row">
                        <div>
                            <form id="postAdd" action="/{{ Request::path() }}/store" method="POST">
                                @csrf
                                <strong class="col-sm-2"></strong>
                                <strong class="col-sm-3" style="margin: 5px 0px;">Name*</strong>
                                <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                                <input class="col-sm-5" type="text" name="name" style="height: 25px;margin-top: 5px" id="name">
                                <strong class="col-sm-2"></strong>
                                <strong class="col-sm-3" style="margin: 5px 0px;">Kind*</strong>
                                <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                                <select class="col-sm-6" style="width: 47%; height: 25px;  margin-top: 5px" name="kindOfRoom" id="kindOfRoom">
                                @foreach($kindOfRooms as $kind)
                                    <option value="{{ $kind->id }}">{{ $kind->kind_of_room }}</option>
                                @endforeach
                                </select><br>
                            </form>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-dark"  onclick="event.preventDefault();
                        document.getElementById('postAdd').submit();">
                            Thêm
                        </button>
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="formUpdate">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">UPDATE ROOMS</h4>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body row">
                        <form id="postUpdate" action="/{{ Request::path() }}/update" method="POST">
                            @csrf
                            <strong class="col-sm-1"></strong>
                            <strong class="col-sm-3" style="margin: 5px 0px;">ID*</strong>
                            <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                            <input class="col-sm-5" type="text" name="id_update" style="height: 25px; margin-top: 5px" id="id_update" readonly="true"><br>
                            <div class="col-sm-12">
                                <strong class="col-sm-1"></strong>
                                <strong class="col-sm-3" style="margin: 5px 0px;">Name*</strong>
                                <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                                <input class="col-sm-5" type="text" name="name_update" style="height: 25px; margin-top: 5px" id="name_update">
                            </div>
                            <strong class="col-sm-1"></strong>
                            <strong class="col-sm-3" style="margin: 5px 0px;">Kind*</strong>
                            <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                            <select class="col-sm-5" style="width: 47%; height: 25px;  margin-top: 5px" name="kind_update" id="kind_update">
                            @foreach($kindOfRooms as $kind)
                                <option value="{{ $kind->id }}">{{ $kind->kind_of_room }}</option>
                            @endforeach
                            </select>
                            <div class="col-sm-12">
                                <strong class="col-sm-1"></strong>
                                <input type="checkbox" id="isUsed" name="isUsed" value="1" class="col-sm-1">
                                <label for="isUsed" class="col-sm-2">IS BEING USED</label>
                                <input type="checkbox" id="isCleaned" name="isCleaned" value="1" class="col-sm-1">
                                <label for="isCleaned" class="col-sm-2">IS CLEANED</label>
                                <input type="checkbox" id="isFixed" name="isFixed" value="1" class="col-sm-1">
                                <label for="isFixed" class="col-sm-2">IS BEING FIXED</label><br>
                            </div>
                        </form>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark"  data-dismiss="modal" onclick="event.preventDefault();document.getElementById('postUpdate').submit();">
                            Update
                        </button>
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="checkDelete">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">DELETE ROOM</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body row">
                        <form id="postDelete" action="/{{ Request::path() }}/delete" method="POST">
                            @csrf
                            <input class="col-sm-1" type="text" name="id_delete" style="height: 25px; margin-top: 5px" id="id_delete" readonly="true" hidden><br>
                            <strong class="col-sm-1"></strong>
                            <strong class="col-sm-4" style="margin: 5px 0px;">Bạn có chắc muốn xóa phòng </strong>
                            <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                            <input class="col-sm-5" type="text" name="room_delete" style="height: 25px; margin-top: 5px" id="room_delete" readonly="true"><br>
                        </form>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark"  data-dismiss="modal" onclick="event.preventDefault();document.getElementById('postDelete').submit();">
                            Delete
                        </button>
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 text-center" style="background-color: papayawhip;">
            <div class="col-sm-7" style="margin: 10px 0px 10px 20px">
                <div class="col-sm-1 noteFree"></div>
                <div class="col-sm-2"> FREE</div>
                <div class="col-sm-1 noteUsed"></div>
                <div class="col-sm-2"> USED</div>
                <div class="col-sm-1 noteCleaned"></div>
                <div class="col-sm-2"> DIRTY</div>
                <div class="col-sm-1 noteFixed"></div>
                <div class="col-sm-2"> FIXED</div>
            </div>
            <div class="col-sm-4" style="margin: 10px 0px 10px 20px">
                <div class=" d-block float-right col-sm-12">
                    <div  class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <form action="/{{ Request::path() }}/searchTable" method="GET">
                                <input type="text" class="form-control bg-light border-0 small" id="searchRoom" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2"  autocomplete="off" name="searchRoom" width="100%" required>
                            </form>
                        </div>
                        <div id="listRoom" style="position: absolute; background: #fffde7; z-index: 1000;margin-left: 25%; border-radius: 5px; text-align: center; width: 50%;">

                        </div>
                    </div>
                    
                </div>
            </div><br>
            @foreach($rooms as $key => $room)
                @if($room->isFixed == 0)
                    @if($room->isUsed ==0)
                        @if($room->isCleaned == 0)
                            <div class="room needclean col-sm-2">
                                <strong>
                                {{ $room->name }}
                                |
                                {{ $room->kinds }}
                                </strong><br>
                                <div class="actRoom">
                                    <p style="font-weight: bold">Room {{ $room->name }}</p>
                                    <i class="fas fa-edit" data-id="{{ $room->id}}" data-name=" {{$room->name}} " data-kind="{{ $room->kindOfRoom }}" data-isUsed="{{$room->isUsed}}" data-isCleaned="{{$room->isCleaned}}" data-isFixed="{{$room->isFixed}}" data-toggle="modal" data-target="#formUpdate" onclick="getUpdate(this)" title="Update Room"></i>
                                    |
                                    <i class="fas fa-trash" data-id="{{ $room->id}}" data-name=" {{$room->name}} " data-toggle="modal" data-target="#checkDelete" onclick="getDelete(this)" title="Delete room"></i>
                                </div>
                            </div>
                        @else
                            <div class="room col-sm-2">
                                <strong>
                                {{ $room->name }}
                                |
                                {{ $room->kinds }}
                                </strong><br>
                                <div class="actRoom">
                                    <p style="font-weight: bold">Room {{ $room->name }}</p>
                                    <i class="fas fa-user-plus" data-id="{{ $room->id}}" data-name=" {{$room->name}}" data-price="{{$room->price}}" data-toggle="modal" data-target="#addCus" onclick="getRoom(this)"></i>
                                    |
                                    <i class="fas fa-edit" data-id="{{ $room->id}}" data-name=" {{$room->name}} " data-kind="{{ $room->kindOfRoom }}" data-isUsed="{{$room->isUsed}}" data-isCleaned="{{$room->isCleaned}}" data-isFixed="{{$room->isFixed}}" data-toggle="modal" data-target="#formUpdate" onclick="getUpdate(this)" title="Update Room"></i>
                                    |
                                    <i class="fas fa-trash" data-id="{{ $room->id}}" data-name=" {{$room->name}} " data-toggle="modal" data-target="#checkDelete" onclick="getDelete(this)" title="Delete room"></i>
                                </div>
                            </div>
                        @endif
                    @else
                        <div class="room isused col-sm-2">
                            <strong>
                            {{ $room->name }}
                            |
                            {{ $room->kinds }}
                            </strong><br>
                            <div class="actRoom">
                                <p style="font-weight: bold">Room {{ $room->name }}</p>
                                <i class="far fa-plus-square" data-toggle="modal" data-target="#addSer" title="Add Service"></i>
                                |
                                @foreach($bills as $bill)
                                    @if($bill->rooms_id == $room->id)
                                    <i class="fas fa-user-edit updateBill" data-idbill="{{ $bill->id }}"data-toggle="modal" data-price="{{$room->price}}" data-target="#updateCus" title="Update Bill" id="activeUpdate"></i>
                                    |
                                    <i class="fas fa-user-slash deleteBill" data-idbill="{{ $bill->id }}" data-idroom="{{ $room->id}}" data-toggle="modal" data-target="#deleteBillForm" title="Delete Bill" id="activeDelete" onclick="getDeleteBill(this)"></i>
                                    @endif
                                @endforeach
                                |
                                <i class="fas fa-edit" data-id="{{ $room->id}}" data-name=" {{$room->name}} " data-kind="{{ $room->kindOfRoom }}" data-isUsed="{{$room->isUsed}}" data-isCleaned="{{$room->isCleaned}}" data-isFixed="{{$room->isFixed}}" data-toggle="modal" data-target="#formUpdate" onclick="getUpdate(this)" title="Update Room"></i>
                            </div>
                        </div>
                    @endif
                @else
                    <div class="room isfixed col-sm-2">
                        <strong>
                        {{ $room->name }}
                        |
                        {{ $room->kinds }}
                        </strong><br>
                        <div class="actRoom">
                            <p style="font-weight: bold">Room {{ $room->name }}</p>
                            <i class="fas fa-edit" data-id="{{ $room->id}}" data-name=" {{$room->name}} " data-kind="{{ $room->kindOfRoom }}" data-isUsed="{{$room->isUsed}}" data-isCleaned="{{$room->isCleaned}}" data-isFixed="{{$room->isFixed}}" data-toggle="modal" data-target="#formUpdate" onclick="getUpdate(this)" title="Update Room"></i>
                            |
                            <i class="fas fa-trash" data-id="{{ $room->id}}" data-name=" {{$room->name}} " data-toggle="modal" data-target="#checkDelete" onclick="getDelete(this)" title="Delete room"></i>
                        </div>
                    </div>
                @endif
            @endforeach
            <div class="room col-sm-2" data-toggle="modal" data-target="#add">
                <i class="notika-icon notika-plus-symbol" style="font-size: 20px;"></i>
            </div>
            <div class="col-sm-12">
                {{ $rooms->links() }}
            </div>
            
            <!-- Main content -->
        </div>
    </div>
</div> 

<!-- Content Row -->
<script type="text/javascript" src="{{asset('js/jquery/jquery.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#searchRoom").keyup(function(){
            var searchRoom =  $('#searchRoom').val();
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if (searchRoom != '') {
                $.ajaxSetup({
                     headers: {
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
                });
                $.ajax({
                    type: "GET", 
                    url: "/{{ Request::path() }}/search",
                    dataType : "json",
                    contentType:"application/x-www-form-urlencoded",
                    data: {
                        searchRoom : searchRoom
                    },
                    success: function (data) {
                        var contentSearch = "";
                        for(var i = 0; i < data.data.length; i++){
                            contentSearch += "<p style='margin : 3px;' class='ajaxList'>"+data.data[i].name+"</p>";
                        }
                        $("#listRoom").css("display","block");
                        $("#listRoom").html(contentSearch);
                        if (keycode == '27') {
                            $("#listRoom").css("display","none");
                        }
                        $( "body" ).click(function( event ) {
                            $("#listRoom").css("display","none");
                        });
                    },
                });
            }
        });
    });

    $('.updateBill').click(function(){
        var id = $(this).data('idbill');
        var price = $(this).data('price');
        $('#postBillUpdate').attr({'action': '/{{ Request::path() }}/bills/update',
                                    'method': 'POST'});

        $.ajax({
            url : '/{{ Request::path() }}/bills/edit/' + id,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method : "GET",
            dataType: "json",
            success: function(data){
                console.log(data);
                for(var i = 0; i < data.billGet.length ; i++) {
                    $('#idbill_update').val(data.billGet[i].id);
                    $('#room_bill_update').val(data.billGet[i].roomName);
                    $('#cus_bill_update').val(data.billGet[i].cus_id);
                    $('#time_bill_update').val(data.billGet[i].time);
                    $('#checkin_bill_update').val(data.billGet[i].checkin);
                    $('#checkout_bill').val(data.billGet[i].checkout);
                    $('#price_bill_update').val(data.billGet[i].sum);
                    $('#roomcharge').val(price);
                    $('#status').val(data.billGet[i].status);
                    $('#idroom').val(data.billGet[i].rooms_id);
                }
            }
        });
    });

    $(document).on('click','.ajaxList',function () {
        var search  = $(this).text();
        $('#searchRoom').val(search);
    })

    function getUpdate(room){
        var id = room.getAttribute("data-id");
        var name = room.getAttribute("data-name");
        var kindOfRoom = room.getAttribute("data-kind");
        var isUsed = room.getAttribute("data-isUsed");
        var isCleaned = room.getAttribute("data-isCleaned");
        var isFixed = room.getAttribute("data-isFixed");

        document.getElementById("id_update").value = id;
        document.getElementById("name_update").value = name; 
        document.getElementById("kind_update").value = kindOfRoom;
        if (isUsed == 1) {
            document.getElementById("isUsed").checked = true;
        }
        if (isCleaned == 1) {
            document.getElementById("isCleaned").checked = true;
        }
        if (isFixed == 1) {
            document.getElementById("isFixed").checked = true;
        }
    }
    function getDelete(room){
        var id = room.getAttribute("data-id");
        var name = room.getAttribute("data-name");

        document.getElementById("id_delete").value = id;
        document.getElementById("room_delete").value = name;
    }
    function getRoom(room){
        var id = room.getAttribute("data-id");
        var name = room.getAttribute("data-name");
        var price = room.getAttribute("data-price");

        document.getElementById("idroom_bill").value = id;
        document.getElementById("room_bill").value = name;
        document.getElementById("price_bill").value = price;
    }
    function getDeleteBill(bill){
        var idBill = bill.getAttribute("data-idbill");
        var idRoom = bill.getAttribute("data-idroom");
        document.getElementById("idBillDelete").value = idBill;
        document.getElementById("idBillRoomDelete").value = idBill;
    }
</script>
@endsection