@extends('layouts.homepage')

@section('title', 'HOMELIVING | Home')

@section('head')
    {{-- Preload the LCP hero so the browser fetches it at high priority before
         it parses the body. imagesrcset lets the browser pick the right size. --}}
    <link rel="preload" as="image" type="image/avif" fetchpriority="high"
        href="{{ asset('assets/hero-1024.avif') }}"
        imagesrcset="{{ asset('assets/hero-640.avif') }} 640w, {{ asset('assets/hero-1024.avif') }} 1024w, {{ asset('assets/hero-1536.avif') }} 1536w, {{ asset('assets/hero-1920.avif') }} 1920w"
        imagesizes="(max-width: 768px) 100vw, (max-width: 1440px) 100vw, 1440px">
@endsection

@section('seo')
    <x-seo
        title="HOMELIVING | Home"
        description="Discover HOMELIVING — curated Scandinavian furniture designed for comfort, longevity, and timeless aesthetic appeal. Shop modern living essentials."
        url="{{ url('/') }}"
        type="website"
    />
@endsection

@section('content')
@php
    // Slide 1: hero, slide 2: gemini-banner.
    // Slide 3 is intentionally empty — a third image will be added later.
    $heroSlides = [
        [
            'base' => 'hero',
            'alt' => 'Modern Scandinavian living room furnished by HOMELIVING',
            'eyebrow' => 'Crafted Living',
            'title' => 'Modern Furniture for',
            'accent' => 'Modern Living',
            'desc' => 'Curated Scandinavian pieces designed for comfort, longevity, and timeless aesthetic appeal.',
        ],
        [
            'base' => 'gemini-banner',
            'alt' => 'Warm neutral sofa and coffee table styled by HOMELIVING',
            'eyebrow' => 'Timeless Comfort',
            'title' => 'Pieces that make a house',
            'accent' => 'feel like home',
            'desc' => 'Natural textures and honest materials, made to be lived with for years to come.',
        ],
    ];
@endphp

