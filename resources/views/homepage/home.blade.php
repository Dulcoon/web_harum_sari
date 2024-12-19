<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>Woodcraft Homeliving</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">


  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <style>
  body {
    font-family: "Oswald", sans-serif;
  }
  </style>
</head>

<body class="bg-grey-100">



<x-navbar />

  <main>

    <!-- is a hero section -->
    <section id="section1"
      class="flex flex-1 flex-col md:flex-row bg-gradient-to-b from-[#e2f8f6] to-[#ddf0ec] h-screen px-4 lg:px-24">
      <div class="flex-1 flex flex-col justify-center items-start">
        <h2 class="text-5xl font-bold mb-4">Stylish, Comfortable<br />and Affordable.</h2>
        <button class="px-6 py-3 bg-black text-white font-bold text-sm uppercase tracking-wider hover:bg-gray-800">Shop
          Now</button>
      </div>
      <div class="flex-1 flex justify-center items-center   ">
        <img alt="A collection of stylish and comfortable wooden furniture including chairs and tables"
          class="object-contain" height="600" src="{{ asset('assets/bg fix.png') }}" width="600" />
      </div>
    </section>
    <!-- hero section end-->





    <!-- section 2 start -->
    <section id="section2" class="kategori mb-16 pt-16 ">
      <div class="text-center py-12">
        <p class="text-gray-500">Shop by category</p>
        <h1 class="text-4xl font-bold">Shop by category</h1>
      </div>
      <div class="container mx-auto px-4 sm:px-6 lg:px-24">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
          <!-- card -->
          <div class="text-center bg-[#f1f3f2] border border-gray-300  flex flex-col items-center">
            <img alt="" class="mx-auto object-cover h-50 w-full rounded-t-lg"
              src="{{ asset('assets/bedroom/Natural Rattan Bedroom  ( Queen Bed ).png') }}" />
            <div class="bg-white mt-4 w-full p-2 rounded-b-lg">
              <p class="font-bold">BEDROOM</p>
              <p class="text-gray-500">6 PRODUCTS</p>
            </div>
          </div>
          <!-- Duplicate cards to test layout -->
          <div class="text-center bg-[#f1f3f2] border border-gray-300  flex flex-col items-center">
            <img alt="" class="mx-auto object-cover h-50 w-full rounded-t-lg"
              src="{{ asset('assets/bedroom/Natural Rattan Bedroom  ( Queen Bed ).png') }}" />
            <div class="bg-white mt-4 w-full p-2 rounded-b-lg">
              <p class="font-bold">BEDROOM</p>
              <p class="text-gray-500">6 PRODUCTS</p>
            </div>
          </div>
          <div class="text-center bg-[#f1f3f2] border border-gray-300  flex flex-col items-center">
            <img alt="" class="mx-auto object-cover h-50 w-full rounded-t-lg"
              src="{{ asset('assets/bedroom/Natural Rattan Bedroom  ( Queen Bed ).png') }}" />
            <div class="bg-white mt-4 w-full p-2 rounded-b-lg">
              <p class="font-bold">BEDROOM</p>
              <p class="text-gray-500">6 PRODUCTS</p>
            </div>
          </div>
          <div class="text-center bg-[#f1f3f2] border border-gray-300  flex flex-col items-center">
            <img alt="" class="mx-auto object-cover h-50 w-full rounded-t-lg"
              src="{{ asset('assets/bedroom/Natural Rattan Bedroom  ( Queen Bed ).png') }}" />
            <div class="bg-white mt-4 w-full p-2 rounded-b-lg">
              <p class="font-bold">BEDROOM</p>
              <p class="text-gray-500">6 PRODUCTS</p>
            </div>
          </div>
          <div class="text-center bg-[#f1f3f2] border border-gray-300  flex flex-col items-center">
            <img alt="" class="mx-auto object-cover h-50 w-full rounded-t-lg"
              src="{{ asset('assets/bedroom/Natural Rattan Bedroom  ( Queen Bed ).png') }}" />
            <div class="bg-white mt-4 w-full p-2 rounded-b-lg">
              <p class="font-bold">BEDROOM</p>
              <p class="text-gray-500">6 PRODUCTS</p>
            </div>
          </div>
          <!-- card end -->
        </div>
      </div>
    </section>
    <!-- section 2 end -->








    <!-- section 3 start -->
    <section id="section3" class="kategori mb-60 pt-16">
      <div class="text-center py-12">
        <p class="text-gray-500">Featured Products</p>
        <h1 class="text-4xl font-bold">Featured Products</h1>
      </div>
      <div class="container mx-auto px-4 sm:px-6 lg:px-24">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6">
          <!-- card -->
          <div class="text-center bg-[#f1f3f2] border border-gray-300  flex flex-col items-center relative">
            <div class="sale absolute left-5 top-5">
              <p class="font-normal text-sm bg-white p-1 px-3 border rounded-full shadow-lg">Sale!</p>
            </div>
            <img alt="" class="mx-auto object-cover h-50 w-full rounded-t-lg"
              src="{{ asset('assets/bedroom/Natural Rattan Bedroom  ( Queen Bed ).png') }}" />
            <div class="bg-[#f1f3f2] mt-4 w-full p-2 mb-4 rounded-b-lg">
              <p class="font-normal text-xl">Natural Rattan Bedroom</p>
              <p class="text-gray-500 text-sm">Rp. 600.000</p>
            </div>
          </div>
          <div class="text-center bg-[#f1f3f2] border border-gray-300  flex flex-col items-center relative">
            <div class="sale absolute left-5 top-5">
              <p class="font-normal text-sm bg-white p-1 px-3 border rounded-full shadow-lg">Sale!</p>
            </div>
            <img alt="" class="mx-auto object-cover h-50 w-full rounded-t-lg"
              src="{{ asset('assets/bedroom/Natural Rattan Bedroom  ( Queen Bed ).png') }}" />
            <div class="bg-[#f1f3f2] mt-4 w-full p-2 mb-4 rounded-b-lg">
              <p class="font-normal text-xl">Natural Rattan Bedroom</p>
              <p class="text-gray-500 text-sm">Rp. 600.000</p>
            </div>
          </div>
          <div class="text-center bg-[#f1f3f2] border border-gray-300  flex flex-col items-center relative">
            <div class="sale absolute left-5 top-5">
              <p class="font-normal text-sm bg-white p-1 px-3 border rounded-full shadow-lg">Sale!</p>
            </div>
            <img alt="" class="mx-auto object-cover h-50 w-full rounded-t-lg"
              src="{{ asset('assets/bedroom/Natural Rattan Bedroom  ( Queen Bed ).png') }}" />
            <div class="bg-[#f1f3f2] mt-4 w-full p-2 mb-4 rounded-b-lg">
              <p class="font-normal text-xl">Natural Rattan Bedroom</p>
              <p class="text-gray-500 text-sm">Rp. 600.000</p>
            </div>
          </div>
          <div class="text-center bg-[#f1f3f2] border border-gray-300  flex flex-col items-center relative">
            <div class="sale absolute left-5 top-5">
              <p class="font-normal text-sm bg-white p-1 px-3 border rounded-full shadow-lg">Sale!</p>
            </div>
            <img alt="" class="mx-auto object-cover h-50 w-full rounded-t-lg"
              src="{{ asset('assets/bedroom/Natural Rattan Bedroom  ( Queen Bed ).png') }}" />
            <div class="bg-[#f1f3f2] mt-4 w-full p-2 mb-4 rounded-b-lg">
              <p class="font-normal text-xl">Natural Rattan Bedroom</p>
              <p class="text-gray-500 text-sm">Rp. 600.000</p>
            </div>
          </div>
          <div class="text-center bg-[#f1f3f2] border border-gray-300  flex flex-col items-center relative">
            <div class="sale absolute left-5 top-5">
              <p class="font-normal text-sm bg-white p-1 px-3 border rounded-full shadow-lg">Sale!</p>
            </div>
            <img alt="" class="mx-auto object-cover h-50 w-full rounded-t-lg"
              src="{{ asset('assets/bedroom/Natural Rattan Bedroom  ( Queen Bed ).png') }}" />
            <div class="bg-[#f1f3f2] mt-4 w-full p-2 mb-4 rounded-b-lg">
              <p class="font-normal text-xl">Natural Rattan Bedroom</p>
              <p class="text-gray-500 text-sm">Rp. 600.000</p>
            </div>
          </div>
          <div class="text-center bg-[#f1f3f2] border border-gray-300  flex flex-col items-center relative">
            <div class="sale absolute left-5 top-5">
              <p class="font-normal text-sm bg-white p-1 px-3 border rounded-full shadow-lg">Sale!</p>
            </div>
            <img alt="" class="mx-auto object-cover h-50 w-full rounded-t-lg"
              src="{{ asset('assets/bedroom/Natural Rattan Bedroom  ( Queen Bed ).png') }}" />
            <div class="bg-[#f1f3f2] mt-4 w-full p-2 mb-4 rounded-b-lg">
              <p class="font-normal text-xl">Natural Rattan Bedroom</p>
              <p class="text-gray-500 text-sm">Rp. 600.000</p>
            </div>
          </div>

          <!-- card end -->
        </div>
      </div>
    </section>
    <!-- section 3 end -->









    <!-- Section 4 -->

    <section id="section4" class="container mx-auto px-4 py-40 sm:px-6 lg:px-8 bg-[#e2f8f6] mb-20">
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6 px-4 lg:px-20">
        <!-- card -->
        <div class="text-center bg-white border border-gray-300 rounded-b-2xl relative py-10">
          <div
            class="image bg-[#e2f8f6] w-24 h-24 rounded-full absolute top-[-45px] left-1/2 transform -translate-x-1/2 flex items-center justify-center">
            <img class="rounded-full w-4/5 h-4/5" src="{{ asset('assets/foto 1.jpg') }}" alt="">
          </div>
          <div class="mt-4 w-full p-2 ">
            <p class="font-bold text-2xl">John Leban</p>
            <p class="font-light text-slate-400 ">General Manager</p>
            <p class="text-sm font-normal mt-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium
              maxime
              iste
              cum! Delectus maiores debitis dolores, aliquid consectetur quia officia.</p>
          </div>

          <div class="star mt-1 flex justify-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#fcca2d" class="size-6">
              <path fill-rule="evenodd"
                d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                clip-rule="evenodd" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#fcca2d" class="size-6">
              <path fill-rule="evenodd"
                d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                clip-rule="evenodd" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#fcca2d" class="size-6">
              <path fill-rule="evenodd"
                d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                clip-rule="evenodd" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#fcca2d" class="size-6">
              <path fill-rule="evenodd"
                d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                clip-rule="evenodd" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#fcca2d" class="size-6">
              <path fill-rule="evenodd"
                d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                clip-rule="evenodd" />
            </svg>

          </div>
        </div>
        <div class="text-center bg-white border border-gray-300 rounded-b-2xl relative py-10">
          <div
            class="image bg-[#e2f8f6] w-24 h-24 rounded-full absolute top-[-45px] left-1/2 transform -translate-x-1/2 flex items-center justify-center">
            <img class="rounded-full w-4/5 h-4/5" src="{{ asset('assets/foto 1.jpg') }}" alt="">
          </div>
          <div class="mt-4 w-full p-2 ">
            <p class="font-bold text-2xl">John Leban</p>
            <p class="font-light text-slate-400 ">General Manager</p>
            <p class="text-sm font-normal mt-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium
              maxime
              iste
              cum! Delectus maiores debitis dolores, aliquid consectetur quia officia.</p>
          </div>

          <div class="star mt-1 flex justify-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#fcca2d" class="size-6">
              <path fill-rule="evenodd"
                d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                clip-rule="evenodd" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#fcca2d" class="size-6">
              <path fill-rule="evenodd"
                d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                clip-rule="evenodd" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#fcca2d" class="size-6">
              <path fill-rule="evenodd"
                d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                clip-rule="evenodd" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#fcca2d" class="size-6">
              <path fill-rule="evenodd"
                d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                clip-rule="evenodd" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#fcca2d" class="size-6">
              <path fill-rule="evenodd"
                d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                clip-rule="evenodd" />
            </svg>

          </div>
        </div>
        <div class="text-center bg-white border border-gray-300 rounded-b-3xl relative py-10">
          <div
            class="image bg-[#e2f8f6] w-24 h-24 rounded-full absolute top-[-45px] left-1/2 transform -translate-x-1/2 flex items-center justify-center">
            <img class="rounded-full w-4/5 h-4/5" src="{{ asset('assets/foto 1.jpg') }}" alt="">
          </div>
          <div class="mt-4 w-full p-2 ">
            <p class="font-bold text-2xl">John Leban</p>
            <p class="font-light text-slate-400 ">General Manager</p>
            <p class="text-sm font-normal mt-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium
              maxime
              iste
              cum! Delectus maiores debitis dolores, aliquid consectetur quia officia.</p>
          </div>

          <div class="star mt-1 flex justify-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#fcca2d" class="size-6">
              <path fill-rule="evenodd"
                d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                clip-rule="evenodd" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#fcca2d" class="size-6">
              <path fill-rule="evenodd"
                d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                clip-rule="evenodd" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#fcca2d" class="size-6">
              <path fill-rule="evenodd"
                d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                clip-rule="evenodd" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#fcca2d" class="size-6">
              <path fill-rule="evenodd"
                d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                clip-rule="evenodd" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#fcca2d" class="size-6">
              <path fill-rule="evenodd"
                d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                clip-rule="evenodd" />
            </svg>

          </div>
        </div>




        <!-- card end -->
      </div>
    </section>

    <!-- Section 4 end -->


    <!-- section 5 -->

    <section id="section5" class="kategori mb-16 pt-20">
      <div class="text-center py-5">
        <p class="text-gray-500">Why Choose Us</p>
        <h1 class="text-4xl font-bold">Why Choose Us</h1>
      </div>
      <div class="container mx-auto px-4 sm:px-6 lg:px-52">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
          <!-- card -->
          <div class="text-center  flex flex-col items-center">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#D6B390" class="size-6">
              <path
                d="M3.375 4.5C2.339 4.5 1.5 5.34 1.5 6.375V13.5h12V6.375c0-1.036-.84-1.875-1.875-1.875h-8.25ZM13.5 15h-12v2.625c0 1.035.84 1.875 1.875 1.875h.375a3 3 0 1 1 6 0h3a.75.75 0 0 0 .75-.75V15Z" />
              <path
                d="M8.25 19.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0ZM15.75 6.75a.75.75 0 0 0-.75.75v11.25c0 .087.015.17.042.248a3 3 0 0 1 5.958.464c.853-.175 1.522-.935 1.464-1.883a18.659 18.659 0 0 0-3.732-10.104 1.837 1.837 0 0 0-1.47-.725H15.75Z" />
              <path d="M19.5 19.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0Z" />
            </svg>
            <p class="text-lg">Fast Delivery</p>
            <p class="text-gray-500 text-sm">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus,
              luctus
              nec.</p>
          </div>
          <div class="text-center  flex flex-col items-center">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#D6B390" class="size-6">
              <path
                d="M2.273 5.625A4.483 4.483 0 0 1 5.25 4.5h13.5c1.141 0 2.183.425 2.977 1.125A3 3 0 0 0 18.75 3H5.25a3 3 0 0 0-2.977 2.625ZM2.273 8.625A4.483 4.483 0 0 1 5.25 7.5h13.5c1.141 0 2.183.425 2.977 1.125A3 3 0 0 0 18.75 6H5.25a3 3 0 0 0-2.977 2.625ZM5.25 9a3 3 0 0 0-3 3v6a3 3 0 0 0 3 3h13.5a3 3 0 0 0 3-3v-6a3 3 0 0 0-3-3H15a.75.75 0 0 0-.75.75 2.25 2.25 0 0 1-4.5 0A.75.75 0 0 0 9 9H5.25Z" />
            </svg>

            <p class="text-lg">Free Shipping</p>
            <p class="text-gray-500 text-sm">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus,
              luctus
              nec.</p>
          </div>
          <div class="text-center  flex flex-col items-center">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#D6B390" class="size-6">
              <path fill-rule="evenodd"
                d="M12.516 2.17a.75.75 0 0 0-1.032 0 11.209 11.209 0 0 1-7.877 3.08.75.75 0 0 0-.722.515A12.74 12.74 0 0 0 2.25 9.75c0 5.942 4.064 10.933 9.563 12.348a.749.749 0 0 0 .374 0c5.499-1.415 9.563-6.406 9.563-12.348 0-1.39-.223-2.73-.635-3.985a.75.75 0 0 0-.722-.516l-.143.001c-2.996 0-5.717-1.17-7.734-3.08Zm3.094 8.016a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z"
                clip-rule="evenodd" />
            </svg>

            <p class="text-lg">Secure Checkout</p>
            <p class="text-gray-500 text-sm">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus,
              luctus
              nec.</p>
          </div>
          <div class="text-center  flex flex-col items-center">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#D6B390" class="size-6">
              <path
                d="M9.195 18.44c1.25.714 2.805-.189 2.805-1.629v-2.34l6.945 3.968c1.25.715 2.805-.188 2.805-1.628V8.69c0-1.44-1.555-2.343-2.805-1.628L12 11.029v-2.34c0-1.44-1.555-2.343-2.805-1.628l-7.108 4.061c-1.26.72-1.26 2.536 0 3.256l7.108 4.061Z" />
            </svg>

            <p class="text-lg">Easy Returns</p>
            <p class="text-gray-500 text-sm">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus,
              luctus
              nec.</p>
          </div>
          <!-- Duplicate cards to test layout -->

          <!-- card end -->
        </div>
      </div>
    </section>
    <!-- section 5 end -->


    <!-- Footer -->
    <div class="footer bg-[#f1f3f2] mt-56">
      <div class="container py-20 grid grid-cols-1 gap-44 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3">
        <div class="text-center">
          <h1 class="text-xl font-bold">PT. HARUM SARI</h1>
          <p class="text-sm">WOODCRAFT HOMELIVING</p>
        </div>
        <div class="text-center">
          <h1 class="text-xl font-bold">Categories</h1>
          <div class="mt-5">
            <a class="block" href="">Bedroom</a>
            <a class="block" href="">Livingroom</a>
            <a class="block" href="">Homewares</a>
            <a class="block" href="">Kids Furniture</a>
          </div>
        </div>
        <div class="text-center">
          <h1 class="text-xl font-bold">PT. HARUM SARI</h1>
          <p class="text-sm">WOODCRAFT HOMELIVING</p>
        </div>
      </div>
      <p class="text-center pb-8">&copy; 2024 Copyright: homeliving.co.id </p>
    </div>
    <!-- Footer end -->





  </main>


  <script>
  document.getElementById('menu-btn').addEventListener('click', function() {
    var menu = document.getElementById('mobile-menu');
    if (menu.classList.contains('hidden')) {
      menu.classList.remove('hidden');
    } else {
      menu.classList.add('hidden');
    }
  });
  </script>


  <script>
  // Select navbar and target section
  const navbar = document.getElementById('navbar');
  const mobile = document.getElementById('mobile-menu');
  const targetSection = document.getElementById("section2"); // Ganti sesuai section yang diinginkan

  // Function to change navbar color
  function changeNavbarColor() {
    const sectionTop = targetSection.offsetTop; // Jarak section dari atas halaman
    const scrollPosition = window.scrollY + navbar.offsetHeight; // Posisi scroll saat ini

    // Cek apakah posisi scroll telah melewati atau mencapai bagian atas section
    if (scrollPosition >= sectionTop) {
      navbar.style.backgroundColor = "#ffffff"; // Warna saat section dicapai
      mobile.style.backgroundColor = "#ffffff"; // Warna saat section dicapai
    } else {
      navbar.style.backgroundColor = "#e2f8f6"; // Warna asli navbar
      mobile.style.backgroundColor = "#e2f8f6"; // Warna asli navbar
    }
  }

  // Event listener for scrolling
  window.addEventListener("scroll", changeNavbarColor);
  </script>



</body>

</html>


