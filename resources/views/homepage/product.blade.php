@extends('layouts.homepage')

@section('title', 'HOMELIVING | Premium Product Listing')

@section('seo')
    <x-seo
        title="HOMELIVING | Premium Product Listing"
        description="Browse our curated collection of Scandinavian furniture and home decor. Find timeless pieces for every room in your home."
        url="{{ url()->current() }}"
        type="website"
    />
@endsection

@section('content')
    <livewire:homepage.product-listing />
@endsection
