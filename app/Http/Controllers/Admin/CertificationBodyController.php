<?php

namespace App\Http\Controllers\Admin;

use App\Models\CertificationBody;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CertificationBodyController extends Controller
{
    function __construct(){
        $this->middleware('permission:view certification body|create certification body|edit certification body|delete certification body', ['only' => ['index','show']]);
        $this->middleware('permission:create certification body', ['only' => ['create','store']]);
        $this->middleware('permission:edit certification body', ['only' => ['edit','update']]);
        $this->middleware('permission:delete certification body', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = CertificationBody::where('status', 0)->orderBy('id', 'desc')->get();
        return view('admin.certification-body.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.certification-body.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name',
        ]);

        $tag = new CertificationBody();
        $tag->name = $request->name;
        $tag->status = $request->status;
        $tag->save();

        return redirect()->back()->with('success', 'Certification Body Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(CertificationBody $certificationBody)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = CertificationBody::find($id);
        return view('admin.certification-body.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:categories,name,'.$id,
        ]);

        $tag = CertificationBody::find($id);
        $tag->name = $request->name;
        $tag->status = $request->status;
        $tag->save();

        return redirect()->back()->with('success', 'Certification Body Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = CertificationBody::find($id);
        $data->status = 1;
        $data->save();
        return redirect()->back()->with('success', 'Certification Body Deleted Successfully');
    }
}
