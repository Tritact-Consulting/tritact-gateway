<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;

class AdminController extends Controller
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
        $company_count = DB::table('users')->where('is_admin', 1)->where('is_company', 1)->count();
        $tag_count = DB::table('tags')->where('status', 0)->count();
        $user_count = DB::table('users')->where('is_admin', 1)->where('is_company', 0)->count();
        $document_count = DB::table('documents')->count();
        return view('admin.home', compact('company_count', 'tag_count', 'user_count', 'document_count'));
    }

    public function markAsRead(){
        Auth::user()->unreadNotifications->markAsRead();
        return redirect()->back()->with('success', 'Notification Mark Read Successfully');
    }
}
