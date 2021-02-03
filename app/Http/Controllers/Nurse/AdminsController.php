<?php

namespace App\Http\Controllers\Nurse;

use App\Http\Controllers\Controller;
use App\Models\admin;
use Illuminate\Http\Request;

class AdminsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:nurse');
    }
    // view admins working times
    public function view_times()
    {
       $admins = admin::all();
       return view('nurse.admin.times',compact('admins'));
    }
}