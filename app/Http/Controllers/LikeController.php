<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function like($id){

        
        Like::create([
            'like'=>'1',
            'dislike'=>'0',
            'user_id'=>Auth::id(),
            'reply_id'=>$id
        ]);
    }
}
