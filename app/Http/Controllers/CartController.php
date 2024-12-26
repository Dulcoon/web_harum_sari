<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Session;


class CartController extends Controller
{
    public function index()
    {
        // Ambil cart dari session
        $cartItems = Session::get('cartItems', []);
    
        // Ambil data produk berdasarkan cart
        $products = [];
        foreach ($cartItems as $productId => $quantity) {
            $product = Product::find($productId); // Mengambil produk berdasarkan ID
            if ($product) {
                $product->quantity = $quantity; // Menambahkan quantity ke produk
                $products[] = $product;
            }
        }
    
        // Pass data produk ke view
        return view('cart.index', compact('products', 'cartItems'));
    }
    
    

    public function addToCart(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Menyimpan produk ke database
        $cart = Cart::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'product_id' => $validated['product_id'],
            ],
            [
                'quantity' => \DB::raw('quantity + ' . $validated['quantity']),
            ]
        );

        // Mendapatkan cart dari session
        $cartItems = Session::get('cartItems', []);
        
        // Update atau tambahkan item ke session
        if (isset($cartItems[$validated['product_id']])) {
            $cartItems[$validated['product_id']]['quantity'] += $validated['quantity'];
        } else {
            $cartItems[$validated['product_id']] = [
                'product_id' => $validated['product_id'],
                'quantity' => $validated['quantity'],
            ];
        }
        
        // Simpan cart kembali ke session
        Session::put('cartItems', $cartItems);

        // Kembalikan respons
        return response()->json([
            'message' => 'Product added to cart',
            'cart' => $cart,
            'cartItems' => $cartItems, // Kirim data cart ke view
        ]);
    }


    public function remove(Request $request)
    {
        // Ambil ID produk dari form
        $productId = $request->input('product_id');
        
        // Cari item di database berdasarkan product_id
        $cartItem = Cart::where('product_id', $productId)
                            ->where('user_id', auth()->id())  // Pastikan milik user yang sedang login
                            ->first();
    
        if ($cartItem) {
            // Hapus item dari database
            $cartItem->delete();
            
            // Menghapus item dari sesi
            $cartItems = session()->get('cartItems', []);
            unset($cartItems[$productId]);
            session()->put('cartItems', $cartItems);
    
            return redirect()->route('cart.index')->with('success', 'Item removed successfully');
        }
    
        return redirect()->route('cart.index')->with('error', 'Item not found');
    }
    

}
