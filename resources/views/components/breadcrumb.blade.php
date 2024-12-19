<?php
$url = request()->getPathInfo();
$items = explode("/", $url);
unset($items[0]); // Hapus elemen pertama jika kosong

?>

<nav aria-label="breadcrumb">
  <ol class="flex space-x-2 text-sm text-gray-600">
    <li>
      <a href="/" class="text-blue-600 hover:underline">Home</a>
    </li>
    @php
      $fullPath = ''; // Variabel untuk menyimpan URL kumulatif
    @endphp
    @foreach ($items as $key => $item)
      @php
        $fullPath .= "/$item"; // Update URL kumulatif
      @endphp
      <li class="flex items-center">
        <span class="mx-2 text-gray-400">/</span>
        @if ($key == array_key_last($items))
          <span class="text-gray-500">{{ Str::ucfirst($item) }}</span>
        @else
          <a href="{{ $fullPath }}" class="text-blue-600 hover:underline">{{ Str::ucfirst($item) }}</a>
        @endif
      </li>
    @endforeach
  </ol>
</nav>
