<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Consultant;
use App\Models\ConsultationBody;
use Illuminate\Http\Request;

class ConsultantController extends Controller
{

    function __construct(){
        $this->middleware('permission:view consultant|create consultant|edit consultant|delete consultant', ['only' => ['index','show']]);
        $this->middleware('permission:create consultant', ['only' => ['create','store']]);
        $this->middleware('permission:edit consultant', ['only' => ['edit','update']]);
        $this->middleware('permission:delete consultant', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Consultant::orderBy('id', 'desc')->get();
        return view('admin.consultant.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $body = ConsultationBody::where('status', 0)->get();
        return view('admin.consultant.create', compact('body'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:consultants,email',
            'phone' => 'required'
        ]);
        $data = new Consultant();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        // $data->consultation_body_id = $request->consultation_body_id;
        $data->save();
        return redirect()->back()->with('success', 'Consultant Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Consultant $consultant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $body = ConsultationBody::where('status', 0)->get();
        $data = Consultant::find($id);
        return view('admin.consultant.edit', compact('body', 'data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:consultants,email,'.$id,
            'phone' => 'required'
            // 'consultation_body_id' => 'required'
        ]);
        $data = Consultant::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        // $data->consultation_body_id = $request->consultation_body_id;
        $data->save();
        return redirect()->back()->with('success', 'Consultant Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Consultant::find($id)->delete();
        return redirect()->back()->with('success', 'Consultant Deleted Successfully');
    }
}
