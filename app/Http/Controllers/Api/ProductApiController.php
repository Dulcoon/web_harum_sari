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
                'image_url' => 'https://c27f-103-92-232-19.ngrok-free.app/storage/'.$product->foto,
                'description' => $product->deskripsi ?? 'No description available',
                'category' => $product->kategori_id ?? 'Uncategorized',
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
                    'image_url' => 'https://c27f-103-92-232-19.ngrok-free.app/storage/' . $product->foto,
                    'description' => $product->deskripsi ?? 'No description available',
                    'category' => $product->kategori->nama ?? 'Uncategorized',
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
