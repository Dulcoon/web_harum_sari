@extends('layouts.homepage')

@section('title', 'My Wishlist - HOMELIVING')

@section('seo')
    <x-seo
        title="My Wishlist — HOMELIVING"
        description="View your saved collections and favorite products on HOMELIVING."
        url="{{ url()->current() }}"
        type="website"
    />
@endsection

@section('content')
<main class="w-full px-4 lg:px-10 py-8 lg:py-16 relative z-10">
    {{-- Header --}}
    <div class="max-w-7xl mx-auto mb-10">
        <div class="flex items-center gap-3 mb-2">
            <div class="h-10 w-10 rounded-2xl bg-premium-gradient flex items-center justify-center shadow-lg shadow-primary/30">
                <span class="material-symbols-outlined text-white text-lg">favorite</span>
            </div>
            <div>
                <h1 class="text-3xl md:text-4xl font-black tracking-tight">My Wishlist</h1>
                <p class="text-sm text-[#6a5548] dark:text-white/60 mt-0.5">Products you love, saved for later.</p>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto">
        @forelse($favorites as $product)
            <div class="group relative flex items-center gap-5 p-5 mb-4 rounded-2xl glass-morphism transition-all duration-300 hover:border-primary/30 cursor-pointer"
                 onclick="window.location='{{ route('product.detail', $product->slug ?? $product->id) }}'">

                {{-- Image --}}
                <div class="w-24 h-24 md:w-28 md:h-28 shrink-0 rounded-xl overflow-hidden bg-white/10">
                    <img src="{{ $product->foto ? asset('storage/' . $product->foto) : asset('assets/no_image.webp') }}"
                         alt="{{ $product->nama }}"
                         class="w-full h-full object-cover" loading="lazy">
                </div>

                {{-- Details --}}
                <div class="flex-1 min-w-0">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-[#8a7568] dark:text-white/40">Premium</span>
                    <h3 class="text-lg md:text-xl font-bold truncate mt-0.5">{{ $product->nama }}</h3>
                    <p class="text-lg font-black premium-text-gradient mt-1">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                </div>

                {{-- Remove from wishlist --}}
                <form method="POST" action="{{ route('wishlist.toggle', $product->slug ?? $product->id) }}" class="shrink-0">
                    @csrf
                    <button type="submit"
                        class="flex items-center justify-center w-10 h-10 rounded-xl bg-red-50 dark:bg-red-500/10 text-red-500 hover:bg-red-100 dark:hover:bg-red-500/20 transition-all"
                        onclick="event.stopPropagation()"
                        aria-label="Remove from wishlist">
                        <span class="material-symbols-outlined text-lg fill-1">favorite</span>
                    </button>
                </form>

                {{-- Arrow --}}
                <span class="material-symbols-outlined text-[#8a7568] dark:text-white/30 shrink-0 hidden md:block">chevron_right</span>
            </div>
        @empty
            <div class="text-center py-20">
                <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-white/5 mb-6">
                    <span class="material-symbols-outlined text-4xl text-[#6a5548] dark:text-white/30">favorite_border</span>
                </div>
                <h3 class="text-2xl font-bold mb-2">Your wishlist is empty</h3>
                <p class="text-[#6a5548] dark:text-white/60 mb-6">Save your favorite products here by tapping the heart icon.</p>
                <a href="{{ route('homepage.product') }}"
                    class="inline-flex items-center gap-2 bg-premium-gradient text-white font-bold px-8 py-4 rounded-2xl shadow-lg shadow-primary/30 hover:scale-105 transition-all">
                    <span class="material-symbols-outlined text-lg">explore</span>
                    Explore Products
                </a>
            </div>
        @endforelse

        {{-- Pagination --}}
        @if($favorites->hasPages())
            <div class="mt-10">
                {{ $favorites->links() }}
            </div>
        @endif
    </div>
</main>
@endsection
