<?php

namespace App\Http\Middleware;

use Closure;

class CheckWechat
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Session::get('wechat_id'))
            return $next($request);
        else if (Request::is('front/error_403')) {
            return $next($request);
        } else {
            return redirect('front/error_403');
        }
    }
}
