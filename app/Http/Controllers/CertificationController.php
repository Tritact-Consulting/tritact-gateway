<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\CompanyCertification;
use App\Models\CertificationCategory;
use App\Models\Auditor;
use App\Models\Category;
use App\Models\User;
use File;
use Illuminate\Support\Str;
use Response;

class CertificationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $data = CompanyCertification::orderBy('expire_date', 'asc')->where('company_id', Auth::user()->company->id)->get();
        $certification = CertificationCategory::where('status', 0)->get();
        $auditors = Auditor::all();
        return view('certification.index', compact('data', 'certification', 'auditors'));
    }

    public function store(Request $request){
        $data = new CompanyCertification();
        $data->user_id = Auth::user()->id;
        $data->company_id = Auth::user()->company->id;
        $data->certifications_id = $request->certification_category;
        $data->certification_name = $request->certification_name;
        $data->issue_date = $request->issue_date;
        $data->expire_date = $request->expire_date;
        $data->certification_number = $request->certification_number;
        $data->save();
        return redirect()->back()->with('success', 'Certification Added Successfully');

    }

    public function edit($id){
        $data = CompanyCertification::find($id);
        if($data->company_id == Auth::user()->company->id){
            $certification = CertificationCategory::where('status', 0)->get();
            return view('certification.edit', compact('data', 'certification'));
        }else{
            return redirect()->back();
        }
    }

    public function update(Request $request, $id){
        $data = CompanyCertification::find($id);
        $data->user_id = Auth::user()->id;
        $data->company_id = Auth::user()->company->id;
        $data->certifications_id = $request->certification_category;
        $data->certification_name = $request->certification_name;
        $data->issue_date = $request->issue_date;
        $data->expire_date = $request->expire_date;
        $data->certification_number = $request->certification_number;
        $data->save();
        return redirect()->back()->with('success', 'Certification Updated Successfully');
    }

    public function destroy($id){
        CompanyCertification::find($id)->delete();
        return redirect()->back()->with('success', 'Certification Deleted Successfully');
    }
    
}
