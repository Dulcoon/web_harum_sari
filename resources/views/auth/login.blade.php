@extends('layouts.auth-clean')

@section('title', 'Login | HOMELIVING')
@section('body_class', 'bg-surface font-body text-on-surface selection:bg-primary-fixed min-h-screen')

@section('content')
<main class="min-h-screen flex items-center justify-center p-4 md:p-8 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-1/3 h-full bg-surface-container-low -z-10 translate-x-1/4"></div>
    <div class="absolute bottom-10 left-10 w-64 h-64 border-outline-variant/10 border-[1px] rounded-full -z-10"></div>
    <div class="absolute -top-20 -left-20 w-96 h-96 bg-primary/5 rounded-full blur-3xl -z-10"></div>

    <div class="max-w-6xl w-full flex flex-col md:flex-row bg-surface-container-lowest rounded-[2rem] overflow-hidden shadow-[0_40px_100px_-20px_rgba(27,28,27,0.08)]">
        <div class="hidden md:block md:w-1/2 relative group min-h-[600px]">
            <img alt="Modern Minimalist Interior" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-[3000ms] ease-out" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBc_nEHMNRuUf4m7Gctua_b2yfnmQvrDVzvAUGOOKkp6JXpAn-_nP7-YTLccfPeb3dbOvMDe8q6TNmNNsoiCvksQtXpkVOup1LAiNfTAxPtaDvhSBOAAhoyNsVxMOkLH6bFf68AGsUGydDC50zOwooBax5aBdE8-JuUmMOSSyRRP7lsakmGMTeB1BK5vjITSFBlseoagdJYTLpXcMzWlQ5Q_0UXiZyoectNNGwaare4NJhIE605aNJptjh-rzlUDBTOKzj1myVbTGEQ"/>
            <div class="absolute inset-0 bg-stone-900/10 mix-blend-multiply"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>
            <div class="absolute bottom-12 left-12 right-12 z-10">
                <p class="font-headline text-5xl text-white leading-[1.1] tracking-tight font-medium">Design <br/>Your <br/>Sanctuary.</p>
            </div>
        </div>

        <div class="w-full md:w-1/2 p-8 md:p-16 flex flex-col justify-center bg-surface-container-lowest">
            <div class="max-w-md mx-auto w-full">
                <header class="mb-12">
                    <div class="text-xl font-bold tracking-tighter text-stone-900 mb-8 uppercase">HOMELIVING</div>
                    <h1 class="font-headline text-3xl font-semibold text-on-surface mb-2 tracking-tight">Welcome Back</h1>
                    <p class="text-secondary font-body text-sm leading-relaxed">Enter your details to access your curated space and saved collections.</p>
                </header>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                @if ($errors->any())
                    <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <div class="space-y-2">
                        <label class="font-label text-xs uppercase tracking-widest text-on-surface-variant font-medium" for="email">Email Address</label>
                        <div class="relative group">
                            <input class="w-full px-4 py-4 bg-surface-container rounded-lg border-none focus:ring-1 focus:ring-primary/40 focus:bg-surface-container-lowest transition-all duration-300 outline-none text-on-surface placeholder:text-stone-400"
                                   id="email"
                                   name="email"
                                   value="{{ old('email') }}"
                                   placeholder="atelier@homeliving.com"
                                   type="email"
                                   required
                                   autofocus
                                   autocomplete="username"/>
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>

                    <div class="space-y-2">
                        <div class="flex justify-between items-center">
                            <label class="font-label text-xs uppercase tracking-widest text-on-surface-variant font-medium" for="password">Password</label>
                            @if (Route::has('password.request'))
                                <a class="font-label text-[10px] uppercase tracking-widest text-primary font-semibold hover:opacity-80 transition-opacity underline underline-offset-4 decoration-primary/30" href="{{ route('password.request') }}">
                                    Forgot Password?
                                </a>
                            @endif
                        </div>
                        <div class="relative group">
                            <input class="w-full px-4 py-4 bg-surface-container rounded-lg border-none focus:ring-1 focus:ring-primary/40 focus:bg-surface-container-lowest transition-all duration-300 outline-none text-on-surface placeholder:text-stone-400"
                                   id="password"
                                   name="password"
                                   placeholder="••••••••"
                                   type="password"
                                   required
                                   autocomplete="current-password"/>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>

                    <div class="pt-4">
                        <button class="w-full bg-[#d46211] hover:bg-[#994200] text-white font-headline font-semibold py-4 rounded-lg shadow-[0_10px_20px_-5px_rgba(212,98,17,0.3)] transition-all duration-300 transform hover:-translate-y-0.5 active:scale-[0.98] flex items-center justify-center gap-2" type="submit">
                            Sign In
                            <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </button>
                    </div>
                </form>

                <div class="relative my-10">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-outline-variant/20"></div>
                    </div>
                    <div class="relative flex justify-center text-xs uppercase tracking-[0.2em] font-label">
                        <span class="bg-surface-container-lowest px-4 text-stone-400">or join the atelier</span>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <button type="button" class="flex items-center justify-center gap-3 py-3 px-4 rounded-lg bg-surface-container hover:bg-surface-container-high transition-colors text-on-surface font-body text-sm font-medium">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"></path><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"></path><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"></path><path d="M12 5.38c1.62 0 3.06.56 4.21 1.66l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"></path></svg>
                        Google
                    </button>
                    <button type="button" class="flex items-center justify-center gap-3 py-3 px-4 rounded-lg bg-surface-container hover:bg-surface-container-high transition-colors text-on-surface font-body text-sm font-medium">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.05 20.28c-.96.95-2.23 1.54-3.73 1.54-3.07 0-5.56-2.49-5.56-5.56 0-3.07 2.49-5.56 5.56-5.56 1.5 0 2.77.59 3.73 1.54l3.13-3.13C18.25 7.15 15.31 6 12 6c-5.52 0-10 4.48-10 10s4.48 10 10 10c3.31 0 6.25-1.15 8.18-3.07l-3.13-3.13z"></path></svg>
                        Apple
                    </button>
                </div>

                <p class="mt-12 text-center text-sm font-body text-secondary">
                    Don't have an account?
                    <a class="text-primary font-semibold hover:underline underline-offset-4 decoration-primary/30 transition-all" href="{{ route('register') }}">Sign Up</a>
                </p>
            </div>
        </div>
    </div>
</main>
@endsection
