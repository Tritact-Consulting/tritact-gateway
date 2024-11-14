<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Notification;
use App\Notifications\UserCreationSuccessful;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('permission:view user', ['only' => ['index']]);
        $this->middleware('permission:create user', ['only' => ['create', 'store']]);
        $this->middleware('permission:update user', ['only' => ['update', 'edit']]);
        $this->middleware('permission:delete user', ['only' => ['destroy']]);
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
            $data = User::where('user_id', Auth::user()->id)->where('status', 0)->orderBy('id', 'desc')->get();
        }else{
            $data = User::where('user_id', Auth::user()->user_id)->where('status', 0)->orderBy('id', 'desc')->get();
        }
        return view('user.index', compact('data'));
    }

    public function create(){
        return view('user.create');
    }

    public function store(Request $request){
        if(Auth::user()->is_company == 1){
            $data = User::find(Auth::user()->id);
        }else{
            $data = User::find(Auth::user()->user_id);
        }

        if($data->company->remaining_users() != 0){

            $request->validate([
                'name' => 'required',
                'email' => 'required|unique:users,email',
                'password' => 'required|confirmed',
            ]);
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->is_admin = 1;
            $user->is_company = 0;
            $user->added_by = Auth::user()->id;
            if(Auth::user()->is_company == 1){
                $user->user_id = Auth::user()->id;
            }else{
                $user->user_id = Auth::user()->user_id;
            }
            $user->save();

            if($request->permission != null){
                $permission = $request->permission;
                $user->syncPermissions($permission);
            }

            // Notify to admin
            $admin = User::where('is_admin', 0)->where('is_company', 0)->first();
            $data = ['text' => $data->name . ' created a User - ' . $user->name, 'name' => $data->name];
            Notification::send($admin, new UserCreationSuccessful($data));
            return redirect()->back()->with('success', 'User Added Successfully');
        }else{
            return redirect()->back()->with('warning', 'User Limit Exceeded');
        }
    }

    public function edit($id){
        if(Auth::user()->is_company == 1){
            $company_id = Auth::user()->id;
        }else{
            $company_id = Auth::user()->user_id;
        }
        $data = User::find($company_id);
        $user = User::find($id);
        if($user->user_id == $company_id){
            return view('user.edit', compact('data', 'user'));
        }else{
            return redirect()->back();
        }
    }

    public function update($id, Request $request){
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
        return redirect()->back()->with('success', 'User Updated Successfully');
    }

    public function destroy($id){
       $data = User::find($id);
       $data->status = 1;
       $data->save();
       return redirect()->back()->with('success', 'User Deleted Successfully');
    }
    
}
