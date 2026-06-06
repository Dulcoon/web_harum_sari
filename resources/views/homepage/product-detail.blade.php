@extends('layouts.homepage')

@section('title', 'HOMELIVING - ' . $product->nama)
@section('body_class', 'bg-background-light dark:bg-background-dark font-sans text-charcoal dark:text-white transition-colors duration-300')

@php
    $productDescription = Str::limit(strip_tags($product->deskripsi ?? ''), 200);
    $productImage = $product->gambar ? asset('storage/' . $product->gambar) : null;
    $productSchema = json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'Product',
        'name' => $product->nama,
        'description' => Str::limit(strip_tags($product->deskripsi ?? ''), 160),
        'image' => $productImage,
    ]);
@endphp

@section('seo')
    <x-seo
        title="{{ $product->nama }} — HOMELIVING"
        description="{{ Str::limit(strip_tags($product->deskripsi ?? ''), 160) }}"
        url="{{ url()->current() }}"
        type="product"
        :image="$productImage"
        :schema="$productSchema"
    />
@endsection

@section('seo')
    <x-seo
        title="{{ $product->nama }} — HOMELIVING"
        description="{{ Str::limit(strip_tags($product->deskripsi ?? ''), 160) }}"
        url="{{ url()->current() }}"
        type="product"
        :image="$product->gambar ? asset('storage/' . $product->gambar) : null"
        :schema="json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'Product',
            'name' => $product->nama,
            'description' => Str::limit(strip_tags($product->deskripsi ?? ''), 200),
            'image' => $product->gambar ? asset('storage/' . $product->gambar) : null,
        ])"
    />
@endsection

@section('content')
<main class="relative z-10 max-w-[1440px] mx-auto px-4 lg:px-10 py-8 lg:py-10">
    <nav class="flex items-center gap-2 text-xs font-medium text-[#9a6c4c] dark:text-primary/70 mb-8 uppercase tracking-wider">
        <a class="hover:text-primary transition-colors" href="{{ route('homepage.home') }}">Home</a>
        <span class="material-symbols-outlined text-[14px]">chevron_right</span>
        <a class="hover:text-primary transition-colors" href="{{ route('homepage.product') }}">Products</a>
        <span class="material-symbols-outlined text-[14px]">chevron_right</span>
        <span class="text-charcoal dark:text-white font-bold">{{ $product->nama }}</span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20">
        <div class="space-y-4">
            <div class="rounded-2xl overflow-hidden border border-border-beige dark:border-white/10 shadow-sm relative group">
                <img class="w-full h-auto object-cover group-hover:scale-105 transition-transform duration-700"
                     alt="{{ $product->nama }}"
                     src="{{ asset('storage/' . $product->foto) }}"/>

                 <span class="absolute top-6 left-6 bg-charcoal text-white text-[10px] font-black px-3 py-1.5 rounded-full uppercase tracking-tighter shadow-lg">
                    In Stock
                </span>

                <form method="POST" action="{{ route('wishlist.toggle', $product->id) }}" class="absolute top-6 right-6">
                    @csrf
                    <button type="submit"
                        class="w-10 h-10 glass-morphism !bg-black/40 rounded-full flex items-center justify-center transition-all hover:scale-110 {{ $isFavorited ? 'text-red-500' : 'text-white/70 hover:text-primary' }}">
                        <span class="material-symbols-outlined text-xl {{ $isFavorited ? 'fill-1' : '' }}">favorite</span>
                    </button>
                </form>
            </div>
        </div>

        <div class="flex flex-col justify-center">
            <h1 class="text-4xl lg:text-5xl font-display font-black leading-tight mb-4">{{ $product->nama }}</h1>

            <div class="flex items-center gap-4 mb-8">
                <span class="text-3xl font-bold text-primary">Rp {{ number_format($product->harga, 0, ',', '.') }}</span>
                <div class="flex gap-1 text-primary text-sm">
                    <span class="material-symbols-outlined text-lg fill-1">star</span>
                    <span class="material-symbols-outlined text-lg fill-1">star</span>
                    <span class="material-symbols-outlined text-lg fill-1">star</span>
                    <span class="material-symbols-outlined text-lg fill-1">star</span>
                    <span class="material-symbols-outlined text-lg">star_half</span>
                </div>
                <span class="text-sm text-gray-500">(24 Reviews)</span>
            </div>

            <div class="prose dark:prose-invert text-gray-600 dark:text-gray-300 mb-10 leading-relaxed font-thin">
                <p>{{ $product->deskripsi }}</p>
            </div>

            <div class="space-y-4">
                <a href="https://wa.me/6287744083275?text=Hello, I would like to inquire about the product {{ $product->nama }}."
                   target="_blank"
                   class="flex w-full items-center justify-center gap-2 border-2 border-border-beige dark:border-white/10 hover:border-green-500 hover:text-green-600 text-gray-600 dark:text-gray-300 font-bold px-8 py-4 rounded-xl transition-all">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" class="w-5 h-5" alt="WhatsApp">
                    Ask Seller via WhatsApp
                </a>
            </div>

            <div class="mt-12 grid grid-cols-2 gap-6 pt-10 border-t border-border-beige dark:border-white/10">
                <div class="flex items-start gap-3">
                    <div class="w-10 h-10 rounded-full bg-warm-beige dark:bg-white/5 flex items-center justify-center text-primary shrink-0">
                        <span class="material-symbols-outlined text-xl">local_shipping</span>
                    </div>
                    <div>
                        <h5 class="font-bold text-sm mb-1">Fast Delivery</h5>
                        <p class="text-xs text-gray-500">2-3 business days</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <div class="w-10 h-10 rounded-full bg-warm-beige dark:bg-white/5 flex items-center justify-center text-primary shrink-0">
                        <span class="material-symbols-outlined text-xl">verified</span>
                    </div>
                    <div>
                        <h5 class="font-bold text-sm mb-1">Original Product</h5>
                        <p class="text-xs text-gray-500">100% Authentic</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
