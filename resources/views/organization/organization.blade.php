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
                    <strong>Organization Manage</strong>
                    <div class="float-right">
                        <input class="btn btn-info date-picker" type="button" value="+ Add Organization" onclick="onOrganizationAdd()">    
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive m-b-40">
                        <table class="table table-borderless table-data3">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Notes</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($organizations as $organization)
                                    <tr>
                                        <td>{{$index++}}</td>
                                        <td>{{$organization->name}}</td>
                                        <td>{{$organization->notes}}</td>
                                        <td>
                                            <div class="table-data-feature">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Edit" onclick="onOrganizationEdit('{{$organization->name}}','{{$organization->notes}}','{{$organization->id}}')">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </button>
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Delete" onclick="onOrganizationDelete('{{$organization->id}}')">
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
<div class="modal fade" id="organizationModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="largeModalLabel">Add Organization</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
               <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <input type="hidden" id="organizationId" value="" />
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
                            <label for="text-input" class=" form-control-label">Notes</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="notes" name="text-input" placeholder="Notes" class="form-control " required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="handleLocation()" >Confirm</button>
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
    function onOrganizationAdd(){
        $("#largeModalLabel").html("Add Organization");
        $("#name").val('');
        $("#notes").val('');
        $("#organizationModal").modal('show');
    }
    function onOrganizationEdit(name,notes,id){
        $("#largeModalLabel").html("Edit Organization");
        $("#name").val(name);
        $("#notes").val(notes);
        $("#organizationId").val(id);
        $("#organizationModal").modal('show');
    }
    function onOrganizationDelete(id){
        if (confirm('Are you sure you want to delete this organization into the database?')) {
            $.post('organization/deleteOrganization',{
                _token: "{{ csrf_token() }}",
                id:id,
            },function(data,status){
                if(data.status == "success"){
                    alert("Organization is successfully deleted");
                    location.reload(true);
                }
            })
        } else {
            // Do nothing!
        }
    }
    function handleLocation(){
        if($("#name").val() == ""){
            toast({ 
                title : 'Warning' , 
                description : 'Input Name Field!' ,
                type : 'warning' ,
                timeout : 0
            })
        }
        else if($("#notes").val() == ""){
            toast({ 
                title : 'Warning' , 
                description : 'Input notes Field!' ,
                type : 'warning' ,
                timeout : 0
            })
        }
        else if($("#organizationId").val() == ""){
            $.post('organization/addOrganization',{
                _token: "{{ csrf_token() }}",
                name: $("#name").val(),
                notes: $("#notes").val(),
            },function(data,status){
                if(data.status == "success"){
                    alert("Organization is successfully added");
                    location.reload(true);
                }
            })
        }
        else{
            $.post('organization/editOrganization',{
                _token: "{{ csrf_token() }}",
                id: $("#organizationId").val(),
                name: $("#name").val(),
                notes: $("#notes").val(),
            },function(data,status){
                if(data.status == "success"){
                    alert("Organization is successfully edited");
                    location.reload(true);
                }
            })
        }
    }
</script>

@endsection