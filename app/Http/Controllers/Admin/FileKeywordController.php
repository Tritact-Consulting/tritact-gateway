<?php

namespace App\Http\Controllers\Admin;

use App\Models\FileKeyword;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FileKeywordController extends Controller
{
    public function index(){
        $data = FileKeyword::get();
        return view('admin.file-keyword.index', compact('data'));
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