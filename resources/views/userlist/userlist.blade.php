@extends('layouts.app')
@section('header_style')
<?php 
    $index = 1;
?>

<link rel="stylesheet" type="text/css" href="{{asset('vendor/jtoast.js-master/src/toastStyle.min.css')}}">
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong>User Manage</strong>
                    <div class="float-right">
                        <input class="btn btn-info date-picker" type="button" value="+ Add User" onclick="onUserAdd()">    
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive m-b-40">
                        <table class="table table-borderless table-data3">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Birthday</th>
                                    <th>State</th>
                                    <th>Notes</th>
                                    <th>OrganizationId</th>
                                    <th>User Role</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{$index++}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->birthday}}</td>
                                        <td>
                                            <span class="role {{$user->state == 'activate' ? 'badge-success' : 'badge-danger'}}">{{$user->state}}</span>
                                        </td>
                                        <td>{{$user->notes}}</td>
                                        <td>{{$user->organizationName}}</td>
                                        <td>
                                            @if($user->role == "user")
                                                 <span class="role badge-primary">{{$user->role}}</span>
                                            @elseif($user->role == "DoorWorker")
                                                <span class="role badge-warning" >{{$user->role}}</span>
                                            @elseif($user->role == "EventManager")
                                                <span class="role badge-info">{{$user->role}}</span>
                                            @else
                                                <span class="role badge-success">{{$user->role}}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="table-data-feature">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Edit" onclick="onEditUser('{{$user->name}}','{{$user->email}}','{{$user->birthday}}','{{$user->state}}','{{$user->notes}}','{{$user->organizationID}}','{{$user->role}}','{{$user->id}}')">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </button>
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Delete" onclick="onDeleteUser('{{$user->id}}')">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>
                                            </div>
                                        </td>    
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="largeModalLabel">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
               <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <input type="hidden" id="userId" value="" />
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Name</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="name" name="text-input" placeholder="Name" class="form-control" required>
                        </div>
                    </div>
                    
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Email</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="Email" id="email" name="text-input" placeholder="Email" class="form-control "  required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Birthday</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="birthday" name="text-input" placeholder="Birthday" class="form-control " required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">State</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <select class="form-control" id="state">
                                <option></option>
                                <option value="activate">Activate</option>
                                <option value="deactivate">Deactivate</option>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Note</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="note" name="text-input" placeholder="Note" class="form-control " required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Organization</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <select class="form-control" id="organization">
                                <option></option>
                                @foreach($organizations as $organization)
                                    <option value="{{$organization->id}}">{{$organization->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <input type="hidden" id="userrole"  required value="">
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="handleUser()" >Confirm</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer_script')
<script type="text/javascript" src="{{asset('vendor/jtoast.js-master/src/toast.min.js')}}" charset="UTF-8"></script>
<script type="text/javascript">
    init({
        fade_in : 800 ,
        fade_out : 800 ,
        position : 'top-right'
    });
    function onUserAdd(){
        $("#name").val('');
        $("#email").val('');
        $("#birthday").val('');
        $("#state").val('');
        $("#note").val('');
        $("#organization").val('');
        $("#userrole").val('user');
        $("#userId").val('');
        $("#userModal").modal('show');
    }
    function onEditUser(name,email,birthday,state,notes,organizationID,role,id) {
        $("#name").val(name);
        $("#email").val(email);
        $("#birthday").val(birthday);
        $("#state").val(state);
        $("#note").val(notes);
        $("#organization").val(organizationID);
        $("#userrole").val(role);
        $("#userId").val(id);
        $("#userModal").modal('show');
    }
    function onDeleteuser(id){
        $.post('userlist/deleteUser',{
            _token: "{{ csrf_token() }}",
            id:$("#userId").val(),
        },function(data,status){
            if(data.status == "success"){
                alert("User is successfully deleted");
                location.reload(true);
            }
        })
    }
    function handleUser(){
         if($("#name").val() == ''){
            toast({ 
                title : 'Warning' , 
                description : 'Input Name Field!' ,
                type : 'warning' ,
                timeout : 0
            })
        }
        else if($("#email").val() == ''){
            toast({ 
                title : 'Warning' , 
                description : 'Input email Field!' ,
                type : 'warning' ,
                timeout : 0
            })
        }
        else if($("#birthday").val() == ''){
            toast({ 
                title : 'Warning' , 
                description : 'Input birthday Field!' ,
                type : 'warning' ,
                timeout : 0
            })
        }
        else if($("#state").val() == ''){
            toast({ 
                title : 'Warning' , 
                description : 'Input state Field!' ,
                type : 'warning' ,
                timeout : 0
            })
        }
        else if($("#note").val() == ''){
            toast({ 
                title : 'Warning' , 
                description : 'Input note Field!' ,
                type : 'warning' ,
                timeout : 0
            })
        }
        else if($("#organization").val() == ''){
            toast({ 
                title : 'Warning' , 
                description : 'Input organization Field!' ,
                type : 'warning' ,
                timeout : 0
            })
        }
        else if($("#userrole").val() == ''){
            toast({ 
                title : 'Warning' , 
                description : 'Input userrole Field!' ,
                type : 'warning' ,
                timeout : 0
            })
        }
        else if($("#userId").val() == ''){
           $.post('userlist/addUser',{
                _token: "{{ csrf_token() }}",
                name:$("#name").val(),
                email:$("#email").val(),
                birthday:$("#birthday").val(),
                state:$("#state").val(),
                notes:$("#note").val(),
                organization:$("#organization").val(),
                role:$("#userrole").val(),
                id:$("#userId").val(),
            },function(data,status){
                if(data.status == "success"){
                    alert("User is successfully added");
                    location.reload(true);
                }
            })
        }
        else{
            $.post('userlist/editUser',{
            _token: "{{ csrf_token() }}",
            name:$("#name").val(),
            email:$("#email").val(),
            birthday:$("#birthday").val(),
            state:$("#state").val(),
            notes:$("#note").val(),
            organization:$("#organization").val(),
            role:$("#userrole").val(),
            id:$("#userId").val(),
        },function(data,status){
            if(data.status == "success"){
                alert("User is successfully edited");
                location.reload(true);
            }
        })
        }
        
    }
</script>

@endsection