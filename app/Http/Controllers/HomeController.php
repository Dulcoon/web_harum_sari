<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Kategori;


use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function showHomePage()
    {
        // Mengambil semua kategori beserta jumlah produk di setiap kategori
        $kategories = Kategori::withCount('products')->get();

        // Mengambil produk untuk ditampilkan di halaman utama
        $products = Product::paginate(12);

        // Mengambil produk yang memiliki atribut featured_products bernilai true
        $featuredProducts = Product::where('featured_products', true)->get();

        return view('homepage.home', compact('products', 'kategories', 'featuredProducts'));
    }

    public function product(Request $request)
    {
        return view('homepage.product');
    }

    public function showProductDetail($id)
    {
        $product = Product::findOrFail($id); // Mengambil produk berdasarkan ID
        return view('homepage.product-detail', compact('product'));
    }

    public function searchSuggestions(Request $request)
    {
        $query = $request->get('query');
        
        $products = Product::where('nama', 'like', "%{$query}%")
            ->limit(5)
            ->get(['id', 'nama', 'harga', 'foto']);

        return response()->json($products);
    }
}
