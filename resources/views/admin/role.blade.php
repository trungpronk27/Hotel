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
          <li class="nav-item active">
            <a class="nav-link" href="role">ROLES</a>
          </li>
          <li class="nav-item ">
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
            @foreach($departs as $depart)
            <li>
                <a class="nav-link" href="/admin/detailsDepart?depart={{$depart->name}}">{{ $depart->name }}</a>
            </li>
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
	<div class="tab-pane active">
		<div class="modal fade" id="add">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">ADD ROLE</h4>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body row" id="formUser">
                        <div>
                            <form id="postAdd" action="{{ asset('/manager/role/store') }}" method="POST">
                                @csrf
                                <strong class="col-sm-2"></strong>
                                <strong class="col-sm-3" style="margin: 5px 0px;">Name*</strong>
                                <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                                <input class="col-sm-5" type="text" name="name" style="height: 25px;margin-top: 5px" id="name">
                                <strong class="col-sm-2"></strong>
                                <strong class="col-sm-3" style="margin: 5px 0px;">Slug*</strong>
                                <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                                <input class="col-sm-5" type="text" name="slug" style="height: 25px; margin-top: 5px" id="email">
                                <strong class="col-sm-2"></strong>
                                <fieldset class="col-sm-10">
								  	<legend>Choose jurisdiction for this role</legend>
								    <div>
								      <input type="checkbox" id="act_user" name="juris[]" value="act-user">
								      <label for="act_user">Act-user</label>
								    </div>
								    <div>
								      <input type="checkbox" id="act_administration" name="juris[]" value="act-administration">
								      <label for="act_administration">Act-administration</label>
								    </div>
								    <div>
								      <input type="checkbox" id="act_accountant" name="juris[]" value="act-accountant">
								      <label for="act_accountant">Act-accountant</label>
								    </div>
								    <div>
								      <input type="checkbox" id="act_receptionist" name="juris[]" value="act-receptionist" >
								      <label for="act_receptionist">Act-receptionist</label>
								    </div>
								    <div>
								      <input type="checkbox" id="act_housekeeping" name="juris[]" value="act-housekeeping">
								      <label for="act_housekeeping">Act-housekeeping</label>
								    </div>
								</fieldset>
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
        <div class="col-sm-12" style="background-color: papayawhip;">
            <div class="table-responsive-md bg-light text-center">
                <table class="table col-sm-12">
                    <caption class="text-center"><strong>ROLE MANAGER</strong></caption>
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center"><input type="checkbox" id="checkAll" onclick="checkAllID()"></th>
                            <th class="text-center">STT</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Slug</th>
                            <th class="text-center">Symbols</th>
                            <th class="text-center">Role</th>
                            <th class="text-center">User</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $key => $role)
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>{{ ($roles->currentPage()-1)*5 + $key+1 }}</td>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->slug }}</td>
                            @switch($role->slug)
							    @case('manager')
							        <td><i class="fas fa-crown"></i><i class="fas fa-crown"></i></td>
							        @break

							    @case('administration')
                            		<td><i class="fas fa-crown"></i></td>
							        @break

							    @case('accountant')
                            		<td><i class="fas fa-chess-queen"></td>
                            		@break

							    @case('receptionist')
                            		<td><i class="fas fa-user"></i></td>
							        @break

							    @case('housekeeping')
                            		<td><i class="far fa-user"></i></td>
							        @break
							    @default
							        <td><i class="fas fa-times-circle"></i></td>
							@endswitch                   
                            <td>{{ $role->permissions }}</td>
                            <td class="text-left">
                                <?php $check = false?>
                            	@foreach($users as $user)
                            		@if($user->slug == $role->slug)
                            		<span class="badge">{{ $user->name }}</span>
                                    <?php $check = true ?>
                            		@endif
                            	@endforeach
                                <?php 
                                    if ($check == false) {
                                ?>
                                    <span class="badge">No User</span>
                                <?php
                                    }                                    
                                ?>
                            </td>                  
                        </tr>
                        @endforeach
                        <tr>
                            <td data-toggle="modal" data-target="#add" colspan="10"><strong>Add</strong></td>
                        </tr>
                    </tbody>          
                </table>
                <tr>{{  $roles->links() }}</tr>
            </div>
                <!-- Main content -->
        </div>
    </div>
</div> 

<!-- Content Row -->
<script type="text/javascript" src="{{asset('js/jquery/jquery.js')}}"></script>
@endsection