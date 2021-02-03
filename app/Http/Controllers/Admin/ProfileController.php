<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\admin;
use Auth;
use Illuminate\Http\Request;
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
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.profile');
    }

    public function updatePicture(Request $request) {
        $this->validate($request, [
            'picture' => 'required|image',
        ]);
        
        // store the picture (you must run this commant to view the pictures in the views `php artisan storage:link`)
        $filePath = $request->picture->store('/public/admins/' . Auth::id());
        // update admin data
        $admin = admin::find(Auth::id());
        $admin->image = $filePath;
        $admin->save();

        return back();
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|regex:/^[\pL\s\-]+$/u|min:3|max:35',
            'email' => [
                'required',
                'email',
                Rule::unique('admins', 'email')->ignore(Auth::id()),
                ],
            'mobile' => 'nullable|numeric|digits_between:8,20',
        ]);
        $admin = Admin::find(Auth::id());
        $admin->name = ucwords(trans($request->name)); // to make the first letter of each name capital
        $admin->email = $request->email;
        $admin->mobile = $request->mobile;;
        $admin->save();
        return back()->with('status', 'updated Successfully!!');
    }

    public function password(Request $request)
    {
        // return $request->all();
        $this->validate($request, [
            'oldPassword' => 'required',
            'newPassword' => 'required|min:8|same:passwordConfirm',
        ]);
        $admin = Admin::find(Auth::id());

        if (Hash::check($request->oldPassword, $admin->password)) {
            $admin->password = bcrypt($request->newPassword);
            $admin->save();
            return back()->with('status', 'updated Successfully!!');
        } else {
            return back()->with('error', 'Old password is wrong');
        }
    }

}