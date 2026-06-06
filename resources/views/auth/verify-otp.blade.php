@extends('layouts.homepage')

@section('title', 'Verify Email | HOMELIVING')

@section('seo')
    <x-seo
        title="Verify Email — HOMELIVING"
        description="Verify your email address to complete your HOMELIVING registration."
        url="{{ url()->current() }}"
        type="website"
    />
@endsection

@section('content')
<main class="min-h-screen flex items-center justify-center px-4 py-12 relative z-10">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <h1 class="text-4xl font-black tracking-tight">HOME<span class="text-primary">LIVING</span></h1>
            <p class="text-sm text-[#6a5548] dark:text-white/60 mt-2">Check your inbox for a verification code.</p>
        </div>

        <div class="glass-morphism rounded-3xl p-8 md:p-10 shadow-warm">
            @if (session('error'))
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50/80 px-4 py-3 text-sm font-medium text-red-700 dark:border-red-500/20 dark:bg-red-500/10 dark:text-red-400">
                    {{ session('error') }}
                </div>
            @endif

            @if (session('success'))
                <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50/80 px-4 py-3 text-sm font-medium text-emerald-700 dark:border-emerald-500/20 dark:bg-emerald-500/10 dark:text-emerald-400">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50/80 px-4 py-3 text-sm font-medium text-red-700 dark:border-red-500/20 dark:bg-red-500/10 dark:text-red-400">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="text-center mb-8">
                <span class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-primary/10 text-primary mb-4">
                    <span class="material-symbols-outlined text-3xl">mail</span>
                </span>
                <p class="text-sm text-[#6a5548] dark:text-white/60">
                    We sent a 6-digit code to <strong class="text-[#51423a] dark:text-white">{{ request('email') }}</strong>
                </p>
            </div>

            <form method="POST" action="{{ route('verify-otp.post') }}" class="space-y-6">
                @csrf
                <input type="hidden" name="email" value="{{ request('email') }}">

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#8b7266] dark:text-[#9a6c4c] mb-3 text-center">Verification Code</label>
                    <div class="flex justify-center gap-3">
                        @for ($i = 0; $i < 6; $i++)
                            <input type="text" maxlength="1" inputmode="numeric" pattern="[0-9]" required
                                class="otp-input w-12 h-14 text-center text-xl font-bold rounded-xl border border-[#eadfd4] bg-white/70 focus:border-primary focus:outline-none focus:ring-0 dark:border-white/10 dark:bg-white/5 dark:text-white"
                                data-index="{{ $i }}"
                                oninput="handleOtpInput(this)"
                                onkeydown="handleOtpKeydown(this, event)">
                        @endfor
                    </div>
                    <input type="hidden" name="otp" id="otp-code">
                </div>

                <button type="submit"
                    class="w-full h-12 rounded-xl bg-[#d46211] hover:bg-[#994200] text-white font-bold text-sm shadow-[0_10px_20px_-5px_rgba(212,98,17,0.3)] transition-all hover:scale-[1.01] active:scale-95">
                    Verify Email
                </button>
            </form>

            <div class="mt-6 text-center">
                <form method="POST" action="{{ route('verify-otp.resend') }}" class="inline">
                    @csrf
                    <input type="hidden" name="email" value="{{ request('email') }}">
                    <button type="submit" id="resend-btn"
                        class="text-sm font-semibold text-primary hover:underline disabled:opacity-40 disabled:no-underline disabled:cursor-not-allowed"
                        disabled>
                        Resend code <span id="countdown">(60)</span>
                    </button>
                </form>
            </div>

            <p class="mt-6 text-center text-sm text-[#6a5548] dark:text-white/60">
                <a href="{{ route('login') }}" class="font-semibold text-primary hover:underline">Back to sign in</a>
            </p>
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script>
    let countdown = 60;
    const resendBtn = document.getElementById('resend-btn');
    const countdownEl = document.getElementById('countdown');

    function startCountdown() {
        countdown = 60;
        resendBtn.disabled = true;
        const interval = setInterval(() => {
            countdown--;
            countdownEl.textContent = `(${countdown})`;
            if (countdown <= 0) {
                clearInterval(interval);
                resendBtn.disabled = false;
                countdownEl.textContent = '';
            }
        }, 1000);
    }

    function handleOtpInput(el) {
        el.value = el.value.replace(/[^0-9]/g, '');
        if (el.value && el.nextElementSibling && el.nextElementSibling.classList.contains('otp-input')) {
            el.nextElementSibling.focus();
        }
        updateOtpCode();
    }

    function handleOtpKeydown(el, e) {
        if (e.key === 'Backspace' && !el.value && el.previousElementSibling && el.previousElementSibling.classList.contains('otp-input')) {
            el.previousElementSibling.focus();
            el.previousElementSibling.value = '';
        }
        updateOtpCode();
    }

    function updateOtpCode() {
        const inputs = document.querySelectorAll('.otp-input');
        let code = '';
        inputs.forEach(input => code += input.value);
        document.getElementById('otp-code').value = code;
    }

    startCountdown();
</script>
@endpush
