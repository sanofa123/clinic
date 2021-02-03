<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    // get page to add new category
    public function add()
    {
    	
        return view('admin.category.add');
    }

    // store the category data
    public function store(Request $request)
    {
    	$this->validate($request,[
            'name' => 'required|regex:/^[\pL\s\-]+$/u|unique:categories|min:3|max:35'
        ]);

        $category = new category;

        $category->name = ucwords(trans($request->name));
        
        

        $category->save();
        return redirect('/admin/category/view')->with('status' ,'Category Added Successfully!!');
    }

    // view categories table
    public function view(Request $request)
    {
        $categories = category::all();
        return view('admin.category.table',compact('categories'));
    }

    public function edit(Request $request,category $category)
    {
        return view('admin.category.update',compact('category'));
    }

    public function update(Request $request, category $category)
    {
        $this->validate($request,[
            'name' => ['required','regex:/^[\pL\s\-]+$/u','min:3','max:35',Rule::unique('categories')->ignore($category->id)]
        ]);
         
        $category->name = ucwords(trans($request->name));
        $category->save();

        return back()->with('status', 'updated Successfully!!');   
    }
    
 
    public function destroy(Request $request,category $category)
    {
        $category->delete();
        return back()->with('status' ,'Category  has been deleted Successfully!!');  
    }
}