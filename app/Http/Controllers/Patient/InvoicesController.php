<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\admin;
use App\Models\clinic;
use App\Models\nurse;
use App\Models\receipt;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoicesController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    // view invoices table
    public function view(Request $request)
    {
         $user = auth()->user();
        $invoices= receipt::where('patient_id',$user->id)->orderBy('day', 'desc')->get();
        foreach ($invoices as $invoice) {

            $invoice->clinic_name = DB::table('clinics')->where('id', $invoice->clinic_id)->value('name');
            $invoice->admin_name = DB::table('admins')->where('id', $invoice->admin_id)->value('name');
            $invoice->nurse_name = DB::table('nurses')->where('id', $invoice->nurse_id)->value('name');
        }
        return view('user.invoice.table',compact('invoices'));
    }

    public function show(Request $request,receipt $invoice)
    {
        $clinic = clinic::find($invoice->clinic_id);
        $nurse = nurse::find($invoice->nurse_id);
        $patient = Patient::find($invoice->patient_id);
        $admin = admin::find($invoice->admin_id);
        $invoice->date = Carbon::parse($invoice->day)->toDateString();
        $invoice->time = Carbon::parse($invoice->day)->format('h:i:s A');
        return view('user.invoice.show', compact('invoice','clinic','nurse','patient','admin'));  
    }
}