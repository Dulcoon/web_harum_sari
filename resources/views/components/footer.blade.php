<footer class="relative z-10 glass-morphism border-t border-black/10 dark:border-white/5 mt-24 py-16">
    <div class="max-w-[1440px] mx-auto px-4 lg:px-10 grid grid-cols-1 md:grid-cols-4 gap-12">
        <div>
            <div class="flex items-center gap-3 mb-6">
                <div class="w-9 h-9 bg-premium-gradient flex items-center justify-center rounded-xl text-white shadow-lg shadow-primary/20">
                    <span class="material-symbols-outlined text-lg">chair</span>
                </div>
                <h1 class="text-xl font-extrabold tracking-tight text-[#1b1c1b] dark:text-white">HOMELIVING</h1>
            </div>
            <p class="text-sm text-[#6a5548] dark:text-white/60 leading-relaxed mb-6">Redefining the essence of modern living through timeless Scandinavian design and sustainable luxury.</p>
            <div class="flex gap-3">
                <a class="w-10 h-10 flex items-center justify-center rounded-xl glass-morphism text-primary hover:bg-premium-gradient hover:text-white transition-all" href="#" aria-label="Website">
                    <span class="material-symbols-outlined text-xl">public</span>
                </a>
                <a class="w-10 h-10 flex items-center justify-center rounded-xl glass-morphism text-primary hover:bg-premium-gradient hover:text-white transition-all" href="#" aria-label="Email">
                    <span class="material-symbols-outlined text-xl">alternate_email</span>
                </a>
            </div>
        </div>

        <div>
            <h5 class="font-black text-xs uppercase tracking-widest mb-6 text-[#2a2019] dark:text-white/90">Collections</h5>
            <ul class="space-y-3 text-sm font-bold text-[#6a5548] dark:text-white/50">
                <li><a class="hover:text-primary transition-colors" href="{{ route('homepage.product') }}">All Furniture</a></li>
                <li><a class="hover:text-primary transition-colors" href="{{ route('homepage.product') }}">Lighting</a></li>
                <li><a class="hover:text-primary transition-colors" href="{{ route('homepage.product') }}">Home Decor</a></li>
                <li><a class="hover:text-primary transition-colors" href="{{ route('homepage.product') }}">Curated Sets</a></li>
            </ul>
        </div>

        <div>
            <h5 class="font-black text-xs uppercase tracking-widest mb-6 text-[#2a2019] dark:text-white/90">Experience</h5>
            <ul class="space-y-3 text-sm font-bold text-[#6a5548] dark:text-white/50">
                <li><a class="hover:text-primary transition-colors" href="{{ route('homepage.product') }}">Design Service</a></li>
                <li><a class="hover:text-primary transition-colors" href="{{ route('homepage.product') }}">Showrooms</a></li>
                <li><a class="hover:text-primary transition-colors" href="{{ route('homepage.product') }}">Sustainability</a></li>
                <li><a class="hover:text-primary transition-colors" href="{{ route('homepage.product') }}">Our Story</a></li>
            </ul>
        </div>

        <div>
            <h5 class="font-black text-xs uppercase tracking-widest mb-6 text-[#2a2019] dark:text-white/90">Stay Inspired</h5>
            <p class="text-sm text-[#6a5548] dark:text-white/60 mb-4 font-medium">Join our community for exclusive previews and design insights.</p>
            <div class="flex p-1.5 glass-morphism rounded-2xl shadow-inner border-white/10">
                <input class="flex-1 bg-transparent border-none rounded-xl px-4 py-2 focus:ring-0 text-sm placeholder:text-[#8a7568] dark:placeholder:text-white/30 text-[#2a2019] dark:text-white" placeholder="Email address" type="email"/>
                <button class="bg-premium-gradient text-white px-6 py-3 rounded-xl font-black text-xs shadow-lg shadow-primary/30">Join</button>
            </div>
        </div>
    </div>

    <div class="max-w-[1440px] mx-auto px-4 lg:px-10 mt-16 pt-8 border-t border-black/10 dark:border-white/5 flex flex-col md:flex-row justify-between gap-4 items-center">
        <p class="text-[10px] font-bold text-[#7d695b] dark:text-white/30 uppercase tracking-widest">© 2024 HOMELIVING. Crafting spaces that inspire.</p>
        <div class="flex gap-8 text-[10px] font-black text-[#7d695b] dark:text-white/30 uppercase tracking-widest">
            <span class="hover:text-primary cursor-pointer transition-colors">Terms</span>
            <span class="hover:text-primary cursor-pointer transition-colors">Privacy</span>
            <span class="hover:text-primary cursor-pointer transition-colors">Cookies</span>
        </div>
    </div>
</footer>
