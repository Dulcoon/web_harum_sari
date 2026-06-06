<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserOtp;
use App\Notifications\SendOtpNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'phone' => ['nullable', 'string', 'max:20'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        $otp = UserOtp::create([
            'user_id' => $user->id,
            'otp' => str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT),
            'type' => 'email_verification',
            'expires_at' => now()->addMinutes(10),
        ]);

        $user->notify(new SendOtpNotification($otp->otp));

        return redirect()->route('verify-otp', ['email' => $user->email])
            ->with('success', 'Registration successful. Please verify your email with the code sent to your inbox.');
    }
}
