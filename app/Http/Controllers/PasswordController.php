<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Mail\ResetPasswordMail;

class PasswordController extends Controller
{
    /**
     * Show the form for requesting a password reset link.
     */
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * Send a reset link to the given user.
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ], [
            'email.exists' => 'We cannot find a user with that email address.'
        ]);

        try {
            // Get the user
            $user = \App\Models\User::where('email', $request->email)->first();
            
            // Generate token using Laravel's built-in password broker
            $token = app('auth.password.broker')->createToken($user);
            
            // Send email using our custom Mail class
            Mail::to($user->email)->send(new ResetPasswordMail($user, $token));
            
            return back()->with('status', 'Password reset link has been sent to your email address.');
            
        } catch (\Exception $e) {
            Log::error('Password reset email failed: ' . $e->getMessage());
            return back()->withErrors(['email' => 'Failed to send password reset email. Please try again.']);
        }
    }

    /**
     * Show the password reset form.
     */
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.reset-password')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    /**
     * Reset the given user's password.
     */
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ], [
            'password.confirmed' => 'Password confirmation does not match.',
            'password.min' => 'Password must be at least 8 characters long.'
        ]);

        try {
            $status = Password::reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function ($user, $password) {
                    $user->forceFill([
                        'password' => Hash::make($password)
                    ])->setRememberToken(Str::random(60));

                    $user->save();

                    event(new PasswordReset($user));
                }
            );

            if ($status === Password::PASSWORD_RESET) {
                return redirect()->route('login')->with('status', 'Your password has been successfully reset!');
            } else {
                return back()->withErrors(['email' => [__($status)]]);
            }
        } catch (\Exception $e) {
            Log::error('Password reset failed: ' . $e->getMessage());
            return back()->withErrors(['email' => 'Failed to reset password. Please try again.']);
        }
    }

    /**
     * Test email configuration (for development only)
     */
    public function testEmail(Request $request)
    {
        try {
            Mail::raw('This is a test email to verify SMTP configuration.', function ($message) use ($request) {
                $message->to($request->input('email', 'test@example.com'))
                        ->subject('Test Email - SMTP Configuration')
                        ->from(config('mail.from.address'), config('mail.from.name'));
            });

            return response()->json(['message' => 'Test email sent successfully!']);
        } catch (\Exception $e) {
            Log::error('Test email failed: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to send test email: ' . $e->getMessage()], 500);
        }
    }
}
