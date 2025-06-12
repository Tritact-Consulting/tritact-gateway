<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CompanyCertification;
use App\Models\AssignAudit;
use DB;
use Auth;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $company_count = DB::table('users')->where('status', 0)->where('is_admin', 1)->where('is_company', 1)->count();
        $tag_count = DB::table('tags')->where('status', 0)->count();
        $user_count = DB::table('users')->where('is_admin', 1)->where('is_company', 0)->count();
        $document_count = DB::table('documents')->where('status', 0)->count();
        $guide_count = DB::table('guides')->where('status', 0)->count();
        $auditor_count = DB::table('auditors')->count();
        $assign_certification_count = DB::table('company_certifications')->count();
        $cert_body_count = DB::table('certification_bodies')->where('status', 0)->count();
        $auditor_expire = CompanyCertification::orderBy('expire_date', 'asc')->get();
        $assigned_audit = null;
        if(count(Auth::user()->assign_audit) != 0){
            $assigned_audit = AssignAudit::where('user_id', Auth::user()->id)->orderBy('updated_at', 'asc')->get();
        }
        $assign_audit = null;
        if(Auth::user()->can('view assign audit')){
            $assign_audit = AssignAudit::orderBy('id', 'desc')->get();
        }
        return view('admin.home', compact('company_count', 'tag_count', 'user_count', 'document_count', 'guide_count', 'auditor_expire', 'auditor_count', 'assign_certification_count', 'cert_body_count', 'assigned_audit', 'assign_audit'));
    }

    public function markAsRead(){
        Auth::user()->unreadNotifications->markAsRead();
        return redirect()->back()->with('success', 'Notification Mark Read Successfully');
    }
}
