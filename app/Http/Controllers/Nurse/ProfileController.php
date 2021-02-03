<?php

namespace App\Http\Controllers\Nurse;

use App\Http\Controllers\Controller;
use App\Models\nurse;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:nurse');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clinic = DB::table('clinics')->where('id', Auth::user()->clinic_id)->value('name');
        return view('nurse.profile',  compact('clinic'));
    }

    public function updatePicture(Request $request) {
        $this->validate($request, [
            'picture' => 'required|image',
        ]);
        
        // store the picture (you must run this commant to view the pictures in the views `php artisan storage:link`)
        $filePath = $request->picture->store('/public/nurses/' . Auth::id());
        // update nurse data
        $nurse = nurse::find(Auth::id());
        $nurse->image = $filePath;
        $nurse->save();

        return back();
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|regex:/^[\pL\s\-]+$/u|min:3|max:35',
            'email' => [
                'required',
                'email',
                Rule::unique('nurses', 'email')->ignore(Auth::id()),
                ],
            'mobile' => 'nullable|numeric|digits_between:8,20',

        ]);
        $nurse = nurse::find(Auth::id());
        $nurse->name = ucwords(trans($request->name)); // to make the first letter of each name capital
        $nurse->email = $request->email;
        $nurse->mobile = $request->mobile;;
        $nurse->save();
        return back()->with('status', 'updated Successfully!!');
    }

    public function password(Request $request)
    {
        $this->validate($request, [
            'oldPassword' => 'required',
            'newPassword' => 'required|min:8|same:passwordConfirm',
        ]);
        $nurse = nurse::find(Auth::id());

        if (Hash::check($request->oldPassword, $nurse->password)) {
            $nurse->password = bcrypt($request->newPassword);
            $nurse->save();
            return back()->with('status', 'updated Successfully!!');
        } else {
            return back()->with('error', 'Old password is wrong');
        }
    }

}