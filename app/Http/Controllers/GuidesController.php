<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Guides;
use App\Models\Category;
use App\Models\User;
use File;
use Illuminate\Support\Str;
use Response;

class GuidesController extends Controller
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
            $categories = Auth::user()->categories->pluck('id')->toArray();
        }else{
            $user = User::find(Auth::user()->user_id);
            $categories = $user->categories->pluck('id')->toArray();
        }
        $get_categories = Category::whereIn('id', $categories)->get();

        $data = Guides::where('status', 0)->whereHas('categories', function($q) use ($categories){
            $q->whereIn('id', $categories);
        });

        $data = $data->orderBy('id', 'desc')->get();

        return view('guide.index', compact('data'));
    }
    
    public function downloadAll(Request $request){
        $doc = $request->doc;
        $doc_id = explode(',', $doc[0]);
        for($i = 0; $i < count($doc_id); $i++){
            $return_file = $this->download($doc_id[$i], 0, 1);
            dump($return_file);
        }
    }

    public function download($id){
        $data = Guides::find($id);
        $file = public_path($data->file);
        $file_name = $data->name;
        $extension = pathinfo($file, PATHINFO_EXTENSION);
        return Response::download($file, $file_name.'.'.$extension);
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
