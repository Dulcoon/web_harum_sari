<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <!-- section 3 start -->
    <section id="section3" class="kategori mb-60 mx-16">
      <div class="breadcrumb ml-5 pt-5">
        @include('components.breadcrumb')
      </div>
      <div class="text-center py-12">
        <p class="text-gray-500">Category Product</p>
        <h1 class="text-4xl font-bold">@if(isset($kategori)) {{ ucfirst($kategori) }} @endif</h1>
      </div>
      <div class="container mx-auto px-8 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
          <!-- card -->
          @foreach ($products as $product)
          <div class="text-center bg-[#f1f3f2] border border-gray-300  flex flex-col items-center relative">
            <div class="sale absolute left-5 top-5">
              <p class="font-normal text-sm bg-white p-1 px-3 border rounded-full shadow-lg">Sale!</p>
            </div>
            <div class="gambar w-full h-full">
              <img alt="" class="mx-auto object-cover h-52 w-auto rounded-t-lg"
                src="{{ asset('storage/' .$product->foto) }}" />
            </div>
            <div class="bg-[#f1f3f2] mt-4 w-full p-2 mb-4 rounded-b-lg">
              <p class="font-normal text-xl">{{ $product->nama }}</p>
              <p class="text-gray-500 text-sm">Rp. {{ number_format($product->harga) }}</p>
            </div>
          </div>
          @endforeach


          <!-- card end -->
        </div>
      </div>

      <div class="mt-4 px-3">
        {{ $products->Links() }}
      </div>
    </section>
    <!-- section 3 end -->



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
</body>

</html>

