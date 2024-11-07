<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Company;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CompanyController extends Controller
{
    public function index(){
        $data = User::where('is_admin', 1)->where('is_company', 1)->orderBy('id', 'desc')->get();
        return view('admin.company.index', compact('data'));
    }

    public function create(){
        return view('admin.company.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed',
            'director_name' => 'required',
            'short_name' => 'required',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->is_admin = 1;
        $user->is_company = 1;
        $user->save();

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

        $user->company()->save($company);
        return redirect()->back()->with('success', 'Company Added Successfully');
    }

    public function edit($id){
        $data = User::find($id);
        return view('admin.company.edit', compact('data'));
    }

    public function update($id, Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$id,
            'director_name' => 'required',
            'short_name' => 'required',
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
        $company->save();
        return redirect()->back()->with('success', 'Company Updated Successfully');
    }

    public function user($company_id){
        $data = User::find($company_id);
        return view('admin.company.user', compact('data'));
    }

    public function userStore(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed',
            'company_id' => 'required',
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
    }
}
