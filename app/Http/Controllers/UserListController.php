<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class UserListController extends Controller
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
        
        $userLists = DB::table("userlist")->get();
        $guests = DB::table("users")->get();
        return view('userlist/userlist')->with('userLists',$userLists)->with('guests',$guests);
    }
    public function onAddUserList(Request $request){
        $name = $request->name;
        $notes = $request->notes;
        DB::table('userlist')
            ->insert([
                'name' => $name,
                'notes' => $notes,
        ]);
        return response()->json([
            'status'  => 'success'
        ]);
    }
    public function onDeleteUserList(Request $request){
        $id = $request->id;
        DB::table('userlist')->where('id',$id)
            ->delete();
        return response()->json([
            'status'  => 'success'
        ]);
    }
    public function onEditUserList(Request $request){
        $name = $request->name;
        $notes = $request->notes;
        DB::table('userlist')->where('id',$request->userListId)
            ->update([
                'name' => $name,
                'notes' => $notes,
        ]);
        return response()->json([
            'status'  => 'success'
        ]);
    }
}
