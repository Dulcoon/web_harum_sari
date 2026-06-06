@extends('layouts.homepage')

@section('title', 'HOMELIVING | Home')

@section('content')
<main class="relative z-10 max-w-[1440px] mx-auto px-4 lg:px-10 py-8 lg:py-10 space-y-10">
    <section class="relative overflow-hidden rounded-[2.5rem] min-h-[520px] lg:min-h-[620px] flex items-center p-6 md:p-8 lg:p-12 border border-black/10 dark:border-white/10">
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-cover bg-center scale-105" style='background-image: url("{{ asset('assets/hero.png') }}");'></div>
        </div>

        <div class="relative z-10 max-w-2xl p-6 md:p-8 lg:p-10 rounded-[2rem] glass-morphism shadow-[0_20px_50px_rgba(0,0,0,0.18)]">
            <div class="space-y-6">
                <span class="inline-flex px-4 py-1 rounded-full bg-primary/20 text-primary text-[10px] font-black uppercase tracking-widest border border-primary/25">Crafted Living</span>
                <h1 class="text-4xl md:text-6xl lg:text-7xl font-black leading-[1.03] tracking-tight text-[#1b1c1b] dark:text-white">Modern Furniture for<br/><span class="premium-text-gradient">Modern Living</span></h1>
                <p class="text-base md:text-lg text-[#5f4b3f] dark:text-white/75 max-w-xl">Curated Scandinavian pieces designed for comfort, longevity, and timeless aesthetic appeal.</p>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('homepage.product') }}" class="bg-premium-gradient text-white px-8 py-3.5 rounded-2xl font-black text-sm shadow-xl hover:scale-105 transition-all">Shop Collection</a>
                    <a href="{{ route('email.form') }}" class="px-8 py-3.5 rounded-2xl font-black text-sm border border-black/15 dark:border-white/15 text-[#2a2019] dark:text-white hover:bg-black/5 dark:hover:bg-white/10 transition-all">Contact Team</a>
                </div>
            </div>
        </div>
    </section>

    <section class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6">
        <article class="glass-morphism rounded-2xl p-6 md:p-8 flex gap-4 items-start">
            <span class="material-symbols-outlined text-primary text-3xl">local_shipping</span>
            <div>
                <p class="text-[10px] font-black uppercase tracking-[0.15em] text-[#8a7568] dark:text-white/45 mb-2">Custom Shipping Assistance</p>
                <p class="text-lg font-bold text-[#1b1c1b] dark:text-white">We help you find the best shipping option</p>
            </div>
        </article>

        <article class="glass-morphism rounded-2xl p-6 md:p-8 flex gap-4 items-start">
            <span class="material-symbols-outlined text-primary text-3xl">eco</span>
            <div>
                <p class="text-[10px] font-black uppercase tracking-[0.15em] text-[#8a7568] dark:text-white/45 mb-2">Premium Materials</p>
                <p class="text-lg font-bold text-[#1b1c1b] dark:text-white">100% Sustainable Craftsmanship</p>
            </div>
        </article>

        <article class="glass-morphism rounded-2xl p-6 md:p-8 flex gap-4 items-start">
            <span class="material-symbols-outlined text-primary text-3xl">assignment_return</span>
            <div>
                <p class="text-[10px] font-black uppercase tracking-[0.15em] text-[#8a7568] dark:text-white/45 mb-2">Easy Returns</p>
                <p class="text-lg font-bold text-[#1b1c1b] dark:text-white">Flexible 30-Day Return Policy</p>
            </div>
        </article>
    </section>

    <section id="categories" class="space-y-6">
        <div class="flex items-center justify-between gap-4">
            <div>
                <h2 class="text-3xl md:text-4xl font-black tracking-tight text-[#1b1c1b] dark:text-white">Browse by Category</h2>
                <p class="text-sm text-[#6a5548] dark:text-white/60">Find pieces tailored to each corner of your home.</p>
            </div>
            <a class="text-sm font-bold text-primary hover:underline underline-offset-4" href="{{ route('homepage.product') }}">View All</a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-5 gap-4 md:gap-6">
            @foreach($kategories as $kategori)
                <a class="group relative aspect-[4/5] rounded-2xl overflow-hidden product-glass-card" href="{{ route('productss', ['kategori_id' => $kategori->id]) }}">
                    <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-110"
                        style='background-image: linear-gradient(to top, rgba(0,0,0,0.55), rgba(0,0,0,0.08)), url("{{ asset('storage/' . $kategori->thumbnail) }}");'></div>
                    <div class="absolute inset-x-0 bottom-0 p-4 md:p-5 text-white">
                        <p class="text-base md:text-lg font-bold leading-tight">{{ $kategori->nama }}</p>
                        <p class="text-[10px] font-black uppercase tracking-[0.12em] text-white/70 mt-1">{{ $kategori->products_count }} Products</p>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    <section id="featured" class="space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-3">
            <div>
                <h2 class="text-3xl md:text-4xl font-black tracking-tight text-[#1b1c1b] dark:text-white">Our Best Sellers</h2>
                <p class="text-sm text-[#6a5548] dark:text-white/60">Our most-loved pieces, chosen by you.</p>
            </div>
            <a href="{{ route('homepage.product') }}" class="text-sm font-bold text-primary hover:underline underline-offset-4">Explore Products</a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-5 md:gap-8">
            @foreach($featuredProducts as $product)
                <article class="product-glass-card rounded-3xl p-4 group transition-all duration-300 hover:-translate-y-1">
                    <div class="product-media-shell relative aspect-square rounded-2xl overflow-hidden mb-4 md:mb-5 flex items-center justify-center p-4 md:p-8">
                        <img src="{{ $product->foto ? asset('storage/' . $product->foto) : asset('assets/no_image.png') }}" alt="{{ $product->nama }}"
                            class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-700"/>

                        <span class="absolute top-3 left-3 bg-premium-gradient text-white text-[9px] md:text-[10px] font-black px-2.5 py-1 rounded-full uppercase tracking-tighter shadow-lg shadow-primary/40">Sale</span>

                        <a href="{{ route('product.detail', $product->id) }}" class="absolute bottom-3 right-3 w-8 h-8 md:w-9 md:h-9 bg-premium-gradient text-white rounded-xl flex items-center justify-center shadow-lg shadow-primary/30 opacity-0 group-hover:opacity-100 translate-y-2 group-hover:translate-y-0 transition-all">
                            <span class="material-symbols-outlined text-base">add</span>
                        </a>
                    </div>

                    <div class="px-1 space-y-1.5">
                        <h3 class="font-bold text-sm md:text-base truncate text-[#1b1c1b] dark:text-white">{{ $product->nama }}</h3>
                        <div class="flex items-center justify-between gap-2">
                            <p class="text-lg font-black premium-text-gradient">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                            <span class="text-[9px] md:text-[10px] font-bold text-[#8a7568] dark:text-white/40 uppercase">Featured</span>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    <section class="space-y-6 pb-4">
        <div class="text-center">
            <h2 class="text-3xl md:text-4xl font-black tracking-tight text-[#1b1c1b] dark:text-white mb-2">What Our Customers Say</h2>
            <p class="text-sm text-[#6a5548] dark:text-white/60">Real stories from people who built warm spaces with HOMELIVING.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach([
                ['name' => 'Sarah Johnson', 'role' => 'Interior Designer', 'quote' => 'The furniture from Woodcraft Homeliving is simply stunning! The quality and craftsmanship are unmatched.'],
                ['name' => 'Michael Brown', 'role' => 'Architect', 'quote' => 'I have been using Homeliving furniture for my projects, and they never disappoint. Modern yet timeless.'],
                ['name' => 'Emily Davis', 'role' => 'Decor Specialist', 'quote' => 'Beautiful and functional pieces. My clients are always impressed with the final look.'],
            ] as $item)
                <article class="glass-morphism rounded-2xl p-7 md:p-8 text-center">
                    <div class="w-16 h-16 mx-auto rounded-full border-4 border-white/90 dark:border-[#2a1d14] overflow-hidden shadow-sm mb-5">
                        <img src="{{ asset('assets/profile.png') }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                    </div>
                    <div class="flex justify-center gap-1 mb-4 text-primary">
                        <span class="material-symbols-outlined text-sm">star</span>
                        <span class="material-symbols-outlined text-sm">star</span>
                        <span class="material-symbols-outlined text-sm">star</span>
                        <span class="material-symbols-outlined text-sm">star</span>
                        <span class="material-symbols-outlined text-sm">star</span>
                    </div>
                    <p class="text-sm text-[#6a5548] dark:text-white/70 italic mb-5">"{{ $item['quote'] }}"</p>
                    <h4 class="font-bold text-lg text-[#1b1c1b] dark:text-white">{{ $item['name'] }}</h4>
                    <p class="text-[10px] font-black uppercase tracking-[0.14em] text-[#8a7568] dark:text-white/40 mt-1">{{ $item['role'] }}</p>
                </article>
            @endforeach
        </div>
    </section>
</main>
@endsection
