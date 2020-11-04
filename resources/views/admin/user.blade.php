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
          <li class="nav-item active">
            <a class="nav-link" href="user">USERS</a>
          </li>
          <li class="nav-item ">
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
                <a class="nav-link" href="/admin/services?kind=1">FOODS AND DRINKS</a>
            </li>
            <li>
                <a class="nav-link" href="/admin/services?kind=2">ENTERTAINMENT</a>
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
    <div class="tab-pane active" id="users">
        <div class="col-sm-12 text-center" style="background-color: papayawhip;">
            <div class=" d-block float-right col-sm-12">
                <div  class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div class="input-group">
                        <form action="{{ asset('/manager/user/searchTable')}}" method="GET">
                            <input type="text" class="form-control bg-light border-0 small" id="searchUser" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2"  autocomplete="off" name="searchUser" width="100%" required>
                        </form>
                    </div>
                    <div id="listUserSearch" style="position: absolute; background: #fffde7; z-index: 1000;margin-left: 50%; border-radius: 5px; text-align: center; width: 23%;">

                    </div>
                </div>
                
            </div>
            <div class="col-sm-12"> 
                @isset($searchs)
                <h3>Từ Khóa: <span style="color: red" id="tuKhoa">
                    {{$searchs}}
                </span></h3>
                @endisset
            </div>
            <div class="modal fade " id="add">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Thêm User</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body row" id="formUser">
                            <div>
                                <form id="postAdd" action="{{ asset('/manager/user/store') }}" method="POST">
                                    @csrf
                                    <strong class="col-sm-4" style="margin: 5px 0px;">Name*</strong>
                                    <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                                    <input class="col-sm-6" type="text" name="name" style="height: 25px;margin-top: 5px" id="name">
                                    <strong class="col-sm-4" style="margin: 5px 0px;">Email*</strong>
                                    <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                                    <input class="col-sm-6" type="text" name="email" style="height: 25px; margin-top: 5px" id="email"><br>
                                    <strong class="col-sm-4" style="margin: 5px 0px;">Password*</strong>
                                    <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                                    <input class="col-sm-6" type="text" name="password" style="height: 25px;  margin-top: 5px" id="password">
                                    <strong class="col-sm-4" style="margin: 5px 0px;">Role*</strong>
                                    <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                                    <select class="col-sm-6" style="width: 47%; height: 25px;  margin-top: 5px" name="role" id="role">
                                    @foreach($roles as $role)
                                        @if ($role->id != 1)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endif
                                    @endforeach
                                    </select><br>
                                    <strong class="col-sm-4" style="margin: 5px 0px;">Departments*</strong>
                                    <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                                    <select class="col-sm-6" style="width: 47%; height: 25px;  margin-top: 5px" name="depart" id="depart">
                                    @foreach($departs as $depart)
                                        <option value="{{ $depart->id }}">{{ $depart->name }}</option>\
                                    @endforeach
                                    </select><br>
                                    <strong class="col-sm-4" style="margin: 5px 0px;">Gender*</strong>
                                    <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                                    <input class="col-sm-1" type="radio" value="female" name="gender" style="margin-top: 10px"><span class="col-sm-1" style="margin-top: 5px;">Female</span>
                                    <input class="col-sm-1" type="radio" value="male" name="gender" style="margin-top: 10px" checked="checked"><span class="col-sm-1" style="margin-top: 5px;">Male</span>
                                    <input class="col-sm-1" type="radio" value="other" name="gender" style="margin-top: 10px"><span class="col-sm-1" style="margin-top: 5px;">Other</span>
                                    <strong class="col-sm-12"></strong>
                                    <div class="col-sm-12">
                                        <strong class="col-sm-4" style="margin: 5px 0px; float: left;">Phone*</strong>
                                        <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                                        <input class="col-sm-6" type="text" name="phone" style="height: 25px; margin-top: 5px" id="phone"><br>
                                    </div>
                                    <strong class="col-sm-4" style="margin: 5px 0px;">Address*</strong>
                                    <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                                    <input class="col-sm-6" type="text" name="address" style="height: 25px;  margin-top: 5px" id="address"><br>
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
            <div class="modal fade " id="formUpdate">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Cập Nhật User</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body row">
                            <form id="postUpdate" action="{{ asset('/manager/user/edit') }}" method="POST">
                                @csrf
                                <strong class="col-sm-4" style="margin: 5px 0px;">ID*</strong>
                                <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                                <input class="col-sm-6" type="text" name="id_update" style="height: 25px; margin-top: 5px" id="id_update" readonly="true"><br>
                                <strong class="col-sm-4" style="margin: 5px 0px;">Name*</strong>
                                <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                                <input class="col-sm-6" type="text" name="name_update" style="height: 25px; margin-top: 5px" id="name_update"><br>
                                <strong class="col-sm-4" style="margin: 5px 0px;">Email*</strong>
                                <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                                <input class="col-sm-6" type="text" name="email_update" style="height: 25px; margin-top: 5px" id="email_update" readonly="true"><br>
                                <strong class="col-sm-4" style="margin: 5px 0px;">Role*</strong>
                                <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                                <select class="col-sm-6" style="width: 47%; height: 25px;  margin-top: 5px" name="role_update" id="role_update">
                                @foreach($roles as $role)
                                    @if ($role->id != 1)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endif
                                @endforeach
                                </select><br>
                                <strong class="col-sm-4" style="margin: 5px 0px;">Department*</strong>
                                <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                                <select class="col-sm-6" style="width: 47%; height: 25px;  margin-top: 5px" name="depart_update" id="depart_update">
                                @foreach($departs as $depart)
                                    <option value="{{ $depart->id }}">{{ $depart->name }}</option>
                                @endforeach
                                </select><br>
                                <div class="col-sm-12">
                                    <strong class="col-sm-4" style="margin: 5px 0px;">Gender*</strong>
                                    <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                                    <select class="col-sm-6" style="height: 25px;  margin-top: 5px" name="gender_update" id="gender_update">
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                                <strong class="col-sm-4" style="margin: 5px 0px;">Phone*</strong>
                                <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                                <input class="col-sm-6" type="text" name="phone_update" style="height: 25px; margin-top: 5px" id="phone_update"><br><br>
                                <strong class="col-sm-4" style="margin: 5px 0px;">Address*</strong>
                                <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                                <input class="col-sm-6" type="text" name="address_update" style="height: 25px;  margin-top: 5px" id="address_update"><br>
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
                            <h4 class="modal-title">Xóa User</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body row">
                            <form id="postDelete" action="{{ asset('/manager/user/delete') }}" method="POST">
                                @csrf
                                <input class="col-sm-1" type="text" name="id_delete" style="height: 25px; margin-top: 5px" id="id_delete" readonly="true" hidden><br>
                                <strong class="col-sm-1"></strong>
                                <strong class="col-sm-4" style="margin: 5px 0px;">Bạn có chắc muốn xóa người dùng </strong>
                                <strong class="col-sm-1" style="margin: 5px 0px;">:</strong>
                                <input class="col-sm-5" type="text" name="name_delete" style="height: 25px; margin-top: 5px" id="name_delete" readonly="true"><br>
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
        </div>
        <div class="col-sm-12" style="background-color: papayawhip;">
            <div class="table-responsive-md bg-light text-center">
                <table class="table col-sm-12">
                    <caption class="text-center"><strong>USER MANAGER</strong></caption>
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center"><input type="checkbox" id="checkAll" onclick="checkAllID()"></th>
                            <th class="text-center">STT</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Role</th>
                            <th class="text-center">Gender</th>
                            <th class="text-center">Phone</th>
                            <th class="text-center">Address</th>
                            <th class="text-center" colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody id="load">
                        @foreach($users as $key => $user)
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>{{ ($users->currentPage()-1)*5 + $key+1 }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->name }}</td>
                            @if ($user->slug == 'manager')
                            <td><i class="fas fa-crown"></i><i class="fas fa-crown"></i></td>
                            @elseif ($user->slug == 'administration')
                            <td><i class="fas fa-crown"></i></td>
                            @elseif ($user->slug == 'accountant')
                            <td><i class="fas fa-chess-queen"></td>
                            @elseif ($user->slug == 'receptionist')
                            <td><i class="fas fa-user"></i></td>
                            @else
                            <td><i class="far fa-user"></i></td>
                            @endif                        
                            <td>{{ $user->gender }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->address }}</td>
                            <td data-id="{{ $user->id }} ">
                                @if ($user->slug != 'manager')
                                <i class="fas fa-edit" data-id="{{ $user->id}}" data-fullname="{{ $user->name }}" data-email= "{{ $user->email}}" data-role= "{{ $user->role_id }}" data-gender="{{ $user->gender }}"
                                data-phone="{{ $user->phone}}" data-address="{{$user->address}}" data-toggle="modal" data-target="#formUpdate" onclick="getUpdate(this)"></i>
                                |
                                <i class="fas fa-trash" data-id="{{ $user->id}}" data-fullname="{{ $user->name }}" data-toggle="modal" data-target="#checkDelete" onclick="getDelete(this)"></i>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td data-toggle="modal" data-target="#add" colspan="10"><strong>Add</strong></td>
                        </tr>
                    </tbody>          
                </table>
                    <tr>{{  $users->links() }}</tr>
            </div>
                <!-- Main content -->
        </div>
    </div>
