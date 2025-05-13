<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Tags;
use App\Models\Category;
use App\Models\Company;
use App\Models\CompanyTags;
use App\Models\CompanyCategories;
use App\Models\Documents;
use App\Models\CompanyCertification;
use App\Models\CertificationCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Mail;
use App\Mail\CompanyAddMail;

class CompanyController extends Controller
{
    public function index(){
        $data = User::where('is_admin', 1)->where('is_company', 1)->where('status', 0)->orderBy('id', 'desc')->get();
        return view('admin.company.index', compact('data'));
    }

    public function create(){
        $tags = Tags::where('status', 0)->get();
        $categories = Category::where('status', 0)->get();
        return view('admin.company.create', compact('tags', 'categories'));
    }

    public function store(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed',
            'director_name' => 'required',
            'short_name' => 'required',
            'tags' => 'required',
            'address' => 'required',
            'website' => 'required',
            'registration_num' => 'required',
            'phone_num' => 'required',
            'company_email' => 'required',
            'logo_width' => 'required',
            'logo_height' => 'required',
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
        $company->website = $request->website;
        $company->registration_num = $request->registration_num;
        $company->phone_num = $request->phone_num;
        $company->company_email = $request->company_email;
        $company->logo_width = $request->logo_width;
        $company->logo_height = $request->logo_height;
        
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

        $categories = $request->categories;
        if($categories != null){
            foreach($categories as $key => $value){
                if($value != 'all'){
                    $data = new CompanyCategories();
                    $data->user_id = $user->id;
                    $data->company_id = $company->id;
                    $data->category_id = $value;
                    $data->save();
                }
            }
        }

        $credentials = $request->credentials;
        if($credentials == 1){
            $email_template = $request->email_temp;
            $mailData = [
                'body' => $email_template
            ];
            Mail::to($request->sender_email)->send(new CompanyAddMail($mailData));
        }

        return redirect()->back()->with('success', 'Company Added Successfully');
    }

    public function edit($id){
        $data = User::find($id);
        $tags = Tags::where('status', 0)->get();
        $categories = Category::where('status', 0)->get();
        return view('admin.company.edit', compact('data', 'tags', 'categories'));
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
            'address' => 'required',
            'website' => 'required',
            'registration_num' => 'required',
            'phone_num' => 'required',
            'company_email' => 'required',
            'logo_width' => 'required',
            'logo_height' => 'required',
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
        $company->website = $request->website;
        $company->registration_num = $request->registration_num;
        $company->phone_num = $request->phone_num;
        $company->company_email = $request->company_email;
        $company->logo_width = $request->logo_width;
        $company->logo_height = $request->logo_height;
        $company->save();
        $old_tag = $user->tags->pluck('id')->toArray();
        $tags = $request->tags;
        $tags = array_diff($tags, ["all"]);
        $user->tags()->syncWithPivotValues($tags, ['company_id' => $company->id]);

        $old_category = $user->categories->pluck('id')->toArray();
        $categories = $request->categories;
        if($categories != null){
            $categories = array_diff($categories, ["all"]);
        }
        $user->categories()->syncWithPivotValues($categories, ['company_id' => $company->id]);

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
    
    public function dashboard($company_id, Request $request){
        $user = User::find($company_id);
        $tags = $user->tags->pluck('id')->toArray();
        $get_tags = Tags::whereIn('id', $tags)->get();
        $data = Documents::where('status', 0)->whereHas('tags', function($q) use ($tags){
            $q->whereIn('id', $tags);
        });
        if($request->tags != null){
            $request_tags = $request->tags;
            $data = $data->whereHas('tags', function($q) use ($request_tags){
                $q->whereIn('id', $request_tags);
            });
        }
        $data = $data->orderBy('id', 'desc')->get();
        return view('admin.company.dashboard.index', compact('user', 'get_tags', 'data'));
    }

    public function destroy($id){
        $data = User::find($id);
        $data->status = 1;
        $data->save();
        return redirect()->back()->with('success', 'Company Deleted Successfully');
    }

    public function companyCertificationAssign(){
        $user = User::where('is_admin', 1)->where('is_company', 1)->where('status', 0)->orderBy('id', 'desc')->get();
        $certification = CertificationCategory::where('status', 0)->get();
        $data = CompanyCertification::orderBy('id', 'desc')->get();
        return view('admin.company.certification', compact('user', 'certification', 'data'));
    }

    public function companyCertificationAdd(Request $request){
        $id = $request->company;
        $company = Company::where('user_id', $id)->first();
        $user = User::find($id);

        $data = new CompanyCertification();
        $data->user_id = $user->id;
        $data->company_id = $company->id;
        $data->certifications_id = $request->certification;
        $data->certification_name = $request->certification_name;
        $data->issue_date = $request->issue_date;
        $data->expire_date = $request->expire_date;
        $data->save();
        return redirect()->back()->with('success', 'Company Certification Assigned Successfully');
    }
}
