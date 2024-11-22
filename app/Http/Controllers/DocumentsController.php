<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Documents;
use App\Models\User;
use App\Models\FileKeyword;
use App\Models\Tags;
use App\Models\DocVersion;
use App\Models\SupportiveDocument;
use File;
use Notification;
use Illuminate\Support\Str;
use App\Notifications\DocumentDownloadSuccessful;

class DocumentsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('permission:view document', ['only' => ['index']]);
        $this->middleware('permission:download document', ['only' => ['download']]);
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        if(Auth::user()->is_company == 1){
            $tags = Auth::user()->tags->pluck('id')->toArray();
        }else{
            $user = User::find(Auth::user()->user_id);
            $tags = $user->tags->pluck('id')->toArray();
        }
        $get_tags = Tags::whereIn('id', $tags)->get();

        $data = Documents::whereHas('tags', function($q) use ($tags){
            $q->whereIn('id', $tags);
        });

        if($request->tags != null){
            $request_tags = $request->tags;
            $data = $data->whereHas('tags', function($q) use ($request_tags){
                $q->whereIn('id', $request_tags);
            });
        }

        $data = $data->orderBy('id', 'desc')->get();


        return view('document.index', compact('data', 'get_tags'));
    }

    public function download($id, $supportive = 0){
        $file_name = '';
        $version_name = '';
        $issue_date = '';
        if($supportive == 0){
            $data = Documents::find($id);
            $file_name = $data->name;
            $version_name = $data->version;
            $issue_date = $data->issue_date;
        }else{
            $data = SupportiveDocument::find($id);
            $file_name = $data->document->name;
            $version_name = $data->version;
            $issue_date = $data->issue_date;
        }
        $file = public_path($data->file);
        $phpword = new \PhpOffice\PhpWord\TemplateProcessor($file);
        $file_keyowords = FileKeyword::all();
        foreach($file_keyowords as $key => $value){
            $director_name = '';
            $short_name = '';
            $company_name = '';
            $logo_path = '';
            $address = '';
            if(Auth::user()->is_company == 1){
                $director_name = Auth::user()->company->director_name;
                $short_name = Auth::user()->company->short_name;
                $company_name = Auth::user()->name;
                $logo_path = public_path(Auth::user()->company->logo);
                $address = Auth::user()->company->address;
            }else{
                $data = User::find(Auth::user()->user_id);
                $director_name = $data->company->director_name;
                $short_name = $data->company->short_name;
                $company_name = $data->name;
                $logo_path = public_path($data->company->logo);
                $address = $data->company->address;
            }

            if($value->data_keyword == 'director_name'){
                $phpword->setValue($value->doc_keyword, $director_name);
            }elseif($value->data_keyword == 'short_name'){
                $phpword->setValue($value->doc_keyword, $short_name);
            }elseif($value->data_keyword == 'name'){
                $phpword->setValue($value->doc_keyword, $company_name);
            }elseif($value->data_keyword == 'address'){
                $phpword->setValue($value->doc_keyword, $address);
            }elseif($value->data_keyword == 'version'){
                if($version_name != ''){
                    $phpword->setValue($value->doc_keyword, $version_name);
                }
            }elseif($value->data_keyword == 'issue_date'){
                $phpword->setValue($value->doc_keyword, $issue_date);
            }elseif($value->data_keyword == 'logo'){
                $phpword->setImageValue($value->doc_keyword, $logo_path);
            }
        }
        // Notify to admin
        $admin = User::where('is_admin', 0)->where('is_company', 0)->first();
        $notify_data = ['text' => Auth::user()->name . ' download a Document - ' . $data->name, 'name' => Auth::user()->name];
        Notification::send($admin, new DocumentDownloadSuccessful($notify_data));
        header("Content-Disposition: attachment; filename=".$file_name.".docx");
        $phpword->saveAs('php://output');
    }

    public function store(Request $request){
        $request->validate([
            'version' => 'required',
            'issue_date' => 'required',
            'file' => 'required',
            'document_id' => 'required',
        ]);

        $data = new SupportiveDocument();
        $data->user_id = Auth::user()->id;
        $data->version = $request->version;
        $data->issue_date = $request->issue_date;
        $data->document_id = $request->document_id;
        if($request->hasFile('file')){
            $path = Str::slug(Auth::user()->name).'/'.Str::slug($request->version);
            $public_path = public_path('document/'.$path);
            $imageName = time().'.'.$request->file->extension();
            $request->file->move(public_path('document/'.$path), $imageName);
            $data->file = 'document/'.$path.'/'.$imageName;
        }
        $data->save();
        return redirect()->back()->with('success', 'Supportive Document Added Successfully');        
    }
    
}
