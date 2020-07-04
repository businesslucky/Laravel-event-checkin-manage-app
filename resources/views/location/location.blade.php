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
                    <strong>Location Manage</strong>
                    <div class="float-right">
                        <input class="btn btn-info date-picker" type="button" value="+ Add Location" onclick="onLocationAdd()">    
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive m-b-40">
                        <table class="table table-borderless table-data3">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Lat</th>
                                    <th>Lon</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($locations as $location)
                                    <tr>
                                        <td>{{$index++}}</td>
                                        <td>{{$location->name}}</td>
                                        <td>{{$location->lat}}</td>
                                        <td>{{$location->lon}}</td>
                                        <td>
                                            <div class="table-data-feature">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Edit" onclick="onLocationEdit('{{$location->name}}','{{$location->lat}}','{{$location->lon}}','{{$location->id}}')">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </button>
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Delete" onclick="onLocationDelete('{{$location->id}}')">
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
<div class="modal fade" id="locationModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="largeModalLabel">Add Location</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
               <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <input type="hidden" id="locationId" value="" />
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
                            <label for="text-input" class=" form-control-label">Lat</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="number" id="lat" name="text-input" placeholder="Lat" class="form-control "  required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Lon</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="number" id="lon" name="text-input" placeholder="Lon" class="form-control " required>
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
    function onLocationAdd(){
        $("#largeModalLabel").html("Add Location");
        $("#name").val('');
        $("#lat").val('');
        $("#lon").val('');
        $("#locationModal").modal('show');
    }
    function onLocationEdit(name,lat,lon,id){
        $("#largeModalLabel").html("Edit Location");
        $("#name").val(name);
        $("#lat").val(lat);
        $("#lon").val(lon);
        $("#locationId").val(id);
        $("#locationModal").modal('show');
    }
    function onLocationDelete(id){
        if (confirm('Are you sure you want to delete this location into the database?')) {
            $.post('location/deleteLocation',{
                _token: "{{ csrf_token() }}",
                id:id,
            },function(data,status){
                if(data.status == "success"){
                    alert("Location is successfully deleted");
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
        else if($("#lat").val() == ""){
            toast({ 
                title : 'Warning' , 
                description : 'Input Lat Field!' ,
                type : 'warning' ,
                timeout : 0
            })
        }
        else if($("#lon").val() == ""){
            toast({ 
                title : 'Warning' , 
                description : 'Input Lon Field!' ,
                type : 'warning' ,
                timeout : 0
            })
        }
        else if($("#locationId").val() == ""){
            $.post('location/addLocation',{
                _token: "{{ csrf_token() }}",
                name: $("#name").val(),
                lat: $("#lat").val(),
                lon: $("#lon").val(),
            },function(data,status){
                if(data.status == "success"){
                    alert("Location is successfully added");
                    location.reload(true);
                }
            })
        }
        else{
            $.post('location/editLocation',{
                _token: "{{ csrf_token() }}",
                id: $("#locationId").val(),
                name: $("#name").val(),
                lat: $("#lat").val(),
                lon: $("#lon").val(),
            },function(data,status){
                if(data.status == "success"){
                    alert("Location is successfully edited");
                    location.reload(true);
                }
            })
        }
    }
</script>

@endsection