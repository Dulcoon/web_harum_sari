<x-app-layout>
<x-slot name="header">
      {{ __('Tambah Penduduk') }}
  </x-slot>

  <section class="bg-white dark:bg-gray-900">
    <div class="py-8 px-4 mx-auto max-w-3xl lg:py-16">
      <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Data Diri</h2>
      <form action="{{ route('penduduk.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
            <div class="sm:col-span-2">
                <label for="nik" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    NIK Penduduk
                </label>
                <input
                    type="text"
                    name="nik"
                    id="nik"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="Masukkan NIK"
                    required
                    maxlength="16"
                    oninput="validateNIK(this)"
                >
                <small id="nikError" class="text-red-600 hidden">NIK tidak boleh lebih dari 16 karakter.</small>
            </div>
          <div class="sm:col-span-2">
            <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Lengkap</label>
            <input type="text" name="nama" id="nama"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
              placeholder="Masukkan nama anda" required="">
          </div>
          <div class="w-full">
            <label for="jenis_kelamin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis
              Kelamin</label>
            <select id="jenis_kelamin" name="jenis_kelamin" required
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
              <option selected="">Jenis Kelamin</option>
              <option value="Laki-Laki">Laki-laki</option>
              <option value="Perempuan">Perempuan</option>
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
              <input datepicker id="default-datepicker" type="text" name="tanggal_lahir" required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="pilih tanggal lahir">
            </div>
          </div>
          <div class="w-full">
            <label for="pekerjaan"
              class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pekerjaan</label>
            <input type="text" name="pekerjaan" id="pekerjaan" required
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
              placeholder="Masukkan Pekerjaan Anda" required="">
          </div>
          <div class="w-full">
            <label for="pendidikan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Pendidikan
            </label>
            <select
                name="pendidikan"
                id="pendidikan"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                required
            >
                <option value="" disabled selected>Pilih pendidikan terakhir Anda</option>
                <option value="SD">SD</option>
                <option value="SMP">SMP</option>
                <option value="SMA">SMA</option>
                <option value="S1">S1</option>
                <option value="S2">S2</option>
                <option value="S3">S3</option>
            </select>
          </div>
          <div class="sm:col-span-2">
            <label for="status_perkawinan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status
              Perkawinan</label>
            <select id="status_perkawinan" name="status_perkawinan" required
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
              <option value="" disabled selected>Status Perkawinan</option>
              <option value="Belum Kawin">Belum Kawin</option>
              <option value="Kawin">Kawin</option>
              <option value="Cerai">Cerai</option>
            </select>
          </div>
          <!-- Input foto -->
          <div class="mb-3">
            <label for="pass_foto" class="form-label">Pass Foto</label>
            <input type="file" name="pass_foto" id="pass_foto" class="form-control" onchange="previewImage(event)" required>
          </div>

          <!-- Display image preview -->
          <div class="mb-3">
            <label for="foto_preview" class="form-label">Preview Pass Foto</label>
            <img id="foto_preview" src="#" alt="Preview Foto" class="hidden max-w-xs" />
          </div>

          <hr class="sm:col-span-2 my-4 border-gray-300" />

          <h2 class="sm:col-span-2 text-xl font-bold text-gray-900 dark:text-white">Alamat</h2>
          <div class="w-full">
            <label for="provinsi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Provinsi</label>
            <select id="provinsi" name="provinsi" required
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
              placeholder="Alamat Lengkap"></textarea>
          </div>
        </div>
        <button type="submit" class="mt-5 text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Simpan</button>
      </form>
    </div>
  </section>



  <script>
    function previewImage(event) {
      var reader = new FileReader();
      reader.onload = function(){
        var output = document.getElementById('foto_preview');
        output.src = reader.result;
        output.classList.remove('hidden'); // Show the image preview
      }
      reader.readAsDataURL(event.target.files[0]);
    }
  </script>
  <script>
    function validateNIK(input) {
        const nikError = document.getElementById('nikError');

        // Memastikan input hanya angka
        const regex = /^[0-9]*$/;
        if (!regex.test(input.value)) {
            nikError.classList.remove('hidden');
            nikError.textContent = "NIK hanya boleh berisi angka.";
            input.setCustomValidity("NIK hanya boleh berisi angka.");
        } else {
            input.setCustomValidity("");
        }

        // Memastikan panjang input adalah 16 karakter
        if (input.value.length !== 16) {
            nikError.classList.remove('hidden');
            nikError.textContent = "NIK harus terdiri dari 16 karakter.";
        } else {
            nikError.classList.add('hidden');
        }
    }
  </script>

</x-app-layout>
