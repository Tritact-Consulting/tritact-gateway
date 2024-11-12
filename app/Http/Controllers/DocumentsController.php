<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Documents;
use File;

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
    public function index()
    {
        $data = Documents::orderBy('id', 'desc')->get();
        return view('document.index', compact('data'));
    }

    public function download($id){
        $data = Documents::find($id);
        $file = public_path($data->file);
        $phpword = new \PhpOffice\PhpWord\TemplateProcessor($file);
        foreach($data->file_keyowords as $key => $value){
            $director_name = '';
            $short_name = '';
            $company_name = '';
            if(Auth::user()->is_company == 1){
                $director_name = Auth::user()->company->director_name;
                $short_name = Auth::user()->company->short_name;
                $company_name = Auth::user()->name;
            }else{
                $data = User::find(Auth::user()->user_id);
                $director_name = $data->company->director_name;
                $short_name = $data->company->short_name;
                $company_name = $data->name;
            }

            if($value->data_keyword == 'director_name'){
                $phpword->setValue($value->doc_keyword, $director_name);
            }elseif($value->data_keyword == 'short_name'){
                $phpword->setValue($value->doc_keyword, $short_name);
            }elseif($value->data_keyword == 'name'){
                $phpword->setValue($value->doc_keyword, $company_name);
            }
        }
        header("Content-Disposition: attachment; filename=edited.docx");
        $phpword->saveAs('php://output');
    }
    
}