<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure; 
use Session;
use Helpers;
class superAdminfMiddleware
{
	
	public function handle($request,Closure $next)
	{
		
		if(Auth::user()->status_dev=='superadmin')
		{
			return $next($request);
		}
 		$request->session()->invalidate();
		return  redirect('/');
		
	}
}
