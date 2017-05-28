<?php

namespace App\Http\Middleware;

use Closure;
use Request;

class CheckDomainNameAdmin
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
        if(strpos(Request::url(), getenv('SITE_ADMIN')))//检测到访问的是前端
            return $next($request);
        else
            return redirect('http://'.getenv('SITE_FRONT').'/front/error_403');
    }
}
