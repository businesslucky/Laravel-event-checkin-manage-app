<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class EventController extends Controller
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
        return view('event/upcomingevent')->with('events',$events)->with('locations',$locations);
    }
    public function onEventAdd(Request $request){
    	$notes = $request->notes;
    	$startTime = $request->startTime;
    	$endTime = $request->endTime;
    	$listMaxCapacity = $request->listMaxCapacity;
    	$plusOnes = $request->plusOnes;
    	$listOpenTime = $request->listOpenTime;
    	$listCloseTime = $request->listCloseTime;
    	$theme = $request->theme;
    	$location = $request->location;
    	$id = DB::table('event')->insertGetId([
    		'startTimeStamp' => $startTime,
    		'endTimeStamp' => $endTime,
    		'listMaxCapacity' => $listMaxCapacity,
    		'plusOnes' => $plusOnes,
    		'notes' => $notes,
    		'listOpenTime' => $listOpenTime,
    		'listCloseTime' => $listCloseTime,
    		'theme' => $theme
    	]);
    	DB::table('eventlocation')->insert([
    		'eventId' => $id,
    		'locationId' => $location
    	]);
        $userlists = DB::table('users')->get();
        foreach ($userlists as $user) {
            DB::table('invitedguest')->insert([
                'notes' => 'Guest',
                'type' => 'guest',
                'guestId' => $user->id,
                'eventId' => $id,
                'invited_by' => Auth::user()->id
            ]);
        }
    	return response()->json([
            'status'  => 'success'
        ]);
    }
    public function onEventEdit(Request $request){
    	$id = $request->id;
    	$notes = $request->notes;
    	$startTime = $request->startTime;
    	$endTime = $request->endTime;
    	$listMaxCapacity = $request->listMaxCapacity;
    	$plusOnes = $request->plusOnes;
    	$listOpenTime = $request->listOpenTime;
    	$listCloseTime = $request->listCloseTime;
    	$theme = $request->theme;
    	$location = $request->location;
    	DB::table('event')->where('id',$id)
    		->update([
	    		'startTimeStamp' => $startTime,
	    		'endTimeStamp' => $endTime,
	    		'listMaxCapacity' => $listMaxCapacity,
	    		'plusOnes' => $plusOnes,
	    		'notes' => $notes,
	    		'listOpenTime' => $listOpenTime,
	    		'listCloseTime' => $listCloseTime,
	    		'theme' => $theme
	    	]);
	    DB::table('eventlocation')->insert([
    		'eventId' => $id,
    		'locationId' => $location
    	]);
    	return response()->json([
            'status'  => 'success'
        ]);
    }
    public function onEventDelete(Request $request){
    	$id = $request->id;
    	DB::table('event')->where('id',$id)
    		->delete();
    	return response()->json([
            'status'  => 'success'
        ]);
    }
}
