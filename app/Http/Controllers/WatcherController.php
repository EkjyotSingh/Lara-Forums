<?php

namespace App\Http\Controllers;

use App\Models\Watcher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class WatcherController extends Controller
{
    public function create($did){
        Watcher::create([
            'user_id'=>Auth::id(),
            'discussion_id'=>$did
        ]);
        Session::flash('success','You will be notified for this discussion');
        return redirect()->back();
    }

    public function destroy($did){
        $watcher=Watcher::where('user_id',Auth::id())->where('discussion_id',$did)->first();
        $watcher->delete();
        Session::flash('success','No further notifications will be send to you for this discussion');
        return redirect()->back();
    }
}
