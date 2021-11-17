<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Providers\RouteServiceProvider as  CustomRouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = CustomRouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
//        $this->middleware('guest:admin')->except('logout');
    }

    //uncomment when the issue is resolved
//    public function username()
//    {
//        return 'email';
//    }
//
//    public function getLoginUrls()
//    {
//        return [
//            'public_url' => str_replace('/', '', RouteServiceProvider::HOME),
//            'admin_url' =>  str_replace('/', '', RouteServiceProvider::ADMIN_HOME),
//        ];
//
//    }
//
//    public function showLoginForm()
//    {
//        $segments = request()->segments();
//        $urls = $this->getLoginUrls();
//        $type = $urls['public_url'];
//        if ( isset($segments) && $segments[0] === $urls['admin_url'] ) {
//            $type = $urls['admin_url'];
//            return view('admin.auth.login', compact('type'));
//        }
//
//        // Show seller or admin login
//        return view('auth.login', compact('type'));
//
//    }
//    /**
//     * Attempt to log the user into the application.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @return bool
//     */
//    protected function attemptLogin(Request $request): bool
//    {
//
//        if ($request->has('type')) {
//            return $this->adminGuard()->attempt(
//                $this->credentials($request), $request->filled('remember')
//            );
//        }
//
//        return $this->guard()->attempt(
//               $this->credentials($request), $request->filled('remember'));
//    }
//
//    /**
//     * Send the response after the user was authenticated.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
//     */
//    protected function sendLoginResponse(Request $request)
//    {
//        $request->session()->regenerate();
//        $this->clearLoginAttempts($request);
//
//        $redirect = $request->has('type') ? '/admin' : '/';
//
//        if ($response = $this->authenticated($request, $request->has('type')
//            ? $this->adminGuard()->user()
//            : $this->guard()->user())
//        ) {
//            return $response;
//        }
//
//        return $request->wantsJson()
//            ? new JsonResponse([], 204)
//            : redirect()->intended($redirect);
//    }
//
//    /**
//     * Log the user out of the application.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
//     */
//    public function logout(Request $request)
//    {
//        if ($request->is('admin') || $request->is('admin/*')) {
//            $redirect = "/admin/login";
//        } else {
//            $redirect = "/login";
//        }
//
//        $this->guard()->logout();
//        $request->session()->invalidate();
//        $request->session()->regenerateToken();
//        if ($response = $this->loggedOut($request)) {
//            return $response;
//        }
//
//        return $request->wantsJson() ? new JsonResponse([], 204) : redirect($redirect);
//    }
//
//
//    public function adminGuard()
//    {
//        return Auth::guard('admin');
//    }
}
