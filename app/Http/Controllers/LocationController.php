<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class LocationController extends Controller
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
    	$locations = DB::table('location')->get();
        return view('location/location')->with('locations',$locations);
    }
    public function addLocation(Request $request){
        $name = $request->name;
        $lat = $request->lat;
        $lon = $request->lon;
        DB::table('location')->insert([
            'name' => $name,
            'lat' => $lat,
            'lon' => $lon,
        ]);
        return response()->json([
            'status'  => 'success'
        ]);
    }
    public function editLocation(Request $request){
        $name = $request->name;
        $lat = $request->lat;
        $lon = $request->lon;
        DB::table('location')->where('id',$request->id)
            ->update([
            'name' => $name,
            'lat' => $lat,
            'lon' => $lon,
        ]);
        return response()->json([
            'status'  => 'success'
        ]);
    }
    public function deleteLocation(Request $request){
        $id = $request->id;
        DB::table('location')->where('id',$id)
            ->delete();
        return response()->json([
            'status'  => 'success'
        ]);
    }
}
