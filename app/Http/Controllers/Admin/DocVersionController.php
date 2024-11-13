<?php

namespace App\Http\Controllers\Admin;

use App\Models\DocVersion;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DocVersionController extends Controller
{
    public function index(){
        $data = DocVersion::first();
        return view('admin.version.index', compact('data'));
    }

    public function create(){
        return view('admin.tag.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
        ]);

        $get_data = DocVersion::get();

        if(count($get_data) == 0){
            $data = new DocVersion();
            $data->name = $request->name;
            $data->save();
        }else{
            $data = DocVersion::first();
            $data->name = $request->name;
            $data->save();
        }

        return redirect()->back()->with('success', 'Version Added Successfully');
    }

}
