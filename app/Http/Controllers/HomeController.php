<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
        return view('home');
    }

    public function profile(){
        return view('profile');
    }

    public function profileUpdate(Request $request){
        $id = Auth::user()->id;
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
        return redirect()->back()->with('success', 'Profile Updated Successfully');
    }
}
