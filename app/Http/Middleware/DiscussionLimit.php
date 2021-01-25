<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DiscussionLimit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->role !='admin'){
            if(auth()->user()->last_discussion_at !=null){
                    if(now()->diffInSeconds(auth()->user()->last_discussion_at) < 1800 ){
                        Session::flash('error','Discussion create limit has reached,Try after 30 minutes from last discussion created');
                        return back();
                    }
            }
        }
        return $next($request);
    }
}
