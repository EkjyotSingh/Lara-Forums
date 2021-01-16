<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LikeController extends Controller
{
    public function like($reply_id){
        $liked=Like::where('reply_id',$reply_id)->where('user_id',Auth::id())->first();
        if($liked){
            if($liked->like==1){
                $liked->delete();
            }else{
                $liked->update([
                    'like'=>'1',
                    'dislike'=>'0',
                    'user_id'=>Auth::id(),
                    'reply_id'=>$reply_id
                ]);
                Session::flash('success','You have liked the reply');
            }
        }else{
            Like::create([
                'like'=>'1',
                'dislike'=>'0',
                'user_id'=>Auth::id(),
                'reply_id'=>$reply_id
            ]);
            Session::flash('success','You have liked the reply');
        }
        return redirect()->back();
    }

    public function dislike($reply_id){
        $disliked=Like::where('reply_id',$reply_id)->where('user_id',Auth::id())->first();
        if($disliked){
            if($disliked->dislike==1){
                $disliked->delete();
            }else{
                $disliked->update([
                    'like'=>'0',
                    'dislike'=>'1',
                    'user_id'=>Auth::id(),
                    'reply_id'=>$reply_id
                ]);
                Session::flash('success','You have disliked the reply');
            }
        }else{
            Like::create([
                'like'=>'0',
                'dislike'=>'1',
                'user_id'=>Auth::id(),
                'reply_id'=>$reply_id
            ]);
            Session::flash('success','You have disliked the reply');
        }
        return redirect()->back();
    }
}
