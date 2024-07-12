<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        if (Auth::guard('admin')->check() && in_array(Auth::guard('admin')->user()->role->role_name, $roles)) {
            return $next($request);
        }

        return redirect('home')->with('error', 'You do not have access to this page');
    }
}
