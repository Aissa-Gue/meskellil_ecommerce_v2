@extends('layouts.mail')

@section('email-title', 'Reset Your Password - ' . config('app.name'))
@section('email-description', 'Reset Your Password')
@section('email-header-subtitle', 'Password Reset Request')

@section('email-content')
    <div class="greeting">
        Hello {{ $user->name }},
    </div>

    <div class="message">
        We received a request to reset your password for your {{ config('app.name') }} account. 
        If you made this request, please click the button below to reset your password.
    </div>

    <div class="button-container">
        <a href="{{ $resetUrl }}" class="primary-button">
            Reset My Password
        </a>
    </div>

    <div class="notice-box notice-warning">
        <strong>⏰ Important:</strong> This password reset link will expire in 60 minutes for security reasons.
    </div>

    <div class="alternative-link">
        <p><strong>Having trouble with the button above?</strong></p>
        <p>Copy and paste the following link into your browser:</p>
        <a href="{{ $resetUrl }}">{{ $resetUrl }}</a>
    </div>

    <div class="notice-box notice-info">
        <strong>🔒 Security Notice:</strong> If you didn't request a password reset, please ignore this email. 
        Your account is safe and no changes have been made.
    </div>

    <div class="message">
        If you continue to have problems, please contact our support team.
    </div>
@endsection
