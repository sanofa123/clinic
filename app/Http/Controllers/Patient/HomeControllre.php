<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\admin;
use App\Models\clinic;
use App\Models\prescription;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function home()
    {
        $clinics = clinic::count();
        $patients = Patient::count();
        $operations = prescription::count();
        $doctors = admin::all();
        $doc_num = admin::count();
        return view('user.index',compact('clinics','patients','operations','doctors','doc_num'));
    }
    
    public function contact()
    {
       $clinics = clinic::all();
       return view('user.clinic.contact',compact('clinics'));
    }

}