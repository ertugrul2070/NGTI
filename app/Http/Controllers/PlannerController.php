<?php

namespace App\Http\Controllers;

use App\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PlannerController extends Controller
{
    public function index()
    {
        return view('planner');
    }

    public function soloIndex()
    {
        return view('planner.plannerSolo');
    }

    public function groupIndex()
    {
        return view('planner.plannerGroup');
    }

    public function getUserReservations()
    {
        $userId = Auth::user()->id;

        $userPlans = DB::select('select * from reservations');
        return view('welcome',['users'=>$userPlans]);
    }

    public function soloCreate(Request $request)
    {
        $date = $request->input('pdate');
        $startTime = $request->input('startT');
        $endTime = $request->input('endT');

        $data = array('reservation_date'=>$date, 'start_time'=>$startTime, 'end_time'=>$endTime, 'reservation_type'=>'Solo', 'status'=>0, 'user_id'=>Auth::user()->id , 'created_at'=>Carbon::now());

        DB::table('reservations')->insert($data);

        return view('/planner');
    }

    public function groupCreate(Request $request)
    {

        $date = $request->input('pdate');
        $startTime = $request->input('startT');
        $endTime = $request->input('endT');
        $users = $request->input('users');
        $dUsers = implode("," , $users);

        $data = array('reservation_date'=>$date, 'start_time'=>$startTime, 'end_time'=>$endTime, 'reservation_type'=>'Group', 'status'=>0, 'user_id'=>Auth::user()->id , 'group'=>$dUsers, 'created_at'=>Carbon::now());

        DB::table('reservations')->insert($data);

        return view('/planner');
    }

    public function getUsers()
    {
        $users = DB::select('select * from users');

        return view('planner.plannerGroup', ['users'=>$users]);
    }

}