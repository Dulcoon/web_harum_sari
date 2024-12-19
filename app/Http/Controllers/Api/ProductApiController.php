<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;


class ProductApiController extends Controller
{
    // Menampilkan semua produk
    public function index()
    {
        $products = Product::all()->map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->nama ?? 'No name',
                'price' => $product->harga ?? 0,
                'image_url' => 'http://127.0.0.1:8000/storage/'.$product->foto,
                'description' => $product->deskripsi ?? 'No description available',
                'category' => $product->kategori_id ?? 'Uncategorized',
            ];
        });
    
        return response()->json(['data' => $products]);
    }
    
    

    // Menampilkan detail produk berdasarkan ID
    public function show($id)
    {
        // Cari produk berdasarkan ID
        $product = Product::find($id);

        // Jika produk ditemukan
        if ($product) {
            return response()->json([
                'success' => true,
                'message' => 'Product details',
                'data' => $product
            ]);
        }

        // Jika produk tidak ditemukan
        return response()->json([
            'success' => false,
            'message' => 'Product not found',
        ], 404);
    }
}
