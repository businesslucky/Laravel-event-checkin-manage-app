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
                    <strong>Add Plusone</strong>
                    <div class="float-right">
                        <input class="btn btn-info date-picker" type="button" value="+ Add Plusone" onclick="onInvite()">    
                    </div>
                </div>
                <div class="card-body">
                    <div class="au-task__item au-task__item--success">
                        <div class="au-task__item-inner">
                            <h5 class="task">
                                <a href="#">Title : {{$event->notes}}</a>
                            </h5>
                            <span class="time">Timeline : {{$event->startTimeStamp}} ~ {{$event->endTimeStamp}}</span><br/>
                            <span class="time">List Max Capacity : {{$event->listMaxCapacity}}</span><br/>
                            <span class="time">Plus One : {{$event->plusOnes}}</span>
                        </div>
                    </div>
                    <br/>
                    <div class="table-responsive m-b-40">
                        <table class="table table-borderless table-data3">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Notes</th>
                                    <th>Birthday</th>
                                    <th>Type</th>
                                    <th>InvitedBy</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inviteLists as $inviteList)
                                    <tr>
                                        <td>{{$index++}}</td>
                                        <td>{{$inviteList->detail->name}}</td>
                                        <td>{{$inviteList->notes}}</td>
                                        <td>{{$inviteList->detail->birthday}}</td>
                                        <td>{{$inviteList->type}}</td>
                                        <td>{{$inviteList->invite_detail->name}}</td>
                                        <td>
                                            @if($inviteList->permission == true)
                                                <div class="table-data-feature">
                                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Edit" onclick="onGuestEdit('{{$inviteList->detail->name}}','{{$inviteList->notes}}','{{$inviteList->detail->birthday}}','{{$inviteList->id}}','{{$inviteList->detail->id}}')">
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </button>
                                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Delete" onclick="onGuestDelete('{{$inviteList->id}}')">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button>
                                                </div>
                                            @endif
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
<div class="modal fade" id="inviteModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="largeModalLabel">Invite</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
               <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <input type="hidden" id="inviteId" value="" />
                    <input type="hidden" id="plusid" value="" />
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Name</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="name" name="text-input" placeholder="Name" class="form-control "  required>
                        </div>
                    </div>
                    
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Notes</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="notes" name="text-input" placeholder="Notes" class="form-control "  required>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Birthday</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="birthday" name="text-input" placeholder="Birthday" class="form-control "  required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="handleInvite()" >Confirm</button>
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
    function onInvite(){
        $("#name").val('');
        $("#notes").val('');
        $("#birthday").val('');
        $("#inviteModal").modal('show');
    }
    function onGuestEdit(guestId,notes,birthday,id,plusid){
        $("#name").val(guestId);
        $("#notes").val(notes);
        $("#inviteId").val(id);
        $("#plusid").val(plusid);
        $("#birthday").val(birthday);
        $("#inviteModal").modal('show');
    }
    function onGuestDelete(id){
        if (confirm('Are you sure you want to delete this user into the database?')) {
            $.post('deleteInvite',{
                _token: "{{ csrf_token() }}",
                id:id,
            },function(data,status){
                if(data.status == "success"){
                    alert("Guest is successfully deleted");
                    location.reload(true);
                }
            })
        } else {
            // Do nothing!
        }
    }
    function handleInvite(  ){
        if($('#name').val() == ""){
            toast({ 
                title : 'Warning' , 
                description : 'Input Name Field!' ,
                type : 'warning' ,
                timeout : 0
            })
        }
        else if($('#birthday').val() == ""){
            toast({ 
                title : 'Warning' , 
                description : 'Input Type Field!' ,
                type : 'warning' ,
                timeout : 0
            })
        }
        else if($('#notes').val() == ""){
            toast({ 
                title : 'Warning' , 
                description : 'Input Notes Field!' ,
                type : 'warning' ,
                timeout : 0
            })
        }
        else if($('#inviteId').val() == ""){
            $.post('addInvite',{
                _token: "{{ csrf_token() }}",
                id:$("#name").val(),
                type:'plusone',
                notes:$("#notes").val(),
                birthday:$("#birthday").val(),
                eventId:"{{$event->id}}"
            },function(data,status){
                if(data.status == "success"){
                    alert("user is successfully invited.");
                    location.reload(true);
                }
                else{
                    alert(data.status);
                }
            })
        }
        else{
            $.post('editInvite',{
                _token: "{{ csrf_token() }}",
                id:$("#name").val(),
                type:'plusone',
                notes:$("#notes").val(),
                birthday:$("#birthday").val(),
                eventId:"{{$event->id}}",
                invite_id:$("#inviteId").val(),
                plusid:$("#plusid").val()
            },function(data,status){
                if(data.status == "success"){
                    alert("user is successfully edited.");
                    location.reload(true);
                }
            })
        }
    }
</script>

@endsection