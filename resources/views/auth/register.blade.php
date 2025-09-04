@extends('layouts.auth')

@section('auth-wrapper')
     <div class="tp-login-top text-center mb-30">
          <h3 class="tp-login-title">{{ __('header.sign_up') }} {{ global_info('brand.name') }}</h3>
          <p>{{ __('header.already_have_account') }} <a href="{{ route('login') }}">{{ __('header.sign_in') }}</a></p>
     </div>
     <div class="tp-login-option">
          <form method="POST" action="{{ route('register') }}">
               @csrf
               <div class="tp-login-input-wrapper">
               <div class="tp-login-input-box">
                    <div class="tp-login-input">
                         <input id="name" name="name" type="text" placeholder="shahnewaz sakil" required autofocus>
                    </div>
                    <div class="tp-login-input-title">
                         <label for="name">{{ __('header.your_name') }}</label>
                    </div>
               </div>
               <div class="tp-login-input-box">
                    <div class="tp-login-input">
                         <input id="email" name="email" type="email" placeholder="example@mail.com" required>
                    </div>
                    <div class="tp-login-input-title">
                         <label for="email">{{ __('header.email') }}</label>
                    </div>
               </div>
               <div class="tp-login-input-box">
                    <div class="tp-login-input">
                         <input id="phone" name="phone" type="text" placeholder="+880 014 5555 9999">
                    </div>
                    <div class="tp-login-input-title">
                         <label for="phone">{{ __('header.phone_number') }}</label>
                    </div>
               </div>
               <div class="tp-login-input-box">
                    <div class="tp-login-input">
                         <input id="password" name="password" type="password" placeholder="{{ __('header.min_6_character') }}" required>
                    </div>
                    <div class="tp-login-input-title">
                         <label for="password">{{ __('header.password') }}</label>
                    </div>
               </div>
               <div class="tp-login-input-box">
                    <div class="tp-login-input">
                         <input id="password_confirmation" name="password_confirmation" type="password" placeholder="{{ __('header.min_6_character') }}" required>
                    </div>
                    <div class="tp-login-input-title">
                         <label for="password_confirmation">{{ __('header.confirm_password') }}</label>
                    </div>
               </div>
               <div class="tp-login-suggetions d-sm-flex align-items-center justify-content-between mb-20">
                    <div class="tp-login-remeber">
                         <input id="terms" type="checkbox" required>
                         <label for="terms">{{ __('header.i_accept_terms') }} <a href="#">{{ __('header.terms_of_service') }}</a></label>
                    </div>
               </div>
               <div class="tp-login-bottom">
                    <button type="submit" class="tp-btn w-100">{{ __('header.sign_up') }}</button>
               </div>
               </div>
          </form>
          <div class="tp-login-mail text-center mb-40 mt-40">
               <p>{{ __('header.or_sign_up_with') }} <a href="#">{{ __('header.email') }}</a></p>
          </div>
          <div class="tp-login-social mb-10 d-flex flex-wrap align-items-center justify-content-center">
               <div class="tp-login-option-item has-google">
               <a href="#">
                    <img src="{{ asset('assets/img/icon/login/google.svg') }}" alt="">
                    {{ __('header.sign_in_with_google') }}
               </a>
               </div>
               {{-- <div class="tp-login-option-item">
               <a href="#">
                    <img src="{{ asset('assets/img/icon/login/facebook.svg') }}" alt="">
               </a>
               </div>
               <div class="tp-login-option-item">
               <a href="#">
                    <img class="apple" src="{{ asset('assets/img/icon/login/apple.svg') }}" alt="">
               </a>
               </div> --}}
          </div>
     </div>
@endsection
