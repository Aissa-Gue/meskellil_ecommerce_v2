@extends('layouts.auth')

@section('auth-wrapper')
     <div class="tp-login-top text-center mb-30">
          <h3 class="tp-login-title">{{ __('header.reset_password') }}</h3>
          <p>{{ __('header.enter_new_password') }}</p>
     </div>
     <div class="tp-login-option">
          <form method="POST" action="{{ route('password.update') }}">
               @csrf
               <input type="hidden" name="token" value="{{ $token }}">
               <input type="hidden" name="email" value="{{ $email }}">
               
               <div class="tp-login-input-wrapper">
               <div class="tp-login-input-box">
                    <div class="tp-login-input">
                         <input id="email" name="email" type="email" value="{{ old('email', $email) }}" required readonly>
                    </div>
                    <div class="tp-login-input-title">
                         <label for="email">{{ __('header.email') }}</label>
                    </div>
               </div>
               <div class="tp-login-input-box">
                    <div class="tp-login-input">
                         <input id="password" name="password" type="password" placeholder="{{ __('header.new_password') }}" required>
                    </div>
                    <div class="tp-login-input-title">
                         <label for="password">{{ __('header.new_password') }}</label>
                    </div>
               </div>
               <div class="tp-login-input-box">
                    <div class="tp-login-input">
                         <input id="password_confirmation" name="password_confirmation" type="password" placeholder="{{ __('header.confirm_new_password') }}" required>
                    </div>
                    <div class="tp-login-input-title">
                         <label for="password_confirmation">{{ __('header.confirm_new_password') }}</label>
                    </div>
               </div>
               <div class="tp-login-bottom">
                    <button type="submit" class="tp-btn w-100">{{ __('header.reset_password') }}</button>
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