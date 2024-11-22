<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Tags;
use App\Models\Company;
use App\Models\CompanyTags;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;

class CompanyController extends Controller
{
    public function index(){
        $data = User::where('is_admin', 1)->where('is_company', 1)->orderBy('id', 'desc')->get();
        return view('admin.company.index', compact('data'));
    }

    public function create(){
        $tags = Tags::where('status', 0)->get();
        return view('admin.company.create', compact('tags'));
    }

    public function store(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed',
            'director_name' => 'required',
            'short_name' => 'required',
            'tags' => 'required'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->is_admin = 1;
        $user->is_company = 1;
        $user->save();
        $user->assignRole('company');
        $company = new Company();
        if($request->hasFile('logo')){
            $imageName = time().'.'.$request->logo->extension();
            $request->logo->move(public_path('company/logos'), $imageName);
            $company->logo = 'company/logos/'.$imageName;
        }
        $company->director_name = $request->director_name;
        $company->short_name = $request->short_name;
        $company->total_user = $request->total_user;
        $company->status = $request->status;
        $company->address = $request->address;
        $company->version = $request->version;
        $company->issue_date = $request->issue_date;

        $user->company()->save($company);

        $tags = $request->tags;
        foreach($tags as $key => $value){
            if($value != 'all'){
                $data = new CompanyTags();
                $data->user_id = $user->id;
                $data->company_id = $company->id;
                $data->tag_id = $value;
                $data->save();
            }
        }

        return redirect()->back()->with('success', 'Company Added Successfully');
    }

    public function edit($id){
        $data = User::find($id);
        $tags = Tags::where('status', 0)->get();
        return view('admin.company.edit', compact('data', 'tags'));
    }

    public function update($id, Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$id,
            'director_name' => 'required',
            'short_name' => 'required',
            'tags' => 'required',
            'version' => 'required',
            'issue_date' => 'required',
        ]);

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

        $company = Company::where('user_id', $id)->first();
        if($request->hasFile('logo')){
            $imageName = time().'.'.$request->logo->extension();
            $request->logo->move(public_path('company/logos'), $imageName);
            $company->logo = 'company/logos/'.$imageName;
        }
        $company->director_name = $request->director_name;
        $company->short_name = $request->short_name;
        $company->total_user = $request->total_user;
        $company->status = $request->status;
        $company->address = $request->address;
        $company->version = $request->version;
        $company->issue_date = $request->issue_date;
        $company->save();
        $old_tag = $user->tags->pluck('id')->toArray();
        $tags = $request->tags;
        $tags = array_diff($tags, ["all"]);
        $user->tags()->syncWithPivotValues($tags, ['company_id' => $company->id]);

        return redirect()->back()->with('success', 'Company Updated Successfully');
    }

    public function user($company_id){
        $data = User::find($company_id);
        return view('admin.company.user', compact('data'));
    }

    public function userStore(Request $request){
        $data = User::find($request->company_id);
        if($data->company->remaining_users() != 0){
            $request->validate([
                'name' => 'required',
                'email' => 'required|unique:users,email',
                'password' => 'required|confirmed',
                'company_id' => 'required',
                'version' => 'required',
                'issue_date' => 'required',
            ]);
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->user_id = $request->company_id;
            $user->is_company = 0;
            $user->is_admin = 1;
            $user->save();
            return redirect()->back()->with('success', 'User Added Successfully');
        }else{
            return redirect()->back()->with('warning', 'User Limit Exceeded');
        }
    }

    public function userEdit($company_id, $id){
        $data = User::find($company_id);
        $user = User::find($id);
        if($user->user_id == $company_id){
            return view('admin.company.user-edit', compact('data', 'user'));
        }else{
            return redirect()->back();
        }
    }

    public function userUpdate($id, Request $request){        
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$id,
        ]);
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
        return redirect()->back()->with('success', 'Company User Updated Successfully');
    }
}
