<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Reply;
use App\Models\Watcher;
use App\Models\Discussion;
use Illuminate\Http\Request;
use App\Notifications\BestReply;
use App\Notifications\NewReplyAdded;
use App\Notifications\WatcherNotify;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Notification;

class ReplyController extends Controller
{
    public function __construct(){
        $this->middleware('reply_limit')->only(['store']); 
    }
    public function store(Request $request,$id){
        //dd(Watcher::where('discussion_id',$id)->pluck('user_id')->toarray())        
        if(auth()->user()->reply_status){

            $this->validate($request,[
                'content'=>'required',
            ]);
    
            $reply=Reply::create([
                'content'=>$request->content,
                'user_id'=>Auth::id(),
                'discussion_id'=>$id,
            ]);
            User::where('id',Auth::id())->update([
                'last_reply_at'=>now()
            ]);
            
            $discussion=Discussion::where('id',$id)->first();
    
            $watchers=Watcher::where('discussion_id',$id)->pluck('user_id')->toarray();
    
            $watchers_detail=array();
            foreach($watchers as $watcher){
                if($watcher != Auth::id()){
                    array_push($watchers_detail,User::where('id',$watcher)->first());
                }
            }
            if(count($watchers)>0){
                Notification::send($watchers_detail,new WatcherNotify($discussion));
            }
            if($discussion->user_id !=Auth::id()){
                $discussion->user->notify(new NewReplyAdded($discussion));
            }
    
            Session::flash('success','Answer added successfully');
            return redirect()->route('discussion.show',$discussion->slug);
        }else{
            Session::flash('error','Admin blocked you from replying.Contact him for any query');
            return redirect()->back();
        }
    }

    public function best_reply($rid,$did){
       $discussion = Discussion::where('id',$did)->first();
       $discussion->best_answer = $rid;
       $discussion->save();
       $reply=Reply::where('id',$rid)->first();
       $reply->user->notify(new BestReply($discussion));
        Session::flash('success','Reply marked as best');
        return redirect()->back();
    }
}
