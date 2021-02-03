<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\admin;
use App\Notifications\PatientEmailNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class EmailsController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function view()
    {
    	$doctors = admin::where('status', '=', 1)->get();
    	return view('user.admin.compose', compact('doctors'));
    }

    public function send(Request $request)
    {
    	$this->validate($request, [
    		'emails.*' => 'required|exists:admins,id',
    		'subject' => 'required|string|min:3',
    		'message' => 'required|string|min:15',
    	]);

    	$admins = admin::find($request->emails);
    	Notification::send($admins, new PatientEmailNotification($request->message, $request->subject, Auth::id()));

    	return back()->with('status', 'Sent Successfully!!');
    }
}