</div> 

<!-- Content Row -->
<script type="text/javascript" src="{{asset('js/jquery/jquery.js')}}"></script>
<script type="text/javascript">

    $(document).ready(function(){
        $("#searchUser").keyup(function(){
            var searchUser =  $('#searchUser').val();
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if (searchUser != '') {
                $.ajaxSetup({
                     headers: {
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
                });
                $.ajax({
                    type: "GET", 
                    url: "/manager/user/search",
                    dataType : "json",
                    contentType:"application/x-www-form-urlencoded",
                    data: {
                        searchUser : searchUser
                    },
                    success: function (data) {
                        var contentSearch = "";
                        for(var i = 0; i < data.data.length; i++){
                            contentSearch += "<p style='margin : 3px;' class='ajaxList'>"+data.data[i].name+"</p>";
                        }
                        $("#listUserSearch").css("display","block");
                        $("#listUserSearch").html(contentSearch);
                        if (keycode == '27') {
                            $("#listUserSearch").css("display","none");
                        }
                        $( "body" ).click(function( event ) {
                            $("#listUserSearch").css("display","none");
                        });
                    },
                });
            }
        });
    });

    $(document).on('click','.ajaxList',function () {
        var search  = $(this).text();
        $('#searchUser').val(search);
    })
    function getUpdate(user){
        var userID = user.getAttribute("data-id");
        var userFullname = user.getAttribute("data-fullname");
        var userEmail = user.getAttribute("data-email");
        var userSlug = user.getAttribute("data-role");
        var userGender = user.getAttribute("data-gender").toLowerCase();
        var userPhone = user.getAttribute("data-phone");
        var userAddress = user.getAttribute("data-address");

        document.getElementById("id_update").value = userID;
        document.getElementById("name_update").value = userFullname;
        document.getElementById("email_update").value = userEmail;
        document.getElementById("role_update").value = userSlug;  
        document.getElementById("gender_update").value = userGender;
        document.getElementById("phone_update").value = userPhone;
        document.getElementById("address_update").value = userAddress;
    }
    function getDelete(user){
        var userID = user.getAttribute("data-id");
        var userName = user.getAttribute("data-fullname")
        document.getElementById("id_delete").value = userID;
        document.getElementById("name_delete").value = userName;
    }
</script>
@endsection