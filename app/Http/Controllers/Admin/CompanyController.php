<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Tags;
use App\Models\Category;
use App\Models\Company;
use App\Models\Partner;
use App\Models\Consultant;
use App\Models\CompanyTags;
use App\Models\CompanyCategories;
use App\Models\Documents;
use App\Models\Auditor;
use App\Models\CertificationBody;
use App\Models\CompanyCertification;
use App\Models\CertificationCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Mail;
use App\Mail\CompanyAddMail;
use Illuminate\Support\Str;

class CompanyController extends Controller
{
    function __construct(){
        $this->middleware('permission:view company|create company|edit company|delete company', ['only' => ['index','show']]);
        $this->middleware('permission:create company', ['only' => ['create','store']]);
        $this->middleware('permission:edit company', ['only' => ['edit','update']]);
        $this->middleware('permission:delete company', ['only' => ['destroy']]);
        $this->middleware('permission:assign company user', ['only' => ['user','userStore']]);
        $this->middleware('permission:login company', ['only' => ['dashboard']]);
        $this->middleware('permission:view assign certification', ['only' => ['companyCertificationAssign']]);
        $this->middleware('permission:create assign certification', ['only' => ['companyCertificationAdd']]);
        $this->middleware('permission:edit assign certification', ['only' => ['companyCertificationEdit','companyCertificationUpdate']]);
        $this->middleware('permission:delete assign certification', ['only' => ['companyCertificationDestroy']]);
    }

    public function index(Request $request){
        $loginUserId = Auth::id();
        $data = User::where('is_admin', 1)
        ->where('is_company', 1)
        ->where('status', 0)
        ->whereHas('assignedTo', function($q) use ($loginUserId) {
            $q->where('parent_user_id', $loginUserId);
        })
        ->with('assignedTo')
        ->orderBy('id', 'desc');
        
        if($request->search != null){
            $data = $data->where('name', 'like', '%' . $request->search . '%');
        }
        $data = $data->get();
        return view('admin.company.index', compact('data'));
    }

    public function create(){
        $tags = Tags::where('status', 0)->get();
        $categories = Category::where('status', 0)->get();
        $partners = Partner::where('status', 0)->get();
        $consultants = Consultant::all();
        return view('admin.company.create', compact('tags', 'categories', 'partners', 'consultants'));
    }

    public function store(Request $request){
        if($request->consultant) {
            $request->validate([
                'name'  => 'required',
                'logo'  => 'required|image',
                'email' => 'required|unique:users,email',
                'phone_num' => 'required',
            ]);
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make(Str::random(10));
            $user->is_admin = 1;
            $user->is_company = 1;
            $user->save();
            $user->assignRole('company');
            $company = new Company();
            if ($request->hasFile('logo')) {
                $imageName = time().'.'.$request->logo->extension();
                $request->logo->move(public_path('company/logos'), $imageName);
                $company->logo = 'company/logos/'.$imageName;
            }
            $company->phone_num = $request->phone_num;
            $company->consultant_id = $request->consultant;
            $user->company()->save($company);
        }else{
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
                'prefix_company_id' => 'required'
            ]);

