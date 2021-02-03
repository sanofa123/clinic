<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EmailsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifications = Auth::user()->notifications()->where('type','App\Notifications\PatientEmailNotification')->paginate(15);
        foreach ($notifications as $notification) {
            $notification['sender'] = Patient::find($notification->data['patient_id']);
        
        }
        return view('admin.emails.inbox', compact('notifications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Patient $patient = null)
    {
        return view('admin.emails.compose', compact('patient'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate_email($request);
        $patient = Patient::byEmail($request->email);
        $patient->sendAdminEmailNotification($request->message, $request->subject, Auth::user()->email);
        // this routes will be changed
        return redirect('/admin/patient/view')->with('status', 'Email is sent to ' . $patient->name);
    }

    protected function validate_email(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|min:5|exists:patients,email',
            'message' => 'required|string|min:15',
            'subject' => 'required|string|min:5',
        ]);
    }

    // mark all notifications as read
    public function mark(Request $request)
    {
        Auth::user()->unreadNotifications->markAsRead();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($email)
    {
        Validator::make(['email' => $email], [
            'email' => 'required|exists:notifications,id',
        ])->validate();
        $email = Auth::user()->notifications->where('id', $email)->first();
        $this->markUndead($email);
        $email['sender'] = Patient::find($email->data['patient_id']);
        return view('admin.emails.read',  compact('email'));
    }

    protected function markUndead($email)
    {
        (!$email->read_at) ? $email->markAsRead() : '';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if (!$request->emails) {
            return back();
        }
        $this->validate($request, [
            'emails.*' => 'required|exists:notifications,id',
        ]);
        foreach ($request->emails as $email) {
            Auth::user()->notifications->where('id', $email)->first()->delete();
        }
        return redirect('/admin/inbox')->with('status', 'Deleted successfully!!');
    }
}