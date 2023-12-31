<?php

namespace App\Http\new_Controllers\Auth;

use App\Models\User;
use App\Classes\VerificationToken;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Mail\VerificationToken as VerificationTokenMail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            // 'username' => ['required','string','max:25', 'unique:users'],
            'address' => ['required','string'],
            'phone_number' => ['required','unique:users'],
            'nin' => ['required','digits:11']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)

    {
        if(isset($data['nin']))
        {
            $nin = Crypt::encryptString($data['nin']);
        }
        else{
            $nin = null;
        }
        $data = User::create([
            'full_name' => $data['full_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'address' => $data['address'],
            'phone_number' => $data['phone_number'],
            // 'username' => $data['username'],
            'nin' => $nin
    ]);

//        $verifyToken = VerificationToken::generate();
//
//        $maildata = [
//            'verify_token' => $verifyToken
//        ];
//        Mail::to($data['email'])->send(new VerificationTokenMail($maildata));

        return $data;
    }

}
