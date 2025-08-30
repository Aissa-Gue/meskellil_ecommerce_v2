@extends('layouts.auth')

@section('auth-header')
    <h3 class="breadcrumb__title">Reset Password</h3>
    <div class="breadcrumb__list">
        <span><a href="{{ route('home') }}">Home</a></span>
        <span>Reset Password</span>
    </div>
@endsection

@section('auth-wrapper')
     <div class="tp-login-top text-center mb-30">
          <h3 class="tp-login-title">Reset Password</h3>
          <p>Enter the new password you want to set</p>
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
                         <label for="email">Email</label>
                    </div>
               </div>
               <div class="tp-login-input-box">
                    <div class="tp-login-input">
                         <input id="password" name="password" type="password" placeholder="New Password" required>
                    </div>
                    <div class="tp-login-input-title">
                         <label for="password">New Password</label>
                    </div>
               </div>
               <div class="tp-login-input-box">
                    <div class="tp-login-input">
                         <input id="password_confirmation" name="password_confirmation" type="password" placeholder="Confirm New Password" required>
                    </div>
                    <div class="tp-login-input-title">
                         <label for="password_confirmation">Confirm New Password</label>
                    </div>
               </div>
               <div class="tp-login-bottom">
                    <button type="submit" class="tp-btn w-100">Reset Password</button>
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