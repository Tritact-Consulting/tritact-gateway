<?php

namespace App\Http\Controllers\Admin;

use App\Models\AssignAudit;
use App\Models\User;
use App\Models\Auditor;
use App\Models\CertificationBody;
use App\Models\Company;
use App\Models\CompanyCertification;
use App\Models\CertificationCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Notifications\AssignAuditNotification;
use Auth;
use Notification;

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

    public function index(Request $request)
    {
        $loginUserId = Auth::id();
        $auditors = Auditor::all();
        $company = User::where('is_admin', 1)
        ->where('is_company', 1)
        ->where('status', 0)
        ->whereHas('assignedTo', function($q) use ($loginUserId) {
            $q->where('parent_user_id', $loginUserId); // filter by logged-in user
        })
        ->with('assignedTo')
        ->orderBy('id', 'desc')
        ->get();
        $certification_category = CertificationCategory::where('status', 0)->orderBy('id', 'desc')->get();
        $certification_body = CertificationBody::where('status', 0)->get();
        $assignedUserIds = User::whereHas('assignedTo', function($q) use ($loginUserId) {
            $q->where('parent_user_id', $loginUserId);
        })->pluck('id')->toArray();
        $data = AssignAudit::whereIn('company_id', $assignedUserIds)->orderBy('id', 'desc');
        if($request->auditor_name != null){
            $auditor_name = $request->auditor_name;
            $data = $data->whereHas('auditor', function($q) use ($auditor_name){
                $q->where('id', $auditor_name);
            });
        }
        if($request->company_name != null){
            $company_name = $request->company_name;
            $data = $data->whereHas('company', function($q) use ($company_name){
                $q->where('id', $company_name);
            });
        }
        if($request->certification_type != null){
            $certification_type = $request->certification_type;
            $data = $data->whereHas('category', function($q) use ($certification_type){
                $q->where('id', $certification_type);
            });
        }
        if($request->certification_body != null){
            $certification_body_se = $request->certification_body;
            $data = $data->whereHas('body', function($q) use ($certification_body_se){
                $q->where('id', $certification_body_se);
            });
        }
        if($request->audit_type != null){
            $data = $data->where('audit_type', 'LIKE', '%' . $request->audit_type . '%');
        }
        if($request->status != null){
            $data = $data->where('status', $request->status);
        }

        $data = $data->get();

        return view('admin.assign-audit.index', compact('data', 'auditors', 'company', 'certification_category', 'certification_body'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $loginUserId = Auth::id();
        $auditors = Auditor::all();
        $company = User::where('is_admin', 1)
        ->where('is_company', 1)
        ->where('status', 0)
        ->whereHas('assignedTo', function($q) use ($loginUserId) {
            $q->where('parent_user_id', $loginUserId);
        })
        ->with('assignedTo')
        ->orderBy('id', 'desc')
        ->get();
        $certification_category = CertificationCategory::where('status', 0)->orderBy('id', 'desc')->get();
        $certification_body = CertificationBody::where('status', 0)->get();
        return view('admin.assign-audit.create', compact('company', 'certification_category', 'auditors', 'certification_body'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'auditor_id' => 'required',
            'company_id' => 'required',
            'certification_category_id' => 'required',
            'audit_type' => 'required',
            'audit_start_date' => 'required',
            'audit_end_date' => 'required',
            'certification_body_id' => 'required',
        ]);
        $data = new AssignAudit();
        $data->auditor_id = $request->auditor_id;
        $data->company_id = $request->company_id;
        $data->certification_category_id = $request->certification_category_id;
        $data->audit_type = $request->audit_type;
        $data->audit_start_date = $request->audit_start_date;
        $data->audit_end_date = $request->audit_end_date;
        $data->certification_body_id = $request->certification_body_id;
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
        $loginUserId = Auth::id();
        $assignedUserIds = User::whereHas('assignedTo', function($q) use ($loginUserId) {
            $q->where('parent_user_id', $loginUserId);
        })->pluck('id')->toArray();
        $user = User::where('is_admin', 1)
        ->where('is_company', 1)
        ->where('status', 0)
        ->whereHas('assignedTo', function($q) use ($loginUserId) {
            $q->where('parent_user_id', $loginUserId); // filter by logged-in user
        })
        ->with('assignedTo')
        ->orderBy('id', 'desc')
        ->get();
        $certification = CertificationCategory::where('status', 0)->get();
        $auditors = Auditor::all();
        $company = User::where('is_admin', 1)
        ->where('is_company', 1)
        ->where('status', 0)
        ->whereHas('assignedTo', function($q) use ($loginUserId) {
            $q->where('parent_user_id', $loginUserId); // filter by logged-in user
        })
        ->with('assignedTo')
        ->orderBy('id', 'desc')
        ->get();
        $certification_category = CertificationCategory::where('status', 0)->orderBy('id', 'desc')->get();
        $data = AssignAudit::where('id', $id)
                ->whereIn('company_id', $assignedUserIds)
                ->first();
        if (!$data) {
            abort(403, 'You are not authorized to edit this assign audit.');
        }
        $certification_body = CertificationBody::where('status', 0)->get();
        return view('admin.assign-audit.edit', compact('data', 'company', 'certification_category', 'auditors', 'certification_body', 'user', 'certification'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'auditor_id' => 'required',
            'company_id' => 'required',
            'certification_category_id' => 'required',
            'audit_type' => 'required',
            'audit_start_date' => 'required',
            'audit_end_date' => 'required',
            'certification_body_id' => 'required',
        ]);
        $data = AssignAudit::find($id);
        $data->auditor_id = $request->auditor_id;
        $data->company_id = $request->company_id;
        $data->certification_category_id = $request->certification_category_id;
        $data->audit_type = $request->audit_type;
        $data->audit_start_date = $request->audit_start_date;
        $data->audit_end_date = $request->audit_end_date;
        $data->certification_body_id = $request->certification_body_id;
        $data->completed = $request->completed;
        $data->status = $request->status;

        $completed = $request->completed;
        if($completed == 1){
            $request->validate([
                'summary_company' => 'required',
                'summary_certification_category' => 'required',
                'summary_certification_body' => 'required',
                'summary_certification_name' => 'required',
            ]);
            $id = $request->summary_company;
            
            $company = Company::where('user_id', $id)->first();
            $user = User::find($id);
            
            if($data->company_certificate_id != null){
                $company_certification = CompanyCertification::find($data->company_certificate_id);
            }else{
                $company_certification = new CompanyCertification();
            }
            $company_certification->user_id = $user->id;
            $company_certification->company_id = $company->id;
            $company_certification->certifications_id = $request->summary_certification_category;
            $company_certification->certification_name = $request->summary_certification_name;
            $company_certification->issue_date = $request->summary_issue_date;
            $company_certification->expire_date = $request->summary_expire_date;
            $company_certification->auditor_id = $request->summary_auditor;
            $company_certification->username = $request->summary_username;
            $company_certification->password = $request->summary_password;
            $company_certification->certification_number = $request->summary_certification_number;
            $company_certification->certification_body_id = $request->summary_certification_body;
            $company_certification->save();
            $data->company_certificate_id = $company_certification->id;
        }

        $data->save();
        
        return redirect()->back()->with('success', 'Assign Audit Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        AssignAudit::find($id)->delete();
        return redirect()->back()->with('success', 'Audit Deleted Successfully');
    }
}
