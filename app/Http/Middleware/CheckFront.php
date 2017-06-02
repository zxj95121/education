<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Request;

class CheckFront
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
        if($request->session()->get('front_id'))
            return $next($request);
        else if (Request::is('front/error_403')) {
            return $next($request);
        } else {
            return redirect('front/error_403');
        }
    }
}
