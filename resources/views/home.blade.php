@extends('layouts.app')
@section('header_style')
<?php 
    $index = 1;
?>
<link href="{{asset('vendor/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" media="screen">
<link rel="stylesheet" type="text/css" href="{{asset('vendor/jtoast.js-master/src/toastStyle.min.css')}}">
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Upcoming Events</div>

                <div class="card-body">
                    <div class="table-responsive m-b-40">
                        <table class="table table-borderless table-data3">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Notes</th>
                                    <th>StartTime</th>
                                    <th>Info</th>
                                    <th>Location</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($events as $event)
                                    <tr>
                                        <td>{{$index++}}</td>
                                        <td>{{$event->notes}}</td>
                                        <td>{{$event->startTimeStamp}}</td>
                                        <td>{{$event->totalGuest}} guests invited</td>
                                        <td>{{$event->locationName}}</td>
                                        <td>
                                                <div class="table-data-feature">
                                                    <a class="item" data-toggle="tooltip" data-placement="top" title="Add Plusone" href="upcomingEvents/plusone/{{$event->id}}">
                                                        <i class="zmdi zmdi-more"></i>
                                                    </a>
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
@endsection
@section('footer_script')

 
<script type="text/javascript" src="{{asset('vendor/jtoast.js-master/src/toast.min.js')}}" charset="UTF-8"></script>
<script type="text/javascript" src="{{asset('vendor/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.js')}}" charset="UTF-8"></script>
<script type="text/javascript" src="{{asset('vendor/bootstrap-datetimepicker-master/js/locales/bootstrap-datetimepicker.fr.js')}}" charset="UTF-8"></script>

@endsection