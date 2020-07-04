<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class OrganizationController extends Controller
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
    	$organizations = DB::table('organization')->get();
        return view('organization/organization')->with('organizations',$organizations);
    }
    public function addOrganization(Request $request){
        $name = $request->name;
        $notes = $request->notes;
        DB::table('organization')->insert([
            'name' => $name,
            'notes' => $notes,
        ]);
        return response()->json([
            'status'  => 'success'
        ]);
    }
    public function editOrganization(Request $request){
        $name = $request->name;
        $notes = $request->notes;
        DB::table('organization')->where('id',$request->id)
            ->update([
            'name' => $name,
            'notes' => $notes,
        ]);
        return response()->json([
            'status'  => 'success'
        ]);
    }
    public function deleteOrganization(Request $request){
        $id = $request->id;
        DB::table('organization')->where('id',$id)
            ->delete();
        return response()->json([
            'status'  => 'success'
        ]);
    }
}
