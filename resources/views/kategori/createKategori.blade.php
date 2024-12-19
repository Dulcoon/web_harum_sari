<x-app-layout>

  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="flex justify-between px-3">
      <h2 class="font-semibold text-2xl">Add Products</h2>
    </div>

    <div class="mt-4" x-data="{ imageUrl: '/storage/no_image.png' }">
      <form enctype="multipart/form-data" action="{{ route('category.store') }}" method="POST" class="flex gap-3">
        @csrf
        <div class="w-1/2">
          <img class="w-4/5" :src="imageUrl"/>
        </div>
        <div class="w-1/2">
          <div class="mt-4">
            <x-input-label for="thumbnail" :value="__('Thumbnail')" />
            <x-text-input accept="image/*" id="thumbnail" class="block mt-1 w-full border p-2" type="file" name="thumbnail" :value="old('thumbnail')" required @change="imageUrl = URL.createObjectURL($event.target.files[0])"/>
            <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
          </div>
          <div class="mt-4">
            <x-input-label for="nama" :value="__('Nama')" />
            <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama" :value="old('nama')" required/>
            <x-input-error :messages="$errors->get('nama')" class="mt-2" />
          </div>
          


          <x-primary-button class="w-full justify-center mt-3">
                  {{ __('Submit') }}
              </x-primary-button>
        </div>

        
        
      </form>
    </div>
  </div>

</x-app-layout>