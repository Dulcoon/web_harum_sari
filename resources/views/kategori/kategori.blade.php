<x-app-layout>

 <div class="w-2xl flex justify-center">
  <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
   <a href="{{route('category.create')}}"><button type="button" class="flex justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Tambah Data</button></a>
   <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
     <tr>
      <th scope="col" class="px-6 py-3">
       id
      </th>
      <th scope="col" class="px-6 py-3">
       Nama
      </th>
      <th scope="col" class="px-6 py-3">
       thumbnail
      </th>
      <th scope="col" class="px-6 py-3">
       <span class="sr-only">Edit</span>
      </th>
     </tr>
    </thead>
    <tbody>
     @foreach ($categories as $kategori )
      
     <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
      <td class="px-6 py-4">
       {{ $kategori->id }}
      </td>
      <td class="px-6 py-4">
       {{ $kategori->nama }}
       
      </td>
      <td class="px-6 py-4">
       <img src="{{ asset('storage/'.$kategori->thumbnail) }}" alt="thumbnail" width="200">
       <!-- {{ $kategori->thumbnail }} -->
      </td>
      <td class="px-6 py-4 text-xl">
       <div class="flex flex-col">
        <a href="{{route('category.edit', $kategori)}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
        <form action="{{ route('category.destroy', $kategori->id) }}" method="POST"
        onsubmit="return confirm('Are you sure you want to delete this category?');">
        @csrf
        @method('DELETE')
        <x-danger-button class="mt-4">
          {{ __('Delete') }}
        </x-danger-button>
            </form>
       </div>
      </td>
     </tr>
     @endforeach
    
    </tbody>
   </table>
  </div>
 </div>

</x-app-layout>