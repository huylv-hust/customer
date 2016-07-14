<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

/**
 * Author thuanth6589
 * Class VerifyToken
 * @package App\Http\Middleware
 */
class AdminLogin
{
	public function handle($request, Closure $next, $guard = null)
	{
		if(Session::get('user')) {
			return $next($request);
		}

		return redirect()->route('admin_login');
	}
}
