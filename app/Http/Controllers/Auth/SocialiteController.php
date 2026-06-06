<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirect(string $provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback(string $provider)
    {
        $socialUser = Socialite::driver($provider)->user();

        $email = $socialUser->getEmail();
        $name = $socialUser->getName() ?? $socialUser->getNickname() ?? 'User';
        $socialId = $socialUser->getId();
        $avatar = $socialUser->getAvatar();

        if (!$email) {
            return redirect()->route('login')->withErrors(['email' => 'Email is required from ' . $provider . '.']);
        }

        $field = $provider . '_id';

        $user = User::where('email', $email)->first();

        if ($user) {
            $user->update([$field => $socialId]);
            Auth::login($user, true);
            return $this->redirectAuthenticated($user);
        }

        $sessionData = [
            'name' => $name,
            'email' => $email,
            $field => $socialId,
            'avatar' => $avatar,
            'provider' => $provider,
        ];

        session(['social_user' => $sessionData]);

        return redirect()->route('complete-profile');
    }

    public function showCompleteProfile()
    {
        $socialUser = session('social_user');

        if (!$socialUser) {
            return redirect()->route('login');
        }

        $suggestedUsername = Str::slug(explode('@', $socialUser['email'])[0]);

        return view('auth.complete-profile', compact('socialUser', 'suggestedUsername'));
    }

    public function completeProfile(Request $request)
    {
        $socialUser = session('social_user');

        if (!$socialUser) {
            return redirect()->route('login');
        }

        $request->validate([
            'username' => 'required|string|max:255|unique:users,username|alpha_dash',
            'phone' => 'required|string|max:20',
        ]);

        $user = User::create([
            'name' => $socialUser['name'],
            'username' => $request->username,
            'email' => $socialUser['email'],
            'phone' => $request->phone,
            $socialUser['provider'] . '_id' => $socialUser[$socialUser['provider'] . '_id'],
            'avatar' => $socialUser['avatar'],
            'email_verified_at' => now(),
            'password' => bcrypt(Str::random(32)),
        ]);

        session()->forget('social_user');

        Auth::login($user, true);

        return $this->redirectAuthenticated($user);
    }

    private function redirectAuthenticated(User $user)
    {
        if ($user->role === 'admin') {
            return redirect()->intended(route('dashboard'));
        }

        return redirect()->intended(route('homepage.home'));
    }
}
