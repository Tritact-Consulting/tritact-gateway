<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{

    function __construct(){
        $this->middleware('permission:view partner|create partner|edit partner|delete partner', ['only' => ['index','show']]);
        $this->middleware('permission:create partner', ['only' => ['create','store']]);
        $this->middleware('permission:edit partner', ['only' => ['edit','update']]);
        $this->middleware('permission:delete partner', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Partner::where('status', 0)->orderBy('id', 'desc')->get();
        return view('admin.partner.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = Partner::where('status', 0)->get();
        return view('admin.partner.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required',
            'contact_name' => 'required',
            'contact_email' => 'required',
            'phone_number' => 'required',
        ]);
        $data = new Partner();
        $data->company_name = $request->company_name;
        $data->contact_name = $request->contact_name;
        $data->contact_email = $request->contact_email;
        $data->phone_number = $request->phone_number;
        $data->notes = $request->notes;
        $data->save();
        return redirect()->back()->with('success', 'Partner Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Partner $partner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Partner::find($id);
        return view('admin.partner.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'company_name' => 'required',
            'contact_name' => 'required',
            'contact_email' => 'required',
            'phone_number' => 'required',
        ]);

        $data = Partner::find($id);
        $data->company_name = $request->company_name;
        $data->contact_name = $request->contact_name;
        $data->contact_email = $request->contact_email;
        $data->phone_number = $request->phone_number;
        $data->notes = $request->notes;
        $data->save();
        return redirect()->back()->with('success', 'Partner Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Partner::find($id);
        $data->status = 1;
        $data->save();
        return redirect()->back()->with('success', 'Partner Deleted Successfully');
    }
}
