<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ReplyLimit
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
            if(auth()->user()->last_reply_at !=null){
                if(now()->diffInSeconds(auth()->user()->last_reply_at) < 300){
                    Session::flash('error','Reply has limit of 5 minutes to avoid spamming');
                    return back();
                }

            }
        }
        return $next($request);
    }
}
