@extends('layouts.app')
@section('header_style')
<?php 
    $index = 1;
?>

<link rel="stylesheet" type="text/css" href="{{asset('vendor/jtoast.js-master/src/toastStyle.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendor/autocomplete/jquery.autocomplete.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendor/sweetalert2/sweetalert2.min.css')}}">
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong>Check In</strong>
                    <div class="float-right">
                        <select id="event" class="form-control">
                            
                            @foreach($events as $event)
                                <option value="{{$event->id}}">{{$event->notes}}</option>
                            @endforeach
                        </select>   
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div id="event_info" class="col-md-10">                        
                        </div>
                        <div class="col-md-2">
                            
                            <iframe src="http://free.timeanddate.com/clock/i725989y/n102/szw160/szh160/hoc000/hbw2/hfceee/cf100/hncccc/fan3/fdi76/mqc000/mql10/mqw4/mqd98/mhc000/mhl10/mhw4/mhd98/mmc000/mml10/mmw1/mmd98" frameborder="0" width="160" height="160"></iframe>

                        </div>
                    </div>
                    <br/>
                    <div id="searchContainer" >
                        
                    </div>
                    
                    <br/>
                    <div class="row">
                        <div class="col fa-hover">
                            <button type="button" class="btn btn-success btn-lg btn-block" onclick="onCheckin()"> Check In</button>
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-danger btn-lg btn-block" onclick="onCheckout()">Check Out</button>
                        </div>
                    </div>
                    <br/>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('footer_script')
<script type="text/javascript" src="{{asset('vendor/jtoast.js-master/src/toast.min.js')}}" charset="UTF-8"></script>
<script type="text/javascript" src="{{asset('vendor/autocomplete/jquery.autocomplete.js')}}" charset="UTF-8"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.full.min.js"></script>
<script type="text/javascript" src="{{asset('vendor/sweetalert2/sweetalert2.min.js')}}" charset="UTF-8"></script>
<script type="text/javascript">

    init({
        fade_in : 800 ,
        fade_out : 800 ,
        position : 'top-right'
    });
    getEvent();
    function onCheckin(){
        var searchValue = $("#searchBox").val();

        $.post('doorworker/onCheck',{
            _token: "{{ csrf_token() }}",
            id:$("#event").val(),
            user:searchValue.split('-')[0],
            usertype:searchValue.split('-')[1],
            mode:'checkin'
        },function(data,status){
            if(data.status == "success"){
                Swal.fire(
                  'Check In!',
                  'Successfuly checked in',
                  'success'
                );
            }else if(data.status == "error"){
                Swal.fire(
                  'Check In!',
                  'Already checked in ',
                  'error'
                );
            }
            else{
                Swal.fire(
                  'time error!',
                  'Already checked out',
                  'error'
                );
            }
        })
    }
    function onCheckout(){
        var searchValue = $("#searchBox").val();

        $.post('doorworker/onCheck',{
            _token: "{{ csrf_token() }}",
            id:$("#event").val(),
            user:searchValue.split('-')[0],
            usertype:searchValue.split('-')[1],
            mode:'checkout'
        },function(data,status){
            if(data.status == "success"){
                Swal.fire(
                  'Check Out!',
                  'Successfuly checked out',
                  'success'
                );
            }else if(data.status == "error"){
                Swal.fire(
                  'Check Out!',
                  'Already checked out',
                  'error'
                );
            }
            else{
                Swal.fire(
                  'time error!',
                  'Already checked out',
                  'error'
                );
            }
        })
    }
    function getEvent(){
        $.post('doorworker/getEvent',{
            _token: "{{ csrf_token() }}",
            id:$("#event").val()
        },function(data,status){
            var event = data.event;
            var htmlContent = `<div class="au-task__item au-task__item--success">
                                    <div class="au-task__item-inner">
                                        <h5 class="task">
                                            <a href="#">Title : `+event.notes+`</a>
                                        </h5>
                                        <span class="time">Timeline : `+event.startTimeStamp+` ~ `+event.endTimeStamp+`</span><br/>
                                        <span class="time">List Max Capacity : `+event.listMaxCapacity+`</span><br/>
                                        <span class="time">Plus One : `+event.plusOnes+`</span>
                                    </div>
                                </div>`;
            $("#event_info").html(htmlContent);
            console.log(data.userList);
            var searchHtmlContent = `<select  class="js-example-responsive js-states select2-hidden-accessible " style="width: 50% !important;" id="searchBox" >
                <optgroup label="Guest">`;
            var guestFlag = 0;
            for(var i = 0 ; i < data.userList.length ; i ++){
                if(data.userList[i].type == "plusone" && guestFlag == 0){
                    searchHtmlContent += `</optgroup><optgroup label="Plusone">`;
                    guestFlag  = 1;
                }
                searchHtmlContent += `<option value="`+data.userList[i].id+`-`+data.userList[i].type+`" >`+data.userList[i].name +` (`+data.userList[i].birthday+`)</option>`;
            }
            searchHtmlContent += `</optgroup></select>`;
            $("#searchContainer").html(searchHtmlContent);
            $('.js-example-responsive').select2({theme: "classic"});
        })
    }
    $("#event").change(function(){
        getEvent();
    })
</script>

@endsection