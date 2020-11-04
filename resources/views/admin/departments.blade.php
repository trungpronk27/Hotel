@extends('template.first')
@section('tab')
<ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro">
    <li class="active"><a data-toggle="tab" href="#Home"><i class="notika-icon notika-finance"></i>MANAGER</a>
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
    <li><a class="nav-link" href="customer"><i class="notika-icon notika-social"></i>CUSTOMER</a>
    </li>
    <li><a class="nav-link" href="recruitment"><i class="notika-icon notika-edit"></i>RECRUITMENT</a>
    </li>
</ul>
<div class="tab-content custom-menu-content">
    <div id="Home" class="tab-pane in active notika-tab-menu-bg animated flipInX">
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
                        <h4 class="modal-title">Add Department</h4>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body row">
                        <div>
                            <form id="postAdd" action="{{ asset('/manager/departments/store') }}" method="POST">
                                @csrf
                                <strong class="col-sm-2"></strong>
                                <strong class="col-sm-3" style="margin: 5px 0px;">Name*</strong>
                                <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                                <input class="col-sm-5" type="text" name="name" style="height: 25px;margin-top: 5px" id="name">
                                <strong class="col-sm-2"></strong>
                                <strong class="col-sm-3" style="margin: 5px 0px;">Role*</strong>
                                <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                                <select class="col-sm-6" style="width: 47%; height: 25px;  margin-top: 5px" name="role" id="role">
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
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
                        <h4 class="modal-title">UPDATE DEPARTMENTS</h4>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body row">
                        <form id="postUpdate" action="{{ asset('/manager/departments/update') }}" method="POST">
                            @csrf
                            <strong class="col-sm-2"></strong>
                            <strong class="col-sm-3" style="margin: 5px 0px;">ID*</strong>
                            <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                            <input class="col-sm-5" type="text" name="id_update" style="height: 25px; margin-top: 5px" id="id_update" readonly="true"><br>
                            <strong class="col-sm-2"></strong>
                            <strong class="col-sm-3" style="margin: 5px 0px;">Name*</strong>
                            <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                            <input class="col-sm-5" type="text" name="name_update" style="height: 25px; margin-top: 5px" id="name_update">
                            <strong class="col-sm-2"></strong>
                            <strong class="col-sm-3" style="margin: 5px 0px;">Role*</strong>
                            <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                            <select class="col-sm-5" style="width: 47%; height: 25px;  margin-top: 5px" name="role_update" id="role_update">
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                            </select><br>
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
                        <form id="postDelete" action="{{ asset('/manager/departments/delete') }}" method="POST">
                            @csrf
                            <input class="col-sm-1" type="text" name="id_delete" style="height: 25px; margin-top: 5px" id="id_delete" readonly="true" hidden><br>
                            <strong class="col-sm-1"></strong>
                            <strong class="col-sm-4" style="margin: 5px 0px;">Bạn có chắc muốn xóa bộ phận </strong>
                            <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                            <input class="col-sm-5" type="text" name="depart_delete" style="height: 25px; margin-top: 5px" id="depart_delete" readonly="true"><br>
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
                    <caption class="text-center"><strong>DEPARTMENT MANAGER</strong></caption>
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center"><input type="checkbox" id="checkAll" onclick="checkAllID()"></th>
                            <th class="text-center">STT</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Role</th>
                            <th class="text-center">Members</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $departments as $key => $depart)
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>{{ ($departments->currentPage()-1)*5 + $key+1 }}</td>
                            <td>{{ $depart->name }}</td>
                            <td>{{ $depart->roleName }}</td>
                            <td>
                            <?php $check = false ?>
                            @foreach( $users as $user)
                                @if( $user->depa_id == $depart->id)
                                <span class="badge">{{ $user->name }}</span>
                                <?php $check = true ?>
                                @endif
                            @endforeach
                            <?php
                                if ($check == false) {
                            ?>
                                <span class="badge">NULL</span>
                            <?php 
                                } 
                            ?>
                            </td>
                            <td >
                                <i class="fas fa-edit" data-id="{{ $depart->id}}" data-name=" {{$depart->name}} " data-role="{{ $depart->role_id }}" data-toggle="modal" data-target="#formUpdate" onclick="getUpdate(this)"></i>
                                |
                                <i class="fas fa-trash" data-id="{{ $depart->id}}" data-name=" {{$depart->name}} " data-toggle="modal" data-target="#checkDelete" onclick="getDelete(this)"></i>
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td data-toggle="modal" data-target="#add" colspan="10"><strong>Add</strong></td>
                        </tr>
                    </tbody>          
                </table>
                <tr>{{  $departments->links() }}</tr>
            </div>
                <!-- Main content -->
        </div>
    </div>
</div> 

<!-- Content Row -->
<script type="text/javascript" src="{{asset('js/jquery/jquery.js')}}"></script>
<script type="text/javascript">
    function getUpdate(depart){
        var id = depart.getAttribute("data-id").toLowerCase();
        var name = depart.getAttribute("data-name");
        var role = depart.getAttribute("data-role").toLowerCase();

        document.getElementById("id_update").value = id;
        document.getElementById("name_update").value = name; 
        document.getElementById("role_update").value = role;
    }
    function getDelete(depart){
        var id = depart.getAttribute("data-id");
        var name = depart.getAttribute("data-name");

        document.getElementById("id_delete").value = id;
        document.getElementById("depart_delete").value = name;
    }
</script>
@endsection