<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Session;
use Closure;

class notLoginSuperAdmin
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
        if (Session::get('id')) {
            return redirect('/test/dashboard');
        }

        return $next($request);
    }
}
