<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;


class ProductApiController extends Controller
{
    public function index()
    {
        $products = Product::all()->map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->nama ?? 'No name',
                'price' => $product->harga ?? 0,
                'image_url' =>$product->foto,
                'description' => $product->deskripsi ?? 'No description available',
                'category' => $product->kategori_id ?? 'Uncategorized',
                'stok' => $product->stok,
            ];
        });
    
        return response()->json(['data' => $products]);
    }
    
    

    public function show($id)
    {
        $product = Product::find($id);
    
        if ($product) {
            return response()->json([
                'success' => true,
                'message' => 'Product details',
                'data' => [
                    'id' => $product->id,
                    'name' => $product->nama ?? 'No name',
                    'price' => $product->harga ?? 0,
                    'image_url' => $product->foto,
                    'description' => $product->deskripsi ?? 'No description available',
                    'category' => $product->kategori->nama ?? 'Uncategorized',
                    'stok' => $product->stok,
                ],
            ]);
        }
    
        // Jika produk tidak ditemukan
        return response()->json([
            'success' => false,
            'message' => 'Product not found',
        ], 404);
    }
    
}
