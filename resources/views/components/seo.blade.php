@props([
    'title' => 'HOMELIVING',
    'description' => 'Curated Scandinavian furniture designed for comfort, longevity, and timeless aesthetic appeal. Explore our collection of modern living essentials.',
    'image' => null,
    'url' => null,
    'type' => 'website',
    'canonical' => null,
    'schema' => null,
])

@php
    $siteUrl = config('app.url', 'http://localhost:8000');
    $pageUrl = $url ?? url()->current();
    $canonicalUrl = $canonical ?? $pageUrl;
    $ogImage = $image ?? asset('assets/og-default.png');
    $siteName = 'HOMELIVING';
@endphp

<meta name="description" content="{{ $description }}">

<link rel="canonical" href="{{ $canonicalUrl }}">

<meta property="og:site_name" content="{{ $siteName }}">
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:url" content="{{ $pageUrl }}">
<meta property="og:type" content="{{ $type }}">
<meta property="og:image" content="{{ $ogImage }}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $title }}">
<meta name="twitter:description" content="{{ $description }}">
<meta name="twitter:image" content="{{ $ogImage }}">

@if ($schema)
    <script type="application/ld+json">{!! $schema !!}</script>
@endif
