<?php

// Menggunakan GuzzleHTTP untuk melakukan HTTP request
use GuzzleHttp\Client;

// Fungsi untuk mendapatkan nama wilayah berdasarkan kode wilayah
function getWilayahNameByCode($code, $type)
{
    // Tentukan URL endpoint API berdasarkan tipe wilayah
    $endpoint = '';
    
    switch ($type) {
        case 'villages':
            $endpoint = "https://wilayah.id/api/villages/{$code}.json";
            break;
        case 'districts':
            $endpoint = "https://wilayah.id/api/districts/{$code}.json";
            break;
        case 'regencies':
            $endpoint = "https://wilayah.id/api/regencies/{$code}.json";
            break;
        case 'provinces':
            $endpoint = "https://wilayah.id/api/provinces/{$code}.json";
            break;
        default:
            return "Tipe wilayah tidak valid";  // Jika tipe tidak valid
    }

    // Membuat client HTTP dengan Guzzle
    $client = new Client();

    try {
        // Melakukan request ke API
        $response = $client->get($endpoint);

        // Mengambil data JSON dari response
        $data = json_decode($response->getBody()->getContents(), true);

        // Cek apakah data ada dan kembalikan nama wilayah
        if (isset($data['data'][0])) {
            return $data['data'][0]['name']; // Mengembalikan nama wilayah
        } else {
            return "Data tidak ditemukan untuk kode wilayah {$code}";
        }
    } catch (\Exception $e) {
        // Menangani error jika request gagal
        return 'Terjadi kesalahan saat mengakses API: ' . $e->getMessage();
    }
}

// Contoh penggunaan
$kodeWilayah = '12.12.08'; // Ganti dengan kode wilayah yang diinginkan
$jenisWilayah = 'villages'; // Bisa 'provinces', 'regencies', 'districts', atau 'villages'

echo getWilayahNameByCode($kodeWilayah, $jenisWilayah);
?>
