<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\admin;
use App\Models\clinic;
use App\Models\material;
use App\Models\nurse;
use App\Models\receipt;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class InvoicesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    // get page to add new invoice
    public function add()
    {
    	$clinics = clinic::all();
    	$nurses = nurse::all();
    	$patients = Patient::all();
    	$admins = admin::all();
        $materials = material::all();
        foreach ($materials as $material) {
            $material->clinic_name = DB::table('clinics')->where('id', $material->clinic_id)->value('name');
            $material->category_name = DB::table('categories')->where('id', $material->category_id)->value('name');
        }
        return view('admin.invoice.add', compact('clinics','nurses','patients','admins','materials'));
    }

    // store the invoice data
    public function store(Request $request)
    {
    	$this->validate($request,[
            'day' => 'date|before_or_equal:today',
            'price' => 'required|numeric|min:0',
            'tax' => 'nullable|numeric|max:1|min:0',
            'discount' => 'nullable|numeric|max:1|min:0',
            'clinic' => 'required|exists:clinics,id',
            'nurse' => 'required|exists:nurses,id',
            'patient' => 'required|exists:patients,id',
            'admin' => 'required|exists:admins,id'
        ]);

        $invoice = new receipt;

        $invoice->total_price = $request->price;
        $invoice->tax = $request->tax;
        $invoice->discount = $request->discount;
        $invoice->clinic_id = $request->clinic;
        $invoice->nurse_id = $request->nurse;
        $invoice->patient_id= $request->patient;
        $invoice->admin_id= $request->admin;
        $date = $request->day . " " . $request->time;
        $invoice->day= Carbon::parse($date);


        

        $invoice->save();
        return redirect('/admin/invoice/view')->with('status' ,'Invoice Created Successfully!!');
    }

    // view invoices table
    public function view(Request $request)
    {
        $invoices = receipt::all();
        foreach ($invoices as $invoice) {

            $invoice->clinic_name = DB::table('clinics')->where('id', $invoice->clinic_id)->value('name');
            $invoice->admin_name = DB::table('admins')->where('id', $invoice->admin_id)->value('name');
            $invoice->nurse_name = DB::table('nurses')->where('id', $invoice->nurse_id)->value('name');
            $invoice->patient_name = DB::table('patients')->where('id', $invoice->patient_id)->value('name');
        }
        return view('admin.invoice.table',compact('invoices'));
    }

    public function edit(Request $request,receipt $invoice)
    {
        $clinics = clinic::all();
    	$nurses = nurse::all();
    	$patients = Patient::all();
    	$admins = admin::all();
        
            $invoice->time = Carbon::parse($invoice->day)->format('h:i:s A');
            $invoice->date = Carbon::parse($invoice->day)->toDateString();
        return view('admin.invoice.update', compact('invoice','clinics','nurses','patients','admins'));
    }

    public function update(Request $request, receipt $invoice)
    {
        $this->validate($request,[
            'day' => 'date|before_or_equal:today',
            'price' => 'required|numeric|min:0',
            'tax' => 'nullable|numeric|max:1|min:0',
            'discount' => 'nullable|numeric|max:1|min:0',
            'clinic' => 'required|exists:clinics,id',
            'nurse' => 'required|exists:nurses,id',
            'patient' => 'required|exists:patients,id',
            'admin' => 'required|exists:admins,id'
        ]);
         
        $invoice->total_price = $request->price;
        $invoice->tax = $request->tax;
        $invoice->discount = $request->discount;
        $invoice->clinic_id = $request->clinic;
        $invoice->nurse_id = $request->nurse;
        $invoice->patient_id= $request->patient;
        $invoice->admin_id= $request->admin;
        $date = $request->day . " " . $request->time;
        $invoice->day= Carbon::parse($date);
        

        $invoice->save();

        return back()->with('status', 'updated Successfully!!');   
    }
    
 
    public function destroy(Request $request,receipt $invoice)
    {
        $invoice->delete();
        return back()->with('status' ,'Invoice  has been deleted Successfully!!');  
    }

    public function show(Request $request,receipt $invoice)
    {
        $clinic = clinic::find($invoice->clinic_id);
        $nurse = nurse::find($invoice->nurse_id);
        $patient = Patient::find($invoice->patient_id);
        $admin = admin::find($invoice->admin_id);
        $invoice->date = Carbon::parse($invoice->day)->toDateString();
        $invoice->time = Carbon::parse($invoice->day)->format('h:i:s A');
        return view('admin.invoice.show', compact('invoice','clinic','nurse','patient','admin'));  
    }
}