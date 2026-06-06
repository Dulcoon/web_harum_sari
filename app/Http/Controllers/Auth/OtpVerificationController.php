<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserOtp;
use App\Notifications\SendOtpNotification;
use Illuminate\Http\Request;

class OtpVerificationController extends Controller
{
    public function show(Request $request)
    {
        $email = $request->email;

        if (!$email) {
            return redirect()->route('login');
        }

        return view('auth.verify-otp', compact('email'));
    }

    public function verify(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'otp' => ['required', 'string', 'size:6'],
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'User not found.']);
        }

        if ($user->email_verified_at) {
            return redirect()->route('login')->with('success', 'Email already verified.');
        }

        $otp = UserOtp::where('user_id', $user->id)
            ->where('otp', $request->otp)
            ->where('type', 'email_verification')
            ->valid()
            ->latest()
            ->first();

        if (!$otp) {
            return back()->withErrors(['otp' => 'Invalid or expired OTP code.']);
        }

        $otp->update(['used_at' => now()]);
        $user->markEmailAsVerified();

        return redirect()->route('login')->with('success', 'Email verified successfully! You can now login.');
    }

    public function resend(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'User not found.']);
        }

        if ($user->email_verified_at) {
            return redirect()->route('login')->with('success', 'Email already verified.');
        }

        $recentOtp = UserOtp::where('user_id', $user->id)
            ->where('type', 'email_verification')
            ->where('created_at', '>', now()->subSeconds(60))
            ->exists();

        if ($recentOtp) {
            return back()->withErrors(['otp' => 'Please wait 60 seconds before requesting a new code.']);
        }

        $otp = UserOtp::create([
            'user_id' => $user->id,
            'otp' => str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT),
            'type' => 'email_verification',
            'expires_at' => now()->addMinutes(10),
        ]);

        $user->notify(new SendOtpNotification($otp->otp));

        return back()->with('success', 'A new verification code has been sent to your email.');
    }
}
