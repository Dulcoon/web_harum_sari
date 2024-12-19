<x-app-layout>

 <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

  @if (session()->has('success'))
  <x-alert message="{{ session('success') }}" />
  @endif

  <div class="flex justify-between px-3">
   <form method="GET" action="{{ route('products.index') }}" class="mb-4">
    <div class="mt-4">
     <x-input-label for="kategori_id" :value="__('Kategori')" />

     <x-dropdown align="left" width="48" contentClasses="py-1 bg-white">
      <x-slot name="trigger">
       <button id="kategori_trigger" type="button" class="block w-full text-left border rounded-lg px-4 py-2 bg-white">
        {{ old('kategori_id') ? $kategories->firstWhere('id', old('kategori_id'))->nama ?? 'Pilih Kategori...' : 'Pilih Kategori...' }}
       </button>
      </x-slot>

      <x-slot name="content">
       @foreach($kategories as $kategori)
       <div>
        <button type="button" class="w-full text-left px-4 py-2 hover:bg-gray-100" @click="
                            document.getElementById('hidden_kategori_id').value = '{{ $kategori->id }}'; 
                            document.getElementById('kategori_trigger').innerText = '{{ $kategori->nama }}';
                        ">
         {{ $kategori->nama }}
        </button>
       </div>
       @endforeach
      </x-slot>
     </x-dropdown>

     <input type="hidden" id="hidden_kategori_id" name="kategori_id" value="{{ old('kategori_id', '') }}">
     <x-input-error :messages="$errors->get('kategori_id')" class="mt-2" />
    </div>

    <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded-md">Filter</button>
   </form>


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
    <img src="{{ url('storage/' . $product->foto) }}" class="h-96 w-full object-cover" alt="">
    <div class="text-center">
     <p>{{ $product->nama }}</p>
     <p>Rp. {{ number_format($product->harga) }}</p>
    </div>

    <div class="flex justify-center">
     <a href="{{route('products.detail', $product)}}" class="w-full">
      <button class="w-full px-3 py-3 bg-zinc-400 font-semibold ">Detail Product</button>
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