<?php

namespace App\Http\Controllers\Admin;

use App\Models\AssignAudit;
use App\Models\User;
use App\Models\CertificationCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AssignAuditController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct(){
        $this->middleware('permission:view assign audit|create assign audit|edit assign audit|delete assign audit', ['only' => ['index','show']]);
        $this->middleware('permission:create assign audit', ['only' => ['create','store']]);
        $this->middleware('permission:edit assign audit', ['only' => ['edit','update']]);
        $this->middleware('permission:delete assign audit', ['only' => ['destroy']]);
    }

    public function index()
    {
        $data = AssignAudit::orderBy('id', 'desc')->get();
        return view('admin.assign-audit.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::where('is_admin', 0)->orderBy('id', 'desc')->get();
        $company = User::where('is_admin', 1)->where('is_company', 1)->where('status', 0)->orderBy('id', 'desc')->get();
        $certification_category = CertificationCategory::where('status', 0)->orderBy('id', 'desc')->get();
        return view('admin.assign-audit.create', compact('user', 'company', 'certification_category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'company_id' => 'required',
            'certification_category_id' => 'required',
            'audit_name' => 'required',
            'audit_start_date' => 'required',
            'audit_end_date' => 'required',
        ]);
        $data = new AssignAudit();
        $data->user_id = $request->user_id;
        $data->company_id = $request->company_id;
        $data->certification_category_id = $request->certification_category_id;
        $data->audit_name = $request->audit_name;
        $data->audit_start_date = $request->audit_start_date;
        $data->audit_end_date = $request->audit_end_date;
        $data->status = 0;
        $data->save();
        return redirect()->back()->with('success', 'Assign Audit Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(AssignAudit $assignAudit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::where('is_admin', 0)->orderBy('id', 'desc')->get();
        $company = User::where('is_admin', 1)->where('is_company', 1)->where('status', 0)->orderBy('id', 'desc')->get();
        $certification_category = CertificationCategory::where('status', 0)->orderBy('id', 'desc')->get();
        $data = AssignAudit::find($id);
        return view('admin.assign-audit.edit', compact('data', 'user', 'company', 'certification_category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required',
            'company_id' => 'required',
            'certification_category_id' => 'required',
            'audit_name' => 'required',
            'audit_start_date' => 'required',
            'audit_end_date' => 'required',
        ]);
        $data = AssignAudit::find($id);
        $data->user_id = $request->user_id;
        $data->company_id = $request->company_id;
        $data->certification_category_id = $request->certification_category_id;
        $data->audit_name = $request->audit_name;
        $data->audit_start_date = $request->audit_start_date;
        $data->audit_end_date = $request->audit_end_date;
        $data->save();
        return redirect()->back()->with('success', 'Assign Audit Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AssignAudit $assignAudit)
    {
        //
    }
}
