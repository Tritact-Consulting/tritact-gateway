<?php

namespace App\Http\Controllers\Admin;

use App\Models\Documents;
use App\Models\Tags;
use App\Models\FileKeyword;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use File;

class DocumentController extends Controller
{
    public function index(){
        $data = Documents::with('tags')->orderBy('id', 'desc')->get();
        return view('admin.document.index', compact('data'));
    }

    public function create(){
        $tags = Tags::where('status', 0)->get();
        return view('admin.document.create', compact('tags'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:documents,name',
            'file' => 'required',
            'tags' => 'required',
        ]);
        $tags = $request->tags;
        $doc = new Documents();
        $doc->name = $request->name;
        //$doc->status = $request->status;
        if($request->hasFile('file')){
            $imageName = time().'.'.$request->file->extension();
            $request->file->move(public_path('document'), $imageName);
            $doc->file = 'document/'.$imageName;
        }
        $doc->save();
        $doc->tags()->sync($tags);

        return redirect()->back()->with('success', 'Document Added Successfully');
    }

    public function edit($id){
        $tags = Tags::where('status', 0)->get();
        $data = Documents::find($id);
        return view('admin.document.edit', compact('data', 'tags'));
    }

    public function update($id, Request $request){
        $request->validate([
            'name' => 'required|unique:documents,name,'.$id,
            'tags' => 'required',
        ]);
        $tags = $request->tags;
        $doc = Documents::find($id);
        $doc->name = $request->name;
        //$doc->status = $request->status;
        if($request->hasFile('file')){
            $imageName = time().'.'.$request->file->extension();
            $request->file->move(public_path('document'), $imageName);
            $doc->file = 'document/'.$imageName;
        }
        $doc->save();
        $doc->tags()->sync($tags);

        return redirect()->back()->with('success', 'Document Updated Successfully');
    }

    public function show($id){
        $data = Documents::find($id);
        return view('admin.document.show', compact('data'));
    }

    public function documentRead(Request $request){
        $data = Documents::find($request->id);
        $lines = file(public_path($data->file));
        foreach($lines as $line) {
            dump($line);
            $get_data = $this->special_chars($line);
            dump($get_data);
        }
    }

    function special_chars($str){
        $str = htmlentities($str, ENT_COMPAT, 'iso-8859-1');
        $str = preg_replace('/&(.)(acute|cedil|circ|lig|grave|ring|tilde|uml);/', "$1", $str);
        return $str;
    }

    public function documentKeyword(Request $request){

        $file_keyword = $request->file_keyword;
        if($file_keyword != null){
            $request->validate([
                'file_keyword' => 'required',
            ]);
            foreach($file_keyword as $key => $value){
                if($value['column'] != ''){
                    $data = new FileKeyword();
                    $data->doc_keyword = $value['keyword'];
                    $data->data_keyword = $value['column'];
                    $data->save();
                }
            }
        }

        $old_keyword = $request->old_keyword;
        $old_column = $request->old_column;

        if($old_keyword != null){
            foreach($old_keyword as $key => $value){
                $data = FileKeyword::find($key);
                $data->doc_keyword = $value;
                $data->save();
            }
        }

        if($old_column != null){
            foreach($old_column as $key => $value){
                $data = FileKeyword::find($key);
                $data->data_keyword = $value;
                $data->save();
            }
        }

        return redirect()->back()->with('success', 'Document Keyword Updated Successfully');
    }

    public function documentDelete(Request $request){
        $id = $request->id;
        $data = FileKeyword::find($id);
        $data->delete();
        return true;
    }
}
