<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class WishlistController extends Controller
{
    public function index(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $favorites = auth()->user()->favoriteProducts()->paginate(12);

        return view('wishlist.index', compact('favorites'));
    }

    public function toggle(Request $request, string $product): RedirectResponse
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $product = Product::where('slug', $product)->orWhere('id', $product)->firstOrFail();

        $user = auth()->user();
        $favorite = Favorite::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->first();

        if ($favorite) {
            $favorite->delete();
        } else {
            Favorite::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
            ]);
        }

        return back();
    }
}
