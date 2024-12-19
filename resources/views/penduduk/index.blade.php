<x-app-layout>
  <x-slot name="header">
    {{ __('List Penduduk') }}
  </x-slot>

  <div class="w-full px-5 md:px-20 lg:px-20 py-5 min-h-screen">
    <div class="flex flex-col-reverse lg:flex-row justify-between py-3">
      
      <label for="table-search" class="sr-only">Search</label>
      <div class="relative">
        <div class="absolute inset-y-0 left-0 rtl:inset-r-0 rtl:right-0 flex items-center ps-3 pointer-events-none">
          <svg class="w-5 h-5  text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor"
            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
              d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
              clip-rule="evenodd"></path>
          </svg>
        </div>
        <form method="GET" action="{{ route('penduduk.index') }}">
          <input type="text" name="search" value="{{ request('search') }}"
            class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="Search for items">
          <button type="submit" class="hidden"></button>
        </form>

      </div>
      <a href="{{ route('penduduk.create') }}"><button type="button"
          class=" text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 ">Tambah
          Data</button></a>
    </div>

    <div class="relative overflow-x-auto lg:overflow-x-hidden shadow-md sm:rounded-lg">
      <div class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4">
      </div>
      <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <tr>

            <th scope="col" class="px-6 py-3">
              NIK
            </th>
            <th scope="col" class="px-6 py-3">
              Nama
            </th>
            <th scope="col" class="px-6 py-3">
              Jenis Kelamin
            </th>
            <th scope="col" class="px-6 py-3">
              Tanggal Lahir
            </th>
            <th scope="col" class="px-6 py-3">
              Alamat
            </th>
            <th scope="col" class="px-6 py-3">
              Pekerjaan
            </th>
            <th scope="col" class="px-6 py-3">
              Pendidikan
            </th>
            <th scope="col" class="px-6 py-3">
              Status Perkawinan
            </th>
            <th scope="col" class="px-6 py-3">
              Action
            </th>
          </tr>
        </thead>
        <tbody>
          @foreach ($penduduks as $penduduk)
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">


        <td class="px-6 py-4">
          {{ $penduduk->nik }}
        </td>
        <td class="px-6 py-4">
          {{ $penduduk->nama }}
        </td>
        <td class="px-6 py-4">
          {{ $penduduk->jenis_kelamin }}
        </td>
        <td class="px-6 py-4">
          {{ $penduduk->tanggal_lahir }}
        </td>
        <td class="px-6 py-4">
          {{ $penduduk->alamat }}
        </td>
        <td class="px-6 py-4">
          {{ $penduduk->pekerjaan }}
        </td>
        <td class="px-6 py-4">
          {{ $penduduk->pendidikan }}
        </td>
        <td class="px-6 py-4">
          {{ $penduduk->status_perkawinan }}
        </td>
        <td class="px-6 py-4">
          <a href="{{ route('penduduk.show', $penduduk->id) }}"
          class="font-medium text-green-600 dark:text-green-500 hover:underline">detail</a>
        </td>
        </tr>
      @endforeach
        </tbody>
      </table>
      
    </div>
    <div class="flex flex-col items-center mt-4">
      <!-- Help text -->
      <span class="text-sm text-gray-700 dark:text-gray-400">
        Showing
        <span class="font-semibold text-gray-900 dark:text-white">{{ $penduduks->firstItem() }}</span>
        to
        <span class="font-semibold text-gray-900 dark:text-white">{{ $penduduks->lastItem() }}</span>
        of
        <span class="font-semibold text-gray-900 dark:text-white">{{ $penduduks->total() }}</span>
        Entries
      </span>
      <!-- Buttons -->
      <div class="inline-flex mt-2 xs:mt-0">
        <a href="{{ $penduduks->previousPageUrl() }}"
          class="flex items-center justify-center px-4 h-10 text-base font-medium text-white bg-gray-800 rounded-s hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white {{ $penduduks->onFirstPage() ? 'pointer-events-none opacity-50' : '' }}">
          Prev
        </a>
        <a href="{{ $penduduks->nextPageUrl() }}"
          class="flex items-center justify-center px-4 h-10 text-base font-medium text-white bg-gray-800 border-0 border-s border-gray-700 rounded-e hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white {{ !$penduduks->hasMorePages() ? 'pointer-events-none opacity-50' : '' }}">
          Next
        </a>
      </div>
    </div>


  </div>

</x-app-layout>