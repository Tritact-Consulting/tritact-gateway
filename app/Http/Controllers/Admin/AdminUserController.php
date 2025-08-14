<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Hash;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct(){
        $this->middleware('permission:view user|create user|edit user|delete user', ['only' => ['index','show']]);
        $this->middleware('permission:create user', ['only' => ['create','store']]);
        $this->middleware('permission:update user', ['only' => ['edit','update']]);
        $this->middleware('permission:delete user', ['only' => ['destroy']]);
    }
    
    public function index(Request $request)
    {
        $data = User::where('is_admin', 0)->orderBy('id', 'desc');
        if($request->name != null){
            $user_name = $request->name;
            $data = $data->where('name', 'like', '%' . $user_name . '%');
        }
        if($request->email != null){
            $user_email = $request->email;
            $data = $data->where('email', 'like', '%' . $user_email . '%');
        }
        $data = $data->get();
        return view('admin.user.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'role' => 'required',
            'password' => 'required',
        ]);
        $data = new User();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = Hash::make($request->password);
        $data->save();
        $data->assignRole($request->role);
        if ($data->hasRole('attendance')) {
            $data->shift_start = $request->shift_start;
            $data->shift_end   = $request->shift_end;
            $data->timezone    = $request->timezone;
            $data->save();
        }
        return redirect()->back()->with('success', 'User Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = User::find($id);
        $roles = Role::all();
        return view('admin.user.edit', compact('data', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'role' => 'required',
        ]);
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        if($request->password != null){
            $data->password = Hash::make($request->password);
        }
        $data->save();
        $data->syncRoles($request->role);

        if ($data->hasRole('attendance')) {
            $data->shift_start = $request->shift_start; // e.g. "09:00"
            $data->shift_end   = $request->shift_end;   // e.g. "17:30"
            $data->timezone    = $request->timezone;    // e.g. "Asia/Kolkata"
            $data->save();
        }
        return redirect()->back()->with('success', 'User Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //
    }
    
}
