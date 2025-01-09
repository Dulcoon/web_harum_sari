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
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
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
            $totalPrice = 0;
          @endphp

          @foreach($cartItems as $item)
          @php
              $product = null;
              foreach ($products as $prod) {
                  if ($prod['id'] == $item['product_id']) {
                      $product = $prod;
                      break;
                  }
              }
          @endphp


            @if($product)
              <div class="flex items-center justify-between p-4 bg-white shadow rounded">
                <div class="flex items-center">
                  <img src="{{ asset('storage/' . $product->foto) }}" alt="{{ $product->nama }}" class="w-[220] h-[220] object-cover mr-4">
                  <div>
                    <h2 class="text-lg font-bold">{{ $product->nama }}</h2>
                    <p class="text-gray-500">Quantity: 
                    <div class="flex gap-5 items-center">
                      <button class="text-[50px] text-blue-500" onclick="updateQuantity({{ $product->id }}, 'decrease')">-</button>
                      <span id="qty-{{ $product->id }}">{{ $item['quantity'] }}</span>
                      <button class="text-[50px] text-blue-500" onclick="updateQuantity({{ $product->id }}, 'increase')">+</button>
                    </div>
                    </p>
                    <!-- Bagian harga mentah di template -->
                    <p class="text-gray-700">Price: Rp 
                      <span id="price-{{ $product->id }}" data-price="{{ $product->harga }}">{{ number_format($product->harga, 0, ',', '.') }}</span>
                    </p>


                  </div>
                </div>

                <div>
                  <form method="POST" action="{{ route('cart.remove') }}">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button class="text-red-500 hover:text-red-700">Remove</button>
                  </form>
                </div>
              </div>

              @php
                if (is_numeric($product->harga) && is_numeric($item['quantity'])) {
                  $totalPrice += $product->harga * $item['quantity'];
                }
              @endphp
            @else
              <p>Product not found</p>
            @endif
          @endforeach

          <!-- Total Price Section -->
          <div class="mt-6 p-4 bg-gray-100 rounded">
            <p class="text-gray-700">Total: Rp <span id="total-overall">{{ number_format($totalPrice, 0, ',', '.') }}</span></p>
          </div>

          <div class="mt-6">
          <a href="{{ route('checkout', $transaction->id ?? 1) }}" class="bg-blue-500 text-white py-2 px-4 rounded">Checkout</a>
          </div>
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
      <p class="text-center pb-8">&copy; 2024 Copyright: homeliving.co.id</p>
    </div>
    <!-- Footer end -->
  </main>

  <script>
function updateQuantity(productId, action) {
    const qtyElement = document.getElementById('qty-' + productId);
    const priceElement = document.getElementById('price-' + productId);
    const totalOverallElement = document.getElementById('total-overall');

    if (!qtyElement || !priceElement) {
        console.error('One or more required elements are missing!');
        return;
    }

    // Mengambil kuantitas dan pastikan valid
    let qty = parseInt(qtyElement.textContent.trim(), 10);  // Menggunakan textContent untuk konsistensi
    if (isNaN(qty)) {
        console.error('Invalid quantity value:', qtyElement.textContent);
        return;
    }

    // Mengambil harga mentah dari atribut data-price dan pastikan valid
    let price = parseFloat(priceElement.getAttribute('data-price'));  // Ambil harga mentah dari atribut data-price

    if (isNaN(price)) {
        console.error('Invalid price value:', price);
        return;
    }

    // Update kuantitas berdasarkan aksi
    if (action === 'increase') {
        qty += 1;
    } else if (action === 'decrease' && qty > 1) {
        qty -= 1;
    }

    // Pastikan kuantitas tetap valid dan tidak kurang dari 1
    qty = Math.max(qty, 1);

    // Update kuantitas pada halaman
    qtyElement.textContent = qty;  // Menggunakan textContent agar nilai lebih konsisten

    // Update harga per item berdasarkan kuantitas
    const newPrice = price * qty;
    priceElement.textContent = new Intl.NumberFormat().format(newPrice); // Menampilkan harga yang terformat dengan benar

    // Kirim update kuantitas ke server
    axios.post('{{ route('cart.update') }}', {
        product_id: productId,
        quantity: qty,
        _token: '{{ csrf_token() }}'
    })
    .then(response => {
        // Setelah update di server, kita ambil harga total keseluruhan
        updateTotalPrice();  // Update total harga keseluruhan setelah update kuantitas
    })
    .catch(error => {
        console.error('Error updating quantity:', error);
    });
}

// Fungsi untuk menghitung total keseluruhan
function updateTotalPrice() {
    const totalOverallElement = document.getElementById('total-overall');
    let totalPrice = 0;

    // Loop untuk menghitung total keseluruhan dari semua item di keranjang
    document.querySelectorAll('[id^="price-"]').forEach((item) => {
        // Ambil ID produk dari elemen harga untuk memastikan kita mendapatkan kuantitas yang sesuai
        const productId = item.id.replace('price-', '');  // Ambil ID produk dari price- ID elemen

        // Ambil kuantitas dari elemen dengan ID yang sesuai
        const qtyElement = document.getElementById('qty-' + productId);  // Ambil kuantitas berdasarkan ID produk
        const price = parseFloat(item.getAttribute('data-price'));  // Ambil harga dari data-price

        // Pastikan harga dan kuantitas valid
        if (!isNaN(price) && qtyElement) {
            const qty = parseInt(qtyElement.textContent.trim(), 10);  // Ambil kuantitas dari qty element
            if (!isNaN(qty)) {
                totalPrice += price * qty;  // Tambahkan harga item ke total
            }
        }
    });

    // Update total keseluruhan
    if (totalOverallElement) {
        totalOverallElement.textContent = new Intl.NumberFormat().format(totalPrice);  // Menampilkan total keseluruhan dengan format yang benar
    }
}

  </script>

  

</body>
</html>
