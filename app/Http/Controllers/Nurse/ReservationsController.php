<?php

namespace App\Http\Controllers\Nurse;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\admin;
use App\Models\clinic;
use App\Models\nurse;
use App\Models\reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;
  date_default_timezone_set('Africa/Cairo');

class ReservationsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:nurse');
    }

    public function change_attendance(reservation $reservation)
    {

        $reservation=reservation::find($reservation->id);   
        $reservation->attend=1;
        $reservation->save();
       
        return back()->with('status','User attendance has been confirmed');
    }
    public function get()
    {
      $today=date('Y-m-d'). ' 23:59:59';
      $reservations=reservation::where('time','>',$today)->where('clinic_id',auth()->user()->clinic_id)->orderBy('time','desc')->get();
      $array=self::getdata($reservations);   
        
      return view('nurse.patient.reservations')->with('reservations',$array);

    }

    public function confirm($reservation_id)
    {
     $reservation=reservation::find($reservation_id); 
     $reservation->nurse_id=auth()->user()->id;
     $reservation->save();
     return back()->with('status' ,'Reservation confirmed');
    }   

    public function reject(reservation $reservation)
    {
        $reservation=Reservation::find($reservation->id); 
        $reservation->reject=1;
        $reservation->nurse_id=auth()->user()->id;
        $reservation->save();
        return back()->with('status' ,'
        	Reservation rejected ');  
    }
    public function search(Request $request)
    {
  
      $date=$request->Reservationdate;
      $reservations=reservation::where('time','LIKE',"%{$date}%")->orderBy('time','desc')->get();
      $array=self::getdata($reservations);     
      return view('nurse.patient.reservations')->with('reservations',$array);
    }


   
       public function getdata($reservations)
   {
   	$array= array();
      foreach ($reservations as $reservation) {
      	$date=date("d-M-Y", strtotime($reservation->time));
        $time=date("h:i a", strtotime($reservation->time));
		
      $doctor=admin::where('id',$reservation->admin_id)->value('name');
      $patient=Patient::where('id',$reservation->patient_id)->value('name');
      $clinic=clinic::where('id',$reservation->clinic_id)->value('name');
      $nurse=nurse::where('id',$reservation->nurse_id)->value('name');
       $response=$reservation->reject;
       $attendance=$reservation->attend;
       array_push($array, 
        array(
        	'id'=>$reservation->id,
            'doctor'=>$doctor,
            'clinic'=>$clinic,
            'nurse'=>$nurse,
            'patient'=>$patient,
            'date'=>$date,
            'time'=>$time,
            'response'=>$response,
            'attend'=>$attendance,
           )
        );
    }  
  return $array;
   }
}