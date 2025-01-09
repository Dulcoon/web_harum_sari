<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartApiController extends Controller
{
    // Menambahkan produk ke keranjang
    public function add(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);
    
        $user = User::findOrFail($validated['user_id']);
        $product = Product::findOrFail($validated['product_id']);
    
        // Add or update the product in the user's cart
        $cartItem = Cart::where('user_id', $user->id)
                        ->where('product_id', $product->id)
                        ->first();
    
        if ($cartItem) {
            // Update the quantity if the product already exists in the cart
            $cartItem->quantity += $validated['quantity'];
            $cartItem->save();
        } else {
            // Otherwise, create a new cart item
            Cart::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'quantity' => $validated['quantity'],
            ]);
        }
    
        return response()->json(['message' => 'Product added to cart'], 200);
    }
    

    // Mendapatkan semua item di keranjang
    public function index()
    {
        $userId = Auth::id();
    
        if (!$userId) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    
        $cartItems = Cart::where('user_id', $userId)
            ->with(['product']) 
            ->get();
    
        $cartItemsWithDetails = $cartItems->map(function($cartItem) {
            $product = $cartItem->product; 
                'id' => $cartItem->id,
                'user_id' => $cartItem->user_id,
                'product_id' => $cartItem->product_id,
                'product_name' => $product->nama ?? 'Unknown',
                'price' => $product->harga ?? 0,
                'quantity' => $cartItem->quantity,
                'image_url' => $product->foto,
                'stock' => $product->stok,
                'created_at' => $cartItem->created_at,
                'updated_at' => $cartItem->updated_at,
            ];
        });
    
        return response()->json($cartItemsWithDetails, 200);
    }
    

    // Menghapus item dari keranjang
    public function remove(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer',
            'product_id' => 'required|integer',
        ]);
    
        $userId = $validated['user_id'];
        $productId = $validated['product_id'];
    
        // Cari item dalam keranjang
        $cartItem = Cart::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();
    
        if (!$cartItem) {
            return response()->json(['error' => 'Product not found in cart'], 404);
        }
    
        // Hapus item dari keranjang
        $cartItem->delete();
    
        return response()->json(['message' => 'Product removed from cart'], 200);
    }
    

    public function success( ){
        return view('thank-you');
    }

    public function update(Request $request)
    {
        $userId = $request->input('user_id');
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        // Find the cart item
        $cartItem = Cart::where('user_id', $userId)
                        ->where('product_id', $productId)
                        ->first();

        if (!$cartItem) {
            return response()->json(['message' => 'Cart item not found'], 404);
        }

        // Check if the product exists and has enough stock
        $product = Product::find($productId);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        if ($quantity > $product->stok) {
            return response()->json(['message' => 'Not enough stock available'], 400);
        }

        // Update the quantity
        $cartItem->quantity = $quantity;
        $cartItem->save();

        return response()->json(['message' => 'Cart item updated successfully', 'cartItem' => $cartItem], 200);
    }
}
