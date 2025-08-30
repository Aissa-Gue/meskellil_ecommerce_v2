@extends('layouts.auth')

@section('auth-header')
    <h3 class="breadcrumb__title">Forgot Password</h3>
    <div class="breadcrumb__list">
        <span><a href="{{ route('home') }}">Home</a></span>
        <span>Forgot Password</span>
    </div>
@endsection

@section('auth-wrapper')
     <div class="tp-login-top text-center mb-30">
          <h3 class="tp-login-title">Forgot Password</h3>
          <p>Enter your email & we'll send you a reset link</p>
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
                         <label for="email">Email</label>
                    </div>
               </div>
               <div class="tp-login-bottom">
                    <button type="submit" class="tp-btn w-100">Send Reset Link</button>
               </div>
               </div>
          </form>
          <div class="tp-login-suggetions d-sm-flex align-items-center justify-content-center">
               <div class="tp-login-forgot">
                    <span>Remember Password? <a href="{{ route('login') }}"> Login</a></span>
               </div>
          </div>
     </div>
@endsection