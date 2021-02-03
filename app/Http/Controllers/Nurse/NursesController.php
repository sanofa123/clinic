<?php

namespace App\Http\Controllers\Nurse;

use App\Http\Controllers\Controller;
use App\Models\clinic;
use App\Models\nurse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NursesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:nurse');
    }
    // view nurses working times
    public function view_times()
    {
       $clinic_id = Auth::user()->clinic_id;
       $nurses = nurse::where('clinic_id',$clinic_id)->get();
       $clinic_name = clinic::find($clinic_id)->value('name');
       return view('nurse.nurse.times',compact('nurses','clinic_name'));
    }
}