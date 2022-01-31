<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */

    public function handle($request, Closure $next, $guard = null)
    {


        if ($guard == "admin" && Auth::guard($guard)->check()) {
         return  redirect(RouteServiceProvider::ADMIN_HOME);
        }

        if($guard == 'e-ticket' && Auth::guard($guard)->check())
        {

            return  redirect(RouteServiceProvider::TICKET_HOME);
        }


        if (Auth::guard($guard)->check()) {
            return redirect('/');
        }

        return $next($request);
    }
}
