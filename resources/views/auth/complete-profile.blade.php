@extends('layouts.homepage')

@section('title', 'Complete Profile | HOMELIVING')

@section('seo')
    <x-seo
        title="Complete Profile — HOMELIVING"
        description="Complete your HOMELIVING profile setup."
        url="{{ url()->current() }}"
        type="website"
    />
@endsection

@section('content')
<main class="min-h-screen flex items-center justify-center px-4 py-12 relative z-10">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <h1 class="text-4xl font-black tracking-tight">HOME<span class="text-primary">LIVING</span></h1>
            <p class="text-sm text-[#6a5548] dark:text-white/60 mt-2">Almost there! Just a few more details.</p>
        </div>

        <div class="glass-morphism rounded-3xl p-8 md:p-10 shadow-warm">
            @if ($errors->any())
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50/80 px-4 py-3 text-sm font-medium text-red-700 dark:border-red-500/20 dark:bg-red-500/10 dark:text-red-400">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('complete-profile.store') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#8b7266] dark:text-[#9a6c4c] mb-2" for="username">Username</label>
                    <input id="username" name="username" type="text" value="{{ old('username', $suggestedUsername ?? '') }}" required placeholder="johndoe"
                        class="h-12 w-full rounded-xl border border-[#eadfd4] bg-white/70 px-4 text-sm placeholder:text-[#8b7266] focus:border-primary focus:outline-none focus:ring-0 dark:border-white/10 dark:bg-white/5 dark:text-white dark:placeholder:text-[#9a6c4c]">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#8b7266] dark:text-[#9a6c4c] mb-2" for="phone">Phone Number</label>
                    <input id="phone" name="phone" type="tel" value="{{ old('phone') }}" required placeholder="+62 812-3456-7890"
                        class="h-12 w-full rounded-xl border border-[#eadfd4] bg-white/70 px-4 text-sm placeholder:text-[#8b7266] focus:border-primary focus:outline-none focus:ring-0 dark:border-white/10 dark:bg-white/5 dark:text-white dark:placeholder:text-[#9a6c4c]">
                    <p class="mt-1 text-xs text-[#8b7266] dark:text-[#9a6c4c]">We'll use this for order updates and delivery coordination.</p>
                </div>

                <button type="submit"
                    class="w-full h-12 rounded-xl bg-[#d46211] hover:bg-[#994200] text-white font-bold text-sm shadow-[0_10px_20px_-5px_rgba(212,98,17,0.3)] transition-all hover:scale-[1.01] active:scale-95">
                    Complete Setup
                </button>
            </form>
        </div>
    </div>
</main>
@endsection
