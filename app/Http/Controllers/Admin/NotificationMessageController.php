<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Notification;
use App\Notifications\NotificationMessage;

class NotificationMessageController extends Controller
{
    public function index(){
        return view('admin.notification.index', compact('data'));
    }

    public function create(){
        $roles = Role::with('users')->get();
        return view('admin.notification.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'message' => 'required',
            'users' => 'required',
        ]);
        $notify_data = [
            'subject' => $request->subject,
            'message' => $request->message,
            'type' => 'notification'
        ];
        $userIds = $request->input('users');
        $users = User::whereIn('id', $userIds)->get();
        Notification::send($users, new NotificationMessage($notify_data));

        foreach($get_user as $key => $value){
            Notification::send($value, new NotificationMessage($notify_data));
        }

        return redirect()->back()->with('success', 'Notification sent to all Selected Users.');
    }
}