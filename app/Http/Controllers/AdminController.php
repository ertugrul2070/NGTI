<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        /*$resevations = DB::select('Select * from reservations join users on reservations.user_id=users.name');*/

        $resevations = DB::table('reservations')->join('users', 'reservations.user_id', '=', 'users.id')->select('reservations.*', 'users.name')->orderBy('start_time', 'asc')->get();
        return view('admin', ['resevations'=>$resevations]);
    }
}
