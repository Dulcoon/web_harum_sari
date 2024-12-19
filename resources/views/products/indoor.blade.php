<x-app-layout>

  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

    @if (session()->has('success'))
    <x-alert message="{{ session('success') }}" />
    @endif

    <div class="flex justify-between px-3">
      <h2 class="font-semibold text-2xl">List Products > Indoor</h2>

      <a href="{{route('products.create')}}">

        <button class="flex px-3 py-3 bg-blue-500 font-semibold text-white"><svg class="mx-2"
            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ffffff"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="12" y1="5" x2="12" y2="19"></line>
            <line x1="5" y1="12" x2="19" y2="12"></line>
          </svg>Tambah Produk</button>

      </a>
    </div>

    <div class="grid md:grid-cols-3 grid-cols-1 gap-3 mt-6 px-3">
      @foreach ($products as $product)
      <div class="border-2 border-dashed border-blue-200">
        <img src="{{ url('storage/' .$product->foto) }}" class="h-96 w-full object-cover" alt="">
        <div class="text-center">
          <p>{{ $product->nama }}</p>
          <p>Rp. {{ number_format($product->harga) }}</p>
        </div>

        <div class="flex justify-center">
          <a href="{{route('products.edit', $product)}}" class="w-full">
            <button class="w-full px-3 py-3 bg-zinc-400 font-semibold ">Edit</button>
          </a>
        </div>
      </div>
      @endforeach
    </div>

    <div class="mt-4 px-3">
      {{ $products->Links() }}
    </div>

  </div>

</x-app-layout>