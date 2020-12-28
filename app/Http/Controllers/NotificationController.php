<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function show(){
        $notifications= auth()->user()->unreadNotifications()->get();
        auth()->user()->unReadNotifications->markAsRead();
        return view('forum.notification')->with('notifications',$notifications);
    }
}
