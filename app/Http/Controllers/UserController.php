<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use Illuminate\Support\Facades\Hash;
class UserController extends Controller
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
    	$users = DB::table('users')->get();
        $organizations = DB::table('organization')->get();
        foreach ($users as $user) {
            $curOrganization = DB::table('organization')->where('id',$user->organizationID)->first();
            if($curOrganization == null)
                $user->organizationName = "not selected";
            else
                $user->organizationName = $curOrganization->name;
        }
        return view('users/users')->with('users',$users)->with('organizations',$organizations);
    }
    public function guestIndex()
    {
        $users = DB::table('users')->where('role','user')->get();
        $organizations = DB::table('organization')->get();
        foreach ($users as $user) {
            $curOrganization = DB::table('organization')->where('id',$user->organizationID)->first();
            if($curOrganization == null)
                $user->organizationName = "not selected";
            else
                $user->organizationName = $curOrganization->name;
        }
        return view('userlist/userlist')->with('users',$users)->with('organizations',$organizations);
    }
    public function deleteUser(Request $request)
    {
       $id = $request->id;
       DB::table('users')->where('id',$id)->delete();

        return response()->json([
            'status'  => 'success'
        ]);
    }
    public function addUser(Request $request){
        $name = $request->name;
        $email = $request->email;
        $birthday = $request->birthday;
        $state = $request->state;
        $notes = $request->notes;
        $organizationID = $request->organization;
        $role = $request->role;
        DB::table('users')
            ->insert([
                'name' => $name,
                'email' => $email,
                'birthday' => $birthday,
                'state' => $state,
                'notes' => $notes,
                'organizationID' => $organizationID,
                'role' => $role,
                'password' => Hash::make($name.$birthday),
        ]);
        return response()->json([
            'status'  => 'success'
        ]);
    }
    public function editUser(Request $request){
        $id = $request->id;
        $name = $request->name;
        $email = $request->email;
        $birthday = $request->birthday;
        $state = $request->state;
        $notes = $request->notes;
        $organizationID = $request->organization;
        $role = $request->role;
        DB::table('users')->where('id',$id)
            ->update([
                'name' => $name,
                'email' => $email,
                'birthday' => $birthday,
                'state' => $state,
                'notes' => $notes,
                'organizationID' => $organizationID,
                'role' => $role,
        ]);
        return response()->json([
            'status'  => 'success'
        ]);
       
    }
}
