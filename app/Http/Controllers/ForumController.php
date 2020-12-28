<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Discussion;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index()
    {
        $discussion=Discussion::Channel_based()->with('channel','user','replies','watchers')->latest()->simplePaginate(3);
        //dd($discussion);
        return view('forum.index')->with('discussions',$discussion);
    }
}
