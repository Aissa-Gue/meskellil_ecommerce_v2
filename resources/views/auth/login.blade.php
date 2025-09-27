@extends('layouts.auth')

@section('auth-wrapper')
     <div class="tp-login-top text-center mb-30">
          <h3 class="tp-login-title">{{ __('header.login') }} {{ global_info('brand.name') }}</h3>
          <p>{{ __('header.dont_have_account') }} <a href="{{ route('register') }}">{{ __('header.create_free_account') }}</a></p>
     </div>
     <div class="tp-login-option">
            <form method="POST" action="{{ route('login') }}">
                  @csrf
                  @if($errors->any())
                       <div class="alert alert-danger">
                            <ul class="mb-0">
                                 @foreach($errors->all() as $error)
                                      <li>{{ $error }}</li>
                                 @endforeach
                            </ul>
                       </div>
                  @endif
               <div class="tp-login-input-wrapper">
               <div class="tp-login-input-box">
                    <div class="tp-login-input">
                         <input id="email" name="email" type="email" value="{{ old('email') }}" placeholder="example@mail.com" required autofocus>
                    </div>
                    <div class="tp-login-input-title">
                         <label for="email">{{ __('header.your_email') }}</label>
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
               <div class="tp-login-suggetions d-sm-flex align-items-center justify-content-between mb-20">
                    <div class="tp-login-remeber">
                         <input id="remember" name="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                         <label for="remember">{{ __('header.remember_me') }}</label>
                    </div>
                    <div class="tp-login-forgot">
                         <a href="{{ route('password.request') }}">{{ __('header.forgot_password') }}</a>
                    </div>
               </div>
               <div class="tp-login-bottom">
                    <button type="submit" class="tp-btn w-100">{{ __('header.login') }}</button>
               </div>
               </div>
          </form>
          <div class="tp-login-mail text-center mb-40 mt-40">
               <p>{{ __('header.or_sign_in_with') }} <a href="#">{{ __('header.email') }}</a></p>
          </div>
          <div class="tp-login-social mb-10 d-flex flex-wrap align-items-center justify-content-center">
               <div class="tp-login-option-item has-google">
               <a href="{{ route('google.login') }}">
                    <img src="{{ asset('assets/img/icon/login/google.svg') }}" alt="">
                    {{ __('header.sign_in_with_google') }}
               </a>
               </div>
          </div>
     </div>
@endsection
