<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use DateTime;
class StatisticsController extends Controller
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
        $events  = DB::table('event')->get();
        foreach ($events as $event) {
            $totalNumber = DB::table('attendanceevent')->where('eventId',$event->id)->where('type',"checkin")->get();
            $currentCount = 0;
            foreach ($totalNumber as $member) {
                if(DB::table('attendanceevent')->where('guestId',$member->guestId)->where('usertype',$member->usertype)->where('type','checkout')->first() == null)
                    $currentCount ++;
            }
            $startTime =  DateTime::createFromFormat('Y-m-d H:i:s', $event->startTimeStamp);
            $endTime =  DateTime::createFromFormat('Y-m-d H:i:s', $event->endTimeStamp);
            $now = new DateTime();
            $sinceStart = $startTime->diff($now);
            $untilEnd = $endTime->diff($now);
            $sinceStart = $sinceStart->format('%y-%m-%a  %h:%i:%s');
            $untilEnd = $untilEnd->format('%y-%m-%a  %h:%i:%s');
            $totalList = DB::table('attendanceevent')->get();
            $percentage = 100 / count($totalList) * count($totalNumber);

            $event->curnum = $currentCount;
            $event->totalnum = count($totalNumber);
            $event->sinceStart = $sinceStart;
            $event->untilEnd = $untilEnd;
            $event->percentage = $percentage;
        }
        return view('statistics/statistics')->with('events',$events);
    }
}
