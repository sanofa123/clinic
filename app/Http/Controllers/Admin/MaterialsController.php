<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\admin;
use App\Models\category;
use App\Models\clinic;
use App\Models\material;
use App\Notifications\MaterialsNotifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rule;
class MaterialsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    // get page to add new material
    public function add()
    {
    	$clinics = clinic::all();
    	$categories = category::all();
        return view('admin.material.add', compact('clinics','categories'));
    }

    // store the material data
    public function store(Request $request)
    {
    	$this->validate($request,[
            'name' => 'required|regex:/^[\pL\s\-]+$/u|min:3|max:35',
            'clinic' => 'required|exists:clinics,id',
            'category' => 'required|exists:categories,id',
            'cost' => 'required|numeric|min:0',
            'min_num' => 'required|numeric|min:1',
            'num' => 'required|numeric|min:0'
        ]);

        $material = new material;

        $material->name = ucfirst(trans($request->name));
        $material->clinic_id = $request->clinic;
        $material->category_id = $request->category;
        $material->cost= $request->cost;
        $material->num= $request->num;
        $material->min_num= $request->min_num;
        $this->check_material($material);
        $material->save();
        return redirect('/admin/material/view')->with('status' ,'Material Added Successfully!!');
    }

    // view materials table
    public function view(Request $request)
    {
        $materials = material::all();
        foreach ($materials as $material) {
            $material->clinic_name = DB::table('clinics')->where('id', $material->clinic_id)->value('name');
            $material->category_name = DB::table('categories')->where('id', $material->category_id)->value('name');
        }
        return view('admin.material.table',compact('materials'));
    }

    public function edit(Request $request,material $material)
    {
        $clinics = clinic::all();
    	$categories = category::all();
        return view('admin.material.update',compact('material', 'clinics','categories'));
    }

    public function update(Request $request, material $material)
    {
        $this->validate($request,[
            'name' => 'required|regex:/^[\pL\s\-]+$/u|min:3|max:35',
            'clinic' => 'required|exists:clinics,id',
            'category' => 'required|exists:categories,id',
            'cost' => 'required|numeric|min:0',
            'min_num' => 'required|numeric|min:1',
            'num' => 'required|numeric|min:0'
        ]);
         
        $material->name = ucfirst(trans($request->name));
        $material->clinic_id = $request->clinic;
        $material->category_id = $request->category;
        $material->cost= $request->cost;
        $material->num= $request->num;
        $material->min_num= $request->min_num;
        $this->check_material($material);
        $material->save();

        return back()->with('status', 'updated Successfully!!');   
    }
    
 
    public function destroy(Request $request,material $material)
    {
        $material->delete();
        return back()->with('status' ,'Material  has been deleted Successfully!!');  
    }

    public function decrease(Request $request,material $material)
    {

        if($material->num == 0)
        {
           return back()->with('status' ,'There is not enough amount of '.$material->name); 
        }
        else
        {
            $material->num = $material->num-1 ;
            $admins = admin::all();
            $this->check_material($material);
            $material->save();
            return back()->with('status' ,'You used '.$material->name);
        }
    }

    public function delete_material_notification(material $material,$content)
    {
        $admins = admin::all();
        $clinic_name = DB::table('clinics')->where('id', $material->clinic_id)->value('name');
         $data['content'] = $content;
        foreach ($admins as $admin) {
            
                $notifications = $admin->notifications->where('data', $data)->all();
            foreach ($notifications as $notification)
                {
                     if($notification)
                    $notification->delete();
                }
            
        }
        
        return back();
    }

    public function check_material(material $material)
    {
        $admins = admin::all();
        $clinic_name = DB::table('clinics')->where('id', $material->clinic_id)->value('name');
        $material->name = ucfirst(trans($material->name));
        $content = $material->name ." needs to be refilled in ".$clinic_name;

        if($material->num < $material->min_num)
            {
                Notification::send($admins, new MaterialsNotifications($content));
            }
        else
            {
                $this->delete_material_notification($material,$content);
            }
    }

}