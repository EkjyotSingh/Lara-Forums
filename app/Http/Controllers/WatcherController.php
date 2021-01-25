<?php

namespace App\Http\Controllers;

use App\Models\Watcher;
use App\Models\Discussion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class WatcherController extends Controller
{
    public function create($did){
        $discussion=Discussion::where('id',$did)->first();
        if($discussion->user_id != Auth::id()){
            Watcher::create([
                'user_id'=>Auth::id(),
                'discussion_id'=>$did
            ]);
            Session::flash('success','You will be notified for this discussion');
        }else{
            Session::flash('error','You have created this discussion,so you cannot subscribe this discussion');
        }
    
        return redirect()->back();
    }

    public function destroy($did){
        $watcher=Watcher::where('user_id',Auth::id())->where('discussion_id',$did)->first();
        $watcher->delete();
        Session::flash('success','No further notifications will be send to you for this discussion');
        return redirect()->back();
    }
}
