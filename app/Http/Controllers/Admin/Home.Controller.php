<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\reservation;
use App\Models\Patient;
use App\Models\category;
use App\Models\nurse;
use App\Models\clinic;
use DB;

date_default_timezone_set('Africa/Cairo');
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $today=Date('Y-m-d');
      $id=auth()->user()->id;
      $reservations=reservation::where('admin_id',$id)->where('time','LIKE',"%{$today}%")->whereNotNull('nurse_id')->where('reject',0)->orderBy('time','desc')->get();

      $array=app('App\Http\Controllers\Nurse\ReservationsController')->getdata($reservations);
        return view('admin.home')->with('reservations',$array);
    }

    public function statistics() {
        $patients = DB::table('admins')->select('created_at', DB::raw('count(*) as total'))->groupBy('created_at') ->get();
        $workers = DB::table('workers')->select('position', DB::raw('count(*) as total'))->groupBy('position') ->get();
        $nurses = nurse::all();

        $categories = category::all(); 
        $clinics = clinic::all();

        return view('admin.statistics', compact('patients', 'nurses', 'workers', 'categories', 'clinics'));
    }
}