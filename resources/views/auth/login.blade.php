@extends('layouts.auth')

@section('auth-header')
    <h3 class="breadcrumb__title">Login Now</h3>
    <div class="breadcrumb__list">
        <span><a href="{{ route('home') }}">Home</a></span>
        <span>Login</span>
    </div>
@endsection

@section('auth-wrapper')
     <div class="tp-login-top text-center mb-30">
          <h3 class="tp-login-title">Login {{ global_info('brand.name') }}</h3>
          <p>Don't have an account? <a href="{{ route('register') }}">Create a free account</a></p>
     </div>
     <div class="tp-login-option">
          <form method="POST" action="{{ route('login') }}">
               @csrf
               <div class="tp-login-input-wrapper">
               <div class="tp-login-input-box">
                    <div class="tp-login-input">
                         <input id="email" name="email" type="email" placeholder="example@mail.com" required autofocus>
                    </div>
                    <div class="tp-login-input-title">
                         <label for="email">Your Email</label>
                    </div>
               </div>
               <div class="tp-login-input-box">
                    <div class="tp-login-input">
                         <input id="password" name="password" type="password" placeholder="Min. 6 character" required>
                    </div>
                    <div class="tp-login-input-title">
                         <label for="password">Password</label>
                    </div>
               </div>
               <div class="tp-login-suggetions d-sm-flex align-items-center justify-content-between mb-20">
                    <div class="tp-login-remeber">
                         <input id="remember" name="remember" type="checkbox">
                         <label for="remember">Remember me</label>
                    </div>
                    <div class="tp-login-forgot">
                         <a href="{{ route('password.request') }}">Forgot Password?</a>
                    </div>
               </div>
               <div class="tp-login-bottom">
                    <button type="submit" class="tp-btn w-100">Login</button>
               </div>
               </div>
          </form>
          <div class="tp-login-mail text-center mb-40 mt-40">
               <p>or Sign in with <a href="#">Email</a></p>
          </div>
          <div class="tp-login-social mb-10 d-flex flex-wrap align-items-center justify-content-center">
               <div class="tp-login-option-item has-google">
               <a href="#">
                    <img src="{{ asset('assets/img/icon/login/google.svg') }}" alt="">
                    Sign in with google
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
