<?php

namespace App\Http\Controllers\Admin;

use App\Models\AssignAudit;
use App\Models\User;
use App\Models\CertificationCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Notifications\AssignAuditNotification;
use Notification;


class AssignedAuditController extends Controller
{
    public function index(){
        $data = Auth::user()->assign_audit;
        return view('admin.assigned-audit.index', compact('data'));
    }

    public function show($id){
        $data = AssignAudit::find($id);
        if($data->user_id == Auth::user()->id){
            return view('admin.assigned-audit.show', compact('data'));
        }else{
            return abort(404);
        }
    }

    public function update(Request $request, $id){
        $data = AssignAudit::find($id);
        $data->status = $request->status;
        $data->save();
        $admin = User::where('is_admin', 0)->where('is_company', 0)->first();
        $notify_data = ['text' => 'Audit name : ' . $data->audit_name . ' has been updated to ' . $data->get_status(), 'name' => Auth::user()->name, 'url' => $data->id];
        Notification::send($admin, new AssignAuditNotification($notify_data));
        return redirect()->back()->with('success', 'Status Updated Successfully');
    }
}
