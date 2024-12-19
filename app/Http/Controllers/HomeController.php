<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Kategori;


use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function showHomePage()
    {
    // Mengambil produk untuk ditampilkan di halaman utama
    $products = Product::paginate(12); 

    return view('homepage.home', compact('products'));
    }

    public function product()
    {

    // Ambil produk berdasarkan kategori
    $products = Product::paginate(12); 

    return view('homepage.product', compact('products'));
    }
}
