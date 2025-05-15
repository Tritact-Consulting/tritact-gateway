<?php

namespace App\Http\Controllers\Admin;

use App\Models\Auditor;
use App\Models\CertificationBody;
use App\Models\CertificationCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuditorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Auditor::orderBy('id', 'desc')->get();
        return view('admin.auditor.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $body = CertificationBody::where('status', 0)->get();
        $category = CertificationCategory::where('status', 0)->get();
        return view('admin.auditor.create', compact('body', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:auditors,email',
            'phone' => 'required',
            'certification_body_id' => 'required',
            'certification_category' => 'required',
        ]);
        $data = new Auditor();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->certification_body_id = $request->certification_body_id;
        $data->save();
        $certification_category = $request->certification_category;
        $data->category()->sync($certification_category);
        return redirect()->back()->with('success', 'Auditor Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Auditor $auditor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $body = CertificationBody::where('status', 0)->get();
        $category = CertificationCategory::where('status', 0)->get();
        $data = Auditor::find($id);
        return view('admin.auditor.edit', compact('body', 'category', 'data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:auditors,email,'.$id,
            'phone' => 'required',
            'certification_body_id' => 'required',
            'certification_category' => 'required',
        ]);
        $data = Auditor::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->certification_body_id = $request->certification_body_id;
        $data->save();
        $certification_category = $request->certification_category;
        $data->category()->sync($certification_category);
        return redirect()->back()->with('success', 'Auditor Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Auditor::find($id)->delete();
        return redirect()->back()->with('success', 'Auditor Deleted Successfully');
    }
}
