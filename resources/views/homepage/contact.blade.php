@extends('layouts.homepage')

@section('title', 'HOMELIVING | Contact Us')

@section('content')
<main class="relative z-10 max-w-[1440px] mx-auto px-4 lg:px-10 py-8 lg:py-10 space-y-8">
    <section class="glass-morphism rounded-[2.2rem] p-7 md:p-10 lg:p-14">
        <div class="max-w-3xl">
            <span class="inline-flex px-4 py-1 rounded-full bg-primary/20 text-primary text-[10px] font-black uppercase tracking-widest border border-primary/20 mb-4">Get In Touch</span>
            <h1 class="text-4xl md:text-6xl font-black leading-[1.05] tracking-tight text-[#1b1c1b] dark:text-white">Let’s Build Your<br/><span class="premium-text-gradient">Dream Interior</span></h1>
            <p class="mt-4 text-sm md:text-base text-[#6a5548] dark:text-white/65 max-w-2xl">Talk to our team about products, customization, shipping, or collaboration opportunities. We’ll get back with the best recommendation for your space.</p>
        </div>
    </section>

    @if (session('pesan'))
        <div class="glass-morphism rounded-2xl p-4 border border-emerald-400/30 text-emerald-700 dark:text-emerald-300 flex items-center gap-3">
            <span class="material-symbols-outlined">check_circle</span>
            <p>{{ session('pesan') }}</p>
        </div>
    @endif

    @if ($errors->any())
        <div class="glass-morphism rounded-2xl p-4 border border-red-400/30 text-red-700 dark:text-red-300">
            <ul class="list-disc list-inside text-sm space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8">
        <section class="lg:col-span-7 glass-morphism rounded-3xl p-6 md:p-8 lg:p-10">
            <h2 class="text-2xl md:text-3xl font-black tracking-tight text-[#1b1c1b] dark:text-white mb-6">Send Us a Message</h2>

            <form action="{{ route('email.send') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-5">
                    <div>
                        <label class="block text-[10px] uppercase tracking-[0.12em] font-black text-[#8a7568] dark:text-white/50 mb-2">Your Name</label>
                        <input class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-white/5 px-4 py-3 text-sm text-[#1b1c1b] dark:text-white placeholder:text-[#9a8679] dark:placeholder:text-white/30 focus:border-primary focus:ring-0"
                            placeholder="John Doe" type="text" name="name" required value="{{ old('name') }}"/>
                    </div>

                    <div>
                        <label class="block text-[10px] uppercase tracking-[0.12em] font-black text-[#8a7568] dark:text-white/50 mb-2">Email Address</label>
                        <input class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-white/5 px-4 py-3 text-sm text-[#1b1c1b] dark:text-white placeholder:text-[#9a8679] dark:placeholder:text-white/30 focus:border-primary focus:ring-0"
                            placeholder="hello@company.com" type="email" name="email" required value="{{ old('email') }}"/>
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] uppercase tracking-[0.12em] font-black text-[#8a7568] dark:text-white/50 mb-2">Phone Number</label>
                    <input class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-white/5 px-4 py-3 text-sm text-[#1b1c1b] dark:text-white placeholder:text-[#9a8679] dark:placeholder:text-white/30 focus:border-primary focus:ring-0"
                        placeholder="+62 8..." type="text" name="phone" required value="{{ old('phone') }}"/>
                </div>

                <div>
                    <label class="block text-[10px] uppercase tracking-[0.12em] font-black text-[#8a7568] dark:text-white/50 mb-2">Subject</label>
                    <input class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-white/5 px-4 py-3 text-sm text-[#1b1c1b] dark:text-white placeholder:text-[#9a8679] dark:placeholder:text-white/30 focus:border-primary focus:ring-0"
                        placeholder="How can we help?" type="text" name="subject" required value="{{ old('subject') }}"/>
                </div>

                <div>
                    <label class="block text-[10px] uppercase tracking-[0.12em] font-black text-[#8a7568] dark:text-white/50 mb-2">Message</label>
                    <textarea class="w-full rounded-xl border border-black/10 dark:border-white/10 bg-black/[0.02] dark:bg-white/5 px-4 py-3 text-sm text-[#1b1c1b] dark:text-white placeholder:text-[#9a8679] dark:placeholder:text-white/30 resize-none focus:border-primary focus:ring-0"
                        placeholder="Tell us about your project..." rows="6" name="message" required>{{ old('message') }}</textarea>
                </div>

                <button class="bg-premium-gradient text-white font-black text-xs uppercase tracking-widest py-4 px-8 rounded-xl shadow-lg shadow-primary/30 hover:brightness-110 transition-all" type="submit">
                    Send Message
                </button>
            </form>
        </section>

        <aside class="lg:col-span-5 space-y-5">
            <article class="glass-morphism rounded-3xl p-6 md:p-7">
                <h3 class="text-[10px] uppercase tracking-[0.2em] font-black text-primary mb-4">The Showroom</h3>
                <div class="flex items-start gap-4">
                    <span class="material-symbols-outlined text-primary text-2xl">location_on</span>
                    <div>
                        <p class="font-bold text-xl text-[#1b1c1b] dark:text-white mb-2">Bali Headquarters</p>
                        <p class="text-sm text-[#6a5548] dark:text-white/65 leading-relaxed">Pura Masuka Street, South Kuta, Badung Regency, Bali 80361, Indonesia.</p>
                    </div>
                </div>
            </article>

            <article class="glass-morphism rounded-3xl p-6 md:p-7 space-y-5">
                <h3 class="text-[10px] uppercase tracking-[0.2em] font-black text-primary">Reach Out</h3>

                <div class="flex items-center gap-4">
                    <span class="material-symbols-outlined text-primary text-2xl">call</span>
                    <div>
                        <p class="text-[10px] uppercase tracking-[0.12em] font-black text-[#8a7568] dark:text-white/50 mb-1">Direct Line</p>
                        <p class="font-bold text-lg text-[#1b1c1b] dark:text-white">0856 4564 646</p>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <span class="material-symbols-outlined text-primary text-2xl">mail</span>
                    <div>
                        <p class="text-[10px] uppercase tracking-[0.12em] font-black text-[#8a7568] dark:text-white/50 mb-1">Enquiries</p>
                        <p class="font-bold text-lg text-[#1b1c1b] dark:text-white break-all">homelivingwoodcraft@gmail.com</p>
                    </div>
                </div>
            </article>

            <article class="glass-morphism rounded-3xl p-6 md:p-7">
                <h3 class="text-[10px] uppercase tracking-[0.2em] font-black text-primary mb-4">Follow Us</h3>
                <div class="flex gap-3">
                    <a aria-label="Instagram" class="w-11 h-11 rounded-full border border-black/10 dark:border-white/10 flex items-center justify-center text-[#8a7568] dark:text-white/50 transition-all hover:border-primary hover:text-primary hover:scale-105" href="#">
                        <span class="material-symbols-outlined text-xl">camera</span>
                    </a>
                    <a aria-label="Facebook" class="w-11 h-11 rounded-full border border-black/10 dark:border-white/10 flex items-center justify-center text-[#8a7568] dark:text-white/50 transition-all hover:border-primary hover:text-primary hover:scale-105" href="#">
                        <span class="material-symbols-outlined text-xl">public</span>
                    </a>
                    <a aria-label="Pinterest" class="w-11 h-11 rounded-full border border-black/10 dark:border-white/10 flex items-center justify-center text-[#8a7568] dark:text-white/50 transition-all hover:border-primary hover:text-primary hover:scale-105" href="#">
                        <span class="material-symbols-outlined text-xl">grid_view</span>
                    </a>
                    <a aria-label="Twitter" class="w-11 h-11 rounded-full border border-black/10 dark:border-white/10 flex items-center justify-center text-[#8a7568] dark:text-white/50 transition-all hover:border-primary hover:text-primary hover:scale-105" href="#">
                        <span class="material-symbols-outlined text-xl">alternate_email</span>
                    </a>
                </div>
            </article>
        </aside>
    </div>
</main>
@endsection
