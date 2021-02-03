<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Resources\FileResource;
use App\Http\Requests\PatientRequest;
use App\Models\Patient;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PatientsController extends Controller
{

    public function __construct() {
        $this->middleware('auth:admin');
    }

    // get edit patient page
    public function edit(Patient $patient)
    {
        return view('/admin/patient/update', compact('patient'));
    }

    // update patient status
    public function change_status(Patient $patient)
    {
        $patient->status = !$patient->status;
        $patient->save();
        $msg = ($patient->status) ? 'Patient has been activated Successfully!!' : 'Patient has been deactivated Successfully!!';
        return back()->with('status', $msg);
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();
        return back()->with('status' ,'patient has been deleted Successfully!!');  
    }

    // get add patient page
    public function add() {
        return view('admin.patient.add');
    }

    // update patient info
    public function update(Request $request, Patient $patient)
    {
         $this->validate($request,[
            'fullName'=>'required|regex:/^[\pL\s\-]+$/u|min:3|max:35',
            'email' => ['required','email', Rule::unique('patients')->ignore($patient->id)],
            'mobile'=>'nullable|numeric|digits_between:8,20',
            'birthday'=>'nullable|date|before:today',
            'gender' => [
                    'nullable',
                    Rule::in(['male', 'female']),
                ],
        ]);

        $patient->name = ucwords(trans($request->fullName)); // to make the first letter of each name capital
        $patient->email = $request->email;
        $patient->mobile = $request->mobile;
        $patient->date_of_birth = $request->birthday;
        $patient->gender = $request->gender;
         
        $patient->save();

        return back()->with('status' ,'Patient Info has been updated Successfully!!');
    }

    // view a table of patients
    public function index()
    {   
        $patients = Patient::all(); 
        return view('/admin/patient/view')->with('patients',$patients); 
    }

    public function store(PatientRequest $request) {
        

        $patient = new Patient ;

        $patient->name = ucwords(trans($request->fullName)); // to make the first letter of each name capital
        $patient->email = $request->email;
        $patient->mobile = $request->mobile;
        $patient->password = bcrypt($request->password);
        $patient->status = 1;
        $patient->date_of_birth = $request->birthday;
        $patient->gender = $request->gender;

        $patient->save();

        return redirect('/admin/patient/view')->with('status' ,'Patient Added Successfully!!');

    }

    // search on patient emails in database
    public function search(Request $request)
    {
        foreach ($this->get_patients($request->term) as $patient) {
            $emails[] = $patient->email;
        }
        return isset($emails) ? $emails : ['Not found'];
    }

    protected function get_patients($term)
    {
        // get emails like the search word with looping into database
        return Patient::where('email', 'LIKE', '%' . $term . '%')->cursor();
    }
}