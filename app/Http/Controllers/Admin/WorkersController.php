<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\clinic;
use App\Models\worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class WorkersController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    // get page to add new worker
    public function add()
    {
    	$clinics = clinic::all();
        return view('admin.worker.add', compact('clinics'));
    }

    // store the worker data
    public function store(Request $request)
    {
    	$this->validate($request,[
            'fullName' => 'required|min:0|max:35|regex:/^[\pL\s\-]+$/u',
            'mobile' => 'nullable|numeric|digits_between:8,20',
            'birthday' => 'required|date|before:today',
            'salary' => 'required|numeric|min:0',
            'clinic' => 'required|exists:clinics,id',
            'position'=>'required|regex:/^[\pL\s\-]+$/u',
            'start_date'=>'required|date'
        ]);

        $worker = new worker;

        $worker->name = ucwords(trans($request->fullName)); // to make the first letter of each name capital
        $worker->mobile = $request->mobile;
        $worker->date_of_birth = $request->birthday;
        $worker->salary= $request->salary;
        $worker->clinic_id= $request->clinic;
        $worker->position= $request->position;
        $worker->date_of_start= $request->start_date;
        

        $worker->save();
        return redirect('/admin/worker/view')->with('status' ,'Worker Added Successfully!!');
    }

    // view workers table
    public function view(Request $request)
    {
        $workers = worker::all();
        foreach ($workers as $worker) {
            $worker->clinic_name = DB::table('clinics')->where('id', $worker->clinic_id)->value('name');
        }
        return view('admin.worker.table',compact('workers'));
    }

    public function edit(Request $request,worker $worker)
    {
        $clinics = clinic::all();
        return view('admin.worker.update',compact('worker', 'clinics'));
    }

    public function update(Request $request, worker $worker)
    {
        $this->validate($request,[
            'fullName' => 'required|min:0|max:35|regex:/^[\pL\s\-]+$/u',
            'mobile' => 'nullable|numeric|digits_between:8,20',
            'birthday' => 'required|date|before:today',
            'salary' => 'required|numeric|min:0',
            'clinic' => 'required|exists:clinics,id',
            'position'=>'required|regex:/^[\pL\s\-]+$/u',
            'start_date'=>'required|date'
        ]);
         
        $worker->name = ucwords(trans($request->fullName)); // to make the first letter of each name capital
        $worker->mobile = $request->mobile;
        $worker->date_of_birth = $request->birthday;
        $worker->salary= $request->salary;
        $worker->clinic_id= $request->clinic;
        $worker->position= $request->position;
        $worker->date_of_start= $request->start_date;
        

        $worker->save();

        return back()->with('status', 'updated Successfully!!');   
    }
    
 
    public function destroy(Request $request,worker $worker)
    {
        $worker->delete();
        return back()->with('status' ,'worker  has been deleted Successfully!!');  
    }

}