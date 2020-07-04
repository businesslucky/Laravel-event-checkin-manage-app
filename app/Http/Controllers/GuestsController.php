<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Importer;
class GuestsController extends Controller
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
        // if($event != null){
            foreach ($eventLocations as $eventLocation) {

            if($event->id == $eventLocation->eventId){
                $event->location = $eventLocation->locationId;
                $curLocation = DB::table('location')->where('id',$eventLocation->locationId)->first();
                $event->locationName = $curLocation->name;
            }
            }
            $inviteList = DB::table("invitedguest")->where('type','guest')->where("eventId",$event->id)->get();
            foreach ($inviteList as $guest) {
                $user_info = DB::table("users")->where('id',$guest->guestId)->first();
                $guest->detail = $user_info;
                $invite_info = DB::table("users")->where('id',$guest->invited_by)->first();
                $guest->invite_detail = $invite_info;
            }
            $guests = DB::table("users")->get();
            $plusOneList = DB::table("invitedguest")->where('type','plusone')->where("eventId",$event->id)->get();
            foreach($plusOneList as $replace){
                $plusoneinfo = DB::table('plusonelists')->where('id',$replace->guestId)->first();
                $replace->detail = $plusoneinfo;
                $invite_info = DB::table("users")->where('id',$guest->invited_by)->first();
                $replace->invite_detail = $invite_info;
            }

            return view('guest/guest')->with('event',$event)->with('inviteLists',$inviteList)->with('guests',$guests)->with('plusonlists',$plusOneList);
        // }
        // else{
        //     $events = DB::table('event')->get();
        //     $locations = DB::table('location')->get();
        //     $eventLocations = DB::table('eventlocation')->get();
        //     foreach ($events as  $event) {
        //         foreach ($eventLocations as $eventLocation) {
        //             if($event->id == $eventLocation->eventId){
        //                 $event->location = $eventLocation->locationId;
        //                 $curLocation = DB::table('location')->where('id',$eventLocation->locationId)->first();
        //                 $event->locationName = $curLocation->name;
        //             }
        //         }
        //     }
        //     return view('event/upcomingevent')->with('events',$events)->with('locations',$locations);
        // }
    }

    public function onAddInvite(Request $request){
        $guestId = $request->id;
        $type = $request->type;
        $notes = $request->notes;
        $eventId = $request->eventId;
        $eventInfo = DB::table('event')->where('id',$eventId)->first();
        $count = DB::table('invitedguest')->where('eventId',$eventId)->get();
        if(count($count) < $eventInfo->listMaxCapacity){
            DB::table('invitedguest')
                ->insert([
                    'notes' => $notes,
                    'type' => $type,
                    'guestId' => $guestId,
                    'eventId' => $eventId,
                    'invited_by' => Auth::user()->id,
            ]);
            return response()->json([
                'status'  => 'success'
            ]);
        }
        else{
            return response()->json([
                'status'  => 'failed'
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
        $guestId = $request->id;
        $type = $request->type;
        $notes = $request->notes;
        $eventId = $request->eventId;

        DB::table('invitedguest')->where('id',$request->invite_id)
            ->update([
                'notes' => $notes,
                'type' => $type,
                'guestId' => $guestId,
                'eventId' => $eventId,
                'invited_by' => Auth::user()->id,
                
        ]);
        return response()->json([
            'status'  => 'success'
        ]);
    }
    public function onExportExcel(){
        return Excel::download(new InvitedGuestExport, 'InvitedUserList.xlsx');
    }
    public function onImportExcel(Request $request){
        // $this->validate($request, [
        //     'import_file' => 'required|mimes:xls,xlsx'
        //  ]);
        // $path = $request->file('import_file')->getRealPath();
        // $data = Excel::import(new InvitedGuestImport, $path);
        // return back()->with('success', 'Import data successfully!');
        
        // $request->validate([
        //     'import_file' => 'required|mimes:xls,xlsx'
        // ]);
 
        $path = $request->file('import_file')->getRealPath();
        // $data = Excel::load($path)->get();
 
        // if($data->count()){
        //     foreach ($data as $key => $value) {
        //         $arr[] = ['name' => $value->name, 'notes' => $value->notes, 'birthday' => $value->birthday, 'eventId' => $value->eventId];
        //     }
 
        //     if(!empty($arr)){
        //         $plusId = DB::table('plusonelists')->insertGetId([
        //         'name' => $arr['name'],
        //         'birthday' => $arr['birthday'],
        //     ]);
        //     DB::table('invitedguest')->insert([
        //         'notes' => $arr['notes'],
        //         'type' => 'plusone',
        //         'guestId' => $plusId,
        //         'eventId' => $arr['eventId'],
        //         'invited_by' =>Auth::user()->id,
        //     ]);
        //     }
        // }
 
        // return back()->with('success', 'Insert Record successfully.');
        $excel = Importer::make('Excel');
        $excel->load($path);
        $collections = $excel->getCollection();
        //dd($collections);
        foreach($collections as $collection){
            $plusId = DB::table('plusonelists')->insertGetId([
                'name' => $collection[0],
                'birthday' => $collection[2],
            ]);
            DB::table('invitedguest')->insert([
                'notes' => $collection[1],
                'type' => 'plusone',
                'guestId' => $plusId,
                'eventId' => $collection[3],
                'invited_by' =>Auth::user()->id,
            ]);
        }
        return back()->with('success', 'Insert Record successfully.');
    }
}
