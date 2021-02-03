<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\PatientRequest;
use App\Models\admin;
use App\Models\clinic;
use App\Models\nurse;
use App\Models\Patient;
use App\Models\reservation;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
  date_default_timezone_set('Africa/Cairo');

class ReservationController extends Controller
{
    //
public function __construct()
    {
        $this->middleware('auth');
    }
    public function get()
    {
    	$clinics= clinic::all();
      $admins=admin::where('status',1)->get();
        return view('user.reservations.create')->with('clinics',$clinics)->with('admins',$admins);
    }
    public function history()
    {
      $reservations=$this->get_history();
       $array=self::getdata($reservations);  
        return view('user.reservations.history')->with('reservations',$array);
    }
    public function get_history()
    {
        $user = auth()->user();
        $reservations= reservation::where('patient_id',$user->id)
               ->orderBy('time', 'desc')
               ->get();
        return $reservations;

    }

    public function edit(reservation $reservation)
    {
      $clinics=clinic::all();
      $reservation=reservation::where('id',$reservation->id)->get();
      $reservation=self::getdata($reservation);
      $admins=admin::where('status',1)->get();
        return view('user.reservations.update')->with('reservations',$reservation)->with('clinics',$clinics)->with('admins',$admins);
      }
    
   public function destroy(reservation $reservation)
   {
         $reservation=Reservation::find($reservation->id); 
       $reservation->delete();
        $reservations=$this->get_history();
        return redirect('reservations/history')->with('reservations',$reservation)->with('status' ,'
          Reservation deleted'); 
   }


public function update(Request $request, reservation $reservation)
{


$this->validate($request,[
           
            'date'=>'required|after:today',
            'time'=>'required|after:"8:00 AM"|before:"10:00 PM"',
        ]);
         $reservation=reservation::find($reservation->id);
         $reservationdate= $request->date.' '.$request->time;
         $reservationdate=Carbon::parse($reservationdate);
         if($request->admin!="Change Doctor" && $reservation->admin_id != $request->admin)
         {
         $reservation->admin_id = $request->admin;
         $reservation->nurse_id=null;
         }
         if($request->clinic!="Change Clinic" && $reservation->clinic_id != $request->clinic)
         {
         $reservation->clinic_id = $request->clinic;
         $reservation->nurse_id=null;
         }
         if($reservation->time != $reservationdate)
         {
          $reservation->time=$reservationdate;
          $reservation->nurse_id=null;
         }
         $reservation->save();
         return back()->with('status' ,'reservation updated Successfully!!');

}
   public function store(Request $request){

$this->validate($request,[
           
            'date'=>'required|after:today',
            'time'=>'required|after:"8:00 AM"|before:"10:00 PM"',
            'clinic'=>'required',
            'admin'=>'required',
        ]);

         $now=Carbon::now()->toDateTimeString();
         $date= $request->date.' '.$request->time;
         $date=Carbon::parse($date);

         // return $request->all();
         $reservation= new reservation;
         $user = auth()->user();
         $reservation->admin_id = $request->admin;
         $reservation->clinic_id = $request->clinic;
         $reservation->patient_id = $user->id;
         $reservation->attend=0;
         $reservation->nurse_id=null;
         $reservation->time=$date;
         $reservation->save();
         return redirect('/reservations/history')->with('status' ,'Reservation Added Successfully!!');
        // return view('user.reservations.update')->with('status' ,'Reservation Added Successfully!!');
          
   }

  public function getdata($reservations)
   {
    $array= array();
      foreach ($reservations as $reservation) {
        $date=date("d-m-Y", strtotime($reservation->time));
        $time=date("h:i A", strtotime($reservation->time));
        
      $doctor=admin::where('id',$reservation->admin_id)->value('name');
      $patient=auth()->user()->name;
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