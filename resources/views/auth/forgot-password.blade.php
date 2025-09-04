@extends('layouts.auth')

@section('auth-wrapper')
     <div class="tp-login-top text-center mb-30">
          <h3 class="tp-login-title">{{ __('header.forgot_password') }}</h3>
          <p>{{ __('header.enter_email_reset_link') }}</p>
     </div>
     <div class="tp-login-option">
          <form method="POST" action="{{ route('password.email') }}">
               @csrf
               <div class="tp-login-input-wrapper">
               <div class="tp-login-input-box">
                    <div class="tp-login-input">
                         <input id="email" name="email" type="email" placeholder="example@mail.com" required autofocus>
                    </div>
                    <div class="tp-login-input-title">
                         <label for="email">{{ __('header.email') }}</label>
                    </div>
               </div>
               <div class="tp-login-bottom">
                    <button type="submit" class="tp-btn w-100">{{ __('header.send_reset_link') }}</button>
               </div>
               </div>
          </form>
          <div class="tp-login-suggetions d-sm-flex align-items-center justify-content-center">
               <div class="tp-login-forgot">
                    <span>{{ __('header.remember_password') }} <a href="{{ route('login') }}"> {{ __('header.login') }}</a></span>
               </div>
          </div>
     </div>
@endsection