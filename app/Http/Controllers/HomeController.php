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

    public function product(Request $request)
    {
    
        $kategoriId = $request->input('kategori_id'); 

        $kategories = Kategori::all();

        $products = Product::with('kategori')
                    ->when($kategoriId, function ($query, $kategoriId) {
                        $query->where('kategori_id', $kategoriId);
                    })->paginate(10);


        return view('homepage.product', compact('products', 'kategories', 'kategoriId'));
    }
}
