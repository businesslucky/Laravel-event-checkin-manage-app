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
                    
                </div>
                <div class="card-body">
                    <div class="table-responsive m-b-40">
                        <table class="table table-borderless table-data3">
                            <thead>
                                <tr style="text-align: center;">
                                    <th>No</th>
                                    <th>Event</th>
                                    <th>Current Number of People</th>
                                    <th>Total  Number of People</th>
                                    <th>Time since event start</th>
                                    <th>Time until event end</th>
                                    <th>Percentage</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($events as $event)
                                    <tr>
                                        <td>{{$index++}}</td>
                                        <td>{{$event->notes}}</td>
                                        <td>{{$event->curnum}}</td>
                                        <td>{{$event->totalnum}}</td>
                                        <td>{{$event->sinceStart}}</td>
                                        <td>{{$event->untilEnd}}</td>
                                        <td>{{$event->percentage}}</td>
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
@endsection
@section('footer_script')
<script type="text/javascript" src="{{asset('vendor/jtoast.js-master/src/toast.min.js')}}" charset="UTF-8"></script>
<script type="text/javascript">
    init({
        fade_in : 800 ,
        fade_out : 800 ,
        position : 'top-right'
    });
</script>

@endsection