            if($request->company_id != null){
                $request->validate([
                    'company_id' => 'required|unique:companies,company_id',
                ]);
            }

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
            $company->policy_date = $request->policy_date;
            $company->company_email = $request->company_email;
            $company->logo_width = $request->logo_width;
            $company->logo_height = $request->logo_height;
            $company->company_id = $request->company_id;
            $company->adding_certification = $request->adding_certification;
            $company->referred_by = $request->referred_by;
            $company->prefix_company_id = $request->prefix_company_id;
            
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
        }

        return redirect()->back()->with('success', 'Company Added Successfully');
    }

    public function edit($id){
        $loginUserId = Auth::id();
        $data = User::where('id', $id)
                ->whereHas('assignedTo', function($q) use ($loginUserId) {
                    $q->where('parent_user_id', $loginUserId);
                })
                ->first();
        if (!$data) {
            abort(403, 'You are not authorized to edit this user.');
        }
        $tags = Tags::where('status', 0)->get();
        $categories = Category::where('status', 0)->get();
        $partners = Partner::where('status', 0)->get();
        $consultants = Consultant::all();
        return view('admin.company.edit', compact('data', 'tags', 'categories', 'partners', 'consultants'));
    }

    public function update($id, Request $request){
        $company = Company::where('user_id', $id)->firstOrFail();
        $user    = User::findOrFail($id);
        if ($request->consultant) {
            $request->validate([
                'name'      => 'required',
                'logo'      => 'nullable|image',
                'email'     => 'required|unique:users,email,' . $id,
                'phone_num' => 'required',
            ]);
            $user->name  = $request->name;
            $user->email = $request->email;
            $user->save();
            if ($request->hasFile('logo')) {
                $imageName = time() . '.' . $request->logo->extension();
                $request->logo->move(public_path('company/logos'), $imageName);
                $company->logo = 'company/logos/' . $imageName;
            }
            $company->phone_num     = $request->phone_num;
            $company->consultant_id = $request->consultant;
            $company->save();
        }else {
            $request->validate([
                'name'             => 'required',
                'email'            => 'required|unique:users,email,' . $id,
                'director_name'    => 'required',
                'short_name'       => 'required',
                'tags'             => 'required',
                'address'          => 'required',
                'website'          => 'required',
                'registration_num' => 'required',
                'phone_num'        => 'required',
                'company_email'    => 'required',
                'logo_width'       => 'required',
                'logo_height'      => 'required',
                'prefix_company_id'=> 'required',
            ]);

            if ($request->password != null) {
                $request->validate([
                    'password' => 'required|confirmed',
                ]);
            }

            if ($request->company_id != null) {
                $request->validate([
                    'company_id' => 'required|unique:companies,company_id,' . $company->id,
                ]);
            }

            $user->name  = $request->name;
            $user->email = $request->email;
            if ($request->password != null) {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            if ($request->hasFile('logo')) {
                $imageName = time() . '.' . $request->logo->extension();
                $request->logo->move(public_path('company/logos'), $imageName);
                $company->logo = 'company/logos/' . $imageName;
            }

            $company->director_name       = $request->director_name;
            $company->short_name          = $request->short_name;
            $company->total_user          = $request->total_user;
            $company->status              = $request->status;
            $company->address             = $request->address;
            $company->version             = $request->version;
            $company->issue_date          = $request->issue_date;
            $company->website             = $request->website;
            $company->registration_num    = $request->registration_num;
            $company->phone_num           = $request->phone_num;
            $company->company_email       = $request->company_email;
            $company->logo_width          = $request->logo_width;
            $company->logo_height         = $request->logo_height;
            $company->company_id          = $request->company_id;
            $company->adding_certification= $request->adding_certification;
            $company->referred_by         = $request->referred_by;
            $company->prefix_company_id   = $request->prefix_company_id;
            $company->policy_date         = $request->policy_date;
            $company->consultant_id       = null;
            $company->save();

            $tags = array_diff($request->tags, ["all"]);
            $user->tags()->syncWithPivotValues($tags, ['company_id' => $company->id]);
            
            $categories = $request->categories ?? [];
            $categories = array_diff($categories, ["all"]);
            $user->categories()->syncWithPivotValues($categories, ['company_id' => $company->id]);
        }

        return redirect()->back()->with('success', 'Company Updated Successfully');
    }


    public function user($company_id){
        $loginUserId = Auth::id();
        $data = User::where('id', $company_id)
                ->whereHas('assignedTo', function($q) use ($loginUserId) {
                    $q->where('parent_user_id', $loginUserId);
                })
                ->first();
        if (!$data) {
            abort(403, 'You are not authorized to edit this user.');
        }
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
        $loginUserId = Auth::id();
        $user = User::where('id', $company_id)
                ->whereHas('assignedTo', function($q) use ($loginUserId) {
                    $q->where('parent_user_id', $loginUserId);
                })
                ->first();
        if (!$user) {
            abort(403, 'You are not authorized to edit this user.');
        }
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

    public function companyCertificationAssign(Request $request){
        $loginUserId = Auth::id();
        $user = User::where('is_admin', 1)
        ->where('is_company', 1)
        ->where('status', 0)
        ->whereHas('assignedTo', function($q) use ($loginUserId) {
            $q->where('parent_user_id', $loginUserId); // filter by logged-in user
        })
        ->with('assignedTo')
        ->orderBy('id', 'desc')
        ->get();
        $certification = CertificationCategory::where('status', 0)->get();
        $auditors = Auditor::all();
        $certification_body = CertificationBody::where('status', 0)->get();
        $assigned_to = User::where('is_admin', 0)->where('status', 0)->orderBy('id', 'desc')->get();

        $assignedUserIds = User::whereHas('assignedTo', function($q) use ($loginUserId) {
            $q->where('parent_user_id', $loginUserId);
        })->pluck('id')->toArray();
        
        $data = CompanyCertification::whereIn('user_id', $assignedUserIds)->orderBy('id', 'desc');
        if($request->company_name != null){
            $company_name = $request->company_name;
            $data = $data->whereHas('user', function($q) use ($company_name){
                $q->where('id', $company_name);
            });
        }
        if($request->certification_type != null){
            $certification_type = $request->certification_type;
            $data = $data->whereHas('certificate', function($q) use ($certification_type){
                $q->where('id', $certification_type);
            });
        }
        if($request->certification_body != null){
            $certificate_body = $request->certification_body;
            $data = $data->whereHas('body', function($q) use ($certificate_body){
                $q->where('id', $certificate_body);
            });
        }
        if($request->certificate_number != null){
            $data = $data->where('certification_number', 'LIKE', '%' . $request->certificate_number . '%');
        }
        if($request->audit_type != null){
            $data = $data->where('audit_type', 'LIKE', '%' . $request->audit_type . '%');
        }


        $data = $data->get();
        return view('admin.company.certification', compact('user', 'certification', 'data', 'auditors', 'certification_body', 'assigned_to'));
    }

    public function companyCertificationAdd(Request $request){
        $id = $request->company;
        $company = Company::where('user_id', $id)->first();
        $user = User::find($id);

        $data = new CompanyCertification();
        $data->user_id = $user->id;
        $data->company_id = $company->id;
        $data->certifications_id = $request->certification_category;
        $data->certification_name = $request->certification_name;
        $data->issue_date = $request->issue_date;
        $data->expire_date = $request->expire_date;
        $data->auditor_id = $request->auditor;
        $data->username = $request->username;
        $data->password = $request->password;
        $data->certification_number = $request->certification_number;
        $data->certification_body_id = $request->certification_body;
        $data->next_audit_due_date = $request->next_audit_due_date;
        $data->previous_certification = $request->previous_certification;
        $data->assigned_to = $request->assigned_to;
        $data->status = $request->status;
        $data->save();
        return redirect()->back()->with('success', 'Company Certification Assigned Successfully');
    }

    public function companyCertificationEdit($id){
        $loginUserId = Auth::id();
        $assignedUserIds = User::whereHas('assignedTo', function($q) use ($loginUserId) {
            $q->where('parent_user_id', $loginUserId);
        })->pluck('id')->toArray();
        $data = CompanyCertification::where('id', $id)
                ->whereIn('user_id', $assignedUserIds)
                ->first();
        if (!$data) {
            abort(403, 'You are not authorized to edit this certification.');
        }
        $user = User::where('is_admin', 1)
        ->where('is_company', 1)
        ->where('status', 0)
        ->whereHas('assignedTo', function($q) use ($loginUserId) {
            $q->where('parent_user_id', $loginUserId); // filter by logged-in user
        })
        ->with('assignedTo')
        ->orderBy('id', 'desc')
        ->get();

        $assigned_to = User::where('is_admin', 0)
        ->where('status', 0)
        ->orderBy('id', 'desc')
        ->get();
        $certification = CertificationCategory::where('status', 0)->get();
        $auditors = Auditor::all();
        $certification_body = CertificationBody::where('status', 0)->get();
        $preview_data = CompanyCertification::where('company_id', $data->company_id)->get();
        return view('admin.company.certification-edit', compact('data', 'user', 'certification', 'auditors', 'certification_body', 'assigned_to', 'preview_data'));
    }

    public function companyCertificationUpdate(Request $request, $id){
        $company_id = $request->company;
        $company = Company::where('user_id', $company_id)->first();
        $user = User::find($company_id);

        $data = CompanyCertification::find($id);
        $data->user_id = $user->id;
        $data->company_id = $company->id;
        $data->certifications_id = $request->certification;
        $data->certification_name = $request->certification_name;
        $data->issue_date = $request->issue_date;
        $data->expire_date = $request->expire_date;
        $data->auditor_id = $request->auditor;
        $data->username = $request->username;
        $data->password = $request->password;
        $data->certification_number = $request->certification_number;
        $data->certification_body_id = $request->certification_body;
        $data->next_audit_due_date = $request->next_audit_due_date;
        $data->previous_certification = $request->previous_certification;
        $data->assigned_to = $request->assigned_to;
        $data->status = $request->status;
        $data->save();
        return redirect()->back()->with('success', 'Company Certification Updated Successfully');
    }

    public function companyCertificationDestroy($id){
        $data = CompanyCertification::find($id)->delete();
        return redirect()->back()->with('success', 'Company Certification Deleted Successfully');
    }

    public function getCertificationByCompany(Request $request){
        $id = $request->id;
        $data = CompanyCertification::where('user_id', $id)->get();
        return response()->json(['success' => true, 'data' => $data]);
    }

    public function autocomplete(Request $request)
    {
        $search = $request->get('query'); // input from ajax

        $companies = \DB::table('companies')
            ->join('users', 'companies.user_id', '=', 'users.id')
            ->where('companies.status', 0)
            ->where('users.status', 0)
            ->where(function($query) use ($search) {
                $query->where('companies.director_name', 'LIKE', "%{$search}%")
                    ->where('users.name', 'LIKE', "%{$search}%")
                    ->orWhere('users.email', 'LIKE', "%{$search}%");
            })
            ->select('companies.*', 'users.name as user_name', 'users.email as user_email')
            ->limit(10)
            ->get();



        $data = [];
        foreach ($companies as $company) {
            $data[] = [
                'id'   => $company->id,
                'name' => $company->user_name,
            ];
        }

        return response()->json($data);
    }

}
