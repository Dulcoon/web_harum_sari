<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>


    <div class="w-full px-10 min-h-screen pb-10">

        <div class="wrapper-lagi grid grid-cols-1 md:grid-cols-3 gap-4 mb-5 mt-7">
            <div class="w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                <div class="flex justify-center">
                    <div class="grid gap-4">
                        <div class="flex gap-7">
                            <div class="icon">
                                <div class="bungkus-icon flex justify-center items-center p-3 bg-green-400 rounded-xl">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="black" class="size-12">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="">
                                <h5
                                    class="inline-flex items-center text-gray-500 dark:text-gray-400 leading-none font-normal mb-2">
                                    Total Penduduk
                                </h5>
                                <p class="text-gray-900 text-center dark:text-white text-3xl leading-none font-bold">{{$totalPenduduk}}</p>
                            </div>
                        </div>
                        <div>
                        </div>
                    </div>
                    
                </div>
                <div
                    class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between mt-2.5">
                    <div class="pt-5">
                    </div>
                </div>
            </div>
            <div class="w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                <div class="flex justify-center">
                    <div class="grid gap-4">
                        <div class="flex gap-7">
                            <div class="icon">
                                <div class="bungkus-icon flex justify-center items-center p-3 bg-[#c9c941] rounded-xl">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-9">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 7.5h-.75A2.25 2.25 0 0 0 4.5 9.75v7.5a2.25 2.25 0 0 0 2.25 2.25h7.5a2.25 2.25 0 0 0 2.25-2.25v-7.5a2.25 2.25 0 0 0-2.25-2.25h-.75m0-3-3-3m0 0-3 3m3-3v11.25m6-2.25h.75a2.25 2.25 0 0 1 2.25 2.25v7.5a2.25 2.25 0 0 1-2.25 2.25h-7.5a2.25 2.25 0 0 1-2.25-2.25v-.75" />
                                </svg>

                                </div>
                            </div>
                            <div class="">
                                <h5
                                    class="inline-flex items-center text-gray-500 dark:text-gray-400 leading-none font-normal mb-2">
                                    Penduduk Usia Produktif
                                </h5>
                                <p class="text-gray-900 text-center dark:text-white text-3xl leading-none font-bold">{{$usiaProduktif}}</p>
                            </div>
                        </div>
                        <div>
                        </div>
                    </div>
                    
                </div>
                <div
                    class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between mt-2.5">
                    <div class="pt-5">
                    </div>
                </div>
            </div>
            <div class="w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                <div class="flex justify-center">
                    <div class="grid gap-4">
                        <div class="flex gap-7">
                            <div class="icon">
                                <div class="bungkus-icon flex justify-center items-center p-3 bg-red-500 rounded-xl">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-9">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 7.5h-.75A2.25 2.25 0 0 0 4.5 9.75v7.5a2.25 2.25 0 0 0 2.25 2.25h7.5a2.25 2.25 0 0 0 2.25-2.25v-7.5a2.25 2.25 0 0 0-2.25-2.25h-.75m-6 3.75 3 3m0 0 3-3m-3 3V1.5m6 9h.75a2.25 2.25 0 0 1 2.25 2.25v7.5a2.25 2.25 0 0 1-2.25 2.25h-7.5a2.25 2.25 0 0 1-2.25-2.25v-.75" />
                                </svg>

                                </div>
                            </div>
                            <div class="">
                                <h5
                                    class="inline-flex items-center text-gray-500 dark:text-gray-400 leading-none font-normal mb-2">
                                    Penduduk Usia Non-Produktif
                                </h5>
                                <p class="text-gray-900 text-center dark:text-white text-3xl leading-none font-bold">{{$usiaNonProduktif}}</p>
                            </div>
                        </div>
                        <div>
                        </div>
                    </div>
                    
                </div>
                <div
                    class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between mt-2.5">
                    <div class="pt-5">
                    </div>
                </div>
            </div>
            
        </div>
        <div class="wrapper grid grid-cols-1 md:grid-cols-1 gap-4">
            <div class="w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                <div class="flex justify-between mb-5">
                    <div class="grid gap-4 grid-cols-2">
                        <div>
                            <h5
                                class="inline-flex items-center text-gray-500 dark:text-gray-400 leading-none font-normal mb-2">
                                Total Penduduk Terdaftar
                                <svg data-popover-target="clicks-info" data-popover-placement="bottom"
                                    class="w-3 h-3 text-gray-400 hover:text-gray-900 dark:hover:text-white cursor-pointer ms-1"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                </svg>
                                <div data-popover id="clicks-info" role="tooltip"
                                    class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
                                    <div class="p-3 space-y-2">
                                        <h3 class="font-semibold text-gray-900 dark:text-white">Pertumbuhan Berdasarkan Jenis Kelamin - Bertahap</h3>
                                        <p>Laporan ini membantu memantau pertumbuhan kumulatif aktivitas berdasarkan jenis kelamin. Idealnya, grafik
                                            menunjukkan tren pertumbuhan untuk data laki-laki dan perempuan. Jika salah satu tren stagnan, hal tersebut
                                            dapat menandakan penurunan partisipasi dari kelompok tersebut.</p>
                                        <h3 class="font-semibold text-gray-900 dark:text-white">Perhitungan</h3>
                                        <p>Untuk setiap periode waktu, volume aktivitas sepanjang waktu dihitung secara terpisah untuk laki-laki dan
                                            perempuan. Artinya, aktivitas pada periode n mencakup semua aktivitas hingga periode n untuk masing-masing jenis
                                            kelamin, ditambah aktivitas baru yang dihasilkan komunitas selama periode tersebut.</p>

                                        <a href="#"
                                            class="flex items-center font-medium text-blue-600 dark:text-blue-500 dark:hover:text-blue-600 hover:text-blue-700 hover:underline">Read
                                            more <svg class="w-2 h-2 ms-1.5 rtl:rotate-180" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="m1 9 4-4-4-4" />
                                            </svg></a>
                                    </div>
                                    <div data-popper-arrow></div>
                                </div>
                            </h5>
                            <p class="text-gray-900 dark:text-white text-2xl leading-none font-bold">{{$totalPenduduk}}</p>
                        </div>
                        <div>
            
                        </div>
                    </div>
                </div>
                <div id="line-chart"></div>
                <div
                    class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between mt-2.5">
                    
                </div>
            </div>
        </div>

    </div>



</x-app-layout>