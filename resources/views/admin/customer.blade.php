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
    <li><a data-toggle="tab" href="#Rooms"><i class="notika-icon notika-windows"></i>ROOMS</a>
    </li>
    <li><a data-toggle="tab" href="#Forms"><i class="notika-icon notika-form"></i>SERVICES</a>
    </li>
    <li class="active"><a class="nav-link" href="customer"><i class="notika-icon notika-social"></i>CUSTOMER</a>
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
    <div id="Rooms" class="tab-pane notika-tab-menu-bg animated flipInX">
        <ul class="nav nav-tabs notika-main-menu-dropdown">
            <li>
                <a class="nav-link" href="/admin/rooms">ROOMS</a>
            </li>
            <li>
                <a class="nav-link" href="/admin/kindOfRoom">KIND OF ROOMS</a>
            </li>
        </ul>
    </div>
    <div id="Cus" class="tab-pane in active notika-tab-menu-bg animated flipInX">
        <ul class="nav nav-tabs notika-main-menu-dropdown">
            <li class="active">
                <a class="nav-link" href="#">CUSTOMERS</a>
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
                        <h4 class="modal-title">ADD CUSTOMER</h4>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body row">
                        <div>
                            <form id="postAdd" action="/{{ Request::path() }}/store" method="POST">
                                @csrf
                                <strong class="col-sm-2"></strong>
                                <strong class="col-sm-3" style="margin: 5px 0px;">Fullname*</strong>
                                <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                                <input class="col-sm-5" type="text" name="fullname" style="height: 25px;margin-top: 5px" id="fullname">
                                <div class="col-sm-12">
                                    <strong class="col-sm-2"></strong>
                                    <strong class="col-sm-3" style="margin: 5px 0px;">Gender*</strong>
                                    <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                                    <select class="col-sm-5" style="height: 25px;  margin-top: 5px" name="gender" id="gender">
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                                <strong class="col-sm-2"></strong>
                                <strong class="col-sm-3" style="margin: 5px 0px;">Identity*</strong>
                                <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                                <input class="col-sm-5" type="text" name="identity" style="height: 25px;margin-top: 5px" id="identity">
                                <strong class="col-sm-2"></strong>
                                <strong class="col-sm-3" style="margin: 5px 0px;">Phone*</strong>
                                <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                                <input class="col-sm-5" type="text" name="phone" style="height: 25px;margin-top: 5px" id="phone">
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
                        <h4 class="modal-title">UPDATE CUSTOMER</h4>
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
                            <strong class="col-sm-3" style="margin: 5px 0px;">Fullname*</strong>
                            <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                            <input class="col-sm-5" type="text" name="fullname_update" style="height: 25px;margin-top: 5px" id="fullname_update">
                            <div class="col-sm-12">
                                <strong class="col-sm-2"></strong>
                                <strong class="col-sm-3" style="margin: 5px 0px;">Gender*</strong>
                                <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                                <select class="col-sm-5" style="height: 25px;  margin-top: 5px" name="gender_update" id="gender_update">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <strong class="col-sm-2"></strong>
                            <strong class="col-sm-3" style="margin: 5px 0px;">Identity*</strong>
                            <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                            <input class="col-sm-5" type="text" name="identity_update" style="height: 25px;margin-top: 5px" id="identity_update">
                            <strong class="col-sm-2"></strong>
                            <strong class="col-sm-3" style="margin: 5px 0px;">Phone*</strong>
                            <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                            <input class="col-sm-5" type="text" name="phone_update" style="height: 25px;margin-top: 5px" id="phone_update">
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
                        <h4 class="modal-title">DELETE CUSTOMER</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body row">
                        <form id="postDelete" action="/{{ Request::path() }}/delete" method="POST">
                            @csrf
                            <input class="col-sm-1" type="text" name="id_delete" style="height: 25px; margin-top: 5px" id="id_delete" readonly="true" hidden><br>
                            <strong class="col-sm-2"></strong>
                            <strong class="col-sm-3" style="margin: 5px 0px;">Bạn có chắc muốn xóa khách</strong>
                            <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                            <input class="col-sm-5" type="text" name="fullname_delete" style="height: 25px; margin-top: 5px" id="fullname_delete" readonly="true"><br>
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
                    <caption class="text-center"><strong>CUSTOMER MANAGER</strong></caption>
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center"><input type="checkbox" id="checkAll" onclick="checkAllID()"></th>
                            <th class="text-center">STT</th>
                            <th class="text-center">Fullname</th>
                            <th class="text-center">Gender</th>
                            <th class="text-center">Identity</th>
                            <th class="text-center">Phone</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $customers as $key => $cus)
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>{{ ($customers->currentPage()-1)*5 + $key+1 }}</td>
                            <td>{{ $cus->full_name }}</td>
                            <td>{{ $cus->gender }}</td>
                            <td>{{ $cus->identity }}</td>
                            <td>{{ $cus->phone }}</td>
                            <td>
                                <i class="fas fa-edit" data-id="{{ $cus->id}}" data-name=" {{$cus->full_name}} " data-gender="{{ $cus->gender }}" data-identity="{{ $cus->identity }}" data-phone="{{ $cus->phone }}" data-toggle="modal" data-target="#formUpdate" onclick="getUpdate(this)"></i>
                                |
                                <i class="fas fa-trash" data-id="{{ $cus->id}}" data-name=" {{$cus->full_name}} " data-toggle="modal" data-target="#checkDelete" onclick="getDelete(this)"></i>
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td data-toggle="modal" data-target="#add" colspan="10"><strong>Add</strong></td>
                        </tr>
                    </tbody>          
                </table>
                <tr>{{  $customers->links() }}</tr>
            </div>
                <!-- Main content -->
        </div>
    </div>
</div> 

<!-- Content Row -->
<script type="text/javascript" src="{{asset('js/jquery/jquery.js')}}"></script>
<script type="text/javascript">
    function getUpdate(customer){
        var id_get = customer.getAttribute("data-id");
        var fullname_get = customer.getAttribute("data-name");
        var gender_get = customer.getAttribute("data-gender");
        var identity_get = customer.getAttribute("data-identity");
        var phone_get = customer.getAttribute("data-phone");

        document.getElementById("id_update").value = id_get;
        document.getElementById("fullname_update").value = fullname_get; 
        document.getElementById("gender_update").value = gender_get; 
        document.getElementById("identity_update").value = identity_get; 
        document.getElementById("phone_update").value = phone_get; 
    }
    function getDelete(customer){
        var id = customer.getAttribute("data-id");
        var fullname_get = customer.getAttribute("data-name");

        document.getElementById("id_delete").value = id;
        document.getElementById("fullname_delete").value = fullname_get; 
    }
</script>
@endsection