<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next , $guard = null)
    {

        if( !Auth::guard('admin')->check())
        {
            return redirect()->route('admin.login.page')->with('error', 'You dont have permission to have access to this resource');

        }
        return $next($request);

    }
}
