<?php

namespace App\Http\Controllers\Admin;

use App\Models\Documents;
use App\Models\Tags;
use App\Models\FileKeyword;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DocumentsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use File;
use App\Notifications\DocumentTagSuccessful;
use Auth;
use Notification;

class DocumentController extends Controller
{
    public function index(){
        $data = Documents::with('tags')->where('status', 0)->orderBy('id', 'desc')->get();
        return view('admin.document.index', compact('data'));
    }

    public function create(){
        $tags = Tags::where('status', 0)->get();
        return view('admin.document.create', compact('tags'));
    }

    public function store(Request $request){
        if($request->bulk == 0){
            $request->validate([
                'name' => 'required',
            ]);
        }
        $request->validate([
            'file' => 'required',
            'tags' => 'required',
        ]);

        $tags = $request->tags;
        //$doc->status = $request->status;
        if($request->hasFile('file')){
            $files = $request->file('file');
            foreach($files as $file){
                $doc = new Documents();
                if($request->bulk == 0){
                    $doc->name = $request->name;
                }else{
                    $doc->name = $file->getClientOriginalName();
                }
                $imageName = time().'.'.$file->extension();
                $file->move(public_path('document'), $imageName);
                $doc->file = 'document/'.$imageName;
                $doc->save();
                $doc->tags()->sync($tags);
                $data = User::where('is_admin', 1)->whereHas('tags', function($a) use ($tags){
                    $a->whereIn('tag_id', $tags);
                })->get();
        
                foreach($data as $key => $value){ 
                    $notify_data = ['text' => $doc->name . ' has been added in tag' , 'name' => Auth::user()->name];
                    Notification::send($value, new DocumentTagSuccessful($notify_data));
                }
            }
        }
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
        $request->validate([
            'keyword' => 'required',
            'column' => 'required',
        ]);

        $data = new FileKeyword();
        $data->doc_keyword = $request->keyword;
        $data->data_keyword = $request->column;
        $data->save();

        return redirect()->back()->with('success', 'Document Keyword Updated Successfully');
    }

    public function documentDelete(Request $request){
        $id = $request->id;
        $data = FileKeyword::find($id);
        $data->delete();
        return true;
    }

    public function destroy($id){
        $data = Documents::find($id);
        $data->status = 1;
        $data->save();
        return redirect()->back()->with('success', 'Document Deleted Successfully');
    }

    public function dashboardDocuments($id, $supportive, $company_id){
        $data = new DocumentsController();
        $data->download($id, $supportive, 0, $company_id);
    }
}
