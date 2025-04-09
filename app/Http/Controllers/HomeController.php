<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Company;
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
        $guide_count = DB::table('guides')->where('status', 0)->count();
        return view('home', compact('guide_count'));
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
