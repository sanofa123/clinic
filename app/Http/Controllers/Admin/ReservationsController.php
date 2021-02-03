<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\admin;
use App\Models\clinic;
use App\Models\nurse;
use App\Models\reservation;
use Carbon\Carbon;
  date_default_timezone_set('Africa/Cairo');
class ReservationsController extends Controller
{

    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function get(){
        $today=Date('Y-m-d');
        $id=auth()->user()->id;
        $reservations=reservation::where('admin_id',$id)->whereNotNull('nurse_id')->where('reject',0)->where('time','LIKE',"%{$today}%")->orderBy('time','desc')->get();
        $array=self::getdata($reservations);      
        return view('admin.patient.reservations')->with('reservations',$array);

    }

    public function search(Request $request){
        $date=$request->Reservationdate;
        $id=auth()->user()->id;
        $reservations=reservation::where('admin_id',$id)->whereNotNull('nurse_id')->where('reject',0)->where('time','LIKE',"%{$date}%")->orderBy('time','desc')->get();
        $array=self::getdata($reservations);     
        return view('admin.patient.reservations')->with('reservations',$array);
    }


    public function getdata($reservations){
        $array= array();
        foreach ($reservations as $reservation) {
            $date=date("d-M-Y", strtotime($reservation->time));
            $time=date("h:i a", strtotime($reservation->time));
      
            $patient=Patient::where('id',$reservation->patient_id)->value('name');
            $clinic=clinic::where('id',$reservation->clinic_id)->value('name');
            $nurse=nurse::where('id',$reservation->nurse_id)->value('name');
            $doctor=admin::where('id', $reservation->admin_id)->value('name');

            $attendance=$reservation->attend;
            array_push($array, 
                array(
                    'id'=>$reservation->id,
                    'clinic'=>$clinic,
                    'doctor'=>$doctor,
                    'nurse'=>$nurse,
                    'patient'=>$patient,
                    'date'=>$date,
                    'time'=>$time,
                    'attend'=>$attendance,
                    'response' => $reservation->reject
                )
            );
        }  

        return $array;
   }

}