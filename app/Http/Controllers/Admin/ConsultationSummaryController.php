<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ConsultationSummary;
use App\Models\Consultant;
use App\Models\User;
use App\Models\CertificationCategory;
use App\Models\CertificationBody;
use Illuminate\Http\Request;

class ConsultationSummaryController extends Controller
{
    function __construct(){
        $this->middleware('permission:view consultation summary|create consultation summary|edit consultation summary|delete consultation summary', ['only' => ['index','show']]);
        $this->middleware('permission:create consultation summary', ['only' => ['create','store']]);
        $this->middleware('permission:edit consultation summary', ['only' => ['edit','update']]);
        $this->middleware('permission:delete consultation summary', ['only' => ['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $consultants = Consultant::all();
        $company = User::where('is_admin', 1)->where('is_company', 1)->where('status', 0)->orderBy('id', 'desc')->get();
        $certification_category = CertificationCategory::where('status', 0)->orderBy('id', 'desc')->get();
        $certification_body = CertificationBody::where('status', 0)->get();
        $data = ConsultationSummary::orderBy('id', 'desc');
        $data = $data->get();
        return view('admin.consultation-summary.index', compact('data', 'consultants', 'company', 'certification_category', 'certification_body'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $consultants = Consultant::all();
        $company = User::where('is_admin', 1)->where('is_company', 1)->where('status', 0)->orderBy('id', 'desc')->get();
        $certification_category = CertificationCategory::where('status', 0)->orderBy('id', 'desc')->get();
        $certification_body = CertificationBody::where('status', 0)->get();
        return view('admin.consultation-summary.create', compact('company', 'certification_category', 'consultants', 'certification_body'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'consultant_id' => 'required',
            'company_id' => 'required',
            'certification_category_id' => 'required',
            'audit_type' => 'required',
            'certification_body_id' => 'required',
        ]);
        $data = new ConsultationSummary();
        $data->consultant_id = $request->consultant_id;
        $data->company_id = $request->company_id;
        $data->certification_category_id = $request->certification_category_id;
        $data->audit_type = $request->audit_type;
        $data->certification_body_id = $request->certification_body_id;
        $data->status = 0;
        $data->save();

        return redirect()->back()->with('success', 'Consultation Summary Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(ConsultationSummary $consultationSummary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::where('is_admin', 1)->where('is_company', 1)->where('status', 0)->orderBy('id', 'desc')->get();
        $certification = CertificationCategory::where('status', 0)->get();
        $consultants = Consultant::all();
        $company = User::where('is_admin', 1)->where('is_company', 1)->where('status', 0)->orderBy('id', 'desc')->get();
        $certification_category = CertificationCategory::where('status', 0)->orderBy('id', 'desc')->get();
        $data = ConsultationSummary::find($id);
        $certification_body = CertificationBody::where('status', 0)->get();
        return view('admin.consultation-summary.edit', compact('data', 'company', 'certification_category', 'consultants', 'certification_body', 'user', 'certification'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'consultant_id' => 'required',
            'company_id' => 'required',
            'certification_category_id' => 'required',
            'audit_type' => 'required',
            'certification_body_id' => 'required',
        ]);
        $data = ConsultationSummary::find($id);
        $data->consultant_id = $request->consultant_id;
        $data->company_id = $request->company_id;
        $data->certification_category_id = $request->certification_category_id;
        $data->audit_type = $request->audit_type;
        $data->certification_body_id = $request->certification_body_id;
        $data->status = 0;
        $data->save();
        return redirect()->back()->with('success', 'Consultation Summary Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        ConsultationSummary::find($id)->delete();
        return redirect()->back()->with('success', 'Consultation Summary Deleted Successfully');
    }
}
