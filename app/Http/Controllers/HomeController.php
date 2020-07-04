<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class HomeController extends Controller
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
            $permission = DB::table('invitedguest')->where('type','guest')->where('eventId',$event->id)->where('guestId',Auth::user()->id)->first();
            $totalCount = DB::table('invitedguest')->where('type','guest')->where('eventId',$event->id)->get();
            $event->totalGuest = count($totalCount);
            if($permission != null)
                $event->isPlus = true;
            else
                $event->isPlus = false;
        }
        return view('home')->with('events',$events)->with('locations',$locations);
    }
    public function getUserList(Request $request){
        $id = $request->event_id;
        $userList = DB::table('userlist')->where('eventId',$id)->get();
        return response()->json([
            'status'  => 'success',
            'userlist' => $userList
        ]);
    }
}
