<x-app-layout>
<x-slot name="header">
      {{ __('Detail Penduduk') }}
  </x-slot>
  <div class="container mx-auto p-4">
    <div class="flex justify-between items-center mb-4">
    </div>
    <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-lg p-8 lg:ml-5 ">
      <div class="flex flex-col justify-between md:flex-row items-center mb-8">
        <div class="block lg:flex items-center gap-3 mb-5 ">
          <img alt="Foto pass foto penduduk" class="w-30 h-30 lg:w-40 lg:h-40  rounded-full mb-4 md:mb-0 md:mr-8 shadow-lg object-cover "
            height="160" src="{{ asset('storage/pass_foto_penduduk/' . $penduduk->pass_foto) }}"
            alt="Foto {{ $penduduk->nama }}" width="160" />
          <div>
            <h2 class="text-3xl font-semibold dark:text-white text-center lg:text-left">
              {{ $penduduk->nama }}
            </h2>
            <p class="text-gray-600 dark:text-gray-400 text-center lg:text-left">
              {{ $penduduk->nik }}
            </p>
          </div>
        </div>


        <div class="inline-flex rounded-md shadow-sm" role="group">
          <a href="{{ route('penduduk.index') }}">
            <button type="button"
              class="inline-flex items-center px-4 py-2 text-sm font-small text-gray-900 bg-transparent border border-gray-900 rounded-s-lg hover:bg-gray-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4 mr-2">
                <path fill-rule="evenodd"
                  d="M9.53 2.47a.75.75 0 0 1 0 1.06L4.81 8.25H15a6.75 6.75 0 0 1 0 13.5h-3a.75.75 0 0 1 0-1.5h3a5.25 5.25 0 1 0 0-10.5H4.81l4.72 4.72a.75.75 0 1 1-1.06 1.06l-6-6a.75.75 0 0 1 0-1.06l6-6a.75.75 0 0 1 1.06 0Z"
                  clip-rule="evenodd" />
              </svg>

              Kembali
            </button>
          </a>
          <form action="{{ route('penduduk.destroy', $penduduk->id) }}" method="POST"
            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
            @csrf
            @method('DELETE')
            <button type="submit"
              class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-transparent border-t border-b border-gray-900 hover:bg-gray-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4 mr-2">
                <path fill-rule="evenodd"
                  d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z"
                  clip-rule="evenodd" />
              </svg>


              Hapus
            </button>
          </form>



          <a href="{{ route('penduduk.edit', $penduduk->id) }}">
            <button type="button"
              class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-transparent border border-gray-900 rounded-e-lg hover:bg-gray-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4 mr-2">
                <path
                  d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                <path
                  d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
              </svg>

              Edit
            </button>
          </a>
        </div>

      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-gray-100 dark:bg-gray-700 p-6 rounded-lg shadow-md">
          <h3 class="font-semibold text-lg">
            Jenis Kelamin
          </h3>
          <p class="text-gray-600 dark:text-gray-400">
            {{ $penduduk->jenis_kelamin }}
          </p>
        </div>
        <div class="bg-gray-100 dark:bg-gray-700 p-6 rounded-lg shadow-md">
          <h3 class="font-semibold text-lg">
            Tanggal Lahir
          </h3>
          <p class="text-gray-600 dark:text-gray-400">
            {{ \Carbon\Carbon::parse($penduduk->tanggal_lahir)->format('d/m/Y') }}
          </p>
        </div>
        <div class="bg-gray-100 dark:bg-gray-700 p-6 rounded-lg shadow-md">
          <h3 class="font-semibold text-lg">
            Alamat
          </h3>
          <p class="text-gray-600 dark:text-gray-400">
            {{ $penduduk->alamat }}
          </p>
        </div>
        <div class="bg-gray-100 dark:bg-gray-700 p-6 rounded-lg shadow-md">
          <h3 class="font-semibold text-lg">
            Kelurahan
          </h3>
          <p class="text-gray-600 dark:text-gray-400">
            {{ $penduduk->kelurahan_name }}
          </p>
        </div>
        <div class="bg-gray-100 dark:bg-gray-700 p-6 rounded-lg shadow-md">
          <h3 class="font-semibold text-lg">
            Kecamatan
          </h3>
          <p class="text-gray-600 dark:text-gray-400">
            {{ $penduduk->kecamatan_name }}
          </p>
        </div>
        <div class="bg-gray-100 dark:bg-gray-700 p-6 rounded-lg shadow-md">
          <h3 class="font-semibold text-lg">
            Kabupaten
          </h3>
          <p class="text-gray-600 dark:text-gray-400">
            {{ $penduduk->kabupaten_name }}
          </p>
        </div>
        <div class="bg-gray-100 dark:bg-gray-700 p-6 rounded-lg shadow-md">
          <h3 class="font-semibold text-lg">
            Provinsi
          </h3>
          <p class="text-gray-600 dark:text-gray-400">
            {{ $penduduk->provinsi_name }}
          </p>
        </div>
        <div class="bg-gray-100 dark:bg-gray-700 p-6 rounded-lg shadow-md">
          <h3 class="font-semibold text-lg">
            Pekerjaan
          </h3>
          <p class="text-gray-600 dark:text-gray-400">
            {{ $penduduk->pekerjaan }}
          </p>
        </div>
        <div class="bg-gray-100 dark:bg-gray-700 p-6 rounded-lg shadow-md">
          <h3 class="font-semibold text-lg">
            Pendidikan
          </h3>
          <p class="text-gray-600 dark:text-gray-400">
            {{ $penduduk->pendidikan }}
          </p>
        </div>
        <div class="bg-gray-100 dark:bg-gray-700 p-6 rounded-lg shadow-md">
          <h3 class="font-semibold text-lg">
            Status Perkawinan
          </h3>
          <p class="text-gray-600 dark:text-gray-400">
            {{ $penduduk->status_perkawinan }}
          </p>
        </div>
      </div>

    </div>
  </div>

</x-app-layout>