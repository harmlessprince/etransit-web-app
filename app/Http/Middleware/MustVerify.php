<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MustVerify
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
//     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $user = User::where('id', auth()->user()->id)->first();

        if($user->email_verified_at == null)
        {
            if($request->expectsJson())
            {
                return response()->json(['success' => false , 'message' => 'Please verify your email']);
            }else{
                toastr()->error('Please verify your email ');
                return redirect('/')->with('error', 'Please verify your email');
            }


        }
        return $next($request);
    }
}
