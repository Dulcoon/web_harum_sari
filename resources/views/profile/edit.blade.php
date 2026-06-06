@extends('layouts.homepage')

@section('title', 'My Profile | HOMELIVING')

@section('content')
<main class="relative z-10 max-w-[1440px] mx-auto px-4 lg:px-10 py-8 lg:py-10">
    @if (session('status') === 'profile-updated')
        <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50/80 px-4 py-3 text-sm font-medium text-emerald-700 dark:border-emerald-500/20 dark:bg-emerald-500/10 dark:text-emerald-400" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
            Profile updated successfully.
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-1">
            <div class="glass-morphism rounded-3xl p-8 text-center shadow-warm sticky top-24">
                <div class="relative inline-block mb-4">
                    <img src="{{ $user->generateAvatarUrl() }}" alt="{{ $user->name }}" class="w-28 h-28 rounded-2xl object-cover mx-auto shadow-lg">
                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-3">
                        @csrf
                        @method('patch')
                        <label class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-primary/10 text-primary text-xs font-semibold cursor-pointer hover:bg-primary/20 transition-colors">
                            <span class="material-symbols-outlined text-base">photo_camera</span>
                            Change Photo
                            <input type="file" name="avatar" accept="image/*" class="hidden" onchange="this.form.submit()">
                        </label>
                    </form>
                </div>
                <h2 class="text-2xl font-bold text-[#1b1c1b] dark:text-white">{{ $user->name }}</h2>
                <p class="text-sm text-[#6a5548] dark:text-white/60 mt-1">{{ '@' . ($user->username ?? 'set_username') }}</p>
                <p class="text-xs text-[#8a7568] dark:text-white/45 mt-3">
                    <span class="inline-flex items-center gap-1">
                        <span class="w-2 h-2 rounded-full {{ $user->email_verified_at ? 'bg-emerald-500' : 'bg-amber-500' }}"></span>
                        {{ $user->email_verified_at ? 'Verified' : 'Email not verified' }}
                    </span>
                </p>

                @if (!$user->email_verified_at)
                    <form method="POST" action="{{ route('verification.send') }}" class="mt-3">
                        @csrf
                        <button type="submit" class="text-xs font-semibold text-primary hover:underline">Resend verification email</button>
                    </form>
                @endif

                <hr class="my-6 border-[#eadfd4] dark:border-white/10">

                <div class="space-y-3 text-left text-sm">
                    <div class="flex items-center gap-3 text-[#51423a] dark:text-white/70">
                        <span class="material-symbols-outlined text-base text-[#8a7568] dark:text-[#9a6c4c]">mail</span>
                        <span class="truncate">{{ $user->email }}</span>
                    </div>
                    <div class="flex items-center gap-3 text-[#51423a] dark:text-white/70">
                        <span class="material-symbols-outlined text-base text-[#8a7568] dark:text-[#9a6c4c]">call</span>
                        <span>{{ $user->phone ?? 'No phone' }}</span>
                    </div>
                </div>

                <hr class="my-6 border-[#eadfd4] dark:border-white/10">

                <div class="space-y-2">
                    <p class="text-xs uppercase tracking-widest font-bold text-[#8a7568] dark:text-white/45">Connected Accounts</p>
                    <div class="flex justify-center">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-medium {{ $user->google_id ? 'bg-primary/10 text-primary' : 'bg-[#eadfd4]/50 text-[#8a7568] dark:bg-white/5 dark:text-white/40' }}">
                            <svg class="w-4 h-4" viewBox="0 0 24 24"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.66l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
                            Google
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2 space-y-8">
            <div class="glass-morphism rounded-3xl p-8 md:p-10 shadow-warm">
                <h3 class="text-xl font-bold text-[#1b1c1b] dark:text-white mb-6">Edit Profile</h3>

                <form method="POST" action="{{ route('profile.update') }}" class="space-y-5">
                    @csrf
                    @method('patch')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-[#8b7266] dark:text-[#9a6c4c] mb-2" for="name">Full Name</label>
                            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required
                                class="h-12 w-full rounded-xl border border-[#eadfd4] bg-white/70 px-4 text-sm placeholder:text-[#8b7266] focus:border-primary focus:outline-none focus:ring-0 dark:border-white/10 dark:bg-white/5 dark:text-white dark:placeholder:text-[#9a6c4c]">
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-[#8b7266] dark:text-[#9a6c4c] mb-2" for="username">Username</label>
                            <input id="username" name="username" type="text" value="{{ old('username', $user->username) }}"
                                class="h-12 w-full rounded-xl border border-[#eadfd4] bg-white/70 px-4 text-sm placeholder:text-[#8b7266] focus:border-primary focus:outline-none focus:ring-0 dark:border-white/10 dark:bg-white/5 dark:text-white dark:placeholder:text-[#9a6c4c]">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-[#8b7266] dark:text-[#9a6c4c] mb-2" for="email">Email Address</label>
                            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required
                                class="h-12 w-full rounded-xl border border-[#eadfd4] bg-white/70 px-4 text-sm placeholder:text-[#8b7266] focus:border-primary focus:outline-none focus:ring-0 dark:border-white/10 dark:bg-white/5 dark:text-white dark:placeholder:text-[#9a6c4c]">
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-[#8b7266] dark:text-[#9a6c4c] mb-2" for="phone">Phone Number</label>
                            <input id="phone" name="phone" type="tel" value="{{ old('phone', $user->phone) }}"
                                class="h-12 w-full rounded-xl border border-[#eadfd4] bg-white/70 px-4 text-sm placeholder:text-[#8b7266] focus:border-primary focus:outline-none focus:ring-0 dark:border-white/10 dark:bg-white/5 dark:text-white dark:placeholder:text-[#9a6c4c]">
                        </div>
                    </div>

                    <div class="pt-2">
                        <button type="submit"
                            class="h-12 px-8 rounded-xl bg-[#d46211] hover:bg-[#994200] text-white font-bold text-sm shadow-[0_10px_20px_-5px_rgba(212,98,17,0.3)] transition-all hover:scale-[1.01] active:scale-95">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>

            <div class="glass-morphism rounded-3xl p-8 md:p-10 shadow-warm">
                <h3 class="text-xl font-bold text-[#1b1c1b] dark:text-white mb-6">Change Password</h3>

                <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
                    @csrf
                    @method('put')

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#8b7266] dark:text-[#9a6c4c] mb-2" for="current_password">Current Password</label>
                        <input id="current_password" name="current_password" type="password" required
                            class="h-12 w-full rounded-xl border border-[#eadfd4] bg-white/70 px-4 text-sm placeholder:text-[#8b7266] focus:border-primary focus:outline-none focus:ring-0 dark:border-white/10 dark:bg-white/5 dark:text-white dark:placeholder:text-[#9a6c4c]">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-[#8b7266] dark:text-[#9a6c4c] mb-2" for="password">New Password</label>
                            <input id="password" name="password" type="password" required
                                class="h-12 w-full rounded-xl border border-[#eadfd4] bg-white/70 px-4 text-sm placeholder:text-[#8b7266] focus:border-primary focus:outline-none focus:ring-0 dark:border-white/10 dark:bg-white/5 dark:text-white dark:placeholder:text-[#9a6c4c]">
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-[#8b7266] dark:text-[#9a6c4c] mb-2" for="password_confirmation">Confirm Password</label>
                            <input id="password_confirmation" name="password_confirmation" type="password" required
                                class="h-12 w-full rounded-xl border border-[#eadfd4] bg-white/70 px-4 text-sm placeholder:text-[#8b7266] focus:border-primary focus:outline-none focus:ring-0 dark:border-white/10 dark:bg-white/5 dark:text-white dark:placeholder:text-[#9a6c4c]">
                        </div>
                    </div>

                    <div class="pt-2">
                        <button type="submit"
                            class="h-12 px-8 rounded-xl bg-[#d46211] hover:bg-[#994200] text-white font-bold text-sm shadow-[0_10px_20px_-5px_rgba(212,98,17,0.3)] transition-all hover:scale-[1.01] active:scale-95">
                            Update Password
                        </button>
                    </div>
                </form>
            </div>

            <div class="glass-morphism rounded-3xl p-8 md:p-10 shadow-warm border border-red-200/50 dark:border-red-500/10">
                <h3 class="text-xl font-bold text-red-600 dark:text-red-400 mb-2">Delete Account</h3>
                <p class="text-sm text-[#6a5548] dark:text-white/60 mb-4">Permanently remove your account and all associated data. This cannot be undone.</p>

                <form method="POST" action="{{ route('profile.destroy') }}" class="space-y-4" onsubmit="return confirm('Are you sure you want to delete your account? This cannot be undone.');">
                    @csrf
                    @method('delete')

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#8b7266] dark:text-[#9a6c4c] mb-2" for="delete-password">Enter your password to confirm</label>
                        <input id="delete-password" name="password" type="password" required placeholder="Current password"
                            class="h-12 w-full rounded-xl border border-red-200 bg-white/70 px-4 text-sm placeholder:text-[#8b7266] focus:border-red-400 focus:outline-none focus:ring-0 dark:border-red-500/20 dark:bg-white/5 dark:text-white dark:placeholder:text-[#9a6c4c]">
                    </div>

                    <button type="submit"
                        class="h-12 px-8 rounded-xl bg-red-600 text-white font-bold text-sm shadow-lg shadow-red-600/25 transition-all hover:bg-red-700 active:scale-95">
                        Delete Account
                    </button>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
