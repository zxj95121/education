<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Request;

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
        var_dump($request->session()->get('openid'));
        echo '<br />';
        var_dump($request->all());
        if($request->session()->get('openid'))
            return $next($request);
        else if (Request::is('front/error_403')) {
            return $next($request);
        } else {
            echo 3;
            exit;
            return redirect('front/error_403');
        }
    }
}
