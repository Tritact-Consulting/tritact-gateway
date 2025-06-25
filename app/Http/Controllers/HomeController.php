<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Company;
use App\Models\Tags;
use App\Models\Documents;
use App\Models\Category;
use App\Models\Guides;
use App\Models\AssignAudit;
use Illuminate\Support\Facades\Hash;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->is_company == 1){
            $tags = Auth::user()->tags->pluck('id')->toArray();
        }else{
            $user = User::find(Auth::user()->user_id);
            $tags = $user->tags->pluck('id')->toArray();
        }
        $get_tags = Tags::whereIn('id', $tags)->get();

        $document_count = Documents::where('status', 0)->whereHas('tags', function($q) use ($tags){
            $q->whereIn('id', $tags);
        })->count();

        if(Auth::user()->is_company == 1){
            $categories = Auth::user()->categories->pluck('id')->toArray();
        }else{
            $user = User::find(Auth::user()->user_id);
            $categories = $user->categories->pluck('id')->toArray();
        }
        $get_categories = Category::whereIn('id', $categories)->get();

        $guide_count = Guides::where('status', 0)->whereHas('categories', function($q) use ($categories){
            $q->whereIn('id', $categories);
        })->count();

        if(Auth::user()->is_company == 1){
            $assign_audit = AssignAudit::where('company_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        }else{
            $user = User::find(Auth::user()->user_id);
            $assign_audit = AssignAudit::where('company_id', $user->id)->orderBy('id', 'desc')->get();
        }

        return view('home', compact('guide_count', 'document_count', 'assign_audit'));
    }

    public function profile(){
        return view('profile');
    }

    public function profileUpdate(Request $request){
        $id = Auth::user()->id;
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$id,
            'signature' => 'required',
        ]);

        if(Auth::user()->is_company == 1){
            $request->validate([
                'signature' => 'required',
            ]);
        }

        if($request->password != null){
            $request->validate([
                'password' => 'required|confirmed',
            ]);
        }
        
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password != null){
            $user->password = Hash::make($request->password);
        }
        $user->save();

        if(Auth::user()->is_company == 1){
            $company = Company::where('user_id', $id)->first();
            $company->signature = $request->signature;
            $company->address = $request->address;
            $company->save();
        }

        return redirect()->back()->with('success', 'Profile Updated Successfully');
    }
}
