<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;



class CartController extends Controller
{
    public function index()
    {
        $cartItems = Session::get('cartItems', []); // Ambil data dari session (hanya ID produk & kuantitas)
        $products = [];
        $totalPrice = 0;
    
        foreach ($cartItems as $productId => $quantity) {
            $product = Product::find($productId);
    
            if ($product) {
                $product->quantity = $quantity;
                $products[] = $product;
    
                // Validasi harga produk adalah angka
                if (is_numeric($product->harga)) {
                    $qty = (int) $quantity; // Tidak perlu akses array karena quantity adalah string
                    $totalPrice += $product->harga * $qty;
                }
            }
        }
    
        return view('cart.index', compact('products', 'totalPrice'));
    }
    
    
    
    

    public function addToCart(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);
    
        // Perbarui atau buat data di database
        $cart = Cart::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'product_id' => $validated['product_id'],
            ],
            [
                'quantity' => \DB::raw('quantity + ' . $validated['quantity']),
            ]
        );
    
        // Perbarui data di session untuk sinkronisasi sementara
        $cartItems = Session::get('cartItems', []);
        $cartItems[$validated['product_id']] = $validated['quantity'];
        Session::put('cartItems', $cartItems);
    
        return response()->json([
            'message' => 'Product added to cart',
            'cart' => $cart,
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

    public function update(Request $request)
    {
        $cartItem = Cart::where('product_id', $request->product_id)
                        ->where('user_id', auth()->id()) // Validasi user
                        ->first();
    
        if ($cartItem) {
            $cartItem->quantity = $request->quantity;
            $cartItem->save();
        }
    
        return response()->json(['success' => true]);
    }
    




    // PEMROSESAN ORDER
    public function process(Request $request)
    {
        dd(env('MIDTRANS_SERVER_KEY'), env('MIDTRANS_CLIENT_KEY'));
        $cartItems = Session::get('cartItems', []);
        $totalPrice = 0;
    
        // Hitung total harga dari cart
        foreach ($cartItems as $productId => $quantity) {
            $product = Product::find($productId);
            if ($product) {
                $totalPrice += $product->harga * $quantity;
            }
        }
    
        if ($totalPrice == 0) {
            return redirect()->route('cart.index')->with('error', 'Cart is empty!');
        }
    
        // Buat transaksi di database
        $transaction = Transaction::create([
            'user_id' => Auth::user()->id,
            'price' => $totalPrice,
            'status' => 'pending',
        ]);
    
        // Konfigurasi Midtrans
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('midtrans.isProduction');
        \Midtrans\Config::$isSanitized = config('midtrans.isSanitized');
        \Midtrans\Config::$is3ds = config('midtrans.is3ds');
    
        $params = [
            'transaction_details' => [
                'order_id' => $transaction->id,
                'gross_amount' => $totalPrice,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ],
        ];
    
        $snapToken = \Midtrans\Snap::getSnapToken($params);
    
        $transaction->snap_token = $snapToken;
        $transaction->save();
    
        return view('cart.checkout', compact('transaction', 'snapToken'));
    }
    

    public function checkout(Transaction $transaction)
    {
        $products = config('products');
        $product = collect($products)->firstWhere('id', $transaction->product_id);

        return view('checkout', compact('transaction', 'product'));
    }

    public function success(Transaction $transaction)
    {
        $transaction->status = 'success';
        $transaction->save();

        return view('checkout.success', compact('transaction'));
    }

    

}
