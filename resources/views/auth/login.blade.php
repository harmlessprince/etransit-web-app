<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet"/>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/login-reg.css')}}" />

</head>
<body>
    <div class="container-fluid">
        @include('layouts.header')
         <div class="login_bg">
                <div class="login_box_section">
                    <div class="login_box">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                            <div class="login_box_text">
                              <div>
                                  <h4>LOG IN</h4>
                                  <p> Don't have an account ? <span class="reg_text"><a href="{{url('/register')}}">Sign Up</a></span></p>
                              </div>
                            </div>
                            <div class="form_box">
                                <form method="POST" action="{{ route('login') }}" >
                                    @csrf
                                    <div for="email" class="form-group">
                                        <input type="email" placeholder="EMAIL" class="form-control login_form_input @error('email')is-invalid @enderror" id="enail" name="email"  value="{{ old('email') }}"  required/>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div  for="password" class="form-group">
                                        <input type="password" placeholder="PASSWORD"  class="form-control login_form_input @error('password')is-invalid @enderror" id="password"  name="password"/>
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="login_button_action">
                                        <button class="login_btn" type="submit">LOGIN</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
     </div>
</body>
</html>
