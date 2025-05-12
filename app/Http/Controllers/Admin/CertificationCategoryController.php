<?php

namespace App\Http\Controllers\Admin;

use App\Models\CertificationCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CertificationCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = CertificationCategory::where('status', 0)->orderBy('id', 'desc')->get();
        return view('admin.certification-category.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.certification-category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name',
        ]);

        $tag = new CertificationCategory();
        $tag->name = $request->name;
        $tag->status = $request->status;
        $tag->save();

        return redirect()->back()->with('success', 'Certification Category Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(CertificationCategory $certificationCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = CertificationCategory::find($id);
        return view('admin.certification-category.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:categories,name,'.$id,
        ]);

        $tag = CertificationCategory::find($id);
        $tag->name = $request->name;
        $tag->status = $request->status;
        $tag->save();

        return redirect()->back()->with('success', 'Certification Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = CertificationCategory::find($id);
        $data->status = 1;
        $data->save();
        return redirect()->back()->with('success', 'Certification Category Deleted Successfully');
    }
}
