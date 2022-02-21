<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Exceptions\UnauthorizedException;


class PermissionMiddleware
{

        /**
         * Handle an incoming request.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  \Closure  $next
         * @return mixed
         */
        public function handle($request, Closure $next, $permission = null, $guard = null)
        {

                $authGuard = app('auth')->guard('admin');



                if ($authGuard->guest()) {
                    throw UnauthorizedException::notLoggedIn();
                }

                if (! is_null($permission)) {
                    $permissions = is_array($permission)
                        ? $permission
                        : explode('|', $permission);
                }

                if ( is_null($permission) ) {
                    $permission = $request->route()->getName();
                    $permissions = array($permission);
                }


                foreach ($permissions as $permission) {
                    if ($authGuard->user()->can($permission)) {
                        return $next($request);
                    }
                }
               Alert::error('Error ', 'You don\'t have permission to view this page');

                return back();
//                throw UnauthorizedException::forPermissions($permissions);
         }

}
