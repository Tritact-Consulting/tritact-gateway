<?php

namespace App\Http\Controllers\Admin;

use App\Models\Guides;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;
use Auth;

class GuideController extends Controller
{
    public function index(){
        $data = Guides::where('status', 0)->orderBy('id', 'desc')->get();
        return view('admin.guide.index', compact('data'));
    }

    public function create(){
        return view('admin.guide.create');
    }

    public function store(Request $request){
        $request->validate([
            'file' => 'required',
        ]);

        //$doc->status = $request->status;
        if($request->hasFile('file')){
            $files = $request->file('file');
            
            $bulk = $request->bulk;
            if($bulk == 1){
                foreach($files as $key => $file){
                    $doc = new Guides();
                    $set_file_name = ucwords(str_replace('-', ' ', pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)));
                    if($request->bulk == 0){
                        $doc->name = $set_file_name;
                    }else{
                        $doc->name = $set_file_name;
                    }
                    $imageName = $key . time().'.'.$file->extension();
                    $file->move(public_path('guide'), $imageName);
                    $doc->file = 'guide/'.$imageName;
                    $doc->save();
                }
            }else{
                $doc = new Guides();
                if($request->name != null){
                    $doc->name = $request->name;
                }else{
                    $set_file_name = ucwords(str_replace('-', ' ', pathinfo($files->getClientOriginalName(), PATHINFO_FILENAME)));
                    $doc->name = $set_file_name;
                }
                $imageName = time().'.'.$files->extension();
                $files->move(public_path('guide'), $imageName);
                $doc->file = 'guide/'.$imageName;
                $doc->save();
            }
        }
        return redirect()->back()->with('success', 'Guide Added Successfully');
    }

    public function edit($id){
        $data = Guides::find($id);
        return view('admin.guide.edit', compact('data'));
    }

    public function update($id, Request $request){
        $request->validate([
            'name' => 'required|unique:documents,name,'.$id,
        ]);

        $doc = Guides::find($id);
        $doc->name = $request->name;
        //$doc->status = $request->status;
        if($request->hasFile('file')){
            $imageName = time().'.'.$request->file->extension();
            $request->file->move(public_path('guide'), $imageName);
            $doc->file = 'guide/'.$imageName;
        }
        $doc->save();

        return redirect()->back()->with('success', 'Guide Updated Successfully');
    }

    public function show($id){
        $data = Guides::find($id);
        return view('admin.guide.show', compact('data'));
    }

    public function destroy($id){
        $data = Guides::find($id);
        $data->status = 1;
        $data->save();
        return redirect()->back()->with('success', 'Guide Deleted Successfully');
    }

}
