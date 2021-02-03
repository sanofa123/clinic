<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClinicRequest;
use App\Models\clinic;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
class ClinicsController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth:admin');
    }
    // get add clinic page
    public function add() {
        return view('admin.clinic.add');
    }

    public function store(ClinicRequest $request) {
        
        $clinic = new clinic ;

        $clinic->name = ucfirst(trans($request->name));
        $clinic->email = $request->email;
        $clinic->telephone = $request->phone;
        $clinic->address = $request->address;
        $clinic->start_time = Carbon::parse($request->start_time)->format('H:i:s');
        $clinic->end_time = Carbon::parse($request->end_time)->format('H:i:s');

        $clinic->save();

        return redirect('admin/clinic/view')->with('status' ,'clinic Added Successfully!!');

    }

    public function destroy(clinic $clinic)
    {
        $clinic->delete();
        return back()->with('status' ,'clinic has been deleted Successfully!!');  
    }

    // view a table of clinics
    public function view()
    {   
        $clinics = clinic::all(); 
        return view('admin.clinic.table')->with('clinics',$clinics); 
    }

    // get edit clinic page
    public function edit(clinic $clinic)
    {
        $clinic->start_time = Carbon::parse($clinic->start_time)->format('h:i:s A');

        $clinic->end_time = Carbon::parse($clinic->end_time)->format('h:i:s A');
        return view('/admin/clinic/update', compact('clinic'));
    }

    public function update(Request $request,clinic $clinic) {
    	$this->validate($request,[
            'email' => ['required','email', Rule::unique('clinics')->ignore($clinic->id)],
            'name' => 'required|regex:/^[\pL\s\-]+$/u|min:3|max:35',
            'phone' => 'nullable|numeric|digits_between:8,20',
                   ]);

        $clinic->name = ucfirst(trans($request->name));
        $clinic->email = $request->email;
        $clinic->telephone = $request->phone;
        $clinic->address = $request->address;
        $clinic->start_time = Carbon::parse($request->start_time)->format('H:i:s');
        $clinic->end_time = Carbon::parse($request->end_time)->format('H:i:s');

        $clinic->save();

        return back()->with('status' ,'clinic Info has been updated Successfully!!');

    }
}