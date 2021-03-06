<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Session;
use Closure;

class loginSuperAdmin
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
        if (!Session::get('id')) {
            return redirect('/superadmin/login');
        }

        return $next($request);
    }
}
