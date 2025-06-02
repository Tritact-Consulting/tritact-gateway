<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tags;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TagController extends Controller
{

    function __construct(){
        $this->middleware('permission:view tag|create tag|edit tag|delete tag', ['only' => ['index','show']]);
        $this->middleware('permission:create tag', ['only' => ['create','store']]);
        $this->middleware('permission:edit tag', ['only' => ['edit','update']]);
        $this->middleware('permission:delete tag', ['only' => ['destroy']]);

    }

    public function index(){
        $data = Tags::where('status', 0)->orderBy('id', 'desc')->get();
        return view('admin.tag.index', compact('data'));
    }

    public function create(){
        return view('admin.tag.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:tags,name',
        ]);

        $tag = new Tags();
        $tag->name = $request->name;
        $tag->status = $request->status;
        $tag->save();

        return redirect()->back()->with('success', 'Tag Added Successfully');
    }

    public function edit($id){
        $data = Tags::find($id);
        return view('admin.tag.edit', compact('data'));
    }

    public function update($id, Request $request){
        $request->validate([
            'name' => 'required|unique:tags,name,'.$id,
        ]);

        $tag = Tags::find($id);
        $tag->name = $request->name;
        $tag->status = $request->status;
        $tag->save();

        return redirect()->back()->with('success', 'Tag Updated Successfully');
    }
    
    public function destroy($id){
        $data = Tags::find($id);
        $data->status = 1;
        $data->save();
        return redirect()->back()->with('success', 'Tag Deleted Successfully');
    }
}
