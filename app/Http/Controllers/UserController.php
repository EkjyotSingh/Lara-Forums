<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index(){
        return view('users')->with('users',User::all());
    }

    public function show($id){
        return view('single_user')->with('user',User::where('id',$id)->first());
    }

    public function update(Request $request,$id){
        User::where('id',$id)->update([
            'role'=>$request->role,
            'discussion_status'=>$request->discussion_status,
            'reply_status'=>$request->reply_status,

        ]);
        Session::flash('success','User Updated successfully');
        return redirect()->route('user.index',['users'=>User::all()]);
    }
}
