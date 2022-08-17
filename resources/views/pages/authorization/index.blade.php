@extends('layouts.app')
<style>
    body html{
        height: 100%;
    }
    .otp-input-wrapper {
        width: 240px;
        text-align: left;
        display: inline-block;
    }
    .otp-input-wrapper input {
        padding: 0;
        width: 264px;
        font-size: 32px;
        font-weight: 600;
        color: #3e3e3e;
        background-color: transparent;
        border: 0;
        margin-left: 12px;
        letter-spacing: 48px;
        font-family: sans-serif !important;
    }
    .otp-input-wrapper input:focus {
        box-shadow: none;
        outline: none;
    }
    .otp-input-wrapper svg {
        position: relative;
        display: block;
        width: 240px;
        height: 2px;
    }
    .otpSection{

        text-align: center;
        margin-top: 10%;

    }

    #validateOtp{
        /* Primary */
        color:white;
        background: #03174C;
        border-radius: 5px;
        padding:10px;
    }


</style>

@section('content')
@include('sweetalert::alert')

    @if($errors->any())
        <div class="alert alert-danger">
            <p><strong>Opps Something went wrong</strong></p>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
<section class="otpSection">

    <div class="prompt">
       <h5> Please Enter the One-Time Password sent to your email!</h5>
    </div>
    <div class="otp-input-wrapper">
        <form id="validate_otp" method="post" action="{{url('send/authorization/request')}}" >
            @csrf
            <input type="text" name="pin" maxlength="4" pattern="[0-9]*" autocomplete="off">
            <svg viewBox="0 0 240 1" xmlns="http://www.w3.org/2000/svg">
                <line x1="0" y1="0" x2="240" y2="0" stroke="#3e3e3e" stroke-width="2" stroke-dasharray="44,22" />
            </svg>
        </form>

        <button id="validateOtp" type="submit" form="validate_otp"  style="margin-top:3em; margin-left: 3em;">Validate OTP</button>
    </div>
</section>

@endsection

