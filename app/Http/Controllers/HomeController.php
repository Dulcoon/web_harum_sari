<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Kategori;


use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function showHomePage()
    {
        $kategories = Kategori::withCount('products')->get();

        $products = Product::paginate(12);

        $featuredProducts = Product::where('featured_products', true)->get();

        $favoriteProductIds = auth()->check()
            ? auth()->user()->favoriteProducts()->pluck('product_id')->toArray()
            : [];

        return view('homepage.home', compact('products', 'kategories', 'featuredProducts', 'favoriteProductIds'));
    }

    public function product(Request $request)
    {
        return view('homepage.product');
    }

    public function showProductDetail($id)
    {
        $product = Product::findOrFail($id);

        $isFavorited = auth()->check()
            && auth()->user()->favoriteProducts()->where('product_id', $product->id)->exists();

        return view('homepage.product-detail', compact('product', 'isFavorited'));
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
