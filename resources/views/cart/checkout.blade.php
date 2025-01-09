<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>Checkout - Woodcraft Homeliving</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
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

<body class="bg-gray-100">
  <x-navbar />

  <main>
    <div class="container mx-auto p-6">
      <h1 class="text-2xl font-bold mb-4">Checkout</h1>

      <form action="{{ route('checkout') }}" method="POST" id="checkout-form">
        @csrf
        <div class="space-y-6">
          <!-- Shipping Address -->
          <div class="bg-white p-6 rounded shadow-md">
            <h2 class="text-lg font-bold mb-4">Shipping Address</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
              <div>
                <label for="name" class="block text-gray-700">Full Name</label>
                <input type="text" name="name" id="name" class="w-full p-3 border rounded" required>
              </div>
              <div>
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" name="email" id="email" class="w-full p-3 border rounded" required>
              </div>
              <div>
                <label for="phone" class="block text-gray-700">Phone Number</label>
                <input type="text" name="phone" id="phone" class="w-full p-3 border rounded" required>
              </div>
              <div>
                <label for="address" class="block text-gray-700">Address</label>
                <textarea name="address" id="address" class="w-full p-3 border rounded" rows="4" required></textarea>
              </div>
            </div>
          </div>

          <!-- Order Summary -->
          <div class="bg-white p-6 rounded shadow-md">
            <h2 class="text-lg font-bold mb-4">Order Summary</h2>
            <div id="order-summary">
              <!-- Product items will be dynamically loaded here -->
            </div>
            <div class="mt-4">
              <p class="font-bold">Total: Rp <span id="total-price">0</span></p>
            </div>
          </div>

          <!-- Payment Section -->
          <div class="bg-white p-6 rounded shadow-md">
            <h2 class="text-lg font-bold mb-4">Payment</h2>
            <div class="flex justify-end">
              <button type="button" class="bg-blue-500 text-white py-2 px-4 rounded" onclick="payWithMidtrans()">Pay Now</button>
            </div>
          </div>
        </div>
      </form>
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
  </main>



  <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

  <script>


  </script>

  <script>
    function loadOrderSummary() {
      let orderSummary = document.getElementById('order-summary');
      let totalPrice = 0;
      const cartItems = @json($cartItems); 

      orderSummary.innerHTML = '';  

      cartItems.forEach(item => {
        const product = item.product;  
        const quantity = item.quantity;
        const price = product.harga;

        const itemRow = document.createElement('div');
        itemRow.classList.add('flex', 'justify-between', 'mb-4');
        itemRow.innerHTML = `
          <span>${product.nama} (x${quantity})</span>
          <span>Rp ${new Intl.NumberFormat().format(price * quantity)}</span>
        `;
        orderSummary.appendChild(itemRow);
        totalPrice += price * quantity;  
      });
      document.getElementById('total-price').textContent = new Intl.NumberFormat().format(totalPrice);
    }

    loadOrderSummary();

    function payWithMidtrans() {
     axios.post('{{ route('checkout.createSnapToken') }}', {
       total_price: document.getElementById('total-price').textContent.replace(/[^0-9]/g, ''),
       products: cartItems, 
       _token: '{{ csrf_token() }}', 
     })
     .then(response => {
       const snapToken = response.data.snap_token;

       window.snap.pay(snapToken, {
         onSuccess: function(result) {
           alert("Payment Success!");
           window.location.href = "{{ route('checkout.success') }}";
         },
         onPending: function(result) {
           alert("Payment Pending!");
           window.location.href = "{{ route('checkout.pending') }}";
         },
         onError: function(result) {
           alert("Payment Error!");
         }
       });
     })
     .catch(error => {
       console.error('Error:', error);
       alert('Failed to initiate payment.');
     });
   }
  </script>

</body>
</html>
