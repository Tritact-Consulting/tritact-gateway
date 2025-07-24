<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ConsultationBody;
use Illuminate\Http\Request;

class ConsultationBodyController extends Controller
{

    function __construct(){
        $this->middleware('permission:view consultation body|create consultation body|edit consultation body|delete consultation body', ['only' => ['index','show']]);
        $this->middleware('permission:create consultation body', ['only' => ['create','store']]);
        $this->middleware('permission:edit consultation body', ['only' => ['edit','update']]);
        $this->middleware('permission:delete consultation body', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = ConsultationBody::where('status', 0)->orderBy('id', 'desc')->get();
        return view('admin.consultation-body.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.consultation-body.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:consultation_bodies,name',
        ]);

        $tag = new ConsultationBody();
        $tag->name = $request->name;
        $tag->status = $request->status;
        $tag->save();

        return redirect()->back()->with('success', 'Consultation Body Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(ConsultationBody $consultationBody)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = ConsultationBody::find($id);
        return view('admin.consultation-body.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:consultation_bodies,name,'.$id,
        ]);

        $tag = ConsultationBody::find($id);
        $tag->name = $request->name;
        $tag->status = $request->status;
        $tag->save();

        return redirect()->back()->with('success', 'Consultation Body Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = ConsultationBody::find($id);
        $data->status = 1;
        $data->save();
        return redirect()->back()->with('success', 'Consultation Body Deleted Successfully');
    }
}
