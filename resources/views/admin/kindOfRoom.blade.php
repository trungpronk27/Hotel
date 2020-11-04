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
                <a class="nav-link" href="/admin/services?kind=1">Foods And Drinks</a>
            </li>
            <li>
                <a class="nav-link" href="/admin/services?kind=2">Entertainment</a>
            </li>
        </ul>
    </div>
    <div id="Rooms" class="tab-pane in active notika-tab-menu-bg animated flipInX">
        <ul class="nav nav-tabs notika-main-menu-dropdown">
            <li>
                <a class="nav-link" href="/admin/rooms">ROOMS</a>
            </li>
            <li class="active">
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
		<div class="modal fade" id="add">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">ADD KIND OF ROOM</h4>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body row">
                        <div>
                            <form id="postAdd" action="/{{ Request::path() }}/store" method="POST">
                                @csrf
                                <strong class="col-sm-2"></strong>
                                <strong class="col-sm-3" style="margin: 5px 0px;">Kind*</strong>
                                <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                                <input class="col-sm-5" type="text" name="kind" style="height: 25px;margin-top: 5px" id="kind">
                                <strong class="col-sm-2"></strong>
                                <strong class="col-sm-3" style="margin: 5px 0px;">Price*</strong>
                                <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                                <input class="col-sm-5" type="number" id="price" name="price" min="500000" max="5000000" step="50000" style="height: 25px;margin-top: 5px">
                                <div class="col-sm-12">
                                    <strong class="col-sm-2"></strong>
                                    <strong class="col-sm-3" style="margin: 5px 0px;">Max People*</strong>
                                    <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                                    <input class="col-sm-5" type="number" id="maxPeople" name="maxPeople" min="1" max="10" style="height: 25px;margin-top: 5px">
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-dark" onclick="event.preventDefault();
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
                        <h4 class="modal-title">UPDATE KIND</h4>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body row">
                        <form id="postUpdate" action="/{{ Request::path() }}/update" method="POST">
                            @csrf
                            <strong class="col-sm-2"></strong>
                            <strong class="col-sm-3" style="margin: 5px 0px;">ID*</strong>
                            <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                            <input class="col-sm-5" type="text" name="id_update" style="height: 25px;margin-top: 5px" id="id_update" readonly>
                            <strong class="col-sm-2"></strong>
                            <strong class="col-sm-3" style="margin: 5px 0px;">Kind*</strong>
                            <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                            <input class="col-sm-5" type="text" name="kind_update" style="height: 25px;margin-top: 5px" id="kind_update">
                            <strong class="col-sm-2"></strong>
                            <strong class="col-sm-3" style="margin: 5px 0px;">Price*</strong>
                            <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                            <input class="col-sm-5" type="number" id="price_update" name="price_update" min="500000" max="5000000" step="50000" style="height: 25px;margin-top: 5px">
                            <div class="col-sm-12">
                                <strong class="col-sm-2"></strong>
                                <strong class="col-sm-3" style="margin: 5px 0px;">Max People*</strong>
                                <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                                <input class="col-sm-5" type="number" id="maxPeople_update" name="maxPeople_update" min="1" max="10" style="height: 25px;margin-top: 5px">
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
                        <h4 class="modal-title">DELETE DEPARTMENT</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body row">
                        <form id="postDelete" action="/{{ Request::path() }}/delete" method="POST">
                            @csrf
                            <input class="col-sm-1" type="text" name="id_delete" style="height: 25px; margin-top: 5px" id="id_delete" readonly="true" hidden><br>
                            <strong class="col-sm-2"></strong>
                            <strong class="col-sm-3" style="margin: 5px 0px;">Bạn có chắc muốn xóa phòng loại</strong>
                            <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                            <input class="col-sm-5" type="text" name="kind_delete" style="height: 25px; margin-top: 5px" id="kind_delete" readonly="true"><br>
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
        <div class="col-sm-12" style="background-color: papayawhip;">
            <div class="table-responsive-md bg-light text-center">
                <table class="table col-sm-12">
                    <caption class="text-center"><strong>KINDS OF ROOM</strong></caption>
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center"><input type="checkbox" id="checkAll" onclick="checkAllID()"></th>
                            <th class="text-center">STT</th>
                            <th class="text-center">Kind</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Max People</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $kinds as $key => $kind)
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>{{ ($kinds->currentPage()-1)*5 + $key+1 }}</td>
                            <td>{{ $kind->kind_of_room }}</td>
                            <td>{{ $kind->price }}</td>
                            <td>{{ $kind->max_people }}</td>
                            <td>
                                <i class="fas fa-edit" data-id="{{ $kind->id}}" data-kind=" {{$kind->kind_of_room}} " data-price="{{ $kind->price }}" data-maxPeople="{{ $kind->max_people }}" data-toggle="modal" data-target="#formUpdate" onclick="getUpdate(this)"></i>
                                |
                                <i class="fas fa-trash" data-id="{{ $kind->id}}" data-kind=" {{$kind->kind_of_room}} " data-toggle="modal" data-target="#checkDelete" onclick="getDelete(this)"></i>
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td data-toggle="modal" data-target="#add" colspan="10"><strong>Add</strong></td>
                        </tr>
                    </tbody>          
                </table>
                <tr>{{  $kinds->links() }}</tr>
            </div>
                <!-- Main content -->
        </div>
    </div>
</div> 

<!-- Content Row -->
<script type="text/javascript" src="{{asset('js/jquery/jquery.js')}}"></script>
<script type="text/javascript">
    function getUpdate(kindOfRoom){
        var id_get = kindOfRoom.getAttribute("data-id");
        var kind_get = kindOfRoom.getAttribute("data-kind");
        var price_get = kindOfRoom.getAttribute("data-price");
        var maxPeople_get = kindOfRoom.getAttribute("data-maxPeople");

        document.getElementById("id_update").value = id_get;
        document.getElementById("kind_update").value = kind_get; 
        document.getElementById("price_update").value = price_get; 
        document.getElementById("maxPeople_update").value = maxPeople_get; 
    }
    function getDelete(kindOfRoom){
        var id = kindOfRoom.getAttribute("data-id");
        var kind_get = kindOfRoom.getAttribute("data-kind");

        document.getElementById("id_delete").value = id;
        document.getElementById("kind_delete").value = kind_get; 
    }
</script>
@endsection