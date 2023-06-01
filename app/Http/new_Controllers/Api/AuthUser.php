<?php

namespace App\Http\new_Controllers\Api;

use App\Classes\VerificationToken;
use App\Http\Controllers\Controller;
use App\Mail\VerificationToken as VerificationTokenMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\User;
use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;


class AuthUser extends BaseController
{


    public function authenticate(Request $request)
    {
        request()->validate([
            'email'    => 'required|email',
            'password' => 'required|string|min:6|max:50'
        ]);
        $credentials = $request->only('email', 'password');

        //Request is validated
        //Crean token
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Login credentials are invalid.',
                ], 400);
            }
        } catch (JWTException $e) {
//            return $credentials;
            return response()->json([
                'success' => false,
                'message' => 'Could not create token.',
            ], 500);
        }

        return response()->json([
            'success' => true,
            'user' => auth()->user(),
            'token' => $token,
        ]);
    }

    /* user Registration */
    public function register(Request $request)
    {

        request()->validate(
            [
                'full_name'   => 'required|string|max:255',
                'email'       => 'required|string|email|max:255|unique:users',
                'password'    => 'required|string|min:6|confirmed',
                'address'     => 'sometimes',
                'username'     => 'required|string|max:40|unique:users',
                'phone_number' => 'required|string|unique:users'
                //|regex:/(01)[0-9]{9}/',
            ]
        );
        DB::beginTransaction();
        $verifyToken = VerificationToken::generate();

        $user = User::create([
                    'full_name' => $request->get('full_name'),
                    'email' => $request->get('email'),
                    'password' => Hash::make($request->get('password')),
                    'address'  => $request['address'] ?? null,
                    'username' => $request['username'],
                    'phone_number' => $request['phone_number'],
                    'verification_token' => $verifyToken
                ]);

        $maildata = [
            'verify_token' => $verifyToken
        ];
        Mail::to($request->get('email'))->send(new VerificationTokenMail($maildata));
        $token = JWTAUTH::fromUser($user);
        DB::commit();
        return response()->json(compact('user','token'),201);
    }

    /* get autheticated user */
    public function getAuthenticatedUser()
    {
        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }

        return response()->json(compact('user'));
    }

}
