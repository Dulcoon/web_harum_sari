<x-app-layout>
<x-slot name="header">
      {{ __('Edit Penduduk') }}
  </x-slot>

  <section class="bg-white dark:bg-gray-900">
    <div class="py-8 px-4 mx-auto max-w-3xl lg:py-16">
      <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Data Diri</h2>
      <form action="{{ route('penduduk.update', $user->id) }} " method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
            <div class="sm:col-span-2">
                <label for="nik" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    NIK Penduduk
                </label>
                <input
                    type="text"
                    name="nik"
                    value="{{ old('nik', $user->nik) }}"
                    id="nik"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="Masukkan NIK"
                    required
                    maxlength="16"
                    pattern="\d{16}"
                    oninput="validateNIK(this)"
                >
                <small id="nikError" class="text-red-600 hidden">NIK harus terdiri dari tepat 16 digit angka.</small>
            </div>
          <div class="sm:col-span-2">
            <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Lengkap</label>
            <input type="text" name="nama" value="{{ old('nama', $user->nama) }}" id="nama"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
              placeholder="Masukkan nama anda" required="">
          </div>
          <div class="w-full">
            <label for="jenis_kelamin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis
              Kelamin</label>
              <select id="jenis_kelamin" name="jenis_kelamin" required
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
              <option value="Laki-Laki" {{ old('jenis_kelamin', $user->jenis_kelamin) == 'Laki-Laki' ? 'selected' : '' }}>Laki-laki</option>
              <option value="Perempuan" {{ old('jenis_kelamin', $user->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
          </div>
          <div>
            <label for="tanggal_lahir"
              class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">tanggal_lahir</label>
            <div class="relative max-w-sm">
              <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                  <path
                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                </svg>
              </div>
              <input datepicker id="default-datepicker" type="text" value="{{ old('tanggal_lahir', $formattedDate) }}" name="tanggal_lahir"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="pilih tanggal lahir" required>
            </div>
          </div>
          <div class="w-full">
            <label for="pekerjaan"
              class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pekerjaan</label>
            <input type="text" name="pekerjaan" value="{{ old('pekerjaan', $user->pekerjaan) }}" id="pekerjaan"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
              placeholder="Masukkan Pekerjaan Anda" required="">
          </div>
          <div class="w-full">
            <label for="pendidikan"
              class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pendidikan</label>
            <input type="text" name="pendidikan" value="{{ old('pendidikan', $user->pendidikan) }}" id="pendidikan"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
              placeholder="Masukkan pendidikan terakhir anda" required="">
          </div>
          <div class="sm:col-span-2">
            <label for="status_perkawinan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status
              Perkawinan</label>
              <select id="status_perkawinan" name="status_perkawinan" required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                <option value="Belum Kawin" {{ old('status_perkawinan', $user->status_perkawinan) == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                <option value="Kawin" {{ old('status_perkawinan', $user->status_perkawinan) == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                <option value="Cerai" {{ old('status_perkawinan', $user->status_perkawinan) == 'Cerai' ? 'selected' : '' }}>Cerai</option>
              </select>

          </div>

                    <!-- Tambahkan Input Gambar -->
          <div class="sm:col-span-2">
            <label for="pass_foto" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Foto Penduduk</label>
            <input type="file" name="pass_foto" id="pass_foto" required
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
              accept="image/*" onchange="previewImage(event)">
          </div>

          <!-- Preview Gambar -->
          <div class="sm:col-span-2">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Preview Gambar</label>
            <img id="image-preview"
              src="{{ asset('storage/pass_foto_penduduk/' . $user->pass_foto) }}"
              alt="Preview Foto Penduduk"
              class="w-40 h-40 object-cover rounded-lg border border-gray-300 dark:border-gray-600">
          </div>

          <hr class="sm:col-span-2 my-4 border-gray-300" />

          <h2 class="sm:col-span-2 text-xl font-bold text-gray-900 dark:text-white">Alamat</h2>
          <div class="w-full">
            <label for="provinsi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Provinsi</label>
            <select id="provinsi" value="{{ old('provinsi', $user->provinsi) }}" name="provinsi" required
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
              <option selected="">Pilih Provinsi</option>
            </select>
          </div>
          <div class="w-full">
            <label for="kabupaten"
              class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kabupaten</label>
            <select id="kabupaten" name="kabupaten" required
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
              disabled>
              <option selected="">Pilih Kabupaten</option>
            </select>
          </div>
          <div class="w-full">
            <label for="kecamatan"
              class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kecamatan</label>
            <select id="kecamatan" name="kecamatan" required
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
              disabled>
              <option selected="">Pilih Kecamatan</option>
            </select>
          </div>
          <div class="w-full">
            <label for="kelurahan"
              class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kelurahan</label>
            <select id="kelurahan" name="kelurahan" required
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
              disabled>
              <option selected="">Pilih Kelurahan</option>
            </select>
          </div>

          <div class="sm:col-span-2">
              <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
              <textarea id="description" name="alamat" rows="8" required
                  class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                  placeholder="Alamat Lengkap">{{ old('alamat', $user->alamat) }}</textarea>
          </div>

        </div>
        <button type="submit" class="mt-5 text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Simpan</button>
      </form>
    </div>
  </section>

    <!-- Tambahkan Script JavaScript untuk Preview -->
  <script>
    function previewImage(event) {
      const preview = document.getElementById('image-preview');
      const file = event.target.files[0];

      if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
          preview.src = e.target.result;
        };
        reader.readAsDataURL(file);
      }
    }
  </script>
  <script>
    function validateNIK(input) {
        const nikError = document.getElementById('nikError');
        // Validasi panjang dan hanya angka
        if (!/^\d{0,16}$/.test(input.value)) {
            input.value = input.value.slice(0, 16); // Membatasi input angka hingga 16 karakter
        }
        nikError.classList.toggle('hidden', input.value.length === 16);
    }
   </script>



</x-app-layout>
