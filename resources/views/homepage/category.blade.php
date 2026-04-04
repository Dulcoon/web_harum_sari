@extends('layouts.homepage')

@section('title', 'Category Product - HOMELIVING')
@section('body_class', 'bg-grey-100')

@section('content')
<main>
    <section id="section3" class="kategori mb-60 px-6 lg:px-10">
        <div class="breadcrumb ml-5 pt-5">
            @include('components.breadcrumb')
        </div>

        <div class="text-center py-12">
            <p class="text-gray-500">Category Product</p>
            <h1 class="text-4xl font-bold">@if(isset($kategori)) {{ ucfirst($kategori) }} @endif</h1>
        </div>

        <div class="w-full">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
                @foreach ($products as $product)
                    <div class="text-center bg-[#f1f3f2] border border-primary/25 hover:border-primary/50 transition-colors flex flex-col items-center relative">
                        <div class="sale absolute left-5 top-5">
                            <p class="font-normal text-sm bg-white p-1 px-3 border rounded-full shadow-lg">Sale!</p>
                        </div>
                        <div class="gambar w-full h-full">
                            <img alt="" class="mx-auto object-cover h-52 w-auto rounded-t-lg" src="{{ asset('storage/' .$product->foto) }}" />
                        </div>
                        <div class="bg-[#f1f3f2] mt-4 w-full p-2 mb-4 rounded-b-lg">
                            <p class="font-normal text-xl">{{ $product->nama }}</p>
                            <p class="text-gray-500 text-sm">Rp. {{ number_format($product->harga) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mt-4 px-3">
            {{ $products->Links() }}
        </div>
    </section>
</main>
@endsection
