<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Detail Products') }}
    </h2>
  </x-slot>

  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="flex flex-col items-center lg:flex-row justify-between px-3">
      <h2 class="font-semibold text-2xl">Detail Products</h2>
      <div class="flex flex-col lg:flex-row gap-2">
        <a href="{{ route('products.edit', $product) }}">
          <x-primary-button class="mt-4">
            {{ __('Edit Product') }}
          </x-primary-button>
        </a>
        <form action="{{ route('products.destroy', $product->id) }}" method="POST"
        onsubmit="return confirm('Are you sure you want to delete this product?');">
        @csrf
        @method('DELETE')
        <x-danger-button class="mt-4">
          {{ __('Delete Product') }}
        </x-danger-button>
            </form>
      </div>
    </div>




    <div class="mt-4" x-data="{ imageUrl: '{{ $product->foto ? asset('storage/' . $product->foto) : '/storage/no_image.png' }}' }">
      <form enctype="multipart/form-data" action="{{ route('products.update', $product->id) }}" method="POST" class="block lg:flex gap-3">
        @csrf
        @method('PUT')
        <div class="lg:w-1/2">
          <img class="w-full lg:w-4/5" :src="imageUrl"/>
        </div>
        <div class="w-full px-3 lg:w-1/2 text-center lg:text-left">

          <div class="mt-4">
            <h3 class="text-slate-600">Nama</h3>
            <p class="font-bold text-xl">{{ $product->nama }}</p>
          </div>
          <div class="mt-4">
            <h3 class="text-slate-600">Harga</h3>
            <p class="font-bold text-xl">Rp. {{ number_format($product->harga) }}</p>
          </div>
          <div class="mt-4">
            <h3 class="text-slate-600">Deskripsi</h3>
            <p class="font-bold text-xl">{{ $product->deskripsi }}</p>
          </div>
          <div class="mt-4">
            <h3 class="text-slate-600">Kategori</h3>
            <p class="font-bold text-xl">{{ $product->kategori->nama}}</p>
          </div>
          <div class="mt-4">
            <h3 class="text-slate-600">Featured Product</h3>
            <p class="font-bold text-xl">{{ $product->featured_products == '1' ? 'True' : 'False' }}</p>
          </div>
        
          

          
        </div>
      </form>
    </div>
  </div>

</x-app-layout>
