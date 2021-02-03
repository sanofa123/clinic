<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\admin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
class AdminsController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function add()
    {
        $week = array('Saturday','Sunday','Monday','Tuesday','Wednesday','Thursday','Friday');
        return view('admin.admin.addadmin',compact('week'));
    }

    public function store(Request $request)
    {
        // Validate the request...
            $this->validate($request,[
            'fullName'=>'required|min:3|regex:/^[\pL\s\-]+$/u|max:35',
            'email'=>'required|unique:admins|email',
            'password'=>'required|string|confirmed|min:8',
            'mobile'=>'nullable|numeric|digits_between:8,20',
            'start_day'=>'required|alpha',
            'end_day'=>'required|alpha',
            'start_time'=>'required',
            'end_time'=>'required',
            'about'=>'required',

            'role' => [
                    'nullable',
                    Rule::in(['doctor', 'super']),
                ],
        ]);
        $admin = new Admin;

        $admin->name=ucwords(trans($request->fullName)); // to make the first letter of each name capital

        $admin->email=$request->email;
        $admin->password = bcrypt($request->password);
        $admin->mobile=$request->mobile;
        $admin->role=$request->role;
        $admin->start_day =$request->start_day;
        $admin->end_day =$request->end_day;
        $admin->about=$request->about;
        $admin->start_time =Carbon::parse($request->start_time)->format('H:i:s');
        $admin->end_time =Carbon::parse($request->end_time)->format('H:i:s');
        $admin->status = 1;

        $admin->save();
        return redirect('/admin/admin/view')->with('status' ,'Admin Added Successfully!!');
    }

    public function view(Request $request)
    {
        $admins = admin::all()->except(Auth::id());
        return view('admin.admin.table',compact('admins'));
    }
 

    public function edit(Request $request, admin $admin)
    {
        $week = array('Saturday','Sunday','Monday','Tuesday','Wednesday','Thursday','Friday');
        $admin->start_time = Carbon::parse($admin->start_time)->format('h:i:s A');
        $admin->end_time = Carbon::parse($admin->end_time)->format('h:i:s A');
        return view('admin.admin.update',compact('admin','week'));
    }

    public function update(Request $request, admin $admin)
    {
        // Validate the request...
            $this->validate($request,[
            'fullName'=>'required|min:3|regex:/^[\pL\s\-]+$/u|max:35',
            'email'=>['required','email', Rule::unique('admins')->ignore($admin->id)],
            'mobile'=>'nullable|numeric|digits_between:8,20',
            'start_day'=>'required|alpha',
            'end_day'=>'required|alpha',
            'start_time'=>'required',
            'end_time'=>'required',
            'about'=>'required',

            'role' => [
                    'nullable',
                    Rule::in(['doctor', 'super']),
                ],
        ]);

         
        $admin->name=ucwords(trans($request->fullName)); // to make the first letter of each name capital
        $admin->email=$request->email;
        $admin->mobile=$request->mobile;
        $admin->role=$request->role;
        $admin->start_day =$request->start_day;
        $admin->end_day =$request->end_day;
        $admin->about=$request->about;
        $admin->start_time =Carbon::parse($request->start_time)->format('H:i:s');
        $admin->end_time =Carbon::parse($request->end_time)->format('H:i:s');
        
        $admin->save();

        return back()->with('status', 'updated Successfully!!');   
    }
    
 
    public function destroy(Request $request,admin $admin)
    {
        $admin->delete();
        return back()->with('status' ,'Admin has been deleted Successfully!!');  
    }

    // activate and deactivate the admin account
    public function status(Request $request,admin $admin)
    {
        $admin->status = !$admin->status;
        $admin->save();
        $msg = ($admin->status) ? 'Admin has been activated Successfully!!' : 'Admin has been deactivated Successfully!!';
        return back()->with('status' ,$msg); 
    }

    // view admins working times
    public function view_times()
    {
       $admins = admin::all();
       return view('admin.admin.times',compact('admins'));
    }

}