<main class="relative z-10">
    {{-- ============================= HERO ============================= --}}
    <section
        x-data="{
            active: 0,
            total: {{ count($heroSlides) }},
            timer: null,
            next() { this.active = (this.active + 1) % this.total },
            prev() { this.active = (this.active - 1 + this.total) % this.total },
            go(i) { this.active = i },
            start() { this.timer = setInterval(() => this.next(), 6500) },
            stop() { clearInterval(this.timer) },
        }"
        x-init="start()"
        @mouseenter="stop()"
        @mouseleave="start()"
        class="relative bg-[#f7f2ec] dark:bg-[#1a0f0a] border-b border-black/5 dark:border-white/5 overflow-hidden"
    >
        <div class="relative max-w-[1440px] mx-auto min-h-[620px] lg:min-h-[680px] flex items-end lg:items-center">

            {{-- Full-bleed slides --}}
            @foreach($heroSlides as $i => $slide)
                <picture>
                    <source type="image/avif"
                        srcset="{{ asset('assets/' . $slide['base'] . '-640.avif') }} 640w, {{ asset('assets/' . $slide['base'] . '-1024.avif') }} 1024w, {{ asset('assets/' . $slide['base'] . '-1536.avif') }} 1536w, {{ asset('assets/' . $slide['base'] . '-1920.avif') }} 1920w"
                        sizes="100vw">
                    <source type="image/webp"
                        srcset="{{ asset('assets/' . $slide['base'] . '-640.webp') }} 640w, {{ asset('assets/' . $slide['base'] . '-1024.webp') }} 1024w, {{ asset('assets/' . $slide['base'] . '-1536.webp') }} 1536w, {{ asset('assets/' . $slide['base'] . '-1920.webp') }} 1920w"
                        sizes="100vw">
                    <img src="{{ asset('assets/' . $slide['base'] . '-1024.webp') }}"
                        alt="{{ $slide['alt'] }}"
                        width="1920" height="1280"
                        @if($i === 0) fetchpriority="high" @endif
                        decoding="async"
                        class="absolute inset-0 w-full h-full object-cover object-center"
                        style="opacity: {{ $i === 0 ? 1 : 0 }}; transition: opacity 900ms ease;"
                        x-bind:style="`opacity: ${active === {{ $i }} ? 1 : 0}; transition: opacity 900ms ease;`">
                </picture>
            @endforeach

            {{-- Seamless scrims: desktop fades in from the left, mobile from the bottom --}}
            <div class="hero-scrim hidden lg:block hero-scrim-h"></div>
            <div class="hero-scrim lg:hidden hero-scrim-v"></div>

            {{-- Content --}}
            <div class="relative z-10 w-full px-6 sm:px-10 lg:px-16 py-14 lg:py-20">
                <div class="w-full max-w-xl">
                    @foreach($heroSlides as $i => $slide)
                        <div
                            x-show="active === {{ $i }}"
                            x-transition:enter="transition ease-out duration-500"
                            x-transition:enter-start="opacity-0 translate-y-3"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            @if($i > 0) style="display: none;" @endif
                        >
                            <span class="inline-block text-[11px] font-black uppercase tracking-[0.28em] text-primary/80">{{ $slide['eyebrow'] }}</span>
                            <h1 class="mt-5 font-serif text-4xl sm:text-5xl lg:text-[3.6rem] leading-[1.06] tracking-tight text-[#2a2019] dark:text-white">
                                {{ $slide['title'] }}<br>
                                <span class="text-primary italic">{{ $slide['accent'] }}</span>
                            </h1>
                            <p class="mt-6 text-sm sm:text-base leading-relaxed text-[#6a5548] dark:text-white/65 max-w-md">{{ $slide['desc'] }}</p>
                        </div>
                    @endforeach

                    {{-- CTAs --}}
                    <div class="mt-9 flex flex-wrap items-center gap-3">
                        <a href="{{ route('homepage.product') }}"
                           class="inline-flex items-center gap-2 bg-primary hover:bg-primary-deep text-white px-7 py-3.5 rounded-md font-bold text-sm tracking-wide shadow-lg shadow-primary/25 transition-all hover:-translate-y-0.5">
                            Shop Collection
                            <x-icon name="arrow_forward" class="w-4 h-4" />
                        </a>
                        <a href="{{ route('email.form') }}"
                           class="inline-flex items-center gap-2 px-7 py-3.5 rounded-md font-bold text-sm tracking-wide border border-[#2a2019]/20 dark:border-white/20 text-[#2a2019] dark:text-white hover:bg-black/5 dark:hover:bg-white/10 transition-all">
                            Explore Catalog
                        </a>
                    </div>

                    {{-- Slider controls --}}
                    <div class="mt-12 flex items-center gap-5">
                        <div class="flex items-center gap-2 text-sm font-bold tabular-nums text-[#2a2019] dark:text-white">
                            <span x-text="String(active + 1).padStart(2, '0')"></span>
                            <span class="h-px w-8 bg-[#2a2019]/25 dark:bg-white/25"></span>
                            <span class="text-[#8a7568] dark:text-white/40">{{ str_pad((string) count($heroSlides), 2, '0', STR_PAD_LEFT) }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <button type="button" @click="prev()" aria-label="Previous slide"
                                class="w-10 h-10 rounded-full border border-[#2a2019]/15 dark:border-white/20 flex items-center justify-center text-[#2a2019] dark:text-white hover:bg-primary hover:border-primary hover:text-white transition-all">
                                <x-icon name="arrow_back" class="w-4 h-4" />
                            </button>
                            <button type="button" @click="next()" aria-label="Next slide"
                                class="w-10 h-10 rounded-full border border-[#2a2019]/15 dark:border-white/20 flex items-center justify-center text-[#2a2019] dark:text-white hover:bg-primary hover:border-primary hover:text-white transition-all">
                                <x-icon name="arrow_forward" class="w-4 h-4" />
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Caption card --}}
            <div class="absolute top-5 right-5 lg:top-auto lg:bottom-5 z-10 max-w-[170px] lg:max-w-[190px] rounded-tl-[1.5rem] rounded-br-[1.5rem] bg-[#2a2019]/85 dark:bg-black/70 backdrop-blur-sm px-4 py-3 lg:px-5 lg:py-4 text-white/90">
                <p class="text-[11px] lg:text-xs leading-relaxed">A home should tell <span class="font-serif italic">your story</span>.</p>
            </div>
        </div>
    </section>

    {{-- ========================= FEATURE BAR ========================= --}}
    <section class="bg-white dark:bg-[#221810] border-b border-black/5 dark:border-white/5">
        <div class="max-w-[1440px] mx-auto grid grid-cols-1 sm:grid-cols-3 divide-y sm:divide-y-0 sm:divide-x divide-black/8 dark:divide-white/8">
            <article class="flex items-center gap-4 px-6 sm:px-8 lg:px-10 py-7">
                <x-icon name="local_shipping" class="w-7 h-7 shrink-0 text-[#2a2019] dark:text-white" />
                <div>
                    <p class="text-sm font-bold text-[#2a2019] dark:text-white">Custom Shipping Assistance</p>
                    <p class="text-xs text-[#8a7568] dark:text-white/50 mt-0.5">We help you find the best option</p>
                </div>
            </article>

            <article class="flex items-center gap-4 px-6 sm:px-8 lg:px-10 py-7">
                <x-icon name="eco" class="w-7 h-7 shrink-0 text-[#2a2019] dark:text-white" />
                <div>
                    <p class="text-sm font-bold text-[#2a2019] dark:text-white">Premium Materials</p>
                    <p class="text-xs text-[#8a7568] dark:text-white/50 mt-0.5">100% sustainable craftsmanship</p>
                </div>
            </article>

            <article class="flex items-center gap-4 px-6 sm:px-8 lg:px-10 py-7">
                <x-icon name="assignment_return" class="w-7 h-7 shrink-0 text-[#2a2019] dark:text-white" />
                <div>
                    <p class="text-sm font-bold text-[#2a2019] dark:text-white">Flexible Returns</p>
                    <p class="text-xs text-[#8a7568] dark:text-white/50 mt-0.5">30-day return policy</p>
                </div>
            </article>
        </div>
    </section>

    {{-- ======================== BROWSE CATEGORY ======================== --}}
    <section id="categories" class="bg-white dark:bg-[#221810]">
        <div class="max-w-[1440px] mx-auto px-6 sm:px-10 lg:px-16 py-16 lg:py-20">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-10">
                <div>
                    <h2 class="font-serif text-3xl sm:text-4xl lg:text-[2.6rem] tracking-tight text-[#2a2019] dark:text-white">Browse by Category</h2>
                    <p class="mt-2 text-sm text-[#8a7568] dark:text-white/55">Find pieces tailored to each corner of your home.</p>
                </div>
                <a href="{{ route('homepage.product') }}"
                   class="inline-flex items-center gap-2 text-xs font-black uppercase tracking-[0.18em] text-primary hover:gap-3 transition-all">
                    View All Categories
                    <x-icon name="arrow_forward" class="w-4 h-4" />
                </a>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-5 gap-x-5 gap-y-8">
                @forelse($kategories as $kategori)
                    <a href="{{ route('productss', ['kategori_id' => $kategori->id]) }}" class="group block">
                        <div class="relative aspect-[4/5] rounded-xl overflow-hidden bg-[#efe6dd] dark:bg-white/5">
                            <img
                                src="{{ $kategori->thumbnail ? asset('storage/' . $kategori->thumbnail) : asset('assets/no_image.webp') }}"
                                alt="{{ $kategori->nama }}"
                                loading="lazy" decoding="async"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                        </div>
                        <div class="mt-4 flex items-center justify-between gap-2">
                            <h3 class="text-sm font-bold text-[#2a2019] dark:text-white truncate group-hover:text-primary transition-colors">{{ $kategori->nama }}</h3>
                            <x-icon name="arrow_forward" class="w-4 h-4 shrink-0 text-[#2a2019]/40 dark:text-white/40 group-hover:text-primary group-hover:translate-x-0.5 transition-all" />
                        </div>
                        <p class="mt-1 text-xs text-[#8a7568] dark:text-white/45">{{ $kategori->products_count }} Products</p>
                    </a>
                @empty
                    <p class="col-span-full text-sm text-[#8a7568] dark:text-white/50">No categories yet.</p>
                @endforelse
            </div>
        </div>
    </section>

    <div class="max-w-[1440px] mx-auto px-4 lg:px-10 py-10 lg:py-14 space-y-10">

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
                @php $isFavorited = in_array($product->id, $favoriteProductIds ?? []); @endphp
                <article onclick="window.location='{{ route('product.detail', $product->slug ?? $product->id) }}'"
                    class="product-glass-card rounded-3xl p-4 group transition-all duration-300 hover:-translate-y-1 cursor-pointer">
                    <div class="product-media-shell relative aspect-square rounded-2xl overflow-hidden mb-4 md:mb-5">
                        <img src="{{ $product->foto ? asset('storage/' . $product->foto) : asset('assets/no_image.webp') }}" alt="{{ $product->nama }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" loading="lazy"/>

                        <span class="absolute top-3 left-3 bg-premium-gradient text-white text-[9px] md:text-[10px] font-black px-2.5 py-1 rounded-full uppercase tracking-tighter shadow-lg shadow-primary/40">Sale</span>

                        <form method="POST" action="{{ route('wishlist.toggle', $product->slug ?? $product->id) }}" class="absolute top-3 right-3">
                            @csrf
                            <button type="submit" onclick="event.stopPropagation()"
                                class="w-8 h-8 md:w-9 md:h-9 glass-morphism !bg-black/30 rounded-full flex items-center justify-center transition-all hover:scale-110 {{ $isFavorited ? 'text-red-500' : 'text-white/50 hover:text-primary' }}">
                                <x-icon name="favorite" :filled="$isFavorited" class="w-5 h-5" />
                            </button>
                        </form>
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
                        <img src="{{ asset('assets/profile.webp') }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                    </div>
                    <div class="flex justify-center gap-1 mb-4 text-primary">
                        <x-icon name="star" :filled="true" class="w-4 h-4 text-primary" />
                        <x-icon name="star" :filled="true" class="w-4 h-4 text-primary" />
                        <x-icon name="star" :filled="true" class="w-4 h-4 text-primary" />
                        <x-icon name="star" :filled="true" class="w-4 h-4 text-primary" />
                        <x-icon name="star" :filled="true" class="w-4 h-4 text-primary" />
                    </div>
                    <p class="text-sm text-[#6a5548] dark:text-white/70 italic mb-5">"{{ $item['quote'] }}"</p>
                    <h4 class="font-bold text-lg text-[#1b1c1b] dark:text-white">{{ $item['name'] }}</h4>
                    <p class="text-[10px] font-black uppercase tracking-[0.14em] text-[#8a7568] dark:text-white/40 mt-1">{{ $item['role'] }}</p>
                </article>
            @endforeach
        </div>
    </section>
    </div>
</main>
@endsection
