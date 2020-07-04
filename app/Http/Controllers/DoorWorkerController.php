<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DateTime;

class DoorWorkerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$events = DB::table('event')->get();
    	$locations = DB::table('location')->get();
    	$eventLocations = DB::table('eventlocation')->get();
    	foreach ($events as  $event) {
    		foreach ($eventLocations as $eventLocation) {
    			if($event->id == $eventLocation->eventId){
    				$event->location = $eventLocation->locationId;
    				$curLocation = DB::table('location')->where('id',$eventLocation->locationId)->first();
    				$event->locationName = $curLocation->name;
    			}
    		}
    	}
        return view('doorworker/doorworker')->with('events',$events)->with('locations',$locations);
    }
    public function getEvent(Request $request){
        $event = DB::table('event')->where('id',$request->id)->first();
        $eventLocations = DB::table('eventlocation')->get();
        foreach ($eventLocations as $eventLocation) {
            if($event->id == $eventLocation->eventId){
                $event->location = $eventLocation->locationId;
                $curLocation = DB::table('location')->where('id',$eventLocation->locationId)->first();
                $event->locationName = $curLocation->name;
            }
        }
        
        $guestList = DB::table('invitedguest')->where('eventId',$event->id)->orderBy('type')->get();
        foreach ($guestList as $value) {
            if($value->type == "guest")
                $curUser = DB::table('users')->where('id',$value->guestId)->first();
            else 
                $curUser = DB::table('plusonelists')->where('id',$value->guestId)->first();
            $value->name = $curUser->name;
            $value->birthday = $curUser->birthday;
        }
        return response()->json([
            'status'  => 'success',
            'event'   => $event,
            'userList' => $guestList
        ]);
    }
    public function onCheck(Request $request){
        $eventId = $request->id;
        $userid = $request->user;
        $userType = $request->usertype;
        $mode = $request->mode;
        $flag = DB::table('attendanceevent')->where('type',$mode)->where('eventId',$eventId)->where('guestId',$userid)->where('usertype',$userType)->first();
        $eventInfo = DB::table('event')->where('id',$eventId)->first();
        $now = new DateTime();
        if($eventInfo->startTimeStamp < $now && $eventInfo->endTimeStamp > $now){
            if($flag == null){
                DB::table('attendanceevent')->insert([
                    'type' => $mode,
                    'eventId' => $eventId,
                    'guestId' => $userid,
                    'usertype' => $userType,
                ]);
                return response()->json([
                    'status'  => 'success',
                ]);
            }
            else{
                return response()->json([
                    'status'  => 'error',
                    'curStatus' => $flag
                ]);
            }
        }
        else{
            return response()->json([
                'status' => 'time Error',

            ]);
        }
    }
}
