<?php

namespace App\Http\Middleware;

use App\Models\Eticket;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Impersonate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $true = $request->input('true');
            $id = $request->session()->get('user-proxy-id');
            if (!$id) {
                return $next($request);
            }
            $user = Eticket::query()->findOrFail($id);
            Auth::guard('e-ticket')->login($user);

        return $next($request);
    }
}
