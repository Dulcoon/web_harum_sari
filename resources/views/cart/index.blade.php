<html lang="en">

<head>
 <meta charset="utf-8" />
 <meta name="base-url" content="{{ url('/') }}">

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
  <div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Your Cart</h1>

    @if(empty($cartItems) || count($cartItems) == 0)
      <p>Your cart is empty.</p>
    @else
     <div class="space-y-4">
    @php
   $totalPrice = 0; // Inisialisasi total harga
    @endphp

    @foreach($cartItems as $item)
     <div class="flex items-center justify-between p-4 bg-white shadow rounded">
    <div class="flex items-center">
      @php
   // Cari produk berdasarkan product_id
   $product = null;
   foreach ($products as $prod) {
    if ($prod->id == $item['product_id']) {
     $product = $prod;
     break;
    }
   }
      @endphp

      @if($product)
     <img src="{{ asset('storage/' . $product->foto) }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover mr-4">
     <div>
    <h2 class="text-lg font-bold">{{ $product->nama }}</h2>
    <p class="text-gray-500">Quantity: {{ $item['quantity'] }}</p>
    <p class="text-gray-700">Price: Rp{{ number_format($product->harga, 0, ',', '.') }}</p>

    @php
    // Menambahkan harga produk ke total harga (harga * quantity)
    $totalPrice += $product->harga * $item['quantity'];
    @endphp
     </div>
      @else
     <p>Product tidak ditemukan</p>
     <p>Product tidak ditemukan</p>
     <p>Product tidak ditemukan</p>
      @endif
    </div>
    <div>
    <form method="POST" action="{{ route('cart.remove') }}">
  @csrf
  @method('DELETE') 
  <input type="hidden" name="product_id" value="{{ $item['product_id'] }}"> 
  <button class="text-red-500 hover:text-red-700">Remove</button>
</form>


    </div>
     </div>
 @endforeach
     </div>

     <!-- Total Price Section -->
     <div class="mt-6 p-4 bg-gray-100 rounded">
    <h3 class="text-lg font-bold">Total: Rp{{ number_format($totalPrice, 0, ',', '.') }}</h3>
     </div>

     <div class="mt-6">
    <button class="bg-blue-500 text-white py-2 px-4 rounded">Checkout</button>
     </div>
 @endif
  </div>

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

















