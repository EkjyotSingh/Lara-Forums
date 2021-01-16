<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Reply;
use App\Models\Discussion;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class DiscussionController extends Controller
{
    public function create(){
        return view('forum.discussion_create');
    }

    public function store(Request $request){
        $this->validate($request,[
            'title'=>'required|unique:discussions',
            'content'=>'required',
            'channel'=>'required',
        ]);

        Discussion::create([
            'title'=>$request->title,
            'content'=>$request->content,
            'user_id'=>Auth::id(),
            'channel_id'=>$request->channel,
            'slug'=>Str::slug($request->title)
        ]);

        Session::flash('success','Discussion created successfully');
        return redirect()->route('forum');
    }

    public function show($discussion_slug){
        return view('forum.single_discussion')->with('discussion',Discussion::where('slug',$discussion_slug)->with('replies.user','channel','replies.likes')->first());
    }

    public function edit($discussion_slug){
        $discussion=Discussion::where('slug',$discussion_slug)->first();
        if($discussion->closed!=1 &&  ($discussion->user_id == Auth::id() || User::is_user_admin())){
            return view('forum.discussion_create')->with('discussion',Discussion::where('slug',$discussion_slug)->first());
        }
        else{
            return back();
        }
    }

    public function update(Request $request,$slug){
        
        $this->validate($request,[
            'content'=>'required',
        ]);
        $discussion=Discussion::where('slug',$slug)->first();
        if($discussion->closed!=1 &&  ($discussion->user_id == Auth::id() || User::is_user_admin())){
           $discussion->update([
            'content'=>$request->content,
           ]);
            Session::flash('success','Discussion updated successfully');
            return redirect()->route('discussion.show',[$discussion->slug])->with('replies.user','channel','replies.likes');
        }
        else{
            return back();
        }
        
    }

    public function discussion_closed($id){
        $discussion=Discussion::where('id',$id)->first();
        if($discussion->best_answer != 0){
            $discussion->closed=1;
            $discussion->save();
    
            Session::flash('success','Discussion closed successfully');
            return redirect()->back();
        }
        Session::flash('error','Discussion doesnot have best answer');
        return redirect()->back();
    }
}
