<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PatientController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
        return view('user.home');
    }

    public function photo(Request $request)
    {
    	$this->validate($request, [
    		'file' => 'required|image'
    	]);
		$filePath = $request->file->store('/public/patients/' . Auth::id());
		$patient = Patient::find(Auth::id());
		$patient->image = $filePath;
		$patient->save();
		return back(); 
    }

    public function update(Request $request)
    {
    	$this->validate($request, [
    		'name' => 'required|regex:/^[\pL\s\-]+$/u|min:3|max:35',
    		'email' => [
    			'required',
    			'email',
    			Rule::unique('patients', 'email')->ignore(Auth::id()),
    			],
    		'mobile' => 'required|numeric|digits_between:8,20',
    		'date' => 'required|date_format:Y-m-d|before:now',
    		'gender' => [
    			'required',
    			'string',
    			Rule::in(['male', 'female']),
    			],

    	]);
    	$patient = Patient::find(Auth::id());
    	$patient->name = ucwords(trans($request->name)); // to make the first letter of each name capital
    	$patient->email = $request->email;
    	$patient->mobile = $request->mobile;
    	$patient->gender = $request->gender;
    	$patient->date_of_birth = $request->date;
    	$patient->save();
    	return back()->with('status', 'updated Successfully!!');
    }

    public function password(Request $request)
    {
    	$this->validate($request, [
    		'oldPassword' => 'required',
    		'newPassword' => 'required|min:8|same:passwordConfirm',
    	]);
    	$patient = Patient::find(Auth::id());
    	// return Hash::check($request->newPassword, $patient->password);
    	if (Hash::check($request->oldPassword, $patient->password)) {
	    	$patient->password = bcrypt($request->newPassword);
	    	$patient->save();
	    	return back()->with('status', 'updated Successfully!!');
    	} else {
    		return back()->with('error', 'Old password is wrong');
    	}
    }
}