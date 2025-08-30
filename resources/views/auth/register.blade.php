@extends('layouts.auth')

@section('auth-header')
    <h3 class="breadcrumb__title">Register Now</h3>
    <div class="breadcrumb__list">
        <span><a href="{{ route('home') }}">Home</a></span>
        <span>Register</span>
    </div>
@endsection

@section('auth-wrapper')
     <div class="tp-login-top text-center mb-30">
          <h3 class="tp-login-title">Sign Up {{ global_info('brand.name') }}</h3>
          <p>Already have an account? <a href="{{ route('login') }}">Sign In</a></p>
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
                         <label for="name">Your Name</label>
                    </div>
               </div>
               <div class="tp-login-input-box">
                    <div class="tp-login-input">
                         <input id="email" name="email" type="email" placeholder="example@mail.com" required>
                    </div>
                    <div class="tp-login-input-title">
                         <label for="email">Email</label>
                    </div>
               </div>
               <div class="tp-login-input-box">
                    <div class="tp-login-input">
                         <input id="phone" name="phone" type="text" placeholder="+880 014 5555 9999">
                    </div>
                    <div class="tp-login-input-title">
                         <label for="phone">Phone Number</label>
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
               <div class="tp-login-input-box">
                    <div class="tp-login-input">
                         <input id="password_confirmation" name="password_confirmation" type="password" placeholder="Min. 6 character" required>
                    </div>
                    <div class="tp-login-input-title">
                         <label for="password_confirmation">Confirm Password</label>
                    </div>
               </div>
               <div class="tp-login-suggetions d-sm-flex align-items-center justify-content-between mb-20">
                    <div class="tp-login-remeber">
                         <input id="terms" type="checkbox" required>
                         <label for="terms">I accept the <a href="#">Terms of Service</a></label>
                    </div>
               </div>
               <div class="tp-login-bottom">
                    <button type="submit" class="tp-btn w-100">Sign Up</button>
               </div>
               </div>
          </form>
          <div class="tp-login-mail text-center mb-40 mt-40">
               <p>or Sign up with <a href="#">Email</a></p>
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
