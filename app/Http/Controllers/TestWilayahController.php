<?php

// Respons JSON dari URL
$jsonResponse = '{
    "data": [
        {"code": "11", "name": "Aceh"},
        {"code": "51", "name": "Bali"},
        {"code": "36", "name": "Banten"},
        {"code": "17", "name": "Bengkulu"},
        {"code": "34", "name": "Daerah Istimewa Yogyakarta"},
        {"code": "31", "name": "DKI Jakarta"},
        {"code": "75", "name": "Gorontalo"},
        {"code": "15", "name": "Jambi"},
        {"code": "32", "name": "Jawa Barat"},
        {"code": "33", "name": "Jawa Tengah"},
        {"code": "35", "name": "Jawa Timur"},
        {"code": "61", "name": "Kalimantan Barat"},
        {"code": "63", "name": "Kalimantan Selatan"},
        {"code": "62", "name": "Kalimantan Tengah"},
        {"code": "64", "name": "Kalimantan Timur"},
        {"code": "65", "name": "Kalimantan Utara"},
        {"code": "19", "name": "Kepulauan Bangka Belitung"},
        {"code": "21", "name": "Kepulauan Riau"},
        {"code": "18", "name": "Lampung"},
        {"code": "81", "name": "Maluku"},
        {"code": "82", "name": "Maluku Utara"},
        {"code": "52", "name": "Nusa Tenggara Barat"},
        {"code": "53", "name": "Nusa Tenggara Timur"},
        {"code": "91", "name": "Papua"},
        {"code": "92", "name": "Papua Barat"},
        {"code": "95", "name": "Papua Pegunungan"},
        {"code": "93", "name": "Papua Selatan"},
        {"code": "94", "name": "Papua Tengah"},
        {"code": "14", "name": "Riau"},
        {"code": "76", "name": "Sulawesi Barat"},
        {"code": "73", "name": "Sulawesi Selatan"},
        {"code": "72", "name": "Sulawesi Tengah"},
        {"code": "74", "name": "Sulawesi Tenggara"},
        {"code": "71", "name": "Sulawesi Utara"},
        {"code": "13", "name": "Sumatera Barat"},
        {"code": "16", "name": "Sumatera Selatan"},
        {"code": "12", "name": "Sumatera Utara"}
    ],
    "meta": {
        "administrative_area_level": 1,
        "updated_at": "2024-10-09T16:56:42+00:00"
    }
}';

// Mengurai JSON menjadi array
$data = json_decode($jsonResponse, true);

// Input kode provinsi
$inputCode = "32";

// Inisialisasi nama provinsi
$provinceName = null;

// Loop untuk mencari nama provinsi berdasarkan kode
foreach ($data['data'] as $province) {
    if ($province['code'] === $inputCode) {
        $provinceName = $province['name'];
        break;
    }
}

// Menampilkan hasil
if ($provinceName) {
    echo "Nama provinsi dengan kode $inputCode adalah: $provinceName";
} else {
    echo "Provinsi dengan kode $inputCode tidak ditemukan.";
}
