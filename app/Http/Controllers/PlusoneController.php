<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use DateTime;

class PlusoneController extends Controller
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
    public function index($id)
    {
    	$event = DB::table('event')->where('id',$id)->first();
        $eventLocations = DB::table('eventlocation')->get();
        foreach ($eventLocations as $eventLocation) {
            if($event->id == $eventLocation->eventId){
                $event->location = $eventLocation->locationId;
                $curLocation = DB::table('location')->where('id',$eventLocation->locationId)->first();
                $event->locationName = $curLocation->name;
            }
        }
        $inviteList = DB::table("invitedguest")->where("eventId",$event->id)->get();
        foreach ($inviteList as $guest) {
            if($guest->type == "plusone")
                $user_info = DB::table("plusonelists")->where('id',$guest->guestId)->first();
            else
                $user_info = DB::table("users")->where('id',$guest->guestId)->first();
            $guest->detail = $user_info;
            $invite_info = DB::table("users")->where('id',$guest->invited_by)->first();
            $guest->invite_detail = $invite_info;
            if($guest->type != "plusone" && $guest->invited_by == Auth::user()->id)
                $guest->permission = false;
            else
                $guest->permission = true;
        }
        $guests = DB::table("users")->get();
        return view('plusone/plusone')->with('event',$event)->with('inviteLists',$inviteList)->with('guests',$guests);
    }
    public function onAddInvite(Request $request){
        $name = $request->id;
        $type = $request->type;
        $birthday = $request->birthday;
        $notes = $request->notes;
        $eventId = $request->eventId;
        $eventInfo = DB::table('event')->where('id',$eventId)->first();
        $totla_count = DB::table('invitedguest')->where('eventId',$eventId)->get();
        $plus_count = DB::table('invitedguest')->where('eventId',$eventId)->where('type','plusone')->get();
        $now = date('Y-m-d H:i:s');
        if(count($totla_count) < $eventInfo->listMaxCapacity && count($plus_count) < $eventInfo->plusOnes) {
            if($eventInfo->listOpenTime < $now &&  $eventInfo->listCloseTime > $now){
                $id = DB::table('plusonelists')->insertGetId([
                    'name' => $name,
                    'birthday' => $birthday
                ]);
                DB::table('invitedguest')
                    ->insert([
                        'notes' => $notes,
                        'type' => $type,
                        'guestId' => $id,
                        'eventId' => $eventId,
                        'invited_by' => Auth::user()->id,
                        
                ]);
                return response()->json([
                    'status'  => 'success'
                ]);
            }
            else{
                return response()->json([
                    'status'  => ' You have to add plus one'.$now.'from '.$eventInfo->listOpenTime.' to '.$eventInfo->listCloseTime
                ]);
            }
        }
        else{
            return response()->json([
                'status'  => 'number of users are bigger than plusones'
            ]);
        }
    }
    public function onDeleteInvite(Request $request){
        $id = $request->id;
        DB::table('invitedguest')->where('id',$id)
            ->delete();
        return response()->json([
            'status'  => 'success'
        ]);
    }
    public function onEditInvite(Request $request){
        $name = $request->id;
        $type = $request->type;
        $notes = $request->notes;
        $eventId = $request->eventId;
        $plusId = $request->plusid;
        $birthday = $request->birthday;

        DB::table('plusonelists')->where('id',$plusId)
            ->update([
                'name' =>  $name,
                'birthday' => $birthday,
                
        ]);
        DB::table('invitedguest')->where('id',$request->invite_id)
            ->update([
                'notes' => $notes,
                'invited_by' => Auth::user()->id,
        ]);
        return response()->json([
            'status'  => 'success'
        ]);
    }
}
