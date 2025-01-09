<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Edit Products') }}
    </h2>
  </x-slot>

  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="flex justify-between px-3">
      <h2 class="font-semibold text-2xl">Edit Products</h2>
      
    </div>




    <div class="mt-4" x-data="{ imageUrl: '{{ $product->foto ? asset('storage/' . $product->foto) : '/storage/no_image.png' }}' }">
      <form enctype="multipart/form-data" action="{{ route('products.update', $product->id) }}" method="POST" class="flex gap-3">
        @csrf
        @method('PUT')
        <div class="w-1/2">
          <img class="w-4/5" :src="imageUrl"/>
        </div>
        <div class="w-1/2">
        <div class="mt-4">
          <x-input-label for="foto" :value="__('Foto')" />
          <x-text-input accept="image/*" id="foto" class="block mt-1 w-full border p-2" type="file" name="foto"
            @change="imageUrl = URL.createObjectURL($event.target.files[0])" />
          <input type="hidden" name="old_foto" value="{{ $product->foto }}">
          <x-input-error :messages="$errors->get('foto')" class="mt-2" />
        </div>

          <div class="mt-4">
            <x-input-label for="nama" :value="__('Nama')" />
            <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama" :value="old('nama', $product->nama)" required/>
            <x-input-error :messages="$errors->get('nama')" class="mt-2" />
          </div>
          <div class="mt-4">
            <x-input-label for="harga" :value="__('Harga')" />
            <x-text-input id="harga" class="block mt-1 w-full" type="text" name="harga" :value="old('harga', $product->harga)" required/>
            <x-input-error :messages="$errors->get('harga')" class="mt-2" />
          </div>
          <div class="mt-4">
            <x-input-label for="deskripsi" :value="__('Deskripsi')" />
            <x-text-area id="deskripsi" class="block mt-1 w-full" type="text-area" name="deskripsi">{{ old('deskripsi', $product->deskripsi) }}</x-text-area>
            <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
          </div>
          <div class="mt-4">
            <x-input-label for="kategori_id" :value="__('Kategori')" />
          
            <x-dropdown align="left" width="48" contentClasses="py-1 bg-white">
              <x-slot name="trigger">
                <button id="kategori_trigger" type="button" class="block w-full text-left border rounded-lg px-4 py-2 bg-white">
                  {{ old('kategori_id', $product->kategori->nama ?? 'Pilih Kategori...') }}
                </button>
              </x-slot>
          
              <x-slot name="content">
                @foreach($kategories as $kategori)
                <div>
                  <button type="button" class="w-full text-left px-4 py-2 hover:bg-gray-100"
                    @click="document.getElementById('hidden_kategori_id').value = '{{ $kategori->id }}'; document.getElementById('kategori_trigger').innerText = '{{ $kategori->nama }}';">
                    {{ $kategori->nama }}
                  </button>
                </div>
                @endforeach
              </x-slot>
            </x-dropdown>
          
            <input type="hidden" id="hidden_kategori_id" name="kategori_id" value="{{ old('kategori_id', $product->kategori_id) }}">
            <x-input-error :messages="$errors->get('kategori_id')" class="mt-2" />
          </div>

          <div class="mt-4">
            <x-input-label for="featured_products" :value="__('Featured Products')" />
          
            <x-dropdown align="left" width="48" contentClasses="py-1 bg-white">
              <x-slot name="trigger">
                <button id="featured_products_trigger" type="button"
                  class="block w-full text-left border rounded-lg px-4 py-2 bg-white">
                  {{ old('featured_products', $product->featured_products) === 1 ? 'True' : 'False' }}
                </button>
              </x-slot>
          
              <x-slot name="content">
                <div @click="$dispatch('input', '1')">
                  <button type="button" class="w-full text-left px-4 py-2 hover:bg-gray-100"
                    @click="document.getElementById('hidden_featured_products').value = 1; document.getElementById('featured_products_trigger').innerText = 'True';">
                    True
                  </button>
                </div>
                <div @click="$dispatch('input', '0')">
                  <button type="button" class="w-full text-left px-4 py-2 hover:bg-gray-100"
                    @click="document.getElementById('hidden_featured_products').value = 0; document.getElementById('featured_products_trigger').innerText = 'False';">
                    False
                  </button>
                </div>
              </x-slot>
            </x-dropdown>
          
            <input type="hidden" id="hidden_featured_products" name="featured_products" value="{{ old('featured_products', $product->featured_products) }}">
            <x-input-error :messages="$errors->get('featured_products')" class="mt-2" />
          </div>

          <div class="mt-4">
            <x-input-label for="stok" :value="__('stok')" />
            <x-text-input id="stok" class="block mt-1 w-full" type="text" name="stok" :value="old('stok', $product->stok)" required/>
            <x-input-error :messages="$errors->get('stok')" class="mt-2" />
          </div>

          <x-primary-button class="w-full justify-center mt-3">
            {{ __('Update') }}
          </x-primary-button>
        </div>
      </form>
    </div>
  </div>

</x-app-layout>
