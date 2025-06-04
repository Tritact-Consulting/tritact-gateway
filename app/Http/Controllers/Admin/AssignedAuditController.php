<?php

namespace App\Http\Controllers\Admin;

use App\Models\AssignAudit;
use App\Models\User;
use App\Models\CertificationCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

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
        return redirect()->back()->with('success', 'Status Updated Successfully');
    }
}
