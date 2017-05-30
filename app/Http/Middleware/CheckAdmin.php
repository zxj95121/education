<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Request;

class CheckAdmin
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
        if($request->session()->get('admin_id')){
            if (Request::is('admin/login')) {
                return redirect('admin/dashboard');
            }
            return $next($request);
        }
        else if (Request::is('admin/login')) {
            return $next($request);
        } else {
            return redirect('admin/login');
        }
    }
}
