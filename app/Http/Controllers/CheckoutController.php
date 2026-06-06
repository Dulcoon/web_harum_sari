<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function index(): View
    {
        return view('cart.checkout');
    }

    public function createMidtransToken(Request $request)
    {
        return response()->json(['error' => 'Not implemented'], 501);
    }

    public function success(): View
    {
        return view('checkout.success');
    }

    public function pending(): View
    {
        return view('checkout.pending');
    }

    public function createSnapToken(Request $request)
    {
        return response()->json(['error' => 'Not implemented'], 501);
    }
}
